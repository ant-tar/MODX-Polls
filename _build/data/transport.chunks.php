<?php
/**
 * @package polls
 * @subpackage build
 */
$chunks = array();

$chunks[0]= $modx->newObject('modChunk');
$chunks[0]->fromArray(array(
    'id' => 0,
    'name' => 'pollsLatestVoteOuter',
    'description' => 'The outer template for the latest poll view',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/pollslatestvoteouter.chunk.tpl'),
    'properties' => '',
),'',true,true);

$chunks[1]= $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
    'id' => 1,
    'name' => 'pollsLatestVoteAnswer',
    'description' => 'The template for the latest poll view of a single answer row',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/pollslatestvoteanswer.chunk.tpl'),
    'properties' => '',
),'',true,true);

$chunks[2]= $modx->newObject('modChunk');
$chunks[2]->fromArray(array(
    'id' => 2,
    'name' => 'pollsLatestResultOuter',
    'description' => 'The outer template for the latest poll view, when voted!',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/pollslatestresultouter.chunk.tpl'),
    'properties' => '',
),'',true,true);

$chunks[3]= $modx->newObject('modChunk');
$chunks[3]->fromArray(array(
    'id' => 3,
    'name' => 'pollsLatestResultAnswer',
    'description' => 'The template for the latest poll view of a single answer row, when voted!',
    'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/pollslatestresultanswer.chunk.tpl'),
    'properties' => '',
),'',true,true);

return $chunks;