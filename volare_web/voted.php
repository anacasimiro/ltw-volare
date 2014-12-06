<?php

	// Include framework
	
	include_once('logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Get current user
	
	$currentUser = User::withUsername( $_SESSION['username'] );
	
	
	// Get already answered Polls
	
	$stmt = $dbh->prepare( 'SELECT pollId FROM answers WHERE userId = ?' );
	$stmt->execute(array( $currentUser->getId() ));
	
	foreach ( $stmt->fetchAll() as $row ) {
		
		Fb::log( $row );
		
		$polls[] = Poll::withId( $row['pollId'] );
		
	}

?>

<?php include_once( $_BASE_DIR . 'templates/header.php' ); ?>

<h1>My Polls</h1>

<?php include_once( $_BASE_DIR . 'templates/poll_list.php' ); ?>

<?php include_once( $_BASE_DIR . 'templates/footer.php' ); ?>