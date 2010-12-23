<?php
$xpdo_meta_map['modPollAnswer']= array (
  'package' => 'polls',
  'table' => 'polls_answers',
  'fields' => 
  array (
    'question' => NULL,
    'answer' => NULL,
    'votes' => NULL,
    'sort_order' => NULL,
  ),
  'fieldMeta' => 
  array (
    'question' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'answer' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'index' => 'index',
    ),
    'votes' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
    ),
    'sort_order' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
    'Question' => 
    array (
      'class' => 'modPollQuestion',
      'local' => 'question',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
  'composites' => 
  array (
    'Logs' => 
    array (
      'class' => 'modPollLog',
      'local' => 'id',
      'foreign' => 'answer',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
