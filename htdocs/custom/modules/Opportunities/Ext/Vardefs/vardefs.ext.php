<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2013-07-11 07:23:28
$dictionary["Opportunity"]["fields"]["dmx_boats_opportunities"] = array (
  'name' => 'dmx_boats_opportunities',
  'type' => 'link',
  'relationship' => 'dmx_boats_opportunities',
  'source' => 'non-db',
  'module' => 'dmx_Boats',
  'bean_name' => 'dmx_Boats',
  'vname' => 'LBL_DMX_BOATS_OPPORTUNITIES_FROM_DMX_BOATS_TITLE',
  'id_name' => 'dmx_boats_opportunitiesdmx_boats_ida',
);
$dictionary["Opportunity"]["fields"]["dmx_boats_opportunities_name"] = array (
  'name' => 'dmx_boats_opportunities_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DMX_BOATS_OPPORTUNITIES_FROM_DMX_BOATS_TITLE',
  'save' => true,
  'id_name' => 'dmx_boats_opportunitiesdmx_boats_ida',
  'link' => 'dmx_boats_opportunities',
  'table' => 'dmx_boats',
  'module' => 'dmx_Boats',
  'rname' => 'name',
);
$dictionary["Opportunity"]["fields"]["dmx_boats_opportunitiesdmx_boats_ida"] = array (
  'name' => 'dmx_boats_opportunitiesdmx_boats_ida',
  'type' => 'link',
  'relationship' => 'dmx_boats_opportunities',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DMX_BOATS_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
);

?>