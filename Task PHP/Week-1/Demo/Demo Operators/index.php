<?php
/*Sự khác nhau giữa == và === là:
== là so sánh giá trị giữa 2 biến
=== là so sánh giá trị và kiểu dữ liệu của 2 biến*/
$a = 2;
$b = '2';
$temp = true;

echo '<b>So sánh sự khác nhau giữa số 2 và chuỗi "2":</b><br>';
echo '- Sử dụng operator "==":<br>';
echo var_dump($a == $b) . '<br>';
echo '- Sử dụng operator "===":<br>';
echo var_dump($a === $b) .'<br><br>';

echo '<b>Trường hợp trả về true của hàm empty() và hàm isset():</b><br>';
// empty() trả về true khi giá trị = null, 0, 0.0, false, '' hoặc 1 biến chưa được khai báo
echo '- Sử dụng empty() khi truyền vào 1 biến chưa được khai báo:<br>';
echo var_dump(empty($anonymous)).'<br>';
echo '- Sử dụng empty() với giá trị = <b>array()</b>:<br>';
echo var_dump(empty($temp = [])).'<br>';
echo '- Sử dụng empty() với giá trị = <b>false</b>:<br>';
echo var_dump(empty($temp = false)).'<br>';
echo '- Sử dụng empty() với giá trị = <b>""</b>:<br>';
echo var_dump(empty($temp = "")).'<br>';
echo '- Sử dụng empty() với giá trị = <b>0</b>:<br>';
echo var_dump(empty($temp = 0)).'<br>';
echo '- Sử dụng empty() với giá trị = <b>0.0</b>:<br>';
echo var_dump(empty($temp = 0.0)).'<br>';

// isset() trả về true khi được gán giá trị cụ thể trừ giá trị = null
echo '- Sử dụng isset() với giá trị = <b>true</b>:<br>';
$temp = true;
echo var_dump(isset($temp)).'<br>';
echo '- Sử dụng isset() với giá trị = <b>false</b>:<br>';
$temp = false;
echo var_dump(isset($temp)).'<br>';
echo '- Sử dụng isset() với giá trị = <b>""</b>:<br>';
$temp = "";
echo var_dump(isset($temp)).'<br>';
echo '- Sử dụng isset() với giá trị = <b>"Đạt"</b>:<br>';
$temp = "Đạt";
echo var_dump(isset($temp)).'<br>';
echo '- Sử dụng isset() với giá trị = <b>0</b>:<br>';
$temp = 0;
echo var_dump(isset($temp)).'<br>';
echo '- Sử dụng isset() với giá trị = <b>0.0</b>:<br>';
$temp = 0.0;
echo var_dump(isset($temp)).'<br><br>';

echo '<b>Trường hợp trả về false của hàm empty() và hàm isset():</b><br>';
// empty() trả về false khi biến có giá trị được gán cụ thể khác 0 và 0.0, chuỗi có độ dài > 0, true
echo '- Sử dụng empty() với giá trị = <b>true</b>:<br>';
echo var_dump(empty($temp = true)).'<br>';
echo '- Sử dụng empty() với giá trị = <b>" "</b>:<br>';
echo var_dump(empty($temp = " ")).'<br>';
echo '- Sử dụng empty() với giá trị = <b>"Đạt"</b>:<br>';
echo var_dump(empty($temp = "Đạt")).'<br>';
echo '- Sử dụng empty() với giá trị = <b>1</b>:<br>';
echo var_dump(empty($temp = 1)).'<br>';
echo '- Sử dụng empty() với giá trị = <b>-0.1</b>:<br>';
echo var_dump(empty($temp = -0.1)).'<br>';

// isset() trả về false khi giá trị = null hoặc khi biến đó chưa được khai báo
echo '- Sử dụng isset() với 1 biến chưa được khai báo:<br>';
echo var_dump(isset($anonymous)).'<br>';
echo '- Sử dụng isset() với giá trị = <b>null</b>:<br>';
$temp = null;
echo var_dump(isset($temp)).'<br>';
