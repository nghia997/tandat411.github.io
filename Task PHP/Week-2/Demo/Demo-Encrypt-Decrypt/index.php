<?php
$key = 'name';
$value = base64_encode('Mai Lâm Tấn Đạt');
$cipher = "AES-256-CBC";
$ivSize = openssl_cipher_iv_length($cipher);
$iv = openssl_random_pseudo_bytes($ivSize);

$encrypt = openssl_encrypt($value, $cipher, $key, OPENSSL_RAW_DATA, $iv);
$decrypt = openssl_decrypt($encrypt, $cipher, $key, OPENSSL_RAW_DATA, $iv);

echo 'Encrypt: ' . $encrypt;
echo '<br>Decrypt: '.base64_decode($decrypt);
