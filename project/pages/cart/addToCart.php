<?php
//если книг еще нет или такой книги нет, то добавляем
if (!$_SESSION['book'] || !in_array($_POST['id'], $_SESSION['book'])) {
    $_SESSION['book'][] = $_POST['id'];
    $message = ['status' => 'ok', 'message' => 'Item is added!'];
} else {
    $message = ['status' => 'ok', 'message' => 'Item is already in cart!'];
}

echo json_encode($message);
