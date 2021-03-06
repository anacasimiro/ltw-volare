<?php

	// Include framework
	
	include_once( 'logic/framework.php' );
	
	
	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/not_logged.php' );

?>

<?php include_once( $_BASE_DIR . 'templates/header.php' ); ?>

<div class="splash_screen">

	<a class="logo" href="<?php echo $_BASE_URL ?>"></a>
	
	<h1>Time flies<br/>Make good choices</h1>
	
	<p>Welcome to Volare</p>
	
	<form class="login-form" action="<?php echo $_BASE_URL ?>actions/check_login.php" method="post">
		
		<input autocomplete="off" class="" type="text" name="username" placeholder="USERNAME">
		<input class="" type="password" name="password" placeholder="PASSWORD">
		
		<input type="submit" value="&#xf090;">
		
	</form>
	
	<form class="signup-form" action="<?php echo $_BASE_URL ?>actions/signup.php" method="post">
		
		<input type="text" name="username" placeholder="USERNAME">
		<input type="password" name="password" placeholder="PASSWORD">
		<input type="password" name="confirm" placeholder="CONFIRM PASSWORD">
		
		<input type="submit" value="Sign Up">
		
	</form>
	
	<div class="signup">
		
		<a href="">Sign Up</a>
		
	</div>
	
	<div class="more">
	
		<p>Check out some polls</p>
		
		<a href="#poll_examples"></a>
	
	</div>

</div>

<div id="poll_examples">

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	
</div>

<?php include_once( $_BASE_DIR . 'templates/footer.php' ); ?>