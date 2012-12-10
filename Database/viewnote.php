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

require_once ABS_PATH . 'bootstrap.php';

// =====================================
// cast id value to int and process data
$rowNum = (int)$row;
$error = false;

if( $rowNum > 0 ) {
	$query = $mysqli->query('SELECT * FROM notes WHERE id = "' . $rowNum . '"');
	if( $query ) {
		$row = $query->fetch_row();
		if( empty($row) ) {
			$error = true;
		}//end if 
		$query->close();
		
		$newQuery = $mysqli->query("SELECT * FROM note_attachments WHERE note_id =$rowNum");
		$results = $newQuery->fetch_row();
		if( $results ) {
			$name = $results[2];
			$att = unserialize($results[3]);
			
			$file_pieces = explode('.', $att['name']);
            $extension = '.'.array_pop($file_pieces);
			
			$fileName = $name.$extension;
			//print $fileName;
			//print $extension;
			//print_r ($att);
		}
		$newQuery->close();
	} else {
			$error = true;
		}//end if/else
}else {
	$error = true;
}//end if/else

function par_split($message) {
	$pieces = explode("\r\n",$message);
	return $pieces;
}//end function()

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
		
		#info { padding: 10px; }
		
		h1 { border-bottom: 4px solid grey; width: 360px; margin-left: 0; padding: 0 0 0 7px; }
		h2 { margin-left: 0; padding-left: 7px; width: 250px; border-bottom: 4px solid grey;}
		
		table { margin-top: 40px; }
		table a { text-decoration: none; }
		table th { color: green; }
		table td { padding: 15px 5px 10px 35px; }
		
		.back { margin-top: 50px; padding: 5px;}
		.update { margin-top: 50px; margin-left: 400px; padding: 5px;}
		.add { margin-top: 50px; margin-right: 0; padding: 5px;}
		footer { color: grey; clear: both; padding: 0 10px 20px 0; height: 15px; text-align: right;}
	
	</style>
</head>
<body>
	<div id="wrap">
		<h1>Assignment 9 PSA</h1>
		<h2>Requested Note</h2>
	</div>
	<div id="content">
			<?php if( !$error ) : ?>
			<h2>ID: <em style="color:grey"><?php print $row[0]; ?></em></h2>
			<h3><?php print strtoupper($row[2]); ?></h3>
				<div id="info">
					<h4><?php print date('l M j, Y', $row[1]) ?>:</h4>
					<p><em><?php print implode('</p><p>', par_split($row[3]) ); ?></em></p>
					
				</div>
				<p>View attachment:</p><p><a href="files/<?php print $fileName; ?>"><img src="files/<?php print $fileName; ?>" height="100px" width="120px"/></a></p>
				<?php else :?>
				<div id="error">
					<p style="text-align: center;"><strong>'Error: requested note does not exist. Please refer back to Notes Tables'</strong></p>
				</div>
			<?php endif; ?>
		
		<a href="index.php"><button class="back">Back To Notes</button></a>
		<a href="update.php?id=<?php print $row[0]?>"><button class="update">Update Note</button></a>
		
	<footer id="footer">
		<p><em>&copy Copyright Jeremy Mills</em></p>
	</footer>

	</div><!--end wrap div-->
</body>
</html>