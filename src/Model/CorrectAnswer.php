<?php

namespace Model;

class CorrectAnswer {

    private $answers = array();

    public function add($toBeAdded) {
        
            $this->answers[] = $toBeAdded;
    }
    
    public function getCorrectAnswers() : array {
        return $this->answers;
    }
}