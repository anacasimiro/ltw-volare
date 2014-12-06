			</div>
		
		</div>
		
		<footer>
				
			<div class="page_canvas">
			
				<span class="copyright">2014 Volare &#169; All rights reserved</span>
				
				<span class="developers">Developed by: Ana Casimiro &#38;&#38; João Bernardino</span>
				
			</div>
			
		</footer>
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<?php if ( basename($_SERVER['PHP_SELF']) == 'edit_poll.php' ) {
			echo '<script type="text/javascript" src="' . $_BASE_URL . 'assets/scripts/edit_poll.js"></script>';
		} ?>
		<?php if ( basename($_SERVER['PHP_SELF']) == 'login.php' ) {
			echo '<script type="text/javascript" src="' . $_BASE_URL . 'assets/scripts/login.js"></script>';
		} ?>
		<?php if ( basename($_SERVER['PHP_SELF']) == 'index.php' ) {
			echo '<script type="text/javascript" src="' . $_BASE_URL . 'assets/scripts/poll_list.js"></script>';
		} ?>
		<?php if ( basename($_SERVER['PHP_SELF']) == 'view_poll.php' ) {
			echo '<script type="text/javascript" src="' . $_BASE_URL . 'assets/scripts/vote.js"></script>';
		} ?>
		
		<?php
			
			if ( $currentPage == 'view_poll.php' && isset($currentUsersAnswer) ) {
				
				echo '<script type="text/javascript">';
				
					echo '$(".view_poll_area .poll_results").show();';
				
				echo '</script>';
				
			}
			
		?>

	</body>
	
</html>