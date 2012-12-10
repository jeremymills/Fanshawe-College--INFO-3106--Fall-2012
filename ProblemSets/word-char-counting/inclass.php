<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

/**
 * _string_count_words_parse_split
 * 
 * @access private
 * @param string Contains the word or piece of a word to split
 * @param int Contains the position of the character to split on
 * @return array Returns an array of the initial word split into pieces
 */
function _string_count_words_parse_pieces(array &$processed_data, $piece, $offset, array &$ignore) {
	$return = array();

	$lhs = substr($piece, 0, $offset);

	if( !isset($processed_data['ignored'][$lhs]) ) {
		$return[] = $lhs;
		++$processed_data['total count while ignoring'];
	}
	else {
		++$processed_data['ignored'][$lhs];
	}

	++$processed_data['total count'];

	if( ($offset + 1) <= strlen($piece) ) {
		$rhs = substr($piece, $offset + 1, strlen($piece));

		$has_split = false;
		for( $i = 0; $i < strlen($rhs) && !$has_split; ++$i ) {
			if( !_string_count_words_validate_char($rhs[$i]) )
			{
				$next = $i + 1;
				if( isset($rhs[$next]) && _string_count_words_validate_char($rhs[$next]) )
				{
					$return = array_merge($return,
						_string_count_words_parse_pieces($processed_data, $rhs, $i, $ignore)
					);
					$has_split = true;
				}
			}
		}

		if( !$has_split ) {
			if( !isset($processed_data['ignored'][$rhs]) ) {
				$return[] = $rhs;
				++$processed_data['total count while ignoring'];
			}
			else {
				++$processed_data['ignored'][$rhs];
			}

			++$processed_data['total count'];
		}
	}

	return $return;
}

function _string_count_words_validate_char($char) {
	return !empty($char) && !(!ctype_alpha($char) && ("'" != $char || '-' != $char));
}

function _string_count_words_sanitize_piece($value) {
	$value = trim($value);
	return empty($value) ? null : $value;
}

function string_count_words($string, array $ignore = array(), $return_array = false) {
	if( !is_string($string) ) {
		throw new Exception('$string parameter must be of type string.');
	}

	$processed_data = array(
		'total count' => 0,
		'total count while ignoring' => 0,
		'ignored' => array()
	);

	if( !empty($ignore) ) {
		foreach( $ignore as $k => &$v ) {
			$processed_data['ignored'][$v] = 0;
		}
	}

	$pieces = explode(' ', $string);
	for( $i = 0, $pieces_size = count($pieces); $i < $pieces_size; ++$i ) {
		$pieces[$i] = _string_count_words_sanitize_piece($pieces[$i]);
		if( null === $pieces[$i] ) {
			unset($pieces[$i]);
		}
	}

	$words = array();
	foreach( $pieces as $piece ) {
		$is_valid = true;
		$has_split = false;

		for( $i = 0; $i < strlen($piece) && !$has_split; ++$i ) {
			$next = $i + 1;
			if( !_string_count_words_validate_char($piece[$i]) ) {
				if( isset($piece[$next]) && _string_count_words_validate_char($piece[$next]) ) {
					$words = array_merge($words, _string_count_words_parse_pieces($processed_data, $piece, $i, $ignore));
					$has_split = true;
				}
				else
				{
					$is_valid = false;
				}
			}
		}

		if( $is_valid && !$has_split ) {
			++$processed_data['total count'];

			if( !isset($processed_data['ignored'][$piece]) ) {
				++$processed_data['total count while ignoring'];

				$words[] = $piece;
			}
			else {
				++$processed_data['ignored'][$piece];
			}
		}
	}

	return $return_array ? $processed_data : $processed_data['total count'];
}


$form = (object) array(
	'has_error' => false,
	'success' => false,
	'messages' => array(),

	'fields' => array('op' => 'word', 'data' => '', 'ignore' => '')
);

$results = (object) array(
	'total_count' => 0,
	'count_while_ignoring' => 0,
	'ignored' => array()
);

