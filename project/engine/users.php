<?php

//дл яформы логина
function getUser($login, $pass)
{
    //если пользователь есть, то
    if ($user = query("SELECT * FROM customers WHERE login = '$login' AND password = '$pass'", 1, BOOKS_DB)) {
        //обновляем дату входа
        query("UPDATE customers SET last_login = CURRENT_TIMESTAMP 
                        WHERE id = {$user['id']}");
    }

    return $user;
}

//регистрация пользователя
function regUser($data)
{

    $login = $data['new_login'];
    $pass = $data['new_pass'];

    //проверка на существование логина
    if (query("SELECT * FROM customers WHERE login = '$login'", 1, BOOKS_DB)) {
        $res = false;
    } else {
        //если такого нет, то вносим в БД
        query("INSERT INTO customers 
(login, password, name, phone, e_mail) 
VALUES ('$login', '$pass', '{$data['new_name']}', {$data['new_phone']}, '{$data['new_mail']}')");
        $res = true;
    }

    return $res;
}
