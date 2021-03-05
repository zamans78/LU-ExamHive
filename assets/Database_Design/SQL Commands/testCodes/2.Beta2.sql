

CREATE TABLE Teacher (
  Teacher_ID INTEGER NOT NULL PRIMARY KEY,
  Name VARCHAR(100),
  Department VARCHAR(200),
  Email VARCHAR(255),
  Password VARCHAR(255),
  Registration_Datetime TIMESTAMP,
  INDEX (Name),
  INDEX (Department)
  )ENGINE = InnoDB;

CREATE TABLE Question (
  Question_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Teacher_ID INTEGER,
  Course_Code VARCHAR(10),
  Batch INTEGER,
  Section VARCHAR(20),
  Course_Name VARCHAR(120),
  Title VARCHAR(100),
  Question_Description TEXT,

  CONSTRAINT FOREIGN KEY (Teacher_ID)
  REFERENCES Teacher (Teacher_ID)
  ON DELETE CASCADE ON UPDATE CASCADE
  )ENGINE = InnoDB;

CREATE TABLE Posted_Question (
  Question_ID INTEGER NOT NULL PRIMARY KEY,
  Post_Datetime TIMESTAMP,

  CONSTRAINT FOREIGN KEY (Question_ID)
  REFERENCES Question (Question_ID)
  ON DELETE CASCADE ON UPDATE CASCADE
  )ENGINE = InnoDB;

CREATE TABLE Student (
  Student_ID INTEGER NOT NULL PRIMARY KEY,
  FirstName VARCHAR(50),
  LastName VARCHAR(50),
  Section CHAR(1),
  Batch INTEGER,
  Email VARCHAR(255),
  Password VARCHAR(255),
  Student_Activation_Code VARCHAR(255),
  Student_Email_Status ENUM('not verified', 'verified'),
  Student_Otp INTEGER,
  Registration_Datetime TIMESTAMP,
  INDEX (FirstName),
  INDEX (LastName),
  INDEX (Section),
  INDEX (Batch)
  )ENGINE = InnoDB;

CREATE TABLE Student_Answer (
  Student_ID INTEGER,
  Question_ID INTEGER,
  Submission_Datetime TIMESTAMP,
  Answer_Description TEXT,

  CONSTRAINT FOREIGN KEY (Student_ID)
  REFERENCES Student (Student_ID)
  ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT FOREIGN KEY (Question_ID)
  REFERENCES Posted_Question (Question_ID)
  ON DELETE NO ACTION ON UPDATE NO ACTION
  )ENGINE = InnoDB;

