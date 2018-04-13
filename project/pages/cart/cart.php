<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/autoLoad.php";
require_once PAGES_DIR . "/cart/login.php";

session_start();

//если есть логин, то
if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {

    sessionTime($_SESSION['start_time'], 1200);

    $userName = $_SESSION['name'];
    $userId = $_SESSION['id'];

    //если есть сохраненные заказы в БД, сохраняем их в сессию и выводим в корзине
    if ($order = getCart($userId)) {
//        var_dump($order);
        $books = $order;
        foreach ($order as $value) {
            if (!in_array($value['id'], $_SESSION['order'])) {
                $_SESSION['order'][] = $value['id'];
            }
        }
    }

    if ($userName == 'admin') {
        redirect('admin');
    }
    //получаем информацию о добавленных книгах (сработал скрипт addToCart)
    if (isset($_SESSION['book']) && !empty($_SESSION['book'])) {
        //делаем запрос к БД на информацию о книгах, добавленных в корзину
        $books = getBooks($_SESSION['book']);
    }

    //рендерим только корзину, передаем массив книг, имя пользователя и дату последнего входа
    echo renderLayout('cart.php', ['userName' => $userName, 'books' => $books]);

    //если логина нет, и если имя есть, то логин
    //если нет, то форма логина с сообщением об ошибке
} else {
    if (isset($_SESSION['name'])) {
        $message = $_SESSION['name'];
    }
    echo renderLayout('login.php', ['message' => $message]);
}
