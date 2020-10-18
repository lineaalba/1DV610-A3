<?php

namespace Controller;

require_once("Login/src/Model/DAL/UserSessionStorage.php");
require_once("Login/src/Controller/RegisterController.php");
require_once("Login/src/Controller/LoginController.php");
require_once("Login/src/Model/LoginModel.php");
require_once("Login/src/Model/MainModel.php");
require_once("Login/src/View/LayoutView.php");
require_once("Login/src/View/LoginView.php");
require_once("Login/src/View/RegisterView.php");

class MainController {
    private $sessionStorage;
    private $registerController;
    private $loginController;
    private $loginModel;
    private $mainModel;
    private $loginView;
    private $registerView;

    public function __construct() {
       $this->sessionStorage = new \Model\DAL\UserSessionStorage();
       $this->registerController = new \Controller\RegisterController();
       $this->loginController = new \Controller\LoginController();
       $this->loginModel = new \Model\LoginModel();
       $this->mainModel = new \Model\MainModel();
       $this->loginView = new \View\LoginView();
       $this->registerView = new \View\RegisterView();
    }
    
    public function run() {
        $loggedInUsers = $this->sessionStorage->getFromSessionOrEmpty(); // Load from storage

        $this->changeState();
        $this->generateOutput();
     
        $this->sessionStorage->saveToSessionStorage($loggedInUsers); // Save to storage
    }

    private function changeState() {            
        $this->registerController->checkForInputs();  
        $this->loginController->checkForInputs();
    }

    private function generateOutput() {
        $message = $this->mainModel->getMessage();
        $isLoggedIn = $this->loginModel->isLoggedIn();

        $link = $this->loginView->showLink($isLoggedIn);
        $renderIsLoggedIn = $this->loginView->renderIsLoggedIn($isLoggedIn);
        $username = $this->mainModel->getSessionUsername();
        $correctHTML = $this->getCorrectHTML($isLoggedIn, $username, $message);
        
        $layoutView = new \View\LayoutView($link, $renderIsLoggedIn, $correctHTML);
        $layoutView->echoHTML();
    }

    private function getCorrectHTML($isLoggedIn, $username, $message) {
        $registerModel = new \Model\RegisterModel();
        
        if (!$isLoggedIn) {
            if ($this->registerView->userClicksRegisterLink() == false && $this->registerView->userWantsToRegister() == false) {
                return $this->loginView->generateLoginFormHTML($username, $message);
            } elseif ($this->registerView->userClicksRegisterLink() == true) {
                return $this->registerView->generateRegisterFormHTML($message);
            } elseif ($this->registerView->userWantsToRegister() && $this->mainModel->getMessage() != $this->registerView->newUserRegistredMessage()) {
               // behålla /register i url
                return $this->registerView->generateRegisterFormHTML($message);
            } elseif ($this->registerView->userWantsToRegister() && $this->mainModel->getMessage() == $this->registerView->newUserRegistredMessage()) {
                return $this->loginView->generateLoginFormHTML($username, $message);
            }
        } elseif ($isLoggedIn) {
            return $this->loginView->generateLogoutButton($message);
        }
    }
}
