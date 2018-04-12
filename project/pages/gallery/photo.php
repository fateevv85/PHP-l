<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/autoLoad.php";

$id = $_GET['id'];
$image = query("SELECT * FROM image_data WHERE id = $id", '1');

query("UPDATE image_data SET views = views + 1 WHERE id = $id");

include PAGES_DIR . '/gallery/comment.php';

echo renderLayout(['image.php', 'comment.php'], ['image' => $image, 'comments' => $comments]);
