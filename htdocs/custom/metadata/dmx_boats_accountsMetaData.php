<?php
// created: 2013-07-11 07:23:28
$dictionary["dmx_boats_accounts"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'dmx_boats_accounts' => 
    array (
      'lhs_module' => 'dmx_Boats',
      'lhs_table' => 'dmx_boats',
      'lhs_key' => 'id',
      'rhs_module' => 'Accounts',
      'rhs_table' => 'accounts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'dmx_boats_accounts_c',
      'join_key_lhs' => 'dmx_boats_accountsdmx_boats_ida',
      'join_key_rhs' => 'dmx_boats_accountsaccounts_idb',
    ),
  ),
  'table' => 'dmx_boats_accounts_c',
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
      'name' => 'dmx_boats_accountsdmx_boats_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'dmx_boats_accountsaccounts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'dmx_boats_accountsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'dmx_boats_accounts_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'dmx_boats_accountsdmx_boats_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'dmx_boats_accounts_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'dmx_boats_accountsaccounts_idb',
      ),
    ),
  ),
);