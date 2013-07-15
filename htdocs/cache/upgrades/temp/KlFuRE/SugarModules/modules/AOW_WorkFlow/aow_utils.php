<?php
/**
 * aow_utils.php
 * @author SalesAgility <support@salesagility.com>
 * Date: 23/05/13
 */

function getModuleFields($module, $view='EditView',$value = '')
{
    global $beanList;

    $fields = array(''=>'');

    if ($module != '') {
        if(isset($beanList[$module]) && $beanList[$module]){
            $mod = new $beanList[$module]();
            foreach($mod->field_defs as $name => $arr){
                if($arr['type'] != 'link'){
                    if(isset($arr['vname']) && $arr['vname'] != ''){
                        $fields[$name] = translate($arr['vname'],$mod->module_dir);
                    } else {
                        $fields[$name] = $name;
                    }
                    if($arr['type'] == 'relate' && isset($arr['id_name']) && $arr['id_name'] != ''){
                        if(isset($fields[$arr['id_name']])) unset( $fields[$arr['id_name']]);
                    }
                }
            } //End loop.

        }
    }
    if($view == 'EditView'){
        return get_select_options_with_id($fields, $value);
    } else {
        return $fields[$value];
    }
}


function getModuleField($module, $fieldname, $aow_field, $view='EditView',$value = '', $alt_type = ''){
    global $current_language, $app_strings, $app_list_strings, $current_user, $beanFiles, $beanList;

    // use the mod_strings for this module
    $mod_strings = return_module_language($current_language,$module);

    // set the filename for this control
    $file = create_cache_directory('modules/AOW_WorkFlow/') . $module . $view . $alt_type . $fieldname . '.tpl';

    if ( !is_file($file)
        || inDeveloperMode()
        || !empty($_SESSION['developerMode']) ) {

        if ( !isset($vardef) ) {
            require_once($beanFiles[$beanList[$module]]);
            $focus = new $beanList[$module];
            $vardef = $focus->getFieldDefinition($fieldname);
        }

        $displayParams = array();
        //$displayParams['formName'] = 'EditView';

        // if this is the id relation field, then don't have a pop-up selector.
        if( $vardef['type'] == 'relate' && $vardef['id_name'] == $vardef['name']) {
            $vardef['type'] = 'varchar';
        }

        if(isset($vardef['precision'])) unset($vardef['precision']);

        //$vardef['precision'] = $locale->getPrecedentPreference('default_currency_significant_digits', $current_user);

        //TODO Fix datetimecomebo
        //temp work around
        if( $vardef['type'] == 'datetimecombo') {
            $vardef['type'] = 'datetime';
        }

        // trim down textbox display
        if( $vardef['type'] == 'text' ) {
            $vardef['rows'] = 2;
            $vardef['cols'] = 32;
        }

        // create the dropdowns for the parent type fields
        if ( $vardef['type'] == 'parent_type' ) {
            $vardef['type'] = 'enum';
        }

        //check for $alt_type
        if ( $alt_type != '' ) {
            $vardef['type'] = $alt_type;
        }

        // remove the special text entry field function 'getEmailAddressWidget'
        if ( isset($vardef['function'])
            && ( $vardef['function'] == 'getEmailAddressWidget'
                || $vardef['function']['name'] == 'getEmailAddressWidget' ) )
            unset($vardef['function']);

        /*if(isset($vardef['name']) && ($vardef['name'] == 'date_entered' || $vardef['name'] == 'date_modified')){
            $vardef['name'] = 'date';
        }*/

        // load SugarFieldHandler to render the field tpl file
        static $sfh;

        if(!isset($sfh)) {
            require_once('include/SugarFields/SugarFieldHandler.php');
            $sfh = new SugarFieldHandler();
        }

        $contents = $sfh->displaySmarty('fields', $vardef, $view, $displayParams);

        // Remove all the copyright comments
        $contents = preg_replace('/\{\*[^\}]*?\*\}/', '', $contents);

        if( $view == 'EditView' &&  ($vardef['type'] == 'relate' || $vardef['type'] == 'parent')){
            $contents = str_replace('"'.$vardef['id_name'].'"','{/literal}"{$fields.'.$vardef['name'].'.id_name}"{literal}', $contents);
            $contents = str_replace('"'.$vardef['name'].'"','{/literal}"{$fields.'.$vardef['name'].'.name}"{literal}', $contents);
        }

        // hack to disable one of the js calls in this control
        if ( isset($vardef['function'])
            && ( $vardef['function'] == 'getCurrencyDropDown'
                || $vardef['function']['name'] == 'getCurrencyDropDown' ) )
            $contents .= "{literal}<script>function CurrencyConvertAll() { return; }</script>{/literal}";

        // Save it to the cache file
        if($fh = @sugar_fopen($file, 'w')) {
            fputs($fh, $contents);
            fclose($fh);
        }
    }

    // Now render the template we received
    $ss = new Sugar_Smarty();

    // Create Smarty variables for the Calendar picker widget
    global $timedate;
    $time_format = $timedate->get_user_time_format();
    $date_format = $timedate->get_cal_date_format();
    $ss->assign('USER_DATEFORMAT', $timedate->get_user_date_format());
    $ss->assign('TIME_FORMAT', $time_format);
    $time_separator = ":";
    $match = array();
    if(preg_match('/\d+([^\d])\d+([^\d]*)/s', $time_format, $match)) {
        $time_separator = $match[1];
    }
    $t23 = strpos($time_format, '23') !== false ? '%H' : '%I';
    if(!isset($match[2]) || $match[2] == '') {
        $ss->assign('CALENDAR_FORMAT', $date_format . ' ' . $t23 . $time_separator . "%M");
    }
    else {
        $pm = $match[2] == "pm" ? "%P" : "%p";
        $ss->assign('CALENDAR_FORMAT', $date_format . ' ' . $t23 . $time_separator . "%M" . $pm);
    }

    $ss->assign('CALENDAR_FDOW', $current_user->get_first_day_of_week());

    // populate the fieldlist from the vardefs
    $fieldlist = array();
    if ( !isset($focus) || !($focus instanceof SugarBean) )
        require_once($beanFiles[$beanList[$module]]);
    $focus = new $beanList[$module];
    // create the dropdowns for the parent type fields
    if ( $vardef['type'] == 'parent_type' ) {
        $focus->field_defs[$vardef['name']]['options'] = $focus->field_defs[$vardef['group']]['options'];
    }
    $vardefFields = $focus->getFieldDefinitions();
    foreach ( $vardefFields as $name => $properties ) {
        $fieldlist[$name] = $properties;
        // fill in enums
        if(isset($fieldlist[$name]['options']) && is_string($fieldlist[$name]['options']) && isset($app_list_strings[$fieldlist[$name]['options']]))
            $fieldlist[$name]['options'] = $app_list_strings[$fieldlist[$name]['options']];
        // Bug 32626: fall back on checking the mod_strings if not in the app_list_strings
        elseif(isset($fieldlist[$name]['options']) && is_string($fieldlist[$name]['options']) && isset($mod_strings[$fieldlist[$name]['options']]))
            $fieldlist[$name]['options'] = $mod_strings[$fieldlist[$name]['options']];
        // Bug 22730: make sure all enums have the ability to select blank as the default value.
        if(!isset($fieldlist[$name]['options']['']))
            $fieldlist[$name]['options'][''] = '';
    }

    // fill in function return values
    if ( !in_array($fieldname,array('email1','email2')) )
    {
        if (!empty($fieldlist[$fieldname]['function']['returns']) && $fieldlist[$fieldname]['function']['returns'] == 'html')
        {

            $function = $fieldlist[$fieldname]['function']['name'];
            // include various functions required in the various vardefs
            if ( isset($fieldlist[$fieldname]['function']['include']) && is_file($fieldlist[$fieldname]['function']['include']))
                require_once($fieldlist[$fieldname]['function']['include']);
            $value = $function($focus, $fieldname, $value, $view);
            // Bug 22730 - add a hack for the currency type dropdown, since it's built by a function.
            if ( preg_match('/getCurrency.*DropDown/s',$function)  )
                $value = str_ireplace('</select>','<option value="">'.$app_strings['LBL_NONE'].'</option></select>',$value);
        }
        /*elseif($fieldname == 'assigned_user_name' && empty($value))
        {
            $value = $GLOBALS['current_user']->id;
            //$value = get_assigned_user_name($GLOBALS['current_user']->id);
        }
        elseif($fieldname == 'team_name' && empty($value))
        {
            $value = json_encode(array());
        }*/
    }




    if(isset( $fieldlist[$fieldname]['id_name'] ) && $fieldlist[$fieldname]['id_name'] != '' && $fieldlist[$fieldname]['id_name'] != $fieldlist[$fieldname]['name']){
        $rel_value = $value;

        if($fieldlist[$fieldname]['module'] == 'Users'){
            $rel_value = get_assigned_user_name($value);
        } else{
            require_once($beanFiles[$beanList[$fieldlist[$fieldname]['module']]]);
            $rel_focus = new $beanList[$fieldlist[$fieldname]['module']];
            $rel_focus->retrieve($value);
            if(isset($fieldlist[$fieldname]['rname']) && $fieldlist[$fieldname]['rname'] != ''){
                $rel_value = $rel_focus->$fieldlist[$fieldname]['rname'];
            } else {
                $rel_value = $rel_focus->name;
            }
        }

        $fieldlist[$fieldlist[$fieldname]['id_name']]['value'] = $value;
        $fieldlist[$fieldname]['value'] = $rel_value;
        $fieldlist[$fieldname]['id_name'] = $aow_field;
        $fieldlist[$fieldlist[$fieldname]['id_name']]['name'] = $aow_field;
        $fieldlist[$fieldname]['name'] = $aow_field.'_display';

    } else if(isset( $fieldlist[$fieldname]['type'] ) && ($fieldlist[$fieldname]['type'] == 'datetimecombo' || $fieldlist[$fieldname]['type'] == 'datetime' || $fieldlist[$fieldname]['type'] == 'date')){
        //$fieldlist[$fieldname]['value'] = $timedate->to_display_date($value);
        //$fieldlist[$fieldname]['value'] = $timedate->to_display_date_time($value, true, true);
        $fieldlist[$fieldname]['value'] = $value;
        $fieldlist[$fieldname]['name'] = $aow_field;
    } else {

        $fieldlist[$fieldname]['value'] = $value;
        $fieldlist[$fieldname]['name'] = $aow_field;

    }

    $ss->assign("fields",$fieldlist);
    $ss->assign("form_name",$view);
    $ss->assign("bean",$focus);

    // add in any additional strings
    $ss->assign("MOD", $mod_strings);
    $ss->assign("APP", $app_strings);
    return $ss->fetch($file);
}



