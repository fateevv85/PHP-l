<?php
header('Content-type: text/html; charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/autoLoad.php";

//загружаем файлы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    uploadImages();
}

$files = getGallery();

echo renderLayout('gallery.php', ['images' => $files]);
