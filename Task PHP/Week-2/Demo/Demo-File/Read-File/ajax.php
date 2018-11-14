<?php
$submit = $_POST['btSubmit'];
$file = $_FILES['fileUpload'];

if (isset($submit)) {uploadFile($file);}

/**
 * Function to upload a input file to path uploads/ and show content of file with method fopen()
 * @param array $file to move this file to path uploads/
 * @return void.
 * */
function uploadFile($file)
{
    // Check file upload with HTTP Post or not
    if (is_uploaded_file($file['tmp_name'])) {

        $path = $file['tmp_name'];
        $destination = 'uploads/'. $file['name'];
        // Get content of file: Way 1
        $content = '';
        $handle = fopen($file['tmp_name'], 'r');
        //Run loop while to get line in file
        while (!feof($handle)) {
            $content .= fgets($handle).'<br>';
        }
        $content = fread($handle, $file['size']);
        fclose($handle);

        //  Get content of file: Way 2
        /*$handle = fopen($file['tmp_name'], 'r');
        $content = fread($handle, $file['size']);
        fclose($handle);*/


        /*  Get content of file: Way 3
        $content = file_get_contents($file['tmp_name']);
        */

        move_uploaded_file($path, $destination);
        echo 'Uploaded successfully! <br><br><b>Content of this file:</b><br>'.$content;
    }

}

