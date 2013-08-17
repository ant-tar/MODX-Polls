<?php
/**
 * Polls
 * 
 * Shows a single Poll from the system, based on the given ID of the Poll question
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
 * id - (Req.) The question ID of the Poll to show
 *
 * LINKING:
 *
 * resultResource - (Opt) when set to a resource id, this resource will be used to show the poll results
 * resultLinkVar - (Opt) when using resultResource, this is the paramatername the snippet is looking for
 */
$polls = $modx->getService('polls','Polls',$modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/').'model/polls/',$scriptProperties);
if (!($polls instanceof Polls)) return '';

// templates
$tplVote = $modx->getOption('tplVote', $scriptProperties, 'pollsLatestVoteOuter');
$tplVoteAnswer = $modx->getOption('tplVoteAnswer', $scriptProperties, 'pollsLatestVoteAnswer');
$tplResult = $modx->getOption('tplResult', $scriptProperties, 'pollsLatestResultOuter');
$tplResultAnswer = $modx->getOption('tplResultAnswer', $scriptProperties, 'pollsLatestResultAnswer');
$output = '';

// selection
$id = $modx->getOption('id', $scriptProperties, 0);

// properties
$resultResource = $modx->getOption('resultResource', $scriptProperties, null);
$resultLinkVar = $modx->getOption('resultLinkVar', $scriptProperties, 'poll');

if(!empty($id) && is_numeric($id)) {
    
    $c = $modx->newQuery('modPollQuestion');
    $c->where(array(
        'id' => $id,
        'hide' => false,
        "(`modPollQuestion`.`publishdate` <= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`publishdate` IS NULL)",
        "(`modPollQuestion`.`unpublishdate` >= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`unpublishdate` IS NULL)",
    ));
    $poll = $modx->getObject('modPollQuestion', $c);
    
    if(!empty($poll) && is_object($poll)) {
        
        // start voting (if submitted)
        if($poll->vote($scriptProperties)) {
            
            $url = $modx->makeUrl($modx->resource->get('id'));
            $modx->sendRedirect($url);
        }
        
        $modx->lexicon->load('polls:latestpoll');
        
        $placeholders = $poll->toArray();
        $placeholders['totalVotes'] = $poll->getTotalVotes();
        
        $category = $poll->getOne('Category');
        $placeholders['category_name'] = (!empty($category) && is_object($category)) ? $category->get('name') : '';
          
        $answers = $poll->getMany('Answers');
        $answersOutput = '';
        foreach($answers as $idx => $answer) {
            $answerParams = array_merge(
                $answer->toArray(), array(
                'percent' => $answer->getVotesPercent($placeholders['totalVotes']),
    	        'idx' => $idx
            ));
            $answersOutput .= $modx->getChunk((!$poll->hasVoted() ? $tplVoteAnswer : $tplResultAnswer), $answerParams);
        }
        
        $placeholders['answers'] = $answersOutput;
        
        if($poll->hasVoted()) {
            
            $vote = $latest->getOne('Logs', array('ipaddress:=' => $_SERVER['REMOTE_ADDR']));
            $placeholders['logdate'] = $vote->get('logdate');
        }
        
        // build resource url for results if not has voted, because then the results are showed
        if(!empty($resultResource) && is_numeric($resultResource) && $resultResource > 0 && !$poll->hasVoted()) {
            
            $resource = $modx->getObject('modResource', $resultResource);
            
            if(!empty($resource)) {
                $url = $modx->makeUrl($resource->get('id'), '', array($resultLinkVar => $poll->get('id')));
                $placeholders['results_url'] = $url;
            }
        }
        
        $output = $modx->getChunk((!$poll->hasVoted() ? $tplVote : $tplResult), $placeholders);
    }
}

return $output;

?>
