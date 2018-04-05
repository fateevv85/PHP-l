<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/picture_gallery/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/upload.php";
require_once ENGINE_DIR . "/db.php";

$id = $_GET['id'];

$image = query("SELECT * FROM image_data WHERE id = $id", 'one');

query("UPDATE image_data SET views = views + 1 WHERE id = $id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    query("INSERT INTO comments (name, content, picture_id) 
                      VALUES ('$name', '$comment', '$id')");
}

$comments = getComments($id);

echo renderLayout(['image.php', 'comment.php'], ['image' => $image, 'comments' => $comments]);
?>
