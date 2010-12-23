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

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'PollsLatest',
    'description' => 'Shows the latest poll of all categories or from a certain category',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.pollslatest.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.pollslatest.php';
$snippets[0]->setProperties($properties);
unset($properties);

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => 1,
    'name' => 'PollsResult',
    'description' => 'Shows the results of a single poll',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.pollsresult.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.pollsresult.php';
$snippets[1]->setProperties($properties);
unset($properties);

return $snippets;