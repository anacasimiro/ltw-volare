<?php

	// Include framework

	include_once( 'logic/framework.php' );


	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Check if $_GET['id'] is defined

	if ( !isset($_GET['id']) ) {
		
		header("location:" . $_BASE_URL);
		
	} else {
		
		$id = $_GET['id'];	

	}
	

	// Get Poll data

	$stmt = $dbh->prepare('SELECT * FROM polls WHERE id=(?)');
	$stmt->execute(array($id));
	$poll = $stmt->fetch();

?>

<?php include_once( $_BASE_DIR . 'templates/header.php' ); ?>

<form class="edit_poll-form" action="<?php echo $_BASE_URL ?>actions/save_poll.php" method="post">

	<div class="volare_row">
		
		<div class="volare_col span_2_of_3">
			
			<div class="volare_row">
				
				<div class="volare_col span_1_of_1">
					
					<label>Title</label>
					<input type="text" name="title" value="">
					
				</div>
				
			</div>
			
			<div class="volare_row">
				
				<div class="volare_col span_1_of_2">
					
					<label>Options</label>
					<input type="text" name="option1" placeholder="Option 1" value="">
					<input type="text" name="option2" placeholder="Option 2" value="">
					<input type="text" name="option3" placeholder="Option 3" value="">
					<input type="text" name="option4" placeholder="Option 4" value="">
					<input type="text" name="option5" placeholder="Option 5" value="">
					
				</div>
				
				<div class="volare_col span_1_of_2">
					
					<label>Start date</label>
					<input type="text" name="startDate" placeholder="DD/MM/YYYY" value="">
					
					<label>End date</label>
					<input type="text" name="endDate" placeholder="DD/MM/YYYY" value="">
					
					<div class="privacy">
						<label>Privacy</label><br/>
						<input type="radio" name="privacy" value="private">
						<input type="radio" name="privacy" value="public">
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="volare_col span_1_of_3">
			
			<label>Image</label>
			<div class="poll_image">
				
				
				
			</div>
			<input type="file" name="poll_image_upload" value="">
			
		</div>

	</div>
	
	<div class="volare_row">
		
		<div class="volare_col span_1_of_1">
			
			<input type="submit" value="Save">
			
		</div>
		
	</div>

</form>

<?php include_once( $_BASE_DIR . 'templates/footer.php' ); ?>	