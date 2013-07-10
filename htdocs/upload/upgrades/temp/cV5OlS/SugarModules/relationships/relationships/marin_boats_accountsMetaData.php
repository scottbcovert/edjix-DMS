<?php
// created: 2013-07-09 03:52:36
$dictionary["marin_boats_accounts"] = array (
  'true_relationship_type' => 'one-to-one',
  'relationships' => 
  array (
    'marin_boats_accounts' => 
    array (
      'lhs_module' => 'marin_Boats',
      'lhs_table' => 'marin_boats',
      'lhs_key' => 'id',
      'rhs_module' => 'Accounts',
      'rhs_table' => 'accounts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'marin_boats_accounts_c',
      'join_key_lhs' => 'marin_boats_accountsmarin_boats_ida',
      'join_key_rhs' => 'marin_boats_accountsaccounts_idb',
    ),
  ),
  'table' => 'marin_boats_accounts_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'marin_boats_accountsmarin_boats_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'marin_boats_accountsaccounts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'marin_boats_accountsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'marin_boats_accounts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'marin_boats_accountsmarin_boats_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'marin_boats_accounts_idb2',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'marin_boats_accountsaccounts_idb',
      ),
    ),
  ),
);