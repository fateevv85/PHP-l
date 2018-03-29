<?php

$a = rand(-10, 10);
$b = rand(-10, 10);

echo 'Number 1: ' . $a . '<br>Number 2: ' . $b;

/*
если $a и $b положительные, вывести их разность;
если $а и $b отрицательные, вывести их произведение;
если $а и $b разных знаков, вывести их сумму;
 */

echo '<h3>Task 1</h3>';

function math($arg1, $arg2)
{

    if ($arg1 >= 0 && $arg2 >= 0) {
        return $arg1 - $arg2 . ' positive';
    } elseif ($arg1 < 0 && $arg2 < 0) {
        return $arg1 * $arg2 . ' negative';
    }

    return $arg1 + $arg2 . ' difference';
}

echo math($a, $b);

/*
Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.
*/

echo '<h3>Task 2</h3>';

function sum($arg1, $arg2)
{
    return $arg1 + $arg2;
}

function dif($arg1, $arg2)
{
    return $arg1 - $arg2;
}

function mul($arg1, $arg2)
{
    return $arg1 * $arg2;
}

function div($arg1, $arg2)
{
    if ($arg2 == 0) {
        return 'Деление на 0!';
    }
    return round($arg1 / $arg2, 2);
}

echo sum($a, $b);
echo '<br>';
echo dif($a, $b);
echo '<br>';
echo mul($a, $b);
echo '<br>';
echo div($a, $b);
echo '<br>';

/*
Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).
*/

echo '<h3>Task 3</h3>';

function mathOperation($arg1, $arg2, $operation)
{
    $res = 0;
    switch ($operation) {
        case 'sum':
            $res = sum($arg1, $arg2);
            break;
        case 'dif':
            $res = dif($arg1, $arg2);
            break;
        case 'mul':
            $res = mul($arg1, $arg2);
            break;
        case 'div':
            $res = div($arg1, $arg2);
            break;
    }
    return $res;
}

echo mathOperation($a, $b, 'sum');
echo '<br>';
echo mathOperation($a, $b, 'dif');
echo '<br>';
echo mathOperation($a, $b, 'mul');
echo '<br>';
echo mathOperation($a, $b, 'div');

/*
 С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
*/

echo '<h3>Task 4</h3>';

$c = rand(2, 5);
$d = rand(2, 5);

echo 'Number 1: ' . $c . '<br>Number 2: ' . $d;

function power($val, $pow)
{
    if ($pow == 1) {
        return $val;
    }
    
    $res = $val * power($val, $pow - 1);

    return $res;
}

echo '<br>';
echo power($c, $d);

?>

<hr>
<footer style="text-align: center"> &copy; <?= date('Y') ?></footer>
