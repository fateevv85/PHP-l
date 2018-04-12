<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/autoLoad.php";


session_start();

if ($_SESSION['account'] == 'admin') {

    sessionTime($_SESSION['start_time'], 1200);

    if($_POST['insert']) {

        $arr = $_POST['query'];
        /*
        $arr[] = uploadBooksImages();
        addBook($arr);
        */
    }

    if ($_POST['logout']) {
        logout();
    }

    echo renderLayout('admin.php', ['arr' => $arr]);

} else {
    redirect('cart');
}


