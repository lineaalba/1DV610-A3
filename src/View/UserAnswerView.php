<?php

namespace View;

class UserAnswerView {
	private $userAnswerModel;
	
	public function __construct(\Model\UserAnswer $toBeShown) {
		$this->userAnswerModel = $toBeShown;
	}

	public function getHTML() {
        $userAnswer = array();
		$userAnswers = $this->userAnswerModel->getAnswers();

		$ret = "";
		$ret = "<h2>Your answers:</h2>";
		$ret .= "<ol>";
		foreach ($userAnswers as $userAnswer) {
			
			$ret .= "<li>$userAnswer</li>";
		}
        $ret .= "</ol>";
    
		echo $ret;
	}
}