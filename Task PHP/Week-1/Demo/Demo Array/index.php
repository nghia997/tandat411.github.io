<?php
$arrayNumber = ['D' => 5, 'F' => 9, 'G' => 1, 'A' => 8, 'E' => 8, 'B' => 0, 'C' => 99, 'H' => 5];
$arrayInfo = ['name' => 'Mai Lâm tấn Đạt', 'ages' => 21, 'sex' => 'male'];
$name = "Mai Lâm Tấn Đạt";

demoSort($arrayNumber);
echo '<hr>';
demoArrayUnique($arrayNumber);
echo '<hr>';
demoExplode($name);
echo '<hr>';
demoImplode($name);
echo '<hr>';
demoArrayKeys($arrayInfo);
echo '<hr>';
demoArrayValues($arrayInfo);
echo '<hr>';
demoInArray($arrayNumber);
echo '<hr>';
demoArrayShift($arrayNumber);
echo '<hr>';
demoArrayUnshift($arrayNumber);
echo '<hr>';
demoArrayPop($arrayNumber);
echo '<hr>';
demoArrayDiff();
echo '<hr>';
demoArrayDiffKey();
echo '<hr>';
demoArrayIntersect();
echo '<hr>';
demoArrayIntersectKey();
echo '<hr>';
demoArrayMerge();
echo '<hr>';
demoMergeRecursive();
echo '<hr>';
demoArrayAddArray();
echo '<hr>';
demoArrayFilter($arrayNumber);
echo '<hr>';
demoArrayMap();
echo '<hr>';
demoArrayWalk();

/**
 * Function sort an array to ascending, descending with KEY or VALUE
 * @param array $arrayNumber is a integer array to sort
 * @return void
 */
function demoSort($arrayNumber)
{
    echo '<b>Mảng số nguyên ban đầu:</b>';
    echo '<pre>';
    print_r($arrayNumber);
    echo '</pre>';
    echo '<b>Sắp xếp theo value:</b><br>';

    // ASORT()
    echo '- Sử dụng hàm <b>asort()</b> để sắp xếp mảng số nguyên tăng dần theo VALUE: <br>';
    asort($arrayNumber);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayNumber);
    echo '</pre>';

    // ARSORT()
    echo '<br>- Sử dụng hàm <b>arsort()</b> để sắp xếp mảng số nguyên giảm dần theo VALUE: <br>';
    arsort($arrayNumber);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayNumber);
    echo '</pre>';
    echo '<b>Sắp xếp theo key:</b><br>';

    // KSORT()
    echo '- Sử dụng hàm <b>ksort()</b> để sắp xếp mảng số nguyên tăng dần theo KEY: <br>';
    ksort($arrayNumber);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayNumber);
    echo '</pre>';

    // KRSORT()
    echo '<br>- Sử dụng hàm <b>krsort()</b> để sắp xếp mảng số nguyên giảm dần theo KEY: <br>';
    krsort($arrayNumber);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayNumber);
    echo '</pre>';
}

/**
 * Function to get all values not duplicate in an array
 * @param array $arrayNumber is a integer array to fill
 * @return void
 */
function demoArrayUnique($arrayNumber)
{
    echo '- Sử dụng hàm <b>array_unique()</b> để xóa những giá trị trùng lặp trong mảng: <br>';
    echo '<b>Mảng số nguyên ban đầu:</b>';
    echo '<pre>';
    print_r($arrayNumber);
    echo '</pre>';
    // ARRAY_UNIQUE()
    $result = array_unique($arrayNumber);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($result);
    echo '</pre>';
}

/**
 * Function to split a string to an array with input delimiter
 * @param string $name is a string to split.
 * @return void
 */
function demoExplode(&$name)
{
    echo '- Sử dụng hàm <b>explode()</b> để cắt một chuỗi thành mảng với chuỗi cắt là " ": <br>';
    echo '<b>Chuỗi ban đầu: </b>' . $name . '<br>';
    $name = explode(' ', $name);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($name);
    echo '</pre>';
}

/**
 * Function to join an array to string with input delimiter
 * @param array $arrayName to join and convert to string.
 * @return void
 */
function demoImplode(&$arrayName)
{
    echo '- Sử dụng hàm <b>implode()</b> để nối một mảng thành chuỗi phân cách nhau bởi ký tự " ": <br>';
    echo '<b>Mảng chuỗi ban đầu:</b>';
    echo '<pre>';
    print_r($arrayName);
    echo '</pre>';
    $result = implode(' ', $arrayName);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($result);
    echo '</pre>';
}

