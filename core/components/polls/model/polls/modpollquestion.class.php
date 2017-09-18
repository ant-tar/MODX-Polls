<?php

class modPollQuestion extends xPDOSimpleObject
{
	/**
	 * Returns the number of total votes of the curren question
	 *
	 * @return integer
	 */
	public function getTotalVotes() {
		
		$totalVotes = 0;
		$answers = $this->getMany('Answers');
		
		foreach($answers as $answer) {
			$totalVotes += $answer->get('votes');
		}
		
		return $totalVotes;
	}
	/**
	 * To vote on a answer of this question
	 *
	 * @param array $properties
	 * @return boolean
	 */
	public function vote($properties=array()) {
		$submitVar = $this->xpdo->getOption('submitVar', $properties, 'pollVote');
		$answerVar = $this->xpdo->getOption('answerVar', $properties, 'answer');
		$comment = $this->xpdo->getOption('comment', $_POST);
		//$postHooks = $this->xpdo->getOption('postHooks', $properties, ''); // implementation in later version
		if(!empty($submitVar) && isset($_POST[$submitVar])) {
			
			$answer = (isset($_POST[$answerVar]) && is_numeric($_POST[$answerVar])) ? (integer) $_POST[$answerVar] : false;
			
			if($answer !== false) {
				
				$answer = $this->getOne('Answers', $answer);
				$answer->addVote($comment);

				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Checks if current visitor already has voted yet
	 *
	 * @return boolean
	 */
	public function hasVoted() {
		
		$vote = $this->getOne('Logs', array(
			'ipaddress:=' => $_SERVER['REMOTE_ADDR'],
			'question' => $this->id
		));
		
		if(!empty($vote)) {
			
			return true;
		}
		
		return false;
	}
}