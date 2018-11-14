<?php

$firstValue = 2;
$secondValue = 5;
$length = 5;

demoIfElse($firstValue, $secondValue);
demoTernaryOperator($firstValue, $secondValue);
demoFor($length);
demoForeach();
demoWhile($length);
demoDoWhile($length);
demoSwitch();

// Demo If-elseif-else
function demoIfElse(&$firstValue, &$secondValue)
{
    echo '<b>Demo for If/elseif/else:</b> <br>';
    echo 'Swap two values <b>' . $firstValue . ' and ' . $secondValue . '</b>: <br>';
    swap($firstValue, $secondValue);
}

//Demo ternary operator
function demoTernaryOperator($firstValue, $secondValue)
{
    $maxValue = ($firstValue > $secondValue) ? $firstValue : $secondValue;
    echo '<br><b>Demo for Ternary Operator:</b> <br>';
    echo 'Find max value in two values <b>' . $firstValue . ' and ' . $secondValue . '</b> use Ternary operator : <br>';
    echo '- Result: ' . $maxValue . '<br>';
}

// Demo Loop foreach
function demoForeach()
{
    $infomation = ['name' => 'Mai Lâm Tấn Đạt', 'ages' => 21, 'sex' => 'male'];
    echo '<br><b>Demo of Loop Foreach:</b> <br>';
    echo "My info: <br>";
    foreach ($infomation as $key => $value) {
        echo '- '.$key.': '.$value.'<br>';
    }
}

// Demo Loop for
function demoFor($length)
{
    echo '<br><b>Demo of Loop For:</b><br>';
    for ($i = 1; $i <= $length; $i++) {
        findNumber($i);
    }
}

// Demo Loop while
function demoWhile($length)
{
    echo '<br><b>Demo of Loop While:</b><br>';
    $number = 1;
    while ($number <= $length) {
        findNumber($number++);
    }
}

// Demo Loop do..while
function demoDoWhile($length)
{
    echo '<br><b>Demo of Loop Do..while:</b><br>';
    $number = $length;
    do {
        findNumber($number--);
    } while ($number > 0);
}

//Demo switch
function demoSwitch()
{
    $value1 = -1;
    $value2 = 6;
    $value3 = 0;
    $value4 = "A";
    $value5 = 5;
    echo '<br><b>Demo for Switch:</b> <br>';
    findNumber($value1);
    findNumber($value2);
    findNumber($value3);
    findNumber($value4);
    findNumber($value5);
}

/**
 *  - Input: Two values with type is a number.
 *  - Output: Swap two values.
 */
function swap(&$valueA, &$valueB)
{
    if ($valueA < $valueB) {
        $valueA += $valueB;
        $valueB = $valueA - $valueB;
        $valueA -= $valueB;
        echo '- Result: ' . $GLOBALS["firstValue"].' - '.$GLOBALS["secondValue"] . '<br>';
    } elseif ($valueA > $valueB) {
        $valueB += $valueA;
        $valueA = $valueB - $valueA;
        $valueB -= $valueA;
        echo '- Result: ' . $GLOBALS["firstValue"].' - '.$GLOBALS["secondValue"] . '<br>';
    } else {
        echo "- It's the same values <br>";
    }
}

/**
 *  - Input: A num in [1->5].
 *  - Output: echo Name og Number, if Input not a correct value: echo a error message for this value.
 */
function findNumber($number)
{
    switch ($number) {
        case 1:
            echo 'One';
            break;
        case 2:
            echo 'Two';
            break;
        case 3:
            echo 'Three';
            break;
        case 4:
            echo 'Four';
            break;
        case 5:
            echo 'Five';
            break;
        default:
            echo 'Value: <b>'.$number.'</b> is not correct';
            break;
    }
    echo '<br>';
}