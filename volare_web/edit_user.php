<?php

	// Include framework

	include_once( 'logic/framework.php' );


	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Get current user
	
	$currentUser = User::withUsername( $_SESSION['username'] );
	

?>

<?php include_once( $_BASE_DIR . 'templates/header.php' ); ?>

<form class="edit_user-form" action="<?php echo $_BASE_URL ?>actions/save_user.php" method="post">

	<div class="volare_row">
		
		<div class="volare_col span_1_of_2">
	
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $currentUser->getUsername() ?>">
			
		</div>
		
		<div class="volare_col span_1_of_2">
			
			<label>E-mail</label>
			<input type="text" name="email" value="<?php echo $currentUser->getEmail() ?>">
			
		</div>
	
	</div>
	
	<div class="volare_row">
		
		<div class="volare_col span_1_of_3">
			
			<label>Current password</label>
			<input type="password" name="current_password" value="">
			
		</div>
		
		<div class="volare_col span_1_of_3">
		
			<label>New password</label>
			<input type="password" name="new_password" value="">
			
		</div>
		
		<div class="volare_col span_1_of_3">
			
			<label>Confirm password</label>
			<input type="password" name="confirm_password" value="">
			
		</div>

		
	</div>
	
	<div class="volare_row">
		
		<div class="volare_col span_1_of_1">
			
			<input type="submit" value="Save">
			
		</div>
	
	</div>

</form>

<?php include_once( $_BASE_DIR . 'templates/footer.php' ); ?>	