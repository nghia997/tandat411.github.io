<?php
$to = 'nhocshockuteo@gmail.com';
$headers = "From: 1551010024.dat@gmail.com \r\n";
$subject = 'Phần tiêu đề';
$message = "あるひ、おばあさんはなくなりました。おばあさんをおはかにほうむってから、ゆきはなけなしのかざいをあつめ、みやこへむけてしゅっぱつしました。";

 if (mb_send_mail($to, $message, $subject, $headers)) {
     echo "Gửi email thành công ...";
 } else {
     echo "Không thể gửi email ...";
 }
 