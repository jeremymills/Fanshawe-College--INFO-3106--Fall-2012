<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('FILES_PATH', ROOT_PATH . 'files' . DIRECTORY_SEPARATOR);

if( !defined('UPLOAD_ERR_EMPTY') ){
    define('UPLOAD_ERR_EMPTY', 5);
}
date_default_timezone_set('America/Toronto');

$lang = array(
    'upload_error' => array(
        1 => 'UPLOAD_ERR_INI_SIZE',
        2 => 'UPLOAD_ERR_FORM_SIZE',
        3 => 'UPLOAD_ERR_PARTIAL',
        4 => 'UPLOAD_ERR_NO_FILE',
        5 => 'UPLOAD_ERR_EMPTY',
        6 => 'UPLOAD_ERR_NO_TMP_DIR',
        7 => 'UPLOAD_ERR_CANT_WRITE',
        8 => 'UPLOAD_ERR_EXTENSION',
    )
);

$has_error = null;
$message = null;
if( isset($_POST['submit']) ){
    $has_error = false;
    $file = isset($_FILES['file']) ? $_FILES['file'] : array();
    
    if( 0 != $file['error'] ){
        //$message = 'The file upload was not successful. Error: ' . $file['error'];
        $message = $lang['upload_error'][$file['error']];
        $has_error = true;
    }
    else
    {
        /*Checks to ensure file is not empty - size is greater than 0*/
        if( 0 == $file['size'] ){
            $message = $lang['upload_error'][UPLOAD_ERR_EMPTY];
            $has_error = true;
        }
    }
    
    if( !$has_error ){
        if( file_exists($file['tmp_name']) ){
            //chmod($file['tmp_name'], 755);
            chmod(FILES_PATH, 777);
            
            $file_pieces = explode('.', $file['name']);
            $extension = array_pop($file_pieces);
            
            unset($file_pieces); //cleanup the namespace
            
            $name = uniqid(time() . '_', true);
            
            $destination = FILES_PATH . $name . '.' . $extension;
            if( !move_uploaded_file($file['tmp_name'], $destination) ){
                $message = 'Unable to move file to destination.';
                $has_error = true;
            }
        }
    }
    
    if( !$has_error ){
        $message = 'The file has been uploaded successfully.';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Files - Example 3</title>
    <style type="text/css">
    .array-of-data {background-color: #f2f2f2; padding: 10px 10px; margin: 10px 0px;}
    </style>
</head>

<body>
    <div class="array-of-data">
        <strong>_POST:</strong> <?php print_r( $_POST ); ?>
    </div>
    
    <div class="array-of-data">
        <strong>_FILES:</strong> <?php print_r( $_FILES ); ?>
    </div>
    
    <h1>Uploading Files - Example 3</h1>
    <?php if( !empty($message) ) : ?>
        <div class="messages">
            <p><?php print $message; ?></p>
        </div>
    <?php endif; ?>
    <form action="ex4.php" method="post" enctype="multipart/form-data">
    <p>    
        <label for="file">File</label>
        <input type="file" name="file" id="file" />
    </p>
    <p>
        <input type="submit" name="submit" value="Upload" />    
    </p>
    </form>
</body>
</html>