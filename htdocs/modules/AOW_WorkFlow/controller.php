<?php
/**
 * Controller.php
 * @author SalesAgility <support@salesagility.com>
 * Date: 21/03/13
 */

require_once("modules/AOW_WorkFlow/aow_utils.php");

class AOW_WorkFlowController extends SugarController {

    protected function action_getModuleFields()
    {
        if (!empty($_REQUEST['aow_module']) && $_REQUEST['aow_module'] != '') {
            echo getModuleFields($_REQUEST['aow_module']);
        }
        die;

    }

    protected function action_getModuleOperatorField(){

        global $app_list_strings, $beanFiles, $beanList;

        $module = $_REQUEST['aow_module'];
        $fieldname = $_REQUEST['aow_fieldname'];
        $aow_field = $_REQUEST['aow_newfieldname'];

        if(isset($_REQUEST['view'])) $view = $_REQUEST['view'];
        else $view= 'EditView';

        if(isset($_REQUEST['aow_value'])) $value = $_REQUEST['aow_value'];
        else $value = '';


        require_once($beanFiles[$beanList[$module]]);
        $focus = new $beanList[$module];
        $vardef = $focus->getFieldDefinition($fieldname);

        switch($vardef['type']) {
            case 'double':
            case 'decimal':
            case 'float':
            case 'currency':
                $valid_opp = array('Equal_To','Not_Equal_To','Greater_Than','Less_Than','Greater_Than_or_Equal_To','Less_Than_or_Equal_To');
                break;
            case 'uint':
            case 'ulong':
            case 'long':
            case 'short':
            case 'tinyint':
            case 'int':
                $valid_opp = array('Equal_To','Not_Equal_To','Greater_Than','Less_Than','Greater_Than_or_Equal_To','Less_Than_or_Equal_To');
                break;
            case 'date':
            case 'datetime':
            case 'datetimecombo':
                $valid_opp = array('Equal_To','Not_Equal_To','Greater_Than','Less_Than','Greater_Than_or_Equal_To','Less_Than_or_Equal_To');
                break;
            case 'enum':
            case 'multienum':
                $valid_opp = array('Equal_To','Not_Equal_To');
                break;
            default:
                $valid_opp = array('Equal_To','Not_Equal_To');
                break;
        }

        foreach($app_list_strings['aow_operator_list'] as $key => $keyValue){
            if(!in_array($key, $valid_opp)){
                unset($app_list_strings['aow_operator_list'][$key]);
            }
        }



        $app_list_strings['aow_operator_list'];
        if($view == 'EditView'){
            echo "<select type='text' style='width:178px;' name='$aow_field' id='$aow_field ' title='' tabindex='116'>". get_select_options_with_id($app_list_strings['aow_operator_list'], $value) ."</select>";
        }else{
            echo $app_list_strings['aow_operator_list'][$value];
        }
        die;

    }

    protected function action_getFieldTypeOptions(){

        global $app_list_strings, $beanFiles, $beanList;

        $module = $_REQUEST['aow_module'];
        $fieldname = $_REQUEST['aow_fieldname'];
        $aow_field = $_REQUEST['aow_newfieldname'];

        if(isset($_REQUEST['view'])) $view = $_REQUEST['view'];
        else $view= 'EditView';

        if(isset($_REQUEST['aow_value'])) $value = $_REQUEST['aow_value'];
        else $value = '';


        require_once($beanFiles[$beanList[$module]]);
        $focus = new $beanList[$module];
        $vardef = $focus->getFieldDefinition($fieldname);

        switch($vardef['type']) {
            case 'double':
            case 'decimal':
            case 'float':
            case 'currency':
                $valid_opp = array('Direct','Field');
                break;
            case 'uint':
            case 'ulong':
            case 'long':
            case 'short':
            case 'tinyint':
            case 'int':
                $valid_opp = array('Direct','Field');
                break;
            case 'date':
            case 'datetime':
            case 'datetimecombo':
                $valid_opp = array('Direct','Field', 'Date');
                break;
            case 'enum':
            case 'multienum':
                $valid_opp = array('Direct','Field', 'Multi');
                break;
            default:
                $valid_opp = array('Direct','Field');
                break;
        }

        foreach($app_list_strings['aow_condition_type_list'] as $key => $keyValue){
            if(!in_array($key, $valid_opp)){
                unset($app_list_strings['aow_condition_type_list'][$key]);
            }
        }

        if($view == 'EditView'){
            echo "<select type='text' style='width:178px;' name='$aow_field' id='$aow_field' title='' tabindex='116'>". get_select_options_with_id($app_list_strings['aow_condition_type_list'], $value) ."</select>";
        }else{
            echo $app_list_strings['aow_condition_type_list'][$value];
        }
        die;

    }

