<?php
// created: 2013-07-11 05:55:51
$dictionary["Account"]["fields"]["opportunities_accounts_1"] = array (
  'name' => 'opportunities_accounts_1',
  'type' => 'link',
  'relationship' => 'opportunities_accounts_1',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_OPPORTUNITIES_ACCOUNTS_1_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'opportunities_accounts_1opportunities_ida',
);
$dictionary["Account"]["fields"]["opportunities_accounts_1_name"] = array (
  'name' => 'opportunities_accounts_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OPPORTUNITIES_ACCOUNTS_1_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'opportunities_accounts_1opportunities_ida',
  'link' => 'opportunities_accounts_1',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["Account"]["fields"]["opportunities_accounts_1opportunities_ida"] = array (
  'name' => 'opportunities_accounts_1opportunities_ida',
  'type' => 'link',
  'relationship' => 'opportunities_accounts_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OPPORTUNITIES_ACCOUNTS_1_FROM_ACCOUNTS_TITLE',
);
