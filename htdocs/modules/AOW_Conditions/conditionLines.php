<?php

function display_condition_lines($focus, $field, $value, $view){

    global $locale, $app_list_strings, $mod_strings;

    $html = '';

    if($view == 'EditView'){

        $html .= '<script src="modules/AOW_Conditions/conditionLines.js"></script>';
        $html .= "<table border='0' cellspacing='4' width='100%' id='conditionLines'></table>";

        $html .= "<div style='padding-top: 10px; padding-bottom:10px;'>";
        $html .= "<input type=\"button\" tabindex=\"116\" class=\"button\" value=\"".$mod_strings['LBL_ADD_CONDITION']."\" id=\"btn_ConditionLine\" onclick=\"insertConditionLine()\" disabled/>";
        $html .= "</div>";


        if(isset($focus->flow_module) && $focus->flow_module != ''){
            require_once("modules/AOW_WorkFlow/aow_utils.php");
            $html .= "<script>";
            $html .= "flow_fields = \"".trim(preg_replace('/\s+/', ' ', getModuleFields($focus->flow_module)))."\";";
            $html .= "flow_module = \"".$focus->flow_module."\";";
            $html .= "document.getElementById('btn_ConditionLine').disabled = '';";
            if($focus->id != ''){
                $conditions = $focus->get_linked_beans('aow_conditions','AOW_Condition');
                foreach($conditions  as $condition_name){
                    $condition_item = json_encode($condition_name->toArray());
                    $html .= "loadConditionLine(".$condition_item.");";
                }
            }
            $html .= "</script>";
        }

    }
    else if($view == 'DetailView'){
        $html .= '<script src="modules/AOW_Conditions/conditionLines.js"></script>';
        $html .= "<table border='0' cellspacing='0' width='100%' id='conditionLines'></table>";


        if(isset($focus->flow_module) && $focus->flow_module != ''){
            require_once("modules/AOW_WorkFlow/aow_utils.php");
            $html .= "<script>";
            $html .= "flow_fields = \"".trim(preg_replace('/\s+/', ' ', getModuleFields($focus->flow_module)))."\";";
            $html .= "flow_module = \"".$focus->flow_module."\";";
            $conditions = $focus->get_linked_beans('aow_conditions','AOW_Condition');
            foreach($conditions  as $condition_name){
                $condition_item = json_encode($condition_name->toArray());
                $html .= "loadConditionLine(".$condition_item.");";
            }
            $html .= "</script>";
        }
    }
    return $html;
}

?>
