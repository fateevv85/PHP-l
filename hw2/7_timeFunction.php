<?php
/*
Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
22 часа 15 минут
21 час 43 минуты
*/
function getTime() {
    date_default_timezone_set('Europe/Moscow');
    $hour =  date('G');
    $min =  date('i');
    $hourString = '';
    $minString = '';

    if ($hour == 1 || $hour == 21) {
        $hourString = ' час ';
    } elseif ($hour <= 4 || $hour >= 22) {
        $hourString = ' часа ';
    } else {
        $hourString = ' часов ';
    }

    //последняя цифра в минутах
    $lastNumber = substr($min, -1);

    if ($lastNumber == 1 && $min != 11) {
        $minString = ' минута.';
    } elseif (preg_match('/[2-4]/', $lastNumber)) {
        $minString = ' минуты.';
    } else {
        $minString = ' минут.';
    }

    return $hour . $hourString . $min . $minString;
}

echo getTime();

?>