/**
 * Function to get all keys in array
 * @param array $arrayInfo to get the key.
 * @return void
 */
function demoArrayKeys($arrayInfo)
{
    echo '- Sử dụng hàm <b>array_keys()</b> để lấy toàn bộ các key trong mảng và lấy 1 key với value = <b>21</b>: <br>';
    echo '<b>Mảng thông tin ban đầu:</b>';
    echo '<pre>';
    print_r($arrayInfo);
    echo '</pre>';
    $result = array_keys($arrayInfo);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($result);
    echo '</pre>';
    $result = array_keys($arrayInfo, 21);
    echo '<pre>';
    print_r($result);
    echo '</pre>';
}

/**
 * Function to get all values in array
 * @param array $arrayInfo to get the value.
 * @return void
 */
function demoArrayValues($arrayInfo)
{
    echo '- Sử dụng hàm <b>array_values()</b> để lấy về 1 mảng liên tục: <br>';
    echo '<b>Mảng thông tin ban đầu:</b>';
    echo '<pre>';
    print_r($arrayInfo);
    echo '</pre>';
    $result = array_values($arrayInfo);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($result);
    echo '</pre>';
}

/**
 * Function to find a value in array
 * @param array $arrayNumber to find the value.
 * @return void
 */
function demoInArray($arrayNumber)
{
    echo '- Sử dụng hàm <b>in_array()</b> để tìm VALUE trong mảng số nguyên: <br>';
    echo '<b>Mảng số nguyên ban đầu:</b>';
    echo '<pre>';
    print_r($arrayNumber);
    echo '</pre>';
    $valueTrue = 99;
    $valueFalse = 88;
    echo '<br>  . Tìm giá trị = <b>' . $valueTrue . '</b> trong mảng số nguyên: <br>';
    $result = in_array($valueTrue, $arrayNumber);
    echo '<b>Kết quả:</b><br><pre>';
    var_dump($result);
    echo '</pre>';
    echo '  . Tìm giá trị = <b>' . $valueFalse . '</b> trong mảng số nguyên: <br>';
    $result = in_array($valueFalse, $arrayNumber);
    echo '<pre>';
    var_dump($result);
    echo '</pre>';
}

/**
 * Function to remove first position in array
 * @param array $arrayNumber.
 * @return void
 */
function demoArrayShift($arrayNumber)
{
    echo '- Sử dụng hàm <b>array_shift()</b> để xóa phần tử đầu trong mảng số nguyên: <br>';
    echo '<b>Mảng số nguyên hiện tại:</b>';
    echo '<pre>';
    print_r($arrayNumber);
    echo '</pre>';

    $valueDeleted = array_shift($arrayNumber);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayNumber);
    echo '</pre>';
    echo 'Phần tử bị xóa đi là: <b>' . $valueDeleted . '</b>';
}

/**
 * Function to add 1 or more values in first position of array
 * @param array $arrayNumber.
 * @return void
 */
function demoArrayUnshift($arrayNumber)
{
    echo '<br><br>- Sử dụng hàm <b>array_unshift()</b> để thêm vào 1 hoặc nhiều phần tử vào đầu mảng số nguyên: <br>';
    echo '<b>Mảng số nguyên hiện tại:</b>';
    echo '<pre>';
    print_r($arrayNumber);
    echo '</pre>';
    $firstValue = 5;
    $secondValue = 20;
    echo 'Thêm vào phần tử đầu với 2 giá trị là:<b>' . $firstValue . ' và ' . $secondValue . ' </b><br>';
    array_unshift($arrayNumber, $firstValue, $secondValue);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayNumber);
    echo '</pre>';
}

/**
 * Function to remove last position of array
 * @param array $arrayNumber.
 * @return void
 */
function demoArrayPop($arrayNumber)
{
    echo '<br>- Sử dụng hàm <b>array_pop()</b> để xóa phần tử cuối của mảng số nguyên: <br>';
    echo '<b>Mảng số nguyên hiện tại:</b>';
    echo '<pre>';
    print_r($arrayNumber);
    echo '</pre>';

    $valueDeleted = array_pop($arrayNumber);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayNumber);
    echo '</pre>';
    echo 'Phần tử bị xóa đi là: <b>' . $valueDeleted . '</b>';
}

/**
 * Function to get all values of first array which not exist in second array
 * @return void
 */
