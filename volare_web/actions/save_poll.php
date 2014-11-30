<?php

	// Include framework

	include_once('../logic/framework.php');
	
	
	// Check $_POST
	
	include_once( $_BASE_DIR . 'logic/access/action.php' );
	

	$id = $_POST['id'];
	$title = $_POST['title'];

	// update à bd...

	try {
		$stmt = $dbh->prepare('UPDATE polls SET title = ? WHERE id = ?');
		$stmt->execute(array($title, $id));

	} catch (PDOException $e) {
		die($e->getMessage());
	}

	header('Location: ' . $_BASE_URL . 'edit_poll.php?id=' . $_POST['id']);

?>