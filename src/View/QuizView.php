<?php

namespace View;

require_once("QuestionView.php");
require_once("StartButtonView.php");

class QuizView {
    private $questionBankToBeShown;

    public function __construct(\Model\QuestionBank $toBeShown) {
        $this->questionBankToBeShown = $toBeShown;
    }

    public function echoQuizHTML() {
        if ($this->userWantsToStartQuiz()) {
            $questionBankHTML = $this->getQuestionBankHTML();
            echo $questionBankHTML;
        } else {
            $startButtonHTML = $this->getStartButtonHTML();
            echo $startButtonHTML;
        } 
    }

    public function userWantsToStartQuiz() : bool {
        return StartButtonView::userWantsToStartQuiz();
    }

    public function userClicksNextButton() : bool {
        return QuestionView::next();
    }

    public function getAnsweredQuestion() : \Model\QuestionModel {
        $answer = $this->getUserAnswer(); 
        $answeredQuestion = $this->questionBankToBeShown->getQuestionByAnswer($answer);
        
        return $answeredQuestion;
    }

    public function getUserAnswer() {
        return QuestionView::getUserAnswer();
    }

    private function getStartButtonHTML() : string {
        $startButtonView = new \View\StartButtonView();
        $ret = "";
        $ret .= $startButtonView->getStartButtonHTML();

        return $ret;
    }

    private function getQuestionBankHTML() : string {    
        $questionsToShow = $this->questionBankToBeShown->getAll();
        $questionViews = array();
        foreach ($questionsToShow as $question) {
            $questionViews[] = new QuestionView($question);
            $randomQuestion = $questionViews[array_rand($questionViews)];        
        }

        $ret = "";
        $ret .= $randomQuestion->getQuestionHTML();
    
        return $ret;   
    }
}