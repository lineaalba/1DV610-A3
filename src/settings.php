<?php

session_start();

class Settings {
	private static $quesitionDataFolder = "../data/questions";
	private static $highscoreDataFolder = "../data/highscores";

	public function getDataFolder() : string {
		return self::$quesitionDataFolder;
	}

	public function getHighscoreFolder() : string {
		return self::$highscoreDataFolder;
	}
}