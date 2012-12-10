<?php
define('IN_APPLICATION', true);

ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);

// ========================================
// define absolute path of mini-application
define('ABS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('FILES_PATH', ABS_PATH . 'files' . DIRECTORY_SEPARATOR);


require_once ABS_PATH . 'bootstrap.php';

// =====================================
// initiate boolean variables
$errors = array();

// ================================
// validation for file errors array
if( !defined('UPLOAD_ERR_EMPTY') ){
    define('UPLOAD_ERR_EMPTY', 5);
}

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


/**
 * add.php form
 */ 
$fields = array('title'=>'', 'message'=>'');
$t = '';
$m = '';

if( isset( $_POST['save']) ) {
	$fields['title'] = isset($_POST['title']) ? strip_tags(stripslashes(trim($_POST['title']))) : $fields['title'];
	$fields['message'] = isset($_POST['message']) ? strip_tags(stripslashes(trim($_POST['message']))) : $fields['message'];
	$file = isset($_FILES['file']) ? $_FILES['file'] : array();
	
	if( empty($fields['title']) ) {
		$errors[] = 'The title field is requird.';
	} else {
		$t = $fields['title'];
	}
	if( empty($fields['message']) ) {
		$errors[] = 'The message field is required.';
	} else {
		$m = $fields['message'];
	}
	///////////////////
    
        if( file_exists($file['tmp_name']) ){
            //chmod($file['tmp_name'], 755);
            chmod(FILES_PATH, 755);
            
            $file_pieces = explode('.', $file['name']);
            $extension = array_pop($file_pieces);
            
            unset($file_pieces); //cleanup the namespace
            
            $name = uniqid(time() . '_', true);
            
            $destination = FILES_PATH . $name . '.' . $extension;
			$openDes = $name.'.'.$extension;
			print $openDes;
            if( !move_uploaded_file($file['tmp_name'], $destination) ){
                $errors[] = 'Unable to move file to destination.';
            }
        }
    
	
	///////////////////
	if( empty($errors) ) {
		// Good! validation seems to be OK!
		// Time to perform some sort of success routine.. mail? save to be? etc.
		
		$date = new DateTime(null);
		$d = $date->getTimestamp();
		
		$insert = $mysqli->prepare("INSERT INTO notes (created, title, message) VALUES(?,?,?)");
		$insertFile = $mysqli->prepare("INSERT INTO note_attachments (note_id,file_name,file_meta) VALUES(?,?,?)");
		if( $insert && $insertFile ) {
			$insert->bind_param('dss',$d,$t,$m);
			$insert->execute();
			
			$fields['title'] = $t;
			$fields['message'] = $m;
			
			$noteID = $mysqli->insert_id;
			//print $noteID.'<br />';
			$ser = serialize($file);
			
			
			// ============================================
			// Prepare insert statement for file attachment
			 
			 
			 $insertFile->bind_param('dss',$noteID,$name,$ser);
			 $insertFile->execute();
			 

		}
		
		$insert->close();
		$insertFile->close();
	}
}

?>
<html !DOCTYPE>
<head>
<title>PHP MySQL</title>
	<style>
		body { background-color: grey; font-family: "Helvetica", Arial, sans-serif; font-size: 13px; color: #333; }
		
		#error { background: #ff0000; padding: 1px 5px; color: #fff; border-radius: 10px;}
		
		#wrap { width: 600px; margin: 70px auto 30px auto; background-color: #fff; border: 1px solid grey; border-radius: 25px; }
		#content { width: 600px; margin: 10px auto 30px auto; background-color: #fff; border: 1px solid grey; border-radius: 25px; }
		#content h3 { margin-top: 5px; text-align: center;}
		
		#upload { margin-left: 15px; margin-bottom:0;}
		#info { padding: 10px; }
		
		h1 { border-bottom: 4px solid grey; width: 360px; margin-left: 0; padding: 0 0 0 7px; }
		h2 { margin-left: 0; padding-left: 7px; width: 250px; border-bottom: 4px solid grey;}
		
		table { margin-top: 40px; }
		table a { text-decoration: none; }
		table th { color: green; }
		table td { padding: 15px 5px 10px 35px; }
		
		.back { margin-top: 50px; padding: 5px;}
		.save { margin-top: 50px; margin-left: 260px; padding: 5px 20px 5px 20px;}
		.add { margin-top: 50px; margin-right: 0; padding: 5px;}
		footer { color: grey; clear: both; padding: 10px 10px 20px 0; height: 15px; text-align: right;}
		
		form { margin-top:-4px;padding:0; }
	</style>
</head>
<body>
	<div id="wrap">
		<h1>Assignment 9 PSA</h1>
		<h2>Add Note</h2>
	</div>
	<form id="content" action="add.php" method="post" enctype="multipart/form-data">
		<?php if( !isset($_POST['save']) ) : ?>
			<h3>Title:*<input type="text" name="title"/></h3>
				<div id="info">
					<p>Message:*<textarea name="message" id="message" cols="69" rows="5"></textarea></p>
				</div>
				
				<div id="upload">
					<label for="file">File:</label>
					<input type="file" name="file" id="file" />
				</div><!--end upload div-->
				
				<input type="submit" class="save" name="save" value="Save" onclick="return(confirm('Are You Sure?'))"/>
			<footer id="footer">
				<p><em>&copy Copyright Jeremy Mills</em></p>
			</footer>
		<?php endif; ?>
		<?php if( isset($_POST['save']) && empty($errors) ) : ?>
				<div id="content" style="background-color: green; text-align: center; font-size: 24px; margin-top: 0;">
					<p style="color: white;">Form Submitted!</p>
				</div>
				<p style="margin-left: 247px;"><a href="viewnote.php?id=<?php print $noteID;?>">View Created Note</a></p>
				
				<?php else : ?>

					<?php if( !empty($errors) ) { ?>
					<div id="error">
						<?php foreach( $errors as $error ) { ?>
							<p><strong>Error: </strong><em><?php print $error; ?></em></p>
					<?php }//endforeach ?>
					</div>
					<a href="add.php"><button class="save">Back</button></a>
					<footer id="footer">
						<p><em>&copy Copyright Jeremy Mills</em></p>
					</footer>
					<?php } ?>
					
		<?php endif; ?>
	<p style="margin-left: 20px; margin-top: -29px;"><a href="index.php">Back to Notes</a></p>
	
	</form><!--end content form-->
</body>
</html>