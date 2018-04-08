<?php
header('Content-type: text/html; charset=utf-8');
?>

<style>
  .wall {
    background-color: gray;
  }

  .hero {
    width: 30px;
    height: 30px;
    position: relative;
  }

  .up::after {
    position: absolute;
    content: '\027A4';
    transform: rotate(270deg);
    top: 3px;
    left: 6px;
  }

  .down::after {
    position: absolute;
    content: '\027A4';
    transform: rotate(90deg);
    top: 3px;
    left: 6px;
  }

  .left::after {
    position: absolute;
    content: '\027A4';
    transform: rotate(180deg);
    top: 3px;
    left: 6px;
  }

  .right::after {
    position: absolute;
    content: '\027A4';
    transform: rotate(360deg);
    top: 3px;
    left: 6px;
  }

  .oneStep {
    display: flex;
    flex-flow: column-reverse nowrap;
  }

  .start {
    display: inline-block;
    position: relative;
  }

  .start::before {
    content: '';
    display: block;
    background-color: yellow;
    font-size: 35px;
    position: absolute;
    width: 150px;
    height: 53px;
    top: 46%;
    left: 28%;
    border-radius: 14px;
  }

  .start::after {
    content: 'Start!';
    font-size: 35px;
    position: absolute;
    top: 48%;
    left: 40%;
  }

  table {
    height: 300px;
    width: 300px;
    border: 1px solid #000;
    border-collapse: collapse;
  }

  td {
    border: 1px solid #000;
  }
</style>

<?php
$mazeArr = [
    [0, 1, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 1, 1, 1, 1, 1, 0],
    [0, 1, 1, 1, 1, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 0, 0, 1, 1, 1, 0],
    [0, 1, 0, 1, 1, 1, 1, 0, 1, 0],
    [0, 1, 0, 1, 0, 0, 0, 0, 1, 0],
    [0, 1, 0, 1, 1, 1, 1, 0, 1, 0],
    [0, 1, 0, 1, 0, 0, 1, 0, 1, 0],
    [0, 1, 1, 1, 1, 0, 1, 1, 1, 0],
    [0, 0, 0, 0, 1, 0, 0, 0, 0, 0]
];

//положение указателя
$hero = [
    'startPositionX' => 0,
    'startPositionY' => 0,
    'startDirection' => 'up',
    'currentPositionX' => 0,
    'currentPositionY' => 0,
    'currentDirection' => 'up',
    'countSteps' => 0
];

//вычисляем начальную позицию указателя
foreach ($mazeArr[$firstLine = count($mazeArr) - 1] as $key => &$number) {
    if ($number == 1) {
        $hero['startPositionX'] = $hero['currentPositionX'] = $key;
        $hero['startPositionY'] = $hero['currentPositionY'] = $firstLine;
    }
}

//рендер стартовой позиции
echo '<div class="start">' . render($mazeArr, $hero) . '</div><hr>';

//цикл выполняется, пока не будет достигнут выход (т.е. координата У == 0)
while ($hero['currentPositionY'] != 0) {
    echo '<div class="oneStep">' . calculate($mazeArr, $hero) . render($mazeArr, $hero) . '</div><hr>';
}

//рендер таблицы
function render($arr, $hero)
{
    $renderMaze = '<table>';
    foreach ($arr as $y => $value) {
        $renderMaze .= '<tr>';
        foreach ($value as $x => $number) {
            if ($y == $hero['currentPositionY'] && $x == $hero['currentPositionX']) {
              //классами изменяем ориентацию курсора
                $renderMaze .= "<td class='hero {$hero['currentDirection']}'></td>";
            } else if ($number == 0) {
                $renderMaze .= '<td class="wall"></td>';
            } else {
                $renderMaze .= '<td class="path"></td>';
            }
        }
        $renderMaze .= '</tr>';
    }

    $renderMaze .= '</table>';

    return $renderMaze;
}

//рассчет шагов
function calculate($mazeArr, &$hero)
{
    //после каждого шага стартовая позиция равна текущей из предыдущего шага
    $hero['startPositionX'] = $hero['currentPositionX'];
    $hero['startPositionY'] = $hero['currentPositionY'];
    $hero['startDirection'] = $hero['currentDirection'];

    //проверка на возможность прохода, содержит ли ячейка в определенной стороне "1"
    $wayToRight = $mazeArr[$hero['startPositionY']][$hero['startPositionX'] + 1] == 1;
    $wayToDown = $mazeArr[$hero['startPositionY'] + 1][$hero['startPositionX']] == 1;
    $wayToLeft = $mazeArr[$hero['startPositionY']][$hero['startPositionX'] - 1] == 1;
    $wayToUp = $mazeArr[$hero['startPositionY'] - 1][$hero['startPositionX']] == 1;

    //в зависимости от направления движения меняется порядок проверки прохода
    if ($hero['currentDirection'] == 'left') {
        if ($wayToUp) {
            stepUp($hero);
        } elseif ($wayToLeft) {
            stepLeft($hero);
        } elseif ($wayToDown) {
            stepDown($hero);
        } elseif ($wayToRight) {
            stepRight($hero);
        }
    } elseif ($hero['currentDirection'] == 'up') {
        if ($wayToRight) {
            stepRight($hero);
        } elseif ($wayToUp) {
            stepUp($hero);
        } elseif ($wayToLeft) {
            stepLeft($hero);
        } elseif ($wayToDown) {
            stepDown($hero);
        }
    } elseif ($hero['currentDirection'] == 'right') {
        if ($wayToDown) {
            stepDown($hero);
        } elseif ($wayToRight) {
            stepRight($hero);
        } elseif ($wayToUp) {
            stepUp($hero);
        } elseif ($wayToLeft) {
            stepLeft($hero);
        }
    } elseif ($hero['currentDirection'] == 'down') {
        if ($wayToLeft) {
            stepLeft($hero);
        } elseif ($wayToDown) {
            stepDown($hero);
        } elseif ($wayToRight) {
            stepRight($hero);
        } elseif ($wayToUp) {
            stepUp($hero);
        }
    }

    //счетчик хода
    $hero['countSteps']++;

    //возвращаем информацию о текущем состоянии
    return "<div>Step № {$hero['countSteps']}<br>
            start position: x: {$hero['startPositionX']}, y: {$hero['startPositionY']}<br>
            start direction: {$hero['startDirection']}<br>
            current position: x: {$hero['currentPositionX']}, y: {$hero['currentPositionY']}<br>
            current direction: {$hero['currentDirection']}</div>";
}

function stepUp(&$hero)
{
    $hero['currentPositionY'] = $hero['startPositionY'] - 1;
    $hero['currentPositionX'] = $hero['startPositionX'];
    $hero['currentDirection'] = 'up';
}

function stepDown(&$hero)
{
    $hero['currentPositionY'] = $hero['startPositionY'] + 1;
    $hero['currentPositionX'] = $hero['startPositionX'];
    $hero['currentDirection'] = 'down';
}

function stepRight(&$hero)
{
    $hero['currentPositionX'] = $hero['startPositionX'] + 1;
    $hero['currentPositionY'] = $hero['startPositionY'];
    $hero['currentDirection'] = 'right';
}

function stepLeft(&$hero)
{
    $hero['currentPositionX'] = $hero['startPositionX'] - 1;
    $hero['currentPositionY'] = $hero['startPositionY'];
    $hero['currentDirection'] = 'left';
}

?>
