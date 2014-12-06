/*
== ------------------------------------------------------------------- ==
== @@ Edit Poll Form
== ------------------------------------------------------------------- ==
*/

function addPollOptions() {
    
    var count = $('.edit_poll-form .poll_options input[name="options[]"]').size();
    
    // Add option
    
    $('.edit_poll-form a.add_option').click(function(event) {
    
        event.preventDefault();
        
        var new_option = '<input type="text" style="display:none;" name="options[]" placeholder="Option ' + (++count) + '" value="">';
        
        $('.edit_poll-form .poll_options a.add_option').before(new_option);
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

function previewUploadedImage() {
	
	var control = $('.edit_poll-form input.image_input');
	
	control.change(function() {
		
	    if (this.files && this.files[0]) {
	        
	        var reader = new FileReader();
	
	        reader.onload = function (e) {
	            
	            $('.edit_poll-form img.image_preview').attr('src', e.target.result);
	        
	        }
	
	        reader.readAsDataURL(this.files[0]);
	    }
		
	});
    
}

function autosetEndDate() {
	
	$('.edit_poll-form input[name="endDate"]').focus(function() {
		
		$(this).val( $('.edit_poll-form input[name="startDate"]').val() );
		
	});
	
}




addPollOptions();
previewUploadedImage();
autosetEndDate();