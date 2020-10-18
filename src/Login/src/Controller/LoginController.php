<?php

namespace Controller;

require_once('Login/src/Model/LoginModel.php');
require_once('Login/src/Model/MainModel.php');
require_once('Login/src/View/LoginView.php');


class LoginController {
	private $loginView;
    private $loginModel;
    private $mainModel;
    private $isLoggedIn;

	public function __construct() {
		$this->loginView = new \View\LoginView();
        $this->loginModel = new \Model\LoginModel();
        $this->mainModel = new \Model\MainModel();
        $this->isLoggedIn = $this->loginModel->isLoggedIn();
    }

    public function checkForInputs() {
        if ($this->loginView->userWantsToLogin()) {
            $username = $this->loginView->getUsername();
            $password = $this->loginView->getPassword();

            $this->mainModel->setSessionUsername($username);
            
            if (empty($username)) {
                $message = $this->loginView->usernameIsMissing();
			}
			
			if ($username) {
				if (empty($password)) {
					$message = $this->loginView->passwordIsMissing();
				}	
            }
            
			if ($username && $password) {
                $this->mainModel->setSessionPassword($password);
                
				return $this->loginUser($username, $password);
            }	
            $this->mainModel->setMessage($message); 
        } elseif ($this->loginView->userWantsToLogOut()) {       
            $this->loginModel->setIsLoggedIn(false);
            $this->mainModel->unsetSessionUsername();

            $message = $this->loginView->byeByeMessage();
            
            $this->mainModel->setMessage($message);
        } 
    }


    private function loginUser($username, $password) {
        if ($this->loginModel->isUserInFile($username, $password)) {
            $this->loginModel->setIsLoggedIn(true);
            $message = $this->loginView->getWelcomeMessage(); 
        } else {
            $message = $this->loginView->wrongNameOrPassword();
        }
    
        $this->mainModel->setMessage($message); 
    }
}