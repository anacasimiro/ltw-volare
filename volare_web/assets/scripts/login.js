/*
== ------------------------------------------------------------------- ==
== @@ Login Page
== ------------------------------------------------------------------- ==
*/

function enableSignupButton() {
	
	$('.signup a').click(function(event) {
		
		event.preventDefault();
		
		if ( $('.login-form').is(':visible') ) {

			$('.login-form').fadeOut(function() {
			
				$('.signup-form').fadeIn();
				
			});
			
			//$('.more').fadeOut();
			
		} else {
			
			$('.signup-form').fadeOut(function() {
			
				$('.login-form').fadeIn();
				
				//$('.more').fadeIn();
				
			});
			
		}
		
		$(this).fadeOut(function() {
		
			$(this).text() == 'Sign Up' ? $(this).text('Log In') : $(this).text('Sign Up');
			
		});
		
		$(this).fadeIn();
		
	});
	
}

function validateLoginForm() {
	
	var username = $('.login-form input[name=username]');
	var password = $('.login-form input[name=password]');
	
	username.focus(function() {
		$(this).removeClass('empty');
	});

	password.focus(function() {
		$(this).removeClass('empty');
	});
	
	$('.login-form input[type=submit]').click(function(event) {
		
		if ( username.val() === '' ) {
			
			username.addClass('empty');
			event.preventDefault();
			
		}
		
		if ( password.val() === '' ) {
			
			password.addClass('empty');
			event.preventDefault();
			
		}
		
	});
	
}

function validateSignupForm() {
	
	var username   = $('.signup-form input[name=username]');
	var password   = $('.signup-form input[name=password]');
	var confirm    = $('.signup-form input[name=confirm]');
	
	username.focus(function() {
		$(this).removeClass('empty');
	});

	password.focus(function() {
		$(this).removeClass('empty');
	});
	
	confirm.focus(function() {
		$(this).removeClass('empty');
	});
	
	$('.signup-form input[type=submit]').click(function(event) {
		
		if ( username.val() === '' ) {
			
			username.addClass('empty');
			event.preventDefault();
			
		}
		
		if ( password.val() === '' ) {
			
			password.addClass('empty');
			event.preventDefault();
			
		}
		
		if ( confirm.val() === '' ) {
			
			confirm.addClass('empty');
			event.preventDefault(s);
			
		}
		
	});
	
}

	
	

enableSignupButton();
validateLoginForm();
validateSignupForm();