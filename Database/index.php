<?php
define('IN_APPLICATION', true);

ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);

// ========================================
// define absolute path of mini-application
define('ABS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// =========================
// initialize bootstrap bill
require_once ABS_PATH . 'bootstrap.php';

$query = $mysqli->query("SELECT * FROM notes ORDER BY id desc");

if( $query ) {
	$results = array();
	
	$results = $query->fetch_all(MYSQLI_ASSOC);
	$query->close();
	$data = array();
	foreach( $results as $result ) {
		$data[] = $result;
	}
}//end if
else {
	print 'Error: No notes were found';
}

//$newQuery = $mysqli->query("SELECT * FROM note_attachments");
	//$attach = $newQuery->fetch_all(MYSQLI_ASSOC);

function table_rows($sql,$id,$date,$title,$message) {
	$id = (int)$id;
	$attachment = null;
	$attach = $sql->fetch_all(MYSQLI_ASSOC);
	//print_r($attach);
	foreach($attach as $attach) {
		$att = $attach['note_id'];
		if($id == $att) {
			$attachment = "<img src=\"image/attachment.png\" height=\"20px\" width=\"20px\"/>";
			return "<tr><th>$id</th><td>$date</td><td>$attachment</td><td><a href=\"viewnote.php?id=$id\">$title</a></td><td>$message</td></tr>";
		} 
	}
	return "<tr><th>$id</th><td>$date</td><td>$attachment</td><td><a href=\"viewnote.php?id=$id\">$title</a></td><td>$message</td></tr>";
}//end function()



?>
<html !DOCTYPE>
<head>
<title>PHP MySQL</title>
	<style>
		body { background-color: grey; font-family: "Helvetica", Arial, sans-serif; font-size: 13px; color: #333; }
		
		#wrap { width: 600px; margin: 70px auto 30px auto; background-color: #fff; border: 1px solid grey; border-radius: 25px; }
		
		h1 { border-bottom: 4px solid grey; width: 360px; margin-left: 0; padding: 0 0 0 7px; }
		h2 { margin-left: 0; padding-left: 7px; width: 250px; border-bottom: 4px solid grey;}
		
		table { margin-top: 40px; }
		table a { text-decoration: none; }
		table th { color: green; padding-left: 5px;}
		table td { padding: 15px 5px 10px 35px; }
		
		#add { float: right; padding: 5px 10px 5px 10px; margin-top: 20px; margin-right: 10px; }
		
		footer { color: grey; clear: both; padding: 50px 10px 20px 0; height: 15px; text-align: right;}
	
	</style>
</head>
<body>
	<div id="wrap">
	<a href="add.php"><button id="add" >Add Note</button></a>
		<h1>Assignment 9 PSA</h1>
		<h2>Notes Database Table</h2>
		
		<table width="99%" border="0" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th width=""></th>
					<th width="40%">Created</th>
					<th></th>
					<th width="25%">Title</th>
					<th width="50%">Message</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach( $data as $data ) {
						print table_rows($newQuery = $mysqli->query("SELECT * FROM note_attachments"),$data['id'],date('D, M j, Y', $data['created']), $data['title'], substr($data['message'],0, 20 ).'...' ); 
					}
				?>
			</tbody>
		</table>
		

	<footer id="footer">
		<p><em>&copy Copyright Jeremy Mills</em></p>
	</footer>

	</div><!--end wrap class-->
</body>
</html>
