<?php

session_start();

//если книг еще нет или такой книги нет, то добавляем
if (!$_SESSION['book'] || !in_array($_GET['id'], $_SESSION['book'])) {
    $_SESSION['book'][] = $_GET['id'];
}

header('Location: book.php?id='.$_GET['id']);
