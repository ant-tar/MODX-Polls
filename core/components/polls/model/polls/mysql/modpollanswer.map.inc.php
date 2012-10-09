<?php
/**
 * @package polls
 */
$xpdo_meta_map['modPollAnswer']= array (
  'package' => 'polls',
  'version' => NULL,
  'table' => 'polls_answers',
  'extends' => 'xPDOSimpleObject',
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
);
