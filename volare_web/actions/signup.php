<?php

	// Include framework
	
	include_once('../logic/framework.php');
	
	
	// Check $_POST
	
	include_once( $_BASE_DIR . 'logic/access/action.php' );
	
	
	// Check if all fields were filled
	
	if ( !isset($_POST['username']) ||
		 !isset($_POST['password']) ||
		 !isset($_POST['confirm'])  ||
		 $_POST['username'] === ''  ||
		 $_POST['password'] === ''  ||
		 $_POST['confirm']  === ''     ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Empty fields!');";
			echo "window.location.href = '" . $_BASE_URL . "login.php'";
			
		echo "</script>";
		die();
		
	} else {
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm  = $_POST['confirm'];
	
	}
	
	
	// Check if username already exists
	
	$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->execute(array($username));
	$result = $stmt->fetchAll();
	
	if ( isset($result) && sizeof($result) > 0 ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Username is already being used!');";
			echo "window.location.href = '" . $_BASE_URL . "login.php'";
			
		echo "</script>";
		die();
		
	}
	
	
	// Check if passwords match
	
	if ( $password != $confirm ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Passwords do not match!');";
			echo "window.location.href = '" . $_BASE_URL . "login.php'";
			
		echo "</script>";
		die();
		
	}
	
	
	// Create new user
	
	$userData['username']          = $username;
	$userData['password']          = hash('sha256', $password);
	$userData['registrationDate']  = time();
	$userData['lastLogin']         = $userData['registrationDate'];
	
	$newUser = new User( $userData );
	$newUser->saveUser();
	


	// Start session for new user
		
	session_start();
	$_SESSION['username'] = $newUser->getUsername();
	header("location:" . $_BASE_URL);

	

?>