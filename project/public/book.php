<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/picture_gallery/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/db.php";

$id = $_GET['id'];

$book = query("SELECT product.*, 
author.name AS `author`,
category.name AS `category`,
publisher.name AS `publisher` 
FROM product 
LEFT JOIN author ON product.author_id = author.id
LEFT JOIN category ON product.category_id = category.id
LEFT JOIN publisher ON product.publisher_id = publisher.id
WHERE product.id = $id", 'one', BOOKS_DB);

echo renderLayout('book.php', ['book' => $book]);
