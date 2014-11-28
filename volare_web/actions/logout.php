<?php

	// Include framework
	
	include_once('../logic/framework.php');
	
	
	// Check session
	
	session_start();
	
	if( !isset($_SESSION['id']) || $_SESSION['id'] === '' ) {
	
		header("location:" . $_BASE_URL);
	
	}
	
	
	// Destroy session
	
	unset($_SESSION['id']);
	session_destroy();
	
	header("location:" . $_BASE_URL);

?>