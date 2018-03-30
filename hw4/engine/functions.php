<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/hw4/config/main.php";
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
                    $fileName = mb_substr($fileName, 0, 25).'...';
                }

                //проверка на тип файла и размер
                if ($fileType == 'image' && $fileSize <= 10e6) {
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
function imgPathArray() {
    //сразу отдает картинки, без нажатия f5 (условие "или" проверяет,
    //было ли сформировано сообщение об обработке картинок, или пуста ли папка с мини картинками,
    //для этого получаем список файлов из нее и сортируем снизу вверх. В этом случае, если папка
    //пуста, то первыми пойдут "..")
    if (uploadImg() || scandir('../public/images/small/',1)[0] != '..') {
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
        } else {
        //если сообщения не было и папка пуста, то
            return false;
        }
}
