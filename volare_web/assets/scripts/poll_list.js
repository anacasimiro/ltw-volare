/*
== ------------------------------------------------------------------- ==
== @@ Poll list
== ------------------------------------------------------------------- ==
*/


function deletePollConfirm() {
	
	$('.poll_list .poll a.delete_poll').click(function(event) {
		
		if ( !confirm( 'Are you sure you want to delete this poll?' ) ) {
			
			event.preventDefault();	
			
		}
		
	});
	
}



deletePollConfirm();