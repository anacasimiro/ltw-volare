<?php

	// Include framework
	
	include_once('logic/framework.php');
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Get current user
	
	$currentUser = User::withUsername( $_SESSION['username'] );
	
	
	// Get the 6 latest Polls

	$stmt = $dbh->prepare('SELECT id FROM polls');
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	foreach ( $result as $row ) {
		
		$latestPolls[] = Poll::withId( $row['id'] );
		
	}

?>

<?php include_once($_BASE_DIR . 'templates/header.php'); ?>

<h2>My Polls</h2>

<section class="poll_list">

	<?php foreach ($latestPolls as $poll) : ?>

		<article class="clearfix">

			<div class="title">
				<?php echo $poll->getTitle(); ?>
			</div>
			
			<div class="link">
				
				<a href="<?php echo $_BASE_URL ?>edit_poll.php?id=<?php echo $poll->getId(); ?>">Edit</a>
				
			</div>
			
			<form action="" method="post">
					
				<?php foreach ($poll->getOptions() as $option) : ?>
				
					<label for="option_<?php echo $option['id'] ?>"><?php echo $option['title'] ?></label>
					<input id="option_<?php echo $option['id'] ?>" name="vote" value="<?php echo $option['id'] ?>" type="radio">
									
				<?php endforeach; ?>
				
				<input type="submit" value="">
				
				<p>Poll started in: <?php echo date( 'd M Y, h:m:s', $poll->getStartDate() ) ?></p>
			
			</form>

		</article>

	<?php endforeach; ?>

</section>

<?php include_once($_BASE_DIR . 'templates/footer.php'); ?>