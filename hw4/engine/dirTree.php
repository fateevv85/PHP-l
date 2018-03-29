<?php

//вывод директории в виде дерева
function dirTree($path)
{
    //если аргумент - это папка, то
    if (is_dir($path)) {
        //создаем список
        $dir = opendir($path);
        //пока есть файл или папка
        while ($file = readdir($dir)) {
            //если вложенный элемент- папка, не включая "." и ".."
            if (is_dir($path . '/' . $file) && $file != '.' && $file != '..') {
                //выводим на печать имя папки
                echo "<li>
                        <!--папки выделяем жирным и подчеркиванием -->
                        <b><u> {$file} </u></b>
                        <!-- открываем тэг для нового списка -->
                        <ul>
                      </li>";
                // и рекурсивно запускаем функцию
                dirTree($path . '/' . $file);
            //если не папка, то добавляем в массив
            } elseif ($file != '.' && $file != '..') {
                //как новый элемент списка
                $arr[] = "<li>{$file}</li>";
            }
        }
        //после прохождения цикла закрываем список
        $arr[] = "</ul>";
        //выводим на печать
        echo implode($arr);
        //если не папка, то просто выводим на печать
    } else {
        $arr[] = "<li>{$path}</li>";
    }
}

dirTree('../');
