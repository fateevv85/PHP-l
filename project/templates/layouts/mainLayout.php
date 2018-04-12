<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="/project/public/styles/main.css">
  <title>PHP - I</title>
</head>
<body>
<div class="content_wrapper">
  <header>
    <div class="storeLogo"></div>
    <ul class="menu">
      <li><a href="/project/public/extra/greetings">Main</a></li>
      <li><a href="/project/public/gallery/gallery">Галерея</a></li>
      <li><a href="/project/public/extra/calc">Калькулятор</a></li>
      <li><a href="/project/public/product/catalog">Каталог</a></li>
      <li><a href="/project/public/cart/cart">Cart</a></li>
    </ul>
  </header>
  <div class="content"><?= $content ?></div>
  <footer>
    Fateev Vasiliy
    &copy; <?= date('Y') ?>
  </footer>
</div>
<script src="/project/public/js/tabMenu.js"></script>
</body>
</html>
