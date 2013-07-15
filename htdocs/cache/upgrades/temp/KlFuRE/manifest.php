<?php
/**
 * Advanced OpenWorkFlow, Automating SugarCRM.
 * @package Advanced OpenWorkFlow for SugarCRM
 * @copyright SalesAgility Ltd http://www.salesagility.com
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author SalesAgility <support@salesagility.com>
 */


$manifest = array (
  0 => 
  array (
    'acceptable_sugar_versions' => 
    array (
      0 => "6.*",
    ),
  ),
  1 => 
  array (
    'acceptable_sugar_flavors' => 
    array (
      0 => 'CE',
      1 => 'PRO',
      2 => 'ENT',
    ),
  ),
  'readme' => '',
  'author' => 'SalesAgility',
  'description' => 'Automating SugarCRM',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'Advanced OpenWorkFlow',
  'published_date' => '2013-07-02',
  'type' => 'module',
  'version' => '0.4',
  'remove_tables' => 'prompt',
);


$installdefs = array (
  'id' => 'AOW_Alpha',
  'beans' => 
  array (
    0 => 
    array (
      'module' => 'AOW_Actions',
      'class' => 'AOW_Action',
      'path' => 'modules/AOW_Actions/AOW_Action.php',
      'tab' => false,
    ),
    1 => 
    array (
      'module' => 'AOW_WorkFlow',
      'class' => 'AOW_WorkFlow',
      'path' => 'modules/AOW_WorkFlow/AOW_WorkFlow.php',
      'tab' => true,
    ),
    2 => 
    array (
      'module' => 'AOW_Processed',
      'class' => 'AOW_Processed',
      'path' => 'modules/AOW_Processed/AOW_Processed.php',
      'tab' => false,
    ),
    3 => 
    array (
      'module' => 'AOW_Conditions',
      'class' => 'AOW_Condition',
      'path' => 'modules/AOW_Conditions/AOW_Condition.php',
      'tab' => false,
    ),
  ),
  'relationships' => 
  array (
    0 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/metadata/aow_workflow_aow_actionsMetaData.php',
    ),
    1 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/metadata/aow_workflow_aow_conditionsMetaData.php',
    ),
    2 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/metadata/aow_processed_aow_actionsMetaData.php',
    ),
  ),
  'image_dir' => '<basepath>/icons',
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/modules/AOW_Actions',
      'to' => 'modules/AOW_Actions',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/modules/AOW_WorkFlow',
      'to' => 'modules/AOW_WorkFlow',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/modules/AOW_Conditions',
      'to' => 'modules/AOW_Conditions',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/modules/AOW_Processed',
      'to' => 'modules/AOW_Processed',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/schedulers',
      'to' => 'custom/Extension/modules/Schedulers/Ext/ScheduledTasks',
    ),
  ),
  'language' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),
   1 => array (
      'from' => '<basepath>/SugarModules/schedulers/language/en_us.lang.php',
      'to_module' => 'Schedulers',
      'language' => 'en_us',
    ),
  ),
);
