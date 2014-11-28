<?php

	// Include framework
	
	include_once('../logic/framework.php');
	
	
	// Check if $_POST['username'] and $_POST['password'] are defined

	if ( !isset($_POST['username']) ||
		 !isset($_POST['password']) || 
		 $_POST['username'] === ''  ||
		 $_POST['password'] === ''		) {
		
		header("location:" . $_BASE_URL . "login.php");
		
	} else {
		
		$username = $_POST['username'];
		$password = $_POST['password'];

	}
	
	
	// Check if credentials are correct
	
	$stmt = $dbh->prepare('SELECT * FROM users WHERE username=?');
	$stmt->execute(array($username));
	$result = $stmt->fetch();
	
	if ( !$result ) {
		
		echo 'Invalid username!';
		
	} else if ( $password != $result['password'] ) {
		
		echo 'Invalid password!';
	
	} else {
		
		echo 'Login successful!';
		session_start();
		$_SESSION['id'] = $result['id'];
		header("location:" . $_BASE_URL);
		
	}
	

?>