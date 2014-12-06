--
-- Create Tables
-- ============================================================


CREATE TABLE "users" (

	"id"				INTEGER PRIMARY KEY AUTOINCREMENT,
	"username"			TEXT,
	"password"			TEXT,
	"email"				TEXT,
	"gender"			INTEGER,
	"image"				TEXT,
	"birthDate"			INTEGER,
	"registrationDate"	INTEGER,
	"lastLogin"			INTEGER
	
);


CREATE TABLE "polls" (

	"id"			INTEGER PRIMARY KEY AUTOINCREMENT,
	"title"			TEXT,
	"ownerId"		INTEGER REFERENCES "users" ("id"),
	"image"			TEXT,
	"isPublic"		INTEGER,
	"isActive"		INTEGER,
	"notifyOwner"	INTEGER,
	"creationDate"	INTEGER,
	"startDate"		INTEGER,
	"endDate"		INTEGER
	
);


CREATE TABLE "pollOptions" (

	"id"		INTEGER PRIMARY KEY AUTOINCREMENT,
	"title"		TEXT,
	"order"		INTEGER,
	"pollId"	INTEGER REFERENCES "polls" ("id")

);


CREATE TABLE "answers" (

	"userId"	INTEGER REFERENCES "users" ("id"),
	"pollId"	INTEGER REFERENCES "polls" ("id"),
	"optionId"	INTEGER REFERENCES "pollOptions" ("id"),
	
	PRIMARY KEY ("userId","pollId")
	
);

