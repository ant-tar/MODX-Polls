<?php
/**
 * @package customers
 * @subpackage processors
 */
/* get board */
if(empty($_REQUEST['id'])) {
	return $modx->error->failure($modx->lexicon('polls.questions.errorload'));
}

$question = $modx->getObject('modPollQuestion', $_REQUEST['id']);
if(!$question) {
	return $modx->error->failure($modx->lexicon('polls.questions.errorload'));
}

return $modx->error->success('', $question->toArray('', true));

?>