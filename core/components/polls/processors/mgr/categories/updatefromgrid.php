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

$poll = $modx->getObject('modPollQuestion', $_DATA['id']);
if(empty($poll)) return $modx->error->failure($modx->lexicon('polls.error.update'));

if(isset($_DATA['publishdate']) && empty($_DATA['publishdate'])) { $_DATA['publishdate'] = null; }
if(isset($_DATA['unpublishdate']) && empty($_DATA['unpublishdate'])) { $_DATA['unpublishdate'] = null; }

$poll->fromArray($_DATA);
if($poll->save() == false) {
    return $modx->error->failure($modx->lexicon('polls.error.save'));
}
/*
$category = $poll->getOne('Category');
$poll->category = ((!empty($category) && is_object($category)) ? $category->get('name') : $poll->category);
var_dump($poll->toArray()); exit();
*/
return $modx->error->success('', $poll);