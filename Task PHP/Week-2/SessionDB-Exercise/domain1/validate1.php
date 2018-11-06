<?php
include_once '../Session.php';

if (isset($_POST['btCreate'])) {
    $key = trim($_POST['txtSessionKey']);
    $value = trim($_POST['txtSessionValue']);

    if (!checkEmpty($key, $value)) {
        $session = new Session();
        $session->start_session('_s', false);
        $_SESSION[$key] = $value;
        setcookie('success', 'Create successful', time() + 1);
       // header('location: index.php');
        echo $_SESSION[$key];
    }
}

function checkEmpty($key, $value)
{
    $check = false;
    if (empty($key)) {
        $check = true;
        setcookie('errorKey', 'ID must not be empty..', time() + 1);
        header('location: index.php');
    }

    if (empty($value)) {
        $check = true;
        setcookie('errorValue', 'Value must not be empty..', time() + 1);
        header('location: index.php');
    }
    return $check;
}