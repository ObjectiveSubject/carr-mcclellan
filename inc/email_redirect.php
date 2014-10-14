<?php

	// Include WordPress 
	define('WP_USE_THEMES', false);
	require( '../../../../wp-load.php' );
	
	$email = $_POST['email'];
	header('location: http://dev.carr.ai-dev.net/news-events/email-alerts/?email=' . $email);

?>