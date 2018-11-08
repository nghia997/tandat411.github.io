<?php
$mainArray = $_POST['mainArray'];

ajaxCalculate($mainArray);

/* Function to summation and multiplication all value in an array then encode result with json:
 * @param array $mainArray to get value.
 * @return void.
 * */
function ajaxCalculate($mainArray)
{
    $sum  = 0;
    $multiplication = 1;
    for ($i = 0; $i < count($mainArray); $i++) {
        $sum += $mainArray[$i];
        $multiplication *= $mainArray[$i];
    }

    $result = [$sum, $multiplication];
    echo 'Kết quả của tổng và tích các giá trị trong mảng: ' . json_encode($result);
}

