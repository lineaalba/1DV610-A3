<?php

namespace View;

class CorrectAnswerView {
	private $correctAnswerModel;
	
	public function __construct(\Model\CorrectAnswer $toBeShown) {
		$this->correctAnswerModel = $toBeShown;
	}

	public function getHTML() {
        $correctAnswer = array();
		$correctAnswers = $this->correctAnswerModel->getCorrectAnswers();

		$ret = "";
		$ret = "<h2>Correct answers:</h2>";
		$ret .= "<ol>";
		foreach ($correctAnswers as $correctAnswer) {
			$ret .= "<li>$correctAnswer</li>";
		}
        $ret .= "</ol>";
    
		echo $ret;
	}
}