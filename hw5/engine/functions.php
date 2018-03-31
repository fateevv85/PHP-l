<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/hw5/config/main.php";
include_once ENGINE_DIR . '/funcImgResize.php';

//функция загрузки картинок
function uploadImg()
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

                //проверка на длину имени файла, если более 25 символов, обрезаем
                if (strlen($fileName) > 20) {
                    $fileName = mb_substr($fileName, 0, 25) . '...';
                }

                //проверка на тип файла и размер
                if ($fileType == 'image' && $fileSize <= 10e6) {
                    //проверка на наличие папок, если их нет, то создаем
                    is_dir(IMAGES_DIR) ?: mkdir(PUBLIC_DIR . '/images');
                    is_dir(IMAGES_SMALL_DIR) ?: mkdir(IMAGES_DIR . '/small');
                    is_dir(IMAGES_ORIG_DIR) ?: mkdir(IMAGES_DIR . '/original');
                    //мини версию копируем в images/small
                    img_resize($tmp, $destImgSmall, 200, 200);
                    //оригинал перемещаем в images/original
                    move_uploaded_file($tmp, $destImgOriginal);
                    //формируем отчет об выполнении
                    $message['good'][] = $fileName;
                    //если проверка не пройдена, добавляем соответствующие сообщения
                } elseif ($fileType != 'image') {
                    $message['bad_type'][] = $fileName;
                } else {
                    $message['bad_size'][] = $fileName;
                }

            }
        }
    }
    return $message;
}

//функция генерации ссылок для галереи картинок
function imgPathArray()
{
    $message = uploadImg();
    //если папки с картинками нет и сообщение об обработке картинок не сформировано, то сообщение об ошибке
    if (!is_dir(IMAGES_DIR) && !$message) {
        return false;
        //если список начинается не с "..", то формируем ссылки
    } elseif (scandir(IMAGES_SMALL_DIR, 1)[0] != '..') {
        $source = opendir(IMAGES_SMALL_DIR);
        $pathSmall = '../public/images/small/';
        $pathOrig = '../public/images/original/';

        while ($file = readdir($source)) {
            if ($file != '.' && $file != '..') {
                //наполняем массив информацией о картинках
                $imgArray[] = [
                    $pathSmall . $file,                         //путь к миниверсии
                    $pathOrig . ltrim($file, 'small-'), //к оригиналу
                    $file,                                      //имя мини
                    ltrim($file, 'small-'),             //имя оригинала
                    filesize($pathSmall . $file),      //размер мини
                    filesize($pathOrig . ltrim($file, 'small-')) //размер оригинала
                ];
            }
        }
        closedir($source);
        return $imgArray;
    } else {
        //если папка пуста, то
        return false;
    }
}
