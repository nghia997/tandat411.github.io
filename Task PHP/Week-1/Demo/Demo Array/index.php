<?php
// Tạo array
$array = [];

// Thêm phần tử trong array
$array[] = 'Lâm';

// hàm array_unshift() để thêm phần tử vào đầu mảng
array_unshift($array, 'Mai');

// hàm array_push() để thêm phần tử vào cuối mảng
array_push($array, 'Tấn');
array_push($array, 'Đạt');

print_r($array);

echo '<br>';

// Hiển thị các phần tử trong mảng
$length = count($array);
for ($i = 0; $i < $length; $i++) {
    echo $array[$i].' ';
}

echo '<br>';

// Sắp xếp array theo value
$arrayNumber = ['D' => 5, 'F' => 9, 'G' => 1, 'A' => 8, 'E' => 8, 'B' => 0, 'C' => 99, 'H' => 5];
echo '<b>Mảng số nguyên ban đầu:</b>';
echo '<pre>';
print_r($arrayNumber);
echo '</pre>';
echo '<b>Sắp xếp theo value:</b><br>';
// ASORT()
echo '- Sử dụng hàm <b>asort()</b> để sắp xếp mảng số nguyên tăng dần: <br>';
// hàm asort() để sắp xếp theo value tăng dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
asort($arrayNumber);
echo '<pre>';
print_r($arrayNumber);
echo '</pre>';
// ARSORT()
echo '<br>- Sử dụng hàm <b>arsort()</b> để sắp xếp mảng số nguyên giảm dần: <br>';
// hàm arsort() để sắp xếp theo value giảm dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
arsort($arrayNumber);
echo '<pre>';
print_r($arrayNumber);
echo '</pre>';

echo '<b>Sắp xếp theo key:</b><br>';
// KSORT()
echo '- Sử dụng hàm <b>ksort()</b> để sắp xếp mảng số nguyên tăng dần: <br>';
// hàm arsort() để sắp xếp theo value giảm dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
ksort($arrayNumber);
echo '<pre>';
print_r($arrayNumber);
echo '</pre>';

// KRSORT()
echo '<br>- Sử dụng hàm <b>krsort()</b> để sắp xếp mảng số nguyên giảm dần: <br>';
// hàm arsort() để sắp xếp theo value giảm dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
krsort($arrayNumber);
echo '<pre>';
print_r($arrayNumber);
echo '</pre>';

// ARRAY_UNIQUE()
echo '<br>- Sử dụng hàm <b>array_unique()</b> để xóa những giá trị trùng lặp trong mảng: <br>';
// hàm arsort() để sắp xếp theo value giảm dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
$result = array_unique($arrayNumber);
echo '<pre>';
print_r($result);
echo '</pre>';

$name = "Mai Lâm Tấn Đạt";
echo '<b>Chuỗi ban đầu: </b>'.$name.'<br>';

// EXPLODE()
echo '<br>- Sử dụng hàm <b>explode()</b> để cắt một chuỗi thành mảng với chuỗi cắt là " ": <br>';
// hàm arsort() để sắp xếp theo value giảm dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
$name = explode(' ', $name);
echo '<pre>';
print_r($name);
echo '</pre>';

// IMPLODE()
echo '<br>- Sử dụng hàm <b>implode()</b> để nối một mảng thành chuỗi phân cách nhau bởi ký tự " ": <br>';
// hàm arsort() để sắp xếp theo value giảm dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
$result = implode(' ', $name);
echo '<pre>';
print_r($result);
echo '</pre>';

$arrayInfo = ['name' => 'Mai Lâm tấn Đạt', 'ages' => 21, 'sex' => 'male'];
echo '<b>Mảng thông tin ban đầu:</b>';
echo '<pre>';
print_r($arrayInfo);
echo '</pre>';
// ARRAY_KEYS()
echo '<br>- Sử dụng hàm <b>array_keys()</b> để lấy toàn bộ các key trong mảng và lấy 1 key với value = <b>21</b>: <br>';
// hàm arsort() để sắp xếp theo value giảm dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
$result = array_keys($arrayInfo);
echo '<pre>';
print_r($result);
echo '</pre>';
$result = array_keys($arrayInfo, 21);
echo '<pre>';
print_r($result);
echo '</pre>';

// ARRAY_KEYS()
echo '<br>- Sử dụng hàm <b>array_values()</b> để lấy về 1 mảng liên tục: <br>';
// hàm arsort() để sắp xếp theo value giảm dần nếu là chuỗi sẽ theo bảng chữ cái alphabet nếu là số thì theo từ nhỏ -> lớn
$result = array_values($arrayInfo);
echo '<pre>';
print_r($result);
echo '</pre>';



