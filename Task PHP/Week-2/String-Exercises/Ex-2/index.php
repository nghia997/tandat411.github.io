<?php
$parentString = 'Mai Lâm Tấn Đạt';
$childString = 'Lâm';

/* Function check data input
 *  @param string @param1
 *  @param string @param2
 *
 *  */
function checkInput($param1, $param2)
{
    $listParam = [$param1, $param2];
    $failParam = [];
    for ($i = 0; $i < 2; $i++) {
            $failParam[] = (!is_string($listParam[$i])) ? $i+1 : null;
    }

    if (count($failParam) == 0) {
        echo 'Correct input';
    } else {
        $message = implode(', ', $failParam);
        throw new LogicException('Invalid parameter '.$message);
    }
}