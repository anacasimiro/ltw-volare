<?php

	// Include framework

	include_once('../logic/framework.php');
	
	
	// Check $_POST
	
	include_once( $_BASE_DIR . 'logic/access/action.php' );
	
	
	// Check if all mandatory fields were filled
	
	if ( !isset($_POST['username'])	|| $_POST['username'] ) {
		
		header("location:" . $_BASE_URL . "edit_user.php?status=empty_fields");
		die();
		
	} else {
		
		$username = $_POST['username'];
	
	}
	
	if ( isset($_POST['current_password']) && $_POST['current_password'] !== '' ) {
		
		$passwords['current_password'] = $_POST['current_password'];
		
	}
	if ( isset($_POST['new_password']) && $_POST['new_password'] !== '' ) {
		
		$passwords['new_password'] = $_POST['new_password'];
		
	}
	if ( isset($_POST['confirm_password']) && $_POST['confirm_password'] !== '' ) {
		
		$passwords['confirm_password'] = $_POST['confirm_password'];
		
	}
	
	if ( !isset($passwords) || sizeof($passwords) != 3 ) {
		
		header("location:" . $_BASE_URL . "edit_user.php?status=empty_fields");
		die();
		
	}
	
	
	// Update user
	
	$currentUser->setUsername( $username );
	
	
	
	

	try {
		$stmt = $dbh->prepare('UPDATE polls SET title = ? WHERE id = ?');
		$stmt->execute(array($title, $id));

	} catch (PDOException $e) {
		die($e->getMessage());
	}

	header('Location: ' . $_BASE_URL . 'edit_poll.php?id=' . $_POST['id']);

?>