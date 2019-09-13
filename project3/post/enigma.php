<?php
require_once "../lib/enigma.inc.php";
//var_dump($_POST);
$controller = new \Enigma\EnigmaController($system, $_POST);
//echo $controller->showRedirect();
//header("location: " . $controller->getRedirect());
echo $controller->getResult();
