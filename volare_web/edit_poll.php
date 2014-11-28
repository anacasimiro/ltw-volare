<?php

	// Include framework

	include_once( 'logic/framework.php' );


	// Check session
	
	session_start();
	
	if( !isset($_SESSION['id']) ){
	
		header("location:" . $_BASE_URL . "login.php");
	
	}
	
	
	// Check if $_GET['id'] is defined

	if ( !isset($_GET['id']) ) {
		
		header("location:" . $_BASE_URL . "index.php");
		
	} else {
		
		$id = $_GET['id'];	

	}
	

	// Get Poll data

	$stmt = $dbh->prepare('SELECT * FROM polls WHERE id=(?)');
	$stmt->execute(array($id));
	$poll = $stmt->fetch();

?>

<?php include_once( $_BASE_DIR . 'templates/header.php' ); ?>

<h2>Edit Poll</h2>

<div class="poll">

	<form action="<?php echo $_BASE_URL ?>	actions/save_poll.php" method="post">

		<input type="hidden" name="id" value="<? echo $poll['id'] ?>">

		<label>Title:</label>
		<input type="text" name="title" value="<?php echo $poll['title'] ?>">

		<input type="submit" value="Save poll">

	</form>

</div>

<?php include_once( $_BASE_DIR . 'templates/footer.php' ); ?>	