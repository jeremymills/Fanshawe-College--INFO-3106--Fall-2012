<?php
ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);

/**
 * _string_count_words_parse_split
 * 
 * @access private 
 * @param string Contains the word or piece of word to split
 * @param int Contains the position of the character to split on
 * @return array Returns an array of the initial word split into pieces
 */
 
function _string_count_words_parse_pieces($piece, $offset) {
	$return = array();
	$return[] = substr($piece, 0, $offset);
	
	if( ($offset +1) <= strlen($piece) ) {
	
		$rhs = substr($piece, $offset + 1, strlen($piece));
		$has_split = false;
		
			for( $i = 0; $i < strlen($rhs) && !$has_split; ++$i) {
				if( !_string_count_words_validate_char($rhs[$i]) ) {
					if( ($i + 1) <= strlen($rhs) ) {////////////////////////////MINE!
						$return = array_merge(
							$return, 
							_string_count_words_parse_pieces($rhs, $i)
						);
					}//end if
					$has_split = true;
				}//end if
				
			}//end for
			
			if( !$has_split ) {
				$return[] = $rhs;
			}//end if
			
	}//end if
		return $return;
}//end string_count_words_parse_split() function

function string_validate_ignored_words($ignore, $data) {
	$ignoreCount = array();
	$wordCount = array();
	
	for( $i = 0; $i < count($data); ++$i ) {
		for( $j = 0; $j < count($ignore); ++$j ) {
			if( $ignore[$j] === $data[$i] ) {
				$ignoreCount[] = $data[$i];
				//++&$processed_data;
				if( $data[$i] = null ) {
					++$i;
				}//end inner if
			}//end inner if

		}//end inner for
		if($data[$i] != null) {
			$wordCount[] = $data[$i];
		}

	}//end for
	
	return ($wordCount);
	//return $wordCount[];
}//end _string_validate_ignore_word() function

function _string_count_words_validate_char($char) {
	return !(!ctype_alpha($char) && ("'" != $char || '-' != $char));
}//end _string_count_words_validate_char() function

function string_valid_words($string) {
	
	if( !is_string($string) ) {
		throw new Exception('parameter must be of type string.');
	}//end if
	
	$pieces = explode(' ', $string);
	$words = array();
	
	foreach( $pieces as $piece ) {
	$implode = array();
		$is_valid = true;
		$has_split = false;
		//print_r ($piece) . print '<br />';
		for( $i = 0; $i < strlen($piece) && !$has_split; ++$i ) {
			if( !_string_count_words_validate_char($piece[$i]) ) {
				
				$implode = array_merge($implode,
					_string_count_words_parse_pieces($piece, $i)
				);
				
				if(implode($implode) != null ) {
					$words[] = implode($implode);
				}
				
				$has_split = true;
			}//end if
		}//end for
		if( $is_valid && !$has_split && $piece != null ) {
			$words[] = $piece;
		}//end if
	}//end foreach

	return ($words);
}//end string_count_words() function
 
function string_valid_ignored_words($string) {
	
	if( !is_string($string) ) {
		throw new Exception('parameter must be of type string.');
	}//end if
	
	$pieces = explode(',', $string);
	$words = array();
	//print_r($pieces);
	foreach( $pieces as $piece ) {
	$implode = array();
		$is_valid = true;
		$has_split = false;

		for( $i = 0; $i < strlen($piece) && !$has_split; ++$i ) {
			if( !_string_count_words_validate_char($piece[$i]) ) {
				
				$implode = array_merge($implode,
					_string_count_words_parse_pieces($piece, $i)
				);
				
				if(implode($implode) != null ) {
					$words[] = implode($implode);
				}
				$has_split = true;

				
			}//end if
		}//end for
		if( $is_valid && !$has_split && $piece != null ) {
			$words[] = $piece;
			//print_r ($words);
		}//end if
		
	}//end foreach
	return ($words);
}//end string_count_words() function

$form = (object) array(
		'has_error' => false,
		'success' => false,
		'messages' => array(),
		'fields' => array('op' => 'word', 'data' => '', 'ignore' => '')
	);

