<?php

namespace Controller;

require_once("Model/QuestionModel.php");
require_once("Model/HighscoreModel.php");
require_once("Model/DAL/UserAnswerSessionStorage.php");
require_once("Model/DAL/CorrectAnswerSessionStorage.php");
require_once("Model/DAL/HighscoreStorage.php");
require_once("Model/DAL/FileQuestionStorage.php");
require_once("Model/UserAnswer.php");
require_once("Model/CorrectAnswer.php");
require_once("Model/QuestionBank.php");
require_once("Model/HighscoreBank.php");
require_once("Controller/QuizController.php");
require_once("View/QuizView.php");
require_once("View/MainView.php");
require_once("View/UserAnswerView.php");
require_once("View/CorrectAnswerView.php");
require_once("Login/src/Controller/MainController.php");
require_once("Login/src/Model/LoginModel.php");
require_once("Login/src/LoginSettings.php");

class Application {
    private $userAnswerStorage;
    private $correctAnswerStorage;
    private $highscoreStorage;
    private $jsonStorage;
    private $settings;

    public function __construct(\Settings $settings) {
        $this->settings = $settings;
        $this->userAnswerStorage = new \Model\DAL\UserAnswerSessionStorage();
        $this->correctAnswerStorage = new \Model\DAL\CorrectAnswerSessionStorage(); 
        $this->highscoreStorage = new \Model\DAL\HighScoreStorage($this->settings->getHighscoreFolder());
        $this->jsonStorage = new \Model\DAL\FileQuestionStorage($this->settings->getDataFolder());
    }

    public function login() {
        $loginSettings = new \LoginSettings();
        $loginController = new \Controller\MainController($loginSettings);
        $loginController->run();

        $loginModel = new \Model\LoginModel();
        if ($loginModel->isLoggedIn() == true) {
            $this->run();
        } elseif ($loginModel->isLoggedIn() == false) {
            $this->highscoreList = $this->highscoreStorage->getScoresToShow();
            $this->mainView = new \View\MainView($this->highscoreList);
            $this->mainView->echoMainHTML();
        }
    }

    public function run() {
        try {
            $this->loadState();
    
            $this->quizView = new \View\QuizView($this->allQuestions,$this->userAnswer);
            $this->userAnswerView = new \View\UserAnswerView($this->userAnswer);
            $this->correctAnswerView = new \View\CorrectAnswerView($this->correctAnswer);
            
            $this->handleInput();
            $this->saveState();
            $this->generateOutput();
    
        } catch (\Exception $e) {
            echo "Sorry, something went wrong =(";
            error_log("Error when loading data" . $e);
        }
    }

    private function loadState() {
        $this->allQuestions = $this->jsonStorage->getQuestionsToShow();
        $this->userAnswer = $this->userAnswerStorage->getFromSessionOrEmpty();
        $this->correctAnswer = $this->correctAnswerStorage->getFromSessionOrEmpty();
    }

    private function handleInput() {
        $quizController = new \Controller\QuizController($this->quizView, $this->userAnswer, $this->userAnswerView, $this->correctAnswer, $this->correctAnswerView);
        $quizController->doQuiz();
    }

    private function saveState() {
        $this->userAnswerStorage->saveToSessionStorage($this->userAnswer);
        $this->correctAnswerStorage->saveToSessionStorage($this->correctAnswer);
    }

    private function generateOutput() {
        $this->quizView->echoQuizHTML();
    }
}