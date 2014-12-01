<?php

	// Include framework

	include_once('../logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );


    // Check $_POST
	
	include_once( $_BASE_DIR . 'logic/access/action.php' );


    // Get current Poll

    if ( $_POST['id'] ) {
        
        $poll = Poll::withId( $_POST['id'] );
        
    } else {
        
        $poll = new Poll( array() );
        
    }


	// Intialize changes flag
	
	$changes = 0;

    
    // Check if title is filled

	if ( !isset($_POST['title']) || $_POST['title'] === '' ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$title = $_POST['title'];
        
        if ( $title !== $poll->getTitle() ) {
            
            $changes = 1;
            $poll->setTitle( $title );
            
        }
	
	}


    // Check if options are filled

	if ( !isset($_POST['options']) || sizeof($_POST['options']) < 2 ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		foreach ($_POST['options'] as $option ) {
            
            $options[] = array(
            
                //"id" => "
                
            );
            
        }
        
	
	}







	

	// Save poll if there were changes
	
	if ( $changes ) {
	
        try {
            $poll->savePoll();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
	
		// Redirect
	
		echo "<script type='text/javascript'>";
		
			echo "alert('Operation completed successfully!');";
			echo "window.location.href = '" . $_BASE_URL . "'";
			
		echo "</script>";
		
	} else {
		
		// Redirect
	
		echo "<script type='text/javascript'>";
		
			echo "alert('No fields were changed!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		
	}


?>