<?php

	// Include framework

	include_once('../logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );


    // Check $_POST
	
	include_once( $_BASE_DIR . 'logic/access/action.php' );


    // Get current Poll

    if ( isset($_POST['pollId']) && $_POST['pollId'] && isset($_POST['answer']) && $_POST['answer'] !== '' ) {
        
        $poll	= Poll::withId( $_POST['pollId'] );
        $answer = $_POST['answer'];
        
    } else {
        
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: You must choose an option!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_user.php'";
			
		echo "</script>";
		die();
        
    }
    
    
    // Get poll answers
    
    $pollAnswers = $poll->getAnswers();
    
    
    // Add answer
    
    $pollAnswers[] = array(
	    
	    'userId' => $currentUser->getId(),
	    'pollId' => $poll->getId(),
	    'optionId' => $answer
	    
    );
    
    
    // Set poll answers
    
    $poll->setAnswers( $pollAnswers );
    
    
    // Save poll
    
    try {
        $poll->saveAnswers();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    
    
    // Send notification
    
    if ( $poll->getNotifyOwner() ) {
	    
	    $pollOwner = User::withId( $poll->getOwnerId() );
	    
		$to			= $pollOwner->getEmail();
		$subject	= $currentUser->getUsername() . " voted on your poll!";
		$message	= "Hi there! We just wanted to let you know that " . $currentUser->getUsername() . " just voted on your poll! Go check it out now!";
		$header		= "From:no-reply@volare.com \r\n";
		$header	   .= "MIME-Version: 1.0\r\n";
		$header    .= "Content-type: text/html\r\n";
		$retval		= mail($to,$subject,$message,$header);
		
		if( $retval == true ) {
			
			Fb::log( "Message sent successfully..." );
		  
		} else {
			
			Fb::log( "Message could not be sent..." );
		  
		}
	    
    }
	
	
	// Return answers
	
	foreach ( $poll->getOptions() as $option ) {
		
		$answers_count = 0;
		
		foreach ( $pollAnswers as $answer ) {
			
			if ( $option['id'] == $answer['optionId'] ) $answers_count++;
			
		}
		
		$allAnswers[] = array(
			
			'option' => $option,
			'answers_count' => $answers_count
			
		);
		
	}
	
	
	echo json_encode( $allAnswers );
	
?>