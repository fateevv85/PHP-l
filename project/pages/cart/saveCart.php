<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/autoLoad.php";

session_start();
//получаем ID пользователя
$user = $_SESSION['id'];

//удаляем предыдущий заказ этого пользователя в БД
query("DELETE FROM order_products WHERE customer_id = {$user}", '', BOOKS_DB);


//преобразовываем массив с ID товара и количеством в строку, чтобы далее вставить в запрос.
foreach ($_POST['order'] as $key => $value) {
    $string[] = "($user, {$value['id']},  {$value['count']})";
}

$string = implode(', ', $string);

query("INSERT INTO order_products 
        (customer_id, product_id, count) 
VALUES $string", null, BOOKS_DB);

echo "{$_SESSION['name']}, your cart is saved!";
