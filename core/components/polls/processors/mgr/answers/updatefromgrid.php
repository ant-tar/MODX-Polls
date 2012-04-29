<?php
/**
 * @package polls
 * @subpackage processors
 */

if(empty($scriptProperties['data'])) {
	return $modx->error->failure($modx->lexicon('polls.error.griddata'));
}

$_DATA = $modx->fromJSON($scriptProperties['data']);
if(!is_array($_DATA)) {
	return $modx->error->failure($modx->lexicon('polls.error.griddata'));
}

if(empty($_DATA['id'])) {
	return $modx->error->failure($modx->lexicon('polls.error.update'));
}

$answer = $modx->getObject('modPollAnswer', $_DATA['id']);
if(empty($answer)) return $modx->error->failure($modx->lexicon('polls.error.update'));

$answer->fromArray($_DATA);
if($answer->save() == false) {
    return $modx->error->failure($modx->lexicon('polls.error.save'));
}

return $modx->error->success('', $answer);