<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project/config/main.php";
require_once ENGINE_DIR . '/db.php';

//загрузка любых файлов
function uploadFiles($directory, $attributeName = 'file')
{
    if (isset($_FILES[$attributeName])) {

        if (!$_FILES[$attributeName]['error']) {

            is_dir($directory) ?: mkdir($directory);
            $name = $_FILES[$attributeName]['name'];
            $tmp = $_FILES[$attributeName]['tmp_name'];
            $size = $_FILES[$attributeName]['size'];
            $dest = "$directory/$name";

            move_uploaded_file($tmp, $dest);

            $fileInfo = [
                'name' => $name,
                'destination' => $dest,
                'size' => $size
            ];
        }
    }

    //возвращает информацию о файле
    return $fileInfo;
}

//загрузка картинок
function uploadImages($maxsize = null)
{
    if ($file = uploadFiles(IMAGES_DIR, 'image')) {

        $destination = IMAGES_SMALL_DIR . '/' . $file['name'];

        is_dir(IMAGES_SMALL_DIR) ?: mkdir(IMAGES_SMALL_DIR);

        include_once VENDOR_DIR . '/funcImgResize.php';
        img_resize($file['destination'], $destination, 200, 200);

        $file['url'] = '../public/img/' . $file['name'];
        $file['urlMini'] = '../public/img/small/' . $file['name'];
        $file['sizeMini'] = filesize($destination);

        query($file);
    }
}