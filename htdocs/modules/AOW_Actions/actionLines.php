<?php
/**
 * actionLines.php
 * @author SalesAgility <support@salesagility.com>
 * Date: 18/03/13
 */

function display_action_lines($focus, $field, $value, $view){

    global $locale, $app_list_strings, $mod_strings;

    $html = '';

    if($view == 'EditView'){
        $html .= '<script src="modules/AOW_Actions/actionLines.js"></script>';

        $aow_actions_list = array();

        include_once('modules/AOW_Actions/actions.php');

        $app_list_actions[''] = '';
        foreach($aow_actions_list as $action_value){

            $action_name = 'action'.$action_value;

            if(file_exists('custom/modules/AOW_Actions/actions/'.$action_name.'.php')){

                require_once('custom/modules/AOW_Actions/actions/'.$action_name.'.php');

            } else if(file_exists('modules/AOW_Actions/actions/'.$action_name.'.php')){

                require_once('modules/AOW_Actions/actions/'.$action_name.'.php');

            } else {
                continue;
            }

            $action = new $action_name();
            foreach($action->loadJS() as $js_file){
                $html .= '<script src="'.$js_file.'"></script>';
            }

            $app_list_actions[$action_value] = translate('LBL_'.strtoupper($action_value),'AOW_Actions');
        }

        $html .= '<input type="hidden" name="app_list_actions" id="app_list_actions" value="'.get_select_options_with_id($app_list_actions, '').'">';

        $html .= "<table style='padding-top: 10px; padding-bottom:10px;' id='actionLines'></table>";

        $html .= "<div style='padding-top: 10px; padding-bottom:10px;'>";
        $html .= "<input type=\"button\" tabindex=\"116\" class=\"button\" value=\"".$mod_strings['LBL_ADD_ACTION']."\" id=\"addGroup\" onclick=\"insertActionLine()\" />";
        $html .= "</div>";

        if($focus->id != ''){
            $actions = $focus->get_linked_beans('aow_actions','AOW_Action');
            foreach($actions  as $action_name){
                $action_item = json_encode($action_name->toArray());

                $html .= "<script>
                        loadActionLine(".$action_item.");
                    </script>";
            }
        }



    }
    else if($view == 'DetailView'){

        $html .= "<table border='0' width='100%' cellpadding='0' cellspacing='0'>";
        $actions = $focus->get_linked_beans('aow_actions','AOW_Action');
        foreach($actions  as $action_name){

            $html .= "<tr><td>". $action_name->action_order ."</td><td>".$action_name->name."</td><td>". translate('LBL_'.strtoupper($action_name->action),'AOW_Actions')."</td></tr>";
        }
        $html .= "</table>";
    }
    return $html;
}