<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/hw5/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/upload.php";
require_once ENGINE_DIR . "/db.php";

$id = htmlspecialchars(strip_tags($_GET['id']));

$image = query("SELECT * FROM image_data WHERE id = $id", 'one');

query("UPDATE image_data SET views = views + 1 WHERE id = $id");

echo renderLayout('image.php', ['image' => $image]);
?>
