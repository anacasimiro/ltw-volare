<?php

	// Include framework
	
	include_once('../logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Destroy session
	
	unset($_SESSION['id']);
	session_destroy();
	
	header("location:" . $_BASE_URL);

?>