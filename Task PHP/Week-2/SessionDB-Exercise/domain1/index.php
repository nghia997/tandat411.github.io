<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Domain 1</title>
</head>
<body>
  <h1>
      <?php
      if (isset($_COOKIE['success'])) {
          echo $_COOKIE['success'];
      }
      ?>
  </h1>
    <form action="validate1.php" method="post">
        <p>ID session:</p>
        <input type="text" name="txtSessionKey">
        <h1>
            <?php
                if (isset($_COOKIE['errorKey'])) {
                    echo $_COOKIE['errorKey'];
                }
            ?>
        </h1>
        <p>Value session:</p>
        <input type="text" name="txtSessionValue">
        <h1>
            <?php
                if (isset($_COOKIE['errorValue'])) {
                    echo $_COOKIE['errorValue'];
                }
            ?>

        </h1>
        <input type="submit" name="btCreate" value="Create Session">
    </form>
</body>
</html>