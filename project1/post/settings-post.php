<?php
require_once "../lib/enigma.inc.php";
$controller = new \Enigma\SettingsController($system, $_POST);

echo "<pre>";
print_r($_POST);
print_r($_SESSION);
print_r($controller->getRedirect());
echo "</pre>";

header("location: " . $controller->getRedirect());