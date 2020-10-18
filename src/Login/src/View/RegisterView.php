<?php

namespace View;

class RegisterView {
    private static $messageId = 'RegisterView::Message';
    private static $username = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $registerLink = 'register';
    private static $register = 'RegisterView::Register';

    public function userClicksRegisterLink() : bool {
        if (isset($_GET[self::$registerLink])) {
            return true;
        } else {
            return false;
        }
    }

    public function userWantsToRegister() : bool {
        if (isset($_POST[self::$register])) {
            return true;
        } else {
            return false;
        }
    }

    public function getUsername() {
        if (isset($_POST[self::$username])) {
            return $_POST[self::$username];
        }
    }

    public function getPassword() {
        if (isset($_POST[self::$password])) {
            return $_POST[self::$password];
        }
    }

    public function getRepeatedPassword() {
        if (isset($_POST[self::$passwordRepeat])) {
            return $_POST[self::$passwordRepeat];
        }
    }
    
    public function registerNewUserLink() {
        return  '<a href="?' . self::$registerLink . '">Register a new user</a>';
    }

    public function generateRegisterFormHTML($message) { 
        $mainModel = new \Model\MainModel();
        $mainModel->unsetSession();
        
        return '
            <h2>Register new user</h2>
            <form method="post" action="/"> 
                <fieldset>
                     <legend>Register a new user - Write username and password</legend>
                     <p id="' . self::$messageId . '">' . $message . '</p>
                     
                     <label for="' . self::$username . '">Username :</label>
                     <input type="text" id="' . self::$username . '" name="' . self::$username . '" value="' . (isset($_POST[self::$username]) ? $_POST[self::$username] : "") . '" />
                     <br>
 
                     <label for="' . self::$password . '">Password :</label>
                     <input type="password" id="' . self::$password . '" name="' . self::$password . '" value />
                     <br>
 
                     <label for="' . self::$passwordRepeat . '">Repeat password :</label>
                     <input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" value="" />
                     <br>
                     <input type="submit" name="' . self::$register . '" value="Register" />
                </fieldset>
            </form>
         ';
    }

    public function containsInvalidCharacters($username) : bool {
        if (strrchr($username, "<") || strrchr($username, ">") || strrchr($username, "/")) {
            return true;
        } else {
            return false;
        }
    }

    public function invalidCharactersMessage() {
        return 'Username contains invalid characters.';
    }

    public function noInputsMessage() {
        return 'Username has too few characters, at least 3 characters.<br>
        Password has too few characters, at least 6 characters.<br>
        User exists, pick another username.';
    }

    public function tooShortUsernameMessage() {
        return 'Username has too few characters, at least 3 characters.<br>';
    }

    public function tooShortPasswordMessage() {
        return 'Password has too few characters, at least 6 characters.<br>';
    }

    public function passwordsDoNotMatchMessage() {
        return 'Passwords do not match.<br>';
    }

    public function userExistsMessage() {
        return 'User exists, pick another username.';
    }

    public function newUserRegistredMessage() {
        return 'Registered new user.';
    }
}