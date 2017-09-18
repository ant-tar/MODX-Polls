<?php
$xpdo_meta_map['modPollQuestion']= array (
  'package' => 'polls',
  'version' => NULL,
  'table' => 'polls_questions',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'category' => NULL,
    'question' => NULL,
    'publishdate' => 'null',
    'unpublishdate' => 'null',
    'hide' => 0,
  ),
  'fieldMeta' => 
  array (
    'category' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'question' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'index' => 'index',
    ),
    'publishdate' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
      'default' => 'null',
      'index' => 'index',
    ),
    'unpublishdate' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
      'default' => 'null',
      'index' => 'index',
    ),
    'hide' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
  ),
  'composites' => 
  array (
    'Answers' => 
    array (
      'class' => 'modPollAnswer',
      'local' => 'id',
      'foreign' => 'question',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Logs' => 
    array (
      'class' => 'modPollLog',
      'local' => 'id',
      'foreign' => 'question',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'Category' => 
    array (
      'class' => 'modPollCategory',
      'local' => 'category',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
