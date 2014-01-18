<?php

# Error stuff (comment out when live):
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Define paths:
define('ROOT', str_replace('\\', '/', __DIR__));
define('INCLUDES', ROOT . '/includes');
define('WEB', 'http://' . $_SERVER['SERVER_NAME']);

# Start the include file string:
$file = INCLUDES . '/';

# Just need to allow for "/" or "/test":
$page = (isset($_GET['page'])) ? $_GET['page'] : '/'; // @todo Might be nice to use a real router.

# Bad query string?
if (in_array($page, array('/', 'test/',))) {
	
	switch ($page) {
		
		case 'test/':
			$file .= 'pages/test.php';
			break;
		
		default:
			$file .= 'pages/index.php';
			break;
		
	}
	
}

# Check for existence:
if ( ! is_file($file)) {
	
	# 404 header:
	header('HTTP/1.1 404 Not Found');
	
	# 404 template:
	$file = INCLUDES . '/404.php'; // Re-build the full path.
	
}

# Page content:
include($file);
# Booyah!
