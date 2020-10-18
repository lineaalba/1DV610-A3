<?php

namespace Model\DAL;

class UserSessionStorage {
    private static $sessionIndex = "UserSessionStorage::index";

    public function __construct() {
        if ($this->isSessionStarted() == FALSE) {
            throw new \Exception("Session must be started for UserSessionStorage class to work");
        }
    }

    public function getFromSessionOrEmpty() : \View\LoginView {
        if (isset($_SESSION[self::$sessionIndex])) {

            return unserialize($_SESSION[self::$sessionIndex]);
        }
        return new \View\LoginView();
    }

    public function saveToSessionStorage(\View\LoginView $toBeStored) {
        $userString = serialize($toBeStored);
        $_SESSION[self::$sessionIndex] = $userString;
    }

    // https://www.php.net/manual/en/function.session-start.php
    /**
    * @return bool
    */
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