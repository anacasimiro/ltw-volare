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

		public function __construct($pollData) {

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
			$this->options       = isset( $pollData['options'] 			) ? $pollData['options'] 	  : 0;

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
		
		
		// Setters
		
		public function setId( $id )						{ $this->id				= $id;				}
		public function setTitle( $title )					{ $this->title			= $title;			}
		public function setOwnerId( $ownedId )				{ $this->ownerId		= $ownerId;			}
		public function setImage( $image )					{ $this->image			= $image;			}
		public function setPublic( $isPublic )				{ $this->isPublic		= $isPublic;		}
		public function setActive( $isActive )				{ $this->isActive		= $isActive;		}
		public function setNotifyOwner( $notifyOwner )		{ $this->notifyOwner	= $notifyOwner;		}
		public function setCreationDate( $creationDate )	{ $this->creationDate	= $creationDate;	}
		public function setStartDate( $startDate )			{ $this->startDate		= $startDate;		}
		public function setEndDate( $endDate )				{ $this->endDate		= $endDate;			}
		public function setOptions( $options )				{ $this->options		= $options;			}
		
		

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

		public function remove() {
			// sql

		}

		public function save() {
			if ( $this->id > 0 ) {
				$this->update();
			}
			else {
				$this->insert();
			}
		}

		private function insert() {
			// SQL
		}

		private function update() {
			// SQL
		}
		

	}

?>