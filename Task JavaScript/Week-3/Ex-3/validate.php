<?php
	include_once("config/connection.php");

    session_start();
	$db        = new Database();
	$name      = trim($_POST["txtName"]);
    $password  = $_POST["txtPass"];
    // Hash password to bcrypt
    $hash_pass = password_hash($_POST["txtPass"], PASSWORD_BCRYPT);
    $email     = trim($_POST["txtEmail"]);
    $birthDay  = $_POST["txtBirth"];

    /* If user click on button Submit:
        - Check validate for all input.
        - If fail: make sessions with error text for any input incorrect.
        - Else: Insert all value to database.
        - Return back to from submit.
    */
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
            header("location: index.php");
        } else {
            $toDay = date('d/m/Y');
            $arr = explode('/', $birthDay);
            $newDate = $arr[2]."/".$arr[1]."/".$arr[0];
            $thisDay = date('d/m/Y', strtotime($newDate));
            if ($thisDay > $toDay) {
                $_SESSION["errorBirth"] = "Day of birth can't be greater than the current date.";
                header("location: index.php");
            } else if ($db->insertUser($name, $hash_pass, $email, $birthDay)) {
                setcookie("success", "Congratulation! Your submit are success.", time() + 3);
            }
        }
        header("location: index.php");
    }

    if (isset($_POST["btnRefresh"])) {header("location: index.php");}
    
