DROP DATABASE IF EXISTS webdev_db;
CREATE DATABASE webdev_db;
USE webdev_db;

CREATE TABLE `Employees` (
  `EmployeeID` int AUTO_INCREMENT,
  `Role` ENUM('Production Operator', 'Factory Manager', 'Administrator', 'Auditor') NOT NULL,
  `FName` VARCHAR(25) NOT NULL,
  `LName` VARCHAR(25) NOT NULL,
  `Password` CHAR(30) NOT NULL,
  PRIMARY KEY (`EmployeeID`)
);

CREATE TABLE `Machines` (
  `MachineID` int AUTO_INCREMENT,
  `MachineName` VARCHAR(50) NOT NULL UNIQUE,
  PRIMARY KEY (MachineID)
);

CREATE TABLE `Jobs` (
  `JobID` int AUTO_INCREMENT,
  `MachineID` int,
  `Name` VARCHAR(50) NOT NULL,
  `Desc` VARCHAR(1000),
  `Priority` ENUM('Low','Medium','High') NOT NULL,
  `AssignedDate` DATE NOT NULL DEFAULT (CURRENT_DATE),
  `Completed` TINYINT(1) NOT NULL DEFAULT 0,
  `FactoryManagerID` int NOT NULL,
  PRIMARY KEY (`JobID`),
  FOREIGN KEY (`MachineID`) REFERENCES `Machines`(`MachineID`),
  FOREIGN KEY (`FactoryManagerID`) REFERENCES `Employees`(`EmployeeID`)
);

CREATE TABLE `Notes` (
  `NoteID` int AUTO_INCREMENT,
  `JobID` int,
  `Subject` VARCHAR(50) NOT NULL,
  `TimeObserved` DATETIME NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `NoteContence` VARCHAR(1000) NOT NULL,
  `Completed` TINYINT(1) NOT NULL DEFAULT 0,
  `ProductionOperatorID` int NOT NULL,
  PRIMARY KEY (`NoteID`),
  FOREIGN KEY (`JobID`) REFERENCES `Jobs`(`JobID`), 
  FOREIGN KEY (`ProductionOperatorID`) REFERENCES `Employees`(`EmployeeID`)
);

CREATE TABLE `Specialization` (
  `ProductionOperatorID` int,
  `Specialization` ENUM('None', 'Machine Loader', 'Robot Overseer', 'CNC Machine Overseer', '3D Printer Overseer', 'Guided Vehicle Overseer', 'Maintenance', 'Assembily Line Overseer', 'Conveyor Overseer') NOT NULL DEFAULT ('None'),
  PRIMARY KEY (`ProductionOperatorID`),
  FOREIGN KEY (`ProductionOperatorID`) REFERENCES `Employees`(`EmployeeID`)
);

CREATE TABLE `Assigned to Jobs` (
  `JobID` int,
  `ProductionOperatorID` int,
  FOREIGN KEY (`JobID`) REFERENCES `Jobs`(`JobID`),
  FOREIGN KEY (`ProductionOperatorID`) REFERENCES `Employees`(`EmployeeID`),
  CONSTRAINT PK_AssignToNote PRIMARY KEY (`JobID`, `ProductionOperatorID`)
);

CREATE TABLE `Assigned to Notes` (
  `NoteID` int,
  `FactoryManagerID` int,
  FOREIGN KEY (`NoteID`) REFERENCES `Notes`(`NoteID`),
  FOREIGN KEY (`FactoryManagerID`) REFERENCES `Employees`(`EmployeeID`),
  CONSTRAINT PK_AssignToNote PRIMARY KEY (`NoteID`, `FactoryManagerID`)
);

CREATE TABLE `Factory Logs` (
  `timestamp` DATETIME DEFAULT (CURRENT_TIMESTAMP),
  `machine_name` VARCHAR(40),
  `temperature` FLOAT,
  `pressure` FLOAT,
  `vibration` FLOAT,
  `humidity` FLOAT,
  `power_consumption` FLOAT,
  `operation_status` TINYINT(1),
  `error_code` CHAR(4),
  `production_count` INT,
  `maintenance_log` VARCHAR(50),
  `speed` FLOAT,
  CONSTRAINT PK_FacLogs PRIMARY KEY (timestamp, machine_name),
  FOREIGN KEY (machine_name) REFERENCES Machines(MachineName)
);

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON webdev_db.`Employees` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Machines` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Jobs` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Notes` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Specialization` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Assigned to Jobs` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Assigned to Notes` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Factory Logs` TO dbadmin@localhost;

INSERT INTO Machines (MachineName) VALUES
  ('CNC Machine'), ('3D Printer'), ('Industrial Robot'), ('Automated Guided Vehicle (AGV)'), ('Smart Conveyor System'), ('IoT Sensor Hub'), ('Predictive Maintenance System'), ('Automated Assembly Line'), ('Quality Control Scanner'), ('Energy Management System');

INSERT INTO Employees (Role, FName, LName, Password) VALUES
  ('Production Operator', 'John', 'Miller', '1234'),
  ('Factory Manager', 'Emily', 'Johnson', '4321'),
  ('Auditor', 'James', 'Clark', 'abc'),
  ('Administrator', 'Jessica', 'White', 'password'),
  ('Production Operator', 'Sarah', 'Turner', 'YV073B5RNPgF'),
  ('Production Operator', 'David', 'Smith', 'mHG20R9ce19J'),
  ('Factory Manager', 'Michael', 'Brown', '52FYu0TGba7R'),
  ('Factory Manager', 'Laura', 'Davis', 'CWMdJcz1593H'),
  ('Auditor', 'James', 'Clark', 'c9TQh5F80Abm'),
  ('Auditor', 'Robert', 'Walker', 'IO7h41g3B44G'),
  ('Administrator', 'Daniel', 'Harris', 'H402Au9jiyKB'),
  ('Administrator', 'Sophia', 'Martin', '%,&WjTN>)k/767%:n=PF{-"rw');

INSERT INTO `Specialization` (ProductionOperatorID, Specialization) VALUES
 (1, 'Machine Loader'),
 (5, 'None'),
 (6, 'CNC Machine Overseer');