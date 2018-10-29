<!--Use long tag to define variables-->
<?php
    $toDay = date('d/m/Y');
    list($name, $old) = ["Mai Lâm Tấn Đạt", 21];
    define('VARIABLE_CONST', 'This is value of VARIABLE_CONST');
    $textMultiLine = <<<EOL
    Đây
    là
    chuỗi
    được
    viết
    trên
    nhiều
    dòng <br>
EOL;
?>

<!--Use short tag to echo all variables-->
<?=
    'Biến textMultiLine với giá trị là một chuỗi được khai báo với multiple lines: <b>' . $textMultiLine . '</b>' .
    'Biến toDay: <b>' . $toDay . '</b><br>' .
    'Các biến trong list variable (name, old): <b>'.$name . ' - ' . $old . '</b><br>' .
    'Biến khai báo hằng VARIABLE_CONST: <b>' . constant('VARIABLE_CONST') . '</b>'
?>
