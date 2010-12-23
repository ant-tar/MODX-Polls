<?php

class modPollQuestion extends xPDOSimpleObject
{
	/**
	 * To vote on a answer of this question
	 *
	 * @param array $properties
	 */
	public function vote($properties=array()) {
		
		$submitVar = $this->xpdo->getOption('submitVar', $properties, 'pollVote');
		$answerVar = $this->xpdo->getOption('answerVar', $properties, 'answer');
		//$postHooks = $this->xpdo->getOption('postHooks', $properties, ''); // implementation in later version
		
		if(!empty($submitVar) && isset($_POST[$submitVar])) {
			
			$answer = (isset($_POST[$answerVar]) && is_numeric($_POST[$answerVar])) ? (integer) $_POST[$answerVar] : false;
			
			if($answer !== false) {
				
				$answer = $this->getOne('Answers', $answer);
				$answer->addVote();
				
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Checks if current visitor already has voted yet
	 */
	public function hasVoted() {
		
		$vote = $this->getOne('Logs', array(
			'ipaddress:=' => $_SERVER['REMOTE_ADDR']
		));
		
		if(!empty($vote)) {
			
			return true;
		}
		
		return false;
	}
}