if( isset($_POST['submit']) ) {
	// do submission processing here ...
	
	$form->fields['op'] = isset($_POST['op']) ? stripslashes(trim($_POST['op'])) : '';
	$form->fields['data'] = isset($_POST['data']) ? stripslashes(strip_tags(trim($_POST['data']))) : '';
	$form->fields['ignore'] = isset($_POST['ignore']) ? stripslashes(strip_tags(trim($_POST['ignore']))) : '';
	
	if( 'word' != $form->fields['op'] && 'char' != $form->fields['op'] ) {
		$form->has_error = true;
		$form->messages[] = 'An invalid operation was selected';
	}//end if
	if( empty ($form->fields['data']) ) {
		$form->has_error = true;
		$form->messages[] = 'The data field cannot be empty as it is required.';
	}//end if
	
	if( !$form->has_error ) {
		
		switch( strtolower($form->fields['op']) ) {
			
			case 'word':
				$dataArray = string_valid_words($form->fields['data']);
				
				$ignoreArray = string_valid_ignored_words($form->fields['ignore']);
				
				$ignoredValues = string_validate_ignored_words($ignoreArray, $dataArray);
				
				$revision = '';
				for( $i = 0; $i < count($ignoredValues); ++$i ) {
					$revision .= $ignoredValues[$i];
					$revision .= ' ';
				}//end for
				
				$occurrence = 0;
				$occurrence = (count($dataArray)-count($ignoredValues));
				break;
				
			case 'char':
				$characters = implode(string_valid_words($form->fields['data']));
				$dataArray = strlen($characters);
				print $dataArray;
				$ignoreArray = string_valid_ignored_words($form->fields['ignore']);
				
				
				
				break;
				
			default :
			$form->has_error = true;
			$form->messages[] = 'An unexpected error has occurred. Please try again.';
				break;
		}//end switch
	}//end if
		
	if( !$form->has_error ) {	
		$form->success = true;
		$form->messages[] = 'Form Passed!';
	}//end if	
	
}//end if

?>

<!DOCTYPE html>
<html>
<head>
	<title>Word and Character Counting</title>
	
	<style>
		body { background-color: #f2f2f2; font-family: "Helvetica", Arial, sans-serif; font-size: 13px; color: #333; }
		
		footer { clear: both; padding-top: 30px; height: 15px;}
		
		h1 { margin: 0px 0px; }
		label { display: block; font-weight: bold; }
		
		.wrap { width: 600px; margin: 30px auto 30px auto; background-color: #fff; border: 1px solid #e2e2e2; padding: 20px 20px; 
				border-radius: 25px; }
				
		.error-messages { background: #ff0000; padding: 1px 5px; color: #fff; border-radius: 10px;}
		
		.success-messages { background: #000; padding: 1px 15px; color: #fff; border-radius: 10px;}
	</style>
</head>

<body>

<div class="wrap">
	<header id="header">
	<h1>Counting</h1>
	</header>
	<section id="main">
	<?php if( $form->success ) : ?>
		<div class="success-messages">
			<p><?php print implode('</p><p>', $form->messages); ?>
			</p>
		</div>
		<p>The total number of items counted was: <?php print count($dataArray); ?></p>
		<p>The total number of items counted while ignoring the ingored values was: <?php  $ignoredValues!=null ? print count($ignoredValues) : print 'null' ?></p>
		
		<table width="99%" border="0" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th width="75%">Ignored Value(s)</th>
					<th width="25%">Count</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><em><?php $_POST['ignore']!=null ? print $_POST['ignore'] : print 'no value entered'; ?></em></td>
					<td>#&nbsp&nbsp&nbsp&nbsp&nbsp <em><?php print $occurrence ?></em></td>
				</td>
			</tbody>
		</table>
		<hr />
		<label>Revised Paragraph:</label>
		<p>
			<?php print $revision; ?>
		</p>
		
		<p><a href="index.php">&larr; Back</a></p>
		
	<?php else : ?>
		<?php if( $form->has_error ) : ?>
		<div class="error-messages">
			<p><?php print implode('<p></p>', $form->messages); ?></p>
		</div>
		<?php endif; ?>
			<form action="index.php" method="post">
			<p>
				<label for="ops">Operation Method: *</label>
				<select name="op" id="ops">
					<option value="word"<?php print 'word' == $form->fields['op'] ? ' selected="selected"' : ''; ?>>Word Counting</option>
					<option value="char"<?php print 'char' == $form->fields['op'] ? ' selected="selected"' : ''; ?>>Character Counting</option>
				</select>
			</p>
			<p>
				<label for="data">Text: *</label>
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
		<p>&copy Copyright Jeremy Mills</p>
	</footer>


</div><!--end wrap div-->

</body>
</html>


