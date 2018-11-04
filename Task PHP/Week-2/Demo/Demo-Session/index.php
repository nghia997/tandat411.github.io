<?php
session_start();

// Create Session 'counter'
$_SESSION['counter'] = (isset($_SESSION['counter'])) ? $_SESSION['counter'] += 1 : $_SESSION['counter'] = 1;

// Delete Session 'counter'
if (isset($_GET['btDelete'])) {
  unset($_SESSION['counter']);
}
?>

<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Session - PHP</title>
</head>
<body>
<form action="index.php" method="get">
  <!--Check Session 'counter' are exist or not-->
    <?= (isset($_SESSION['counter'])) ? 'Bạn đã truy cập vào trang này <b>' . $_SESSION['counter'] .
        '</b> lần trong Session này.<br><button name="btDelete">Xóa Session</button>' : 'Session đã bị xóa..'?>
</form>
</body>
</html>
