<?php
include_once '../Session.php';

$session = new Session();
$session->start_session('_s', false);

if (isset($_POST['btRead'])) {
    $key = trim($_POST['txtSessionKey']);
    if (empty($key)) {
        $check = true;
        setcookie('errorKey', 'ID must not be empty..', time() + 1);
        header('location: index.php');
    } else {
        //header('location: index.php');
        echo 'Result: <b>' . $_SESSION[$key] . '</b>';
        //echo var_dump($session);
    }
}
