<?php
$module_name='marin_Boats';
$subpanel_layout = array (
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'popup_module' => 'marin_Boats',
    ),
  ),
  'where' => '',
  'list_fields' => 
  array (
    'name' => 
    array (
      'vname' => 'LBL_NAME',
      'widget_class' => 'SubPanelDetailViewLink',
      'width' => '45%',
      'default' => true,
    ),
    'year' => 
    array (
      'type' => 'multienum',
      'studio' => 'visible',
      'vname' => 'LBL_YEAR',
      'width' => '10%',
      'default' => true,
    ),
    'make' => 
    array (
      'type' => 'varchar',
      'vname' => 'LBL_MAKE',
      'width' => '10%',
      'default' => true,
    ),
    'model' => 
    array (
      'type' => 'varchar',
      'vname' => 'LBL_MODEL',
      'width' => '10%',
      'default' => true,
    ),
    'hin' => 
    array (
      'type' => 'varchar',
      'vname' => 'LBL_HIN',
      'width' => '10%',
      'default' => true,
    ),
    'date_modified' => 
    array (
      'vname' => 'LBL_DATE_MODIFIED',
      'width' => '45%',
      'default' => true,
    ),
    'edit_button' => 
    array (
      'vname' => 'LBL_EDIT_BUTTON',
      'widget_class' => 'SubPanelEditButton',
      'module' => 'marin_Boats',
      'width' => '4%',
      'default' => true,
    ),
    'remove_button' => 
    array (
      'vname' => 'LBL_REMOVE',
      'widget_class' => 'SubPanelRemoveButton',
      'module' => 'marin_Boats',
      'width' => '5%',
      'default' => true,
    ),
  ),
);