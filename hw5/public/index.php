<?php
header('Content-type: text/html; charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/hw5/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/upload.php";
require_once ENGINE_DIR . "/db.php";
?>

<!--<link rel="stylesheet" href="styles/main.css">-->

<!--
1. Создать галерею изображений, состоящую из двух страниц:
просмотр всех фотографий (уменьшенных копий);
просмотр конкретной фотографии (изображение оригинального размера) по ее ID в базе данных.
2. В базе данных создать таблицу, в которой будет храниться информация о картинках (адрес на сервере, размер, имя).
3. *На странице просмотра фотографии полного размера под картинкой должно быть указано число ее просмотров.
4. *На странице просмотра галереи список фотографий должен быть отсортирован по популярности. Популярность = число кликов по фотографии.
-->

<?php

$files = getGallery();

//загружаем файлы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    uploadImages(PUBLIC_DIR . '/img');
    query($files);
    $files = getGallery();
}

echo renderLayout('gallery.php', ['images' => $files]);
?>
