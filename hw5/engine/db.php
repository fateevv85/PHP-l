<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hw5/config/main.php";
include_once ENGINE_DIR . '/render.php';

function connect($param, $close = false)
{
    //если флаг 'close', то закрываем соединение
    if ($close) {
        return mysqli_close(mysqli_connect(HOST, USER, PASSWORD, $param, PORT));
    }
    return mysqli_connect(HOST, USER, PASSWORD, $param, PORT);
}

function query($queryArg, $db = IMAGES_DB)
{
    $con = connect($db);
    //если массив, то вносим значения в БД
    if (is_array($queryArg)) {
        //CALLBACK!
        $name = $_FILES['files']['name'];
        //проверяем, есть ли уже такое значение в БД
        $result = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM image_data WHERE name = '$name'"));
        //если нет, получаем информацию об этом файле, и передаем его в БД
        if (!$result) {
            $image = getImageInfo($name);
            mysqli_query($con, "INSERT INTO image_data (name, url, size, url_mini, size_mini, views) VALUES ('$image[0]', '$image[1]', $image[2], '$image[3]', $image[4], 0)");
        }
        //если строка, то делаем запрос
    } elseif (is_string($queryArg)) {
        //защита от инъекций - экранируем кавычки, меняем спец символы, убираем тэги
//        $inputText = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_GET['textId'])));
        //запрос на чтение
        if (substr($queryArg,0,6) == 'SELECT' ) {
            $result = mysqli_fetch_all(mysqli_query($con, $queryArg), MYSQLI_ASSOC);
            //если результат выборки корректный, то создаем массив с информацией об image ID
            return $result;
        } else {
            mysqli_query($con, $queryArg);
        }

    }
    mysqli_close($con);
}

function getGallery()
{
    return query("SELECT * FROM image_data ORDER BY views DESC");
}
