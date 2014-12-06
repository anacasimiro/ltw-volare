<?php

	// Include framework
	
	include_once('../logic/framework.php');
	
	
	// Check $_POST
	
	include_once( $_BASE_DIR . 'logic/access/action.php' );
	
	
	// Check if $_POST['username'] and $_POST['password'] are defined

	if ( !isset($_POST['username']) ||
		 !isset($_POST['password']) || 
		 $_POST['username'] === ''  ||
		 $_POST['password'] === ''		) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Empty fields!');";
			echo "window.location.href = '" . $_BASE_URL . "login.php'";
			
		echo "</script>";
		die();
		
	} else {
		
		$username = $_POST['username'];
		$password = hash('sha256', $_POST['password']);

	}
	
	
	// Check if credentials are correct
	
	$stmt = $dbh->prepare('SELECT * FROM users WHERE username=?');
	$stmt->execute(array($username));
	$result = $stmt->fetch();
	
	if ( !$result ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Invalid Username!');";
			echo "window.location.href = '" . $_BASE_URL . "login.php'";
			
		echo "</script>";
		die();
		
	} else if ( $password != $result['password'] ) {
		
		echo "<script type='text/javascript'>";
		
			echo "alert('Error: Wrong Password!');";
			echo "window.location.href = '" . $_BASE_URL . "login.php'";
			
		echo "</script>";
		die();
	
	} else {
		
		
		// Start session
		
		echo 'Login successful!';
		session_start();
		$_SESSION['username'] = $result['username'];
		header("location:" . $_BASE_URL);
		
	}
	

?>