<?php
define('IN_APPLICATION', true);

ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);

// =============================================
// get and set user specified row id using $_GET
$row = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ========================================
// define absolute path of mini-application
define('ABS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('FILES_PATH', ABS_PATH . 'files' . DIRECTORY_SEPARATOR);

require_once ABS_PATH . 'bootstrap.php';

// =====================================
// cast id value to int and process data
$rowNum = (int)$row;
$error = false;
$errors = array();
$title = '';
$message = '';

if( $rowNum > 0 ) {
	$query = $mysqli->query("SELECT * FROM notes WHERE id = $rowNum");
	if( $query ) {
		$row = $query->fetch_row();

		$title = $row[2];
		$message = $row[3];
		
		if( empty($row) ) {
			$error = true;
			$errors[] = 'Error: requested note does not exist. Please refer back to Notes Tables';
		}//end if 
	} else {
			$error = true;
			$errors[] = 'Error: Server Error: Database Connection could not be completed';
		}//end if/else
}else {
	$error = true;
	$errors[] = 'Error accessing title: Please chose another title';
}//end if/else
$query->close();

function par_split($message) {
	$pieces = explode("\r\n",$message);
	return $pieces;
}//end function()

// ================================
// validation for file errors array

$lang = array(
    'upload_error' => array(
        1 => 'UPLOAD_ERR_INI_SIZE',
        2 => 'UPLOAD_ERR_FORM_SIZE',
        3 => 'UPLOAD_ERR_PARTIAL',
        4 => 'UPLOAD_ERR_NO_FILE',
        5 => 'UPLOAD_ERR_EMPTY',
        6 => 'UPLOAD_ERR_NO_TMP_DIR',
        7 => 'UPLOAD_ERR_CANT_WRITE',
        8 => 'UPLOAD_ERR_EXTENSION'
    )
);


/**
 * update.php form
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
	//print_r ($file);
    //Checks to ensure file is not empty - size is greater than 0
    if( 0 !== $file['size'] ){
        //print 'hi';
		$edit = $mysqli->query("SELECT * FROM note_attachments WHERE note_id=$rowNum");
		$nameRow = $edit->fetch_row();
		if($nameRow) {
			// grab extension from file
			$file_pieces = explode('.', $file['name']);
            $extension = '.'.array_pop($file_pieces);
			unset($file_pieces); //cleanup the namespace
			
			// grab queryied row and attach extension
			$fileName = $nameRow[2].$extension;
			$fileExist = FILES_PATH . $fileName;

				if( file_exists($fileExist) ) {
					//print '<br />herro';
					//deletes from file
					 unlink(FILES_PATH . $fileName);
				}
		// save file to files folder
			$insertFile = $mysqli->prepare("UPDATE note_attachments SET note_id=?,file_name=?,file_meta=? WHERE id=?");
			if( $insertFile ) {
			//print 'hello';
			$ser = serialize($file);
			$name = uniqid(time() . '_', true);
			
			// ============================================
			// Prepare insert statement for file attachment
			 $insertFile->bind_param('dssd',$rowNum,$name,$ser,$nameRow[0]);
			 $insertFile->execute();
			 
				//chmod($file['tmp_name'], 755);
				chmod(FILES_PATH, 755);
				
				
				$destination = FILES_PATH . $name . $extension;
				$openDes = FILES_PATH.$name.$extension;
				//print $openDes;
				if( !move_uploaded_file($file['tmp_name'], $destination) ){
					$errors[] = 'Unable to move file to destination.';
				}
			} else {
				$errors[] = 'Unable to save file to database, please try again';
			}
			$insertFile->close();
            
		} else {
			$insertInto = $mysqli->prepare("INSERT INTO note_attachments (note_id,file_name,file_meta) VALUES(?,?,?)");
			if( $insertInto ) {
				$ser = serialize($file);
				$name = uniqid(time() . '_', true);
			
				$insertInto->bind_param('dss',$rowNum,$name,$ser);
				$insertInto->execute();
			
				
				//chmod($file['tmp_name'], 755);
				chmod(FILES_PATH, 755);
				
				$file_pieces = explode('.', $file['name']);
				$extension = '.'.array_pop($file_pieces);
				unset($file_pieces); //cleanup the namespace
				
				$destination = FILES_PATH . $name . $extension;
				$openDes = FILES_PATH.$name.$extension;
				//print $openDes;
				if( !move_uploaded_file($file['tmp_name'], $destination) ){
					$errors[] = 'Unable to move file to destination.';
				}
				
			}
			$insertInto->close();
		}
		$edit->close();
	}
	///////////////////
	if( empty($errors) ) {
		// Good! validation seems to be OK!
		// Time to perform some sort of success routine.. mail? save to be? etc.
		
		$update = $mysqli->prepare("UPDATE notes SET title = ?, message = ? WHERE id = ?");
		if( $update ) {
			$update->bind_param('ssd',$t,$m,$rowNum);
			$update->execute();
			
			$title = $t;
			$message = $m;

		}
		$update->close();
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
		#content h2 { margin: 0; padding-left: 7px; width: 55px; border-bottom: 4px solid grey; border-right: 3px solid grey; padding-left: 10px; float: left;}
		#content h3 { margin-top: 5px; text-align: center;}
		#upload { margin-left: 15px; margin-bottom:0;}
		
		#info { padding: 10px 10px 0 10px; }
		
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
		<h2>Update Note</h2>
	</div>
	<form id="content" action="update.php?id=<?php print $row[0]; ?>" method="post" enctype="multipart/form-data">
			<?php if( !$error && empty($errors) ) : ?>
			<h2>ID: <em style="color:grey"><?php print $row[0]; ?></em></h2>
			<h3><input type="text" name="title" value="<?php print $title; ?>"/></h3>
				<div id="info">
					<h4><?php print date('l M j, Y', $row[1]) ?>:</h4>
					<p><textarea name="message" id="message" cols="69" rows="5"><?php print $message; ?></textarea></p>
					
				</div>
				
				<div id="upload">
					<label for="file">File:</label>
					<input type="file" name="file" id="file" onclick="return(confirm('This will overwrite previous file, are you sure?'))"/>
				</div><!--end upload div-->
				
				<input type="submit" class="save" name="save" value="Save" onclick="return(confirm('Are You Sure?'))"/>
	
				<?php else :?>
				<div id="error">
					<?php 
					if( !empty($errors) ) {
						foreach( $errors as $error ) { ?>
							<p><strong>Error: </strong><em><?php print $error; ?></em></p>
					<?php }//endforeach
					}//end if ?>
				</div>
			<button class="save" onclick="update.php?id=<?php print $row[0]?>">Back</button>
			<?php endif; ?>
	<footer id="footer">
		<p><em>&copy Copyright Jeremy Mills</em></p>
	</footer>
	<p style="margin-left: 20px; margin-top: -27px;"><a href="viewnote.php?id=<?php print $rowNum; ?>">Back to View Note</a></p>
	</form>
</body>
</html>