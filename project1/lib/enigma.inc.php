<?php
require __DIR__ . "/../vendor/autoload.php";

// Start the PHP session system
session_start();

define("SYSTEM_SESSION", 'system');

// If there is a Guessing session, use that. Otherwise, create one
if(!isset($_SESSION[SYSTEM_SESSION])) {
    $_SESSION[SYSTEM_SESSION] = new Enigma\System(new Enigma\Enigma());
}

$system = $_SESSION[SYSTEM_SESSION];
$system->setRoot('/~xuchensh/project1');

if(!isset($open) && $system->getUsername() === ''){
    $root = $system->getRoot();
    header("location: $root/");
    exit;
}