<?php
$parentString = 'Mai Lâm Tấn Đạt';
$childString = 'Lâm';

try {
    checkInput($parentString, $childString);
} catch (LogicException $e) {
    echo $e->getMessage();
    die();
}

echo "Result find string '$childString' in parent string '$parentString' is ";
findString($parentString, $childString);

/* Function check data input
 *  @param string @param1 to check
 *  @param string @param2 to check
 *  @throw LogicException with a messages 'Invalid parameter [index of param] if one of them is not a string'
 *  @return void
 *  */
function checkInput($param1, $param2)
{
    $listParam = [$param1, $param2];
    $failParam = [];
    for ($i = 0; $i < 2; $i++) {
        if (!is_string($listParam[$i])) {
            $failParam[] = $i + 1;
        }
    }

    if (count($failParam) == 0) {
        echo 'Correct input <br><hr>';
    } else {
        $message = implode(', ', $failParam);
        throw new LogicException('Invalid parameter '.$message);
    }
}

/* Function find a string in another string
 *  @param string $parentString is a parent string
 *  @param string @$childString to find in $parentString
 *  @return void
 *  */
function findString($parentString, $childString)
{
    echo (strpos($parentString, $childString)) ? '<b>TRUE</b>' : '<b>FALSE</b>';
}