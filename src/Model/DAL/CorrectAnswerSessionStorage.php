<?php

namespace Model\DAL;

class CorrectAnswerSessionStorage {

    private static $sessionIndex = "CorrectAnswerSessionStorage::index";

    public function __construct() {
        if ($this->isSessionStarted() == FALSE) {
            throw new \Excetion("Session must be started for CorrectAnswerSessionStorage class to work");
        }
    }

    public function getFromSessionOrEmpty() : \Model\CorrectAnswer {
        if (isset($_SESSION[self::$sessionIndex])) {
            return unserialize($_SESSION[self::$sessionIndex]);
        }
        
        return new \Model\CorrectAnswer();
    }

    public function saveToSessionStorage(\Model\CorrectAnswer $toBeStored) {
        $correctAnswerString = serialize($toBeStored);
        $_SESSION[self::$sessionIndex] = $correctAnswerString;
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