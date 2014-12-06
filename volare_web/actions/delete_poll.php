<?php

	// Include framework

	include_once( '../logic/framework.php' );


	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Check if $_GET['id'] is defined

	if ( !isset($_GET['id']) ) {
		
		header("location:" . $_BASE_URL);
		
	} else {
		
		$id = $_GET['id'];	

	}
	

	// Get Poll
	
	$poll = Poll::withId( $id );
	
	
	// Delete Poll
	
    try {
        $poll->removePoll();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    
    
	// Redirect

	echo "<script type='text/javascript'>";
	
		echo "alert('Poll deleted successfully!');";
		echo "window.location.href = '" . $_BASE_URL . "'";
		
	echo "</script>";

?>