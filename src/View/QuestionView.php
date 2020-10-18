<?php

namespace View;

class QuestionView {
    private static $next = __CLASS__ . '::next';
    private static $radio = __CLASS__ . '::radio';
   
    public static function next() {
        return isset($_POST[self::$next]);
    }

    public static function getUserAnswer(){
        if (isset($_POST[self::$radio])) {
            return $_POST[self::$radio];
        }
    }

    private $questionModel;
    private $answer;

    public function __construct(\Model\QuestionModel $toBeShown) {
        $this->questionModel = $toBeShown;
    }

    // public static function getCorrectAnswer() {
    //     return $this->answer;
    // }

    public function getQuestionHTML() : string {
        $title = $this->questionModel->getTitle();
        $answer = $this->questionModel->getAnswer();
        $answerOptionTwo = $this->questionModel->getAnswerOptionTwo();
        $answerOptionThree = $this->questionModel->getAnswerOptionThree();
        $answerOptionFour = $this->questionModel->getAnswerOptionFour();
        
        $array = array();
        array_push($array, $answer, $answerOptionTwo, $answerOptionThree, $answerOptionFour);
        $answer = $array[0];

        $this->answer = $answer;

        shuffle($array);
       
        return '
        <div>
            <h3>' . $title . '</h3>
        </div>
        <div>
            <form action="" method="post" > 
                <label><input type="radio" name="' . self::$radio . '" value="' . $array[0] . '">' . $array[0] . '</label>
                <br>
                <label><input type="radio" name="' . self::$radio . '" value="' . $array[1] . '">' . $array[1] . '</label>
                <br>
                <label><input type="radio" name="' . self::$radio . '" value="' . $array[2] . '">' . $array[2] . '</label>
                <br>
                <label><input type="radio" name="' . self::$radio . '" value="' . $array[3] . '">' . $array[3] . '</label>
                <br><br>
                <input type="submit" name="' . self::$next . '" value="Next">
            </form>   
        </div>         
        ';
    }
}