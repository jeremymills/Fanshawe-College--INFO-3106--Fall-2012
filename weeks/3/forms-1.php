<?php
/**
 * forms-1.php
 */

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

$fields = array('name' => '', 'email' => '@domain.com', 'phone' => '', 'message' => '', 'check' => '');
$errors = array(); 
$is_success = false;
 
if( isset($_POST['submit']) ) {
  
  $fields['name'] = isset($_POST['name']) ? stripslashes(trim($_POST['name'])) : $fields['name'];
  $fields['email'] = isset($_POST['email']) ? stripslashes(trim($_POST['email'])) : $fields['email'];
  $fields['phone'] = isset($_POST['phone']) ? stripslashes(trim($_POST['phone'])) : $fields['phone'];
  $fields['message'] = isset($_POST['message']) ? strip_tags(stripslashes(trim($_POST['message']))) : $fields['message'];
  
  $fields['check'] = isset($_POST['check']) ? 1 : '';
  
  if( '' == $fields['name'] ) {
    $errors[] = 'The name field is required.';
  }
  
  if( '' == $fields['email'] ) {
    $errors[] = 'The email field is required.';
  }
  
  if( empty($fields['message']) ) {
    $errors[] = 'The message field is required.';
  }
  
  if( !is_numeric($fields['phone']) ) {
    $errors[] = 'The phone field must have a numeric value.';
  }
  
  if( empty($errors) ) {
    // Good! Validation seems to be OK!
    // Time to perform some sort of success routine... mail? save to be? etc.
    
    $is_success = true;
  }
  
}
 
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
<?php } else {
  if( !empty($errors) ) {
    foreach( $errors as $error ) { ?>
      <p>Error: <em><?php print $error; ?></em></p>
    <?php }
  }
} // end if-else
?>

<form id="form-1" action="forms-1.php" method="post">

<p><label for="name">Name: *</label> <input type="text" name="name" id="name" value="<?php print $fields['name']; ?>" maxlength="255" size="40" /></p>

<p><label for="email">Email: *</label> <input type="text" name="email" id="email" value="<?php print $fields['email']; ?>" maxlength="255" size="40" /></p>

<p><label for="phone">Phone:</label> <input type="text" name="phone" id="phone" value="<?php print $fields['phone']; ?>" maxlength="15" size="40" /></p>

<p><label for="message">Message: *</label> <textarea name="message" id="message" cols="60" rows="10"><?php print $fields['message']; ?></textarea></p>

<p><input type="checkbox" name="check" value="1" id="check" /> <label for="check">Here is my checkbox</label></p>

<p><input type="submit" name="submit" value="Submit" /></p>

</form>


</body>
</html>