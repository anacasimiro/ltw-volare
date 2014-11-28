<!DOCTYPE html>
<html lang="pt-PT">

	<head>

		<meta charset="utf-8">
		<title>Volare</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="assets/style.css">
		<link rel="shortcut icon" type="image/png" href="<?php echo $_BASE_URL ?>assets/images/favicon.png"/>

	</head>

	<body>
		
		<?php if ( basename($_SERVER['PHP_SELF']) != 'login.php' ) {
		
			echo '<header>';
				
				echo '<div class="page_canvas">';
					
					echo '<a href="' . $_BASE_URL . '">Home</a>';
					
				echo '</div>';
				
			echo '</header>';
		
		} ?>

		<div class="main_content">

			<div class="page_canvas">