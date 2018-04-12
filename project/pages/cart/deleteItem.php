<?php
session_start();

$key = array_search($_POST['id'], $_SESSION['book']);

if (is_numeric($key)) {
    unset($_SESSION['book'][$key]);
    $message = 'ok';
} else {
    $message = 'error';
}

echo $message;
