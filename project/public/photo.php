<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/upload.php";
require_once ENGINE_DIR . "/db.php";

$id = $_GET['id'];
$image = query("SELECT * FROM image_data WHERE id = $id", 'one');

query("UPDATE image_data SET views = views + 1 WHERE id = $id");

include PUBLIC_DIR . '/comment.php';

echo renderLayout(['image.php', 'comment.php'], ['image' => $image, 'comments' => $comments]);
