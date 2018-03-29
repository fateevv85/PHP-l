<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/hw4/config/main.php";
require_once ENGINE_DIR . '/functions.php';
//получаем массив сообщений об операциях с файлами
$list = uploadFiles();
?>

<div class="upload_form_wrapper">
  <div class="upload_form">
    <h5>Upload your pictures to the gallery!</h5>
    <form action="" enctype="multipart/form-data" method="post">
      <input type="file" name="file[]" multiple>
      <input type="submit">
        <!-- формируем список сообщений для кадого файла -->
        <?php if ($list) { ?>
          <ul>
              <?php foreach ($list as $value) { ?>
                <li> <?= $value ?> </li>
              <?php } ?>
          </ul>
        <?php } ?>
    </form>
  </div>
</div>
