<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/db.php";

$id = $_GET['id'];

$book = getBooks($id);

echo renderLayout('book.php', ['book' => $book]);
