<?php
/**
 * @package polls
 * @subpackage processors
 */

if(empty($scriptProperties['id'])) {
	return $modx->error->failure($modx->lexicon('polls.question.error_update'));
}

$question = $modx->getObject('modPollQuestion', $scriptProperties['id']);
if(empty($question)) {
	return $modx->error->failure($modx->lexicon('polls.question.error_update'));
}

if(isset($scriptProperties['publishdate']) && empty($scriptProperties['publishdate'])) { $scriptProperties['publishdate'] = null; }
if(isset($scriptProperties['unpublishdate']) && empty($scriptProperties['unpublishdate'])) { $scriptProperties['unpublishdate'] = null; }
if(isset($scriptProperties['hide']) && !empty($scriptProperties['hide'])) { $scriptProperties['hide'] = true; } else { $scriptProperties['hide'] = false; }

$question->fromArray($scriptProperties);
if($question->save() == false) {
    return $modx->error->failure($modx->lexicon('polls.question.error_update'));
}

return $modx->error->success('', $customers);

?>