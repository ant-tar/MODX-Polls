<?php
/**
 * @package polls
 * @subpackage processors
 */
$category = $modx->newObject('modPollCategory');
$category->fromArray($scriptProperties);

/* save */
if($category->save() == false) {
    return $modx->error->failure($modx->lexicon('polls.categories.create.error_save'));
}


return $modx->error->success('', $category);

?>