function demoArrayDiff()
{
    $firstArray = ['name' => 'Đạt', 'ages' => 20, 'sex' => 'male', 'country' => 'Bến Tre'];
    $secondArray = ['name' => 'Đạt', 'ages' => 21, 'sex' => 'male', 'phone' => '0347439597'];

    echo '<br><br>- Sử dụng hàm <b>array_diff()</b> để lấy VALUE những phần tử trong mảng đầu tiên <i>không tồn tại</i> trong mảng thứ 2: <br>';
    echo '<b>Mảng thứ 1:</b>';
    echo '<pre>';
    print_r($firstArray);
    echo '</pre>';
    echo '<b>Mảng thứ 2:</b>';
    echo '<pre>';
    print_r($secondArray);
    echo '</pre>';

    $arrayDiff = array_diff($firstArray, $secondArray);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayDiff);
    echo '</pre>';
}

/**
 * Function to get all keys of first array which not exist in second array
 * @return void
 */
function demoArrayDiffKey()
{
    $firstArray = ['name' => 'Đạt', 'ages' => 20, 'sex' => 'male', 'country' => 'Bến Tre'];
    $secondArray = ['name' => 'Đạt', 'ages' => 21, 'sex' => 'male', 'phone' => '0347439597'];

    echo '<br>- Sử dụng hàm <b>array_diff_key()</b> để lấy những phần tử trong mảng đầu tiên có KEY <i>không tồn tại</i> trong mảng thứ 2: <br>';
    echo '<b>Mảng thứ 1:</b>';
    echo '<pre>';
    print_r($firstArray);
    echo '</pre>';
    echo '<b>Mảng thứ 2:</b>';
    echo '<pre>';
    print_r($secondArray);
    echo '</pre>';

    $arrayDiff = array_diff_key($firstArray, $secondArray);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayDiff);
    echo '</pre>';
}

/**
 * Function to get all values of first array which exist in second array
 * @return void
 */
function demoArrayIntersect()
{
    $firstArray = ['name' => 'Đạt', 'ages' => 20, 'sex' => 'male', 'country' => 'Bến Tre'];
    $secondArray = ['name' => 'Đạt', 'ages' => 21, 'sex' => 'male', 'phone' => '0347439597'];

    echo '<br>- Sử dụng hàm <b>array_intersect()</b> để lấy những phần tử trong mảng đầu tiên có VALUE <i>tồn tại</i> trong mảng thứ 2: <br>';
    echo '<b>Mảng thứ 1:</b>';
    echo '<pre>';
    print_r($firstArray);
    echo '</pre>';
    echo '<b>Mảng thứ 2:</b>';
    echo '<pre>';
    print_r($secondArray);
    echo '</pre>';

    $arrayIntersect = array_intersect($firstArray, $secondArray);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayIntersect);
    echo '</pre>';
}

/**
 * Function to get all keys of first array which exist in second array
 * @return void
 */
function demoArrayIntersectKey()
{
    $firstArray = ['name' => 'Đạt', 'ages' => 20, 'sex' => 'male', 'country' => 'Bến Tre'];
    $secondArray = ['name' => 'Đạt', 'ages' => 21, 'sex' => 'male', 'phone' => '0347439597'];

    echo '<br>- Sử dụng hàm <b>array_intersect_key()</b> để lấy những phần tử trong mảng đầu tiên có KEY <i>tồn tại</i> trong mảng thứ 2: <br>';
    echo '<b>Mảng thứ 1:</b>';
    echo '<pre>';
    print_r($firstArray);
    echo '</pre>';
    echo '<b>Mảng thứ 2:</b>';
    echo '<pre>';
    print_r($secondArray);
    echo '</pre>';

    $arrayIntersect = array_intersect_key($firstArray, $secondArray);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayIntersect);
    echo '</pre>';
}

/**
 * Function to merge all values of all input arrays if duplicate key will get values of last array
 * @return void
 */
function demoArrayMerge()
{
    $firstArray = ['name' => 'Đạt', 'ages' => 20, 'sex' => 'male', 'country' => 'Bến Tre'];
    $secondArray = ['name' => 'Tấn Đạt', 'ages' => 21, 'sex' => 'male', 'phone' => '0347439597'];

    echo '<br>- Sử dụng hàm <b>array_merge()</b> để gộp toàn bộ phần tử của các mảng nếu trùng Key sẽ lấy phần tử của mảng cuối cùng: <br>';
    echo '<b>Mảng thứ 1:</b>';
    echo '<pre>';
    print_r($firstArray);
    echo '</pre>';
    echo '<b>Mảng thứ 2:</b>';
    echo '<pre>';
    print_r($secondArray);
    echo '</pre>';

    $arrayMerge = array_merge($firstArray, $secondArray);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayMerge);
    echo '</pre>';
}

/**
 * Function to merge all values of all arrays if duplicate key will create an array
 * @return void
 */
