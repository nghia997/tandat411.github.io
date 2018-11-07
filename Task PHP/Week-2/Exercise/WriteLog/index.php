<?php
include_once "Log.php";
$log = new Log();
$log->emergency("This is a new Emergency message");
$log->alert("This is a new Alert message");
$log->critical("This is a new Critical message");
$log->notice("This is a new Notice message");
$log->info("This is a new Info message");
$log->error("This is a new Error message");
$log->warning("This is a new Warning message");
$log->debug("This is a new DEBUG message");