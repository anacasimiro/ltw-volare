<?php

	// Include framework

	include_once('../logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Check $_POST
	
	include_once( $_BASE_DIR . 'logic/access/action.php' );
	
	
	// Intialize changes flag
	
	$changes = 0;
	
	
	// Check if username is filled
	
	if ( !isset($_POST['username'])	|| $_POST['username'] === '' ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_user.php'";
			
		echo "</script>";
		die();
		
	} else {
		
		$username = $_POST['username'];
	
	}
	
	
	// Check if email is filled
	
	if ( isset($_POST['email']) && $_POST['email'] !== '' ) {
		
		$email = $_POST['email'];
	
	}
	
	
	// Check if passwords are filled
	
	if ( isset($_POST['current_password']) && $_POST['current_password'] !== '' ) {
		
		$passwords['current_password'] = $_POST['current_password'];
		
	}
	if ( isset($_POST['new_password']) && $_POST['new_password'] !== '' ) {
		
		$passwords['new_password'] = $_POST['new_password'];
		
	}
	if ( isset($_POST['confirm_password']) && $_POST['confirm_password'] !== '' ) {
		
		$passwords['confirm_password'] = $_POST['confirm_password'];
		
	}
	
	if ( isset($passwords) && sizeof($passwords) != 3 ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Some mandatory fields are empty!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_user.php'";
			
		echo "</script>";
		die();
		
	}
	
	
	// Check if current password is right
	
	if ( isset($passwords) && $currentUser->getPassword() !== hash('sha256' , $passwords['current_password']) ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: The current password is wrong!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_user.php'";
			
		echo "</script>";
		die();
		
	}
	
	
	// Check if passwords match
	
	if ( isset($passwords) && $passwords['new_password'] !== $passwords['confirm_password'] ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Passwords do not match!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_user.php'";
			
		echo "</script>";
		die();
		
	}
	
	
	// Check if new password is the same as the previous
	
	if ( isset($passwords) && $passwords['current_password'] === $passwords['new_password'] ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: The new password cannot be the same as the old one!');";
			echo "window.location.href = '" . $_BASE_URL . "edit_user.php'";
			
		echo "</script>";
		die();
		
	}

		
	// Check if username changed
	
	if ( $currentUser->getUsername() !== $username ) {
	
	
		// Check if username already exists
		
		$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
		$stmt->execute(array($username));
		$result = $stmt->fetchAll();
		
		if ( isset($result) && sizeof($result) > 0 ) {
			
			echo "<script type='text/javascript'>";
			
				echo "alert('Error: Username is already being used!');";
				echo "window.location.href = '" . $_BASE_URL . "edit_user.php'";
				
			echo "</script>";
			die();
			
		}
		

		// Update session 
		
		$_SESSION['username'] = $username;

		
		// Update current user's username
		
		$currentUser->setUsername( $username );
		
		
		// Update changes flag
		
		$changes = 1;
		
	}
	
	
	// Check if email changed
	
	if ( isset($email) && $currentUser->getEmail() !== $email ) {
		
		// Update current user's email
		
		$currentUser->setEmail( $email );
		
		
		// Update changes flag
		
		$changes = 1;
		
	}
	
	
	// Check if password changed
	
	if ( isset($passwords) ) {
		
		// Update current user's password
		
		$currentUser->setPassword( hash('sha256', $passwords['new_password']) );
		
		
		// Update changes flag
		
		$changes = 1;
		
	}
	
	
	// Save user if there were changes
	
	if ( $changes ) {
	
        try {
            $currentUser->saveUser();
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
			echo "window.location.href = '" . $_BASE_URL . "edit_user.php'";
			
		echo "</script>";
		
	}
	
	
?>