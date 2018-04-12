<?php
$id = $_GET['id'];
$book = getBooks($id);
echo renderLayout('book.php', ['book' => $book]);
