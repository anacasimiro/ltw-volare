<?php

	// Include framework
	
	include_once('logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Get current user
	
	$currentUser = User::withUsername( $_SESSION['username'] );
	

?>

<?php include_once($_BASE_DIR . 'templates/header.php'); ?>

<h1>Error 403</h1>

<h3>Permission denied	!</h3>

<?php include_once($_BASE_DIR . 'templates/footer.php'); ?>