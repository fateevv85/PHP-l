<?php
header('Content-type: text/html; charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/autoLoad.php";

session_start();

if (!$path = preg_replace(["#^/#", "#[?].*#"], '', substr($_SERVER['REQUEST_URI'], 15))) {
    $path = '/product/catalog';
}

$pageName = PAGES_DIR . '/' . $path . '.php';

if (file_exists($pageName)) {
    include $pageName;
}
