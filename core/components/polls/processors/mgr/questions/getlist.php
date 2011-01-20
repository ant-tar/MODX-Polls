<?php
/**
 * Get a list of questions
 *
 * @package polls
 * @subpackage processors
 */
$isLimit = !empty($_REQUEST['limit']);
$category = $modx->getOption('category', $_REQUEST, false);
$start = $modx->getOption('start', $_REQUEST, 0);
$limit = $modx->getOption('limit', $_REQUEST, 20);
$sort = $modx->getOption('sort', $_REQUEST, 'id');
$dir = $modx->getOption('dir', $_REQUEST, 'DESC');
$query = $modx->getOption('query', $_REQUEST, '');

$c = $modx->newQuery('modPollQuestion');
$c->select('modPollQuestion.*');

if(!empty($query)) {
	$c->andCondition(array(
		'question:LIKE' => '%'.$query.'%'
	));
}

// get category
$category = $modx->getObject('modPollCategory', array('name' => $category));
if(!empty($category)) {
	$c->where(array('modPollQuestion.category:=' => $category->get('id')));
}

$count = $modx->getCount('modPollQuestion', $c);
$c->sortby($sort, $dir);
if($isLimit) {
	$c->limit($limit, $start);
}

$results = $modx->getCollection('modPollQuestion', $c);

$list = array();
foreach($results as $entry) {
    $oneItem = $entry->toArray();
	
	$category = $entry->getOne('Category');
	$oneItem['category_name'] = $modx->lexicon('polls.question.nocategory');
	if(!empty($category)) {
		$oneItem['category_name'] = $category->get('name');
	}
	
	$oneItem['totalVotes'] = $entry->getTotalVotes();
	
	$answers = $entry->getMany('Answers');
	$oneItem['answers'] = count($answers);
	
    $oneItem['menu'] = array();
    $oneItem['menu'][] = array(
        'text' => $modx->lexicon('polls.questions.update'),
        'handler' => 'this.updateQuestion'
    );
	
    $oneItem['menu'][] = array(
        'text' => $modx->lexicon('polls.answers'),
        'handler' => 'this.setupAnswers'
    );
	
    $oneItem['menu'][] = array(
        'text' => $modx->lexicon('polls.duplicate'),
        'handler' => 'this.duplicateQuestion'
    );
    
    $oneItem['menu'][] = '-';
    $oneItem['menu'][] = array(
        'text' => $modx->lexicon('polls.questions.remove'),
        'handler' => 'this.removeQuestion'
    );
	
    $list[] = $oneItem;
}

return $this->outputArray($list, $count);

?>