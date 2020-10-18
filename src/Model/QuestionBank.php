<?php

namespace Model;

class QuestionBank {
    private $questions = array();

    public function getAll() : array {
        return $this->questions;
    }

    public function add(QuestionModel $toBeAdded) {
        foreach ($this->questions as $question) {
            if ($question->getTitle() == $toBeAdded->getTitle()) {
                throw new \Exception("This question already exists in question bank");
            }
        }
        $this->questions[] = $toBeAdded;
    }
}