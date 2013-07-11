<?php
// created: 2013-07-11 06:35:49
$dictionary["dmx_Boats"]["fields"]["opportunities_dmx_boats_1"] = array (
  'name' => 'opportunities_dmx_boats_1',
  'type' => 'link',
  'relationship' => 'opportunities_dmx_boats_1',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_OPPORTUNITIES_DMX_BOATS_1_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'opportunities_dmx_boats_1opportunities_ida',
);
$dictionary["dmx_Boats"]["fields"]["opportunities_dmx_boats_1_name"] = array (
  'name' => 'opportunities_dmx_boats_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OPPORTUNITIES_DMX_BOATS_1_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'opportunities_dmx_boats_1opportunities_ida',
  'link' => 'opportunities_dmx_boats_1',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["dmx_Boats"]["fields"]["opportunities_dmx_boats_1opportunities_ida"] = array (
  'name' => 'opportunities_dmx_boats_1opportunities_ida',
  'type' => 'link',
  'relationship' => 'opportunities_dmx_boats_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OPPORTUNITIES_DMX_BOATS_1_FROM_DMX_BOATS_TITLE',
);
