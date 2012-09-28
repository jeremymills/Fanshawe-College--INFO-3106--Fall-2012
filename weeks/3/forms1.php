<?php
//ALWAYS include next two lines!!
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

/**
 * forms-1.php
 */ 

$fields = array('name'=>'' , 'email'=>'@domain.com', 'phone'=>'', 'message'=>'', 'check'=>'');
$errors = array();
$is_success = false;
 
if( isset( $_POST['submit']) ) {
	$fields['name'] = isset($_POST['name']) ? strip_tags(stripslashes(trim($_POST['name']))) : $fields['name'];
	$fields['email'] = isset($_POST['email']) ? strip_tags(stripslashes(trim($_POST['email']))) : $fields['email'];
	$fields['message'] = isset($_POST['message']) ? strip_tags(stripslashes(trim($_POST['message']))) : $fields['message'];
	$fields['phone'] = isset($_POST['phone']) ? strip_tags(stripslashes(trim($_POST['phone']))) : $fields['phone'];
	$fields['check'] = isset($_POST['check']) ? $_POST['check'] : '';
	
	if( '' ==$fields['name'] ) {
		$errors[] = 'The name field is requird.';
	}
	if( ''==$fields['email'] ) {
		$errors[] = 'The email field is required.';
	}
	if( empty($fields['message']) ) {
		$errors[] = 'The message field is required.';
	}
	if( !is_numeric($fields['phone']) ) {
		$errors[] = 'The phone field must have a numeric value';
	}
	
	if( empty($errors) ) {
		// Good! validation seems to be OK!
		// Time to perform some sort of success routine.. mail? save to be? etc.
		
		$is_success = true;
	}
} 
  
print_r($_POST); 
?>
<html>
<head>
	<title>Forms 1 Example</title>
</head>
<body>

<div style="background: #eee; padding: 10px 10px; margin-bottom: 20px;">
	<?php print_r( $fields ); ?>
</div>

<?php if( $is_success ) { ?>
		<p>Congrats! You have successfully submitted this form with no validation errors.</p>
<?php }//end if 
else {
	if( !empty($errors) ) {
		foreach( $errors as $error ) { ?>
			<p>Error: <em><?php print $error; ?></em></p>
		<?php }//endforeach
	}//end if
}//end else
 ?>
 
<form id="form-1" action="forms1.php" method="post">

	<p><label id="name">Name: *</label><input type="text" name="name" value="<?php print $fields['name']; ?>" maxlength="255" size="40" /></p>
	<p><label for="email">Email: *</label> <input type="text" name="email" id="email" value="<?php print $fields['email']; ?>" maxlength="255" size="40" /></p>
	<p><label for="phone">Phone:</label> <input type="text" name="phone" id="phone" value="<?php print $fields['phone']; ?>" maxlength="15" size="40" /></p>	
	<p><label for="message">Message: *</label> <textarea name="message" id="message" cols="10" rows="10"><?php print $fields['message']; ?></textarea></p>
	
	<p><input type="checkbox" name="check" value="1" id="check" /><label for="check">Here is my checkbox</label></p>
	<p><input type="submit" name="submit" value="submit" /></p>

</form>
 
 
 
</body>
</html>