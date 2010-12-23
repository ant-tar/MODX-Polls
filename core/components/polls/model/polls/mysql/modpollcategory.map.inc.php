<?php
$xpdo_meta_map['modPollCategory']= array (
  'package' => 'polls',
  'table' => 'polls_categories',
  'fields' => 
  array (
    'name' => NULL,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'index' => 'index',
    ),
  ),
  'composites' => 
  array (
    'Questions' => 
    array (
      'class' => 'modPollQuestion',
      'local' => 'id',
      'foreign' => 'category',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
