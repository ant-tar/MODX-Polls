<?php
/**
 * PollsLatest
 * Shows the latest poll of all categories or from a certain category
 *
 * @author Bert Oost @ OostDesign
 * @copyright Copyright Bert Oost <bert@oostdesign.nl>
 * @package polls
 *
 * TEMPLATES:
 *
 * tplVote - The main form template for the latest poll view
 * tplVoteAnswer - The form template for the answers inside the main view
 * tplResult - The main result template for the latest poll view
 * tplResultAnswer - The result template for the answers inside the outer view
 *
 * SELECTION:
 *
 * category - (Opt) will select the latest poll from the given category (id or name), could be multiple devided by a comma
 * sortby - (Opt) to influence the normal order, order could be any field in list, defaults to id
 * sortdir - (Opt) to influence the normal order direction, defaults to DESC
 * [Note] No params; will select the latest poll from any category
 *        sortby and sortdir are normally not need to set
 *
 * LINKING:
 *
 * resultResource - (Opt) when set to a resource id, this resource will be used to show the poll results
 * resultLinkVar - (Opt) when using resultResource, this is the paramatername the snippet is looking for
 *
 * OPTIONS:
 *
 * uniqueBy - (Opt) defauls to ip, when set to user will limit voting to logged in users instead of ip-address
 *
 */
$polls = $modx->getService('polls','Polls',$modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/').'model/polls/',$scriptProperties);
if (!($polls instanceof Polls)) return '';

// templates
$tplVote = $modx->getOption('tplVote', $scriptProperties, 'pollsLatestVoteOuter');
$tplVoteAnswer = $modx->getOption('tplVoteAnswer', $scriptProperties, 'pollsLatestVoteAnswer');
$tplResult = $modx->getOption('tplResult', $scriptProperties, 'pollsLatestResultOuter');
$tplResultAnswer = $modx->getOption('tplResultAnswer', $scriptProperties, 'pollsLatestResultAnswer');

// properties
$category = $modx->getOption('category', $scriptProperties, null);
$sortby = $modx->getOption('sortby', $scriptProperties, 'id');
$sortdir = $modx->getOption('sortdir', $scriptProperties, 'DESC');
$resultResource = $modx->getOption('resultResource', $scriptProperties, null);
$resultLinkVar = $modx->getOption('resultLinkVar', $scriptProperties, 'poll');
$uniqueBy = $modx->getOption('uniqueBy', $scriptProperties, 'ip');

// start getting latest poll
$c = $modx->newQuery('modPollQuestion');

if(!empty($category)) {
  $categories = explode(',',$category);
  foreach($categories as $categoryid) {
    $c->orCondition(array(
      'category:=' => $categoryid
    ));
  }
}

$c->where(array(
  "(`modPollQuestion`.`publishdate` <= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`publishdate` IS NULL)",
  "(`modPollQuestion`.`unpublishdate` >= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`unpublishdate` IS NULL)"
));
$c->andCondition(array('modPollQuestion.hide:=' => '0'));
$c->sortby($sortby, $sortdir);
$c->limit(1);

$latest = $modx->getObject('modPollQuestion', $c);

if(!empty($latest)) {
  
  // start voting (if submitted)
  if($latest->vote($scriptProperties)) {
    
    $url = $modx->makeUrl($modx->resource->get('id'));
    $modx->sendRedirect($url);
  }
  
  $modx->lexicon->load('polls:latestpoll');
  
  $placeholders = $latest->toArray();
  $placeholders['totalVotes'] = $latest->getTotalVotes();

  $category = $latest->getOne('Category');
  $placeholders['category_name'] = (!empty($category) && is_object($category)) ? $category->get('name') : '';
  
  $answers = $latest->getMany('Answers');
  $answersOutput = '';
  foreach($answers as $idx => $answer) {
    $answerParams = array_merge(
      $answer->toArray(), array(
	'percent' => $answer->getVotesPercent($placeholders['totalVotes']),
	'idx' => $idx
      )
    );
    $answersOutput .= $modx->getChunk((!$latest->hasVoted($uniqueBy) ? $tplVoteAnswer : $tplResultAnswer), $answerParams);
  }
  
  $placeholders['answers'] = $answersOutput;
  
  if($latest->hasVoted($uniqueBy)) {
	  
	switch ($uniqueBy) {
	    case 'user':
	    	$user = $modx->getUser();
	    	$vote = $latest->getOne('Logs', array('user:=' => $user->get(id)));
			$placeholders['logdate'] = $vote->get('logdate');
	    	break;
	    default:
	    	$vote = $latest->getOne('Logs', array('ipaddress:=' => $_SERVER['REMOTE_ADDR']));
			$placeholders['logdate'] = $vote->get('logdate');
	    	break;
	}  
    
  }
  
  // build resource url for results if not has voted, because then the results are showed
  if(!empty($resultResource) && is_numeric($resultResource) && $resultResource > 0 && !$latest->hasVoted($uniqueBy)) {
    
    $resource = $modx->getObject('modResource', $resultResource);
    
    if(!empty($resource)) {
      $url = $modx->makeUrl($resource->get('id'), '', '&'.$resultLinkVar.'='.$latest->get('id'));
      $placeholders['results_url'] = $url;
    }
  }
  
  $output = $modx->getChunk((!$latest->hasVoted($uniqueBy) ? $tplVote : $tplResult), $placeholders);
  
  return $output;
}

return '';