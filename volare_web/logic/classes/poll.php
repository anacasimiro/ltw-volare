<?php

	class Poll {

		private $id;
		private $title;
		private $ownerID;
		private $image;
		private $isPublic;
		private $isActive;
		private $notifyOwner;
		private $creationDate;
		private $startDate;
		private $endDate;
		private $options;
		private $answers;


		// Constructor

		public function __construct( $pollData ) {

			$this->id            = isset( $pollData['id'] 				) ? $pollData['id'] 		  : 0;
			$this->title         = isset( $pollData['title'] 			) ? $pollData['title'] 		  : '';
			$this->ownerId       = isset( $pollData['ownerId'] 			) ? $pollData['ownerId'] 	  : 0;
			$this->image         = isset( $pollData['image'] 			) ? $pollData['image'] 		  : '';
			$this->isPublic      = isset( $pollData['isPublic'] 		) ? $pollData['isPublic'] 	  : 0;
			$this->isActive      = isset( $pollData['isActive'] 		) ? $pollData['isActive'] 	  : 0;
			$this->notifyOwner   = isset( $pollData['notifyOwner'] 		) ? $pollData['notifyOwner']  : 0;
			$this->creationDate  = isset( $pollData['creationDate']		) ? $pollData['creationDate'] : 0;
			$this->startDate     = isset( $pollData['startDate']		) ? $pollData['startDate'] 	  : 0;
			$this->endDate       = isset( $pollData['endDate'] 			) ? $pollData['endDate'] 	  : 0;
			$this->options       = isset( $pollData['options'] 			) ? $pollData['options'] 	  : array();
			$this->answers       = isset( $pollData['answers'] 			) ? $pollData['answers'] 	  : array();

		}
		
		
		// Getters
		
		public function getId()				{ return $this->id;				}
		public function getTitle()			{ return $this->title;			}
		public function getOwnerId()		{ return $this->ownerId;		}
		public function getImage()			{ return $this->image;			}
		public function isPublic()			{ return $this->isPublic;		}
		public function isActive()			{ return $this->isActive;		}
		public function getNotifyOwner()	{ return $this->notifyOwner;	}
		public function getCreationDate()	{ return $this->creationDate;	}
		public function getStartDate()		{ return $this->startDate;		}
		public function getEndDate()		{ return $this->endDate;		}
		public function getOptions()		{ return $this->options;		}
		public function getAnswers()		{ return $this->options;		}
		
		
		// Setters
		
		public function setId(			 $id			) { $this->id			= $id;				}
		public function setTitle(		 $title			) { $this->title		= $title;			}
		public function setOwnerId(		 $ownerId		) { $this->ownerId		= $ownerId;			}
		public function setImage(		 $image			) { $this->image		= $image;			}
		public function setPublic(		 $isPublic		) { $this->isPublic		= $isPublic;		}
		public function setActive(		 $isActive		) { $this->isActive		= $isActive;		}
		public function setNotifyOwner(  $notifyOwner	) { $this->notifyOwner	= $notifyOwner;		}
		public function setCreationDate( $creationDate	) { $this->creationDate	= $creationDate;	}
		public function setStartDate(	 $startDate		) { $this->startDate	= $startDate;		}
		public function setEndDate(		 $endDate		) { $this->endDate		= $endDate;			}
		public function setOptions(		 $options 		) { $this->options		= $options;			}
		public function setAnswers(		 $answers 		) { $this->answers		= $answers;			}
		
		
		// Static methods

		public static function getAll() {

			
			// Database connection
			
			global $dbh;
			
			
			// Get Polls data from database
			
			$stmt = $dbh->prepare('SELECT * FROM polls');
			$stmt->execute();
			$pollsData = $stmt->fetchAll();
			
			
			// Create instances of class Poll
			
			foreach( $pollsData as $pollData ) {
				$polls[] = new Poll( $pollData );
			}
			
			
			// Get Polls options from database
			
			foreach ( $polls as $poll ) {
				
				$stmt = $dbh->prepare('SELECT * FROM pollOptions WHERE pollId = ?');
				$stmt->execute( array( $poll->getId() ) );
				$poll->setOptions( $stmt->fetchAll() );
				
			}


			return $polls;

		}

		public static function withId( $id ) {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Get Poll from database
			
			$stmt = $dbh->prepare('SELECT * FROM polls WHERE id = ?');
			$stmt->execute(array($id));
			$pollData = $stmt->fetch();
			
			
			// Get Poll options from database
			
			$stmt = $dbh->prepare('SELECT * FROM pollOptions WHERE pollId = ?');
			$stmt->execute(array($id));
			$pollData['options'] = $stmt->fetchAll();
			
			
			// Create new instance of class Poll
			
			$poll = new Poll( $pollData );
			
			
			return $poll;

		}


		// Basic operations

		public function removePoll() {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Remove Poll from database
			
			$stmt = $dbh->prepare('DELETE FROM polls WHERE id = ?');
			$stmt->execute(array( $this->id ));
			
			
			// Remove Poll options from database
			
			$stmt = $dbh->prepare('DELETE FROM pollOptions WHERE pollId = ?');
			$stmt->execute(array( $this->id ));

		}

		public function savePoll() {
			
			
			// Existing Poll
			
			if ( $this->id > 0 ) {
				$this->updatePoll();
			}
			
			
			// New Poll
			
			else {
				$this->insertPoll();
			}
			
		}

		private function insertPoll() {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Insert Poll into database
			
			$stmt = $dbh->prepare('
			
				INSERT INTO polls (
									
					"title",
					"ownerId",
					"image",
					"isPublic",
					"isActive",
					"notifyOwner",
					"creationDate",
					"startDate",
					"endDate"
									
				) VALUES ("?", ?, "?", ?, ?, ?, ?, ?, ?)
			
			');
			
			$stmt->execute(array(
				
				$this->title,
				$this->ownerId,
				$this->image,
				$this->isPublic,
				$this->isActive,
				$this->notifyOwner,
				$this->creationDate,
				$this->startDate,
				$this->endDate
				
			));
			
			
			// Insert Poll options into database
			
			foreach( $this->options as $option ) {
				
				insertOption( $option );

			}
				
		}

		private function updatePoll() {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Update Poll in database
			
			$stmt = $dbh->prepare('
			
				UPDATE polls SET
				
					"title" = "?",
					"ownerId" = ?,
					"image" = "?",
					"isPublic" = ?,
					"isActive" = ?,
					"notifyOwner" = ?,
					"creationDate" = ?,
					"startDate" = ?,
					"endDate" = ?
					
				WHERE id = ?
			
			');
			
			$stmt->execute(array(
				
				$this->title,
				$this->ownerId,
				$this->image,
				$this->isPublic,
				$this->isActive,
				$this->notifyOwner,
				$this->creationDate,
				$this->startDate,
				$this->endDate,
				$this->id
				
			));
			
			
			// Update/insert Poll options into database
			
			foreach( $this->options as $option ) {
				
				if ( $option['id'] > 0 ) {
					updateOption( $option );
				} else {
					insertOption( $option );
				}
				
			}
			
			
			// Update/insert Poll answers into database
			
			foreach( $this->answers as $answer ) {
				
				$stmt = $dbh->prepare('
				
					INSERT OR REPLACE INTO answers (
						
						"userId",
						"pollId",
						"optionId"
						
					) VALUES (?, ?, ?)
					
				');
				
				$stmt->execute(array(
					
					$answer['userId'],
					$answer['pollId'],
					$answer['optionId']
					
				));
				
			}
			
		}
		
		private function insertOption( $option ) {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Insert Poll option into database
			
			$stmt = $dbh->prepare('
			
				INSERT INTO pollOptions (
					
					"title",
					"order",
					"pollId"
					
				) VALUES (?, ?, ?)
			
			');
			
			$stmt->execute(array(
				
				$option['title'],
				$option['order'],
				$option['pollId']
				
			));
			
		}
		
		private function updateOption( $option ) {
			
			// Database connection
			
			global $dbh;
			
			
			// Update Poll option in database
			
			$stmt = $dbh->prepare('
			
				UPDATE pollOptions SET
					
					"title" = "?",
					"order" = ?,
					"pollId" = ?
					
				WHERE id = ?
			
			');
			
			$stmt->execute(array(
				
				$option['title'],
				$option['order'],
				$option['pollId'],
				$option['id']
				
			));
			
		}
		
		private function insertAnswer( $answer ) {
			
			// Database connection
			
			global $dbh;
			
			
			// Insert Answer into database
			
			$stmt = $dbh->prepare('
			
				INSERT INTO answers (

					"userId",
					"pollId",
					"optionId"
					
				) VALUES (?, ?, ?)
			
			');
			
			$stmt->execute(array(
				
				$answer['userId'],
				$answer['pollId'],
				$answer['optionId']
				
			));
			
		}
		
		private function updateAnswer( $answer ) {
			
			// Database connection
			
			global $dbh;
			
			
			// Update Answer in database
			
			$stmt = $dbh->prepare('
			
				UPDATE answers SET

					"userId" = ?,
					"pollId" = ?,
					"optionId = ?"
					
				WHERE userId = ? AND optionId = ?
			
			');
			
			$stmt->execute(array(
				
				$answer['userId'],
				$answer['pollId'],
				$answer['optionId'],
				$answer['userId'],
				$answer['optionId']
				
				
			));
			
		}

	}

?>