<section class="poll_list">

	<?php $loop_count = 0; ?>

	<?php if ( isset($polls) ) { foreach ($polls as $poll) : ?>
	
		<?php if ( $poll->getStartDate() > time() ) continue; ?>
		
		<?php if ( $poll->getEndDate() < time() && $currentPage != 'voted.php' ) continue; ?>
		
		<?php if ( !$poll->isPublic() && $currentPage != 'voted.php' ) continue; ?>
		
		<?php
			
			$alreadyAnswered = 0;
			
			foreach ( $poll->getAnswers() as $answer ) {
				
				if ( $answer['userId'] == $currentUser->getId() && $currentPage != 'voted.php' ) $alreadyAnswered = 1;
				
			}
			
			if ( isset($alreadyAnswered) && $alreadyAnswered ) continue;
			
		?>
		
		<?php $loop_count++; ?>
	
		<?php $pollOwner = User::withId( $poll->getOwnerId() ); ?>

		<article class="clearfix poll<?php if ( $poll->getEndDate() <= time() ) echo ' ended'; ?>">

			<a title="View Poll" class="poll_image" href="<?php echo $_BASE_URL . 'view_poll.php?id=' . $poll->getId() ?>"><img src="<?php echo $poll->getImage(); ?>" alt="Poll Image" /></a>
			
			<div class="poll_details">
				
				<div class="description">
					
					<h3><?php
						
						echo $poll->getTitle();
						
						if ( $poll->getEndDate() <= time() ) { echo ' <cite>(finished)</cite>'; }
						
					?></h3>
					
					<span>Created by: <?php echo ( $pollOwner->getId() == $currentUser->getId() ) ? 'You' : $pollOwner->getUsername(); ?></span>
					
					<span>Start date: &nbsp;<?php echo date('m/d/Y H:i', $poll->getStartDate() ); ?></span>
					
					<span>End date: &nbsp;&nbsp;<?php echo date('m/d/Y H:i', $poll->getEndDate() ); ?></span>
					
				</div>
			
				<div class="poll_links">
					
					<?php
						
						if ( $pollOwner->getId() == $currentUser->getId() ) {
					
							if ( $poll->getEndDate() > time() ) {
							
								echo '<a class="edit_poll" href="' . $_BASE_URL . 'edit_poll.php?id=' . $poll->getId() . '">Edit Poll</a>';
							
							}
							
							echo '<a class="delete_poll" href="' . $_BASE_URL . 'actions/delete_poll.php?id=' . $poll->getId() . '">Delete Poll</a>';
						
						}	
						
						if ( $poll->getStartDate() <= time() ) {
						
							echo '<a class="view_poll" href="' . $_BASE_URL . 'view_poll.php?id=' . $poll->getId() . '">View Poll</a>';
							
						}
					
					?>
					
				</div>
				
			</div>

		</article>

	<?php endforeach; } ?>
	
	
	<?php
		
		if ( !$loop_count ) {
		
			if ( $currentPage == 'index.php' ) {
			
				echo '<h3>Oops! Looks like there are no polls! Go ahead and <a title="New Poll" href="' . $_BASE_URL . 'edit_poll.php?id=0">create one</a> now!</h3>';
				
			}
			
			if ( $currentPage == 'voted.php' ) {
				
				echo "<h3>Oops! Looks like you still haven't voted on any poll!</h3>";
				
			}
			
		}
		
	?>

</section>