<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
  <form id="js-form" action="ajax.php" method="post" enctype="multipart/form-data">
    <input type="file" id="js-file" name="fileUpload">
    <input type="submit" id="js-btSubmit" name="btSubmit" value="Upload">
  </form>
  <div class="progress" id="js-progress">
    <p>Progress:
      <span class="progress_percent" id="js-progress_percent">0%</span>
      <span id="js-result"></span>
    </p>
    <div class="progress_bar" id="js-progress_bar"></div>
  </div>
</div>

  <!--SCRIPT-->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/action.js"></script>
</body>
</html>