<?php
//отправляем логин и пароль в БД
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $pass = $_POST['password'];
    //если такой пользователь есть, то
    if ($user = getUser($login, $pass)) {
        $message = 'Your login: ' . $user['login'] . '<br>'
            . 'last login: ' . $user['last_login'];
        //записываем в сессию логин и ИД
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['name'] = $user['name'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['account'] = $user['account'];
        $_SESSION['start_time'] = time();
        if ($user['account'] == 'user') {
            redirect('cart');
        } elseif ($user['account'] == 'admin') {
            redirect('admin');
        }
        //если нажата кнопка logout, уничтожаем сессию
    } elseif ($_POST['logout']) {
        logout();
        //если пользователя нет, то сообщение
    } else {
        $message = 'incorrect_login';
    }
}
