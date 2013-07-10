<?php
$module_name = 'marin_Boats';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'make' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_MAKE',
        'width' => '10%',
        'default' => true,
        'name' => 'make',
      ),
      'hin' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_HIN',
        'width' => '10%',
        'default' => true,
        'name' => 'hin',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'year' => 
      array (
        'type' => 'multienum',
        'studio' => 'visible',
        'label' => 'LBL_YEAR',
        'width' => '10%',
        'default' => true,
        'name' => 'year',
      ),
      'make' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_MAKE',
        'width' => '10%',
        'default' => true,
        'name' => 'make',
      ),
      'model' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_MODEL',
        'width' => '10%',
        'default' => true,
        'name' => 'model',
      ),
      'hin' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_HIN',
        'width' => '10%',
        'default' => true,
        'name' => 'hin',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
