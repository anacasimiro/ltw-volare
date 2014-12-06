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
        
    } else {
        
        $poll = new Poll( array() );
        
    }
    

	// Redirect if poll already ended
	
	if ( $id > 0 && $poll->getEndDate() <= time() ) {
		
		header("location:" . $_BASE_URL);
		
	}
	
	
	// Redirect if poll doesn't belong to current user
	
	if ( $poll->getId() && $poll->getOwnerId() != $currentUser->getId() ) {
		
		header("location:" . $_BASE_URL . "403.php");
		
	}


?>

<?php include_once( $_BASE_DIR . 'templates/header.php' ); ?>

<?php if ( !$id ) echo '<h2>What do you want to ask this time?</h2	>'; ?>

<form enctype="multipart/form-data" class="edit_poll-form" action="<?php echo $_BASE_URL ?>actions/save_poll.php" method="post">

	<div class="volare_row">
		
		<div class="volare_col span_2_of_3">
			
			<div class="volare_row">
				
				<div class="volare_col span_1_of_1">
					
                    <input type="hidden" name="id" value="<?php echo $poll->getId(); ?>">
                    
					<label>Title</label>
					<input type="text" name="title" value="<?php echo $poll->getTitle(); ?>" <?php if ( $poll->getStartDate() < time() && $id ) echo 'readonly="readonly"'; ?> >
					
				</div>
				
			</div>
			
			<div class="volare_row">
				
				<div class="volare_col span_1_of_2 poll_options">
					
					<label>Options</label>
					<?php

                        if ( $id ) {
                            
                            foreach ( $poll->getOptions() as $option ) {
                            
                                echo '<input type="text" name="options[]" placeholder="Option ' . $option['order'] . '" value="' . $option['title'] . '"';
                                if ( $poll->getStartDate() < time() ) echo ' readonly="readonly" ';
                                echo '>';
                            
                            } 
                            
                        } else {
                            
                            echo '<input type="text" name="options[]" placeholder="Option 1" value="">';
                            echo '<input type="text" name="options[]" placeholder="Option 2" value="">';
                            
                        }

                    ?>
					<a title="Add option" class="add_option <?php if ( sizeof($poll->getOptions()) >= 5 ) echo 'disabled' ?>" href="#" <?php if ( $poll->getStartDate() < time() && $id ) echo 'style="display:none;"'; ?> >&#xf067;</a>
                    <a title="Remove option" class="remove_option <?php if ( sizeof($poll->getOptions()) <= 2 ) echo 'disabled' ?>" href="#" <?php if ( $poll->getStartDate() < time() && $id ) echo 'style="display:none;"'; ?> >&#xf068;</a>
					
				</div>
				
				<div class="volare_col span_1_of_2">
				
					<div class="privacy">
						<label>Is this poll public?</label>
						<input type="radio" class="yes" name="privacy" value="1" <?php if ( $poll->isPublic() && $id ) echo 'checked'; ?> >
						<input type="radio" class="no" name="privacy" value="0" <?php if ( !($poll->isPublic()) && $id ) echo 'checked'; ?> >
					</div>
                    
					<label>Start date</label>
					<input type="text" name="startDate" placeholder="mm/dd/yyyy hh:mm" value="<?php if ( $id ) echo date('m/d/Y H:i', $poll->getStartDate()); ?>" <?php if ( $poll->getStartDate() < time() && $id ) echo 'readonly="readonly"'; ?> >
					
					<label>End date</label>
					<input type="text" name="endDate" placeholder="mm/dd/yyyy hh:mm" value="<?php if ( $id ) echo date('m/d/Y H:i', $poll->getEndDate()); ?>">
                    
                    <div class="alerts">
						<label>Enable email alerts?</label>
						<input type="radio" class="yes" name="alerts" value="1" <?php if ( $poll->getNotifyOwner() && $id ) echo 'checked'; ?> >
						<input type="radio" class="no" name="alerts" value="0" <?php if ( !($poll->getNotifyOwner()) && $id ) echo 'checked'; ?> >
						<cite>Info: to receive alerts, you should set your email address in your account settings</cite>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="volare_col span_1_of_3 poll_image">
			
			<label>Image</label>
			<div>
				
				<img class="image_preview" src="<?php if ( $poll->getImage() ) echo $_BASE_URL . $poll->getImage(); ?>" alt="" />
                <span class="camera_icon">&#xf030;</span>
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
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