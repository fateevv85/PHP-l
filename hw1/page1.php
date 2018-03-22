<head>
  <title>Text page</title>
</head>
<?php
date_default_timezone_set("Europe/Moscow");
$name = 'Vasiliy';
$age = date('Y') - 1985;
$currentDate = date('d-m-Y H:i');
$string = "Меня зовут %s.
<br>
Через год мне будет %d года, а еще через год %d лет.
<br>
На моих часах сейчас: %s.";

$text = sprintf($string, $name, $age + 1, $age + 2, $currentDate);
echo $text;
echo '<p></p>';
//replace spaces with underscore
echo str_replace(' ', '_', $text);
echo '<p></p>';
//print substring
echo strstr($text, 'На моих');
?>
