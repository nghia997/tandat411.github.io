<?php
$array1 = [11, 222, 333, 6, 1, 5];
$array2 = [5, 6, 1, 20];
$array3 = [99, 5, 9, 0, 1];
try {
    echo 'Check 3 parameters: ';
    checkInput($array1, $array2, $array3);
} catch (LogicException $e) {
    echo $e->getMessage();
    die();
}

echo "<b>3 arrays inputted: </b><br><pre>";
echo '<b>First array:</b><br>';
print_r($array1);
echo '<b>Second array:</b><br>';
print_r($array2);
echo '<b>Third array:</b><br>';
print_r($array3);
echo "</pre>";

echo '1. Find number one in first Array: ';
findNumberOne($array1);
echo '2. Merge second array and third array: ';
mergeArrays($array2, $array3);
echo '3. Print out all values whose sum of digits is divisible by 2: ';
evenArray($array1,$array2,$array3);

/* Frunction check input
 *  @params 3 array.
 *  @throw LogicException with message "Invalid parameter [index]" if one of them is not an array
 *  @return a string.
 */
function checkInput($array1, $array2, $array3)
{
    $listParams = [$array1, $array2, $array3];
    $length = count($listParams);
    $failPosition = [];

    for ($i = 0; $i < $length; $i++) {
        if (!is_array($listParams[$i])) {
            $failPosition[] = $i + 1;
        }
    }

    if (count($failPosition) == 0) {
        echo '<b>Correct</b><br>';
    } else {
        $getFailPosition = implode(', ', $failPosition);
        throw new LogicException('<b>Invalid parameter ' . $getFailPosition . '</b>');
    }
}

/* Frunction number 1 in first array
 *  @params 3 array.
 *  @return a string.
 */
function findNumberOne($firstArray)
{
    echo (in_array(1, $firstArray)) ? '<b>Found</b>' : '<b>Not found</b>';
    echo '<br>';
}

/* Frunction merge 2 array in position 2 and 3, delete duplicates
 *  @params 2 array.
 *  @return a string.
 */
function mergeArrays($secondArray, $thirdArray)
{
    $arrayUnduplicate = array_unique(array_merge($secondArray, $thirdArray));
    $result = implode(', ', $arrayUnduplicate);
    echo '<b>'.$result.'</b><br>';
}

/* Frunction merge 2 array in position 2 and 3, delete duplicates
 *  @params 2 array.
 *  @return a string.
 */
function evenArray($firstArray, $secondArray, $thirdArray)
{
    $arrayUnduplicate = array_unique(array_merge($firstArray, $secondArray, $thirdArray));
    $arrayFilter = array_filter($arrayUnduplicate, function ($value) {
        $total = 0;
        while ($value % 10 != 0) {
            $total += $value % 10;
            $value = $value / 10;
        }
        return ($total % 2 == 0) ? true : false;
    });
    $result = implode(', ', $arrayFilter);
    echo '<b>'.$result.'</b><br>';
}


