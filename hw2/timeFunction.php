<?php
/*
Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
22 часа 15 минут
21 час 43 минуты
*/

date_default_timezone_set('Europe/Moscow');
$time = time();
$hour = date('G', $time);
$min = date('i', $time);

/*
 1. 1 час
 2. 2 часа
 3. 11 часов
*/
$hourArr = [
    'час', 'часа', 'часов'
];
$minArr = [
    'минута', 'минуты', 'минут'
];

function comparisonText($value, $arr)
{
    if (!is_numeric($value) || !is_array($arr) || $value < 0) {
        return 'incorrect data!';
    }

    if (preg_match('/[1][1-9]/', substr($value, -2))) {
        $teen = true;
    }

    $lastNumber = $value % 10;

    if ($lastNumber == 1 && !$teen) {
        $requiredText = $arr[0];
    } elseif (preg_match('/[2-4]/', $lastNumber) && !$teen) {
        $requiredText = $arr[1];
    } else {
        $requiredText = $arr[2];
    }

    return $value . ' ' . $requiredText;
}

echo comparisonText($hour, $hourArr) . ' ' . comparisonText($min, $minArr);

?>