function getDateField($module, $aow_field, $view='EditView', $value){
    global $app_list_strings;

    $value = json_decode(html_entity_decode_utf8($value), true);

    if(!file_exists('modules/AOBH_BusinessHours/AOBH_BusinessHours.php')) unset($app_list_strings['aow_date_type_list']['working_hours']);

    $date_operator['now'] = '';
    $date_operator['plus'] = '+';
    $date_operator['minus'] = '-';

    $field = '';

    if($view == 'EditView'){
        $field .= "<select type='text' name='$aow_field".'[0]'."' id='$aow_field".'[0]'."' title='' tabindex='116'>". getDateFields($module, $view, $value[0]) ."</select>&nbsp;&nbsp;";
        $field .= "<select type='text' name='$aow_field".'[1]'."' id='$aow_field".'[1]'."' title='' tabindex='116'>". get_select_options_with_id($date_operator, $value[1]) ."</select>&nbsp;";
        $field .= "<input  type='text' name='$aow_field".'[2]'."' id='$aow_field".'[2]'."' title='' value='$value[2]' style='width:40px;' tabindex='116'>&nbsp;";
        $field .= "<select type='text' name='$aow_field".'[3]'."' id='$aow_field".'[3]'."' title='' tabindex='116'>". get_select_options_with_id($app_list_strings['aow_date_type_list'], $value[3]) ."</select>";
    }
    else {
        $field = getDateFields($module, $view, $value[0]).' '.$date_operator[$value[1]].' '.$value[2].' '.$app_list_strings['aow_date_type_list'][$value[3]];
    }
    return $field;

}

