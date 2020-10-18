<?php

namespace Model;

class HighscoreBank {

    private $highscores = array();

    public function getAll() : array {
        return $this->highscores;
    }

    public function add(HighscoreModel $toBeAdded) {
        foreach ($this->highscores as $highscore) {
            // if ($highscore->getUsers() == $toBeAdded->getUsers()) {
            //     throw new \Exception("This user already exists in highscore list");
                
            // }
        }
        $this->highscores[] = $toBeAdded;
    }
}