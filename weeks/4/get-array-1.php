<?php
/*
print '_GET Array Examples and uses.<br />';

print_r( $_GET );

print '<br /><br />';

*/

function my_page_initializer() {
	global $site_config;
	
	$page = null;
	if( isset($_GET['page']) ) {
		$page = trim($_GET['page']);
	}
	
	switch( $page )
	{
		case 'contact':
			$site_config['title'] = 'Contact';
			$site_config['body'] = '<p>This is my contact page.</p>';
			break;
		
		case 'about':
			$site_config['title'] = 'About';
			$site_config['body'] = '<p>This is my about page.</p>';
			break;
		
		case 'home':
		default:
			$site_config['title'] = 'Home';
			$site_config['body'] = '<p>This is my home page.</p>';
			break;
	}
	
	// T Ops on Test ...
	$site_config['show_get'] = isset($_GET['show_get']) ? ((bool) $_GET['show_get']) : false;
}

$site_config = array(
	'title' => 'My Demo Page',
	'body'  => '<p>Here is my HTML markup for the default page, if none is specified.',
	
	'show_get' => true
);

my_page_initializer();

?>
<html>
<head>
	<title><?php print $site_config['title']; ?></title>
</head>
<body>
	
<?php if( $site_config['show_get'] ) { ?>
<div style="padding: 10px 10px; background: #eee;">
	<?php print_r( $_GET ); ?>
</div>
<?php } // endif ?>


<ul>
	<li><a href="get-array-1.php" title="Home">Home</a></li>
	<li><a href="get-array-1.php?page=about" title="About">About</a></li>
	<li><a href="get-array-1.php?page=contact" title="Contact">Contact</a></li>
</ul>

<?php print $site_config['body']; ?>
	
</body>
</html>