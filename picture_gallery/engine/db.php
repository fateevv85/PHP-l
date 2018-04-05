<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/picture_gallery/config/main.php";
include_once ENGINE_DIR . '/render.php';

function query($queryArg, $number = null, $db = null)
{
    //если массив, то вносим значения в БД
    if (is_array($queryArg)) {

        ///преобразуем массив в переменные
        extract($queryArg);

        //проверяем, есть ли уже такое значение в БД
        $result = mysqli_fetch_all(executeQuery("SELECT * FROM image_data WHERE name = '$name'"));
        //если нет, передаем его в БД
        if (!$result) {
            executeQuery("INSERT INTO image_data (name, url, size, url_mini, size_mini)                                   VALUES ('$name', '$url', $size, '$urlMini', $sizeMini)");
        }

        //если строка, то делаем запрос
    } elseif (is_string($queryArg)) {
        //запрос на чтение
        if (substr($queryArg, 0, 6) == 'SELECT') {
            $result = $number == 'one' ?
                mysqli_fetch_all(executeQuery($queryArg, $db), MYSQLI_ASSOC)[0] :
                mysqli_fetch_all(executeQuery($queryArg, $db), MYSQLI_ASSOC);
            //если результат выборки корректный, то создаем массив с информацией об image ID
            return $result;
        } else {
            executeQuery($queryArg);
        }
    }
}

function executeQuery($query, $db = null)
{
    $result = htmlspecialchars(strip_tags($query));
    if ($db) {
        return mysqli_query(getConnection($db), $result);
    }
    return mysqli_query(getConnection(), $result);
}

function getConnection($dbName = IMAGES_DB)
{
    static $con = null;

    if (!$con) {
        $con = mysqli_connect(HOST, USER, PASSWORD, $dbName, PORT);
    }

    return $con;
//    mysqli_close($con);
}

function getGallery()
{
    return query("SELECT * FROM image_data ORDER BY views DESC");
}

function getComments($id) {
    return query("SELECT * FROM comments WHERE picture_id = $id ORDER BY Date DESC");
}

function getBooks() {
    return query("SELECT product.*, author.name AS `author` FROM product LEFT JOIN author ON product.author_id = author.id", null, BOOKS_DB);
}