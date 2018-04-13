<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/autoLoad.php";

session_start();

$user = $_SESSION['id'];

if ($_POST['cart'] == 'clear') {
    query("DELETE FROM order_products WHERE customer_id = {$user}", '', BOOKS_DB);

    unset($_SESSION['book']);
}

echo 'Cart is cleared!';
