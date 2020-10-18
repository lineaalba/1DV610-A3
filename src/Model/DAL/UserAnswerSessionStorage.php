<?php

namespace Model\DAL;

class UserAnswerSessionStorage {

    private static $sessionIndex = "UserAnswerSessionStorage::index";

    public function __construct() {
        if ($this->isSessionStarted() == FALSE) {
            throw new \Exception("Session must be started for UserAnswerSessionStorage class to work");
        }
    }

    public function getFromSessionOrEmpty() : \Model\UserAnswer {
        if (isset($_SESSION[self::$sessionIndex])) {
            return unserialize($_SESSION[self::$sessionIndex]);
        }
        
        return new \Model\UserAnswer();
    }

    public function saveToSessionStorage(\Model\UserAnswer $toBeStored) {
        $userAnswerString = serialize($toBeStored);
        $_SESSION[self::$sessionIndex] = $userAnswerString;
    }

    private function isSessionStarted() {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }
}