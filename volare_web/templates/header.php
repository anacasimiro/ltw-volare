<?php
	
	// Get current page
	
	$currentPage = basename($_SERVER['PHP_SELF']);
	
?>

<!DOCTYPE html>
<html lang="pt-PT">

	<head>

		<meta charset="utf-8">
		<title>Volare</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_URL ?>assets/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $_BASE_URL ?>assets/plugins/font-awesome/css/font-awesome.css" />
		<link rel="shortcut icon" type="image/png" href="<?php echo $_BASE_URL ?>assets/images/favicon.png"/>
		
		<!--[if lt IE 9]>
		    <script src="../assets/plugins/html5shiv/html5shiv.js"></script>
		<![endif]-->

	</head>

	<body <?php if ( $currentPage != 'login.php' ) { echo 'class="fixed"'; } ?>>
		
		<?php if ( $currentPage != 'login.php' ) {
		
			echo '<header class="dark">';
				
				echo '<div class="page_canvas">';
				
					echo '<div class="meta_bar">';
					
						echo '<div class="align_wrapper">';
					
							echo '<div class="meta_links">';
						
		?>
		
		<?php
						
								echo '<a class="my_profile';
								
								if ( $currentPage == 'edit_user.php' ) echo ' active';
								
								echo '" href="' . $_BASE_URL . 'edit_user.php">' . $currentUser->getUsername() . '</a>';
						
		?>
		
		<?php
			
								echo '<a class="logout" href="' . $_BASE_URL . 'actions/logout.php">Logout</a>';
					
							echo '</div>';
					
						echo '</div>';
					
					echo '</div>';
					
					echo '<div class="main">';
					
						echo '<a class="logo" href="' . $_BASE_URL . '"></a>';
					
						echo '<nav class="main_menu">';
						
							echo '<div class="align_wrapper">';
						
								echo '<ul>';
							
		?>
		
		<?php
							
									echo '<li><a class="home';
									if ( $currentPage == 'index.php' ) echo ' active';
									echo '" href="' . $_BASE_URL . '">Home</a></li>';
									
									echo '<li><a class="new_poll';
									if ( $currentPage == 'edit_poll.php' && isset($_GET['id']) && $_GET['id'] == 0 ) echo ' active';
									echo '" href="' . $_BASE_URL . 'edit_poll.php?id=0">New Poll</a></li>';
									
									echo '<li><a class="voted';
									if ( $currentPage == 'voted.php' ) echo ' active';
									echo '" href="' . $_BASE_URL . 'voted.php">Voted Polls</a></li>';
									
									echo '<li><a class="my_polls';
									if ( $currentPage == 'my_polls.php' ) echo ' active';
									echo '" href="' . $_BASE_URL . 'my_polls.php">My Polls</a></li>';
								
		?>
		
		<?php
							
								echo '</ul>';
								
							echo '</div>';
						
						echo '</nav>';
						
					echo '</div>';
					
				echo '</div>';
				
			echo '</header>';
			
			echo '<div class="fade header"></div>';
		
		} ?>

		<div class="main_content">

			<div class="page_canvas">