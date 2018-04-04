<?php
include_once ENGINE_DIR . "/db.php";

/*
function getImgInfo($name = true)
{
    if (scandir(IMAGES_DIR, 1)[0] != '..') {
        return
            array_filter(
                array_map(function ($file) {
                    //сканируем папку с картинками и добавляем данные в массив
                    if (!is_dir(IMAGES_DIR . '/' . $file)) {
                        $arr = [
                            $file,                                              //имя оригинала
                            '../public/img/' . $file,                           //путь к оригиналу
                            filesize(IMAGES_DIR . '/' . $file),        //размер оригинала
                            '../public/img/small/' . $file,                     //путь к миниверсии
                            filesize(IMAGES_SMALL_DIR . '/' . $file)   //размер мини
                        ];
                    }
                    return $arr;
                    //каллбэк выбирает информацию о файле с определенным именем
                }, scandir(IMAGES_DIR)), function ($item) use ($name) {
                return $item[0] == $name;
            });
            } else {
        //если папка пуста, то
        return false;
    }
}*/

function getImageInfo($name)
{
    //если такой файл есть в папке с изображениями
    if (array_search($name, scandir(IMAGES_DIR))) {
        $result = [
            $name,                                              //имя оригинала
            '../public/img/' . $name,                           //путь к оригиналу
            filesize(IMAGES_DIR . '/' . $name),        //размер оригинала
            '../public/img/small/' . $name,                     //путь к миниверсии
            filesize(IMAGES_SMALL_DIR . '/' . $name)   //размер мини
        ];
    }
    return $result;
}

function renderLayout($template, $params = [], $useLayout = true)
{
    $content = renderTemplate($template, $params);
    if ($useLayout) {
        $content = renderTemplate('layouts/mainLayout.php', ['content' => $content]);
    }
    return $content;
}

function renderTemplate($template, $params = [])
{
    ob_start();
    extract($params);
    include TEMPLATES_DIR . "/{$template}";
    return ob_get_clean();
}
