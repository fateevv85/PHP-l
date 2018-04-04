<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/hw5/config/main.php";

//загрузка любых файлов
function uploadFiles($directory, $attributeName = 'files', $callback = null)
{
    if (isset($_FILES[$attributeName])) {

        if (!$_FILES[$attributeName]['error']) {

            is_dir($directory) ?: mkdir($directory);
            $name = $_FILES[$attributeName]['name'];
            $tmp = $_FILES[$attributeName]['tmp_name'];
            $dest = "$directory/$name";

            if (!is_null($callback)) {
                return $name;
            }

            move_uploaded_file($tmp, $dest);

        }
    }
    //возвращает директорию, куда перемещены картинки
    return $dest;
}

//загрузка картинок
function uploadImages($directory, $maxsize = 0)
{
    if ($source = uploadFiles($directory)){
        $destination = PUBLIC_DIR . '/img/small';

        is_dir($destination) ?: mkdir($destination);

        include_once VENDOR_DIR . '/funcImgResize.php';
        img_resize($source, $destination . '/' . uploadFiles('img', 'files', 1), 200, 200);
    }
}
