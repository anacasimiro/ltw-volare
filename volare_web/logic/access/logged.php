<?php

	// Check session
	
	session_start();
	
	if( !isset($_SESSION['username']) || $_SESSION['username'] === '' ) {
	
		header("location:" . $_BASE_URL . 'login.php');
		die();
	
	} else {
		
		// Get current user
		
		$currentUser = User::withUsername( $_SESSION['username'] );
		
	}
	
?>