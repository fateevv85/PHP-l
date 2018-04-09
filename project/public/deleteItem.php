<?php

session_start();

$key = array_search(key($_POST), $_SESSION['book']);

unset($_SESSION['book'][$key]);

header('Location: cart.php');

