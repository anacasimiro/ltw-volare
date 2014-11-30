<?php
	
	class User {
		
		private $id;
		private $username;
		private $password;
		private $email;
		private $gender;
		private $image;
		private $birthDate;
		private $registrationDate;
		private $lastLogin;
		
		
		// Constructor
		
		public function __construct( $userData ) {
			
			$this->id                = isset( $userData['id']				) ? $userData['id']					: NULL;
			$this->username          = isset( $userData['username']			) ? $userData['username']			: NULL;
			$this->password          = isset( $userData['password']			) ? $userData['password']			: NULL;
			$this->email             = isset( $userData['email']			) ? $userData['email']				: NULL;
			$this->gender            = isset( $userData['gender']			) ? $userData['gender']				: NULL;
			$this->image             = isset( $userData['image']			) ? $userData['image']				: NULL;
			$this->birthDate         = isset( $userData['birthDate']		) ? $userData['birthDate']			: NULL;
			$this->registrationDate  = isset( $userData['registrationDate']	) ? $userData['registrationDate']	: NULL;
			$this->lastLogin         = isset( $userData['lastLogin']		) ? $userData['lastLogin']			: NULL;
			
		}
		
		
		// Getters
		
		public function getId()					{ return $this->id;				}
		public function getUsername()			{ return $this->username;			}
		public function getPassword()			{ return $this->password;			}
		public function getEmail()				{ return $this->email;			}
		public function getGender()				{ return $this->gender;			}
		public function getImage()				{ return $this->image;			}
		public function getBirthDate()			{ return $this->birthDate;		}
		public function getRegistrationDate()	{ return $this->registrationDate;	}
		public function getLastLogin()			{ return $this->lastLogin;		}
		
		
		// Setters
		
		public function setId( $id )								{ $this->id					= $id;					}
		public function setUsername( $username )					{ $this->username			= $username;			}
		public function setPassword( $password )					{ $this->password			= $password;			}
		public function setEmail( $email )							{ $this->email				= $email;				}
		public function setGender( $gender )						{ $this->gender				= $gender;				}
		public function setImage( $image )							{ $this->image				= $image;				}
		public function setBirthDate( $birthDate )					{ $this->birthDate			= $birthDate;			}
		public function setRegistrationDate( $registrationDate )	{ $this->registrationDate	= $registrationDate;	}
		public function setLastLogin( $lastLogin )					{ $this->lastLogin			= $lastLogin;			}
		
		
		// Static methods
		
		public static function getAll() {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Get Users data from database
			
			$stmt = $dbh->prepare('SELECT * FROM users');
			$stmt->execute();
			$usersData = $stmt->fetchAll();
			
			
			// Create instances of class User
			
			foreach( $usersData as $userData ) {
				$users[] = new User( $userData );
			}


			return $users;
			
		}
		
		public static function withUsername( $username ) {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Get User from database
			
			$stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
			$stmt->execute(array( $username ));
			$userData = $stmt->fetch();
						
			
			// Create new instance of class User
			
			$user = new User( $userData );
			
			
			return $user;
			
		}
		
		
		// Basic operations
		
		public function removeUser() {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Remove User from database
			
			$stmt = $dbh->prepare('DELETE FROM polls WHERE id = ?');
			$stmt->execute(array( $this->id ));

			
		}
		
		public function saveUser() {
			
			
			// Existing User
			
			if ( $this->id > 0 ) {
				$this->updateUser();
			}
			
			
			// New User
			
			else {
				$this->insertUser();
			}
			
		}
		
		private function insertUser() {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Insert User into database
			
			$stmt = $dbh->prepare('
			
				INSERT INTO users (
									
					"username",
					"password",
					"email",
					"gender",
					"image",
					"birthDate",
					"registrationDate",
					"lastLogin"
									
				) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
			
			');
			
			$stmt->execute(array(
				
				$this->username,
				$this->password,
				$this->email,
				$this->gender,
				$this->image,
				$this->birthDate,
				$this->registrationDate,
				$this->lastLogin
				
			));
			
		}
		
		private function updateUser() {
			
			
			// Database connection
			
			global $dbh;
			
			
			// Update User in database
			
			$stmt = $dbh->prepare('
			
				UPDATE users SET
				
					"username" = ?,
					"password" = ?,
					"email" = ?,
					"gender" = ?,
					"image" = ?,
					"birthDate" = ?,
					"registrationDate" = ?,
					"lastLogin" = ?
					
				WHERE id = ?
			
			');
			
			$stmt->execute(array(
				
				$this->username,
				$this->password,
				$this->email,
				$this->gender,
				$this->image,
				$this->birthDate,
				$this->registrationDate,
				$this->lastLogin,
				$this->id
				
			));
			
		}
		
		
	}	
	
?>