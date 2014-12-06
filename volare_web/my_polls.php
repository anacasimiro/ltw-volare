<?php

	// Include framework
	
	include_once('logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Get current user
	
	$currentUser = User::withUsername( $_SESSION['username'] );
	
	
	// Get User's Polls
	
	$stmt = $dbh->prepare( 'SELECT id FROM polls WHERE ownerId = ? ORDER BY startDate DESC' );
	$stmt->execute(array( $currentUser->getId() ));
	
	foreach ( $stmt->fetchAll() as $row ) {
		
		$polls[] = Poll::withId( $row['id'] );
		
	}

?>

<?php include_once($_BASE_DIR . 'templates/header.php'); ?>

<h1>My Polls</h1>

<section class="poll_list">

	<?php if ( isset($polls) ) { foreach ($polls as $poll) : ?>

		<article class="clearfix poll<?php if ( $poll->getEndDate() <= time() ) echo ' ended'; ?>">

			<a title="View Poll" class="poll_image" href=""><img src="<?php echo $poll->getImage(); ?>" alt="Poll Image" /></a>
			
			<div class="poll_details">
				
				<div class="description">
					
					<h3><?php
						
						echo $poll->getTitle();
						
						if ( $poll->getEndDate() <= time() ) { echo ' <cite>(finished)</cite>'; }
						
					?></h3>
					
					<span>Start date: &nbsp;<?php echo date('m/d/Y H:i', $poll->getStartDate() ); ?></span>
					
					<span>End date: &nbsp;&nbsp;<?php echo date('m/d/Y H:i', $poll->getEndDate() ); ?></span>
					
				</div>
			
				<div class="poll_links">
					
					<?php
					
						if ( $poll->getEndDate() > time() ) {
						
							echo '<a class="edit_poll" href="' . $_BASE_URL . 'edit_poll.php?id=' . $poll->getId() . '">Edit Poll</a>';
						
						}
						
						echo '<a class="delete_poll" href="' . $_BASE_URL . 'actions/delete_poll.php?id=' . $poll->getId() . '">Delete Poll</a>';
						
						if ( $poll->getStartDate() <= time() ) {
						
							echo '<a class="view_poll" href="' . $_BASE_URL . 'view_poll.php?id=' . $poll->getId() . '">View Poll</a>';
							
						}
					
					?>
					
				</div>
				
			</div>

		</article>

	<?php endforeach; } else { echo '<h3>You have no polls! Go ahead and <a title="New Poll" href="' . $_BASE_URL . 'edit_poll.php?id=0">create one</a> now!</h3>'; } ?>

</section>

<?php include_once($_BASE_DIR . 'templates/footer.php'); ?>