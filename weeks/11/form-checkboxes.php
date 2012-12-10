<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

if( isset($_POST['submit']) ) {

	$names = isset($_POST['my_check']) ? $_POST['my_check'] : array();

	// print_r( $names );
	/*
	print 'Print names using For loop ...<br />';
	for( $i = 0; $i < count($names); ++$i ) {
		print $names[$i] . ', ';
	} */

	/*
	print '<br />Print names using For Each Loop ... <br />';
	foreach( $names as $name ) {
		print $name . ', ';
	} */
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Multiple Checkboxes</title>
</head>
<body>

<div style="padding: 10px; background: #f2f2f2;">
	<?php print_r( $_POST ); ?>
</div>

<form action="form-checkboxes.php" method="post">
<?php // for( $i = 1; $i <= 10; ++$i ) { ?>
<?php $checkboxes = array('Nick Hiebert', 'Carlie Hiel', 'Michael Cameron', 'Thomas Eastwood', 'Christopher Tully', 'Josh Parsons');
foreach( $checkboxes as $i => $name ) { ?>
<p>
	<input type="checkbox" name="my_check[key_<?php print $i; ?>]" value="<?php print $name; ?>" /> <?php print $name; ?>
</p>
<?php } ?>
<p><input type="submit" name="submit" value="Submit" /></p>
</form>

</body>
</html>