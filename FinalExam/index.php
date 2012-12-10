<?php 
define('IN_APPLICATION',true);

//enable error_reporting
ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);
// =================================
// define absolute path of application
define('ABS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// =========================
// initialize bootstrap bill
require_once ABS_PATH . 'bootstrap.php';


$errors = array();
$data = array();

$query = $mysqli->query("SELECT * FROM uploaded_files ORDER BY id desc");

if( $query ) {
	$results = array();
	
	$results = $query->fetch_all(MYSQLI_ASSOC);
	//print_r ($results);
	$query->close();
	//print_r ($data);
}//end if
else {
	$errors[] = 'Error: No files were found';
}


?>
<!DOCTYPE html>
<head>
<title>PHP MySQL</title>
<link rel="stylesheet" href="main.css" type="text/css" />
</head>
<body>
	<div id="wrap" style="margin:0 auto 0 100px; width: 600px;">
	<a href="upload.php"><button id="upload" style="float:right;">Upload New File</button></a>
		<h1>Files</h1>
		<?php 
		foreach( $results as $result ) {
		//get the contact id
		$ID = $result['id'];
		$name = $result['name'];
		$filesName = $result['file_name'];
		print "<hr /><ul>
							<li>The File id: $ID</li>
							<li>The name: <a href=\"files/$filesName\">$name</a></li>
						</ul><hr />"; 

	}//end foreach?>
	</div><!--end wrap class-->
	<footer id="footer" style="float: right; margin-right: 400px;">
		<p><em>&copy Copyright Jeremy Mills</em></p>
	</footer>
</body>
</html>