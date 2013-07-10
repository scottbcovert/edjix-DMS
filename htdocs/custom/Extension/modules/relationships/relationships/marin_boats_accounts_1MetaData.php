<?php
// created: 2013-07-09 05:47:18
$dictionary["marin_boats_accounts_1"] = array (
  'true_relationship_type' => 'many-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'marin_boats_accounts_1' => 
    array (
      'lhs_module' => 'marin_Boats',
      'lhs_table' => 'marin_boats',
      'lhs_key' => 'id',
      'rhs_module' => 'Accounts',
      'rhs_table' => 'accounts',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'marin_boats_accounts_1_c',
      'join_key_lhs' => 'marin_boats_accounts_1marin_boats_ida',
      'join_key_rhs' => 'marin_boats_accounts_1accounts_idb',
    ),
  ),
  'table' => 'marin_boats_accounts_1_c',
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
      'name' => 'marin_boats_accounts_1marin_boats_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'marin_boats_accounts_1accounts_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'marin_boats_accounts_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'marin_boats_accounts_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'marin_boats_accounts_1marin_boats_ida',
        1 => 'marin_boats_accounts_1accounts_idb',
      ),
    ),
  ),
);