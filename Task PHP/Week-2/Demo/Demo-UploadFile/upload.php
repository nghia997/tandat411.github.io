<?php
$submit = $_POST['btSubmit'];
$file = $_FILES['fileUpload'];

if (isset($submit)) {uploadFile($file);}

/* Function to upload a input file to path uploads/
 * @param array $file to move this file to path uploads/
 * @return none.
 * */
function uploadFile($file)
{
    if ($file['size'] > 2097152) {
        echo '<script> alert("File size is too large, should be less than 2M."); </script>';
    } else if (!empty($file['name'])) {
        move_uploaded_file($file['tmp_name'], 'uploads/'. $file['name']);
        echo '<script> alert("Upload successful."); </script>';
    } else echo '<script> alert("No file selected for upload."); </script>';
}
