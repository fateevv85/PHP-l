<?php
header('Content-type: text/html; charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/picture_gallery/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/upload.php";
require_once ENGINE_DIR . "/db.php";
?>

<?php
//загружаем файлы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    uploadImages();
}

$files = getGallery();

echo renderLayout('gallery.php', ['images' => $files]);
?>
