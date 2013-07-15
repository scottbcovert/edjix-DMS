<?php
/**
 * actionCreateRecord.php
 * @author SalesAgility <support@salesagility.com>
 * Date: 25/04/13
 */


require_once('modules/AOW_Actions/actions/actionBase.php');
class actionCreateRecord extends actionBase {

    function actionCreateRecord(){
        parent::actionBase();
    }

    function loadJS(){

        return array('modules/AOW_Actions/actions/actionCreateRecord.js');
    }

    function edit_display($line,SugarBean $bean = null, $params = array()){
        global $app_list_strings;

        $modules = $app_list_strings['aow_moduleList'];


        $html = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
        $html .= "<tr>";
        $html .= '<td id="name_label" scope="row" valign="top">Record Type:<span class="required">*</span>&nbsp;:&nbsp;';
        $html .= "<select name='aow_actions_param[".$line."][record_type]' id='aow_actions_param_record_type".$line."'  onchange='show_crModuleFields($line);'>".get_select_options_with_id($modules, $params['record_type'])."</select></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= '<td colspan="4" scope="row"><table id="crLine'.$line.'_table" width="100%"></table></td>';
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= '<td colspan="4" scope="row"><input type="button" tabindex="116" style="display:none" class="button" value="Add Line" id="addcrline'.$line.'" onclick="add_crLine('.$line.')" /></td>';
        $html .= "</tr>";


        if(isset($params['record_type']) && $params['record_type'] != ''){
            require_once("modules/AOW_WorkFlow/aow_utils.php");
            $html .= "<script id ='aow_script".$line."'>";
            $html .= "cr_fields[".$line."] = \"".trim(preg_replace('/\s+/', ' ', getModuleFields($params['record_type'])))."\";";
            $html .= "cr_module[".$line."] = \"".$params['record_type']."\";";
            if(isset($params['field'])){
                foreach($params['field'] as $key => $field){
                    if(is_array($params['value'][$key]))$params['value'][$key] = json_encode($params['value'][$key]);

                    $html .= "load_crline('".$line."','".$field."','".$params['value'][$key]."','".$params['value_type'][$key]."');";
                }
            }
            $html .= "</script>";
        }
        return $html;

    }

    function run_action(SugarBean $bean, $params = array()){
        global $beanList, $app_list_strings, $current_user, $locale, $timedate;

        $time_format = $current_user->getPreference('timef');
        if($time_format == ''){$time_format = $locale->getPrecedentPreference('default_time_format');}

        $date_format = $current_user->getPreference('datef');
        if($date_format == ''){$date_format = $locale->getPrecedentPreference('default_date_format');}

        $date_format .= ' '.$time_format;

        $date_operator['now'] = '';
        $date_operator['plus'] = '+';
        $date_operator['minus'] = '-';


        if(isset($params['record_type']) && $params['record_type'] != ''){
            if($beanList[$params['record_type']]){
                $record = new $beanList[$params['record_type']]();
                $record_vardefs = $record->getFieldDefinitions();

                if(isset($params['field'])){
                    foreach($params['field'] as $key => $field){

                        switch($params['value_type'][$key]) {
                            case 'Field':
                                $data = $bean->field_defs[$params['value'][$key]];

                                if($data['type'] == 'relate' && isset($data['id_name'])) {
                                    $params['value'][$key] = $data['id_name'];
                                }
                                $value = $bean->$params['value'][$key];
                                break;
                            case 'Date':
                                switch($params['value'][$key][3]) {
                                    case 'business_hours';
                                        if(file_exists('modules/AOBH_BusinessHours/AOBH_BusinessHours.php')){
                                            require_once('modules/AOBH_BusinessHours/AOBH_BusinessHours.php');

                                            $businessHours = new AOBH_BusinessHours();

                                            $dateToUse = $params['value'][$key][0];
                                            $sign = $params['value'][$key][1];
                                            $amount = $params['value'][$key][2];

                                            if($sign != "plus"){
                                                $amount = 0-$amount;
                                            }
                                            if($dateToUse == "now"){
                                                $value = $businessHours->addBusinessHours($amount);
                                            }else if($dateToUse == "field"){
                                                $dateToUse = $params['field'][$key];
                                                $value = $businessHours->addBusinessHours($amount, $timedate->fromDb($bean->$dateToUse));
                                            }else{
                                                $value = $businessHours->addBusinessHours($amount, $timedate->fromDb($bean->$dateToUse));
                                            }
                                            $value = $timedate->asDb( $value );
                                            break;
                                        }
                                        $params['value'][$key][3] = 'hours';
                                        //No business hours module found - fall through.
                                    default:
                                        //matt code here
                                        if($params['value'][$key][0] == 'now'){
                                            $date = date('Y-m-d  H:i:s');
                                        } else if($params['value'][$key][0] == 'field'){
                                            $date = $record->$params['field'][$key];
                                        } else {
                                            $date = $bean->$params['value'][$key][0];
                                        }

                                        if($params['value'][$key][1] != 'now'){
                                            $value = date('Y-m-d  H:i:s', strtotime($date . ' '.$date_operator[$params['value'][$key][1]].$params['value'][$key][2].$app_list_strings['aow_date_type_list'][$params['value'][$key][3]]));
                                        } else {
                                            $value = date('Y-m-d  H:i:s', strtotime($date));
                                        }
                                    break;
                                }
                                break;
                            case 'Direct':
                            default:
                                $value = $params['value'][$key];
                                break;
                        }

                        if($record_vardefs[$field]['type'] == 'relate' && isset($record_vardefs[$field]['id_name'])) {
                            $field = $record_vardefs[$field]['id_name'];
                        }
                        $record->$field = $value;
                    }
                }
                $record->process_save_dates =false;
                $record->save();

                //Setting invoice quote relationship
                require_once('modules/Relationships/Relationship.php');
                $key = Relationship::retrieve_by_modules($bean->module_dir, $record->module_dir, $GLOBALS['db']);
                if (!empty($key)) {
                    foreach($bean->field_defs as $field=>$def){
                        if($def['type'] == 'link' && !empty($def['relationship']) && $def['relationship'] == $key){
                            $bean->load_relationship($field);
                            $bean->$field->add($record->id);
                            break;
                        }
                    }
                }

                return true;
            }
        }
        return false;
    }


}