<?php
 // created: 2013-07-11 07:23:28
$layout_defs["dmx_Boats"]["subpanel_setup"]['dmx_boats_accounts'] = array (
  'order' => 100,
  'module' => 'Accounts',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_DMX_BOATS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'get_subpanel_data' => 'dmx_boats_accounts',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
