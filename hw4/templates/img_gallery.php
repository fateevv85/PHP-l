<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/hw4/config/main.php";
require_once ENGINE_DIR . '/functions.php';
?>

<!--шаблон генерации галереи-->
<div class="gallery">
  <h3>Image gallery</h3>
  <div class="gallery_pictures">
      <?php if (imgPathArray()) {
          foreach (imgPathArray() as $key => $image) { ?>
            <!--второй элемент массива - оригинал изображения-->
            <a href="<?= $image[1] ?>" target="_blank">
              <!--первый элемент массива - мини-версия-->
              <img src="<?= $image[0] ?>" alt="image" width="200">
            </a>
          <?php }
      } else { ?>
        <h5>Gallery is empty!</h5>
      <?php } ?>
  </div>
</div>
