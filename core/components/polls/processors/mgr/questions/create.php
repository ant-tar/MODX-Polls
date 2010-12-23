<?php
/**
 * @package polls
 * @subpackage processors
 */
$question = $modx->newObject('modPollQuestion');

if(!isset($scriptProperties['publishdate']) || empty($scriptProperties['publishdate'])) { $scriptProperties['publishdate'] = null; }
if(!isset($scriptProperties['unpublishdate']) || empty($scriptProperties['unpublishdate'])) { $scriptProperties['unpublishdate'] = null; }
if(!isset($scriptProperties['hide']) || empty($scriptProperties['hide'])) { $scriptProperties['hide'] = true; }

$question->fromArray($scriptProperties);

/* save */
if($question->save() == false) {
    return $modx->error->failure($modx->lexicon('polls.questions.create.error_save'));
}


return $modx->error->success('', $question);

?>