<?php
/**
 * @package polls
 * @subpackage processors
 */

if(empty($scriptProperties['id'])) {
	return $modx->error->failure($modx->lexicon('polls.questions.duplicate_error'));
}

$oldQuestion = $modx->getObject('modPollQuestion', $scriptProperties['id']);
if(empty($oldQuestion)) {
	return $modx->error->failure($modx->lexicon('polls.questions.duplicate_error'));
}

// new question
$newQuestion = $modx->newObject('modPollQuestion');
$newQuestion->fromArray($oldQuestion->toArray('', true), '', false, true);
$newQuestion->set('hide', true);

// add answer
$newAnswers = array();
$oldAnswers = $oldQuestion->getMany('Answers');
foreach($oldAnswers as $oldAnswer) {
	$oneAnswer = $modx->newObject('modPollAnswer');
	$oneAnswer->set('answer', $oldAnswer->get('answer'));
	$oneAnswer->set('votes', 0);
	$oneAnswer->set('sort_order', $oldAnswer->get('sort_order'));
	
	$newAnswers[] = $oneAnswer;
}

$newQuestion->addMany($newAnswers);
if($newQuestion->save() == false) {
    return $modx->error->failure($modx->lexicon('polls.questions.duplicate_error'));
}

return $modx->error->success('', $customers);

?>