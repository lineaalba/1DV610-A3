<?php

namespace Model\DAL;

class FileQuestionStorage {

	private $data;

	public function __construct(string $data) {
		$this->data = $data;
	}


	public function getQuestionsToShow() : \Model\QuestionBank {

		$ret = new \Model\QuestionBank();

		$file = scandir($this->data);

		foreach ($file as $fileName) {

			$fileRelativePath = $this->data . "/" . $fileName;
			if (is_file($fileRelativePath)) {
				
				$fileContentString = file_get_contents($fileRelativePath);

				$jsonObject = json_decode($fileContentString);

				$question = new \Model\QuestionModel($jsonObject->title, $jsonObject->answer, $jsonObject->answerOptionTwo, $jsonObject->answerOptionThree, $jsonObject->answerOptionFour);

				$ret->add($question);
			}
		}
		return $ret;
	}
}