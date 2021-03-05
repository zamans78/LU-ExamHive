CREATE TABLE Teacher (
  Teacher_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  FirstName VARCHAR(50),
  LastName VARCHAR(50),
  Department VARCHAR(200),
  email VARCHAR(255),
  Password VARCHAR(255),
  Registration_datetime TIMESTAMP,

  INDEX (FirstName),
  INDEX (LastName),
  INDEX (Department)
) ENGINE = InnoDB;


CREATE TABLE Question (
  Question_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Teacher_ID INTEGER,
  Course_code VARCHAR(10),
  Course_name VARCHAR(120),
  Title VARCHAR(100),
  Batch INTEGER,
  Section VARCHAR(40),
  Question_Description TEXT,

  INDEX (Course_code),
  INDEX (Course_name),
  INDEX (Title),
  CONSTRAINT FOREIGN KEY (Teacher_ID)
  REFERENCES Teacher (Teacher_ID)
  ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;


CREATE TABLE Posted_Question (
  Posted_Question_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Teacher_ID INTEGER,
  Question_ID INTEGER,
  Post_datetime TIMESTAMP,
  CONSTRAINT FOREIGN KEY (Teacher_ID)
  REFERENCES Teacher (Teacher_ID)
  ON DELETE CASCADE ON UPDATE CASCADE,
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
  password VARCHAR(250),
  Student_Activation_Code VARCHAR(250),
  Student_Email_Status enum('not verified', 'verified'),
  Student_Otp INTEGER,
  Registration_datetime TIMESTAMP,

  INDEX (FirstName),
  INDEX (LastName),
  INDEX (Section),
  INDEX (Batch)
) ENGINE = InnoDB;


CREATE TABLE Student_Answer (
  Student_ID INTEGER NOT NULL PRIMARY KEY,
  Posted_Question_ID INTEGER,
  Section CHAR(1),
  Batch INTEGER,
  Answer_Description TEXT,

  INDEX (Section),
  INDEX (Batch),
  CONSTRAINT FOREIGN KEY (Student_ID)
  REFERENCES Student (Student_ID)
  ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (Posted_Question_ID)
  REFERENCES Posted_Question (Posted_Question_ID)
  ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;


CREATE TABLE Student_Submission (
  Student_Submission_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Student_ID INTEGER,
  Student_Submission_datetime TIMESTAMP,
  CONSTRAINT FOREIGN KEY (Student_ID)
  REFERENCES Student_Answer (Student_ID)
  ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;


CREATE TABLE Answer_Check (
  Student_Submission_ID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CONSTRAINT FOREIGN KEY (Student_Submission_ID)
  REFERENCES Student_Submission (Student_Submission_ID)
  ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE = InnoDB;

