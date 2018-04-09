<h2>Каталог</h2>
<form action="">
  <select name="select" id="">
      <?php foreach ($category as $value) : ?>
        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
      <?php endforeach; ?>
  </select>
  <input type="submit" value="Select">
</form>
<div class="catalog">
    <?php foreach ($books as $item): ?>
      <div class="catalogGood">
        <a href="book.php?id=<?= $item['id'] ?>">
          <img src="<?= $item['picture_small_url'] ?>" alt="small picture" class="imgCatalog">
<!--          <span class="book_root"></span>-->
          <br>
          <span class="descriptionLink"><?= $item['title'] ?>
            <br>
            <i><?= $item['author: '] ?></i>
          </span>
        </a>
      </div>
    <?php endforeach;  //var_dump($books); ?>
</div>
