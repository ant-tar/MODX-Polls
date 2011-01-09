<?php
 /**
  * PollsResult
  *
  * Shows the results of a single poll
  *
  * @author Bert Oost
  * @copyright Copyright 2010, Bert Oost
  * @version 0.1-rc1 - December 21, 2010
  * @package polls
  *
  * TEMPLATES:
  *
  * tpl - The main result template for the poll view
  * tplAnswer - The result template for the answers inside the outer view
  *
  * LINKING:
  *
  * resultLinkVar - (Opt) when using resultResource, this is the paramatername the snippet is looking for
  */
  $polls = $modx->getService('polls','Polls',$modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/').'model/polls/',$scriptProperties);
  if (!($polls instanceof Polls)) return '';
  
  // templates
  $tpl = $modx->getOption('tpl', $scriptProperties, 'pollsLatestResultOuter');
  $tplAnswer = $modx->getOption('tplAnswer', $scriptProperties, 'pollsLatestResultAnswer');
  
  // properties
  $resultLinkVar = $modx->getOption('resultLinkVar', $scriptProperties, 'poll');
  
  if(isset($_GET[$resultLinkVar]) && is_numeric($_GET[$resultLinkVar]) && $_GET[$resultLinkVar] > 0) {
    
    // start getting poll results
    $c = $modx->newQuery('modPollQuestion');
    
    $c->innerJoin('modPollAnswer','Answers');
    $c->where(array(
      'modPollQuestion.id:=' => $_GET[$resultLinkVar],
      'modPollQuestion.hide:=' => false,
      "(`modPollQuestion`.`publishdate` >= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`publishdate` IS NULL)",
      "(`modPollQuestion`.`unpublishdate` <= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`unpublishdate` IS NULL)"
    ));
    
    $result = $modx->getObject('modPollQuestion', $c);
    
    if(!empty($result)) {
      
      $modx->lexicon->load('polls:latestpoll');
    
      $placeholders = $result->toArray();
      $placeholders['totalVotes'] = $result->getTotalVotes();
	  
      $category = $result->getOne('Category');
      $placeholders['category_name'] = (!empty($category) && is_object($category)) ? $category->get('name') : '';
      
      $answers = $result->getMany('Answers');
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
      
      if($result->hasVoted()) {
        
        $vote = $result->getOne('Logs', array('ipaddress:=' => $_SERVER['REMOTE_ADDR']));
        $placeholders['logdate'] = $vote->get('logdate');
      }
      
      $output = $modx->getChunk($tpl, $placeholders);
      
      return $output;
    }
  }
  
  return '';