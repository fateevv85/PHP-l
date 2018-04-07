<h2>Товар каталога:</h2>
<div class="nameImg">
  <p class="goodsHeader">
    <b><?= $book['title'] ?></b>
    <br><?= $book['author'] ?>
  </p>
  <div class="imgBack">
    <a href="<?= $book['picture_url'] ?>" target="_blank">
      <img src="<?= $book['picture_small_url'] ?>" alt="small picture" class="imgGoods">
    </a>
  </div>
  <div class="shortDescription">
    <p class="goodsHeader">Краткое описание:</p>
    <div>Это хорошая книга!</div>
    <div class="price">Цена:</div>
    <div class="book_price"><?= $book['price'] ?></div>
    <a href="addToCart.php?id=<?= $book['id'] ?>" class="buying">Купить</a>
  </div>
</div>
<div class="property">
  <p class="goodsHeader">Характеристики товара:</p>
  <ul class="propertyList">
    <li>ID товара: <?= $book['id'] ?></li>
    <li>Издательство: <?= $book['publisher'] ?></li>
    <li>Категория: <?= $book['category'] ?></li>
    <!--<li>Год издания: 2014</li>
    <li>Кол-во страниц: 285</li>
    <li>ISBN: 9785170844210</li>
    <li>Тираж: 4000</li>
    <li>Формат: 20.5 x 13 x 1.6</li>
    <li>Тип обложки: Твердая бумажная</li>
    <li>Возрастные ограничения : 16+</li>-->
  </ul>
</div>
<div class="longDescription">
  <p class="goodsHeader">Описание товара:</p>
  <div>
      <?= $book['description'] ?>
  </div>
</div>
