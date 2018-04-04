<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/hw5/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/upload.php";
require_once ENGINE_DIR . "/db.php";

$id = $_GET['id'];
$image = query("SELECT * FROM image_data WHERE id = $id")[0];
$count = $image['views'];
$count++;
query("UPDATE image_data SET views = $count WHERE id = $id");
echo renderLayout('image.php', ['image' => $image]);
?>
