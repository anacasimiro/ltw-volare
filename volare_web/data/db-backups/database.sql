--
-- Create Tables
-- ============================================================


CREATE TABLE "users" (

	"id" INTEGER PRIMARY KEY AUTOINCREMENT,
	"username" TEXT,
	"password" TEXT,
	"email" TEXT,
	"gender" INTEGER,
	"image" TEXT,
	"birthDate" INTEGER,
	"registrationDate" INTEGER,
	"lastLogin" INTEGER
	
);


CREATE TABLE "polls" (

	"id" INTEGER PRIMARY KEY AUTOINCREMENT,
	"title" TEXT,
	"ownerId" INTEGER REFERENCES "users" ("id"),
	"image" TEXT,
	"isPublic" INTEGER,
	"isActive" INTEGER,
	"notifyOwner" INTEGER,
	"creationDate" INTEGER,
	"startDate" INTEGER,
	"endDate" INTEGER

);


CREATE TABLE "pollOptions" (

	"id" INTEGER PRIMARY KEY AUTOINCREMENT,
	"title" TEXT,
	"order" INTEGER,
	"pollId" INTEGER REFERENCES "polls" ("id")
	
);


CREATE TABLE "answers" (

	"userId" INTEGER REFERENCES "users" ("id"),
	"optionId" INTEGER REFERENCES "pollOptions" ("id"),
	PRIMARY KEY ("userId","optionId")
	
);


--
-- Insert Users
-- ============================================================


INSERT INTO "users" (

	"id",
	"username",
	"password",
	"email",
	"gender",
	"image",
	"birthDate",
	"registrationDate",
	"lastLogin"

) VALUES (

	NULL,
	"anacasimiro",
	"anacasimiro",
	"anacasimiro1995@gmail.com",
	1,
	NULL,
	799632000,
	1416249348,
	1416249375
	
);


INSERT INTO "users" (

	"id",
	"username",
	"password",
	"email",
	"gender",
	"image",
	"birthDate",
	"registrationDate",
	"lastLogin"

) VALUES (

	NULL,
	"joaomnb",
	"joaomnb",
	"joao.mnb@gmail.com",
	0,
	NULL,
	792720000,
	1416249425,
	1416249435
	
);


--
-- Insert Polls
-- ============================================================


INSERT INTO "polls" (

	"id",
	"title",
	"ownerId",
	"image",
	"isPublic",
	"isActive",
	"notifyOwner",
	"creationDate",
	"startDate",
	"endDate"

) VALUES (

	NULL,
	"O que gostas mais?",
	"1",
	NULL,
	1,
	1,
	1,
	1416249845,
	1416249845,
	1417392000 
	
);


--
-- Insert Poll Options
-- ============================================================


INSERT INTO "pollOptions" (

	"id",
	"title",
	"order",
	"pollId"

) VALUES (

	NULL,
	"Bolo de chocolate",
	1,
	1
	
);


INSERT INTO "pollOptions" (

	"id",
	"title",
	"order",
	"pollId"

) VALUES (

	NULL,
	"Natas do céu",
	2,
	1
	
);


--
-- Insert Answers
-- ============================================================


INSERT INTO "answers" (

	"userId",
	"optionId"

) VALUES (

	1,
	1
	
);


INSERT INTO "answers" (

	"userId",
	"optionId"

) VALUES (

	2,
	1
	
);










