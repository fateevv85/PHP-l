<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/picture_gallery/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/db.php";

$books = getBooks();

echo renderLayout('catalog.php', ['books' => $books]);
