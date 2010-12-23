<?php
/**
 * @package polls
 * @subpackage processors
 */

if(empty($scriptProperties['id'])) {
	return $modx->error->failure($modx->lexicon('polls.categories.error_remove'));
}

$category = $modx->getObject('modPollCategory', $scriptProperties['id']);
if(empty($category)) {
	return $modx->error->failure($modx->lexicon('polls.categories.error_remove'));
}

if($category->remove() == false) {
    return $modx->error->failure($modx->lexicon('polls.categories.error_remove'));
}

return $modx->error->success('', $category);