<?php
$submit = $_POST['btSubmit'];
$file = $_FILES['fileUpload'];

if (isset($submit)) {uploadFile($file);}

/* Function to upload a input file to path uploads/
 * @param array $file to move this file to path uploads/
 * @return void.
 * */
function uploadFile($file)
{
    // Check file upload with HTTP Post or not
    if (is_uploaded_file($file['tmp_name'])) {
        $path = $file['tmp_name'];
        $destination = 'uploads/'. $file['name'];
        move_uploaded_file($path, $destination);
        echo 'Uploaded successfully!';
    }

}

