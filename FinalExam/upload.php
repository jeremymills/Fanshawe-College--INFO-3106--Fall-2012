<?php
define('IN_APPLICATION',true);

ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);

// =================================
// define absolute path of application
define('ABS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('FILES_PATH', ABS_PATH . 'files' . DIRECTORY_SEPARATOR);
// =========================
// initialize bootstrap bill
require_once ABS_PATH . 'bootstrap.php';

$errors = array();

if( isset($_POST['submit']) ) {

	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$file = isset($_FILES['file']) ? $_FILES['file'] : '';
	//print_r ($name);
	//print '<br >';
	//print_r ($file);

		if( empty($name) ) {
			$errors[] = 'Error: Name field can not be empty';
		}
		if( empty($file['tmp_name']) ) {
			$errors[] = 'Error: Can not upload empty file';
		}
	
	if( empty($errors) ) {
	
		//insert file name into database
		$insert = $mysqli->prepare("INSERT INTO uploaded_files (name, file_name) VALUES(?,?)");
		
		//prepare file_name for insert into database
		if( file_exists($file['tmp_name']) ){
			//chmod($file['tmp_name'], 755);
			chmod(FILES_PATH, 755);
			
			$file_pieces = explode('.', $file['name']);
			$extension = array_pop($file_pieces);
										
			unset($file_pieces); //cleanup the namespace
										
			$filesName = uniqid(time() . '_', true);
										
			$destination = FILES_PATH . $filesName . '.' . $extension;
			$fileName = $filesName.'.'.$extension;
			//print $openDes;
			if( !move_uploaded_file($file['tmp_name'], $destination) ){
				$errors[] = 'Unable to move file to destination.';
			}
		}
		if(empty($errors) ) {	
				$insert->bind_param('ss',$name,$fileName);
				$insert->execute();											
		}//end if(empty($errors))
	}//end if ( empty($errors) )
	else {
		foreach( $errors as $error ) {
			print $error . '<br />';
		}
	}


}
?>
<!DOCTYPE html>
<head>
<title>Upload a File</title>
</head>

<body>
<h1>Add a File</h1>
			<form method="POST" enctype="multipart/form-data">
				<fieldset><legend>File Name: *<input type="text" name="name" value="<?php if (isset($name)) print $name; ?>"/></legend>
		
					<label for="file">File:</label>
					<input type="file" name="file" id="file" />

				<input class="save" type="submit" name="submit" value="Save"/>
				</fieldset>
			</form>
<?php if( isset($_POST['submit']) && empty($errors) ) :?>
			<p style="height:40px; width:100%; background:lightgreen; color: white;">File upload Sucessfully!</p>
			
			<p><a href="index.php">View Uploaded File</a></p>
			
<?php endif; ?>
</body>
</html>