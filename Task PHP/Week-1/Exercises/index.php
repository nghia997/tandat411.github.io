<?php
$array1 = ['A' => 6, 10, 1, 'B' => 5, 'C' => 30];
$array2 = [11, 222, 333, 5, 6, 1, 20];
$array3 = [99, 5, 9, 0, 1];
$mainArray = [];
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
echo '2. Merge second array and third array (Main array): ';
mergeArrays($array2, $array3);
echo '3. Print out all values whose sum of digits is divisible by 2: ';
evenArray($mainArray);
echo '4. Print out all the ascending value of the first array that exists in the main array: ';
ascendingSort($array1, $mainArray);
echo '5. Print out all the descending value of the first array whose key is not in the main array: ';
echo '<pre><b>First array:</b><br>';
print_r($array1);
echo '<b>Main array:</b><br>';
print_r($mainArray);
echo '</pre> Result: ';
descendingSort($array1, $mainArray);

/* Function check input
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

/* Function number 1 in first array
 *  @params first array.
 *  @return a string result.
 */
function findNumberOne($firstArray)
{
    echo (in_array(1, $firstArray)) ? '<b>Found</b>' : '<b>Not found</b>';
    echo '<br>';
}

/* Function merge 2 array in position 2 and 3, delete duplicate values
 *  @params second array and third array.
 *  @return a string result.
 */
function mergeArrays($secondArray, $thirdArray)
{
    $arrayUnduplicate = array_unique(array_merge($secondArray, $thirdArray));
    $GLOBALS['mainArray'] = $arrayUnduplicate;
    $result = implode(', ', $arrayUnduplicate);
    echo '<b>' . $result . '</b><br>';
}

/* Function filter out all values whose sum of digits is divisible by 2
 *  @params main array.
 *  @return a string result.
 */
function evenArray($mainArray)
{
    $arrayFilter = array_filter($mainArray, function ($value) {
        $total = 0;
        while ($value % 10 != 0) {
            $total += $value % 10;
            $value = $value / 10;
        }
        return ($total % 2 == 0) ? true : false;
    });
    $result = implode(', ', $arrayFilter);
    echo '<b>' . $result . '</b><br>';
}

/* Function ascending sort all of the value of the first array that exists in the main array
 *  @params first array and main array.
 *  @return a string result.
 */
function ascendingSort($array1, $mainArray)
{
    $arrayResult = array_intersect($array1, $mainArray);
    asort($arrayResult);
    $result = implode(', ', $arrayResult);
    echo '<b>' . $result . '</b><br>';
}

/* Function descending sort all the descending value of the first array whose key is not in the main array
 *  @params first array and main array.
 *  @return a string result.
 */
function descendingSort($array1, $mainArray)
{
    $arrayResult = array_diff_key($array1, $mainArray);
    arsort($arrayResult);
    $result = implode(', ', $arrayResult);
    echo '<b>' . $result . '</b><br>';
}
