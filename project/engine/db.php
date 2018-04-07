<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
include_once ENGINE_DIR . '/render.php';

/**
 * @param $queryArg
 * принимает массив или строку
 * @param null $number
 * если 1 - то возращает только первую строку запроса
 * @param null $db
 * если указано, то БД, отличная от image
 * @return array|null
 */
function query($queryArg, $number = null, $db = null)
{
    //если массив, то вносим значения в БД
    if (is_array($queryArg)) {
        //преобразуем массив в переменные
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
            $result = $number == '1' ?
                mysqli_fetch_all(executeQuery($queryArg, $db), MYSQLI_ASSOC)[0] :
                mysqli_fetch_all(executeQuery($queryArg, $db), MYSQLI_ASSOC);
            //если результат выборки корректный, то создаем массив с информацией об image ID
            return $result;
        } else {
            executeQuery($queryArg, $db);
        }
    }
}

//выполнение запроса, работает в функции query
/**
 * @param $query
 * запрос
 * @param null $db
 * если указано, то БД, отличная от image
 * @return bool|mysqli_result
 */
function executeQuery($query, $db = null)
{
    $result = htmlspecialchars(strip_tags($query));
    $connect = $db ? getConnection($db) : getConnection();

    return mysqli_query($connect, $result);
}

/** устанавливает соединение
 * @param string $dbName
 * БД, отличная от image
 * @return mysqli|null
 */
function getConnection($dbName = IMAGES_DB)
{
    static $con = null;

    if (!$con) {
        $con = mysqli_connect(HOST, USER, PASSWORD, $dbName, PORT);
    }

    return $con;
}

/** возвращает массив с данными о всех изображениях
 * @return array|null
 */
function getGallery()
{
    return query("SELECT * FROM image_data ORDER BY views DESC");
}

function getComments($id)
{
    return query("SELECT * FROM comments WHERE picture_id = $id ORDER BY Date DESC");
}

/** возращает информацию о книгах, добавленных в текущей сессии
 * @param null $number
 * может быть или числом - одна книга
 * или массивом - несколько книг
 * или без параметра - все книги в БД
 * @return array|null
 * результат запроса
 */
function getBooks($number = null)
{
    //чтобы не делать несколько функций, я модифицирую запрос с помошью переменных
    $count = null;
    $fields = "SELECT product.*, ";

    if (is_numeric($number)) {
        $string = " WHERE product.id = $number";
        $count = 1;
    } elseif (is_array($number)) {
        $fields = "SELECT product.title, ";
        $string = " WHERE product.id IN (" . implode(',', $number) . ")";
    } else {
        $string = null;
    }

    return query($fields .
        "author.name AS `author`,
        publisher.name AS `publisher`,
        category.name AS `category`
        FROM product 
        LEFT JOIN author ON product.author_id = author.id
        LEFT JOIN publisher ON product.publisher_id = publisher.id
        LEFT JOIN category ON product.category_id = category.id" . $string, $count, BOOKS_DB);
}

/** возращает сохраненную в БД корзину
 * @return array|null
 */
function getCart()
{
    return query("SELECT product.id, product.title, order_products.customer_id, 
                                    product.price, customers.name as `customer`, author.name as `author`, 
                                    publisher.name as `publisher` from product
inner join order_products on product.id = order_products.product_id
inner join customers on order_products.customer_id = customers.id
inner join author on product.author_id = author.id
inner join publisher on product.publisher_id = publisher.id  where order_products.customer_id = {$_SESSION['id']}", '', BOOKS_DB);
}
