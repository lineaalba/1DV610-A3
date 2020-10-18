<?php

namespace Model;

class LoginModel {
    private static $SESSION_LOGGEDIN = __CLASS__ . "::loggedin";
    private static $SESSION_BROWSER_INFO = __CLASS__ . "::browserInfo";
    private static $USER_AGENT = 'HTTP_USER_AGENT';

    public function setIsLoggedIn($isLoggedIn) {
        $_SESSION[self::$SESSION_BROWSER_INFO] = $_SERVER[self::$USER_AGENT];
		$_SESSION[self::$SESSION_LOGGEDIN] = $isLoggedIn;
    }

    public function isLoggedIn() : bool {
		if(isset($_SESSION[self::$SESSION_LOGGEDIN]) && $_SESSION[self::$SESSION_LOGGEDIN] == true && isset($_SESSION[self::$SESSION_BROWSER_INFO]) && $_SESSION[self::$SESSION_BROWSER_INFO] == $_SERVER[self::$USER_AGENT]) {
            return true;
        } else {
            return false;
		}
    }

    // https://stackoverflow.com/questions/42721005/php-checkin-if-username-and-password-are-correct-from-txt-file
    public function isUserInFile($username, $password) : bool {
        $credentials = $username . ":" . $password . "\n";
        $file = "Login/data/accounts.txt";
  
        $contents = file_get_contents($file);
        $pattern = preg_quote($credentials, '/');
        $pattern = "/^.*$pattern.*\$/m";
                
        if (preg_match_all($pattern, $contents, $matches)) {
			return true;
        } else {
            return false;
        }
    }
}