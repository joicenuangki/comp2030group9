DROP DATABASE IF EXISTS webdev_db;
CREATE DATABASE webdev_db;
USE webdev_db;

CREATE TABLE `Employees` (
  `EmployeeID` int AUTO_INCREMENT,
  `Role` ENUM('Production Operator', 'Factory Manager', 'Administrator', 'Auditor') NOT NULL,
  `FName` VARCHAR(25) NOT NULL,
  `LName` VARCHAR(25) NOT NULL,
  `Password` CHAR(60) NOT NULL,
  PRIMARY KEY (`EmployeeID`)
);

CREATE TABLE `Machines` (
  `MachineID` int AUTO_INCREMENT,
  `MachineName` VARCHAR(50) NOT NULL UNIQUE,
  `Description` VARCHAR(500),
  `Decommissioned` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (MachineID)
);

CREATE TABLE `Jobs` (
  `JobID` int AUTO_INCREMENT,
  `MachineID` int DEFAULT NULL,
  `Name` VARCHAR(50) NOT NULL,
  `Desc` VARCHAR(1000),
  `Priority` ENUM('Low','Medium','High') NOT NULL,
  `AssignedDate` DATE NOT NULL DEFAULT (CURRENT_DATE),
  `Completed` TINYINT(1) NOT NULL DEFAULT 0,
  `FactoryManagerID` int NOT NULL,
  PRIMARY KEY (`JobID`),
  FOREIGN KEY (`MachineID`) REFERENCES `Machines`(`MachineID`) ON DELETE SET NULL ON UPDATE SET NULL,
  FOREIGN KEY (`FactoryManagerID`) REFERENCES `Employees`(`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Notes` (
  `NoteID` int AUTO_INCREMENT,
  `JobID` int DEFAULT NULL,
  `Subject` VARCHAR(50) NOT NULL,
  `TimeObserved` DATETIME NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `NoteContence` VARCHAR(1000) NOT NULL,
  `Completed` TINYINT(1) NOT NULL DEFAULT 0,
  `ProductionOperatorID` int NOT NULL,
  PRIMARY KEY (`NoteID`),
  FOREIGN KEY (`JobID`) REFERENCES `Jobs`(`JobID`) ON DELETE SET NULL ON UPDATE SET NULL, 
  FOREIGN KEY (`ProductionOperatorID`) REFERENCES `Employees`(`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Specialization` (
  `ProductionOperatorID` int,
  `Specialization` ENUM('None', 'Machine Loader', 'Robot Overseer', 'CNC Machine Overseer', '3D Printer Overseer', 'Guided Vehicle Overseer', 'Maintenance', 'Assembily Line Overseer', 'Conveyor Overseer') NOT NULL DEFAULT ('None'),
  PRIMARY KEY (`ProductionOperatorID`),
  FOREIGN KEY (`ProductionOperatorID`) REFERENCES `Employees`(`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `Assigned to Jobs` (
  `JobID` int,
  `ProductionOperatorID` int,
  FOREIGN KEY (`JobID`) REFERENCES `Jobs`(`JobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`ProductionOperatorID`) REFERENCES `Employees`(`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT PK_AssignToNote PRIMARY KEY (`JobID`, `ProductionOperatorID`)
);

CREATE TABLE `Assigned to Notes` (
  `NoteID` int,
  `FactoryManagerID` int,
  FOREIGN KEY (`NoteID`) REFERENCES `Notes`(`NoteID`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`FactoryManagerID`) REFERENCES `Employees`(`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT PK_AssignToNote PRIMARY KEY (`NoteID`, `FactoryManagerID`)
);

CREATE TABLE `Factory Logs` (
  `timestamp` TIMESTAMP DEFAULT (CURRENT_TIMESTAMP),
  `machine_name` VARCHAR(50),
  `temperature` FLOAT,
  `pressure` FLOAT,
  `vibration` FLOAT,
  `humidity` FLOAT,
  `power_consumption` FLOAT,
  `operational_status` ENUM('active', 'idle', 'maintenance'),
  `error_code` CHAR(4),
  `production_count` INT,
  `maintenance_log` VARCHAR(50),
  `speed` FLOAT,
  CONSTRAINT PK_FacLogs PRIMARY KEY (timestamp, machine_name),
  FOREIGN KEY (machine_name) REFERENCES Machines(MachineName) ON DELETE CASCADE ON UPDATE CASCADE
);

FLUSH PRIVILEGES;
CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON webdev_db.`Employees` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Machines` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Jobs` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Notes` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Specialization` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Assigned to Jobs` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Assigned to Notes` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Factory Logs` TO dbadmin@localhost;

INSERT INTO Machines (MachineName, Description) VALUES
  ('CNC Machine', 'The Computer Numerical Control Machine is a semi automatic machine that uses sets of programed instructions to operate'), 
  ('3D Printer', 'The 3D Printer is an automatic machine capable of despencing a hot fillament that can harden forming layers that produce 3D products out of plastics such as PLA and ABS'), 
  ('Industrial Robot', 'The robot is an arm shaped machine responsible for lifting, welding and scanning items off the conveyor belt'), 
  ('Automated Guided Vehicle (AGV)', 'A vehicle that is capable of transporting items, particualy boxes across the factory floor typically to and from storage and production lines'), 
  ('Smart Conveyor System', 'A system that controles all aspects of conveyors around the factory, including speed, direction and throughput'), 
  ('IoT Sensor Hub', 'The Internet of Things Sensor Hub detects and connects devices to the local network'), 
  ('Predictive Maintenance System', 'A system that runs tests on other machines to detect when maintenance will be required before a failure occurs'), 
  ('Automated Assembly Line', 'A series of machines that can produce products with minimal to no human input'), 
  ('Quality Control Scanner', 'A scanner that scans all products on the factory line to ensure their quality and that the automated process succeded'), 
  ('Energy Management System', 'A system that monitors, reports and manages the factories energy usage of each machine connected to the power');

INSERT INTO Employees (Role, FName, LName, Password) VALUES
  ('Production Operator', 'John', 'Miller', '$2y$10$C6DYhLb1dtkBr5WacReoBeT3H1EYpR.yVUgB5496XORDUi0.OB2Q6'),
  ('Factory Manager', 'Emily', 'Johnson', '$2y$10$b0lEW1j4FvNDl.R82HTa2.s.I6ygIEhL/wlkbynd8nVmfYJNt644O'),
  ('Auditor', 'James', 'Clark', '$2y$10$SO8FoXDNhazpLZsJnt.w8O0kNwdm8rC6NcAgfcSRtGiODiX8zh5r6'),
  ('Administrator', 'Jessica', 'White', '$2y$10$DY29y/V3xPIMLPpCfsgIXuH882nHsCf6gzJ6GYn4baVN6DkJ1MzG2'),
  ('Production Operator', 'Sarah', 'Turner', '$2y$10$HhjnxbZXw9sMvmV4G0A14OIDIq.Sd.Z9dtgOqg6AvQqZk.Dpy/LKO'),
  ('Production Operator', 'David', 'Smith', '$2y$10$a7iHMoH0LVJHKYtxeyhDyuwZ92Mj6VSbJqagClH3e9LsAP64GePuu'),
  ('Factory Manager', 'Michael', 'Brown', '$2y$10$6rQlj2AODz3nnIDu5nXrBuVg021d819WrHvQVQB3rPI6zRQOF1k9C'),
  ('Factory Manager', 'Laura', 'Davis', '$2y$10$Dmp1/eWT5NG96ulqkOtrmuO65mVX/D7ow30xJ0XfLWPcmALJpfuki'),
  ('Auditor', 'James', 'Clark', '$2y$10$rKHTZMiteq83VRWwUYwKxOn5RNqXwNj5IQ9tUZ38Gk4BQ0ghksmuG'),
  ('Auditor', 'Robert', 'Walker', '$2y$10$gFFDtnPACZ4qzTq/a.umzO7XE4W2jQGuw4QSMdLFwuhf0eCgfpBei'),
  ('Administrator', 'Daniel', 'Harris', '$2y$10$KKG92AogN.79rKCOS0nwGeTWRCRJElcu0hy8rbEbi9HTCNULaRzcy'),
  ('Administrator', 'Sophia', 'Martin', '$2y$10$Sxn.zmuFxTyL8Fz5yI4dHeaEFDfU0bsTgeJuBTMjU5Ib5XWwqiv42');

INSERT INTO `Specialization` (ProductionOperatorID, Specialization) VALUES
 (1, 'Machine Loader'),
 (5, 'None'),
 (6, 'CNC Machine Overseer');