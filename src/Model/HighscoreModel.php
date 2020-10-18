<?php

namespace Model;

class HighscoreModel {

    private $user;
    private $score;

    public function __construct(string $user, string $score) {
    
        if (mb_strlen($user) < 1) {
            throw new \Exception("User can not be empty.");
        }

        if (mb_strlen($score) < 1) {
            throw new \Exception("Score can not be empty.");
        }

        $this->user = $user;
        $this->score = $score;
    }

    public function getUser() : string {
        return $this->user;
    }

    public function getScore() : string {
        return $this->score;
    }
}