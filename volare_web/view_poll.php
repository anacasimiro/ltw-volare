<?php

	// Include framework

	include_once( 'logic/framework.php' );


	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Check if $_GET['id'] is defined

	if ( !isset($_GET['id']) ) {
		
		header("location:" . $_BASE_URL);
		
	} else {
		
		$id = $_GET['id'];	

	}
	

	// Get Poll object

    if ( $id > 0 ) { 

        $poll = Poll::withId( $id );
        
    } else {
        
        header("location:" . $_BASE_URL);
        
    }
    
    
    // Check if Poll already started
    
    if ( $poll->getStartDate() > time() ) {
	    
	    header("location:" . $_BASE_URL);
	    
    }
    
    
    // Get Poll owner
    
    $pollOwner = User::withId( $poll->getOwnerId() );
    
    
    // Get current user's answer
    
    if ( sizeof( $poll->getAnswers() ) > 0 ) {
    
	    foreach ( $poll->getAnswers() as $answer ) {
		    
		    if ( $answer['userId'] == $currentUser->getId() ) {
			    
			    $currentUsersAnswer = $answer;
			    
		    }
		    
	    }

	}

?>

<?php include_once( $_BASE_DIR . 'templates/header.php' ); ?>

<div class="view_poll_area">
	
	<h2><?php
		
		echo $poll->getTitle();
		if ( $poll->getEndDate() <= time() ) { echo ' <cite>(finished)</cite>'; }
		
	?></h2>

	<div class="volare_row">
		
		<div class="volare_col span_1_of_3">
				
			<img class="poll_image" src="<?php if ( $poll->getImage() ) echo $_BASE_URL . $poll->getImage(); ?>" alt="" />
			
			<span>Created by: <?php echo ( $pollOwner->getId() == $currentUser->getId() ) ? 'You' : $pollOwner->getUsername(); ?></span>
			
			<span>Start date: &nbsp;<?php echo date('m/d/Y H:i', $poll->getStartDate() ); ?></span>
			
			<span>End date: &nbsp;&nbsp;<?php echo date('m/d/Y H:i', $poll->getEndDate() ); ?></span>
			
		</div>
		
		<div class="volare_col span_2_of_3">
					
			<form class="voting" action="actions/vote.php" method="post">
				
				<input type="hidden" name="pollId" value="<?php echo $poll->getId(); ?>">
				
				<?php
	                    
					foreach ( $poll->getOptions() as $option ) {
					
						echo '<div>';
						
					    	echo '<input ';
					    	
					    	if ( isset( $currentUsersAnswer ) && $currentUsersAnswer['optionId'] == $option['id'] ) echo 'checked ';
					    	if ( isset( $currentUsersAnswer ) || $poll->getEndDate() <= time() ) echo 'disabled ';
					    	
					    	echo 'type="radio" name="answer" id="option_' . $option['id'] . '" value="' . $option['id'] . '">';
							echo '<label for="">' . $option['title'] . '</label>';
					    
					    echo '</div>';
					
					}
					
					if ( $poll->getEndDate() > time() && ( !isset($currentUsersAnswer) || !$currentUsersAnswer ) ) echo '<input type="submit" value="Vote">';
	
	            ?>
	        
			</form>
			
			<div class="poll_results">
				
				<?php
					
					echo '<input type="hidden" name="total_votes" value="' . sizeof($poll->getAnswers()) . '">';
					
					echo '<h3>Results</h3>';
				
					foreach ( $poll->getOptions() as $option ) {
						
						$votes_count = 0;
						
						foreach ( $poll->getAnswers() as $answer ) {
							
							if ( $answer['optionId'] == $option['id'] ) $votes_count++;
							
						}
						
						echo '<div class="option o' . $option['id'] . '">';
						
							echo '<div class="votes_bar"><span>' . $option['title'] . '<cite> - ' . $votes_count . ' vote(s)</cite></span></div>';
						
						echo '</div>';
						
					}	
					
				?>
				
			</div>
			
		</div>
		
	</div>
	
</div>

<?php include_once( $_BASE_DIR . 'templates/footer.php' ); ?>