<?php
include_once 'Session.php';
$session = new Session();
$session->start_session('dat', false);

$_SESSION['name'] = 'Mai Lâm Tấn Đạt';
echo 'Your data Session: <b>' . $_SESSION['name'] . '</b>';

