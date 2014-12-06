/*
== ------------------------------------------------------------------- ==
== @@ Vote AJAX
== ------------------------------------------------------------------- ==
*/

function getVoteResults() {
	
	$('.view_poll_area .voting').submit(function(event) {
		
		event.preventDefault();
		
		$.ajax({
			type: 'post',
			url: '../../actions/vote.php',
			data: $(this).serialize(),
			success: function(data) {
				
				var allAnswers = $.parseJSON(data);
				var totalAnswers = 0;
				var answers = [];
				
				$('.view_poll_area .voting').fadeOut(function() {
					
					$(allAnswers).each(function(index, item) {
						
						totalAnswers += this['answers_count'];
						
						var option = {
							
							optionId:	'o' + this['option']['id'],
							votes:		this['answers_count']
							
						}
						
						answers.push( option );
						
					});
					
					$(answers).each(function() {
						
						var new_width = Math.round( (this.votes / totalAnswers) * 100 );
						
						$('.poll_results .' + this.optionId).find('.votes_bar span').append("<cite> - " + this.votes + " vote(s)</cite>");
						
						$('.poll_results .' + this.optionId).find('.votes_bar').animate( {"width": new_width + "%"}, 1000);
						
					});
					
					$('.view_poll_area .poll_results').fadeIn();
					
				});
				
			},
			fail: function() {
				alert('form failed');
			}
		});
		
	});
	
}




getVoteResults();