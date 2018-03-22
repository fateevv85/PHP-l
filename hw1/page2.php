<?php
/* Перенаправление броузера на другую страницу в той же директории, что и
изначально запрошенная */
$host  = $_SERVER['HTTP_HOST'];
$uri   = dirname($_SERVER['PHP_SELF']);
$extra = 'page1.php';
header("Location: http://$host$uri/$extra");
?>

<?php
//header("Location: http://php-i/hw1/page1.php");
//?>
