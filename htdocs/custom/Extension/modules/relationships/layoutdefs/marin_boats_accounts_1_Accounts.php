<?php
 // created: 2013-07-09 05:47:18
$layout_defs["Accounts"]["subpanel_setup"]['marin_boats_accounts_1'] = array (
  'order' => 100,
  'module' => 'marin_Boats',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_MARIN_BOATS_ACCOUNTS_1_FROM_MARIN_BOATS_TITLE',
  'get_subpanel_data' => 'marin_boats_accounts_1',
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