function getDateFields($module, $view='EditView',$value = '')
{
    global $beanList, $app_list_strings;

    $fields = $app_list_strings['aow_date_options'];

    if ($module != '') {
        if(isset($beanList[$module]) && $beanList[$module]){
            $mod = new $beanList[$module]();
            foreach($mod->field_defs as $name => $arr){
                if($arr['type'] == 'date' || $arr['type'] == 'datetime' || $arr['type'] == 'datetimecombo'){
                    if(isset($arr['vname']) && $arr['vname'] != ''){
                        $fields[$name] = translate($arr['vname'],$mod->module_dir);
                    } else {
                        $fields[$name] = $name;
                    }
                }
            } //End loop.

        }
    }
    if($view == 'EditView'){
        return get_select_options_with_id($fields, $value);
    } else {
        return $fields[$value];
    }
}


function fixUpFormatting()
{
    global $timedate;
    static $boolean_false_values = array('off', 'false', '0', 'no');


    foreach($this->field_defs as $field=>$def)
    {
        if ( !isset($this->$field) ) {
            continue;
        }
        if ( (isset($def['source'])&&$def['source']=='non-db') || $field == 'deleted' ) {
            continue;
        }
        if ( isset($this->fetched_row[$field]) && $this->$field == $this->fetched_row[$field] ) {
            // Don't hand out warnings because the field was untouched between retrieval and saving, most database drivers hand pretty much everything back as strings.
            continue;
        }
        $reformatted = false;
        switch($def['type']) {
            case 'datetime':
            case 'datetimecombo':
                if(empty($this->$field)) break;
                if ($this->$field == 'NULL') {
                    $this->$field = '';
                    break;
                }
                if ( ! preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',$this->$field) ) {
                    // This appears to be formatted in user date/time
                    $this->$field = $timedate->to_db($this->$field);
                    $reformatted = true;
                }
                break;
            case 'date':
                if(empty($this->$field)) break;
                if ($this->$field == 'NULL') {
                    $this->$field = '';
                    break;
                }
                if ( ! preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$this->$field) ) {
                    // This date appears to be formatted in the user's format
                    $this->$field = $timedate->to_db_date($this->$field, false);
                    $reformatted = true;
                }
                break;
            case 'time':
                if(empty($this->$field)) break;
                if ($this->$field == 'NULL') {
                    $this->$field = '';
                    break;
                }
                if ( preg_match('/(am|pm)/i',$this->$field) ) {
                    // This time appears to be formatted in the user's format
                    $this->$field = $timedate->fromUserTime($this->$field)->format(TimeDate::DB_TIME_FORMAT);
                    $reformatted = true;
                }
                break;
            case 'double':
            case 'decimal':
            case 'currency':
            case 'float':
                if ( $this->$field === '' || $this->$field == NULL || $this->$field == 'NULL') {
                    continue;
                }
                if ( is_string($this->$field) ) {
                    $this->$field = (float)unformat_number($this->$field);
                    $reformatted = true;
                }
                break;
            case 'uint':
            case 'ulong':
            case 'long':
            case 'short':
            case 'tinyint':
            case 'int':
                if ( $this->$field === '' || $this->$field == NULL || $this->$field == 'NULL') {
                    continue;
                }
                if ( is_string($this->$field) ) {
                    $this->$field = (int)unformat_number($this->$field);
                    $reformatted = true;
                }
                break;
            case 'bool':
                if (empty($this->$field)) {
                    $this->$field = false;
                } else if(true === $this->$field || 1 == $this->$field) {
                    $this->$field = true;
                } else if(in_array(strval($this->$field), $boolean_false_values)) {
                    $this->$field = false;
                    $reformatted = true;
                } else {
                    $this->$field = true;
                    $reformatted = true;
                }
                break;
            case 'encrypt':
                $this->$field = $this->encrpyt_before_save($this->$field);
                break;
        }
        if ( $reformatted ) {
            $GLOBALS['log']->deprecated('Formatting correction: '.$this->module_dir.'->'.$field.' had formatting automatically corrected. This will be removed in the future, please upgrade your external code');
        }
    }

}