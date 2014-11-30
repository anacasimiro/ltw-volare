<!DOCTYPE html>
<html lang="pt-PT">

	<head>

		<meta charset="utf-8">
		<title>Volare</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_URL ?>assets/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_URL ?>assets/plugins/font-awesome/css/font-awesome.css" />
		<link rel="shortcut icon" type="image/png" href="<?php echo $_BASE_URL ?>assets/images/favicon.png"/>

	</head>

	<body <?php if ( basename($_SERVER['PHP_SELF']) != 'login.php' ) { echo 'class="fixed"'; } ?>>
		
		<?php if ( basename($_SERVER['PHP_SELF']) != 'login.php' ) {
		
			echo '<header class="dark">';
				
				echo '<div class="page_canvas">';
				
					echo '<div class="meta_bar">';
					
						echo '<a class="logout" href="' . $_BASE_URL . 'actions/logout.php">Logout</a>';
						
						echo '<a class="my_profile" href="' . $_BASE_URL . 'edit_user.php">' . $currentUser->getUsername() . '</a>';
					
					echo '</div>';
					
					echo '<div class="main">';
					
						echo '<a class="logo" href="' . $_BASE_URL . '"></a>';
					
						echo '<nav class="main_menu">';
						
							echo '<ul>';
							
								echo '<li><a class="home" href="' . $_BASE_URL . '">Home</a></li>';
								echo '<li><a class="new_poll" href="' . $_BASE_URL . 'edit_poll.php?id=0">New Poll</a></li>';
								echo '<li><a class="my_polls" href="' . $_BASE_URL . '">My Polls</a></li>';
							
							echo '</ul>';
						
						echo '</nav>';
						
					echo '</div>';
					
				echo '</div>';
				
			echo '</header>';
			
			echo '<div class="fade header"></div>';
		
		} ?>

		<div class="main_content">

			<div class="page_canvas">