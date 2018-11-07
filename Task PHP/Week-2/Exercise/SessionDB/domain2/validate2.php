<?php
include_once '../Session.php';

if (isset($_POST['btRead'])) {
    $key = trim($_POST['txtSessionKey']);
    if (empty($key)) {
        $check = true;
        setcookie('errorKey', 'ID must not be empty..', time() + 1);
        header('location: index.php');
    } else {
        $session = new Session();
        session_id($key);
        $session->start_session('dat', false);
        $result = $session->read($key);
        echo (empty($result)) ? '<b>This session is not exist..</b>' : 'Result: <b>' . $session->read($key) . '</b>';
    }
}
