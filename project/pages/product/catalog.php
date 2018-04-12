<?php
$books = getBooks();
//считываем все категории из БД
$categories = query("SELECT * FROM category", null, BOOKS_DB);
$categoryId = $_GET['select'];

//если категория выбрана, то выбираем соответствующие товары
if ($categoryId) {
    $books = getCategories($categoryId);
}

echo renderLayout('catalog.php', ['books' => $books, 'category' => $categories]);
