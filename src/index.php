<?php

require_once("Settings.php");
require_once("Controller/Application.php");

$settings = new Settings();
$Application = new \Controller\Application($settings);
// $Application->run();
$Application->login();
