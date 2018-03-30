<?php

//удаление непустой директории
function removeDir($path)
{
    //если аргумент - это папка, то отбрасывем точки,
    if (is_dir($path) && $path != '.' && $path != '..') {
        //открываем ее
        $dir = opendir($path);
        //пока в ней что-то есть (кроме точек), запускаем рекурсивно нашу функцию
        while ($file = readdir($dir)) {
            if ($file != '.' && $file != '..') {
                removeDir($path . '/' . $file);
            }
        }
        //закрываем поток
        closedir($dir);
        //удаляем папку с выводом сообщения
        rmdir($path);
        echo "dir <b> {$path} </b> is delete!<br>";
    //если аргумент - это файл, то удаляем его
    } elseif
    (is_file($path)) {
        echo "file {$path} is delete <br>";
        unlink($path);
    //в случае ошибки (аргумент не существует)
    } else {
        return print "incorrect argument: '{$path}'";
    }
}

?>
