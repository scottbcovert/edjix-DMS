<?php
// created: 2013-07-09 03:52:36
$dictionary["Account"]["fields"]["marin_boats_accounts"] = array (
  'name' => 'marin_boats_accounts',
  'type' => 'link',
  'relationship' => 'marin_boats_accounts',
  'source' => 'non-db',
  'module' => 'marin_Boats',
  'bean_name' => false,
  'vname' => 'LBL_MARIN_BOATS_ACCOUNTS_FROM_MARIN_BOATS_TITLE',
  'id_name' => 'marin_boats_accountsmarin_boats_ida',
);
$dictionary["Account"]["fields"]["marin_boats_accounts_name"] = array (
  'name' => 'marin_boats_accounts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MARIN_BOATS_ACCOUNTS_FROM_MARIN_BOATS_TITLE',
  'save' => true,
  'id_name' => 'marin_boats_accountsmarin_boats_ida',
  'link' => 'marin_boats_accounts',
  'table' => 'marin_boats',
  'module' => 'marin_Boats',
  'rname' => 'name',
);
$dictionary["Account"]["fields"]["marin_boats_accountsmarin_boats_ida"] = array (
  'name' => 'marin_boats_accountsmarin_boats_ida',
  'type' => 'link',
  'relationship' => 'marin_boats_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_MARIN_BOATS_ACCOUNTS_FROM_MARIN_BOATS_TITLE',
);
