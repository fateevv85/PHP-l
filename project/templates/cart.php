<h5>Hello, <?= $userName ?>!</h5>
<div><?= $message ?></div>
<form action="" method="post" name="logoutform">
  <input type="submit" value="Log out" name="logout">
</form>
<div>Your cart orders:</div>
<?php if (empty($books)) : ?>
  <div>Cart is empty!</div>
<?php else: ?>
  <div class="cart_orders">
      <?php foreach ($books as $book) : ?>
        <div class="order_item">
          <ul class="desc_list">
              <?php foreach ($book as $key => $value) : ?>
                <li>
                  <b><?= $key ?>: </b>
                  <span data-type="<?= $key ?>"><?= $value ?></span>
                </li>
              <?php endforeach; ?>
          </ul>
          <div>Количество: <input type="number" min="1" max="10" value="1" class="count_item"></div>
          <div>Цена:
            <div class="cart_item_sum"><?= $book['price'] ?></div>
            рублей
          </div>
          <div class="delete_item" data-id="<?= $book['id'] ?>">Delete item</div>
        </div>
      <?php endforeach; ?>
  </div>
  <div class="cart_total">Итого:
    <div class="cart_total_sum"></div>
    рублей
  </div>
  <!--<form action="" method="post">
    <input type="submit" name="clear_cart" id="clear_cart" value="Clear cart">
    <input type="submit" name="submit_cart" id="submit_cart" value="Save cart">
  </form>-->
    <div class="clear_cart">Clear cart</div>
    <div class="save_cart">Save cart</div>

<?php endif; ?>
<script src="../js/cartActivity.js"></script>
