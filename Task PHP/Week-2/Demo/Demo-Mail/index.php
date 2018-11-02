<?php
$recipient = 'nhocshockuteo@gmail.com';
$headers = 'From: 1551010024.dat@gmail.com';
$headers .="MIME-Version: 1.0\r\nContent-Type: text/html; charset=iso-8859-1";
$subject = 'Hello World';
$message = '<html><body><h1>This is a test</h1></body></html>';
$retval = mb_send_mail($recipient, $subject, $message, $headers);

     if( $retval == true )
     {
         echo "Gửi email thành công ...";
     }
     else
     {
         echo "Không thể gửi email ...";
     }