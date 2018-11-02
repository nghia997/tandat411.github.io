<?php
// Khai báo định dạng là file excel
header('Content-Type: application/excel');
// Nội dung trả về là một file đính kèm (attachment) với tên file là database
header('Content-Disposition: attachment; filename="database.csv"');
