<?php
// created: 2013-07-09 03:52:36
$dictionary["marin_Boats"]["fields"]["marin_boats_accounts"] = array (
  'name' => 'marin_boats_accounts',
  'type' => 'link',
  'relationship' => 'marin_boats_accounts',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_MARIN_BOATS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'id_name' => 'marin_boats_accountsaccounts_idb',
);
$dictionary["marin_Boats"]["fields"]["marin_boats_accounts_name"] = array (
  'name' => 'marin_boats_accounts_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_MARIN_BOATS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'marin_boats_accountsaccounts_idb',
  'link' => 'marin_boats_accounts',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["marin_Boats"]["fields"]["marin_boats_accountsaccounts_idb"] = array (
  'name' => 'marin_boats_accountsaccounts_idb',
  'type' => 'link',
  'relationship' => 'marin_boats_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_MARIN_BOATS_ACCOUNTS_FROM_ACCOUNTS_TITLE',
);
