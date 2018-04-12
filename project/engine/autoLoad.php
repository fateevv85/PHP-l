<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";

$files = scandir(ENGINE_DIR);
foreach ($files as $file) {
    if (!in_array(['.', '..', 'autoload.php'], $files)) {
        if (substr($file, -3) == 'php') {
            include_once ENGINE_DIR . DIRECTORY_SEPARATOR . $file;
        }
    }
}
