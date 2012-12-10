<?php
ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);


function _rpn_evaluate_op($lhs, $rhs, $op) {
	//debugging
	//print_r( func_get_args() );
	//print __FUNCTION__ . '::' . __LINE__ . '---><br />';
	
	$val = null;
	switch( $op ) {
		case '+':
			$val = $lhs + $rhs;
		break;
		
		case '*':
			$val = $lhs * $rhs;
		break;
			
		case '/':
			$val = $lhs / $rhs;
		break;
			
		case '^':
			$val = pow($lhs, $rhs);
		break;
			
		case 'sqrt':
			$val = sqrt($lhs);
		break;
		
		case '-':
			$val = $lhs - $rhs;
		break;
		
		}//end switch

	return $val;
}//end _rpn_evaluate_op() function

function rpn_evaluate($equation) {
	static $valid_operators = array('+', '-', '*', 'sqrt', '/', '^');

	$pieces = explode(' ', $equation);
	$pieces_size = count($pieces);

	if( 0 >= $pieces_size ) {
		return null;
	}//end if
	
	$processed_data = array(
		'equation' => array_shift($pieces),
		'has_error' => false
	);
	--$pieces_size;

	for( $i = 0; $i < $pieces_size; ++$i ) {
		$lhs = $processed_data['equation'];
		$rhs = null;
		if( is_numeric($pieces[$i]) ) {
			$rhs = $pieces[$i];
			
			$next = $i+1;
			if( isset($pieces[$next]) && is_numeric($pieces[$next]) ) {
				$lhs = $rhs;
				$rhs = $pieces[$next];
				++$i;
			}//end if

		}		
		

		$op = $pieces[++$i];
		$val = _rpn_evaluate_op($lhs, $rhs, $op);		
		if( null === $val ) {
				//print $i . '--->' . $op . '<----';
					/*
					$lhs = $rhs;
					$rhs = $op;
					
					$op = $pieces[++$i];
					$val = _rpn_evaluate_op($lhs, $rhs, $op);
					if( null === $val ) {
						return null;
					}
					
					//return null;
					*/
			//an error has occured ...
				$processed_data['has_error'] = true;
				//print 'hello';
		}//end if
		
		$next = $i + 1;
		if( isset($pieces[$next]) && in_array($pieces[$next], $valid_operators) ) {
			$val = _rpn_evaluate_op($lhs, $val, $pieces[$next]);
			
			++$i;
		}//end if
		//++$i;
		
		$processed_data['equation'] = $val;
	}//end for
	return $processed_data;
}//end rpn_evaluate() function


$form = (object) array(
		'has_error' => false,
		'success' => false,
		'messages' => array(),
		'fields' => array('op' => 'eq', 'data' => '')
	);

if( isset($_POST['submit']) ) {
	// do submission processing here ...
	
	$form->fields['op'] = isset($_POST['op']) ? stripslashes(trim($_POST['op'])) : '';
	$form->fields['data'] = isset($_POST['data']) ? strip_tags(trim($_POST['data'])) : '';
	
	if( 'eq' != $form->fields['op'] ) {
		$form->has_error = true;
		$form->messages[] = 'An invalid operation was selected';
	}//end if
	if( empty ($form->fields['data']) ) {
		$form->has_error = true;
		$form->messages[] = 'The data field cannot be empty as it is required.';
	}//end if
		
	$result = rpn_evaluate($form->fields['data']);
		if( $result['has_error'] ) {
			$form->has_error = true;
			$form->messages[] = 'Equation Operation is unsupported';
		}//end inner if
	
	
	
	if( !$form->has_error ) {
		$form->success = true;
		$form->messages[] = 'Form Passed!';

		switch( strtolower($form->fields['op']) ) {
			
			case 'eq':
				$regData = $_POST['data'];
				//$newData = rpn_evaluate($form->fields['data']);
				$data = $result['equation'];
				break;
				
			default :
			$form->has_error = true;
			$form->messages[] = 'An unexpected error has occurred. Please try again.';
				break;
		}//end switch
	}//end if
	
	
}//end if

/*
$new = rpn_evaluate('1 2 +'); 
print $new->equation. '<br />'; // 3
$new1 = rpn_evaluate('3 42 +');
print $new1->equation . '<br />';// 45
//print rpn_evaluate('1024 512 +') . '<br />';// 1536

$new2 = rpn_evaluate('1 1 + 2 + 2 +');
print $new2->equation. '<br />';// 6
$new3 = rpn_evaluate('1 1 + 2 2 + -');
print $new3->equation . '<br />';//4
*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>Equation Counting</title>
	
	<style>
		body { background-color: #f2f2f2; font-family: "Helvetica", Arial, sans-serif; font-size: 13px; color: #333; }
		
		footer { clear: both; padding-top: 30px; height: 15px;}
		
		h1 { margin: 0px 0px; }
		label { display: block; font-weight: bold; }
		
		.wrap { width: 600px; margin: 30px auto 30px auto; background-color: #fff; border: 1px solid #e2e2e2; padding: 20px 20px; border-radius: 25px; }
				
		.error-messages { background: #ff0000; padding: 1px 5px; color: #fff; border-radius: 10px;}
		
		.success-messages { background: #000; margin-bottom: 25px; padding: 1px 15px; color: #fff; border-radius: 10px;}
		
	</style>
</head>

<body>

<div class="wrap">
	<header id="header">
	<h1>Equations</h1>
	</header>
	<section id="main">
	<?php if( $form->success ) : ?>
		<div class="success-messages">
			<p><?php print implode('</p><p>', $form->messages); ?>
			</p>
		</div>
		
		<table width="99%" border="0" cellpadding="10" cellspacing="0">
			<thead>
				<tr>
					<th width="75%">Equation Entered</th>
					<th width="25%">Result</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><em>"<?php print $regData; ?>"</em></td>
					<td>#&nbsp&nbsp&nbsp&nbsp&nbsp <em><?php print $data; ?></em></td>
				</td>
			</tbody>
		</table>
		
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
						<option value="eq"<?php print 'eq' == $form->fields['eq'] ? ' selected="selected"' : ''; ?>>Equation</option>
					</select>
				</p>
				<p>
					<label for="data">Formula: *</label>
					<textarea id="data" name="data" cols="12" rows="8" style="width: 95%;"><?php print $form->fields['data']; ?></textarea>
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