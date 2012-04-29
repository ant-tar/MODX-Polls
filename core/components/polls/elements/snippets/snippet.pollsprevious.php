<?php
/**
 * PollsPrevious
 * Generates a listing of Polls which are no longer active or not latest anymore
 *
 * @author Bert Oost @ OostDesign
 * @copyright Copyright Bert Oost <bert@oostdesign.nl>
 * @package polls
 *
 * TEMPLATING:
 *
 * tplOuter - (Opt) an optional outer template could be set to surround the output
 * tpl - The question template, default used the pollsLatestResultOuter
 * tplAnswer - The answer template per question, default used the pollsLatestResultAnswer
 *
 * SELECTION:
 *
 * category - (Opt) will select polls from the given category (id or name), could be multiple devided by a comma
 * unpubOnly - (Opt) will show unpublished polls only (default set to false)
 * showHidden - (Opt) will show hidden polls too! (default set to false)
 *
 * sortby - (Opt) to influence the normal order, order could be any field in list, defaults to id
 * sortdir - (Opt) to influence the normal order direction, defaults to DESC
 * limit - (Opt) to limit the selecting result, also compatible with getPage for paging
 * offset - (Opt) to set a start of the selection result, compatible with getPage for paging
 * totalVar - (Opt) to set a placeholder name containing the total results, compatible with getPage for paging
 *
 * LINKING:
 *
 * resultResource - (Opt) when set to a resource id, this resource will be used to show the poll results
 * resultLinkVar - (Opt) when using resultResource, this is the paramatername the snippet is looking for
 */
$polls = $modx->getService('polls','Polls',$modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/').'model/polls/',$scriptProperties);
if (!($polls instanceof Polls)) return '';
$modx->lexicon->load('polls:previouspolls');

// templates
$tplOuter = $modx->getOption('tplOuter', $scriptProperties, '');
$tpl = $modx->getOption('tpl', $scriptProperties, 'pollsLatestResultOuter');
$tplAnswer = $modx->getOption('tplAnswer', $scriptProperties, 'pollsLatestResultAnswer');
$output = '';

// properties
$category = $modx->getOption('category', $scriptProperties, null);
$unpubOnly = (boolean) $modx->getOption('unpubOnly', $scriptProperties, 0);
$showHidden = (boolean) $modx->getOption('showHidden', $scriptProperties, 0);

$sortby = $modx->getOption('sortby', $scriptProperties, 'id');
$sortdir = $modx->getOption('sortdir', $scriptProperties, 'DESC');
$limit = $modx->getOption('limit', $scriptProperties, 0);
$offset = $modx->getOption('offset', $scriptProperties, 0);
$totalVar = $modx->getOption('totalVar', $scriptProperties, 'total');

$resultResource = $modx->getOption('resultResource', $scriptProperties, null);
$resultLinkVar = $modx->getOption('resultLinkVar', $scriptProperties, 'poll');

// find all previous polls
$c = $modx->newQuery('modPollQuestion');

if(!empty($category)) {
  $categories = explode(',',$category);
  foreach($categories as $category) {
    if(!empty($category) && is_numeric($category)) {
      $c->orCondition(array('category' => $category));
    } else if(!empty($category)) {
      $category = $modx->getObject('modPollCategory', array('name' => $category));
      if(!empty($category) && is_object($category) && $category instanceof modPollCategory) {
	$c->orCondition(array('category' => $category->get('id')));
      }
    }
  }
}

// only unpublished or not?
if($unpubOnly) {
  $c->andCondition(array(
    "`modPollQuestion`.`unpublishdate` IS NOT NULL",
    "`modPollQuestion`.`unpublishdate` <= '".date('Y-m-d H:i:s')."'"
  ));
}
else {
  $c->andCondition(array(
    "(`modPollQuestion`.`publishdate` <= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`publishdate` IS NULL)",
    "(`modPollQuestion`.`unpublishdate` >= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`unpublishdate` IS NULL)"
  ));
}

// show hidden items too?
if(!$showHidden) {
  $c->andCondition(array(
    'modPollQuestion.hide' => false
  ));
}

$c->sortby($sortby, $sortdir);

// limits?
if(!empty($limit)) {
  $total = $modx->getCount('modPollQuestion', $c);
  $modx->setPlaceholder($totalVar, $total);
  
  $c->limit($limit, $offset);
}

// get resource for results if not has voted, because then the results are showed
if(!empty($resultResource) && is_numeric($resultResource) && $resultResource > 0) {
  
  $resultResource = $modx->getObject('modResource', $resultResource);
}

// get collection of questions
$questions = $modx->getCollection('modPollQuestion', $c);

foreach($questions as $index => $question) {
  
  $placeholders = $question->toArray();
  $placeholders['totalVotes'] = $question->getTotalVotes();
  $placeholders['idx'] = ($index + 1);
  
  $category = $question->getOne('Category');
  $placeholders['category_name'] = (!empty($category) && is_object($category)) ? $category->get('name') : '';
  
  // include the answers
  $answers = $question->getMany('Answers');
  $answersOutput = '';
  foreach($answers as $idx => $answer) {
    $answerParams = array_merge(
      $answer->toArray(), array(
	'percent' => $answer->getVotesPercent($placeholders['totalVotes']),
	'idx' => $idx
      )
    );
    $answersOutput .= $modx->getChunk($tplAnswer, $answerParams);
  }
  
  $placeholders['answers'] = $answersOutput;
  
  // add results url
  $placeholders['results_url'] = '';
  if(!empty($resultResource) && $resultResource instanceof modResource) {
    $url = $modx->makeUrl($resultResource->get('id'), '', array($resultLinkVar => $question->get('id')));
    $placeholders['results_url'] = $url;
  }
  
  $output .= $modx->getChunk($tpl, $placeholders);
}

// outer template output
if(!empty($tplOuter) && !empty($output)) {
  
  $output = $modx->getChunk($tplOuter, array('wrapper' => $output));
}

return $output;
?>