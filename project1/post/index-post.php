<?php
$open = true;
require_once "../lib/enigma.inc.php";
$controller = new \Enigma\IndexController($system, $_POST);
header("location: " . $controller->getRedirect());