$(document).ready(function() {
	
	$('.signup a').click(function(event) {
		
		event.preventDefault();
		
		if ( $('.login-form').is(':visible') ) {

			$('.login-form').fadeOut(function() {
			
				$('.signup-form').fadeIn();
				
			});
			
			$('.more').fadeOut();
			$('#poll_examples').fadeOut();
			
		} else {
			
			$('.signup-form').fadeOut(function() {
			
				$('.login-form').fadeIn();
				
				$('.more').fadeIn();
				$('#poll_examples').fadeIn();
				
			});
			
		}
		
		$(this).fadeOut(function() {
		
			$(this).text() == 'Sign Up' ? $(this).text('Log In') : $(this).text('Sign Up');
			
		});
		
		$(this).fadeIn();
		
	});
	
});