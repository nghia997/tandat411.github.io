<?php
	include_once("config/connection.php");

    session_start();
	$db       = new Database();
	$name     = $_POST["txtName"].trim();
    $password = $_POST["txtPass"];
    $email    = $_POST["txtEmail"].trim();
    $birthDay = $_POST["txtBirth"];

	if (isset($_POST["btnSubmit"])) {
        if (empty($name)) {
            $_SESSION["errorName"] = "User name must not be empty.";
        }
        else if (strlen($name) < 8) {
            $_SESSION["errorName"] = "User name must be more than 8 characters.";
        }

        if (empty($password)) {
            $_SESSION["errorPass"] = "Password must not be empty.";
        } else if (strlen($password) < 8) {
            $_SESSION["errorPass"] = "Password must be more than 8 characters.";
        }

        if (empty($email)) {
            $_SESSION["errorEmail"] = "Email must not be empty.";
        } else if (strlen($email) < 8) {
            $_SESSION["errorEmail"] = "Email must be more than 8 characters.";
        } else {
            $regex = "/^([\w0-9_\.\-])+\@(([\w0-9\-])+\.)+([\w0-9]{2,4})+$/";
            $a = preg_match($regex, $email);
            if (!$a) {
                $_SESSION["errorEmail"] = "Wrong email format.";
            }
        }

        if (empty($birthDay)) {
            $_SESSION["errorBirth"] = "Day of birth must not be empty.";
        } else {
            $toDay = date('d/m/Y');
            $arr = explode('/', $birthDay);
            $newDate = $arr[2]."/".$arr[1]."/".$arr[0];
            $thisDay = date('d/m/Y', strtotime($newDate));
            if ($thisDay > $toDay) {
                $_SESSION["errorBirth"] = "Day of birth can't be greater than the current date.";
            }
        }


        header("location: index.php");
    }


?>