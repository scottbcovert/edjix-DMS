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


class AOW_Condition extends Basic {
	var $new_schema = true;
	var $module_dir = 'AOW_Conditions';
	var $object_name = 'AOW_Condition';
	var $table_name = 'aow_conditions';
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
	var $freeflow_id;
	var $condition_order;
	var $field;
	var $operator;
	var $value;
	var $condition_operator;
	
	function AOW_Condition(){
		parent::Basic();
	}
	
	function bean_implements($interface){
		return false;
	}

    function save_lines($post_data, $parent, $key = ''){

        $line_count = count($post_data[$key.'field']);
        $j = 0;
        for ($i = 0; $i < $line_count; ++$i) {

            if($post_data[$key.'deleted'][$i] == 1){
                $this->mark_deleted($post_data[$key.'id'][$i]);
            } else {
                $condition = new AOW_Condition();
                foreach($this->field_defs as $field_def) {
                    if(isset($post_data[$key.$field_def['name']][$i])){
                        if(is_array($post_data[$key.$field_def['name']][$i])) $post_data[$key.$field_def['name']][$i] = encodeMultienumValue($post_data[$key.$field_def['name']][$i]);
                        $condition->$field_def['name'] = $post_data[$key.$field_def['name']][$i];
                    }

                }
                if(trim($condition->field) != ''){
                    $condition->condition_order = ++$j;
                    $condition->assigned_user_id = $parent->assigned_user_id;
                    $condition->aow_workflow_id = $parent->id;
                    $condition->save();
                }
            }
        }
    }


}
?>