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
		
			echo "alert('Error: The Poll must have a title');";
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




	// Check if privacy is specified
	
	if ( !isset($_POST['privacy']) || ( $_POST['privacy'] !== '1' && $_POST['privacy'] !== '0' ) ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: You must choose an option concerning privacy!');";
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
	



	// Check if start date is specified
	
	if ( !isset($_POST['startDate']) || $_POST['startDate'] === '' ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: A start date must be specified!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$startDate = strtotime( $_POST['startDate'] );
		
		if ( !$startDate || strlen($_POST['startDate']) != 16 ) {
			
			echo "<script type='text/javascript'>";
			
				echo "alert('Error: Invalid start date!');";
				echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
				
			echo "</script>";
			die();
			
		} else {
			
			if ( $startDate != $poll->getStartDate() ) {
			
				$changes = 1;
				$poll->setStartDate( $startDate );
				
			}
			
		}
		
	}
	



	// Check if end date is specified
	
	if ( !isset($_POST['endDate']) || $_POST['endDate'] === '' ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: An end date must be specified!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$endDate = strtotime( $_POST['endDate'] );
		
		if ( !$endDate || strlen($_POST['endDate']) != 16 ) {
			
			echo "<script type='text/javascript'>";
			
				echo "alert('Error: Invalid end date!');";
				echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
				
			echo "</script>";
			die();
			
		} else {
			
			if ( $endDate != $poll->getEndDate() ) {
			
				$changes = 1;
				$poll->setEndDate( $endDate );
				
			}
			
		}
		
	}
	
	
	
	
	// Check if start and end dates are valid
	
	if ( $poll->getStartDate() >= $poll->getEndDate() ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Start date must be before the end date!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	}
	
	if ( $poll->getId() == 0 && $startDate < time() ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Start date cannot be before the current time!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	}
	
	if ( $endDate <= time() ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: End date cannot be before the current time!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	}
	
 
 
	
	// Check if alerts are specified
	
	if ( !isset($_POST['alerts']) || ( $_POST['alerts'] !== '1' && $_POST['alerts'] !== '0' ) ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: You must choose an option concerning email alerts!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		$alerts = $_POST['alerts'];
		
		if ( $alerts !== $poll->getNotifyOwner() ) {
			
			$changes = 1;
			$poll->setNotifyOwner( $alerts );
			
		}
		
	}



	
	// Check if image is specified

	if ( ( !isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK ) && !$poll->getImage() ) {
		
		if ( isset($_FILES['image']) && ( $_FILES['image']['error'] === UPLOAD_ERR_INI_SIZE || $_FILES['image']['error'] === UPLOAD_ERR_FORM_SIZE ) ) {
		
			echo "<script type='text/javascript'>";
			
				echo "alert('Error: The uploaded file exceeds the max size (2MB)!');";
				echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
				
			echo "</script>";
			die();
		
		} else {
			
			echo "<script type='text/javascript'>";
			
				echo "alert('Error: Upload failed with error code " . $_FILES['image']['error'] . "');";
				echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
				
			echo "</script>";
			die();
			
		}
		
	}

    if ( $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE ) {
		
        $image_info = getimagesize($_FILES['image']['tmp_name']);
        $upload_dir = 'data/images/';

        if ( $image_info === FALSE ) {

            echo "<script type='text/javascript'>";

                echo "alert('Error: The uploaded file does not seem to be an image!');";
                echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";

            echo "</script>";
            die();

        }

        if ( ($image_info[2] !== IMAGETYPE_JPEG) && ($image_info[2] !== IMAGETYPE_PNG) && ($image_info[2] !== IMAGETYPE_GIF) ) {

            echo "<script type='text/javascript'>";

                echo "alert('Error: Only images in JPEG, PNG and GIF formats are supported!');";
                echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";

            echo "</script>";
            die();

        }
        
        
    }
        
    if ( isset($image_info) && $image_info !== '' ) {

        $changes = 1;
        move_uploaded_file($_FILES['image']['tmp_name'], $_BASE_DIR . $upload_dir . $_FILES['image']['name']);
        $poll->setImage( $upload_dir . $_FILES['image']['name'] );

    } else {

        if ( !$poll->getImage() ) {
            
            echo "<script type='text/javascript'>";

                echo "alert('Error: The Poll must have an image!');";
                echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";

            echo "</script>";
            die();
            
        }

    }
		



	// Set creation date
	
	if ( !$poll->getId() ) {
		
		$poll->setCreationDate( time() );
		
	}




    // Check if options are filled

	if ( !isset($_POST['options']) || sizeof($_POST['options']) < 2 ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: The Poll must have at least 2 options!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
			
		echo "</script>";
		die();
		
	} else {
		
		if ( !$poll->getId() ) {
			
			$stmt = $dbh->prepare( 'BEGIN TRANSACTION' );
			$stmt->execute();
			
			$stmt = $dbh->prepare( 'INSERT INTO polls (title) VALUES (?)' );
			$stmt->execute(array( "dummy" ));
			
			$stmt = $dbh->prepare( 'SELECT * FROM polls ORDER BY id DESC LIMIT 1' );
			$stmt->execute();
			
			
			$new_id = $stmt->fetch()['id'];
			
			$stmt = $dbh->prepare( 'ROLLBACK' );
			$stmt->execute();
			
		}
		
		
		$options_count = 0;
		
		foreach ($_POST['options'] as $option ) {
			
			if ( $option !== '' ) {
            
	            $options[] = array(
	            
	                "title" => $option,
	                "order" => ++$options_count,
	                "pollId" => $poll->getId() ? $poll->getId() : $new_id
	                
	            );

			}
            
        }
        
        if ( $options_count < 2 ) {
	        
			echo "<script type='text/javascript'>";
			
				echo "alert('Error: The Poll must have at least 2 options!');";
				echo "window.location.href = '" . $_BASE_URL . "edit_poll.php?id=" . $poll->getId() . "'";
				
			echo "</script>";
			die();
	        
        } else {
	        
	        $currentOptions = $poll->getOptions();
	        
	        foreach ( $currentOptions as &$currentOption ) {
		        
		        unset( $currentOption['id'] );
		        
	        }
	        
	        if ( $options != $currentOptions ) {
		        
		        $changes = 1;
		        $poll->setOptions( $options );
		        
	        }
	        
        }
        
	}
	
	
	
	
	// Set Poll OwnerId
	
	if ( !$poll->getOwnerId() ) {
		
		$poll->setOwnerId( $currentUser->getId() );
		
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