<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>List User</title>
</head>
<body>
  <div class="container">
    <button onclick="location='insert.php'">Add a new User</button>
    <button class="btn-show" id="js-btn-show">Show list users</button>
    <table class="table-show" id="js-users"></table>
  </div>

  <!--SCRIPT-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/action.js"></script>
<?php
  //Check the Session 'result' are exist or not
  if (isset($_SESSION['result'])) {echo "<script>alert('".$_SESSION['result']."');</script>";}
?>
</body>
</html>
