<?php
session_start();
session_destroy();
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>Update User</title>
</head>
<body>
  <?php
  //Check the variable 'editID' are exist or not
    if (empty($_GET['editID'])) {
      die('Failed to update..');
    }
  ?>
  <div class="container">
    <h1>EDIT USER ID: <?=$_GET['editID']?></h1>
    <form action=<?="controllers/UserController.php?editID=".$_GET['editID']?> method="post">
      <table class="table-edit">
        <tr>
          <td class="label">Username:</td>
          <td>
            <input type="text" name="txtName">
            <p class="validate">
                <?php if (isset($_SESSION['emptyName'])) {echo $_SESSION['emptyName'];} ?>
            </p>
          </td>
        </tr>
        <tr>
          <td class="label">Password:</td>
          <td>
            <input type="password" name="txtPass">
            <p class="validate">
                <?php if (isset($_SESSION['emptyPass'])) {echo $_SESSION['emptyPass'];} ?>
            </p>
          </td>
        </tr>
        <tr>
          <td class="label">Email:</td>
          <td>
            <input type="email" name="txtEmail">
            <p class="validate">
                <?php if (isset($_SESSION['emptyEmail'])) {echo $_SESSION['emptyEmail'];} ?>
            </p>
          </td>
        </tr>
        <tr>
          <td class="label">Birthday:</td>
          <td>
            <input type="date" name="txtDoB">
            <p class="validate">
                <?php if (isset($_SESSION['emptyDoB'])) {echo $_SESSION['emptyDoB'];} ?>
            </p>
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Save"></td>
        </tr>
      </table>
    </form>
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
