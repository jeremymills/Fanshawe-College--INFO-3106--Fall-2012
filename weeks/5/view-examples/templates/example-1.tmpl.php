<html>
<head>
	<title>My first View</title>
</head>
<body>
	<p>Hello World! Yay, this looks much better then just simply printing.</p>

	<p><strong>my_string:</strong> <?php print $my_string; ?></p>
	<p><strong>my_object:</strong> <?php print_r( $my_object ); ?></p>
	<p><strong>my_array:</strong> <?php print_r( $my_array ); ?></p>
	
	<ul>
		<?php foreach( $my_array as $key => $val ) : ?>
		<li>Key: <?php print $key; ?> = Val: <?php print $val; ?></li>
		<?php endforeach; ?>
	</ul>
	
</body>
</html>