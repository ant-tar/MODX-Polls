<?php
/**
 * @package polls
 * @subpackage processors
 */

if(empty($scriptProperties['id'])) {
	return $modx->error->failure($modx->lexicon('polls.answers.error_remove'));
}

$answer = $modx->getObject('modPollAnswer', $scriptProperties['id']);
if(empty($answer)) {
	return $modx->error->failure($modx->lexicon('polls.answers.error_remove'));
}

if($answer->remove() == false) {
    return $modx->error->failure($modx->lexicon('polls.answers.error_remove'));
}

return $modx->error->success('', $answer);