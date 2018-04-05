<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/picture_gallery/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/db.php";

$books = getBooks();
$categories = query("SELECT * FROM category", null, BOOKS_DB);


$categoryId = $_GET['select'];

if ($categoryId) {
    $booksCat = array_filter($books, function ($book) use ($categoryId) {
        return $book['category_id'] == $categoryId;
    });
    echo renderLayout('catalog.php', ['books' => $booksCat, 'category' => $categories]);
} else {
    echo renderLayout('catalog.php', ['books' => $books, 'category' => $categories]);
}
