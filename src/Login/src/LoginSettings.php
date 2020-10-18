<?php

// session_start();

class LoginSettings {

	private static $dataFolder = "data/accounts.txt";

	public function getDataFolder() : string {
		return self::$dataFolder;
	}
}