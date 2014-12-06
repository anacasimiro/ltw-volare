<?php

	// Include framework
	
	include_once('logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Get current user
	
	$currentUser = User::withUsername( $_SESSION['username'] );
	
	
	if ( isset( $_GET['search'] ) && $_GET['search'] !== '' ) {
		
		// Get Polls that match the search
		
		$stmt = $dbh->prepare( 'SELECT id FROM polls WHERE title LIKE ? ORDER BY startDate DESC' );
		$stmt->execute(array( '%' . $_GET['search'] . '%' ));
		
		foreach ( $stmt->fetchAll() as $row ) {
			
			$polls[] = Poll::withId( $row['id'] );
			
		}
		
		
	} else {
	
		// Get Latest Polls
		
		$stmt = $dbh->prepare( 'SELECT id FROM polls ORDER BY startDate DESC' );
		$stmt->execute();
		
		foreach ( $stmt->fetchAll() as $row ) {
			
			$polls[] = Poll::withId( $row['id'] );
			
		}
		
	}

?>

<?php include_once($_BASE_DIR . 'templates/header.php'); ?>

<?php
	
	if ( isset( $_GET['search'] ) && $_GET['search'] !== '' ) {
	
		echo '<h1>Search results:</h1>';
		
	} else {
		
		echo '<h1>Latest Polls</h1>';
		
	}
	
?>

<form class="search_form" action="<?php echo $_BASE_URL ?>" method="get">
	
	<input type="text" name="search" placeholder="Search polls..." value="">
	<input type="submit" value="&#xf061;">
	
</form>

<?php include_once($_BASE_DIR . 'templates/poll_list.php'); ?>

<?php include_once($_BASE_DIR . 'templates/footer.php'); ?>