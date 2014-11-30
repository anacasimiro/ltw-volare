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
		
		<div class="volare_col span_1_of_3">
	
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $currentUser->getUsername() ?>">
			
			<label>E-mail</label>
			<input type="text" name="email" value="">
			
		</div>
		
		<div class="volare_col span_1_of_3">
			
			<label>Birth date</label>
			<input type="text" name="birthDate" placeholder="DD/MM/YYYY" value="<?php echo date('d/m/Y', $currentUser->getBirthDate()) ?>">
		
			<div class="gender">
				<label>Gender</label><br/>
				<input type="radio" name="gender" value="M">
				<input type="radio" name="gender" value="F">
			</div>
			
		</div>
		
	</div>
	
	<div class="volare_row">
		
		<div class="volare_col span_1_of_3">
			
			<label>Current password</label>
			<input type="password" name="current_password" value="">
		
			<label>New password</label>
			<input type="password" name="new_password" value="">
			
			<label>Confirm password</label>
			<input type="password" name="confirm_password" value="">
			
		</div>

		<input type="submit" value="">
	
	</div>

</form>

<?php include_once( $_BASE_DIR . 'templates/footer.php' ); ?>	