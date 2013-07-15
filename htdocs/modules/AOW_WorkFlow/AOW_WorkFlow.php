<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2012 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


class AOW_WorkFlow extends Basic {
	var $new_schema = true;
	var $module_dir = 'AOW_WorkFlow';
	var $object_name = 'AOW_WorkFlow';
	var $table_name = 'aow_workflow';
	var $importable = false;
	var $disable_row_level_security = true ;
	
	var $id;
	var $name;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $modified_by_name;
	var $created_by;
	var $created_by_name;
	var $description;
	var $deleted;
	var $created_by_link;
	var $modified_user_link;
	var $assigned_user_id;
	var $assigned_user_name;
	var $assigned_user_link;
	var $flow_module;
	var $status;
	var $run_when;
	
	function AOW_WorkFlow(){
		parent::Basic();
        $this->load_flow_beans();
	}
	
	function bean_implements($interface){
		switch($interface){
			case 'ACL': return true;
		}
		return false;
	}

    function save($check_notify = FALSE){
        if (empty($this->id)){
            unset($_POST['aow_conditions_id']);
            unset($_POST['aow_actions_id']);
        }

        parent::save($check_notify);

        require_once('modules/AOW_Conditions/AOW_Condition.php');
        $condition = new AOW_Condition();
        $condition->save_lines($_POST, $this, 'aow_conditions_');

        require_once('modules/AOW_Actions/AOW_Action.php');
        $action = new AOW_Action();
        $action->save_lines($_POST, $this, 'aow_actions_');
    }

    function load_flow_beans(){
        global $beanList, $app_list_strings;

        $app_list_strings['aow_moduleList'] = $app_list_strings['moduleList'];

        foreach($app_list_strings['aow_moduleList'] as $mkey => $mvalue){
            if(!isset($beanList[$mkey]) || str_begin($mkey, 'AOW_')){
                unset($app_list_strings['aow_moduleList'][$mkey]);
            }
        }

        $app_list_strings['aow_moduleList'] = array_merge((array)array(''=>''), (array)$app_list_strings['aow_moduleList']);

        asort($app_list_strings['aow_moduleList']);
    }

    /**
     * Select and run all active flows
     */
	function run_flows(){
		$flows = AOW_WorkFlow::get_full_list(''," aow_workflow.status = 'Active' ");

        foreach($flows as $flow){
            $flow->run_flow();
        }
        return true;
	}

    /**
     * Retrieve the beans to actioned and run the actions
     */
    function run_flow(){
        $beans = $this->get_flow_beans();

        if(!empty($beans)){
            foreach($beans as $bean){
                $this->run_actions($bean);
            }
        }
    }

    /**
     * Use the condition statements and processed table to build query to retrieve beans to be actioned
     */
    function get_flow_beans(){
        global $beanList, $app_list_strings;

        if($beanList[$this->flow_module]){
            $module = new $beanList[$this->flow_module]();
            $where = '';

            $conditions = $this->get_linked_beans('aow_conditions','AOW_Condition');
            foreach($conditions as $condition){
                if(isset($app_list_strings['aow_sql_operator_list'][$condition->operator])){
                    $where_set = false;

                    if($where != ''){
                        $where .= ' AND ';
                    }
                    $data = $module->field_defs[$condition->field];

                    if($data['type'] == 'relate' && isset($data['id_name'])) {
                        $condition->field = $data['id_name'];
                    }
                    if(  (isset($data['source']) && $data['source'] == 'custom_fields')) {
                        $field = $module->table_name.'_cstm.'.$condition->field;
                    } else {
                        $field = $module->table_name.'.'.$condition->field;
                    }

                    switch($condition->value_type) {
                        case 'Field':
                            $data = $module->field_defs[$condition->value];

                            if($data['type'] == 'relate' && isset($data['id_name'])) {
                                $condition->value = $data['id_name'];
                            }
                            if(  (isset($data['source']) && $data['source'] == 'custom_fields')) {
                                $value = $module->table_name.'_cstm.'.$condition->value;
                            } else {
                                $value = $module->table_name.'.'.$condition->value;
                            }
                            break;
                        case 'Date':
                            $value = 'NOW()';
                            break;
                        case 'Multi':
                            $sep = ' AND ';
                            if($condition->operator == 'Equal_To') $sep = ' OR ';
                            $multi_values = unencodeMultienum($condition->value);
                            if(!empty($multi_values)){
                                $value = '(';
                                foreach($multi_values as $multi_value){
                                    if($value != '(') $value .= $sep;
                                    $value .= $field.' '.$app_list_strings['aow_sql_operator_list'][$condition->operator].' "'.$multi_value.'"';
                                }
                                $value .= ')';
                            }
                            $where .= $value;
                            $where_set = true;
                            break;
                        case 'Direct':
                        default:
                            $value = '"'.$condition->value.'"';
                            break;
                    }


                    if(!$where_set) $where .= $field.' '.$app_list_strings['aow_sql_operator_list'][$condition->operator].' '.$value;
                }
            }
           if(!$this->multiple_runs){
                if($where != ''){
                    $where .= ' AND ';
                }
                $where .= "NOT EXISTS (SELECT * FROM aow_processed WHERE aow_processed.aow_workflow_id='".$this->id."' AND aow_processed.bean_id=".$module->table_name.".id AND aow_processed.status = 'Complete')";
            }
            $query = $module->create_new_list_query('', $where, array(), array(), 0, '', false, $this);

            //echo '<br />'.$query;

            return $module->process_full_list_query($query);

        }
        return null;
    }

    /**
     * Run the actions against the passed $bean
     */
    function run_actions(SugarBean $bean){

        require_once('modules/AOW_Processed/AOW_Processed.php');
        $processed = new AOW_Processed();
        if(!$this->multiple_runs){
            $processed->retrieve_by_string_fields(array('aow_workflow_id' => $this->id,'bean_id' => $bean->id));

            if($processed->status == 'Complete'){
                //should not have gotten this far, so return
                return true;
            }
        }
        $processed->aow_workflow_id = $this->id;
        $processed->bean_id = $bean->id;
        $processed->status = 'Running';
        $processed->save(false);
        $processed->load_relationship('aow_actions');

        $actions = $this->get_linked_beans('aow_actions','AOW_Action');
        $pass = true;
        foreach($actions  as $action){

            if($this->multiple_runs || !$processed->db->getOne('select id from aow_processed_aow_actions where aow_processed_id = "'.$processed->id.'" AND aow_action_id = "'.$action->id.'" AND status = "Complete"')){
                $action_name = 'action'.$action->action;

                if(file_exists('custom/modules/AOW_Actions/actions/'.$action_name.'.php')){
                    require_once('custom/modules/AOW_Actions/actions/'.$action_name.'.php');
                } else if(file_exists('modules/AOW_Actions/actions/'.$action_name.'.php')){
                    require_once('modules/AOW_Actions/actions/'.$action_name.'.php');
                } else {
                    return false;
                }

                $flow_action = new $action_name();
                if(!$flow_action->run_action($bean, unserialize(base64_decode($action->parameters)))){
                    $pass = false;
                    $processed->aow_actions->add($action->id, array('status' => 'Failed'));
                } else {
                    $processed->aow_actions->add($action->id, array('status' => 'Complete'));
                }
            }

        }

        if($pass) $processed->status = 'Complete';
        else $processed->status = 'Failed';
        $processed->save(false);

        return $pass;
    }

		
}
?>
