<?php
    //Create Cookie 'name' with value 'Mai Lâm Tấn Đạt' and exist in 1h
    setcookie('name', 'Mai Lâm Tấn Đạt', time() + 3600);

    // Check on click button 'Xóa Cookie'
    if (isset($_GET['btDelete'])) {
        // Delete Cookie 'name'
        setcookie('name', '', time() - 3600);
        header('Location: index.php');
    }
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cookie - PHP</title>
</head>
<body>
    <form action="index.php" method="get">
       <!--Check Cookie 'name' are exist or not-->
        <?= (isset($_COOKIE['name'])) ? 'Giá trị của Cookie vừa tạo: <b>' . $_COOKIE['name'] .
            '</b><br><button name="btDelete">Xóa Cookie</button>' : 'Cookie đã bị xóa..'?>
    </form>
</body>
</html>