if( isset($_POST['submit']) ) {

	$form->fields['op'] = isset($_POST['op']) ? stripslashes(trim($_POST['op'])) : '';
	$form->fields['data'] = isset($_POST['data']) ? stripslashes(strip_tags(trim($_POST['data']))) : '';
	$form->fields['ignore'] = isset($_POST['ignore']) ? stripslashes(strip_tags(trim($_POST['ignore']))) : '';

	if( 'words' != $form->fields['op'] && 'chars' != $form->fields['op'] ) {
		$form->has_error = true;
		$form->messages[] = 'An invalid operation was selected.';
	}

	/* if( empty($form->fields['data']) ) {
		$form->has_error = true;
		$form->messages[] = 'The data field cannot be empty as it is required.';
	} */

	if( !$form->has_error )
	{
		if( !empty($form->fields['ignore']) ) {
			$ignored_values = explode(',', $form->fields['ignore']);
			$ignored_values = array_map('trim', $ignored_values);
		}
		else {
			$ignored_values = array();
		}

		switch( strtolower($form->fields['op']) ) {

			case 'words':
				//$results->total_count = 
				$processed_results = string_count_words($form->fields['data'], $ignored_values, true);

				print $processed_results['total count'];

				break;

			case 'chars':
				break;

			default:
				$form->has_error = true;
				$form->messages[] = 'An unexpected error has occurred. Please try again.';
				break;
		}
	}

	if( !$form->has_error )
	{
		$form->success = true;
		$form->messages[] = 'Congrats! You have successfully submitted this form.';
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Word and Character Counting</title>
	<style>
	html { background-color: #f2f2f2; font-family: "Helvetica", Arial, sans-serif; font-size: 13px; color: #333; }
	
	h1 { margin: 0px 0px; }
	label { display: block; font-weight: bold; }
	
	.wrapper { width: 600px; margin-left: auto; margin-right: auto; margin-top: 30px; margin-bottom: 30px; background-color: #fff; border: 1px solid #e2e2e2; padding: 24px 24px; }
	
	.error-messages { background: #ff0000; padding: 5px 15px; color: #fff; }
	
	.success-messages { background: #000; padding: 5px 15px; color: #fff; }
	</style>
</head>
<body>

	<div class="post-array" style="border: 1px solid #000; padding: 10px 10px; margin: 15px 0px;">
		<?php print_r( $_POST ); ?>
	</div>
	<div class="form-object" style="border: 1px solid #000; padding: 10px 10px; margin: 15px 0px;">
		<?php print_r( $form ); ?>
	</div>
	<div class="results-object" style="border: 1px solid #000; padding: 10px 10px; margin: 15px 0px;">
		<?php print_r( $results ); ?>
	</div>

<div class="wrapper">
	<header id="header">
		<h1>Counting</h1>
	</header>
	<section id="main">
	<?php if( $form->success ) : ?>
		
		<div class="success-messages">
			<p><?php print implode('</p><p>', $form->messages); ?></p>
		</div>
		<p>The total number of items counted was: <?php print number_format($results->total_count); ?></p>
		<p>The total number of items counted while ignoring the ignored values was: ##</p>
		<table width="99%" border="0" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th width="75%">Ignored Value</th>
					<th width="25%">Count</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>My ignored value here</td>
					<td>123</td>
				</tr>
			</tbody>
		</table>
		<p><a href="inclass.php">&larr; Back</a></p>
		
	<?php else : ?>
		<?php if( $form->has_error ) : ?>
		<div class="error-messages">
			<p><?php print implode('</p><p>', $form->messages); ?></p>
		</div>
		<?php endif; ?>
		<form action="inclass.php" method="post">
		<p>
			<label for="ops">Operation Method: *</label>
			<select name="op" id="ops">
				<option value="words"<?php print 'words' == $form->fields['op'] ? ' selected="selected"' : ''; ?>>Word Counting</option>
				<option value="chars"<?php print 'chars' == $form->fields['op'] ? ' selected="selected"' : ''; ?>>Character Counting</option>
			</select>
		</p>
		<p>
			<label for="data">String: *</label>
			<textarea id="data" name="data" cols="12" rows="8" style="width: 95%;"><?php print $form->fields['data']; ?></textarea>
		</p>
		<p>
			<label for="ignore">Ignore:</label>
			<input type="text" name="ignore" id="ignored" value="<?php print $form->fields['ignore']; ?>" />
		</p>
		<p>
			<input type="submit" value="Submit" name="submit" />
		</p>
		</form>
	<?php endif; ?>	
	</section>
	<footer id="footer">
		<p>Copyright information here.</p>
	</footer>

</div>

</body>
</html>
