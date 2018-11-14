<?php
include_once '../Session.php';

// Check button 'Create Session' was clicked
if (isset($_POST['btCreate'])) {
    $id = trim($_POST['txtSessionID']);
    $value = trim($_POST['txtSessionValue']);

    // Check $id and $value are empty or not
    if (!checkEmpty($id, $value)) {
        $session = new Session();
        $session->start_session('dat', false);
        // Set name for new session
        session_id($id);
        // Set value of this session
        $_SESSION[$id] = $value;
        setcookie('success', 'Create successful', time() + 1);
        header('location: index.php');
    }
}

/**
 * Function to check inputs empty or not
 * @param string $id to check id of session
 * @param string $value to check data of session
 * @return boolean $check to know in one of them are empty or not
 */
function checkEmpty($id, $value)
{
    $check = false;
    // Check $id are empty or not
    if (empty($id)) {
        $check = true;
        setcookie('errorKey', 'ID must not be empty..', time() + 1);
        header('location: index.php');
    }
    // Check $value are empty or not
    if (empty($value)) {
        $check = true;
        setcookie('errorValue', 'Value must not be empty..', time() + 1);
        header('location: index.php');
    }
    return $check;
}