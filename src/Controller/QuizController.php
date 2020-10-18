<?php

namespace Controller;

class QuizController {
    private $userAnswer;
    private $quizView;
    private $userAnswerView;
    private $correctAnswer;
    private $correctAnswerView;

    public function __construct(\View\QuizView $quizView, \Model\UserAnswer $userAnswer, \View\UserAnswerView $userAnswerView, \Model\CorrectAnswer $correctAnswer, \View\CorrectAnswerView $correctAnswerView) {
        $this->userAnswer = $userAnswer;
        $this->quizView = $quizView;
        $this->userAnswerView = $userAnswerView;
        $this->correctAnswer = $correctAnswer;
        $this->correctAnswerView = $correctAnswerView;
    }

    public function doQuiz() {
        if ($this->quizView->userClicksNextButton()) {
            $answer = $this->quizView->getUserAnswer();
            $this->userAnswer->add($answer);
            $answers = $this->userAnswer->getAnswers();

            $this->userAnswerView->getHTML();
        }
    }
}