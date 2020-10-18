<?php

namespace View;

require_once('Login/src/View/RegisterView.php');
require_once('Login/src/Model/RegisterModel.php');
require_once('Login/src/Model/MainModel.php');

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $username = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $registerView;
	private $mainModel;
   
    public function __construct() {
		$this->registerView = new \View\RegisterView();
		$this->mainModel = new \Model\MainModel();
	}
	
	public function showLink($isLoggedIn) {
		if (!$isLoggedIn) {
            if ($this->registerView->userClicksRegisterLink() == false && $this->registerView->userWantsToRegister() == false) {
                return $this->registerView->registerNewUserLink();
            } elseif ($this->registerView->userClicksRegisterLink() == true) {
				return '<a href="/">Back to login</a>';
            } elseif ($this->registerView->userWantsToRegister() && $this->mainModel->getMessage() != $this->registerView->newUserRegistredMessage()) {
				return '<a href="/">Back to login</a>';
            } elseif ($this->registerView->userWantsToRegister() && $this->mainModel->getMessage() == $this->registerView->newUserRegistredMessage()) {
                return $this->registerView->registerNewUserLink();
            }
        } elseif ($isLoggedIn) {
            return '';
        }
    }

    public function showLink($isLoggedIn) {
        if (!$isLoggedIn) {
            if ($this->registerView->userClicksRegisterLink()) {
                return '<a href="/">Back to login</a>';
            } elseif (!$isLoggedIn || $this->userWantsToLogout()) {
                return = $this->registerView->registerNewUserLink();
            }
        }
    }

    public function renderIsLoggedIn($isLoggedIn) {
        if (!$isLoggedIn) {
            return '<h2>Not logged in</h2>';
        } else {
            return '<h2>Logged in</h2>';
        }
    }

    public function userWantsToLogin() : bool {
		if (isset($_POST[self::$login])) {
			return true;
		} else {
			return false;
		}
    }
    
	public function getUsername() {
		return $_POST[self::$username];
    }
    
	public function getPassword() {
		return $_POST[self::$password];
    }
    
    public function usernameIsMissing() {
		return 'Username is missing';
	}

	public function passwordIsMissing() {
		return 'Password is missing';
    }
    
    public function getWelcomeMessage() {
		return 'Welcome';
	}

	public function wrongNameOrPassword() {
		if (isset($_POST[self::$login])) {
			return 'Wrong name or password';
		}
    }

    public function userWantsToLogOut() : bool {
        if (isset($_POST[self::$logout]) && $_POST[self::$logout] == true) {
			return true;
		} else {
			return false;
		}
    }
    
    public function byeByeMessage() {
		if ($this->userWantsToLogOut()) {
			return 'Bye bye!';
		}
    }

    public function generateLoginFormHTML($username, $message) {
		$_POST[self::$username] = $username;
		$this->mainModel->unsetSession();

		return '
			<form action="/" method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$username . '">Username :</label>
					<input type="text" id="' . self::$username . '" name="' . self::$username . '" value="' . (isset($_POST[self::$username]) ? $_POST[self::$username] : "") . '" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
    }
    
    public function generateLogoutButton($message) {
		$this->mainModel->unsetSessionMessage();
        return '
			<form method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
    }
}