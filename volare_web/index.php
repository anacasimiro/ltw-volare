<?php

	include_once('logic/framework.php');

	$stmt = $dbh->prepare('SELECT * FROM polls ');
	$stmt->execute();

	$polls = Poll::getAll();

?>

<?php include_once($_BASE_DIR . 'templates/header.php'); ?>

<h1>My Polls</h1>

<section class="poll_list">

	<?php foreach ($polls as $poll) : ?>

		<article class="clearfix">

			<div class="title">
				<?php echo $poll->getTitle(); ?>
			</div>
			
			<div class="link">
				
				<a href="edit_poll.php?id=<?php echo $poll->getid(); ?>">Edit</a>
				
			</div>
			
			<ul class="poll_options">
				
				<?php foreach ($poll->getOptions() as $option) : ?>
				
					<li><?php echo $option['title'] ?></li>
									
				<?php endforeach; ?>
				
			</ul>

		</article>

	<?php endforeach; ?>

</section>

<?php include_once($_BASE_DIR . 'templates/footer.php'); ?>