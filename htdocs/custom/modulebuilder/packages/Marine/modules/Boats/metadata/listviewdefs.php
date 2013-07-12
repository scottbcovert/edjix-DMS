<?php
$module_name = 'dmx_Boats';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'YEAR' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_YEAR',
    'width' => '10%',
    'default' => true,
  ),
  'MAKE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MAKE',
    'width' => '10%',
    'default' => true,
  ),
  'MODEL' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MODEL',
    'width' => '10%',
    'default' => true,
  ),
  'HIN' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_HIN',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
);
?>
