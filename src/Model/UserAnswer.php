<?php

namespace Model;

class UserAnswer {

    private $answers = array();

    public function add($toBeAdded) {
        
            $this->answers[] = $toBeAdded;
    }
    

    public function getAnswers() : array {
        return $this->answers;
    }
}