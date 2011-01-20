<?php
/**
 * Get a list of questions
 *
 * @package polls
 * @subpackage processors
 */
$isLimit = !empty($_REQUEST['limit']);
$combobox = $modx->getOption('combo', $_REQUEST, false);
$start = $modx->getOption('start', $_REQUEST, 0);
$limit = $modx->getOption('limit', $_REQUEST, 20);
$sort = $modx->getOption('sort', $_REQUEST, 'id');
$dir = $modx->getOption('dir', $_REQUEST, 'DESC');
$query = $modx->getOption('query', $_REQUEST, '');

$c = $modx->newQuery('modPollCategory');
$c->select('modPollCategory.*');

if(!empty($query)) {
	$c->andCondition(array(
		'question:LIKE' => '%'.$query.'%'
	));
}

$count = $modx->getCount('modPollCategory', $c);
$c->sortby($sort, $dir);
if($isLimit) {
	$c->limit($limit, $start);
}

$results = $modx->getCollection('modPollCategory', $c);

$list = array();

if(!empty($combobox) && $combobox == 'true') {
	$list[] = array(
		'id' => 0,
		'name' => $modx->lexicon('polls.question.nocategory')
	);
}

foreach($results as $entry) {
    $oneItem = $entry->toArray();
	
    $oneItem['menu'][] = array(
        'text' => $modx->lexicon('polls.categories.remove'),
        'handler' => 'this.removeCategory'
    );
	
    $list[] = $oneItem;
}

return $this->outputArray($list, $count);

?>