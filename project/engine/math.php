<?php
function mathOperation($arg1, $arg2, $operation)
{
    if (!is_numeric($arg1) || !is_numeric($arg2)) {
        $res = 'Insert correct value!';
    } else {
        $res = 0;
        switch ($operation) {
            case '+':
                $res = $arg1 + $arg2;
                break;
            case '-':
                $res = $arg1 - $arg2;
                break;
            case 'x':
                $res = $arg1 * $arg2;
                break;
            case '/':
                $res = $arg2 == 0 ? 'Деление на 0!' : round($arg1 / $arg2, 2);
                break;
        }
    }
    return $res;
}
