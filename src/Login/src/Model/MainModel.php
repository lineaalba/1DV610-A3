<?php

namespace Model;

class MainModel {
    private static $SESSION_USERNAME = __CLASS__ . "::username";
    private static $SESSION_PASSWORD = __CLASS__ . "::password";
    private static $SESSION_MESSAGE = __CLASS__ . "::message";

    public function setMessage($message) {
        $_SESSION[self::$SESSION_MESSAGE] = $message;
    }
    
    public function getMessage() {
        if (isset($_SESSION[self::$SESSION_MESSAGE])) {
            return $_SESSION[self::$SESSION_MESSAGE];
        }
    }

    public function setSessionUsername($username) {
        $_SESSION[self::$SESSION_USERNAME] = $username;
    }

    public function getSessionUsername() {
        if (isset($_SESSION[self::$SESSION_USERNAME])) {
            return $_SESSION[self::$SESSION_USERNAME];
        } else {
            return '';
        }
    }

    public function setSessionPassword($password) {
        $_SESSION[self::$SESSION_PASSWORD] = $password;
    }
    
    public function unsetSession() {
		return session_unset();
    }

    public function unsetSessionMessage() {
        unset($_SESSION[self::$SESSION_MESSAGE]);
    }

    public function unsetSessionUsername() {
        unset($_SESSION[self::$SESSION_USERNAME]);
    }
}