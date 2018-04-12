<div class="gallery">
  <h3>Image gallery</h3>
  <div class="gallery_pictures">
      <?php if ($images) {
          foreach ($images as $key => $image) : ?>
            <a href="photo?id=<?=$image['id']?>" target="_blank">
              <img src="<?= $image['url_mini'] ?>" alt="image">
            </a>
          <?php endforeach;
      } else { ?>
        <h5>Gallery is empty!</h5>
      <?php } ?>
  </div>
</div>
<div class="upload_form_wrapper">
  <div class="upload_form">
    <h5>Upload your pictures to the gallery!</h5>
    <form action="" enctype="multipart/form-data" method="post">
      <input type="file" name="image">
      <input type="submit">
    </form>
  </div>
</div>
