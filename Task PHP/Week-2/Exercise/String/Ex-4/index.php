<?php
$trim = 'trim';

try {
    checkInput($trim);
} catch (LogicException $e) {
    echo $e->getMessage();
    die();
}

echo "1. Remove the 'm' from the string 'trim':<br>Result: ";
deleteM($trim);
echo "<br><br>2. Reverse the string 'trim' and use the ltrim():<br>Result: ";
reverseString($trim);

/**
 * Function check input
 * @params array $param1 to check.
 * @throw LogicException with message "Invalid parameter" if one of them is not a string
 * @return void.
 */
function checkInput($param1)
{
    // Check input parameter is a string or not
    if (is_string($param1)) {
        echo 'Correct input<br><hr>';
    } else {
        throw new LogicException('Invalid parameter');
    }
}

/**
 * Function delete character 'm' in string 'trim'
 * @params string $trim is a main string to delete.
 * @return void.
 */
function deleteM($trim)
{
    echo rtrim($trim, 'm');
}

/**
 * Function delete character 'm' in string 'trim'
 * @params string $trim is a main string to delete.
 * @return void.
 */
function reverseString($trim)
{
    $result = '';
    $lenght = strlen($trim);
    // Run loop while to cut a single character in a string
    while ($lenght > 0) {
        $result .= ltrim($trim, substr($trim, 0, $lenght - 1));
        $trim = substr($trim, 0, $lenght - 1);
        $lenght--;
    }
    echo $result;
}
