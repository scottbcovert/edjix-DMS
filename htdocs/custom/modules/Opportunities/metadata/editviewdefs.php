<?php
$viewdefs ['Opportunities'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'javascript' => '{$PROBABILITY_SCRIPT}',
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'useTabs' => false,
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 
          array (
            'name' => 'amount',
          ),
        ),
        1 => 
        array (
          0 => 'account_name',
          1 => 
          array (
            'name' => 'date_closed',
          ),
        ),
        2 => 
        array (
          0 => 'sales_stage',
        ),
        3 => 
        array (
          0 => 'lead_source',
          1 => 'probability',
        ),
        4 => 
        array (
          0 => 'next_step',
          1 => 'assigned_user_name',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'dmx_boats_opportunities_name',
            'label' => 'LBL_DMX_BOATS_OPPORTUNITIES_FROM_DMX_BOATS_TITLE',
          ),
        ),
      ),
    ),
  ),
);
?>