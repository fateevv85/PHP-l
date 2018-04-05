<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/picture_gallery/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/db.php";

$books = getBooks();

//считываем все категории из БД
$categories = query("SELECT * FROM category", null, BOOKS_DB);

//добавляем в начало пункт 'All categories'
array_unshift($categories, ['id' => 0, 'name' => 'All categories']);

$categoryId = $_GET['select'];

//если категория выбрана, то выбираем соответсвующие товары
if ($categoryId) {
    $booksCat = array_filter($books, function ($book) use ($categoryId) {
        return $book['category_id'] == $categoryId;
    });
    echo renderLayout('catalog.php', ['books' => $booksCat, 'category' => $categories]);
    //если нет, то все
} else {
    echo renderLayout('catalog.php', ['books' => $books, 'category' => $categories]);
}
