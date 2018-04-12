<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/autoLoad.php";

session_start();
//получаем ID пользователя
$user = $_SESSION['id'];

//преобразовываем массив с ID товара и количеством в строку, чтобы далее вставить в запрос.
foreach ($_POST['arr'] as $key => $value) {
    $string[] = "($user, {$value['id']},  {$value['count']})";
}

$string = implode(', ', $string);

query("INSERT INTO order_products 
        (customer_id, product_id, count) 
VALUES $string", null, BOOKS_DB);
