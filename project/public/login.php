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
        $_SESSION['start_time'] = time();
        header('Location: cart.php');
        //если нажата кнопка logout, уничтожаем сессию
    } elseif ($_POST['logout']) {
        session_start();
        $_SESSION = array();
        session_destroy();
        //если пользователя нет, то сообщение
    } else {
        $message = 'Incorrect login/password!';
    }
}
