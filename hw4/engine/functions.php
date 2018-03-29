<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/hw4/config/main.php";
include_once ENGINE_DIR . '/funcImgResize.php';

//функция загрузки картинок
function uploadFiles()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['file'])) {
            foreach ($_FILES['file']['type'] as $key => $item) {

                $fileType = explode('/', $item)[0];
                $tmp = $_FILES['file']['tmp_name'][$key];
                $fileName = $_FILES['file']['name'][$key];
                //меняем имя для мини-версии, для удобства
                $fileNameSmall = sprintf('small-%s', $fileName);
                $fileSize = $_FILES['file']['size'][$key];
                //пути для копирования изображений
                $destImgSmall = IMAGES_SMALL_DIR . '/' . $fileNameSmall;
                $destImgOriginal = IMAGES_ORIG_DIR . '/' . $fileName;

                //проверка на тип файла и размер
                if ($fileType == 'image' && $fileSize <= 10e6) {
                    //мини версию копируем в images/small
                    img_resize($tmp, $destImgSmall, 200, 200);
                    //оригинал перемещаем в images/original
                    move_uploaded_file($tmp, $destImgOriginal);
                    //формируем отчет об выполнении
                    $message[] = "<span class='upload_form__good'>" .
                        '"' . $fileName . '"' . "</span>" . ' is uploaded!';
                    //если проверка не пройдена, появятся соответствующие сообщения
                } elseif ($fileType != 'image') {
                    $message[] = "<span class='upload_form__bad'>" .
                        '"' . $fileName . '"' . "</span>" .
                        ' has unsupported file type! ' . "({$fileType})";
                } else {
                    $message[] = "<span class='upload_form__bad'>" .
                        '"' . $fileName . '"' . "</span>" .
                        ' size is bigger then 10Mb! ' . "({$fileSize})" . '<br>';
                }
            }
        }
    }

    return $message;
}

//функция генерации ссылок для галереи картинок
function imgPathArray()
{
    $source = opendir(IMAGES_SMALL_DIR);
    $pathSmall = '../public/images/small/';
    $pathOrig = '../public/images/original/';

    while ($file = readdir($source)) {
        if ($file != '.' && $file != '..') {
            //наполняем массив ссылками, где 0 элемент - ссылка на мини картинку, 1 - на оригинальную
            $imgArray[] = [$pathSmall . $file, $pathOrig . ltrim($file, 'small-')];
        }
    }

    closedir($source);

    return $imgArray;
}
