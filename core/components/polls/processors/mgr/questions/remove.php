<?php
/**
 * @package polls
 * @subpackage processors
 */

if(empty($scriptProperties['id'])) {
	return $modx->error->failure($modx->lexicon('polls.questions.error_remove'));
}

$question = $modx->getObject('modPollQuestion', $scriptProperties['id']);
if(empty($question)) {
	return $modx->error->failure($modx->lexicon('polls.questions.error_remove'));
}

if($question->remove() == false) {
    return $modx->error->failure($modx->lexicon('polls.questions.error_remove'));
}

return $modx->error->success('', $question);