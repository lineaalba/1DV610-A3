<?php

namespace View;

class StartButtonView {
    private static $start = __CLASS__ . '::start';

    public static function userWantsToStartQuiz() : bool {
        if (isset($_POST[self::$start])) {
            return true;
        } else {
            return false;
        }
    }

    public function getStartButtonHTML() : string {
       return ' 
            <div>
                <form action="" method="post" > 
                    <input type="submit" name="' . self::$start . '" value="Start quiz">
                </form>   
            </div>
        ';
    }
}