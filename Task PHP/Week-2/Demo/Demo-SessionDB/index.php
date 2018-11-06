<?php
include_once 'session.php';
$sess = new session();
$sess->start_session('name', false);

$_SESSION['b'] = 'Mai Lâm Tấn Đạt';
echo 'Your data Session: <b>' . $_SESSION['b'] . '</b>';