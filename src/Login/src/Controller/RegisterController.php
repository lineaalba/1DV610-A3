<?php

namespace Controller;

require_once('Login/src/View/RegisterView.php');
require_once('Login/src/Model/RegisterModel.php');
require_once('Login/src/Model/MainModel.php');

class RegisterController {
    private $registerView;
    private $registerModel;
    private $mainModel;

    public function __construct() {
        $this->registerView = new \View\RegisterView();
        $this->registerModel = new \Model\RegisterModel();
        $this->mainModel = new \Model\MainModel();
    }

    public function checkForInputs() {
        if ($this->registerView->userWantsToRegister()) {
            $username = $this->registerView->getUsername();
            $password = $this->registerView->getPassword();
            $repeatedPassword = $this->registerView->getRepeatedPassword();
            $this->mainModel->setSessionUsername($username);
            if ($this->registerView->containsInvalidCharacters($username)) {
                $this->registerModel->removeInvalidCharacters($username);
                $message = $this->registerView->invalidCharactersMessage();
            } elseif ($this->registerModel->noUserInputs($username, $password)) {
                $message = $this->registerView->noInputsMessage();
            } elseif ($this->registerModel->tooShortUsername($username)) {
                $message = $this->registerView->tooShortUsernameMessage();
            } elseif ($this->registerModel->tooShortPassword($password)) {
                $message = $this->registerView->tooShortPasswordMessage();
            } elseif ($this->registerModel->noRepeatedPassword($repeatedPassword)) {
                $message = $this->registerView->passwordsDoNotMatchMessage();
            } elseif ($this->registerModel->passwordsDoNotMatch($password, $repeatedPassword)) {
                $message = $this->registerView->passwordsDoNotMatchMessage();
            } elseif ($this->registerModel->userExists($username)) {
                $message = $this->registerView->userExistsMessage();
            } elseif ($username && $password) {
                $message = $this->registerView->newUserRegistredMessage();
                $this->registerModel->saveUserToFile($username, $password);
                $this->mainModel->setSessionUsername($username);
            }  
            
            $this->mainModel->setMessage($message);
        }
    }
}