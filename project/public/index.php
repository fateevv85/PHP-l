<?php
header('Content-type: text/html; charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . "/render.php";
require_once ENGINE_DIR . "/upload.php";
require_once ENGINE_DIR . "/db.php";

echo renderLayout('index.php');