    protected function action_getModuleFieldType()
    {
        $module = $_REQUEST['aow_module'];
        $fieldname = $_REQUEST['aow_fieldname'];
        $aow_field = $_REQUEST['aow_newfieldname'];

        if(isset($_REQUEST['view'])) $view = $_REQUEST['view'];
        else $view= 'EditView';

        if(isset($_REQUEST['aow_value'])) $value = $_REQUEST['aow_value'];
        else $value = '';

        switch($_REQUEST['aow_type']) {
            case 'Field':
                if(isset($_REQUEST['alt_module']) && $_REQUEST['alt_module'] != '') $module = $_REQUEST['alt_module'];
                if($view == 'EditView'){
                    echo "<select type='text' style='width:178px;' name='$aow_field' id='$aow_field ' title='' tabindex='116'>". getModuleFields($module, $view, $value) ."</select>";
                }else{
                    echo getModuleFields($module, $view, $value);
                }
                break;
            case 'Date':
                if($view == 'EditView'){
                    echo "<input type='text' style='width:178px;' name='$aow_field' id='$aow_field ' title='' value='$value' tabindex='116'>";
                }else{
                    echo $value;
                }
                break;
            case 'Multi':
                echo getModuleField($module,$fieldname, $aow_field, $view, $value,'multienum');
                break;
            case 'Direct':
            default:
                echo getModuleField($module,$fieldname, $aow_field, $view, $value );
                break;
        }
        die;

    }

    protected function action_getModuleFieldTypeSet()
    {
        $module = $_REQUEST['aow_module'];
        $fieldname = $_REQUEST['aow_fieldname'];
        $aow_field = $_REQUEST['aow_newfieldname'];

        if(isset($_REQUEST['view'])) $view = $_REQUEST['view'];
        else $view= 'EditView';

        if(isset($_REQUEST['aow_value'])) $value = $_REQUEST['aow_value'];
        else $value = '';

        switch($_REQUEST['aow_type']) {
            case 'Field':
                if(isset($_REQUEST['alt_module']) && $_REQUEST['alt_module'] != '') $module = $_REQUEST['alt_module'];
                if($view == 'EditView'){
                    echo "<select type='text' style='width:178px;' name='$aow_field' id='$aow_field ' title='' tabindex='116'>". getModuleFields($module, $view, $value) ."</select>";
                }else{
                    echo getModuleFields($module, $view, $value);
                }
                break;
            case 'Date':
                if(isset($_REQUEST['alt_module']) && $_REQUEST['alt_module'] != '') $module = $_REQUEST['alt_module'];
                echo getDateField($module, $aow_field, $view, $value);
                break;
            case 'Multi':
            case 'Direct':
            default:
                echo getModuleField($module,$fieldname, $aow_field, $view, $value );
                break;
        }
        die;

    }

    protected function action_getModuleField()
    {
        if(isset($_REQUEST['view'])) $view = $_REQUEST['view'];
        else $view= 'EditView';

        if(isset($_REQUEST['aow_value'])) $value = $_REQUEST['aow_value'];
        else $value = '';

        echo getModuleField($_REQUEST['aow_module'],$_REQUEST['aow_fieldname'], $_REQUEST['aow_newfieldname'], $view, $value );
        die;
    }

    protected function action_getAction(){
        global $beanList, $beanFiles;

        $action_name = 'action'.$_REQUEST['aow_action'];
        $line = $_REQUEST['line'];

        if($_REQUEST['aow_module'] == '' || !isset($beanList[$_REQUEST['aow_module']])){
            echo '';
            die;
        }

        if(file_exists('custom/modules/AOW_Actions/actions/'.$action_name.'.php')){

            require_once('custom/modules/AOW_Actions/actions/'.$action_name.'.php');

        } else if(file_exists('modules/AOW_Actions/actions/'.$action_name.'.php')){

            require_once('modules/AOW_Actions/actions/'.$action_name.'.php');

        } else {
            echo '';
            die;
        }
        $params = array();
        if(isset($_REQUEST['id'])){
            require_once('modules/AOW_Actions/AOW_Action.php');
            $aow_action = new AOW_Action();
            $aow_action->retrieve($_REQUEST['id']);
            $params = unserialize(base64_decode($aow_action->parameters));
        }

        $action = new $action_name();

        require_once($beanFiles[$beanList[$_REQUEST['aow_module']]]);
        $bean = new $beanList[$_REQUEST['aow_module']];
        echo $action->edit_display($line,$bean,$params);
        die;
    }


    protected function action_testFlow(){

        echo 'Started<br />';
        require_once('modules/AOW_WorkFlow/AOW_WorkFlow.php');
        $workflow = new AOW_WorkFlow();

        if($workflow->run_flows())echo 'PASSED';

    }

}