<?php
include_once '../Session.php';

if (isset($_POST['btCreate'])) {
    $id = trim($_POST['txtSessionID']);
    $value = trim($_POST['txtSessionValue']);

    if (!checkEmpty($id, $value)) {
        $session = new Session();
        $session->start_session('dat', false);
        // Set id for new session
        session_id($id);
        // Set name of this session is id
        $_SESSION[$id] = $value;
        setcookie('success', 'Create successful', time() + 1);
        header('location: index.php');
    }
}

/*  Function to check inputs empty or not
 *  @param string $id to check id of session
 *  @param string $value to check data of session
 *  @return boolean $check to know in one of them are empty or not
 * */
function checkEmpty($id, $value)
{
    $check = false;
    if (empty($id)) {
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