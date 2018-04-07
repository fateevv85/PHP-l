<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/picture_gallery/config/main.php";
include_once ENGINE_DIR . '/math.php';
include_once ENGINE_DIR . '/render.php';
/*1. Создать форму-калькулятор с операциями: сложение, вычитание, умножение, деление. Не забыть обработать деление на ноль! Выбор операции можно осуществлять с помощью тега <select>.
2. Создать калькулятор, который будет определять тип выбранной пользователем операции, ориентируясь на нажатую кнопку.*/

$arr = $_REQUEST;

$result = mathOperation($arr['digit1'], $arr['digit2'], $arr['action']);

echo renderLayout('calc.php', ['result' => $result]);
