<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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
 * You can aow_condition SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address aow_condition@sugarcrm.com.
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

$dictionary['aow_workflow_aow_conditions'] = array ( 'table' => 'aow_workflow_aow_conditions'
, 'fields' => array (
        array('name' =>'id', 'type' =>'varchar', 'len'=>'36')
    , array('name' =>'aow_condition_id', 'type' =>'varchar', 'len'=>'36')
    , array('name' =>'aow_workflow_id', 'type' =>'varchar', 'len'=>'36')
    , array ('name' => 'date_modified','type' => 'datetime')
    , array('name' =>'deleted', 'type' =>'bool', 'len'=>'1', 'required'=>false, 'default'=>'0')
    )                                  , 'indices' => array (
        array('name' =>'aow_workflow_aow_conditionspk', 'type' =>'primary', 'fields'=>array('id'))
    , array('name' => 'idx_aow_workflow_aow_condition', 'type'=>'alternate_key', 'fields'=>array('aow_workflow_id','aow_condition_id'))
    , array('name' => 'idx_condid_del_freid', 'type' => 'index', 'fields'=> array('aow_condition_id', 'deleted', 'aow_workflow_id'))

    )

, 'relationships' => array ('aow_workflow_aow_conditions' => array('lhs_module'=> 'AOW_WorkFlow', 'lhs_table'=> 'aow_workflow', 'lhs_key' => 'id',
        'rhs_module'=> 'AOW_Conditions', 'rhs_table'=> 'aow_conditions', 'rhs_key' => 'aow_workflow_id',
        'relationship_type'=>'one-to-many',
        'join_table'=> 'aow_workflow_aow_conditions', 'join_key_lhs'=>'aow_workflow_id', 'join_key_rhs'=>'aow_condition_id'))


)
?>
