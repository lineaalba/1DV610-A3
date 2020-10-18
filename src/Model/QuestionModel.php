<?php

namespace Model;

class QuestionModel {
    private $title;
    private $answer;
    private $answerOptionTwo;
    private $answerOptionThree;
    private $answerOptionFour;

    public function __construct(string $title, string $answer, string $answerOptionTwo, string $answerOptionThree, string $answerOptionFour) {
    
        if (mb_strlen($title) < 1) {
            throw new \Exception("Title can not be empty.");
        }

        if (mb_strlen($answer) < 1) {
            throw new \Exception("Answer can not be empty.");
        }

        if (mb_strlen($answerOptionTwo) < 1) {
            throw new \Exception("AnswerOptionTwo can not be empty.");
        }

        if (mb_strlen($answerOptionThree) < 1) {
            throw new \Exception("AnswerOptionThree can not be empty.");
        }

        if (mb_strlen($answerOptionFour) < 1) {
            throw new \Exception("AnswerOptionFour can not be empty.");
        }

        $this->title = $title;
        $this->answer = $answer;
        $this->answerOptionTwo = $answerOptionTwo;
        $this->answerOptionThree = $answerOptionThree;
        $this->answerOptionFour = $answerOptionFour;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getAnswer() : string {
        return $this->answer;
    }

    public function getAnswerOptionTwo() : string {
        return $this->answerOptionTwo;
    }

    public function getAnswerOptionThree() : string {
        return $this->answerOptionThree;
    }

    public function getAnswerOptionFour() : string {
        return $this->answerOptionFour;
    } 
}