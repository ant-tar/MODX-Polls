<?php
/**
 * @package polls
 * @subpackage processors
 */
$answer = $modx->newObject('modPollAnswer');
$answer->fromArray($scriptProperties);

/* save */
if($answer->save() == false) {
    return $modx->error->failure($modx->lexicon('polls.answers.create.error_save'));
}


return $modx->error->success('', $answer);

?>