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

    // public function addUser($toBeAdded) {
        
    //     $this->users[] = $toBeAdded;
    // }

    // public function addScore($toBeAdded) {
        
    //     $this->scores[] = $toBeAdded;
    // }


    public function getUser() : string {
        return $this->user;
    }

    public function getScore() : string {
        return $this->score;
    }


    // public function __construct(string $user, string $score) {
    
    //     if (mb_strlen($user) < 1) {
    //         throw new \Exception("User can not be empty.");
    //     }

    //     if (mb_strlen($score) < 0) {
    //         throw new \Exception("Score can not be under 0.");
    //     }

    //     $this->user = $user;
    //     $this->score = $score;
    // }

    // public function getUser() : string {
    //     return $this->user;
    // }

    // public function getScore() : string {
    //     return $this->score;
    // }
}