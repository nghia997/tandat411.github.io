<?php
$name = 'Mai Lâm Tấn Đạt';

try {
    checkInput($name);
} catch (LogicException $e) {
    echo $e->getMessage();
}

echo "Result of string '$name' is ";
checkMultiByte($name);

/* Function check input
 *  @params array $param1 to check.
 *  @throw LogicException with message "Invalid parameter" if one of them is not a string
 *  @return void.
 */
function checkInput($param1)
{
    if (is_string($param1)) {
        echo 'Correct input<br><hr>';
    } else {
        throw new LogicException('Invalid parameter');
    }
}

/* Function check input
 *  @params string $name to check this is a multi-bytes string or single-byte string.
 *  @return void.
 */
function checkMultiByte($name)
{
    $lenght = mb_strlen($name);
    if (strlen($name) != $lenght) {
        echo '<b>TRUE, this is a multi-bytes string</b>';
    } else {
        echo '<b>FALSE, this is a single-byte string</b>';
    }
}