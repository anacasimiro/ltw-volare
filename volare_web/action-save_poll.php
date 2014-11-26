<?php

	include_once('logic/framework.php');

	$id = $_POST['id'];
	$title = $_POST['title'];

	// update à bd...

	try {
		$stmt = $dbh->prepare('UPDATE polls SET title = ? WHERE id = ?');
		$stmt->execute(array($title, $id));

	} catch (PDOException $e) {
		die($e->getMessage());
	}

	header('Location: edit_poll.php?id=' . $_POST['id']);

?>