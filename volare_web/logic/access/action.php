<?php
	
	// Check $_POST
	
	if ( !$_POST ) {
		
		header("location:" . $_BASE_URL);
		die();
		
	}	
	
?>