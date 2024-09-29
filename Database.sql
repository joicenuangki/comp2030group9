DROP DATABASE IF EXISTS webdev_db;
CREATE DATABASE webdev_db;
USE webdev_db;

CREATE TABLE `Employees` (
  `EmployeeID` int AUTO_INCREMENT,
  `Role` ENUM('Production Operator', 'Factory Manager', 'Administrator', 'Auditor'),
  `FName` VARCHAR(15),
  `LName` VARCHAR(15),
  PRIMARY KEY (`EmployeeID`)
);

CREATE TABLE `Machines` (
  `MachineID` int AUTO_INCREMENT,
  `MachineName` VARCHAR(40) UNIQUE,
  `Temperature` FLOAT,
  `Pressure` FLOAT,
  `Vibration` FLOAT,
  `Humidity` FLOAT,
  `PowerConsumption` FLOAT,
  `OperationStatus` TINYINT(1),
  `ErrorCode` CHAR(4),
  `ProductionCount` INT,
  `MaintenanceLog` VARCHAR(50),
  `Speed` FLOAT,
  PRIMARY KEY (MachineID)
);

CREATE TABLE `Jobs` (
  `JobID` int AUTO_INCREMENT,
  `MachineID` int,
  `Name` VARCHAR(25) NOT NULL,
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
  `Subject` VARCHAR(25) NOT NULL,
  `TimeObserved` DATETIME NOT NULL DEFAULT (CURRENT_TIMESTAMP),
  `NoteContence` VARCHAR(1000) NOT NULL,
  `Completed` TINYINT(1) NOT NULL DEFAULT 0,
  `ProductionOperatorID` int NOT NULL,
  PRIMARY KEY (`NoteID`),
  FOREIGN KEY (`JobID`) REFERENCES `Jobs`(`JobID`), 
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
GRANT all privileges ON webdev_db.`Assigned to Jobs` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Assigned to Notes` TO dbadmin@localhost;
GRANT all privileges ON webdev_db.`Factory Logs` TO dbadmin@localhost;