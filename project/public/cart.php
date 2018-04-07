<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/db.php";
require_once ENGINE_DIR . "/users.php";


include_once PUBLIC_DIR . "/login.php";


session_start();

//если есть логин, то
if (isset($_SESSION['login'])) {

    $userName = $_SESSION['name'];

    //получаем информацию о добавленных книгах (сработал скрипт addToCart)
    if (isset($_SESSION['book'])) {
        //делаем запрос к БД на информацию о книгах, добавленных в корзину
        $books = getBooks($_SESSION['book']);
    } else {
        $books[0]['title'] = 'Cart is empty!';
    }

    //удаляем товары из корзины (сессии)
    if ($_POST['clear_cart']) {
        unset($_SESSION['book']);
        header('Location: cart.php');
    }

    //заносим товары в базу
    //пока не готово
    if ($_POST['submit_cart']) {
        var_dump($_SESSION);
        //query("");
    }

    //рендерим только корзину, передаем массив книг, имя пользователя и дату последнего входа
    echo renderLayout(['cart.php'], ['userName' => $userName, 'books' => $books, 'message' => $message]);

    //если логина нет, то форма логина с сообщением об ошибке
} else {
    echo renderLayout(['login.php'], ['message' => $message]);
}
