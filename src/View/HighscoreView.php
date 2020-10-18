<?php

namespace View;

class HighscoreView {
    private $highscoreModel;

    public function __construct(\Model\HighscoreModel $toBeShown) {
        $this->highscoreModel = $toBeShown;
    }

    public function getHighscoreHTML() : string {
        $user = $this->highscoreModel->getUser();
        $score = $this->highscoreModel->getScore();
        $array = array();
   
        $array[$user] = $score;
    
        foreach($array as $key => $value) {
            return '
            <div>
                <h4>' . $key . ' : ' . $value . '</h4>
            </div>';
            
          }
    }
}