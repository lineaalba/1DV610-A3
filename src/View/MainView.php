<?php

namespace View;

require_once("HighscoreView.php");

class MainView {

    private $highscoresToBeShown;

    public function __construct(\Model\HighScoreBank $toBeShown) {
        $this->highscoresToBeShown = $toBeShown;
    }

    public function echoMainHTML() {
        $highscoreBankHTML = $this->getHighscoreBankHTML();

        echo $highscoreBankHTML;
    }

    private function getHighscoreBankHTML() : string {
        $highscoresToShow = $this->highscoresToBeShown->getAll();
        $highscoreViews = array();
        foreach ($highscoresToShow as $highscore) {
            $highscoreViews[] = new HighscoreView($highscore);
        }
        $ret = "";
        foreach ($highscoreViews as $hview) {
           
            $ret .= $hview->getHighscoreHTML();
        }
        
        return "<br><h3>PHP Quiz Highscore list</h3> $ret <br> <h4>=> Log in to try it out!</h4>";
    }
}