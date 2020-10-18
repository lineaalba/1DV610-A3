<?php

namespace Model\DAL;

class HighscoreStorage {
	private $data;

	public function __construct(string $data) {
		$this->data = $data;
    }
    
    public function getScoresToShow() : \Model\HighscoreBank {

		$ret = new \Model\HighscoreBank();

		$file = scandir($this->data);

		foreach ($file as $fileName) {

			$fileRelativePath = $this->data . "/" . $fileName;
			if (is_file($fileRelativePath)) {
				
				$fileContentString = file_get_contents($fileRelativePath);

				$jsonObject = json_decode($fileContentString);
	
				$highscore = new \Model\HighscoreModel($jsonObject->user, $jsonObject->score);

				$ret->add($highscore);
			}
		}
		return $ret;

	}


}