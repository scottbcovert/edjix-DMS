<?php
 // created: 2013-07-11 06:31:43
$layout_defs["Opportunities"]["subpanel_setup"]['dmx_boats_opportunities'] = array (
  'order' => 100,
  'module' => 'dmx_Boats',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_DMX_BOATS_OPPORTUNITIES_FROM_DMX_BOATS_TITLE',
  'get_subpanel_data' => 'dmx_boats_opportunities',
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
