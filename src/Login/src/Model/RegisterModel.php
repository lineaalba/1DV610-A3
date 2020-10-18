<?php

namespace Model;

class RegisterModel {
    private static $SESSION_USERNAME = __CLASS__ . "::username";
    private static $USERNAME_MIN_LENGTH = 3;
    private static $PASSWORD_MIN_LENGTH = 6;

    public function removeInvalidCharacters($username) {
        $username = strip_tags($username);
        return $username;
    }

    public function noUserInputs($username, $password) : bool {
        if (strlen($username) == 0 && strlen($password) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tooShortUsername($username) : bool {
        if (strlen($username) < self::$USERNAME_MIN_LENGTH) {
            return true;
        } else {
            return false;
        }
    }

    public function tooShortPassword($password) : bool {
        if (strlen($password) < self::$PASSWORD_MIN_LENGTH) {
            return true;
        } else {
            return false;
        }
    }

    public function noRepeatedPassword($repeatedPassword) : bool {
        if (empty($repeatedPassword)) {
            return true;
        } else {
            return false;
        }
    }

    public function passwordsDoNotMatch($password, $repeatedPassword) : bool {
        if ($repeatedPassword != $password) {
            return true;
        } else {
            return false;
        }
    }

    public function userExists($username) : bool {
        $accountsFile = "Login/data/accounts.txt";

        $contents = file_get_contents($accountsFile);
        $pattern = preg_quote($username, "/");
        $pattern = "/^.*$pattern.*\$/m";

        if (preg_match_all($pattern, $contents, $matches)) {
            return true;
        } else {
            return false;
        }
    }

    public function saveUserToFile($username, $password) {
        $credentials = $username . ":" . $password . "\n";

        $file = fopen('Login/data/accounts.txt', 'a+');
        fwrite($file, $credentials);
        fclose($file);
    }
}