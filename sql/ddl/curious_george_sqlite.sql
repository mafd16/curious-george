--
-- Table Questions
--
DROP TABLE IF EXISTS Questions;
CREATE TABLE Questions (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "userId" INTEGER NOT NULL,
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
    "questionId" INTEGER NOT NULL,
    "userId" INTEGER NOT NULL,
    "answer" TEXT NOT NULL,
    "accepted" INTEGER,
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
    "questionId" INTEGER NOT NULL,
    "answerId" INTEGER,
    "userId" INTEGER NOT NULL,
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
    "entries" INTEGER,
    "city" TEXT,
    "country" TEXT,
    "slogan" TEXT,
    "birth" DATETIME
);


--
-- Table Tags
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "tag" TEXT UNIQUE NOT NULL,
    "rank" INTEGER
);
