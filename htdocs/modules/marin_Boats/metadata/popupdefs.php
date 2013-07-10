<?php
$popupMeta = array (
    'moduleMain' => 'marin_Boats',
    'varName' => 'marin_Boats',
    'orderBy' => 'marin_boats.name',
    'whereClauses' => array (
  'name' => 'marin_boats.name',
),
    'searchInputs' => array (
  0 => 'marin_boats_number',
  1 => 'name',
  2 => 'priority',
  3 => 'status',
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'type' => 'name',
    'link' => true,
    'label' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
  ),
  'YEAR' => 
  array (
    'type' => 'multienum',
    'studio' => 'visible',
    'label' => 'LBL_YEAR',
    'width' => '10%',
    'default' => true,
  ),
  'MAKE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MAKE',
    'width' => '10%',
    'default' => true,
  ),
  'MODEL' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MODEL',
    'width' => '10%',
    'default' => true,
  ),
),
);
