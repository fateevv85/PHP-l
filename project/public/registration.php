<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/db.php";
require_once ENGINE_DIR . "/users.php";

if ($_POST['new_registration']) {
    $newUser = $_POST;
    if (regUser($newUser)) {
        $message = 'User successfully create!';
    } else {
        $message = 'This login is already exist!';
    }
}

echo renderLayout('registration.php', ['message' => $message]);