function demoMergeRecursive()
{
    $firstArray = ['name' => 'Đạt', 'ages' => 20, 'sex' => 'male', 'country' => 'Bến Tre'];
    $secondArray = ['name' => 'Tấn Đạt', 'ages' => 21, 'sex' => 'male', 'phone' => '0347439597'];
    echo '<br>- Sử dụng hàm <b>array_merge()</b> để gộp toàn bộ phần tử của các mảng nếu trùng KEY sẽ tạo thành mảng liên tục: <br>';
    echo '<b>Mảng thứ 1:</b>';
    echo '<pre>';
    print_r($firstArray);
    echo '</pre>';
    echo '<b>Mảng thứ 2:</b>';
    echo '<pre>';
    print_r($secondArray);
    echo '</pre>';

    $arrayMerge = array_merge_recursive($firstArray, $secondArray);
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayMerge);
    echo '</pre>';
}

/**
 * Function to plus 2 arrays if key duplicate will get the value of first array
 * @return void
 */
function demoArrayAddArray()
{
    $firstArray = ['name' => 'Đạt', 'ages' => 20, 'sex' => 'male', 'country' => 'Bến Tre'];
    $secondArray = ['name' => 'Tấn Đạt', 'ages' => 21, 'sex' => 'male', 'phone' => '0347439597'];

    echo '<br>- Sử dụng <b>array + array</b> để gộp toàn bộ phần tử của các mảng nếu trùng KEY sẽ lấy phần tử của mảng đầu tiên: <br>';
    echo '<b>Mảng thứ 1:</b>';
    echo '<pre>';
    print_r($firstArray);
    echo '</pre>';
    echo '<b>Mảng thứ 2:</b>';
    echo '<pre>';
    print_r($secondArray);
    echo '</pre>';

    $arrayMerge = $firstArray + $secondArray;
    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayMerge);
    echo '</pre>';
}

/**
 * Function to merge all values of all arrays if duplicate key will create an array
 * @return void
 */
function demoArrayFilter($arrayNumber)
{
    echo '<br>- Sử dụng hàm <b>array_filter()</b> để lọc phần tử chẵn và lẻ tương ứng với hàm callback() trả về: <br>';
    echo '<b>Mảng số nguyên ban đầu:</b>';
    echo '<pre>';
    print_r($arrayNumber);
    echo '</pre>';
    $evenArray = array_filter($arrayNumber, function ($value) {
        return ($value % 2 == 0) ? true : false;
    });
    $oddArray = array_filter($arrayNumber, function ($value) {
        return ($value % 2 != 0) ? true : false;
    });
    echo '<b>Kết quả:</b><br>';
    echo 'Mảng sổ lẻ:<pre>';
    print_r($oddArray);
    echo '</pre>';
    echo 'Mảng số chẵn: <pre>';
    print_r($evenArray);
    echo '</pre>';
}

/**
 * Function to join all values by position in array with callback function
 * @return void
 */
function demoArrayMap()
{
    $arrayFirstName = ['Mai Lâm Tấn', 'Lý Thiên', 'Huỳnh Quốc'];
    $arrayLastName = ['Đạt', 'Hưng', 'Khánh'];

    echo '<br>- Sử dụng hàm <b>array_map()</b> để lấy họ và tên từ 2 mảng dữ liệu Họ, Tên: <br>';
    echo '<b>Mảng dữ liệu Họ:</b>';
    echo '<pre>';
    print_r($arrayFirstName);
    echo '</pre>';
    echo '<b>Mảng dữ liệu Tên:</b>';
    echo '<pre>';
    print_r($arrayLastName);
    echo '</pre>';
    $arrayMap = array_map(function ($arrayFirstName, $arrayLastName) {
        return $arrayFirstName . ' ' . $arrayLastName;
    }, $arrayFirstName, $arrayLastName);

    echo '<b>Kết quả:</b><br><pre>';
    print_r($arrayMap);
    echo '</pre>';
}

/**
 * Function to get all values by position in array with callback function
 * @return void
 */
function demoArrayWalk()
{
    $arrayName = ['Đạt', 'Hưng', 'Khánh'];
    $text = '- Đây là dữ liệu của KEY ';

    echo '<br>- Sử dụng hàm <b>array_walk()</b> để xuất ra thông tin của mảng: <br>';
    echo '<b>Mảng dữ liệu 1:</b>';
    echo '<pre>';
    print_r($arrayName);
    echo '</pre>';

    echo '<b>Kết quả:</b><br>';
    array_walk($arrayName, function ($value, $key, $text) {
        echo $text . $key . ': ' . $value . '<br>';
    }, $text);
}
