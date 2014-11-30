<?php

	// Check session
	
	session_start();
	
	if( isset($_SESSION['username']) && $_SESSION['username'] !== '' ) {
	
		header("location:" . $_BASE_URL);
		die();
	
	}
	
?>