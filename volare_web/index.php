<?php

	// Include framework
	
	include_once('logic/framework.php');
	
	
	// Check session
	
	session_start();
	
	if( !isset($_SESSION['id']) || $_SESSION['id'] === '' ) {
	
		header("location:" . $_BASE_URL . "login.php");
	
	}
	
	Fb::log( 'Session is registered for user with id = ' . $_SESSION['id'] );
	
	

	$stmt = $dbh->prepare('SELECT * FROM polls ');
	$stmt->execute();

	$polls = Poll::getAll();

?>

<?php include_once($_BASE_DIR . 'templates/header.php'); ?>

<h2>My Polls</h2>

<section class="poll_list">

	<?php foreach ($polls as $poll) : ?>

		<article class="clearfix">

			<div class="title">
				<?php echo $poll->getTitle(); ?>
			</div>
			
			<div class="link">
				
				<a href="edit_poll.php?id=<?php echo $poll->getid(); ?>">Edit</a>
				
			</div>
			
			<form action="" method="post">
					
				<?php foreach ($poll->getOptions() as $option) : ?>
				
					<label for="option_<?php echo $option['id'] ?>"><?php echo $option['title'] ?></label>
					<input id="option_<?php echo $option['id'] ?>" name="vote" value="<?php echo $option['id'] ?>" type="radio">
									
				<?php endforeach; ?>
				
				<input type="submit" value="Vote">
			
			</form>

		</article>

	<?php endforeach; ?>

</section>

<a href="<?php echo $_BASE_URL ?>actions/logout.php">Logout</a>

<?php include_once($_BASE_DIR . 'templates/footer.php'); ?>