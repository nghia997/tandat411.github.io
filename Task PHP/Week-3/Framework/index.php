<?php
include_once 'libs/log/Log.php';
include_once 'config/config.php';
include_once 'libs/sessiondb/Session.php';

$session = new Session();
$session->start_session('start', true);
echo '<h1>This is Demo for MySQL with Framework</h1>';
// Check controller and action in the URL
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'user';
    $action = 'showUser';
}

session_id($controller);
$_SESSION[$controller] = $action;
include_once 'routes.php';

// Demo Transaction
echo '<h1>This is Demo for Transaction with Framework</h1>';
$pdo = Database::getInstance();
try {
    // Run this code first to see Transaction FAIL
    $pdo->beginTransaction();
    $pdo->exec("INSERT INTO students(student_name, class_id) VALUES('Mai Lam Tan Dat', 1)");
    $pdo->exec("UPDATE classes SET num_of_students=num_of_students+1 WHERE id=1");
    $pdo->commit();

    // Then run this code to add a class with id = 1 to table Classes and see this Transaction are success.
    /*$pdo->beginTransaction();
    $pdo->exec("INSERT INTO classes(name, num_of_students) VALUES('5A', 0)");
    $pdo->exec("INSERT INTO students(student_name, class_id) VALUES('Student A', 1)");
    $pdo->exec("UPDATE classes SET num_of_students=num_of_students+1 WHERE id=1");
    $pdo->commit();*/
    echo 'Run Transaction are success..';
} catch (Exception $e) {
    $pdo->rollback();
    echo $e->getMessage();
}
