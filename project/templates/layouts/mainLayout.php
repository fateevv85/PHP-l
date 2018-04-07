<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles/main.css">
  <title>PHP - I</title>
</head>
<body>
<header>
  <div class="storeLogo"></div>
  <ul class="menu">
    <li><a href="index.php">Главная</a></li>
    <li><a href="gallery.php">Галерея</a></li>
    <li><a href="calc.php">Калькулятор</a></li>
    <li><a href="catalog.php">Каталог</a></li>
  </ul>
</header>
<div class="content"><?= $content ?></div>
<footer>
  Fateev Vasiliy
  &copy; <?= date('Y') ?>
</footer>
</body>
</html>
