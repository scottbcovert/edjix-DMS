<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2013-07-11 07:23:28
$dictionary["Account"]["fields"]["dmx_boats_accounts"] = array (
  'name' => 'dmx_boats_accounts',
  'type' => 'link',
  'relationship' => 'dmx_boats_accounts',
  'source' => 'non-db',
  'module' => 'dmx_Boats',
  'bean_name' => 'dmx_Boats',
  'vname' => 'LBL_DMX_BOATS_ACCOUNTS_FROM_DMX_BOATS_TITLE',
  'id_name' => 'dmx_boats_accountsdmx_boats_ida',
);
$dictionary["Account"]["fields"]["dmx_boats_accounts_name"] = array (
  'name' => 'dmx_boats_accounts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DMX_BOATS_ACCOUNTS_FROM_DMX_BOATS_TITLE',
  'save' => true,
  'id_name' => 'dmx_boats_accountsdmx_boats_ida',
  'link' => 'dmx_boats_accounts',
  'table' => 'dmx_boats',
  'module' => 'dmx_Boats',
  'rname' => 'name',
);
$dictionary["Account"]["fields"]["dmx_boats_accountsdmx_boats_ida"] = array (
  'name' => 'dmx_boats_accountsdmx_boats_ida',
  'type' => 'link',
  'relationship' => 'dmx_boats_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_DMX_BOATS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
);

?>