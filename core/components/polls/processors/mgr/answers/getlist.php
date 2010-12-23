<?php
/**
 * Get a list of questions
 *
 * @package polls
 * @subpackage processors
 */
$isLimit = !empty($_REQUEST['limit']);
$question = $modx->getOption('id', $_REQUEST, 0);
$sort = $modx->getOption('sort', $_REQUEST, 'sort_order=0, sort_order, id');
$dir = $modx->getOption('dir', $_REQUEST, 'ASC');
$query = $modx->getOption('query', $_REQUEST, '');

$question = $modx->getObject('modPollQuestion', $question);

$c = $modx->newQuery('modPollAnswer');
if(!empty($query)) {
	$c->andCondition(array(
		'answer:LIKE' => '%'.$query.''
	));
}
$c->sortby($sort, $dir);

$answers = $question->getMany('Answers', $c);

$list = array();
foreach($answers as $answer) {
    $oneItem = $answer->toArray();
	
    $oneItem['menu'] = array();
    $oneItem['menu'][] = array(
        'text' => $modx->lexicon('polls.answers.remove'),
        'handler' => 'this.removeAnswer'
    );
	
    $list[] = $oneItem;
}

return $this->outputArray($list, $count);

?>