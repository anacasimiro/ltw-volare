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

    
    Fb::log( 0 );
    
    
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

	Fb::log( 1 );

	// Check if privacy is specified
	
	if ( !isset($_POST['privacy']) || ( $_POST['privacy'] !== 1 && $_POST['privacy'] !== 0 ) ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$privacy = $_POST['privacy'];
		
		if ( $privacy !== $poll->isPublic() ) {
			
			$changes = 1;
			$poll->setPublic( $privacy );
			
		}
		
	}
	
	Fb::log( 2 );
	
	// Check if start date is specified
	
	if ( !isset($_POST['startDate']) || $_POST['startDate'] === '' ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$startDate = strtotime( $_POST['startDate'] );
		
		if ( !$startDate ) {
			
			echo "<script type='text/javascript'>";
			
				echo "alert('Error: Invalid date format!');";
				echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
				
			echo "</script>";
			die();
			
		} else {
			
			if ( $startDate !== $poll->getStartDate() ) {
			
				$changes = 1;
				$poll->setStartDate( $startDate );
				
			}
			
		}
		
	}
	
	Fb::log( 3 );
	
	// Check if end date is specified
	
	if ( !isset($_POST['endDate']) || $_POST['endDate'] === '' ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$endDate = strtotime( $_POST['endDate'] );
		
		if ( !$startDate ) {
			
			echo "<script type='text/javascript'>";
			
				echo "alert('Error: Invalid date format!');";
				echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
				
			echo "</script>";
			die();
			
		} else {
			
			if ( $startDate !== $poll->getEndDate() ) {
			
				$changes = 1;
				$poll->setEndDate( $endDate );
				
			}
			
		}
		
	}
	
	
	// Check if alerts are specified
	
	if ( !isset($_POST['alerts']) || ( $_POST['alerts'] !== 1 && $_POST['alerts'] !== 0 ) ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$alerts = $_POST['alerts'];
		
		if ( $alerts !== $poll->notifyOwner() ) {
			
			$changes = 1;
			$poll->setNotifyOwner( $alerts );
			
		}
		
	}
	
	
	// Check if image is specified
	
	if ( !isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Upload failed with error code " . $_FILES['image']['error'] . "');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	}
		
	$image_info = getimagesize($_FILES['file']['tmp_name']);
	$upload_dir = $_BASE_DIR . 'data/images/';
		
	if ( $image_info === FALSE ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Unable to determine image type of uploaded file');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	}
	
	if ( ($image_info[2] !== IMAGETYPE_JPEG) && ($image_info[2] !== IMAGETYPE_PNG) ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: The format of the uploaded image is not supported!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	}
	
	if ( !($poll->getImage()) ) {
		
		$changes = 1;
		move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $_FILES['image']['name']);
		$poll->setImage( $upload_dir . $_FILES['image']['name'] );
		
	}




    // Check if options are filled
/*

	if ( !isset($_POST['options']) || sizeof($_POST['options']) < 2 ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$options_count = 1;
		
		foreach ($_POST['options'] as $option ) {
            
            $options[] = array(
            
                "title" => $option,
                "order" => $options_count++,
                "pollId" => $poll,
                
            );
            
        }
        
	
	}
*/



	

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