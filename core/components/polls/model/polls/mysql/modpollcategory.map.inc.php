<?php
/**
 * @package polls
 */
$xpdo_meta_map['modPollCategory']= array (
  'package' => 'polls',
  'version' => NULL,
  'table' => 'polls_categories',
  'extends' => 'xPDOSimpleObject',
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
