<?php
/**
 * @package polls
 * @subpackage build
 */
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    $o = str_replace('<?php','',$o);
    $o = str_replace('?>','',$o);
    $o = trim($o);
    return $o;
}
$snippets = array();

$snippets[0] = $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'Polls',
    'description' => 'Shows a single Poll from the system, based on the given ID of the Poll question',
    'snippet' => getSnippetContent($sources['snippets'].'snippet.polls.php'),
),'',true,true);
/*
$properties = file_get_contents($sources['snippets'].'snippet.polls.properties.json');
$snippets[0]->setProperties($modx->fromJSON($properties));
*/
unset($properties);

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 0,
    'name' => 'PollsLatest',
    'description' => 'Shows the latest poll of all categories or from a certain category',
    'snippet' => getSnippetContent($sources['snippets'].'snippet.pollslatest.php'),
),'',true,true);
$properties = file_get_contents($sources['snippets'].'snippet.pollslatest.properties.json');
$snippets[1]->setProperties($modx->fromJSON($properties));
unset($properties);

$snippets[2] = $modx->newObject('modSnippet');
$snippets[2]->fromArray(array(
    'id' => 1,
    'name' => 'PollsResult',
    'description' => 'Shows the results of a single poll',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.pollsresult.php'),
),'',true,true);
$properties = file_get_contents($sources['snippets'].'snippet.pollsresult.properties.json');
$snippets[2]->setProperties($modx->fromJSON($properties));
unset($properties);

$snippets[3] = $modx->newObject('modSnippet');
$snippets[3]->fromArray(array(
    'id' => 1,
    'name' => 'PollsPrevious',
    'description' => 'Generates a listing of Polls which are no longer active or not latest anymore',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.pollsprevious.php'),
),'',true,true);
$properties = file_get_contents($sources['snippets'].'snippet.pollsprevious.properties.json');
$snippets[3]->setProperties($modx->fromJSON($properties));
unset($properties);

return $snippets;