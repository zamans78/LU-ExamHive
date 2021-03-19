CREATE DATABASE lu_Exam_Hive;
GRANT ALL ON lu_Exam_Hive.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON lu_Exam_Hive.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';
---------------------------------------------------------------------------------------------
CREATE TABLE Admin(
 Admin_ID INTEGER NOT NULL PRIMARY KEY,
 Admin_Eamil VARCHAR(255),
 Password VARCHAR(255),
 Registration_Datetime TIMESTAMP
)ENGINE = InnoDB;

----------------------------------------------------------------------------------------------
CREATE TABLE Contact_Us (
  ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Email VARCHAR(255),
  Name VARCHAR(255),
  Message TEXT,
  Received_Datetime TIMESTAMP,

  INDEX (Name),
  INDEX (Email)
  )ENGINE = InnoDB;

----------------------------------------------------------------------------------------------

CREATE TABLE Reset_Password (
  ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Email VARCHAR(255),
  Code VARCHAR(255),
  Requested_Datetime TIMESTAMP,

  INDEX (Code),
  INDEX (Email)
  )ENGINE = InnoDB;

----------------------------------------------------------------------------------------------

CREATE TABLE Teacher (
  Teacher_ID INTEGER NOT NULL PRIMARY KEY,
  Name VARCHAR(100),
  Department VARCHAR(200),
  Teacher_Email VARCHAR(255),
  Password VARCHAR(255),
  Registration_Datetime TIMESTAMP,
  INDEX (Name),
  INDEX (Department)
  )ENGINE = InnoDB;

----------------------------------------------------------------------------------------------

CREATE TABLE Question_Description (
  Question_Description_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Teacher_ID INTEGER,
  Course_Code VARCHAR(10),
  Batch INTEGER,
  Section VARCHAR(20),
  Course_Name VARCHAR(120),
  Title VARCHAR(100),
  Meeting_Link TEXT,
  Action VARCHAR(10),
  Content LONGTEXT,

  CONSTRAINT FOREIGN KEY (Teacher_ID)
  REFERENCES Teacher (Teacher_ID)
  ON DELETE CASCADE ON UPDATE CASCADE
  )ENGINE = InnoDB;

----------------------------------------------------------------------------------------------

CREATE TABLE Student (
  Profile_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Student_ID INTEGER(11),
  FirstName VARCHAR(50),
  LastName VARCHAR(50),
  Section CHAR(1),
  Batch INTEGER,
  Student_Email VARCHAR(255),
  Password VARCHAR(255),
  Student_Activation_Code VARCHAR(255),
  Student_Email_Status ENUM('not verified', 'verified'),
  Student_Otp INTEGER,
  Registration_Datetime TIMESTAMP,
  INDEX (Student_ID),
  INDEX (FirstName),
  INDEX (LastName),
  INDEX (Section),
  INDEX (Batch)
  )ENGINE = InnoDB;

----------------------------------------------------------------------------------------------

CREATE TABLE Student_Answer (
  Answer_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Question_Description_ID INTEGER,
  Answer MEDIUMTEXT,
  Student_ID INTEGER(11),
  Full_Name VARCHAR(100),
  Section CHAR(1),
  Batch INTEGER,
  Submission_Datetime TIMESTAMP,
  Score INT NULL,

  CONSTRAINT FOREIGN KEY (Question_Description_ID)
  REFERENCES Question_Description (Question_Description_ID)
  ON DELETE NO ACTION ON UPDATE NO ACTION
  )ENGINE = InnoDB;