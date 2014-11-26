<?php

	include_once('logic/framework.php');

	$id = $_GET['id'];

	$stmt = $dbh->prepare('SELECT * FROM polls WHERE id=(?)');
	$stmt->execute(array($id));

	$poll = $stmt->fetch();

	Fb::log( $poll );

?>

<?php include_once('templates/header.php'); ?>

<h1>Edit Poll</h1>

<div class="poll">

	<form action="action-save_poll.php" method="post">

		<input type="hidden" name="id" value="<?=$poll['id']?>">

		<label>Title:</label>
		<input type="text" name="title" value="<?=$poll['title']?>">

		<input type="submit" value="Save poll">

	</form>

</div>

<?php include_once('templates/footer.php'); ?>