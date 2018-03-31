<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hw5/config/main.php";
require_once ENGINE_DIR . "/functions.php";

function connect($close = '')
{
    //если флаг 'close', то закрываем соединение
    if ($close == 'close') {
        return mysqli_close(mysqli_connect(HOST, USER, PASSWORD, 'images', PORT));
    }

    return mysqli_connect(HOST, USER, PASSWORD, 'images', PORT);
}


function query()
{
    //если запрос POST, то обновляем БД
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //соединяемся
        $con = connect();
        //получаем массив информации об изображениях
        $imgArray = imgPathArray();

        mysqli_query($con, "DELETE FROM image_data WHERE 1 = 1");
        //передаем его в БД
        foreach ($imgArray as $key => $value) {
            mysqli_query($con, "INSERT INTO image_data (url, name, size, size_mini, url_mini, name_mini, views) VALUES ('$value[1]', '$value[3]', $value[5], $value[4], '$value[0]','$value[2]',  0)");
        }

        $result = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM image_data WHERE 1 = 1"), MYSQLI_ASSOC);

        return $result;
        //если GET, то считываем ID
    } else {
        $con = connect();
            //защита от инъекций - экранируем кавычки, меняем спец символы, убираем тэги
            $inputText = mysqli_real_escape_string($con, htmlspecialchars(strip_tags($_GET['textId'])));
            //запрос на чтение
            $result = mysqli_query($con, "SELECT * FROM image_data WHERE id = {$inputText}");
            //если результат выборки корректный, то создаем массив с информацией об image ID
            if ($result) {
                return mysqli_fetch_all($result, MYSQLI_ASSOC);
            } else {
                return 'wrong query!';
            }
    }
}
