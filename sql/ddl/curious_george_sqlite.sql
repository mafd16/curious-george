--
-- Table Questions
--
DROP TABLE IF EXISTS Questions;
CREATE TABLE Questions (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userId" INTEGER,
    "title" TEXT NOT NULL,
    "question" TEXT NOT NULL,
    "tag1Id" INTEGER,
    "tag2Id" INTEGER,
    "tag3Id" INTEGER,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME,
    "rank" INTEGER
);


--
-- Table Answers
--
DROP TABLE IF EXISTS Answers;
CREATE TABLE Answers (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "questionId" INTEGER,
    "userId" INTEGER,
    "answer" TEXT NOT NULL,
    "accepted", INTEGER,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME,
    "rank" INTEGER
);


--
-- Table Comments
--
DROP TABLE IF EXISTS Comments;
CREATE TABLE Comments (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "questionId" INTEGER,
    "answerID" INTEGER,
    "userId" INTEGER,
    "comment" TEXT NOT NULL,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME,
    "rank" INTEGER
);


--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "acronym" TEXT NOT NULL,
    "password" TEXT NOT NULL,
    "email" TEXT UNIQUE NOT NULL,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME,
    "active" DATETIME,
    "admin" INTEGER,
    "entries" INTEGER
);


--
-- Table Tags
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "tag" TEXT UNIQUE NOT NULL
);
