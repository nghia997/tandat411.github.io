<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Domain 2</title>
</head>
<body>
    <form action="validate2.php" method="post">
        <p>ID session:</p>
        <input type="text" name="txtSessionKey">
        <h1>
            <?php
            // Check cookie('errorKey') are exist or not
                if (isset($_COOKIE['errorKey'])) {
                    echo $_COOKIE['errorKey'];
                }
            ?>
        </h1>
        <input type="submit" name="btRead" value="Read Session">
    </form>
</body>
</html>