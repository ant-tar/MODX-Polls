<?php

class modPollAnswer extends xPDOSimpleObject
{
	/**
	 * Returns the number of percents of the number of votes
	 *
	 * @return float
	 */
	public function getVotesPercent($total) {
		
		$percent = number_format(($this->votes / $total) * 100, 1, '.', '');
		
		return $percent;
	}
	
	/**
	 * Adds a vote to the current answer/question
	 *
	 * @return boolean
	 */
	public function addVote() {
		
		if(!$this->hasVoted()) {
		
			$currVotes = $this->votes;
			$this->set('votes', $currVotes+1);
			
			if($this->save()) {
				
				$this->logVote();
				
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Logs a vote on this answer
	 *
	 * @return boolean
	 */
	private function logVote() {
		
		$vote = $this->xpdo->newObject('modPollLog');
		$vote->set('question', $this->question);
		$vote->set('ipaddress', $_SERVER['REMOTE_ADDR']);
		$vote->set('logdate', date('Y-m-d H:i:s'));
		$vote->addOne($this);
		
		if($vote->save()) {
			
			return true;
		}
		
		return false;
	}
	
	/**
	 * Check if current IP address has voted on the current answer/question
	 *
	 * @return boolean
	 */
	private function hasVoted() {
		
		$vote = $this->getOne('Logs', array( 
			'ipaddress:=' => $_SERVER['REMOTE_ADDR'],
			'answer' => $this->id
		));
		
		if(!empty($vote)) {
			
			return true;
		}
		
		return false;
	}
}