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


function addPollOptions() {
    
    var count = 2;
        
    
    // Add option
    
    $('.edit_poll-form a.add_option').click(function(event) {
    
        event.preventDefault();
        
        var new_option = '<input type="text" style="display:none;" name="options[]" placeholder="Option ' + (++count) + '" value="">';
        
        $('.edit_poll-form .poll_options input[name="options[]"]:last-of-type').after(new_option);
        $('.edit_poll-form .poll_options input[name="options[]"]:last-of-type').slideDown(200);
        
        
        // Enable or disable buttons
    
        if ( count > 2 ) {

            $('.edit_poll-form a.remove_option').removeClass('disabled');

        } else {

            $('.edit_poll-form a.remove_option').addClass('disabled');
            
        }
        
        if ( count < 5 ) {

            $('.edit_poll-form a.add_option').removeClass('disabled');

        } else {

            $('.edit_poll-form a.add_option').addClass('disabled');
            
        }
        
    });
    
    
    // Remove option
    
    $('.edit_poll-form a.remove_option').click(function(event) {
    
        event.preventDefault();
        
        count--;
        $('.edit_poll-form .poll_options input[name="options[]"]:last-of-type').slideUp(200, function() {
        
            $(this).remove();
        
        });
        
        
        // Enable or disable buttons
    
        if ( count > 2 ) {

            $('.edit_poll-form a.remove_option').removeClass('disabled');

        } else {

            $('.edit_poll-form a.remove_option').addClass('disabled');
            
        }
        
        if ( count < 5 ) {

            $('.edit_poll-form a.add_option').removeClass('disabled');

        } else {

            $('.edit_poll-form a.add_option').addClass('disabled');
            
        }
        
    });
    
}


function previewUploadedImage(input) {
    
    if (input.files && input.files[0]) {
        
        var reader = new FileReader();

        reader.onload = function (e) {
            
            $('.edit_poll-form img.image_preview').attr('src', e.target.result);
        
        }

        reader.readAsDataURL(input.files[0]);
    }
    
}


$(document).ready(function() {
	
	enableSignupButton();
	validateLoginForm();
	validateSignupForm();
    addPollOptions();
    $('.edit_poll-form input.image_input').change(function() {
    
        previewUploadedImage(this);
        
    });
    
});