<?php

namespace Model;

class HighscoreBank {
    private $highscores = array();

    public function getAll() : array {
        return $this->highscores;
    }

    public function add(HighscoreModel $toBeAdded) {
        foreach ($this->highscores as $highscore) {
        }
        $this->highscores[] = $toBeAdded;
    }
}