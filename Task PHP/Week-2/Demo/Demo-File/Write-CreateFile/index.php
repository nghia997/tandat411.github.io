<?php
$createFile = tempnam('file/', 'tandat');
$handle = fopen($createFile, 'w');
fwrite($handle, 'Mai Lâm Tấn Đạt');
fclose($handle);