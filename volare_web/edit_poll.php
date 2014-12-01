<?php

	// Include framework

	include_once( 'logic/framework.php' );


	// Check session
	
	include_once( $_BASE_DIR . 'logic/access/logged.php' );
	
	
	// Check if $_GET['id'] is defined

	if ( !isset($_GET['id']) ) {
		
		header("location:" . $_BASE_URL);
		
	} else {
		
		$id = $_GET['id'];	

	}
	

	// Get Poll object

    if ( $id > 0 ) { 

        $poll = Poll::withId( $id );
        
        Fb::log( $poll );
        
    } else {
        
        $poll = new Poll( array() );
        
    }


?>

<?php include_once( $_BASE_DIR . 'templates/header.php' ); ?>

<form class="edit_poll-form" action="<?php echo $_BASE_URL ?>actions/save_poll.php" method="post">

	<div class="volare_row">
		
		<div class="volare_col span_2_of_3">
			
			<div class="volare_row">
				
				<div class="volare_col span_1_of_1">
					
                    <input type="hidden" name="id" value="<?php echo $poll->getId(); ?>">
                    
					<label>Title</label>
					<input type="text" name="title" value="<?php echo $poll->getTitle(); ?>" <?php if ( $poll->getStartDate() < time() && $id ) echo 'disabled'; ?> >
					
				</div>
				
			</div>
			
			<div class="volare_row">
				
				<div class="volare_col span_1_of_2 poll_options">
					
					<label>Options</label>
					<?php

                        if ( $id ) {
                            
                            foreach ( $poll->getOptions() as $option ) {
                            
                                echo '<input type="text" name="options[]" placeholder="Option ' . $option['order'] . '" value="' . $option['title'] . '"';
                                if ( $poll->getStartDate() < time() ) echo ' disabled ';
                                echo '>';
                            
                            } 
                            
                        } else {
                            
                            echo '<input type="text" name="options[]" placeholder="Option 1" value="">';
                            echo '<input type="text" name="options[]" placeholder="Option 2" value="">';
                            
                        }

                    ?>
					<a class="add_option" href="#" <?php if ( $poll->getStartDate() < time() && $id ) echo 'style="display:none;"'; ?> >&#xf067;</a>
                    <a class="remove_option disabled" href="#" <?php if ( $poll->getStartDate() < time() && $id ) echo 'style="display:none;"'; ?> >&#xf068;</a>
					
				</div>
				
				<div class="volare_col span_1_of_2">
				
					<div class="privacy">
						<label>Is this poll public?</label>
						<input type="radio" class="yes" name="privacy" value="1" <?php if ( $poll->isPublic() && $id ) echo 'checked'; ?> >
						<input type="radio" class="no" name="privacy" value="0" <?php if ( !($poll->isPublic()) && $id ) echo 'checked'; ?> >
					</div>
                    
					<label>Start date</label>
					<input type="text" name="startDate" placeholder="DD/MM/YYYY" value="<?php if ( $id ) echo date('d/m/Y', $poll->getStartDate()); ?>" <?php if ( $poll->getStartDate() < time() && $id ) echo 'disabled'; ?> >
					
					<label>End date</label>
					<input type="text" name="endDate" placeholder="DD/MM/YYYY" value="<?php if ( $id ) echo date('d/m/Y', $poll->getEndDate()); ?>">
                    
                    <div class="alerts">
						<label>Enable email alerts?</label>
						<input type="radio" class="yes" name="alerts" value="1" <?php if ( $poll->getNotifyOwner() ) echo 'checked'; ?> >
						<input type="radio" class="no" name="alerts" value="0">
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="volare_col span_1_of_3 poll_image">
			
			<label>Image</label>
			<div>
				
				<img class="image_preview" src="" alt="" />
                <span class="camera_icon">&#xf030;</span>
                <input type="file" name="image" class="image_input" value="">

			</div>
			
		</div>

	</div>
	
	<div class="volare_row">
		
		<div class="volare_col span_1_of_1">
			
			<input type="submit" value="Save">
			
		</div>
		
	</div>

</form>

<?php include_once( $_BASE_DIR . 'templates/footer.php' ); ?>	