-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: volunteermanagementsystem
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `AdminId` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `PASSWORD_HASH` varchar(100) NOT NULL,
  `LAST_LOGIN` date DEFAULT NULL,
  `ACCOUNT_CREATION_DATE` date DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  PRIMARY KEY (`AdminId`),
  UNIQUE KEY `Email` (`Email`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (4,'Jane','Smith','janesmith@example.com','01283103800','2002-02-02','janesmith@example.com','$2y$10$W5qgNO9kcEGtCFvAEAVlRuZtk1MA.wQO7vsEGQL0W37YX2FDmXJD.','2024-12-29','2024-12-29',118),(5,'Buzz','Fuzz','Buzz@examaple.com','01283103800','2002-08-02','Buzz@examaple.com','$2y$10$FQgGLJC.r0dUKmPXZxwCIuEO/A5FYUc2e/s8Z9BQjjbYvROlAlZrS','2024-12-29','2024-12-29',119),(27,'Admin','Example','20p6022@eng.asu.edu.eg','+201283103800','2002-02-02','20p6022@eng.asu.edu.eg','$2y$10$zrkldlfE8yqu2xCMWkD/ZObtqq.500OcQglXqkCsPDUSJjQQ2lkW.','2025-01-15','2025-01-15',159);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_notificationtype`
--

DROP TABLE IF EXISTS `admin_notificationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_notificationtype` (
  `AdminID` int NOT NULL,
  `NotificationTypeID` int NOT NULL,
  PRIMARY KEY (`AdminID`,`NotificationTypeID`),
  KEY `admin_notificationtype_ibfk_2` (`NotificationTypeID`),
  CONSTRAINT `admin_notificationtype_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminId`),
  CONSTRAINT `admin_notificationtype_ibfk_2` FOREIGN KEY (`NotificationTypeID`) REFERENCES `notificationtype` (`NotificationTypeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notificationtype`
--

LOCK TABLES `admin_notificationtype` WRITE;
/*!40000 ALTER TABLE `admin_notificationtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_notificationtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_privilege`
--

DROP TABLE IF EXISTS `admin_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_privilege` (
  `AdminID` int NOT NULL AUTO_INCREMENT,
  `Admin_PrivilegeID` int DEFAULT NULL,
  PRIMARY KEY (`AdminID`),
  KEY `admin_privilege_ibfk_2` (`Admin_PrivilegeID`),
  CONSTRAINT `admin_privilege_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminId`),
  CONSTRAINT `admin_privilege_ibfk_2` FOREIGN KEY (`Admin_PrivilegeID`) REFERENCES `privilege` (`PrivilegeID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_privilege`
--

LOCK TABLES `admin_privilege` WRITE;
/*!40000 ALTER TABLE `admin_privilege` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advancedbadgedecorator`
--

DROP TABLE IF EXISTS `advancedbadgedecorator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `advancedbadgedecorator` (
  `decorator_id` int NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`decorator_id`),
  CONSTRAINT `advancedbadgedecorator_ibfk_1` FOREIGN KEY (`decorator_id`) REFERENCES `badgedecorator` (`decorator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advancedbadgedecorator`
--

LOCK TABLES `advancedbadgedecorator` WRITE;
/*!40000 ALTER TABLE `advancedbadgedecorator` DISABLE KEYS */;
/*!40000 ALTER TABLE `advancedbadgedecorator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applicationdetails`
--

DROP TABLE IF EXISTS `applicationdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applicationdetails` (
  `ApplicationDetailsID` int NOT NULL AUTO_INCREMENT,
  `ApplicationDate` date DEFAULT NULL,
  `EventID` int DEFAULT NULL,
  `ApplicationStatusID` int DEFAULT NULL,
  `ApplyForEventID` int DEFAULT NULL,
  PRIMARY KEY (`ApplicationDetailsID`),
  KEY `EventID` (`EventID`),
  KEY `ApplicationStatusID` (`ApplicationStatusID`),
  KEY `ApplyForEventID` (`ApplyForEventID`),
  CONSTRAINT `applicationdetails_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`),
  CONSTRAINT `applicationdetails_ibfk_2` FOREIGN KEY (`ApplicationStatusID`) REFERENCES `applicationstatus` (`ApplicationStatusID`),
  CONSTRAINT `applicationdetails_ibfk_3` FOREIGN KEY (`ApplyForEventID`) REFERENCES `applyforevent` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicationdetails`
--

LOCK TABLES `applicationdetails` WRITE;
/*!40000 ALTER TABLE `applicationdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `applicationdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applicationdetails_organization`
--

DROP TABLE IF EXISTS `applicationdetails_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applicationdetails_organization` (
  `ApplicationID` int NOT NULL,
  `OrganizationID` int NOT NULL,
  PRIMARY KEY (`ApplicationID`,`OrganizationID`),
  KEY `applicationdetails_organization_ibfk_2` (`OrganizationID`),
  CONSTRAINT `applicationdetails_organization_ibfk_1` FOREIGN KEY (`ApplicationID`) REFERENCES `applicationdetails` (`ApplicationDetailsID`) ON DELETE CASCADE,
  CONSTRAINT `applicationdetails_organization_ibfk_2` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicationdetails_organization`
--

LOCK TABLES `applicationdetails_organization` WRITE;
/*!40000 ALTER TABLE `applicationdetails_organization` DISABLE KEYS */;
/*!40000 ALTER TABLE `applicationdetails_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applicationstatus`
--

DROP TABLE IF EXISTS `applicationstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applicationstatus` (
  `ApplicationStatusID` int NOT NULL,
  `ApplicationStatusName` varchar(50) NOT NULL,
  PRIMARY KEY (`ApplicationStatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicationstatus`
--

LOCK TABLES `applicationstatus` WRITE;
/*!40000 ALTER TABLE `applicationstatus` DISABLE KEYS */;
/*!40000 ALTER TABLE `applicationstatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applyforevent`
--

DROP TABLE IF EXISTS `applyforevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applyforevent` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `VolunteerId` int DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `VolunteerId` (`VolunteerId`),
  CONSTRAINT `applyforevent_ibfk_1` FOREIGN KEY (`VolunteerId`) REFERENCES `volunteer` (`VolunteerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applyforevent`
--

LOCK TABLES `applyforevent` WRITE;
/*!40000 ALTER TABLE `applyforevent` DISABLE KEYS */;
/*!40000 ALTER TABLE `applyforevent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badgedecorator`
--

DROP TABLE IF EXISTS `badgedecorator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `badgedecorator` (
  `decorator_id` int NOT NULL AUTO_INCREMENT,
  `badge_id` int NOT NULL,
  PRIMARY KEY (`decorator_id`),
  KEY `badge_id` (`badge_id`),
  CONSTRAINT `badgedecorator_ibfk_1` FOREIGN KEY (`badge_id`) REFERENCES `volunteerbadge` (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badgedecorator`
--

LOCK TABLES `badgedecorator` WRITE;
/*!40000 ALTER TABLE `badgedecorator` DISABLE KEYS */;
/*!40000 ALTER TABLE `badgedecorator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergencycontact`
--

DROP TABLE IF EXISTS `emergencycontact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emergencycontact` (
  `EmergencyContactID` int NOT NULL AUTO_INCREMENT,
  `EmergencyContactName` varchar(50) NOT NULL,
  `EmergencyContactPhone` varchar(50) NOT NULL,
  PRIMARY KEY (`EmergencyContactID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencycontact`
--

LOCK TABLES `emergencycontact` WRITE;
/*!40000 ALTER TABLE `emergencycontact` DISABLE KEYS */;
INSERT INTO `emergencycontact` VALUES (36,'Jane Smith','01283103800'),(37,'John Doe','0128362192'),(38,'Johnnn Doe','0128362192');
/*!40000 ALTER TABLE `emergencycontact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergencycontact_volunteer`
--

DROP TABLE IF EXISTS `emergencycontact_volunteer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emergencycontact_volunteer` (
  `EmergencyContactID` int NOT NULL,
  `VolunteerID` int NOT NULL,
  PRIMARY KEY (`EmergencyContactID`,`VolunteerID`),
  KEY `fk_volunteer` (`VolunteerID`),
  CONSTRAINT `fk_emergency_contact` FOREIGN KEY (`EmergencyContactID`) REFERENCES `emergencycontact` (`EmergencyContactID`) ON DELETE CASCADE,
  CONSTRAINT `fk_volunteer` FOREIGN KEY (`VolunteerID`) REFERENCES `volunteer` (`VolunteerID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencycontact_volunteer`
--

LOCK TABLES `emergencycontact_volunteer` WRITE;
/*!40000 ALTER TABLE `emergencycontact_volunteer` DISABLE KEYS */;
INSERT INTO `emergencycontact_volunteer` VALUES (36,49),(38,49);
/*!40000 ALTER TABLE `emergencycontact_volunteer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `EventID` int NOT NULL AUTO_INCREMENT,
  `EventName` varchar(255) DEFAULT NULL,
  `EventDate` date DEFAULT NULL,
  `EventLocationID` int DEFAULT NULL,
  `EventDescription` text,
  PRIMARY KEY (`EventID`),
  KEY `EventLocationID` (`EventLocationID`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (32,'anything','2002-02-02',141,'please work'),(33,'anythingggg','2002-02-02',141,'please workkk'),(34,'idk man','2002-03-03',NULL,'okkk'),(35,'idk man','2002-03-03',6033,'okkk'),(36,'idk man','2002-03-03',0,'okkk'),(37,'idk man','2002-03-03',1048,'okkk'),(38,'idk man','2002-03-03',1733,'okkk'),(39,'idk man','2004-03-04',0,'okkk'),(40,'anything','2002-02-02',0,'please work'),(41,'idk man','2004-02-02',6034,'okkk'),(42,'idk man','2002-02-02',6033,'okkk'),(43,'idk man','2002-02-02',6008,'okkk'),(44,'idk man','2003-02-02',6008,'okkk'),(45,'Charity','2003-02-02',6008,'okkk'),(46,'Charity','2003-02-02',0,'okkk'),(47,'Charity event','2019-09-08',6040,'charity description'),(48,'Charity event','2020-09-09',6041,'charity description'),(49,'Charity event','2020-09-09',6033,'charity description');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_eventtype`
--

DROP TABLE IF EXISTS `event_eventtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_eventtype` (
  `EventID` int NOT NULL,
  `EventTypeID` int NOT NULL,
  PRIMARY KEY (`EventID`,`EventTypeID`),
  KEY `EventTypeID` (`EventTypeID`),
  CONSTRAINT `event_eventtype_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`) ON DELETE CASCADE,
  CONSTRAINT `event_eventtype_ibfk_2` FOREIGN KEY (`EventTypeID`) REFERENCES `eventtype` (`EventTypeID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_eventtype`
--

LOCK TABLES `event_eventtype` WRITE;
/*!40000 ALTER TABLE `event_eventtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_eventtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_requirement`
--

DROP TABLE IF EXISTS `event_requirement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_requirement` (
  `EventID` int NOT NULL,
  `EventRequirementID` int NOT NULL,
  PRIMARY KEY (`EventID`,`EventRequirementID`),
  KEY `EventRequirementID` (`EventRequirementID`),
  CONSTRAINT `event_requirement_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`),
  CONSTRAINT `event_requirement_ibfk_2` FOREIGN KEY (`EventRequirementID`) REFERENCES `requirement` (`RequirementID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_requirement`
--

LOCK TABLES `event_requirement` WRITE;
/*!40000 ALTER TABLE `event_requirement` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_requirement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventfeedback`
--

DROP TABLE IF EXISTS `eventfeedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventfeedback` (
  `FeedbackID` int NOT NULL AUTO_INCREMENT,
  `Comments` text,
  `FeedbackDate` date DEFAULT NULL,
  `FeedbackTimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Rating` int DEFAULT NULL,
  `EventID` int DEFAULT NULL,
  PRIMARY KEY (`FeedbackID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `eventfeedback_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventfeedback`
--

LOCK TABLES `eventfeedback` WRITE;
/*!40000 ALTER TABLE `eventfeedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventfeedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventfeedback_volunteerhistory`
--

DROP TABLE IF EXISTS `eventfeedback_volunteerhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventfeedback_volunteerhistory` (
  `FeedbackID` int NOT NULL,
  `VolunteerHistoryID` int NOT NULL,
  PRIMARY KEY (`FeedbackID`,`VolunteerHistoryID`),
  KEY `VolunteerHistoryID` (`VolunteerHistoryID`),
  CONSTRAINT `eventfeedback_volunteerhistory_ibfk_1` FOREIGN KEY (`FeedbackID`) REFERENCES `eventfeedback` (`FeedbackID`) ON DELETE CASCADE,
  CONSTRAINT `eventfeedback_volunteerhistory_ibfk_2` FOREIGN KEY (`VolunteerHistoryID`) REFERENCES `volunteerhistory` (`VolunteerHistoryID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventfeedback_volunteerhistory`
--

LOCK TABLES `eventfeedback_volunteerhistory` WRITE;
/*!40000 ALTER TABLE `eventfeedback_volunteerhistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventfeedback_volunteerhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventtype`
--

DROP TABLE IF EXISTS `eventtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventtype` (
  `EventTypeID` int NOT NULL,
  `EventTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`EventTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventtype`
--

LOCK TABLES `eventtype` WRITE;
/*!40000 ALTER TABLE `eventtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expertbadgedecorator`
--

DROP TABLE IF EXISTS `expertbadgedecorator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expertbadgedecorator` (
  `decorator_id` int NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`decorator_id`),
  CONSTRAINT `expertbadgedecorator_ibfk_1` FOREIGN KEY (`decorator_id`) REFERENCES `badgedecorator` (`decorator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expertbadgedecorator`
--

LOCK TABLES `expertbadgedecorator` WRITE;
/*!40000 ALTER TABLE `expertbadgedecorator` DISABLE KEYS */;
/*!40000 ALTER TABLE `expertbadgedecorator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `FeedbackID` int NOT NULL AUTO_INCREMENT,
  `Comments` text,
  `FeedbackDate` date DEFAULT NULL,
  `Rating` int DEFAULT NULL,
  PRIMARY KEY (`FeedbackID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grantprivilege`
--

DROP TABLE IF EXISTS `grantprivilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grantprivilege` (
  `GrantPrivilegeID` int NOT NULL AUTO_INCREMENT,
  `DATE` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `AdminID` int DEFAULT NULL,
  PRIMARY KEY (`GrantPrivilegeID`),
  KEY `AdminID` (`AdminID`),
  CONSTRAINT `grantprivilege_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grantprivilege`
--

LOCK TABLES `grantprivilege` WRITE;
/*!40000 ALTER TABLE `grantprivilege` DISABLE KEYS */;
/*!40000 ALTER TABLE `grantprivilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grantprivilegedetails`
--

DROP TABLE IF EXISTS `grantprivilegedetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grantprivilegedetails` (
  `GrantPrivilegeDetailsID` int NOT NULL AUTO_INCREMENT,
  `GrantPrivilegeID` int DEFAULT NULL,
  `PrivilegeID` int DEFAULT NULL,
  PRIMARY KEY (`GrantPrivilegeDetailsID`),
  KEY `GrantPrivilegeID` (`GrantPrivilegeID`),
  KEY `PrivilegeID` (`PrivilegeID`),
  CONSTRAINT `grantprivilegedetails_ibfk_1` FOREIGN KEY (`GrantPrivilegeID`) REFERENCES `grantprivilege` (`GrantPrivilegeID`),
  CONSTRAINT `grantprivilegedetails_ibfk_2` FOREIGN KEY (`PrivilegeID`) REFERENCES `privilege` (`PrivilegeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grantprivilegedetails`
--

LOCK TABLES `grantprivilegedetails` WRITE;
/*!40000 ALTER TABLE `grantprivilegedetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `grantprivilegedetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leaderbadgedecorator`
--

DROP TABLE IF EXISTS `leaderbadgedecorator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leaderbadgedecorator` (
  `decorator_id` int NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`decorator_id`),
  CONSTRAINT `leaderbadgedecorator_ibfk_1` FOREIGN KEY (`decorator_id`) REFERENCES `badgedecorator` (`decorator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaderbadgedecorator`
--

LOCK TABLES `leaderbadgedecorator` WRITE;
/*!40000 ALTER TABLE `leaderbadgedecorator` DISABLE KEYS */;
/*!40000 ALTER TABLE `leaderbadgedecorator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `location` (
  `AddressID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `ParentID` int DEFAULT NULL,
  PRIMARY KEY (`AddressID`),
  KEY `ParentID` (`ParentID`)
) ENGINE=InnoDB AUTO_INCREMENT=6042 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,'Afghanistan',NULL),(2,'Badakhshan',1),(3,'Eshkashem',2),(4,'Fayzabad',2),(5,'Jurm',2),(6,'Khandud',2),(7,'Qal\'eh-ye Panjeh',2),(8,'Badgis',1),(9,'Bala Morghab',8),(10,'Qal\'eh-ye Naw',8),(11,'Baglan',1),(12,'Andarab',11),(13,'Baghlan',11),(14,'Dahaneh-ye Ghawri',11),(15,'Nahrin',11),(16,'Pol-e Khumri',11),(17,'Balkh',1),(18,'Dawlatabad',17),(19,'Mazar-e Sharif',17),(20,'Qarchi Gak',17),(21,'Shulgara',17),(22,'Tash Gozar',17),(23,'Bamiyan',1),(24,'Panjab',23),(25,'Qil Qal\'eh',23),(26,'Farah',1),(27,'Anar Darreh',26),(28,'Shindand',26),(29,'Faryab',1),(30,'Andkhvoy',29),(31,'Darzi Ab',29),(32,'Maymanah',29),(33,'Gawr',1),(34,'Chaghcharan',33),(35,'Shahrak',33),(36,'Taywarah',33),(37,'Gazni',1),(38,'Ghazni',37),(39,'Herat',1),(40,'Awbeh',39),(41,'Eslam Qal\'eh',39),(42,'Ghurian',39),(43,'Karukh',39),(44,'Kuhestan',39),(45,'Kushk',39),(46,'Qarabagh',39),(47,'Tawraghudi',39),(48,'Tir Pol',39),(49,'Zendejan',39),(50,'Hilmand',1),(51,'Baghran',50),(52,'Darwishan',50),(53,'Deh Shu',50),(54,'Gereshk',50),(55,'Lashkar Gah',50),(56,'Sangin',50),(57,'Jawzjan',1),(58,'Aqchah',57),(59,'Qarqin',57),(60,'Sang-e Charak',57),(61,'Shibarghan',57),(62,'Kabul',1),(63,'Baghrami',62),(64,'Mir Bachchekut',62),(65,'Paghman',62),(66,'Sarawbi',62),(67,'Kapisa',1),(68,'Mahmud-e Raqi',67),(69,'Taghab',67),(70,'Khawst',1),(71,'Kunar',1),(72,'Asadabad',71),(73,'Asmar',71),(74,'Lagman',1),(75,'Mehtar Lam',74),(76,'Lawghar',1),(77,'Azraw',76),(78,'Baraki Barak',76),(79,'Pol-e Alam',76),(80,'Nangarhar',1),(81,'Achin',80),(82,'Batsawul',80),(83,'Hugyani',80),(84,'Jalalabad',80),(85,'Nader Shah Kawt',80),(86,'Nimruz',1),(87,'Chahar Burjak',86),(88,'Chakhansur',86),(89,'Khash',86),(90,'Mirabad',86),(91,'Rudbar',86),(92,'Zaranj',86),(93,'Nuristan',1),(94,'Paktika',1),(95,'Orgun',94),(96,'Zareh Sharan',94),(97,'Zarghun Shahr',94),(98,'Paktiya',1),(99,'\'Ali Khayl',98),(100,'Ghardez',98),(101,'Parwan',1),(102,'Charikar',101),(103,'Jabal-os-Saraj',101),(104,'Qandahar',1),(105,'Qunduz',1),(106,'Dasht-e Archa',105),(107,'Emam Saheb',105),(108,'Hazart Imam',105),(109,'Khanabad',105),(110,'Qal\'eh-ye Zal',105),(111,'Samangan',1),(112,'Aybak',111),(113,'Kholm',111),(114,'Sar-e Pul',1),(115,'Takhar',1),(116,'Chah Ab',115),(117,'Eshkamesh',115),(118,'Farkhar',115),(119,'Khwajeh Ghar',115),(120,'Rostaq',115),(121,'Taloqan',115),(122,'Yangi Qal\'eh',115),(123,'Uruzgan',1),(124,'Deh Rawud',123),(125,'Gaz Ab',123),(126,'Tarin Kawt',123),(127,'Wardag',1),(128,'Gardan Diwal',127),(129,'Maydanshahr',127),(130,'Zabul',1),(131,'Qalat-e Ghilzay',130),(132,'Albania',NULL),(133,'Algeria',NULL),(134,'\'Ayn Daflah',133),(135,'\'Ayn Tamushanat',133),(136,'Adrar',133),(137,'Atar',136),(138,'Awlaf',136),(139,'Rijan',136),(140,'Shingati',136),(141,'Timimun',136),(142,'al-Aghwat',133),(143,'Aflu',142),(144,'Hassi al-Raml',142),(145,'al-Bayadh',133),(146,'al-Abyad Sidi Shaykh',145),(147,'Brizyanah',145),(148,'al-Jaza\'ir',133),(149,'Bab Azwar',148),(150,'Baraki',148),(151,'Bir Murad Rais',148),(152,'Birkhadam',148),(153,'Burj-al-Kiffan',148),(154,'Dar-al-Bayda',148),(155,'al-Wad',133),(156,'al-Mighair',155),(157,'Bayadha',155),(158,'Dabilah',155),(159,'Hassan \'Abd-al-Karim',155),(160,'Hassi Halifa',155),(161,'Jama\'a',155),(162,'Maqran',155),(163,'Qamar',155),(164,'Raqiba',155),(165,'Rubbah',155),(166,'Sidi Amran',155),(167,'Algiers',133),(168,'Hydra',167),(169,'Kouba',167),(170,'Annabah',133),(171,'al-Buni',170),(172,'al-Hajar',170),(173,'Birrahhal',170),(174,'Saraydih',170),(175,'Sidi Amar',170),(176,'ash-Shalif',133),(177,'\'Ayn Maran',176),(178,'Abu al-Hassan',176),(179,'ash-Shattiyah',176),(180,'Bani Hawa',176),(181,'Bu Qadir',176),(182,'Sidi Ukaskah',176),(183,'Tanas',176),(184,'Wadi al-Fiddah',176),(185,'Wadi Sali',176),(186,'at-Tarif',133),(187,'al-Qal\'ah',186),(188,'Ban Mahdi',186),(189,'Bani Amar',186),(190,'Basbas',186),(191,'Dariyan',186),(192,'Saba\'ita Muk',186),(193,'Bashshar',133),(194,'\'Abadlah',193),(195,'Bani Wanif',193),(196,'Qanadsan',193),(197,'Taghit',193),(198,'Batnah',133),(199,'\'Aris',198),(200,'\'Ayn Tutah',198),(201,'Barikah',198),(202,'Marwanah',198),(203,'Naghaus',198),(204,'Ra\'s-al-\'Ayun',198),(205,'Tazult',198),(206,'Bijayah',133),(207,'\'Ayt Rizin',206),(208,'Akbu',206),(209,'al-Qasr',206),(210,'Amizur',206),(211,'Barbasha',206),(212,'Farrawn',206),(213,'Ighram',206),(214,'Sadduk',206),(215,'Shamini',206),(216,'Sidi \'Aysh',206),(217,'Taskaryut',206),(218,'Tazmalt',206),(219,'Timazrit',206),(220,'Uz-al-Laqin',206),(221,'Biskrah',133),(222,'Awlad Jallal',221),(223,'Sidi Khalid',221),(224,'Sidi Ukbah',221),(225,'Tulja',221),(226,'Um\'ash',221),(227,'Zaribat-al-Wad',221),(228,'Blidah',133),(229,'al-\'Afrun',228),(230,'al-Arba\'a',228),(231,'Awlad Salam',228),(232,'Awlad Yaysh',228),(233,'Bani Khalil',228),(234,'Bani Marad',228),(235,'Bani Tamu',228),(236,'Bu Arfa',228),(237,'Bufarik',228),(238,'Buinan',228),(239,'Buqara',228),(240,'Maftah',228),(241,'Muzayah',228),(242,'Shabli',228),(243,'Shari\'ah',228),(244,'Shiffa',228),(245,'Sidi Mussa',228),(246,'Suma',228),(247,'Wadi al-Allagh',228),(248,'Buirah',133),(249,'\'Ayn Bissim',248),(250,'Aghbalu',248),(251,'Bi\'r Ghabalu',248),(252,'Lakhdariyah',248),(253,'Shurfa',248),(254,'Sur-al-Ghuzlan',248),(255,'Bumardas',133),(256,'\'Ayn Tayah',255),(257,'al-Arba\'a Tash',255),(258,'ar-Ruwibah',255),(259,'Awlad Haddaj',255),(260,'Awlad Mussa',255),(261,'Bani Amran',255),(262,'Budwawu',255),(263,'Budwawu al-Bahri',255),(264,'Burj Minayal',255),(265,'Dalis',255),(266,'Hammadi',255),(267,'Issar',255),(268,'Khamis-al-Khashnah',255),(269,'Nasiriyah',255),(270,'Raghayah',255),(271,'Sa\'abat',255),(272,'Tinyah',255),(273,'Burj Bu Arririj',133),(274,'Ghalizan',133),(275,'Ammi Mussa',274),(276,'Jidiwiyah',274),(277,'Mazunah',274),(278,'Sidi Muhammad Ban \'Ali',274),(279,'Wadi Rahiyu',274),(280,'Zammurah',274),(281,'Ghardayah',133),(282,'al-Ghuli\'ah',281),(283,'al-Qararah',281),(284,'Biryan',281),(285,'Bu Nura',281),(286,'Ghardaia',281),(287,'Matlili',281),(288,'Ilizi',133),(289,'Jijili',133),(290,'al-Miliyah',289),(291,'Amir \'Abd-al-Qadar',289),(292,'Shifka',289),(293,'Tahar',289),(294,'Jilfah',133),(295,'\'Ayn Wissarah',294),(296,'\'Ayn-al-Ibil',294),(297,'al-Idrisiyah',294),(298,'Birin',294),(299,'Dar Shiyukh',294),(300,'Hassi Bahbah',294),(301,'Mis\'ad',294),(302,'Sharif',294),(303,'Khanshalah',133),(304,'al-Mahmal',303),(305,'Sharshar',303),(306,'Tawziyanat',303),(307,'Masilah',133),(308,'\'Ayn-al-Hajal',307),(309,'\'Ayn-al-Milh',307),(310,'Bu Sa\'adah',307),(311,'Hammam Dhala\'a',307),(312,'Ma\'adid',307),(313,'Maghra',307),(314,'Sidi \'Aysa',307),(315,'Wanugha',307),(316,'Midyah',133),(317,'\'Ayn Bu Sif',316),(318,'Birwaghiyah',316),(319,'Qasr-al-Bukhari',316),(320,'Shillalah',316),(321,'Tablat',316),(322,'Milah',133),(323,'Farjiwah',322),(324,'Qararam Quqa',322),(325,'Ruwashad',322),(326,'Salghum-al-\'Ayd',322),(327,'Sidi Maruf',322),(328,'Sidi Marwan',322),(329,'Tajananah',322),(330,'Talighmah',322),(331,'Wadi Athmaniyah',322),(332,'Muaskar',133),(333,'Bu Khanifiyah',332),(334,'Muhammadiyah',332),(335,'Siq',332),(336,'Tighinnif',332),(337,'Wadi al-Abtal',332),(338,'Zahana',332),(339,'Mustaghanam',133),(340,'\'Ayn Tadalas',339),(341,'Hassi Mamash',339),(342,'Mazaghran',339),(343,'Sidi Ali',339),(344,'Naama',133),(345,'\'Ayn Safra',344),(346,'Mishriyah',344),(347,'Oran',133),(348,'Ouargla',133),(349,'Qalmah',133),(350,'\'Ayn Bardah',349),(351,'Bumahra Ahmad',349),(352,'Hamman Awlad \'Ali',349),(353,'Wadi Zinati',349),(354,'Qustantinah',133),(355,'\'Ayn Abid',354),(356,'\'Ayn Samara',354),(357,'al-Khurub',354),(358,'Didush Murad',354),(359,'Hamma Bu Ziyan',354),(360,'Zighut Yusuf',354),(361,'Sakikdah',133),(362,'\'Azzabah',361),(363,'al-Harush',361),(364,'al-Qull',361),(365,'Amjaz Adshish',361),(366,'Fil Fila',361),(367,'Karkira',361),(368,'Ramadan Jamal',361),(369,'Shataybih',361),(370,'Tamalus',361),(371,'Satif',133),(372,'\'Ayn \'Azl',371),(373,'\'Ayn Arnat',371),(374,'\'Ayn Taqrut',371),(375,'\'Ayn Wilman',371),(376,'\'Ayn-al-Khabira',371),(377,'al-\'Ulmah',371),(378,'Bouira',371),(379,'Buq\'ah',371),(380,'Salah Bay',371),(381,'Setif',371),(382,'Ziyama Mansuriyah',371),(383,'Sayda\'',133),(384,'\'Ayn-al-Hajar',383),(385,'Sidi ban-al-\'Abbas',133),(386,'Suq Ahras',133),(387,'Tamanghasat',133),(388,'\'Ayn Qazzan',387),(389,'\'Ayn Salah',387),(390,'Tibazah',133),(391,'\'Ayn Binyan',390),(392,'al-Qull\'ah',390),(393,'Bu Isma\'il',390),(394,'Bu Midfar\'ah',390),(395,'Damus',390),(396,'Duwirah',390),(397,'Hajut',390),(398,'Hammam Righa',390),(399,'Sawlah',390),(400,'Shiragha',390),(401,'Shirshall',390),(402,'Sidi Farj',390),(403,'Stawali',390),(404,'Ziralda',390),(405,'Tibissah',133),(406,'al-\'Awaynat',405),(407,'Bi\'r-al-\'Itir',405),(408,'Hammamat',405),(409,'Mursut',405),(410,'Shariyah',405),(411,'Winzah',405),(412,'Tilimsan',133),(413,'al-Mansurah',412),(414,'Awlad Mimun',412),(415,'Bani Mastar',412),(416,'Bani Sikran',412),(417,'Ghazawat',412),(418,'Hannayah',412),(419,'Maghniyah',412),(420,'Nidruma',412),(421,'Ramsh',412),(422,'Sabra',412),(423,'Shatwan',412),(424,'Sibdu',412),(425,'Sidi \'Abdallah',412),(426,'Tinduf',133),(427,'Tisamsilt',133),(428,'Thaniyat-al-Had',427),(429,'Tiyarat',133),(430,'\'Ayn Dhahab',429),(431,'Firindah',429),(432,'Mahdiyah',429),(433,'Mashra\'a Asfa',429),(434,'Qasr Shillalah',429),(435,'Rahuyah',429),(436,'Sughar',429),(437,'Takhamarat',429),(438,'Tizi Wazu',133),(439,'Umm-al-Bawaghi',133),(440,'\'Ayn Bayda',439),(441,'\'Ayn Fakrun',439),(442,'\'Ayn Kirshah',439),(443,'\'Ayn Malilah',439),(444,'Bi\'r Shuhada',439),(445,'Miskyanah',439),(446,'Shamurah',439),(447,'Wahran',133),(448,'\'Ayn Biya',447),(449,'\'Ayn-at-Turk',447),(450,'al-Ansur',447),(451,'Arzu',447),(452,'as-Saniyah',447),(453,'Bi\'r-al-Jir',447),(454,'Butlilis',447),(455,'Hassi Bu Nif',447),(456,'Mars-al-Kabir',447),(457,'Qadayal',447),(458,'Sidi ash-Shami',447),(459,'Wadi Thalatha',447),(460,'Warqla',133),(461,'al-Hajirah',460),(462,'Hassi Mas\'ud',460),(463,'Nazla',460),(464,'Ruwisiyat',460),(465,'Tabisbast',460),(466,'Tamalhat',460),(467,'Tamasin',460),(468,'Tayabat-al-Janubiyah',460),(469,'Tughghurt',460),(470,'Wilaya d Alger',133),(471,'Wilaya de Bejaia',133),(472,'Wilaya de Constantine',133),(473,'American Samoa',NULL),(474,'Andorra',NULL),(475,'Angola',NULL),(476,'Anguilla',NULL),(477,'Antarctica',NULL),(478,'Antigua And Barbuda',NULL),(479,'Argentina',NULL),(480,'Armenia',NULL),(481,'Aruba',NULL),(482,'Australia',NULL),(483,'New South Wales',482),(484,'Albury - Wodonga (Albury part)',483),(485,'Armidale',483),(486,'Ballina',483),(487,'Batemans Bay',483),(488,'Bathurst',483),(489,'Blue Mountains',483),(490,'Bowral - Mittagong',483),(491,'Broken Hill',483),(492,'Central Coast',483),(493,'Cessnock',483),(494,'Coffs Harbour',483),(495,'Dubbo',483),(496,'Forster - Tuncurry',483),(497,'Goulburn',483),(498,'Grafton',483),(499,'Griffith',483),(500,'Kempsey',483),(501,'Kiama',483),(502,'Kurri Kurri',483),(503,'Lismore',483),(504,'Lithgow',483),(505,'Maitland',483),(506,'Morisset - Cooranbong',483),(507,'Muswellbrook',483),(508,'Nelson Bay',483),(509,'Newcastle',483),(510,'Nowra - Bomaderry',483),(511,'Orange',483),(512,'Port Macquarie',483),(513,'Raymond Terrace',483),(514,'Singleton',483),(515,'Sydney',483),(516,'Tamworth',483),(517,'Taree',483),(518,'Tweed Heads',483),(519,'Ulladulla',483),(520,'Wagga Wagga',483),(521,'Wollongong',483),(522,'Queensland',482),(523,'Brisbane',522),(524,'Bundaberg',522),(525,'Cairns',522),(526,'Gladstone',522),(527,'Gold Coast',522),(528,'Hervey Bay',522),(529,'Mackay',522),(530,'Rockhampton',522),(531,'Sunshine Coast',522),(532,'Toowoomba',522),(533,'Townsville',522),(534,'South Australia',482),(535,'Adelaide',534),(536,'Agery',534),(537,'Alawoona',534),(538,'Alford',534),(539,'Allendale East',534),(540,'American River',534),(541,'Andamooka',534),(542,'Andrews',534),(543,'Angaston',534),(544,'Angle Vale',534),(545,'Appila',534),(546,'Ardrossan',534),(547,'Armagh',534),(548,'Arno Bay',534),(549,'Arthurton',534),(550,'Auburn',534),(551,'Avenue Range',534),(552,'Bagot Well',534),(553,'Baird Bay',534),(554,'Balaklava',534),(555,'Balgowan',534),(556,'Balhannah',534),(557,'Barabba',534),(558,'Barmera',534),(559,'Beachport',534),(560,'Beltana',534),(561,'Berri',534),(562,'Bethany',534),(563,'Binnum',534),(564,'Birdwood',534),(565,'Black Hill',534),(566,'Black Point',534),(567,'Blakiston',534),(568,'Blanche Harbor',534),(569,'Blanchetown',534),(570,'Blinman',534),(571,'Blyth',534),(572,'Booborowie',534),(573,'Booleroo Centre',534),(574,'Border Village',534),(575,'Bordertown',534),(576,'Borrika',534),(577,'Boston',534),(578,'Bower',534),(579,'Bowhill',534),(580,'Bowmans',534),(581,'Brentwood',534),(582,'Brinkworth',534),(583,'Bruce',534),(584,'Brukunga',534),(585,'Buckleboo',534),(586,'Burra',534),(587,'Burrungule',534),(588,'Bute',534),(589,'Butler',534),(590,'Cadell',534),(591,'Calca',534),(592,'Callington',534),(593,'Calomba',534),(594,'Caloote',534),(595,'Calperum Station',534),(596,'Caltowie',534),(597,'Cambrai',534),(598,'Cape Jervis',534),(599,'Carpenter Rocks',534),(600,'Carrickalinga',534),(601,'Carrieton',534),(602,'Ceduna',534),(603,'Charleston',534),(604,'Cherry Gardens',534),(605,'Cherryville',534),(606,'Chowilla',534),(607,'Clare',534),(608,'Clarendon',534),(609,'Clayton Bay',534),(610,'Cleve',534),(611,'Clinton',534),(612,'Cobdogla',534),(613,'Cockaleechie',534),(614,'Cockatoo Valley',534),(615,'Cockburn',534),(616,'Coffin Bay',534),(617,'Commissariat Point',534),(618,'Coober Pedy',534),(619,'Coobowie',534),(620,'Cook',534),(621,'Cooke Plains',534),(622,'Cooltong',534),(623,'Coomandook',534),(624,'Coonalpyn',534),(625,'Coonawarra',534),(626,'Coorabie',534),(627,'Copeville',534),(628,'Copley',534),(629,'Corny Point',534),(630,'Coulta',534),(631,'Cowell',534),(632,'Cradock',534),(633,'Crystal Brook',534),(634,'Cudlee Creek',534),(635,'Culburra',534),(636,'Cultana',534),(637,'Cummins',534),(638,'Cungena',534),(639,'Curramulka',534),(640,'Currency Creek',534),(641,'Danggali',534),(642,'Darke Peak',534),(643,'Davenport',534),(644,'Dawesley',534),(645,'Delamere',534),(646,'Donovans',534),(647,'Dowlingville',534),(648,'Dublin',534),(649,'Dutton',534),(650,'Eden Valley',534),(651,'Ediacara',534),(652,'Edillilie',534),(653,'Edithburgh',534),(654,'Elliston',534),(655,'Encounter Bay',534),(656,'Ernabella',534),(657,'Eudunda',534),(658,'False Bay',534),(659,'Farrell Flat',534),(660,'Finniss',534),(661,'Foul Bay',534),(662,'Fowlers Bay',534),(663,'Frances',534),(664,'Freeling',534),(665,'Fregon',534),(666,'Furner',534),(667,'Galga',534),(668,'Gawler',534),(669,'Georgetown',534),(670,'Geranium',534),(671,'Giles Corner',534),(672,'Glencoe',534),(673,'Glendambo',534),(674,'Gluepot',534),(675,'Goolwa',534),(676,'Greenock',534),(677,'Greenways',534),(678,'Gulnare',534),(679,'Gumeracha',534),(680,'Hahndorf',534),(681,'Halbury',534),(682,'Halidon',534),(683,'Hallett',534),(684,'Hamilton',534),(685,'Hamley Bridge',534),(686,'Hammond',534),(687,'Harrogate',534),(688,'Hartley',534),(689,'Haslam',534),(690,'Hatherleigh',534),(691,'Hawker',534),(692,'Hayborough',534),(693,'Head of the Bight',534),(694,'Hill River',534),(695,'Hilltown',534),(696,'Hincks',534),(697,'Honiton',534),(698,'Hoyleton',534),(699,'Hynam',534),(700,'Inman Valley',534),(701,'Innamincka',534),(702,'Inneston',534),(703,'Iron Baron',534),(704,'Iron Knob',534),(705,'Island Beach',534),(706,'Jabuk',534),(707,'James Well',534),(708,'Jamestown',534),(709,'Jervois',534),(710,'Kadina',534),(711,'Kainton',534),(712,'Kalangadoo',534),(713,'Kanmantoo',534),(714,'Kapunda',534),(715,'Karkoo',534),(716,'Karoonda',534),(717,'Keith',534),(718,'Kersbrook',534),(719,'Keyneton',534),(720,'Ki Ki',534),(721,'Kielpa',534),(722,'Kimba',534),(723,'Kingoonya',534),(724,'Kingscote',534),(725,'Kingston SE',534),(726,'Kingston-On-Murray',534),(727,'Kongorong',534),(728,'Koolunga',534),(729,'Koppio',534),(730,'Korunye',534),(731,'Krondorf',534),(732,'Kunytjanu',534),(733,'Kyancutta',534),(734,'Kybybolite',534),(735,'Lake View',534),(736,'Lameroo',534),(737,'Langhorne Creek',534),(738,'Laura',534),(739,'Leigh Creek',534),(740,'Lenswood',534),(741,'Lewiston',534),(742,'Light Pass',534),(743,'Linwood',534),(744,'Lipson',534),(745,'Littlehampton',534),(746,'Lobethal',534),(747,'Lochiel',534),(748,'Lock',534),(749,'Long Plains',534),(750,'Longwood',534),(751,'Louth Bay',534),(752,'Loveday',534),(753,'Lower Light',534),(754,'Loxton',534),(755,'Loxton North',534),(756,'Lucindale',534),(757,'Lyndhurst',534),(758,'Lyndoch',534),(759,'Lyrup',534),(760,'Macclesfield',534),(761,'Mallala',534),(762,'Mambray Creek',534),(763,'Manna Hill',534),(764,'Mannum',534),(765,'Manoora',534),(766,'Mantung',534),(767,'Marama',534),(768,'Marananga',534),(769,'Marion Bay',534),(770,'Marla',534),(771,'Marrabel',534),(772,'Marree',534),(773,'McCracken',534),(774,'Meadows',534),(775,'Melrose',534),(776,'Meningie',534),(777,'Mercunda',534),(778,'Merriton',534),(779,'Middle Beach',534),(780,'Middleback Range',534),(781,'Middleton',534),(782,'Mil Lel',534),(783,'Milang',534),(784,'Millicent',534),(785,'Mindarie',534),(786,'Minlaton',534),(787,'Minnipa',534),(788,'Mintabie',534),(789,'Mintaro',534),(790,'Miranda',534),(791,'Moculta',534),(792,'Monarto South',534),(793,'Monash',534),(794,'Moonta',534),(795,'Moorak',534),(796,'Moorlands',534),(797,'Moorook',534),(798,'Morchard',534),(799,'Morgan',534),(800,'Mount Barker',534),(801,'Mount Bryan',534),(802,'Mount Burr',534),(803,'Mount Compass',534),(804,'Mount Gambier',534),(805,'Mount Pleasant',534),(806,'Mount Torrens',534),(807,'Mullaquana',534),(808,'Mundallio',534),(809,'Mundoora',534),(810,'Murdinga',534),(811,'Murray Bridge',534),(812,'Murray Bridge East',534),(813,'Murray Bridge South',534),(814,'Murray Town',534),(815,'Mylor',534),(816,'Mypolonga',534),(817,'Myponga',534),(818,'Nackara',534),(819,'Nain',534),(820,'Nairne',534),(821,'Nangwarry',534),(822,'Nantawarra',534),(823,'Naracoorte',534),(824,'Narrung',534),(825,'New Well',534),(826,'Nildottie',534),(827,'Ninnes',534),(828,'Nonning',534),(829,'Normanville',534),(830,'Norton Summit',534),(831,'Nullarbor',534),(832,'Nundroo',534),(833,'Nuriootpa',534),(834,'Oakbank',534),(835,'OB Flat',534),(836,'Olary',534),(837,'Olympic Dam',534),(838,'Oodnadatta',534),(839,'Orroroo',534),(840,'Overland Corner',534),(841,'Owen',534),(842,'Padthaway',534),(843,'Palmer',534),(844,'Parachilna',534),(845,'Paratoo',534),(846,'Parham',534),(847,'Parilla',534),(848,'Paringa',534),(849,'Parndana',534),(850,'Parrakie',534),(851,'Paruna',534),(852,'Paskeville',534),(853,'Peake',534),(854,'Peebinga',534),(855,'Penneshaw',534),(856,'Penola',534),(857,'Penrice',534),(858,'Penwortham',534),(859,'Perlubie',534),(860,'Perponda',534),(861,'Peterborough',534),(862,'Piccadilly',534),(863,'Pine Point',534),(864,'Pinkerton Plains',534),(865,'Pinnaroo',534),(866,'Point Boston',534),(867,'Point Lowly',534),(868,'Point Mcleay',534),(869,'Point Pass',534),(870,'Point Pearce',534),(871,'Point Souttar',534),(872,'Point Sturt',534),(873,'Point Turton',534),(874,'Polda',534),(875,'Poochera',534),(876,'Port Arthur',534),(877,'Port Augusta',534),(878,'Port Augusta North',534),(879,'Port Augusta West',534),(880,'Port Broughton',534),(881,'Port Elliot',534),(882,'Port Flinders',534),(883,'Port Gawler',534),(884,'Port Germein',534),(885,'Port Hughes',534),(886,'Port Julia',534),(887,'Port Kenny',534),(888,'Port Lincoln',534),(889,'Port MacDonnell',534),(890,'Port Neill',534),(891,'Port Paterson',534),(892,'Port Pirie',534),(893,'Port Pirie South',534),(894,'Port Pirie West',534),(895,'Port Victoria',534),(896,'Port Vincent',534),(897,'Port Wakefield',534),(898,'Price',534),(899,'Proof Range',534),(900,'Punyelroo',534),(901,'Qualco',534),(902,'Quorn',534),(903,'Ramco',534),(904,'Rapid Bay',534),(905,'Raukkan',534),(906,'Redbanks',534),(907,'Redhill',534),(908,'Reeves Plains',534),(909,'Rendelsham',534),(910,'Renmark',534),(911,'Renmark South',534),(912,'Risdon Park',534),(913,'Risdon Park South',534),(914,'Riverton',534),(915,'Robe',534),(916,'Robertstown',534),(917,'Rogues Point',534),(918,'Roseworthy',534),(919,'Rowland Flat',534),(920,'Roxby Downs',534),(921,'Rudall',534),(922,'Saddleworth',534),(923,'Saltia',534),(924,'Sandalwood',534),(925,'Sanderston',534),(926,'Sandilands',534),(927,'Sandy Creek',534),(928,'Sapphiretown',534),(929,'Seaford',534),(930,'Second Valley',534),(931,'Secret Rocks',534),(932,'Sedan',534),(933,'Seppeltsfield',534),(934,'Shea-Oak Log',534),(935,'Sherlock',534),(936,'Smoky Bay',534),(937,'Snowtown',534),(938,'Solomontown',534),(939,'South Kilkerran',534),(940,'Southend',534),(941,'Spalding',534),(942,'Springton',534),(943,'Stanley Flat',534),(944,'Stansbury',534),(945,'Stenhouse Bay',534),(946,'Stirling',534),(947,'Stirling North',534),(948,'Stockport',534),(949,'Stockwell',534),(950,'Stone Hut',534),(951,'Stone Well',534),(952,'Strathalbyn',534),(953,'Streaky Bay',534),(954,'Sultana Point',534),(955,'Summertown',534),(956,'Sutherlands',534),(957,'Swan Reach',534),(958,'Tailem Bend',534),(959,'Taldra',534),(960,'Tantanoola',534),(961,'Tanunda',534),(962,'Taplan',534),(963,'Tarcoola',534),(964,'Tarcowie',534),(965,'Tarlee',534),(966,'Tarpeena',534),(967,'Taylorville Station',534),(968,'Templers',534),(969,'Terowie',534),(970,'Thevenard',534),(971,'Thompson Beach',534),(972,'Tickera',534),(973,'Tiddy Widdy Beach',534),(974,'Tintinara',534),(975,'Tooligie',534),(976,'Totness',534),(977,'Trihi',534),(978,'Truro',534),(979,'Tumby Bay',534),(980,'Tungkillo',534),(981,'Two Wells',534),(982,'Uleybury',534),(983,'Ungarra',534),(984,'Upper Sturt',534),(985,'Uraidla',534),(986,'Veitch',534),(987,'Venus Bay',534),(988,'Verdun',534),(989,'Victor Harbor',534),(990,'Virginia',534),(991,'Waikerie',534),(992,'Wallaroo',534),(993,'Wami Kata',534),(994,'Wanbi',534),(995,'Wangary',534),(996,'Wanilla',534),(997,'Warnertown',534),(998,'Warooka',534),(999,'Warrachie',534),(1000,'Warramboo',534),(1001,'Warrow',534),(1002,'Wasleys',534),(1003,'Watervale',534),(1004,'Waukaringa',534),(1005,'Webb Beach',534),(1006,'Weetulta',534),(1007,'Wellington',534),(1008,'Wharminda',534),(1009,'Whites Flat',534),(1010,'Whyalla',534),(1011,'Whyalla Barson',534),(1012,'Whyalla Jenkins',534),(1013,'Whyalla Norrie',534),(1014,'Whyalla Playford',534),(1015,'Whyalla Stuart',534),(1016,'Whyte Yarcowie',534),(1017,'Williamstown',534),(1018,'Willunga',534),(1019,'Wilmington',534),(1020,'Windsor',534),(1021,'Winkie',534),(1022,'Winninowie',534),(1023,'Wirrabara',534),(1024,'Wirrulla',534),(1025,'Wistow',534),(1026,'Witchelina',534),(1027,'Wolseley',534),(1028,'Woodside',534),(1029,'Wool Bay',534),(1030,'Woolundunga',534),(1031,'Woomera',534),(1032,'Wudinna',534),(1033,'Wynarka',534),(1034,'Yacka',534),(1035,'Yahl',534),(1036,'Yalata',534),(1037,'Yallunda Flat',534),(1038,'Yaninee',534),(1039,'Yankalilla',534),(1040,'Yeelanna',534),(1041,'Yellabinna',534),(1042,'Yongala',534),(1043,'Yorketown',534),(1044,'Yumali',534),(1045,'Yunta',534),(1046,'Tasmania',482),(1047,'Devonport',1046),(1048,'Hobart',1046),(1049,'Launceston',1046),(1050,'Strahan',1046),(1051,'Victoria',482),(1052,'Ararat',1051),(1053,'Bairnsdale',1051),(1054,'Ballarat',1051),(1055,'Bendigo',1051),(1056,'Colac',1051),(1057,'Echuca',1051),(1058,'Geelong',1051),(1059,'Horsham',1051),(1060,'Mahe',1051),(1061,'Melbourne',1051),(1062,'Mildura',1051),(1063,'Portland',1051),(1064,'Shepparton',1051),(1065,'Swan Hill',1051),(1066,'Torquay',1051),(1067,'Traralgon',1051),(1068,'Wangaratta',1051),(1069,'Warrnambool',1051),(1070,'Wodonga',1051),(1071,'Western Australia',482),(1072,'Albany',1071),(1073,'Augusta',1071),(1074,'Binningup',1071),(1075,'Boddington-Ranford',1071),(1076,'Bridgetown',1071),(1077,'Broome',1071),(1078,'Bullsbrook',1071),(1079,'Bunbury',1071),(1080,'Busselton',1071),(1081,'Capel',1071),(1082,'Carnarvon',1071),(1083,'Collie',1071),(1084,'Cowaramup',1071),(1085,'Dampier',1071),(1086,'Denmark',1071),(1087,'Derby',1071),(1088,'Donnybrook',1071),(1089,'Drummond Cove',1071),(1090,'Dunsborough',1071),(1091,'Esperance',1071),(1092,'Exmouth',1071),(1093,'Fitzroy Crossing',1071),(1094,'Geraldton',1071),(1095,'Halls Creek',1071),(1096,'Harvey',1071),(1097,'Jurien Bay',1071),(1098,'Kalbarri',1071),(1099,'Kalgoorlie-Boulder',1071),(1100,'Kambalda West',1071),(1101,'Karratha',1071),(1102,'Katanning',1071),(1103,'Kojonup',1071),(1104,'Kununurra',1071),(1105,'Little Grove',1071),(1106,'Manjimup',1071),(1107,'Margaret River',1071),(1108,'Merredin',1071),(1109,'Moora',1071),(1110,'Mundijong',1071),(1111,'Narrogin',1071),(1112,'Newman',1071),(1113,'Northam',1071),(1114,'Paraburdoo',1071),(1115,'Perth',1071),(1116,'Pinjarra',1071),(1117,'Port Denison-Dongara',1071),(1118,'Port Hedland',1071),(1119,'Serpentine',1071),(1120,'Tom Price',1071),(1121,'Two Rocks',1071),(1122,'Wagin',1071),(1123,'Waroona',1071),(1124,'Wickham',1071),(1125,'Yanchep',1071),(1126,'York',1071),(1127,'Austria',NULL),(1128,'Bundesland Salzburg',1127),(1129,'Bundesland Steiermark',1127),(1130,'Bundesland Tirol',1127),(1131,'Burgenland',1127),(1132,'Eisenstadt',1131),(1133,'GroBpetersdorf',1131),(1134,'Jennersdorf',1131),(1135,'Kemeten',1131),(1136,'Mattersburg',1131),(1137,'Neudorfl',1131),(1138,'Neusiedl am See',1131),(1139,'Oberwart',1131),(1140,'Pinkafeld',1131),(1141,'Rust',1131),(1142,'Carinthia',1127),(1143,'Maria Rain',1142),(1144,'Poggersdorf',1142),(1145,'Karnten',1127),(1146,'Althofen',1145),(1147,'Arnoldstein',1145),(1148,'Bad Sankt Leonhard',1145),(1149,'Bleiburg',1145),(1150,'Ebenthal',1145),(1151,'Eberndorf',1145),(1152,'Feldkirchen',1145),(1153,'Ferlach',1145),(1154,'Finkenstein',1145),(1155,'Friesach',1145),(1156,'Hermagor',1145),(1157,'Klagenfurt',1145),(1158,'Klagenfurt ',1145),(1159,'Lohnsburg',1145),(1160,'Moosburg',1145),(1161,'Paternion',1145),(1162,'Radentheim',1145),(1163,'Sankt Andra',1145),(1164,'Sankt Jakob',1145),(1165,'Sankt Veit',1145),(1166,'Seeboden',1145),(1167,'Spittal',1145),(1168,'Velden am Worthersee',1145),(1169,'Villach',1145),(1170,'Volkermarkt',1145),(1171,'Wernberg',1145),(1172,'Wolfsberg',1145),(1173,'Liezen',1127),(1174,'Lower Austria',1127),(1175,'Niederosterreich',1127),(1176,'Amstetten',1175),(1177,'Bad Voslau',1175),(1178,'Baden',1175),(1179,'Berndorf',1175),(1180,'Boheimkirchen',1175),(1181,'Bruck an der Leitha',1175),(1182,'Brunn',1175),(1183,'Deutsch-Wagram',1175),(1184,'Ebreichsdorf',1175),(1185,'Eggendorf',1175),(1186,'Fischamend',1175),(1187,'Gablitz',1175),(1188,'Ganserndorf',1175),(1189,'Gerasdorf',1175),(1190,'Gloggnitz',1175),(1191,'Gmund',1175),(1192,'Greifenstein',1175),(1193,'GroB-Enzersdorf',1175),(1194,'GroB-Gerungs',1175),(1195,'Guntramsdorf',1175),(1196,'Haag',1175),(1197,'Hainburg',1175),(1198,'Heidenreichstein',1175),(1199,'Herzogenburg',1175),(1200,'Himberg',1175),(1201,'Hollabrunn',1175),(1202,'Horn',1175),(1203,'Klosterneuburg',1175),(1204,'Korneuburg',1175),(1205,'Kottingbrunn',1175),(1206,'Krems',1175),(1207,'Laa',1175),(1208,'Langenlois',1175),(1209,'Langenzersdorf',1175),(1210,'Leobendorf',1175),(1211,'Leopoldsdorf',1175),(1212,'Lilienfeld',1175),(1213,'Loipersdorf',1175),(1214,'Maria Enzersdorf',1175),(1215,'Melk',1175),(1216,'Mistelbach',1175),(1217,'Modling',1175),(1218,'Neulengbach',1175),(1219,'Neunkirchen',1175),(1220,'Niederleis',1175),(1221,'Ober-Grabendorf',1175),(1222,'Perchtoldsdorf',1175),(1223,'Pernitz',1175),(1224,'Pottendorf',1175),(1225,'Poysdorf',1175),(1226,'Pressbaum',1175),(1227,'Purgstall',1175),(1228,'Purkersdorf',1175),(1229,'Reichenau',1175),(1230,'Retz',1175),(1231,'Sankt Andra-Wordern',1175),(1232,'Sankt Peter in der Au',1175),(1233,'Sankt Polten',1175),(1234,'Sankt Valentin',1175),(1235,'Scheibbs',1175),(1236,'Schrems',1175),(1237,'Schwechat',1175),(1238,'Seitenstetten',1175),(1239,'Sollenau',1175),(1240,'Stockerau',1175),(1241,'Strasshof',1175),(1242,'Ternitz',1175),(1243,'Traiskirchen',1175),(1244,'Traismauer',1175),(1245,'Tulln',1175),(1246,'Vosendorf',1175),(1247,'Waidhofen',1175),(1248,'Wiener Neudorf',1175),(1249,'Wiener Neustadt',1175),(1250,'Wieselburg',1175),(1251,'Wilhelmsburg',1175),(1252,'Wolkersdorf',1175),(1253,'Ybbs',1175),(1254,'Ybbsitz',1175),(1255,'Zistersdorf',1175),(1256,'Zwettl',1175),(1257,'Oberosterreich',1127),(1258,'Alkoven',1257),(1259,'Altheim',1257),(1260,'Altmunster',1257),(1261,'Andorf',1257),(1262,'Ansfelden',1257),(1263,'Asten',1257),(1264,'Attnang-Puchheim',1257),(1265,'Aurolzmunster',1257),(1266,'Bad Goisern',1257),(1267,'Bad Hall',1257),(1268,'Bad Ischl',1257),(1269,'Braunau',1257),(1270,'Breitenfurt',1257),(1271,'Ebensee',1257),(1272,'Eferding',1257),(1273,'Engerwitzdorf',1257),(1274,'Enns',1257),(1275,'Feldkirchen an der Donau',1257),(1276,'Frankenburg',1257),(1277,'Freistadt',1257),(1278,'Gallneukirchen',1257),(1279,'Garsten',1257),(1280,'Gmunden',1257),(1281,'Gramastetten',1257),(1282,'Grieskirchen',1257),(1283,'Gunskirchen',1257),(1284,'Horsching',1257),(1285,'Kirchdorf an der Krems',1257),(1286,'Kremsmunster',1257),(1287,'Krenglbach',1257),(1288,'Laakirchen',1257),(1289,'Lenzing',1257),(1290,'Leonding',1257),(1291,'Linz',1257),(1292,'Loibichl',1257),(1293,'Marchtrenk',1257),(1294,'Mattighofen',1257),(1295,'Mauthausen',1257),(1296,'Micheldorf',1257),(1297,'Neuhofen an der Krems',1257),(1298,'Ohlsdorf',1257),(1299,'Ottensheim',1257),(1300,'Pasching',1257),(1301,'Perg',1257),(1302,'Pettenbach',1257),(1303,'Pram',1257),(1304,'Pregarten',1257),(1305,'Puchenau',1257),(1306,'Regau',1257),(1307,'Ried',1257),(1308,'Rohrbach in Oberosterreich',1257),(1309,'Rutzenmoos',1257),(1310,'Sankt Florian',1257),(1311,'Sankt Georgen',1257),(1312,'Sankt Marien',1257),(1313,'Scharding',1257),(1314,'Scharnstein',1257),(1315,'Schwertberg',1257),(1316,'Seewalchen',1257),(1317,'Sierning',1257),(1318,'Stadl-Paura',1257),(1319,'Steyr',1257),(1320,'Steyregg',1257),(1321,'Steyrermuhl',1257),(1322,'Thalheim',1257),(1323,'Timelkam',1257),(1324,'Traun',1257),(1325,'Vocklabruck',1257),(1326,'Vocklamarkt',1257),(1327,'Vorchdorf',1257),(1328,'Wels',1257),(1329,'Wilhering',1257),(1330,'Salzburg',1127),(1331,'Abtenau',1330),(1332,'Anif',1330),(1333,'Bad Gastein',1330),(1334,'Bad Hofgastein',1330),(1335,'Bergheim',1330),(1336,'Bischofshofen',1330),(1337,'Bruck an der GroBglocknerstraB',1330),(1338,'Burmoos',1330),(1339,'Elsbethen',1330),(1340,'Eugendorf',1330),(1341,'Forstau',1330),(1342,'Grodig',1330),(1343,'Hallein',1330),(1344,'Hallwang',1330),(1345,'Henndorf',1330),(1346,'Kuchl',1330),(1347,'Mayrhofen',1330),(1348,'Mittersill',1330),(1349,'Neumarkt',1330),(1350,'Oberndorf',1330),(1351,'Obertrum am See',1330),(1352,'Piesendorf',1330),(1353,'Puch',1330),(1354,'Radstadt',1330),(1355,'Saalfelden',1330),(1356,'Sankt Johann im Pongau',1330),(1357,'Seekirchen',1330),(1358,'Sieghartskirchen',1330),(1359,'StraBwalchen',1330),(1360,'Strobl',1330),(1361,'Tamsweg',1330),(1362,'Thalgau',1330),(1363,'Wals-Siezenheim',1330),(1364,'Wolfgangsee',1330),(1365,'Zell am See',1330),(1366,'Schleswig-Holstein',1127),(1367,'Ahrensbok',1366),(1368,'Ahrensburg',1366),(1369,'Albersdorf',1366),(1370,'Altenholz',1366),(1371,'Alveslohe',1366),(1372,'Ammersbek',1366),(1373,'Bad Bramstedt',1366),(1374,'Bad Oldesloe',1366),(1375,'Bad Schwartau',1366),(1376,'Bad Segeberg',1366),(1377,'Bargteheide',1366),(1378,'Barmstedt',1366),(1379,'Barsbuttel',1366),(1380,'Bredstedt',1366),(1381,'Brunsbuttel',1366),(1382,'Budelsdorf',1366),(1383,'Eckernforde',1366),(1384,'Eddelak',1366),(1385,'Elmshorn',1366),(1386,'Eutin',1366),(1387,'Flensburg',1366),(1388,'Friedrichstadt',1366),(1389,'Geesthacht',1366),(1390,'Glinde',1366),(1391,'Gluckstadt',1366),(1392,'Grob Pampau',1366),(1393,'Halstenbek',1366),(1394,'Hamfelde',1366),(1395,'Harrislee',1366),(1396,'Hartenholm',1366),(1397,'Heide',1366),(1398,'Heiligenhafen',1366),(1399,'Henstedt-Ulzburg',1366),(1400,'Honenwestedt',1366),(1401,'Husum',1366),(1402,'Itzehoe',1366),(1403,'Kaltenkirchen',1366),(1404,'Kappeln',1366),(1405,'Kiel',1366),(1406,'Kronshagen',1366),(1407,'Lauenburg',1366),(1408,'Lensahn',1366),(1409,'Lubeck',1366),(1410,'Malente',1366),(1411,'Mielkendorf',1366),(1412,'Molfsee',1366),(1413,'Molln',1366),(1414,'Neuenbrook',1366),(1415,'Neumunster',1366),(1416,'Neustadt',1366),(1417,'Norderstedt',1366),(1418,'Oldenburg',1366),(1419,'Oststeinbek',1366),(1420,'Pinneberg',1366),(1421,'Plon',1366),(1422,'Preetz',1366),(1423,'Quickborn',1366),(1424,'Ratekau',1366),(1425,'Ratzeburg',1366),(1426,'Reinbek',1366),(1427,'Reinfeld',1366),(1428,'Rellingen',1366),(1429,'Rendsburg',1366),(1430,'Rethwisch',1366),(1431,'Satrup',1366),(1432,'Scharbeutz',1366),(1433,'Schenefeld',1366),(1434,'Schleswig',1366),(1435,'Schmalfeld',1366),(1436,'Schoenkirchen',1366),(1437,'Schwarzenbek',1366),(1438,'Seefeld',1366),(1439,'Sievershutten',1366),(1440,'Stockelsdorf',1366),(1441,'Tangstedt',1366),(1442,'Timmendorfer Strand',1366),(1443,'Tornesch',1366),(1444,'Travemunde',1366),(1445,'Uetersen',1366),(1446,'Wahlstedt',1366),(1447,'Wedel',1366),(1448,'Wentorf',1366),(1449,'Westerland',1366),(1450,'Westerronfeld',1366),(1451,'Wohltorf',1366),(1452,'Wotersen',1366),(1453,'Steiermark',1127),(1454,'Bad Aussee',1453),(1455,'Barnbach',1453),(1456,'Bruck an der Mur',1453),(1457,'Deutschlandsberg',1453),(1458,'Eisenerz',1453),(1459,'Feldbach',1453),(1460,'Feldkirchen bei Graz',1453),(1461,'Fohnsdorf',1453),(1462,'Frohnleiten',1453),(1463,'Furstenfeld',1453),(1464,'Gleisdorf',1453),(1465,'Gratkorn',1453),(1466,'Graz',1453),(1467,'Hartberg',1453),(1468,'Judenburg',1453),(1469,'Judendorf-StraBengel',1453),(1470,'Kapfenberg',1453),(1471,'Karlsdorf',1453),(1472,'Kindberg',1453),(1473,'Knittelfeld',1453),(1474,'Koflach',1453),(1475,'Krieglach',1453),(1476,'Lannach',1453),(1477,'Leibnitz',1453),(1478,'Leoben',1453),(1479,'Murzzuschlag',1453),(1480,'Rottenmann',1453),(1481,'Schladming',1453),(1482,'Seiersberg',1453),(1483,'Spielberg',1453),(1484,'Trofaiach',1453),(1485,'Voitsberg',1453),(1486,'Wagna',1453),(1487,'Weiz',1453),(1488,'Zeltweg',1453),(1489,'Styria',1127),(1490,'Deutschfeistritz',1489),(1491,'Sankt Bartholoma',1489),(1492,'Tirol',1127),(1493,'Absam',1492),(1494,'Axams',1492),(1495,'Ebbs',1492),(1496,'Fugen',1492),(1497,'Hall',1492),(1498,'Haselgehr',1492),(1499,'Hopfgarten',1492),(1500,'Imst',1492),(1501,'Innsbruck',1492),(1502,'Jenbach',1492),(1503,'Kirchberg',1492),(1504,'Kirchbichl',1492),(1505,'Kitzbuhel',1492),(1506,'Kramsach',1492),(1507,'Kufstein',1492),(1508,'Landeck',1492),(1509,'Lienz',1492),(1510,'Matrei',1492),(1511,'Neustift im Stubaital',1492),(1512,'Reutte',1492),(1513,'Rum',1492),(1514,'Sankt Johann in Tirol',1492),(1515,'Scheffau',1492),(1516,'Schwaz',1492),(1517,'St. Johann Am Walde',1492),(1518,'Telfs',1492),(1519,'Vols',1492),(1520,'Vomp',1492),(1521,'Wattens',1492),(1522,'Worgl',1492),(1523,'Zirl',1492),(1524,'Upper Austria',1127),(1525,'Vorarlberg',1127),(1526,'Altach',1525),(1527,'Bludenz',1525),(1528,'Bregenz',1525),(1529,'Chassieu',1525),(1530,'Dietmannsried',1525),(1531,'Dornbirn',1525),(1532,'Feldkirch',1525),(1533,'Frastanz',1525),(1534,'Gotzis',1525),(1535,'Hard',1525),(1536,'Hochst',1525),(1537,'Hohenems',1525),(1538,'Horbranz',1525),(1539,'Hufingen',1525),(1540,'Lauterach',1525),(1541,'Lochau',1525),(1542,'Lustenau',1525),(1543,'Mittelberg',1525),(1544,'Nenzing',1525),(1545,'Nuziders',1525),(1546,'Rankweil',1525),(1547,'Schruns',1525),(1548,'Thuringen',1525),(1549,'Wolfurt',1525),(1550,'Wien',1127),(1551,'Vienna',1550),(1552,'Azerbaijan',NULL),(1553,'Abseron',1552),(1554,'Alat',1553),(1555,'Artyom',1553),(1556,'Baki',1553),(1557,'Bakixanov',1553),(1558,'Balaxani',1553),(1559,'Bilacari',1553),(1560,'Bilqax',1553),(1561,'Bina',1553),(1562,'Buzovna',1553),(1563,'Haci Zeynalabdin',1553),(1564,'Hovsan',1553),(1565,'Lokbatan',1553),(1566,'Mastaga',1553),(1567,'Puta',1553),(1568,'Qarasuxur',1553),(1569,'Qobustan',1553),(1570,'Rasulzada',1553),(1571,'Sabuncu',1553),(1572,'Sanqacal',1553),(1573,'Sumqayit',1553),(1574,'Suraxani',1553),(1575,'Xirdalan',1553),(1576,'Zirya',1553),(1577,'Baki Sahari',1552),(1578,'Ganca',1552),(1579,'Daskasan',1578),(1580,'Xanlar',1578),(1581,'Ganja',1552),(1582,'Kalbacar',1552),(1583,'Cabrayil',1582),(1584,'Lacin',1582),(1585,'Lankaran',1552),(1586,'Astara',1585),(1587,'Goytapa',1585),(1588,'Masalli',1585),(1589,'Neftcala',1585),(1590,'Mil-Qarabax',1552),(1591,'Agcabadi',1590),(1592,'Agdam',1590),(1593,'Barda',1590),(1594,'Mingacevir',1590),(1595,'Tartar',1590),(1596,'Yevlax',1590),(1597,'Mugan-Salyan',1552),(1598,'Ali Bayramli',1597),(1599,'Bilasuvar',1597),(1600,'Calilabad',1597),(1601,'Qarasu',1597),(1602,'Qazimammad',1597),(1603,'Saatli',1597),(1604,'Sabirabad',1597),(1605,'Salyan',1597),(1606,'Nagorni-Qarabax',1552),(1607,'Susa',1606),(1608,'Xankandi',1606),(1609,'Xocavand',1606),(1610,'Naxcivan',1552),(1611,'Culfa',1610),(1612,'Ordubad',1610),(1613,'Sadarak',1610),(1614,'Sarur',1610),(1615,'Priaraks',1552),(1616,'Beylaqan',1615),(1617,'Fuzuli',1615),(1618,'Imisli',1615),(1619,'Qazax',1552),(1620,'Agstafa',1619),(1621,'Gadabay',1619),(1622,'Kovlar',1619),(1623,'Qaracamirli',1619),(1624,'Samkir',1619),(1625,'Tovuz',1619),(1626,'Saki',1552),(1627,'Amircan',1626),(1628,'Balakan',1626),(1629,'Katex',1626),(1630,'Oguz',1626),(1631,'Qabala',1626),(1632,'Qax',1626),(1633,'Zaqatala',1626),(1634,'Sirvan',1552),(1635,'Agdas',1634),(1636,'Agsu',1634),(1637,'Goycay',1634),(1638,'Ismayilli',1634),(1639,'Kurdamir',1634),(1640,'Samaxi',1634),(1641,'Ucar',1634),(1642,'Zardab',1634),(1643,'Xacmaz',1552),(1644,'Davaci',1643),(1645,'Quba',1643),(1646,'Qusar',1643),(1647,'Siyazan',1643),(1648,'Xudat',1643),(1649,'Bahamas The',NULL),(1650,'Abaco',1649),(1651,'Coopers Town',1650),(1652,'Marsh Harbour',1650),(1653,'Acklins Island',1649),(1654,'Andros',1649),(1655,'Andros Town',1654),(1656,'Nicholls Town',1654),(1657,'Berry Islands',1649),(1658,'Biminis',1649),(1659,'Alice Town',1658),(1660,'Cat Island',1649),(1661,'Crooked Island',1649),(1662,'Eleuthera',1649),(1663,'Freetown',1662),(1664,'Rock Sound',1662),(1665,'Exuma and Cays',1649),(1666,'Grand Bahama',1649),(1667,'Inagua Islands',1649),(1668,'Long Island',1649),(1669,'Mayaguana',1649),(1670,'Pirates Well',1669),(1671,'New Providence',1649),(1672,'Ragged Island',1649),(1673,'Rum Cay',1649),(1674,'San Salvador',1649),(1675,'Bahrain',NULL),(1676,'\'Isa',1675),(1677,'al-Manamah',1675),(1678,'al-Muharraq',1675),(1679,'ar-Rifa\'a',1675),(1680,'Badiyah',1675),(1681,'Hidd',1675),(1682,'Jidd Hafs',1675),(1683,'Mahama',1675),(1684,'Manama',1675),(1685,'Sitrah',1675),(1686,'Bangladesh',NULL),(1687,'Bagar Hat',1686),(1688,'Bandarban',1686),(1689,'Barguna',1686),(1690,'Barisal',1686),(1691,'Gaurnadi',1690),(1692,'Mehendiganj',1690),(1693,'Nalchiti',1690),(1694,'Bhola',1686),(1695,'Burhanuddin',1694),(1696,'Char Fasson',1694),(1697,'Lalmohan',1694),(1698,'Bogora',1686),(1699,'Adamighi',1698),(1700,'Sherpur',1698),(1701,'Brahman Bariya',1686),(1702,'Chandpur',1686),(1703,'Hajiganj',1702),(1704,'Chattagam',1686),(1705,'Boalkhali',1704),(1706,'Fatikchhari',1704),(1707,'Lohagara',1704),(1708,'Patiya',1704),(1709,'Rangunia',1704),(1710,'Raozan',1704),(1711,'Sandip',1704),(1712,'Satkaniya',1704),(1713,'Chittagong Division',1686),(1714,'Chuadanga',1686),(1715,'Alamdanga',1714),(1716,'Damurhuda',1714),(1717,'Dhaka',1686),(1718,'Dhamrai',1717),(1719,'Dohar',1717),(1720,'Dinajpur',1686),(1721,'Bochanganj',1720),(1722,'Fulbari',1720),(1723,'Parbatipur',1720),(1724,'Faridpur',1686),(1725,'Bhanga',1724),(1726,'Char Bhadrasan',1724),(1727,'Feni',1686),(1728,'Chhagalnaiya',1727),(1729,'Gaybanda',1686),(1730,'Gazipur',1686),(1731,'Tungi',1730),(1732,'Gopalganj',1686),(1733,'Tungi Para',1732),(1734,'Habiganj',1686),(1735,'Baniachang',1734),(1736,'Jaipur Hat',1686),(1737,'Jamalpur',1686),(1738,'Sarishabari',1737),(1739,'Jessor',1686),(1740,'Abhaynagar',1739),(1741,'Jhikargachha',1739),(1742,'Keshabpur',1739),(1743,'Jhalakati',1686),(1744,'Jhanaydah',1686),(1745,'Kaliganj',1744),(1746,'Kotchandpur',1744),(1747,'Shailkupa',1744),(1748,'Khagrachhari',1686),(1749,'Khagrachari',1748),(1750,'Manikchhari',1748),(1751,'Ramgarh',1748),(1752,'Khulna',1686),(1753,'Phultala',1752),(1754,'Kishorganj',1686),(1755,'Bajitpur',1754),(1756,'Bhairab Bazar',1754),(1757,'Itna',1754),(1758,'Koks Bazar',1686),(1759,'Komilla',1686),(1760,'Laksham',1759),(1761,'Kurigram',1686),(1762,'Chilmari',1761),(1763,'Nageshwari',1761),(1764,'Ulipur',1761),(1765,'Kushtiya',1686),(1766,'Bheramara',1765),(1767,'Lakshmipur',1686),(1768,'Ramganj',1767),(1769,'Ramgati',1767),(1770,'Raypur',1767),(1771,'Lalmanir Hat',1686),(1772,'Madaripur',1686),(1773,'Magura',1686),(1774,'Maimansingh',1686),(1775,'Bhaluka',1774),(1776,'Fulbaria',1774),(1777,'Gafargaon',1774),(1778,'Ishwarganj',1774),(1779,'Muktagachha',1774),(1780,'Trishal',1774),(1781,'Manikganj',1686),(1782,'Maulvi Bazar',1686),(1783,'Meherpur',1686),(1784,'Munshiganj',1686),(1785,'Naral',1686),(1786,'Kalia',1785),(1787,'Narayanganj',1686),(1788,'Rupganj',1787),(1789,'Narsingdi',1686),(1790,'Roypura',1789),(1791,'Nator',1686),(1792,'Gurudaspur',1791),(1793,'Naugaon',1686),(1794,'Nawabganj',1686),(1795,'Gomastapur',1794),(1796,'Shibganj',1794),(1797,'Netrakona',1686),(1798,'Nilphamari',1686),(1799,'Domar',1798),(1800,'Sa\'idpur',1798),(1801,'Noakhali',1686),(1802,'Begamganj',1801),(1803,'Senbagh',1801),(1804,'Pabna',1686),(1805,'Bera',1804),(1806,'Bhangura',1804),(1807,'Ishurdi',1804),(1808,'Panchagarh',1686),(1809,'Patuakhali',1686),(1810,'Pirojpur',1686),(1811,'Bhandaria',1810),(1812,'Mathbaria',1810),(1813,'Nesarabad',1810),(1814,'Rajbari',1686),(1815,'Pangsha',1814),(1816,'Rajshahi',1686),(1817,'Rangamati',1686),(1818,'Kaptai',1817),(1819,'Rangpur',1686),(1820,'Badarganj',1819),(1821,'Kaunia',1819),(1822,'Satkhira',1686),(1823,'Shariatpur',1686),(1824,'Palang',1823),(1825,'Silhat',1686),(1826,'Sirajganj',1686),(1827,'Shahjadpur',1826),(1828,'Sunamganj',1686),(1829,'Chhatak',1828),(1830,'Tangayal',1686),(1831,'Gopalpur',1830),(1832,'Mirzapur',1830),(1833,'Sakhipur',1830),(1834,'Thakurgaon',1686),(1835,'Pirganj',1834),(1836,'Barbados',NULL),(1837,'Christ Church',1836),(1838,'Saint Andrew',1836),(1839,'Saint George',1836),(1840,'Saint James',1836),(1841,'Saint John',1836),(1842,'Saint Joseph',1836),(1843,'Saint Lucy',1836),(1844,'Saint Michael',1836),(1845,'Saint Peter',1836),(1846,'Saint Philip',1836),(1847,'Saint Thomas',1836),(1848,'Belarus',NULL),(1849,'Belgium',NULL),(1850,'Belize',NULL),(1851,'Benin',NULL),(1852,'Bermuda',NULL),(1853,'Bhutan',NULL),(1854,'Bumthang',1853),(1855,'Jakar',1854),(1856,'Chhukha',1853),(1857,'Phuentsholing',1856),(1858,'Chirang',1853),(1859,'Damphu',1858),(1860,'Daga',1853),(1861,'Taga Dzong',1860),(1862,'Geylegphug',1853),(1863,'Ha',1853),(1864,'Lhuntshi',1853),(1865,'Mongar',1853),(1866,'Pemagatsel',1853),(1867,'Punakha',1853),(1868,'Gasa',1867),(1869,'Rinpung',1853),(1870,'Paro',1869),(1871,'Samchi',1853),(1872,'Phuntsholing',1871),(1873,'Samdrup Jongkhar',1853),(1874,'Shemgang',1853),(1875,'Tashigang',1853),(1876,'Timphu',1853),(1877,'Thimphu',1876),(1878,'Tongsa',1853),(1879,'Wangdiphodrang',1853),(1880,'Bolivia',NULL),(1881,'Beni',1880),(1882,'Guayaramerin',1881),(1883,'Magdalena',1881),(1884,'Reyes',1881),(1885,'Riberalta',1881),(1886,'Rurrenabaque',1881),(1887,'San Borja',1881),(1888,'San Ignacio',1881),(1889,'San Ramon',1881),(1890,'Santa Ana',1881),(1891,'Santa Rosa',1881),(1892,'Trinidad',1881),(1893,'Chuquisaca',1880),(1894,'Camargo',1893),(1895,'Monteagudo',1893),(1896,'Muyupampa',1893),(1897,'Padilla',1893),(1898,'Sucre',1893),(1899,'Tarabuco',1893),(1900,'Villa Serano',1893),(1901,'Cochabamba',1880),(1902,'Aiquile',1901),(1903,'Arani',1901),(1904,'Capinota',1901),(1905,'Chimore',1901),(1906,'Cliza',1901),(1907,'Colomi',1901),(1908,'Entre Rios',1901),(1909,'Irpa Irpa',1901),(1910,'Ivirgarzama',1901),(1911,'Mizque',1901),(1912,'Punata',1901),(1913,'Shinahota',1901),(1914,'Sipe Sipe',1901),(1915,'Tarata',1901),(1916,'Ucurena',1901),(1917,'La Paz',1880),(1918,'Oruro',1880),(1919,'Caracollo',1918),(1920,'Challapata',1918),(1921,'Eucaliptus',1918),(1922,'Huanuni',1918),(1923,'Machacamarca',1918),(1924,'Poopo',1918),(1925,'Santiago de Huari',1918),(1926,'Totoral',1918),(1927,'Pando',1880),(1928,'Cobija',1927),(1929,'Potosi',1880),(1930,'Atocha',1929),(1931,'Betanzos',1929),(1932,'Colquechaca',1929),(1933,'Llallagua',1929),(1934,'Santa Barbara',1929),(1935,'Tupiza',1929),(1936,'Uncia',1929),(1937,'Uyuni',1929),(1938,'Villazon',1929),(1939,'Santa Cruz',1880),(1940,'Tarija',1880),(1941,'Bermejo',1940),(1942,'San Lorenzo',1940),(1943,'Villamontes',1940),(1944,'Yacuiba',1940),(1945,'Bosnia and Herzegovina',NULL),(1946,'Federacija Bosna i Hercegovina',1945),(1947,'Republika Srpska',1945),(1948,'Botswana',NULL),(1949,'Central Bobonong',1948),(1950,'Central Boteti',1948),(1951,'Central Mahalapye',1948),(1952,'Central Serowe-Palapye',1948),(1953,'Central Tutume',1948),(1954,'Chobe',1948),(1955,'Kachikau',1954),(1956,'Kasane',1954),(1957,'Kavimba',1954),(1958,'Kazungula',1954),(1959,'Lesoma',1954),(1960,'Muchinje-Mabale',1954),(1961,'Pandamatenga',1954),(1962,'Pandamatenga Botswana Defence ',1954),(1963,'Parakarungu',1954),(1964,'Satau',1954),(1965,'Francistown',1948),(1966,'Gaborone',1948),(1967,'Ghanzi',1948),(1968,'Bere',1967),(1969,'Charles Hill',1967),(1970,'Chobokwane',1967),(1971,'Dekar',1967),(1972,'East Hanahai',1967),(1973,'Groote Laagte',1967),(1974,'Kacgae',1967),(1975,'Karakobis',1967),(1976,'Kuke Quarantine Camp',1967),(1977,'Kule',1967),(1978,'Makunda',1967),(1979,'Ncojane',1967),(1980,'New Xade',1967),(1981,'New Xanagas',1967),(1982,'Qabo',1967),(1983,'Tsootsha',1967),(1984,'West Hanahai',1967),(1985,'Jwaneng',1948),(1986,'Kgalagadi North',1948),(1987,'Kgalagadi South',1948),(1988,'Kgatleng',1948),(1989,'Artisia',1988),(1990,'Bokaa',1988),(1991,'Dikgonye',1988),(1992,'Dikwididi',1988),(1993,'Kgomodiatshaba',1988),(1994,'Khurutshe',1988),(1995,'Leshibitse',1988),(1996,'Mabalane',1988),(1997,'Malolwane',1988),(1998,'Malotwana Siding',1988),(1999,'Matebeleng',1988),(2000,'Mmamashia',1988),(2001,'Mmathubudukwane',1988),(2002,'Mochudi',1988),(2003,'Modipane',1988),(2004,'Morwa',1988),(2005,'Oliphants Drift',1988),(2006,'Oodi',1988),(2007,'Pilane',1988),(2008,'Ramonaka',1988),(2009,'Ramotlabaki',1988),(2010,'Rasesa',1988),(2011,'Sikwane',1988),(2012,'Kweneng',1948),(2013,'Boatlaname',2012),(2014,'Botlhapatlou',2012),(2015,'Diagane',2012),(2016,'Diphudugodu',2012),(2017,'Diremogolo Lands',2012),(2018,'Ditshegwane',2012),(2019,'Ditshukudu',2012),(2020,'Dumadumane',2012),(2021,'Dutlwe',2012),(2022,'Gabane',2012),(2023,'Gakgatla',2012),(2024,'Gakuto',2012),(2025,'Galekgatshwane',2012),(2026,'Gamodubu',2012),(2027,'Gaphatshwa',2012),(2028,'Hatsalatladi',2012),(2029,'Kamenakwe',2012),(2030,'Kaudwane',2012),(2031,'Kgaphamadi',2012),(2032,'Kgope',2012),(2033,'Khekhenya-Chepetese',2012),(2034,'Khudumelapye',2012),(2035,'Kopong',2012),(2036,'Kotolaname',2012),(2037,'Kubung',2012),(2038,'Kumakwane',2012),(2039,'Lentsweletau',2012),(2040,'Lephepe',2012),(2041,'Lesirane',2012),(2042,'Letlhakeng',2012),(2043,'Losilakgokong',2012),(2044,'Maboane',2012),(2045,'Mahetlwe',2012),(2046,'Makabanyane-Dikgokong',2012),(2047,'Malwelwe',2012),(2048,'Mamhiko',2012),(2049,'Manaledi',2012),(2050,'Mantshwabisi',2012),(2051,'Marejwane',2012),(2052,'Masebele',2012),(2053,'Medie',2012),(2054,'Metsibotlhoko',2012),(2055,'Metsimotlhaba',2012),(2056,'Mmakanke',2012),(2057,'Mmankgodi',2012),(2058,'Mmanoko',2012),(2059,'Mmokolodi',2012),(2060,'Mmopane',2012),(2061,'Mmopane Lands',2012),(2062,'Mogoditshane',2012),(2063,'Mogoditshane Botswana Defence ',2012),(2064,'Mogoditshane Lands',2012),(2065,'Mogonono',2012),(2066,'Molepolole',2012),(2067,'Mononyane',2012),(2068,'Monwane',2012),(2069,'Morabane',2012),(2070,'Morope',2012),(2071,'Moshaweng',2012),(2072,'Mosokotswe',2012),(2073,'Motokwe',2012),(2074,'Ngware',2012),(2075,'Nkoyaphiri',2012),(2076,'Ramaphatlhe',2012),(2077,'Salajwe',2012),(2078,'Serinane',2012),(2079,'Sesung',2012),(2080,'Shadishadi',2012),(2081,'Sojwe',2012),(2082,'Sorilatholo',2012),(2083,'Suping',2012),(2084,'Takatokwane',2012),(2085,'Thamaga',2012),(2086,'Thebephatshwa',2012),(2087,'Tlowaneng',2012),(2088,'Tsetseng',2012),(2089,'Tswaane',2012),(2090,'Lobatse',1948),(2091,'Ngamiland',1948),(2092,'Bodibeng',2091),(2093,'Boro',2091),(2094,'Botlhatlogo',2091),(2095,'Chanoga',2091),(2096,'Chuchubega',2091),(2097,'Daonara',2091),(2098,'Ditshiping',2091),(2099,'Habu',2091),(2100,'Jao',2091),(2101,'Kareng',2091),(2102,'Katamaga',2091),(2103,'Kgakge',2091),(2104,'Khwai Camp',2091),(2105,'Komana',2091),(2106,'Legotlhwana',2091),(2107,'Mababe',2091),(2108,'Makalamabedi',2091),(2109,'Matlapana',2091),(2110,'Matsaudi',2091),(2111,'Mawana',2091),(2112,'Mokgalo-Haka',2091),(2113,'Morutsha',2091),(2114,'Nxharaga',2091),(2115,'Phuduhudu',2091),(2116,'Samodupi',2091),(2117,'Sankuyo',2091),(2118,'Sehithwa',2091),(2119,'Semboyo',2091),(2120,'Sexaxa',2091),(2121,'Shakawe',2091),(2122,'Shorobe',2091),(2123,'Somela',2091),(2124,'Toteng',2091),(2125,'Tsanekona',2091),(2126,'Tsao',2091),(2127,'Xaxaba',2091),(2128,'Xhobe',2091),(2129,'Ngwaketse',1948),(2130,'Bethel',2129),(2131,'Borobadilepe',2129),(2132,'Diabo',2129),(2133,'Digawana',2129),(2134,'Dikhukhung',2129),(2135,'Dinatshana',2129),(2136,'Dipotsana',2129),(2137,'Ditlharapa',2129),(2138,'Gamajalela',2129),(2139,'Gasita',2129),(2140,'Gathwane',2129),(2141,'Good Hope',2129),(2142,'Goora-seno',2129),(2143,'Gopong',2129),(2144,'Hebron',2129),(2145,'Itholoke',2129),(2146,'Kanaku',2129),(2147,'Kangwe',2129),(2148,'Kanye',2129),(2149,'Keng',2129),(2150,'Kgomokasitwa',2129),(2151,'Kgoro',2129),(2152,'Khakhea',2129),(2153,'Khonkhwa',2129),(2154,'Kokong',2129),(2155,'Lehoko',2129),(2156,'Lejwana',2129),(2157,'Lekgolobotlo',2129),(2158,'Leporung',2129),(2159,'Logagane',2129),(2160,'Lorolwana',2129),(2161,'Lorwana',2129),(2162,'Lotlhakane',2129),(2163,'Lotlhakane West',2129),(2164,'Mabule',2129),(2165,'Mabutsane',2129),(2166,'Madingwana',2129),(2167,'Magoriapitse',2129),(2168,'Magotlhawane',2129),(2169,'Mahotshwane',2129),(2170,'Maisane',2129),(2171,'Makokwe',2129),(2172,'Malokaganyane',2129),(2173,'Manyana',2129),(2174,'Maokane',2129),(2175,'Marojane',2129),(2176,'Maruswa',2129),(2177,'Metlobo',2129),(2178,'Metlojane',2129),(2179,'Mmakgori',2129),(2180,'Mmathethe',2129),(2181,'Mogojogojo',2129),(2182,'Mogonye',2129),(2183,'Mogwalale',2129),(2184,'Mokatako',2129),(2185,'Mokgomane',2129),(2186,'Mokhomba',2129),(2187,'Molapowabojang',2129),(2188,'Molete',2129),(2189,'Morwamosu',2129),(2190,'Moshaneng',2129),(2191,'Moshupa',2129),(2192,'Motlhwatse',2129),(2193,'Motsentshe',2129),(2194,'Musi',2129),(2195,'Ngwatsau',2129),(2196,'Ntlhantlhe',2129),(2197,'Papatlo',2129),(2198,'Phihitshwane',2129),(2199,'Pitsana-Potokwe',2129),(2200,'Pitsane',2129),(2201,'Pitseng-Ralekgetho',2129),(2202,'Pitshane Molopo',2129),(2203,'Rakhuna',2129),(2204,'Ralekgetho',2129),(2205,'Ramatlabama',2129),(2206,'Ranaka',2129),(2207,'Sedibeng',2129),(2208,'Segakwana',2129),(2209,'Segwagwa',2129),(2210,'Seherelela',2129),(2211,'Sekhutlane',2129),(2212,'Sekoma',2129),(2213,'Selokolela',2129),(2214,'Semane',2129),(2215,'Sese',2129),(2216,'Sheep Farm',2129),(2217,'Tlhankane',2129),(2218,'Tlhareseleele',2129),(2219,'Tshidilamolomo',2129),(2220,'Tshwaane',2129),(2221,'Tsonyane',2129),(2222,'Tswaaneng',2129),(2223,'Tswagare-Lothoje-Lokalana',2129),(2224,'Tswanyaneng',2129),(2225,'North East',1948),(2226,'Okavango',1948),(2227,'Beetsha',2226),(2228,'Eretsha',2226),(2229,'Etsha 1',2226),(2230,'Etsha 13',2226),(2231,'Etsha 6',2226),(2232,'Etsha 8',2226),(2233,'Etsha 9',2226),(2234,'Gane',2226),(2235,'Gonutsuga',2226),(2236,'Gowe',2226),(2237,'Gudingwa',2226),(2238,'Gumare',2226),(2239,'Ikoga',2226),(2240,'Kajaja',2226),(2241,'Kapotora Lands',2226),(2242,'Kauxwhi',2226),(2243,'Matswee',2226),(2244,'Maun',2226),(2245,'Moaha',2226),(2246,'Mohembo East',2226),(2247,'Mohembo West',2226),(2248,'Mokgacha',2226),(2249,'Ngarange',2226),(2250,'Nokaneng',2226),(2251,'Nxamasere',2226),(2252,'Nxaunxau',2226),(2253,'Nxwee',2226),(2254,'Qangwa',2226),(2255,'Roye',2226),(2256,'Samochema',2226),(2257,'Sekondomboro',2226),(2258,'Sepopa',2226),(2259,'Seronga',2226),(2260,'Shaowe',2226),(2261,'Tobere Lands',2226),(2262,'Tubu',2226),(2263,'Tubu Lands',2226),(2264,'Xadau',2226),(2265,'Xakao',2226),(2266,'Xaxa',2226),(2267,'Xhauga',2226),(2268,'Xurube',2226),(2269,'Orapa',1948),(2270,'Selibe Phikwe',1948),(2271,'South East',1948),(2272,'Sowa',1948),(2273,'Bouvet Island',NULL),(2274,'Brazil',NULL),(2275,'Acre',2274),(2276,'Acrelandia',2275),(2277,'Brasileia',2275),(2278,'Cruzeiro do Sul',2275),(2279,'Epitaciolandia',2275),(2280,'Feijo',2275),(2281,'Mancio Lima',2275),(2282,'Manoel Urbano',2275),(2283,'Marechal Thaumaturgo',2275),(2284,'Placido de Castro',2275),(2285,'Porto Walter',2275),(2286,'Rio Branco',2275),(2287,'Rodrigues Alves',2275),(2288,'Sena Madureira',2275),(2289,'Senador Guiomard',2275),(2290,'Tarauaca',2275),(2291,'Xapuri',2275),(2292,'Alagoas',2274),(2293,'Agua Branca',2292),(2294,'Anadia',2292),(2295,'Arapiraca',2292),(2296,'Atalaia',2292),(2297,'Barra de Santo Antonio',2292),(2298,'Batalha',2292),(2299,'Boca da Mata',2292),(2300,'Cacimbinhas',2292),(2301,'Cajueiro',2292),(2302,'Campo Alegre',2292),(2303,'Campo Grande',2292),(2304,'Canapi',2292),(2305,'Capela',2292),(2306,'Coite do Noia',2292),(2307,'Colonia Leopoldina',2292),(2308,'Coruripe',2292),(2309,'Craibas',2292),(2310,'Delmiro Gouveia',2292),(2311,'Dois Riachos',2292),(2312,'Estrela de Alagoas',2292),(2313,'Feira Grande',2292),(2314,'Flexeiras',2292),(2315,'Girau do Ponciano',2292),(2316,'Ibateguara',2292),(2317,'Igaci',2292),(2318,'Igreja Nova',2292),(2319,'Inhapi',2292),(2320,'Joaquim Gomes',2292),(2321,'Jundia',2292),(2322,'Junqueiro',2292),(2323,'Lagoa da Canoa',2292),(2324,'Limoeiro de Anadia',2292),(2325,'Maceio',2292),(2326,'Major Isidoro',2292),(2327,'Maragogi',2292),(2328,'Maravilha',2292),(2329,'Marechal Deodoro',2292),(2330,'Maribondo',2292),(2331,'Mata Grande',2292),(2332,'Matriz de Camaragibe',2292),(2333,'Messias',2292),(2334,'Minador do Negrao',2292),(2335,'Murici',2292),(2336,'Novo Lino',2292),(2337,'Olho d\'Agua das Flores',2292),(2338,'Olivenca',2292),(2339,'Palmeira dos Indios',2292),(2340,'Pao de Acucar',2292),(2341,'Passo de Camaragibe',2292),(2342,'Penedo',2292),(2343,'Piacabucu',2292),(2344,'Pilar',2292),(2345,'Piranhas',2292),(2346,'Poco das Trincheiras',2292),(2347,'Porto Calvo',2292),(2348,'Porto Real do Colegio',2292),(2349,'Quebrangulo',2292),(2350,'Rio Largo',2292),(2351,'Santana do Ipanema',2292),(2352,'Santana do Mundau',2292),(2353,'Sao Jose da Laje',2292),(2354,'Sao Jose da Tapera',2292),(2355,'Sao Luis do Quitunde',2292),(2356,'Sao Miguel dos Campos',2292),(2357,'Sao Sebastiao',2292),(2358,'Satuba',2292),(2359,'Senador Rui Palmeira',2292),(2360,'Taquarana',2292),(2361,'Teotonio Vilela',2292),(2362,'Traipu',2292),(2363,'Uniao dos Palmares',2292),(2364,'Vicosa',2292),(2365,'Amapa',2274),(2366,'Laranjal do Jari',2365),(2367,'Macapa',2365),(2368,'Mazagao',2365),(2369,'Oiapoque',2365),(2370,'Santana',2365),(2371,'Amazonas',2274),(2372,'Alvaraes',2371),(2373,'Anori',2371),(2374,'Apui',2371),(2375,'Autazes',2371),(2376,'Bagua Grande',2371),(2377,'Barcelos',2371),(2378,'Barreirinha',2371),(2379,'Benjamin Constant',2371),(2380,'Boca do Acre',2371),(2381,'Borba',2371),(2382,'Cajaruro',2371),(2383,'Canutama',2371),(2384,'Carauari',2371),(2385,'Careiro',2371),(2386,'Careiro da Varzea',2371),(2387,'Chachapoyas',2371),(2388,'Coari',2371),(2389,'Codajas',2371),(2390,'Eirunepe',2371),(2391,'Envira',2371),(2392,'Fonte Boa',2371),(2393,'Guajara',2371),(2394,'Humaita',2371),(2395,'Ipixuna',2371),(2396,'Iranduba',2371),(2397,'Itacoatiara',2371),(2398,'Japura',2371),(2399,'Jazan',2371),(2400,'Jutai',2371),(2401,'La Peca',2371),(2402,'Labrea',2371),(2403,'Leticia',2371),(2404,'Manacapuru',2371),(2405,'Manaquiri',2371),(2406,'Manaus',2371),(2407,'Manicore',2371),(2408,'Maraa',2371),(2409,'Maues',2371),(2410,'Nhamunda',2371),(2411,'Nova Olinda do Norte',2371),(2412,'Novo Airao',2371),(2413,'Novo Aripuana',2371),(2414,'Parintins',2371),(2415,'Pauini',2371),(2416,'Puerto Ayacucho',2371),(2417,'Puerto Narino',2371),(2418,'Rio Preto da Eva',2371),(2419,'Santa Isabel do Rio Negro',2371),(2420,'Santo Antonio do Ica',2371),(2421,'Sao Gabriel da Cachoeira',2371),(2422,'Sao Paulo de Olivenca',2371),(2423,'Tabatinga',2371),(2424,'Tapaua',2371),(2425,'Tefe',2371),(2426,'Tonantins',2371),(2427,'Uarini',2371),(2428,'Urucara',2371),(2429,'Urucurituba',2371),(2430,'Bahia',2274),(2431,'Acajutiba',2430),(2432,'Alagoinhas',2430),(2433,'Amargosa',2430),(2434,'Amelia Rodrigues',2430),(2435,'America Dourada',2430),(2436,'Anage',2430),(2437,'Araci',2430),(2438,'Aurelino Leal',2430),(2439,'Baixa Grande',2430),(2440,'Barra',2430),(2441,'Barra da Estiva',2430),(2442,'Barra do Choca',2430),(2443,'Barreiras',2430),(2444,'Belmonte',2430),(2445,'Boa Vista do Tupim',2430),(2446,'Bom Jesus da Lapa',2430),(2447,'Boquira',2430),(2448,'Brumado',2430),(2449,'Buerarema',2430),(2450,'Cachoeira',2430),(2451,'Cacule',2430),(2452,'Caetite',2430),(2453,'Cafarnaum',2430),(2454,'Camacan',2430),(2455,'Camacari',2430),(2456,'Camamu',2430),(2457,'Campo Alegre de Lourdes',2430),(2458,'Campo Formoso',2430),(2459,'Canarana',2430),(2460,'Canavieiras',2430),(2461,'Candeias',2430),(2462,'Candido Sales',2430),(2463,'Cansancao',2430),(2464,'Capim Grosso',2430),(2465,'Caravelas',2430),(2466,'Carinhanha',2430),(2467,'Casa Nova',2430),(2468,'Castro Alves',2430),(2469,'Catu',2430),(2470,'Cicero Dantas',2430),(2471,'Cipo',2430),(2472,'Coaraci',2430),(2473,'Conceicao da Feira',2430),(2474,'Conceicao do Almeida',2430),(2475,'Conceicao do Coite',2430),(2476,'Conceicao do Jacuipe',2430),(2477,'Conde',2430),(2478,'Coracao de Maria',2430),(2479,'Coronel Joao Sa',2430),(2480,'Correntina',2430),(2481,'Cruz das Almas',2430),(2482,'Curaca',2430),(2483,'Dias d\'Avila',2430),(2484,'Encruzilhada',2430),(2485,'Esplanada',2430),(2486,'Euclides da Cunha',2430),(2487,'Eunapolis',2430),(2488,'Feira de Santana',2430),(2489,'Filadelfia',2430),(2490,'Formosa do Rio Preto',2430),(2491,'Gandu',2430),(2492,'Guanambi',2430),(2493,'Guaratinga',2430),(2494,'Iacu',2430),(2495,'Ibicarai',2430),(2496,'Ibicui',2430),(2497,'Ibipeba',2430),(2498,'Ibirapitanga',2430),(2499,'Ibirataia',2430),(2500,'Ibotirama',2430),(2501,'Iguai',2430),(2502,'Ilheus',2430),(2503,'Inhambupe',2430),(2504,'Ipiau',2430),(2505,'Ipira',2430),(2506,'Iraquara',2430),(2507,'Irara',2430),(2508,'Irece',2430),(2509,'Itabela',2430),(2510,'Itaberaba',2430),(2511,'Itabuna',2430),(2512,'Itacare',2430),(2513,'Itagi',2430),(2514,'Itagiba',2430),(2515,'Itajuipe',2430),(2516,'Itamaraju',2430),(2517,'Itambe',2430),(2518,'Itanhem',2430),(2519,'Itaparica',2430),(2520,'Itapetinga',2430),(2521,'Itapicuru',2430),(2522,'Itarantim',2430),(2523,'Itirucu',2430),(2524,'Itiuba',2430),(2525,'Itororo',2430),(2526,'Ituacu',2430),(2527,'Itubera',2430),(2528,'Jacobina',2430),(2529,'Jaguaquara',2430),(2530,'Jaguarari',2430),(2531,'Jequie',2430),(2532,'Jeremoabo',2430),(2533,'Jitauna',2430),(2534,'Joao Dourado',2430),(2535,'Juazeiro',2430),(2536,'Jussara',2430),(2537,'Laje',2430),(2538,'Lapao',2430),(2539,'Lauro de Freitas',2430),(2540,'Livramento',2430),(2541,'Macarani',2430),(2542,'Macaubas',2430),(2543,'Madre de Deus',2430),(2544,'Mairi',2430),(2545,'Maracas',2430),(2546,'Maragogipe',2430),(2547,'Marau',2430),(2548,'Mascote',2430),(2549,'Mata de Sao Joao',2430),(2550,'Medeiros Neto',2430),(2551,'Miguel Calmon',2430),(2552,'Milagres',2430),(2553,'Monte Santo',2430),(2554,'Morro de Chapeu',2430),(2555,'Mucuri',2430),(2556,'Mundo Novo',2430),(2557,'Muritiba',2430),(2558,'Mutuipe',2430),(2559,'Nazare',2430),(2560,'Nova Soure',2430),(2561,'Nova Vicosa',2430),(2562,'Olindina',2430),(2563,'Oliveira dos Brejinhos',2430),(2564,'Palmas de Monte Alto',2430),(2565,'Paramirim',2430),(2566,'Paratinga',2430),(2567,'Paripiranga',2430),(2568,'Pau Brasil',2430),(2569,'Paulo Afonso',2430),(2570,'Pilao Arcado',2430),(2571,'Pindobacu',2430),(2572,'Piritiba',2430),(2573,'Planalto',2430),(2574,'Pocoes',2430),(2575,'Pojuca',2430),(2576,'Ponto Novo',2430),(2577,'Porto Seguro',2430),(2578,'Prado',2430),(2579,'Presidente Tancredo Neves',2430),(2580,'Queimadas',2430),(2581,'Quijingue',2430),(2582,'Rafael Jambeiro',2430),(2583,'Remanso',2430),(2584,'Riachao das Neves',2430),(2585,'Riachao do Jacuipe',2430),(2586,'Riacho de Santana',2430),(2587,'Ribeira do Pombal',2430),(2588,'Rio Real',2430),(2589,'Ruy Barbosa',2430),(2590,'Salvador',2430),(2591,'Santa Cruz Cabralia',2430),(2592,'Santa Ines',2430),(2593,'Santa Maria da Vitoria',2430),(2594,'Santa Rita de Cassia',2430),(2595,'Santaluz',2430),(2596,'Santo Amaro',2430),(2597,'Santo Antonio de Jesus',2430),(2598,'Santo Estevao',2430),(2599,'Sao Desiderio',2430),(2600,'Sao Felipe',2430),(2601,'Sao Francisco do Conde',2430),(2602,'Sao Gabriel',2430),(2603,'Sao Goncalo dos Campos',2430),(2604,'Sao Sebastiao do Passe',2430),(2605,'Saubara',2430),(2606,'Seabra',2430),(2607,'Senhor do Bonfim',2430),(2608,'Sento Se',2430),(2609,'Serra do Ramalho',2430),(2610,'Serra Dourada',2430),(2611,'Serrinha',2430),(2612,'Simoes Filho',2430),(2613,'Sobradinho',2430),(2614,'Souto Soares',2430),(2615,'Tanhacu',2430),(2616,'Taperoa',2430),(2617,'Tapiramuta',2430),(2618,'Teixeira de Freitas',2430),(2619,'Teofilandia',2430),(2620,'Terra Nova',2430),(2621,'Tremedal',2430),(2622,'Tucano',2430),(2623,'Uaua',2430),(2624,'Ubaira',2430),(2625,'Ubaitaba',2430),(2626,'Ubata',2430),(2627,'Una',2430),(2628,'Urucuca',2430),(2629,'Utinga',2430),(2630,'Valenca',2430),(2631,'Valente',2430),(2632,'Vera Cruz',2430),(2633,'Vitoria da Conquista',2430),(2634,'Wenceslau Guimaraes',2430),(2635,'Xique-Xique',2430),(2636,'Ceara',2274),(2637,'Acarau',2636),(2638,'Acopiara',2636),(2639,'Amontada',2636),(2640,'Aquiraz',2636),(2641,'Aracati',2636),(2642,'Aracoiaba',2636),(2643,'Araripe',2636),(2644,'Assare',2636),(2645,'Aurora',2636),(2646,'Barbalha',2636),(2647,'Barro',2636),(2648,'Barroquinha',2636),(2649,'Baturite',2636),(2650,'Beberibe',2636),(2651,'Bela Cruz',2636),(2652,'Boa Viagem',2636),(2653,'Brejo Santo',2636),(2654,'Camocim',2636),(2655,'Campos Sales',2636),(2656,'Caninde',2636),(2657,'Carire',2636),(2658,'Caririacu',2636),(2659,'Cascavel',2636),(2660,'Caucaia',2636),(2661,'Cedro',2636),(2662,'Chorozinho',2636),(2663,'Coreau',2636),(2664,'Crateus',2636),(2665,'Crato',2636),(2666,'Cruz',2636),(2667,'Eusebio',2636),(2668,'Farias Brito',2636),(2669,'Forquilha',2636),(2670,'Fortaleza',2636),(2671,'Granja',2636),(2672,'Guaiuba',2636),(2673,'Guaraciaba do Norte',2636),(2674,'Hidrolandia',2636),(2675,'Horizonte',2636),(2676,'Ibiapina',2636),(2677,'Ico',2636),(2678,'Iguatu',2636),(2679,'Independencia',2636),(2680,'Ipu',2636),(2681,'Ipueiras',2636),(2682,'Iraucuba',2636),(2683,'Itaitinga',2636),(2684,'Itapage',2636),(2685,'Itapipoca',2636),(2686,'Itarema',2636),(2687,'Jaguaribe',2636),(2688,'Jaguaruana',2636),(2689,'Jardim',2636),(2690,'Juazeiro do Norte',2636),(2691,'Jucas',2636),(2692,'Lavras da Mangabeira',2636),(2693,'Limoeiro do Norte',2636),(2694,'Maracanau',2636),(2695,'Maranguape',2636),(2696,'Marco',2636),(2697,'Massape',2636),(2698,'Mauriti',2636),(2699,'Missao Velha',2636),(2700,'Mombaca',2636),(2701,'Morada Nova',2636),(2702,'Nova Russas',2636),(2703,'Novo Oriente',2636),(2704,'Ocara',2636),(2705,'Oros',2636),(2706,'Pacajus',2636),(2707,'Pacatuba',2636),(2708,'Paracuru',2636),(2709,'Paraipaba',2636),(2710,'Parambu',2636),(2711,'Pedra Branca',2636),(2712,'Pentecoste',2636),(2713,'Quixada',2636),(2714,'Quixeramobim',2636),(2715,'Quixere',2636),(2716,'Redencao',2636),(2717,'Reriutaba',2636),(2718,'Russas',2636),(2719,'Santa Quiteria',2636),(2720,'Santana do Acarau',2636),(2721,'Sao Benedito',2636),(2722,'Sao Goncalo do Amarante',2636),(2723,'Senador Pompeu',2636),(2724,'Sobral',2636),(2725,'Tabuleiro do Norte',2636),(2726,'Tamboril',2636),(2727,'Taua',2636),(2728,'Tiangua',2636),(2729,'Trairi',2636),(2730,'Ubajara',2636),(2731,'Umirim',2636),(2732,'Uruburetama',2636),(2733,'Varjota',2636),(2734,'Varzea Alegre',2636),(2735,'Vicosa do Ceara',2636),(2736,'Distrito Federal',2274),(2737,'Espirito Santo',2274),(2738,'Estado de Sao Paulo',2274),(2739,'Goias',2274),(2740,'Abadiania',2739),(2741,'Acreuna',2739),(2742,'Aguas Lindas de Goias',2739),(2743,'Alexania',2739),(2744,'Anapolis',2739),(2745,'Anicuns',2739),(2746,'Aparecida de Goiania',2739),(2747,'Aragarcas',2739),(2748,'Bela Vista de Goias',2739),(2749,'Bom Jesus de Goias',2739),(2750,'Buriti Alegre',2739),(2751,'Cacu',2739),(2752,'Caiaponia',2739),(2753,'Caldas Novas',2739),(2754,'Campos Belos',2739),(2755,'Campos Verdes',2739),(2756,'Carmo do Rio Verde',2739),(2757,'Catalao',2739),(2758,'Cavalcante',2739),(2759,'Ceres',2739),(2760,'Cidade Ocidental',2739),(2761,'Cocalzinho de Coias',2739),(2762,'Cristalina',2739),(2763,'Crixas',2739),(2764,'Doverlandia',2739),(2765,'Edeia',2739),(2766,'Firminopolis',2739),(2767,'Formosa',2739),(2768,'Goianapolis',2739),(2769,'Goianesia',2739),(2770,'Goiania',2739),(2771,'Goianira',2739),(2772,'Goiatuba',2739),(2773,'Guapo',2739),(2774,'Iaciara',2739),(2775,'Indiara',2739),(2776,'Inhumas',2739),(2777,'Ipameri',2739),(2778,'Ipora',2739),(2779,'Itaberai',2739),(2780,'Itapaci',2739),(2781,'Itapirapua',2739),(2782,'Itapuranga',2739),(2783,'Itumbiara',2739),(2784,'Jaragua',2739),(2785,'Jatai',2739),(2786,'Luziania',2739),(2787,'Mara Rosa',2739),(2788,'Minacu',2739),(2789,'Mineiros',2739),(2790,'Morrinhos',2739),(2791,'Mozarlandia',2739),(2792,'Neropolis',2739),(2793,'Niquelandia',2739),(2794,'Nova Crixas',2739),(2795,'Novo Gama',2739),(2796,'Orizona',2739),(2797,'Padre Bernardo',2739),(2798,'Palmeiras de Goias',2739),(2799,'Parauna',2739),(2800,'Petrolina de Goias',2739),(2801,'Piracanjuba',2739),(2802,'Pirenopolis',2739),(2803,'Pires do Rio',2739),(2804,'Planaltina',2739),(2805,'Pontalina',2739),(2806,'Porangatu',2739),(2807,'Posse',2739),(2808,'Quirinopolis',2739),(2809,'Rialma',2739),(2810,'Rio Verde',2739),(2811,'Rubiataba',2739),(2812,'Santa Helena de Goias',2739),(2813,'Santa Terezinha de Goias',2739),(2814,'Santo Antonio do Descoberto',2739),(2815,'Sao Domingos',2739),(2816,'Sao Luis de Montes Belos',2739),(2817,'Sao Miguel do Araguaia',2739),(2818,'Sao Simao',2739),(2819,'Senador Canedo',2739),(2820,'Silvania',2739),(2821,'Trindade',2739),(2822,'Uruacu',2739),(2823,'Uruana',2739),(2824,'Valparaiso de Goias',2739),(2825,'Vianopolis',2739),(2826,'Maranhao',2274),(2827,'Acailandia',2826),(2828,'Alcantara',2826),(2829,'Aldeias Altas',2826),(2830,'Alto Alegre do Pindare',2826),(2831,'Amarante do Maranhao',2826),(2832,'Anajatuba',2826),(2833,'Araioses',2826),(2834,'Arame',2826),(2835,'Arari',2826),(2836,'Bacabal',2826),(2837,'Balsas',2826),(2838,'Barra do Corda',2826),(2839,'Barreirinhas',2826),(2840,'Bequimao',2826),(2841,'Bom Jardim',2826),(2842,'Brejo',2826),(2843,'Buriti',2826),(2844,'Buriti Bravo',2826),(2845,'Buriticupu',2826),(2846,'Candido Mendes',2826),(2847,'Cantanhede',2826),(2848,'Carolina',2826),(2849,'Carutapera',2826),(2850,'Caxias',2826),(2851,'Chapadinha',2826),(2852,'Codo',2826),(2853,'Coelho Neto',2826),(2854,'Colinas',2826),(2855,'Coroata',2826),(2856,'Cururupu',2826),(2857,'Davinopolis',2826),(2858,'Dom Pedro',2826),(2859,'Esperantinopolis',2826),(2860,'Estreito',2826),(2861,'Fortuna',2826),(2862,'Godofredo Viana',2826),(2863,'Governador Eugenio Barros',2826),(2864,'Governador Nunes Freire',2826),(2865,'Grajau',2826),(2866,'Humberto de Campos',2826),(2867,'Icatu',2826),(2868,'Imperatriz',2826),(2869,'Itapecuru Mirim',2826),(2870,'Itinga do Maranhao',2826),(2871,'Joao Lisboa',2826),(2872,'Lago da Pedra',2826),(2873,'Lago do Junco',2826),(2874,'Maracacume',2826),(2875,'Matinha',2826),(2876,'Matoes',2826),(2877,'Mirador',2826),(2878,'Miranda do Norte',2826),(2879,'Moncao',2826),(2880,'Montes Altos',2826),(2881,'Morros',2826),(2882,'Nova Olinda do Maranhao',2826),(2883,'Olho d\'Agua das Cunhas',2826),(2884,'Paco do Lumiar',2826),(2885,'Paraibano',2826),(2886,'Parnarama',2826),(2887,'Passagem Franca',2826),(2888,'Pastos Bons',2826),(2889,'Paulo Ramos',2826),(2890,'Pedreiras',2826),(2891,'Penalva',2826),(2892,'Pindare Mirim',2826),(2893,'Pinheiro',2826),(2894,'Pio XII',2826),(2895,'Pirapemas',2826),(2896,'Pocao de Pedras',2826),(2897,'Porto Franco',2826),(2898,'Presidente Dutra',2826),(2899,'Raposa',2826),(2900,'Riachao',2826),(2901,'Rosario',2826),(2902,'Santa Helena',2826),(2903,'Santa Luzia',2826),(2904,'Santa Luzia do Parua',2826),(2905,'Santa Quiteria do Maranhao',2826),(2906,'Santa Rita',2826),(2907,'Sao Benedito do Rio Preto',2826),(2908,'Sao Bento',2826),(2909,'Sao Bernardo',2826),(2910,'Sao Domingos do Maranhao',2826),(2911,'Sao Joao Batista',2826),(2912,'Sao Joao dos Patos',2826),(2913,'Sao Jose de Ribamar',2826),(2914,'Sao Luis',2826),(2915,'Sao Luis Gonzaga do Maranhao',2826),(2916,'Sao Mateus do Maranhao',2826),(2917,'Sao Pedro da Agua Branca',2826),(2918,'Sao Raimundo das Mangabeiras',2826),(2919,'Timbiras',2826),(2920,'Timon',2826),(2921,'Trizidela do Vale',2826),(2922,'Tuntum',2826),(2923,'Turiacu',2826),(2924,'Tutoia',2826),(2925,'Urbano Santos',2826),(2926,'Vargem Grande',2826),(2927,'Viana',2826),(2928,'Vitoria do Mearim',2826),(2929,'Vitorino Freire',2826),(2930,'Ze Doca',2826),(2931,'Mato Grosso',2274),(2932,'Mato Grosso do Sul',2274),(2933,'Minas Gerais',2274),(2934,'Para',2274),(2935,'Abaetetuba',2934),(2936,'Acara',2934),(2937,'Afua',2934),(2938,'Agua Azul do Norte',2934),(2939,'Alenquer',2934),(2940,'Almeirim',2934),(2941,'Altamira',2934),(2942,'Ananindeua',2934),(2943,'Augusto Correa',2934),(2944,'Baiao',2934),(2945,'Barcarena',2934),(2946,'Belem',2934),(2947,'Benevides',2934),(2948,'Braganca',2934),(2949,'Breu Branco',2934),(2950,'Breves',2934),(2951,'Bujaru',2934),(2952,'Cameta',2934),(2953,'Capanema',2934),(2954,'Capitao Poco',2934),(2955,'Castanhal',2934),(2956,'Conceicao do Araguaia',2934),(2957,'Concordia do Para',2934),(2958,'Curionopolis',2934),(2959,'Curuca',2934),(2960,'Dom Eliseu',2934),(2961,'Eldorado dos Carajas',2934),(2962,'Garrafao do Norte',2934),(2963,'Goianesia do Para',2934),(2964,'Gurupa',2934),(2965,'Igarape-Acu',2934),(2966,'Igarape-Miri',2934),(2967,'Irituia',2934),(2968,'Itaituba',2934),(2969,'Itupiranga',2934),(2970,'Jacareacanga',2934),(2971,'Jacunda',2934),(2972,'Juruti',2934),(2973,'Limoeiro do Ajuru',2934),(2974,'Mae do Rio',2934),(2975,'Maraba',2934),(2976,'Maracana',2934),(2977,'Marapanim',2934),(2978,'Marituba',2934),(2979,'Medicilandia',2934),(2980,'Mocajuba',2934),(2981,'Moju',2934),(2982,'Monte Alegre',2934),(2983,'Muana',2934),(2984,'Novo Progresso',2934),(2985,'Novo Repartimento',2934),(2986,'Obidos',2934),(2987,'Oeiras do Para',2934),(2988,'Onverwacht',2934),(2989,'Oriximina',2934),(2990,'Ourem',2934),(2991,'Ourilandia',2934),(2992,'Pacaja',2934),(2993,'Paragominas',2934),(2994,'Parauapebas',2934),(2995,'Portel',2934),(2996,'Porto de Moz',2934),(2997,'Prainha',2934),(2998,'Rio Maria',2934),(2999,'Rondon do Para',2934),(3000,'Ruropolis',2934),(3001,'Salinopolis',2934),(3002,'Santa Isabel do Para',2934),(3003,'Santa Luzia do Para',2934),(3004,'Santa Maria do Para',2934),(3005,'Santana do Araguaia',2934),(3006,'Santarem',2934),(3007,'Santo Antonio do Taua',2934),(3008,'Sao Caetano de Odivelas',2934),(3009,'Sao Domingos do Araguaia',2934),(3010,'Sao Domingos do Capim',2934),(3011,'Sao Felix do Xingu',2934),(3012,'Sao Geraldo do Araguaia',2934),(3013,'Sao Joao de Pirabas',2934),(3014,'Sao Miguel do Guama',2934),(3015,'Senador Jose Porfirio',2934),(3016,'Soure',2934),(3017,'Tailandia',2934),(3018,'Terra Santa',2934),(3019,'Tome-Acu',2934),(3020,'Tucuma',2934),(3021,'Tucurui',2934),(3022,'Ulianopolis',2934),(3023,'Uruara',2934),(3024,'Vigia',2934),(3025,'Viseu',2934),(3026,'Xinguara',2934),(3027,'Paraiba',2274),(3028,'Alagoa Grande',3027),(3029,'Alagoa Nova',3027),(3030,'Alagoinha',3027),(3031,'Alhandra',3027),(3032,'Aracagi',3027),(3033,'Arara',3027),(3034,'Araruna',3027),(3035,'Areia',3027),(3036,'Aroeiras',3027),(3037,'Bananeiras',3027),(3038,'Barra de Santa Rosa',3027),(3039,'Bayeux',3027),(3040,'Boqueirao',3027),(3041,'Brejo do Cruz',3027),(3042,'Caapora',3027),(3043,'Cabedelo',3027),(3044,'Cacimba de Dentro',3027),(3045,'Cajazeiras',3027),(3046,'Campina Grande',3027),(3047,'Catole do Rocha',3027),(3048,'Conceicao',3027),(3049,'Coremas',3027),(3050,'Cruz do Espirito Santo',3027),(3051,'Cuite',3027),(3052,'Desterro',3027),(3053,'Dona Ines',3027),(3054,'Esperanca',3027),(3055,'Fagundes',3027),(3056,'Guarabira',3027),(3057,'Gurinhem',3027),(3058,'Imaculada',3027),(3059,'Inga',3027),(3060,'Itabaiana',3027),(3061,'Itaporanga',3027),(3062,'Itapororoca',3027),(3063,'Itatuba',3027),(3064,'Jacarau',3027),(3065,'Joao Pessoa',3027),(3066,'Juazeirinho',3027),(3067,'Juripiranga',3027),(3068,'Juru',3027),(3069,'Lagoa Seca',3027),(3070,'Mamanguape',3027),(3071,'Manaira',3027),(3072,'Mari',3027),(3073,'Massaranduba',3027),(3074,'Mogeiro',3027),(3075,'Monteiro',3027),(3076,'Mulungu',3027),(3077,'Natuba',3027),(3078,'Nova Floresta',3027),(3079,'Patos',3027),(3080,'Paulista',3027),(3081,'Pedras de Fogo',3027),(3082,'Pianco',3027),(3083,'Picui',3027),(3084,'Pirpirituba',3027),(3085,'Pitimbu',3027),(3086,'Pocinhos',3027),(3087,'Pombal',3027),(3088,'Princesa Isabel',3027),(3089,'Puxinana',3027),(3090,'Remigio',3027),(3091,'Rio Tinto',3027),(3092,'Salgado de Sao Felix',3027),(3093,'Sao Joao do Rio do Peixe',3027),(3094,'Sao Jose de Piranhas',3027),(3095,'Sao Sebastiao de Lagoa de Roca',3027),(3096,'Sape',3027),(3097,'Serra Branca',3027),(3098,'Solanea',3027),(3099,'Soledade',3027),(3100,'Sousa',3027),(3101,'Sume',3027),(3102,'Tavares',3027),(3103,'Teixeira',3027),(3104,'Triunfo',3027),(3105,'Uirauna',3027),(3106,'Umbuzeiro',3027),(3107,'Parana',2274),(3108,'Almirante Tamandare',3107),(3109,'Alto Parana',3107),(3110,'Alto Piquiri',3107),(3111,'Altonia',3107),(3112,'Ampere',3107),(3113,'Andira',3107),(3114,'Antonina',3107),(3115,'Apucarana',3107),(3116,'Arapongas',3107),(3117,'Arapoti',3107),(3118,'Araucaria',3107),(3119,'Assai',3107),(3120,'Assis Chateaubriand',3107),(3121,'Astorga',3107),(3122,'Bandeirantes',3107),(3123,'Barbosa Ferraz',3107),(3124,'Bela Vista do Paraiso',3107),(3125,'Cambara',3107),(3126,'Cambe',3107),(3127,'Campina da Lagoa',3107),(3128,'Campina Grande do Sul',3107),(3129,'Campo Largo',3107),(3130,'Campo Murao',3107),(3131,'Candido de Abreu',3107),(3132,'Capitao Leonidas Marques',3107),(3133,'Carambei',3107),(3134,'Castro',3107),(3135,'Centenario do Sul',3107),(3136,'Chopinzinho',3107),(3137,'Cianorte',3107),(3138,'Clevelandia',3107),(3139,'Colombo',3107),(3140,'Colorado',3107),(3141,'Contenda',3107),(3142,'Corbelia',3107),(3143,'Cornelio Procopio',3107),(3144,'Coronel Vivida',3107),(3145,'Cruzeiro do Oeste',3107),(3146,'Curitiba',3107),(3147,'Dois Vizinhos',3107),(3148,'Engenheiro Beltrao',3107),(3149,'Faxinal',3107),(3150,'Fazenda Rio Grande',3107),(3151,'Florestopolis',3107),(3152,'Foz do Iguacu',3107),(3153,'Francisco Beltrao',3107),(3154,'Goioere',3107),(3155,'Guaira',3107),(3156,'Guaraniacu',3107),(3157,'Guarapuava',3107),(3158,'Guaratuba',3107),(3159,'Ibaiti',3107),(3160,'Ibipora',3107),(3161,'Imbituva',3107),(3162,'Irati',3107),(3163,'Itaperucu',3107),(3164,'Ivaipora',3107),(3165,'Jacarezinho',3107),(3166,'Jaguariaiva',3107),(3167,'Jandaia do Sul',3107),(3168,'Jataizinho',3107),(3169,'Lapa',3107),(3170,'Laranjeiras do Sul',3107),(3171,'Loanda',3107),(3172,'Londrina',3107),(3173,'Mandaguacu',3107),(3174,'Mandaguari',3107),(3175,'Marechal Candido Rondon',3107),(3176,'Marialva',3107),(3177,'Maringa',3107),(3178,'Matelandia',3107),(3179,'Matinhos',3107),(3180,'Medianeira',3107),(3181,'Moreira Sales',3107),(3182,'Nova Aurora',3107),(3183,'Nova Esperanca',3107),(3184,'Nova Londrina',3107),(3185,'Ortigueira',3107),(3186,'Paicandu',3107),(3187,'Palmas',3107),(3188,'Palmeira',3107),(3189,'Palotina',3107),(3190,'Paranagua',3107),(3191,'Paranavai',3107),(3192,'Pato Branco',3107),(3193,'Peabiru',3107),(3194,'Pinhais',3107),(3195,'Pinhao',3107),(3196,'Pirai do Sul',3107),(3197,'Piraquara',3107),(3198,'Pitanga',3107),(3199,'Ponta Grossa',3107),(3200,'Pontal do Parana',3107),(3201,'Porecatu',3107),(3202,'Primero de Maio',3107),(3203,'Prudentopolis',3107),(3204,'Quatro Barras',3107),(3205,'Quedas do Iguacu',3107),(3206,'Realeza',3107),(3207,'Reserva',3107),(3208,'Ribeirao do Pinhal',3107),(3209,'Rio Branco do Sul',3107),(3210,'Rio Negro',3107),(3211,'Rolandia',3107),(3212,'Santa Terezinha de Itaipu',3107),(3213,'Santo Antonio da Platina',3107),(3214,'Santo Antonio do Sudoeste',3107),(3215,'Sao Joao do Ivai',3107),(3216,'Sao Jose dos Pinhais',3107),(3217,'Sao Mateus do Sul',3107),(3218,'Sao Miguel do Iguacu',3107),(3219,'Sarandi',3107),(3220,'Senges',3107),(3221,'Sertanopolis',3107),(3222,'Siquera Campos',3107),(3223,'Tapejara',3107),(3224,'Telemaco Borba',3107),(3225,'Terra Boa',3107),(3226,'Terra Rica',3107),(3227,'Terra Roxa',3107),(3228,'Tibagi',3107),(3229,'Toledo',3107),(3230,'Ubirata',3107),(3231,'Umuarama',3107),(3232,'Uniao da Victoria',3107),(3233,'Wenceslau Braz',3107),(3234,'Pernambuco',2274),(3235,'Abreu e Lima',3234),(3236,'Afogados da Ingazeira',3234),(3237,'Agrestina',3234),(3238,'Agua Preta',3234),(3239,'Aguas Belas',3234),(3240,'Alianca',3234),(3241,'Altinho',3234),(3242,'Amaraji',3234),(3243,'Araripina',3234),(3244,'Arcoverde',3234),(3245,'Barra de Guabiraba',3234),(3246,'Barreiros',3234),(3247,'Belem de Sao Francisco',3234),(3248,'Belo Jardim',3234),(3249,'Bezerros',3234),(3250,'Bodoco',3234),(3251,'Bom Conselho',3234),(3252,'Bonito',3234),(3253,'Brejo da Madre de Deus',3234),(3254,'Buique',3234),(3255,'Cabo de Santo Agostinho',3234),(3256,'Cabrobo',3234),(3257,'Cachoeirinha',3234),(3258,'Caetes',3234),(3259,'Camaragibe',3234),(3260,'Camocim de Sao Felix',3234),(3261,'Canhotinho',3234),(3262,'Capoeiras',3234),(3263,'Carnaiba',3234),(3264,'Carpina',3234),(3265,'Caruaru',3234),(3266,'Catende',3234),(3267,'Cha Grande',3234),(3268,'Condado',3234),(3269,'Cumaru',3234),(3270,'Cupira',3234),(3271,'Custodia',3234),(3272,'Escada',3234),(3273,'Exu',3234),(3274,'Feira Nova',3234),(3275,'Fernando de Noronha',3234),(3276,'Flores',3234),(3277,'Floresta',3234),(3278,'Gameleira',3234),(3279,'Garanhuns',3234),(3280,'Gloria do Goita',3234),(3281,'Goiana',3234),(3282,'Gravata',3234),(3283,'Ibimirim',3234),(3284,'Igarassu',3234),(3285,'Inaja',3234),(3286,'Ipojuca',3234),(3287,'Ipubi',3234),(3288,'Itaiba',3234),(3289,'Itamaraca',3234),(3290,'Itapissuma',3234),(3291,'Itaquitinga',3234),(3292,'Jaboatao',3234),(3293,'Joao Alfredo',3234),(3294,'Joaquim Nabuco',3234),(3295,'Lagoa do Itaenga',3234),(3296,'Lajedo',3234),(3297,'Limoeiro',3234),(3298,'Macaparana',3234),(3299,'Maraial',3234),(3300,'Moreno',3234),(3301,'Nazare da Mata',3234),(3302,'Olinda',3234),(3303,'Orobo',3234),(3304,'Ouricuri',3234),(3305,'Palmares',3234),(3306,'Panelas',3234),(3307,'Parnamirim',3234),(3308,'Passira',3234),(3309,'Paudalho',3234),(3310,'Pedra',3234),(3311,'Pesqueira',3234),(3312,'Petrolandia',3234),(3313,'Petrolina',3234),(3314,'Pombos',3234),(3315,'Quipapa',3234),(3316,'Recife',3234),(3317,'Ribeirao',3234),(3318,'Rio Formoso',3234),(3319,'Salgueiro',3234),(3320,'Santa Cruz do Capibaribe',3234),(3321,'Santa Maria da Boa Vista',3234),(3322,'Sao Bento do Una',3234),(3323,'Sao Caitano',3234),(3324,'Sao Joao',3234),(3325,'Sao Joaquim do Monte',3234),(3326,'Sao Jose da Coroa Grande',3234),(3327,'Sao Jose do Belmonte',3234),(3328,'Sao Jose do Egito',3234),(3329,'Sao Lourenco da Mata',3234),(3330,'Serra Talhada',3234),(3331,'Sertania',3234),(3332,'Sirinhaem',3234),(3333,'Surubim',3234),(3334,'Tabira',3234),(3335,'Tamandare',3234),(3336,'Taquaritinga do Norte',3234),(3337,'Timbauba',3234),(3338,'Toritama',3234),(3339,'Tupanatinga',3234),(3340,'Vicencia',3234),(3341,'Vitoria de Santo Antao',3234),(3342,'Piaui',2274),(3343,'Alto Longa',3342),(3344,'Altos',3342),(3345,'Amarante',3342),(3346,'Avelino Lopes',3342),(3347,'Barras',3342),(3348,'Beneditinos',3342),(3349,'Bom Jesus',3342),(3350,'Buriti dos Lopes',3342),(3351,'Campo Maior',3342),(3352,'Canto do Buriti',3342),(3353,'Castelo do Piaui',3342),(3354,'Cocal',3342),(3355,'Corrente',3342),(3356,'Demerval Lobao',3342),(3357,'Elesbao Veloso',3342),(3358,'Esperantina',3342),(3359,'Floriano',3342),(3360,'Gilbues',3342),(3361,'Guadalupe',3342),(3362,'Inhuma',3342),(3363,'Itainopolis',3342),(3364,'Itaueira',3342),(3365,'Jaicos',3342),(3366,'Joaquim Pires',3342),(3367,'Jose de Freitas',3342),(3368,'Luis Correia',3342),(3369,'Luzilandia',3342),(3370,'Matias Olimpio',3342),(3371,'Miguel Alves',3342),(3372,'Monsenhor Gil',3342),(3373,'Oeiras',3342),(3374,'Palmeirais',3342),(3375,'Parnaiba',3342),(3376,'Pedro II',3342),(3377,'Picos',3342),(3378,'Pimenteiras',3342),(3379,'Pio IX',3342),(3380,'Piracuruca',3342),(3381,'Piripiri',3342),(3382,'Porto',3342),(3383,'Regeneracao',3342),(3384,'Sao Joao do Piaui',3342),(3385,'Sao Miguel do Tapuio',3342),(3386,'Sao Pedro do Piaui',3342),(3387,'Sao Raimundo Nonato',3342),(3388,'Simoes',3342),(3389,'Simplicio Mendes',3342),(3390,'Teresina',3342),(3391,'Uniao',3342),(3392,'Urucui',3342),(3393,'Valenca do Piaui',3342),(3394,'Rio de Janeiro',2274),(3395,'Rio Grande do Norte',2274),(3396,'Rio Grande do Sul',2274),(3397,'Rondonia',2274),(3398,'Alta Floresta d\'Oeste',3397),(3399,'Alto Alegre do Parecis',3397),(3400,'Alto Paraiso',3397),(3401,'Alvorada d\'Oeste',3397),(3402,'Ariquemes',3397),(3403,'Buritis',3397),(3404,'Cacoal',3397),(3405,'Candeias do Jamari',3397),(3406,'Cerejeiras',3397),(3407,'Colorado do Oeste',3397),(3408,'Corumbiara',3397),(3409,'Espigao d\'Oeste',3397),(3410,'Governador Jorge Teixeira',3397),(3411,'Guajara-Mirim',3397),(3412,'Jaru',3397),(3413,'Ji-Parana',3397),(3414,'Machadinho d\'Oeste',3397),(3415,'Ministro Andreazza',3397),(3416,'Mirante da Serra',3397),(3417,'Nova Brasilandia d\'Oeste',3397),(3418,'Nova Mamore',3397),(3419,'Novo Horizonte do Oeste',3397),(3420,'Ouro Preto do Oeste',3397),(3421,'Pimenta Bueno',3397),(3422,'Porto Velho',3397),(3423,'Presidente Medici',3397),(3424,'Rolim de Moura',3397),(3425,'Santa Luzia d\'Oeste',3397),(3426,'Sao Miguel do Guapore',3397),(3427,'Urupa',3397),(3428,'Vale do Paraiso',3397),(3429,'Vilhena',3397),(3430,'Roraima',2274),(3431,'Alto Alegre',3430),(3432,'Boa Vista',3430),(3433,'Bonfim',3430),(3434,'Caracarai',3430),(3435,'Mucajai',3430),(3436,'Normandia',3430),(3437,'Sao Joao da Baliza',3430),(3438,'Sao Luiz',3430),(3439,'Santa Catarina',2274),(3440,'Sao Paulo',2274),(3441,'Sergipe',2274),(3442,'Aquidaba',3441),(3443,'Aracaju',3441),(3444,'Araua',3441),(3445,'Areia Branca',3441),(3446,'Barra dos Coqueiros',3441),(3447,'Boquim',3441),(3448,'Campo do Brito',3441),(3449,'Caninde de Sao Francisco',3441),(3450,'Carira',3441),(3451,'Cristinapolis',3441),(3452,'Estancia',3441),(3453,'Frei Paulo',3441),(3454,'Gararu',3441),(3455,'Indiaroba',3441),(3456,'Itabaianinha',3441),(3457,'Itaporanga d\'Ajuda',3441),(3458,'Japaratuba',3441),(3459,'Japoata',3441),(3460,'Lagarto',3441),(3461,'Laranjeiras',3441),(3462,'Malhador',3441),(3463,'Maruim',3441),(3464,'Moita Bonita',3441),(3465,'Monte Alegre de Sergipe',3441),(3466,'Neopolis',3441),(3467,'Nossa Senhora da Gloria',3441),(3468,'Nossa Senhora das Dores',3441),(3469,'Nossa Senhora do Socorro',3441),(3470,'Poco Verde',3441),(3471,'Porto da Folha',3441),(3472,'Propria',3441),(3473,'Riachao do Dantas',3441),(3474,'Ribeiropolis',3441),(3475,'Salgado',3441),(3476,'Santa Luzia do Itanhy',3441),(3477,'Santo Amaro das Brotas',3441),(3478,'Sao Cristovao',3441),(3479,'Simao Dias',3441),(3480,'Tobias Barreto',3441),(3481,'Tomar do Geru',3441),(3482,'Umbauba',3441),(3483,'Tocantins',2274),(3484,'Alvorada',3483),(3485,'Ananas',3483),(3486,'Araguacu',3483),(3487,'Araguaina',3483),(3488,'Araguatins',3483),(3489,'Arraias',3483),(3490,'Augustinopolis',3483),(3491,'Axixa do Tocantins',3483),(3492,'Colinas do Tocantins',3483),(3493,'Dianopolis',3483),(3494,'Formoso do Araguaia',3483),(3495,'Goiatins',3483),(3496,'Guarai',3483),(3497,'Gurupi',3483),(3498,'Miracema do Tocantins',3483),(3499,'Miranorte',3483),(3500,'Paraiso',3483),(3501,'Porto Nacional',3483),(3502,'Sitio Novo do Tocantins',3483),(3503,'Taguatinga',3483),(3504,'Tocantinopolis',3483),(3505,'Wanderlandia',3483),(3506,'Xambioa',3483),(3507,'British Indian Ocean Territory',NULL),(3508,'Brunei',NULL),(3509,'Belait',3508),(3510,'Kuala Belait',3509),(3511,'Seria',3509),(3512,'Brunei-Muara',3508),(3513,'Bandar Seri Begawan',3512),(3514,'Temburong',3508),(3515,'Bangar',3514),(3516,'Tutong',3508),(3517,'Bulgaria',NULL),(3518,'Blagoevgrad',3517),(3519,'Bansko',3518),(3520,'Belica',3518),(3521,'Goce Delchev',3518),(3522,'Hadzhidimovo',3518),(3523,'Jakoruda',3518),(3524,'Kresna',3518),(3525,'Melnik',3518),(3526,'Petrich',3518),(3527,'Razlog',3518),(3528,'Sandanski',3518),(3529,'Simitli',3518),(3530,'Burgas',3517),(3531,'Ahtopol',3530),(3532,'Ajtos',3530),(3533,'Balgarovo',3530),(3534,'Bourgas',3530),(3535,'Carevo',3530),(3536,'Kableshkovo',3530),(3537,'Kameno',3530),(3538,'Karnobat',3530),(3539,'Malko Tarnovo',3530),(3540,'Nesebar',3530),(3541,'Obzor',3530),(3542,'Pomorie',3530),(3543,'Primorsko',3530),(3544,'Sozopol',3530),(3545,'Sredec',3530),(3546,'Sungurlare',3530),(3547,'Tvardica',3530),(3548,'Dobrich',3517),(3549,'Balchik',3548),(3550,'General-Toshevo',3548),(3551,'Kavarna',3548),(3552,'Loznica',3548),(3553,'Shabla',3548),(3554,'Tervel',3548),(3555,'Gabrovo',3517),(3556,'Drjanovo',3555),(3557,'Plachkovci',3555),(3558,'Sevlievo',3555),(3559,'Trjavna',3555),(3560,'Haskovo',3517),(3561,'Dimitrovgrad',3560),(3562,'Harmanli',3560),(3563,'Ivajlovgrad',3560),(3564,'Ljubimec',3560),(3565,'Madzharovo',3560),(3566,'Merichleri',3560),(3567,'Simeonovgrad',3560),(3568,'Svilengrad',3560),(3569,'Jambol',3517),(3570,'Boljarovo',3569),(3571,'Elhovo',3569),(3572,'Straldzha',3569),(3573,'Topolovgrad',3569),(3574,'Kardzhali',3517),(3575,'Ardino',3574),(3576,'Dzhebel',3574),(3577,'Krumovgrad',3574),(3578,'Momchilgrad',3574),(3579,'Kjustendil',3517),(3580,'Boboshevo',3579),(3581,'Bobovdol',3579),(3582,'Dupnica',3579),(3583,'Kocherinovo',3579),(3584,'Rila',3579),(3585,'Sapareva Banja',3579),(3586,'Zemen',3579),(3587,'Lovech',3517),(3588,'Aprilci',3587),(3589,'Jablanica',3587),(3590,'Letnica',3587),(3591,'Lukovit',3587),(3592,'Sopot',3587),(3593,'Teteven',3587),(3594,'Trojan',3587),(3595,'Ugarchin',3587),(3596,'Montana',3517),(3597,'Anaconda-Deer Lodge County',3596),(3598,'Arlee',3596),(3599,'Belgrade',3596),(3600,'Berkovica',3596),(3601,'Billings',3596),(3602,'Bojchinovci',3596),(3603,'Bozeman',3596),(3604,'Brusarci',3596),(3605,'Butte',3596),(3606,'Butte-Silver Bow',3596),(3607,'Chiprovci',3596),(3608,'Great Falls',3596),(3609,'Havre',3596),(3610,'Helena',3596),(3611,'Helena Valley Southeast',3596),(3612,'Helena Valley West Central',3596),(3613,'Kalispell',3596),(3614,'Lame Deer',3596),(3615,'Laurel',3596),(3616,'Lewistown',3596),(3617,'Livingston',3596),(3618,'Lom',3596),(3619,'Malmstrom Air Force Base',3596),(3620,'Manhattan',3596),(3621,'Miles City',3596),(3622,'Missoula',3596),(3623,'Orchard Homes',3596),(3624,'Pablo',3596),(3625,'Polson',3596),(3626,'Roberts',3596),(3627,'Ryegate',3596),(3628,'Sidney',3596),(3629,'Stevensville',3596),(3630,'Valchedram',3596),(3631,'Varshec',3596),(3632,'Whitefish',3596),(3633,'Oblast Sofiya-Grad',3517),(3634,'Pazardzhik',3517),(3635,'Batak',3634),(3636,'Belovo',3634),(3637,'Bracigovo',3634),(3638,'Koprivshtica',3634),(3639,'Panagjurishte',3634),(3640,'Peshtera',3634),(3641,'Rakitovo',3634),(3642,'Septemvri',3634),(3643,'Strelcha',3634),(3644,'Velingrad',3634),(3645,'Pernik',3517),(3646,'Bankja',3645),(3647,'Batanovci',3645),(3648,'Breznik',3645),(3649,'Radomir',3645),(3650,'Tran',3645),(3651,'Pleven',3517),(3652,'Belene',3651),(3653,'Cherven Brjag',3651),(3654,'Dolna Mitropolija',3651),(3655,'Dolni Dabnik',3651),(3656,'Guljanci',3651),(3657,'Levski',3651),(3658,'Nikopol',3651),(3659,'Pordim',3651),(3660,'Slavjanovo',3651),(3661,'Trashtenik',3651),(3662,'Varbica',3651),(3663,'Plovdiv',3517),(3664,'Asenovgrad',3663),(3665,'Brezovo',3663),(3666,'Car Kalojan',3663),(3667,'Hisarja',3663),(3668,'Kalofer',3663),(3669,'Karlovo',3663),(3670,'Klisura',3663),(3671,'Krichim',3663),(3672,'Parvomaj',3663),(3673,'Perushtica',3663),(3674,'Rakovski',3663),(3675,'Sadovo',3663),(3676,'Saedinenie',3663),(3677,'Stambolijski',3663),(3678,'Razgrad',3517),(3679,'Isperih',3678),(3680,'Kubrat',3678),(3681,'Senovo',3678),(3682,'Zavet',3678),(3683,'Ruse',3517),(3684,'Bjala',3683),(3685,'Borovo',3683),(3686,'Dve Mogili',3683),(3687,'Russe',3683),(3688,'Vetovo',3683),(3689,'Shumen',3517),(3690,'Kaolinovo',3689),(3691,'Kaspichan',3689),(3692,'Novi Pazar',3689),(3693,'Pliska',3689),(3694,'Smjadovo',3689),(3695,'Veliki Preslav',3689),(3696,'Silistra',3517),(3697,'Alfatar',3696),(3698,'Dulovo',3696),(3699,'Glavinica',3696),(3700,'Tutrakan',3696),(3701,'Sliven',3517),(3702,'Kermen',3701),(3703,'Kotel',3701),(3704,'Nova Zagora',3701),(3705,'Shivachevo',3701),(3706,'Smoljan',3517),(3707,'Chepelare',3706),(3708,'Devin',3706),(3709,'Dospat',3706),(3710,'Laki',3706),(3711,'Madan',3706),(3712,'Nedelino',3706),(3713,'Rudozem',3706),(3714,'Zlatograd',3706),(3715,'Sofija grad',3517),(3716,'Sofijska oblast',3517),(3717,'Stara Zagora',3517),(3718,'Targovishte',3517),(3719,'Antonovo',3718),(3720,'Omurtag',3718),(3721,'Opaka',3718),(3722,'Popovo',3718),(3723,'Varna',3517),(3724,'Beloslav',3723),(3725,'Dalgopol',3723),(3726,'Devnja',3723),(3727,'Iskar',3723),(3728,'Provadija',3723),(3729,'Suvorovo',3723),(3730,'Valchi Dol',3723),(3731,'Veliko Tarnovo',3517),(3732,'Vidin',3517),(3733,'Belogradchik',3732),(3734,'Bregovo',3732),(3735,'Dimovo',3732),(3736,'Dolni Chiflik',3732),(3737,'Dunavci',3732),(3738,'Gramada',3732),(3739,'Kula',3732),(3740,'Vraca',3517),(3741,'Bjala Slatina',3740),(3742,'Knezha',3740),(3743,'Kojnare',3740),(3744,'Kozloduj',3740),(3745,'Krivodol',3740),(3746,'Mezdra',3740),(3747,'Mizija',3740),(3748,'Orjahovo',3740),(3749,'Roman',3740),(3750,'Yablaniza',3517),(3751,'Burkina Faso',NULL),(3752,'Bale',3751),(3753,'Boromo',3752),(3754,'Bam',3751),(3755,'Kongoussi',3754),(3756,'Bazega',3751),(3757,'Kombissiri',3756),(3758,'Bougouriba',3751),(3759,'Diebougou',3758),(3760,'Pa',3758),(3761,'Boulgou',3751),(3762,'Garango',3761),(3763,'Tenkodogo',3761),(3764,'Boulkiemde',3751),(3765,'Koudougou',3764),(3766,'Comoe',3751),(3767,'Banfora',3766),(3768,'Ganzourgou',3751),(3769,'Zorgo',3768),(3770,'Gnagna',3751),(3771,'Bogande',3770),(3772,'Gourma',3751),(3773,'Fada N\'gourma',3772),(3774,'Houet',3751),(3775,'Bekuy',3774),(3776,'Bobo Dioulasso',3774),(3777,'Ioba',3751),(3778,'Dano',3777),(3779,'Kadiogo',3751),(3780,'Ouagadougou',3779),(3781,'Kenedougou',3751),(3782,'Koalla',3781),(3783,'Koloko',3781),(3784,'Orodara',3781),(3785,'Komandjari',3751),(3786,'Gayeri',3785),(3787,'Kompienga',3751),(3788,'Pama',3787),(3789,'Kossi',3751),(3790,'Nouna',3789),(3791,'Kouritenga',3751),(3792,'Koupela',3791),(3793,'Kourweogo',3751),(3794,'Bousse',3793),(3795,'Leraba',3751),(3796,'Sindou',3795),(3797,'Mouhoun',3751),(3798,'Dedougou',3797),(3799,'Nahouri',3751),(3800,'Po',3799),(3801,'Namentenga',3751),(3802,'Boulsa',3801),(3803,'Noumbiel',3751),(3804,'Batie',3803),(3805,'Oubritenga',3751),(3806,'Ziniare',3805),(3807,'Oudalan',3751),(3808,'Gorom-Gorom',3807),(3809,'Passore',3751),(3810,'Yako',3809),(3811,'Poni',3751),(3812,'Gaoua',3811),(3813,'Kampti',3811),(3814,'Loropeni',3811),(3815,'Sanguie',3751),(3816,'Sanmatenga',3751),(3817,'Seno',3751),(3818,'Sissili',3751),(3819,'Soum',3751),(3820,'Sourou',3751),(3821,'Tapoa',3751),(3822,'Tuy',3751),(3823,'Yatenga',3751),(3824,'Zondoma',3751),(3825,'Zoundweogo',3751),(3826,'Burundi',NULL),(3827,'Cambodia',NULL),(3828,'Banteay Mean Chey',3827),(3829,'Bat Dambang',3827),(3830,'Kampong Cham',3827),(3831,'Kampong Chhnang',3827),(3832,'Kampong Spoeu',3827),(3833,'Kampong Thum',3827),(3834,'Kampot',3827),(3835,'Kandal',3827),(3836,'Ta Khmau',3835),(3837,'Kaoh Kong',3827),(3838,'Kracheh',3827),(3839,'Krong Kaeb',3827),(3840,'Krong Pailin',3827),(3841,'Krong Preah Sihanouk',3827),(3842,'Mondol Kiri',3827),(3843,'Otdar Mean Chey',3827),(3844,'Phnum Penh',3827),(3845,'Pousat',3827),(3846,'Preah Vihear',3827),(3847,'Prey Veaeng',3827),(3848,'Rotanak Kiri',3827),(3849,'Siem Reab',3827),(3850,'Stueng Traeng',3827),(3851,'Svay Rieng',3827),(3852,'Takaev',3827),(3853,'Phumi Takaev',3852),(3854,'Cameroon',NULL),(3855,'Adamaoua',3854),(3856,'Banyo',3855),(3857,'Meiganga',3855),(3858,'Ngaoundere',3855),(3859,'Tibati',3855),(3860,'Tignere',3855),(3861,'Centre',3854),(3862,'Akonolinga',3861),(3863,'Azay-le-Rideau',3861),(3864,'Bafia',3861),(3865,'Chevillon-sur-Huillard',3861),(3866,'Cloyes-sur-le-Loir',3861),(3867,'Eseka',3861),(3868,'Gellainville',3861),(3869,'Guerin Kouka',3861),(3870,'Hinche',3861),(3871,'La Chaussse-Saint-Victor',3861),(3872,'La Ville-aux-Clercs',3861),(3873,'Ladon',3861),(3874,'Le Chatelet',3861),(3875,'Mbalmayo',3861),(3876,'Mfou',3861),(3877,'Mirebalais',3861),(3878,'Monatele',3861),(3879,'Nanga Eboko',3861),(3880,'Obala',3861),(3881,'Ombesa',3861),(3882,'Petach Tikva',3861),(3883,'Ramallah',3861),(3884,'Saa',3861),(3885,'Sokode',3861),(3886,'Sotouboua',3861),(3887,'Tchamba',3861),(3888,'Yaounde',3861),(3889,'Est',3854),(3890,'Abong Mbang',3889),(3891,'Batouri',3889),(3892,'Bertoua',3889),(3893,'Betare Oya',3889),(3894,'Djoum',3889),(3895,'Doume',3889),(3896,'Lomie',3889),(3897,'Yokadouma',3889),(3898,'Littoral',3854),(3899,'Bonaberi',3898),(3900,'Cotonou',3898),(3901,'Dibombari',3898),(3902,'Douala',3898),(3903,'Edea',3898),(3904,'Loum',3898),(3905,'Manjo',3898),(3906,'Mbanga',3898),(3907,'Nkongsamba',3898),(3908,'Yabassi',3898),(3909,'Nord',3854),(3910,'Aniche',3909),(3911,'Annoeullin',3909),(3912,'Anzin',3909),(3913,'Armentieres',3909),(3914,'Aulnoye-Aymeries',3909),(3915,'Bailleul',3909),(3916,'Bondues',3909),(3917,'Bruay-sur-l\'Escaut',3909),(3918,'Canala',3909),(3919,'Cap-Haitien',3909),(3920,'Cappelle-la-Grande',3909),(3921,'Caudry',3909),(3922,'Comines',3909),(3923,'Conde-sur-l\'Escaut',3909),(3924,'Coudekerque-Branche',3909),(3925,'Croix',3909),(3926,'Croix-des-Bouquets',3909),(3927,'Denain',3909),(3928,'Douai',3909),(3929,'Douchy-les-Mines',3909),(3930,'Dunkerque',3909),(3931,'Escaudain',3909),(3932,'Fache-Thumesnil',3909),(3933,'Figuif',3909),(3934,'Fourmies',3909),(3935,'Garoua',3909),(3936,'Grande Riviere du Nord',3909),(3937,'Grande-Synthe',3909),(3938,'Graveline',3909),(3939,'Guider',3909),(3940,'Halluin',3909),(3941,'Haubourdin',3909),(3942,'Hautmont',3909),(3943,'Hazebrouck',3909),(3944,'Hem',3909),(3945,'Hienghene',3909),(3946,'Houailu',3909),(3947,'Hulluch',3909),(3948,'Jeumont',3909),(3949,'Kaala Gomen',3909),(3950,'Kone',3909),(3951,'Koumac',3909),(3952,'La Madeleine',3909),(3953,'Lagdo',3909),(3954,'Lambersart',3909),(3955,'Leers',3909),(3956,'Lille',3909),(3957,'Limbe',3909),(3958,'Lomme',3909),(3959,'Loos',3909),(3960,'Lys-lez-Lannoy',3909),(3961,'Marcq-en-Baroeul',3909),(3962,'Marennes',3909),(3963,'Marly',3909),(3964,'Marquette-lez-Lille',3909),(3965,'Maubeuge',3909),(3966,'Merville',3909),(3967,'Mons-en-Baroeul',3909),(3968,'Mouvaux',3909),(3969,'Neuville-en-Ferrain',3909),(3970,'Onnaing',3909),(3971,'Ouegoa',3909),(3972,'Pignon',3909),(3973,'Poindimie',3909),(3974,'Poli',3909),(3975,'Ponerihouen',3909),(3976,'Pouebo',3909),(3977,'Pouembout',3909),(3978,'Poum',3909),(3979,'Poya',3909),(3980,'Raismes',3909),(3981,'Rey Bouba',3909),(3982,'Ronchin',3909),(3983,'Roncq',3909),(3984,'Roubaix',3909),(3985,'Saint-Amand-les-Eaux',3909),(3986,'Saint-Andre-lez-Lille',3909),(3987,'Saint-Pol-sur-Mer',3909),(3988,'Saint-Saulve',3909),(3989,'Seclin',3909),(3990,'Sin-le-Noble',3909),(3991,'Somain',3909),(3992,'Tchollire',3909),(3993,'Touho',3909),(3994,'Tourcoing',3909),(3995,'Valenciennes',3909),(3996,'Vieux-Conde',3909),(3997,'Villeneuve-d\'Ascq',3909),(3998,'Voh',3909),(3999,'Wasquehal',3909),(4000,'Wattignies',3909),(4001,'Wattrelos',3909),(4002,'Waziers',3909),(4003,'Nord Extreme',3854),(4004,'Nordouest',3854),(4005,'Bamenda',4004),(4006,'Kumbo',4004),(4007,'Mbengwi',4004),(4008,'Mme',4004),(4009,'Njinikom',4004),(4010,'Nkambe',4004),(4011,'Wum',4004),(4012,'Ouest',3854),(4013,'Anse-a-Galets',4012),(4014,'Bafang',4012),(4015,'Bafoussam',4012),(4016,'Bafut',4012),(4017,'Bali',4012),(4018,'Bana',4012),(4019,'Bangangte',4012),(4020,'Carrefour',4012),(4021,'Delmas',4012),(4022,'Djang',4012),(4023,'Fontem',4012),(4024,'Foumban',4012),(4025,'Foumbot',4012),(4026,'Kenscoff',4012),(4027,'Lascahobas',4012),(4028,'Leogane',4012),(4029,'Mbouda',4012),(4030,'Petionville',4012),(4031,'Petit Goave',4012),(4032,'Port-au-Prince',4012),(4033,'Sud',3854),(4034,'Akom',4033),(4035,'Ambam',4033),(4036,'Aquin',4033),(4037,'Bouloupari',4033),(4038,'Bourail',4033),(4039,'Dumbea',4033),(4040,'Ebolowa',4033),(4041,'Farino',4033),(4042,'Kribi',4033),(4043,'La Foa',4033),(4044,'Les Cayes',4033),(4045,'Lolodorf',4033),(4046,'Moindou',4033),(4047,'Moloundou',4033),(4048,'Mont-Dore',4033),(4049,'Mvangue',4033),(4050,'Noumea',4033),(4051,'Paita',4033),(4052,'Sangmelima',4033),(4053,'Sarramea',4033),(4054,'Thio',4033),(4055,'Yate',4033),(4056,'Sudouest',3854),(4057,'Buea',4056),(4058,'Idenao',4056),(4059,'Kumba',4056),(4060,'Mamfe',4056),(4061,'Muyuka',4056),(4062,'Tiko',4056),(4063,'Canada',NULL),(4064,'Alberta',4063),(4065,'Airdrie',4064),(4066,'Athabasca',4064),(4067,'Banff',4064),(4068,'Barrhead',4064),(4069,'Bassano',4064),(4070,'Beaumont',4064),(4071,'Beaverlodge',4064),(4072,'Black Diamond',4064),(4073,'Blackfalds',4064),(4074,'Blairmore',4064),(4075,'Bon Accord',4064),(4076,'Bonnyville',4064),(4077,'Bow Island',4064),(4078,'Brooks',4064),(4079,'Calgary',4064),(4080,'Calmar',4064),(4081,'Camrose',4064),(4082,'Canmore',4064),(4083,'Cardston',4064),(4084,'Carstairs',4064),(4085,'Chateau Lake Louise',4064),(4086,'Chestermere',4064),(4087,'Clairmont',4064),(4088,'Claresholm',4064),(4089,'Coaldale',4064),(4090,'Coalhurst',4064),(4091,'Cochrane',4064),(4092,'Crossfield',4064),(4093,'Devon',4064),(4094,'Didsbury',4064),(4095,'Drayton Valley',4064),(4096,'Drumheller',4064),(4097,'Edmonton',4064),(4098,'Edson',4064),(4099,'Elk Point',4064),(4100,'Fairview',4064),(4101,'Falher',4064),(4102,'Fort MacLeod',4064),(4103,'Fox Creek',4064),(4104,'Gibbons',4064),(4105,'Grand Centre',4064),(4106,'Grande Cache',4064),(4107,'Grande Prairie',4064),(4108,'Grimshaw',4064),(4109,'Hanna',4064),(4110,'High Level',4064),(4111,'High Prairie',4064),(4112,'High River',4064),(4113,'Hinton',4064),(4114,'Irricana',4064),(4115,'Jasper',4064),(4116,'Killam',4064),(4117,'La Crete',4064),(4118,'Lac la Biche',4064),(4119,'Lacombe',4064),(4120,'Lamont',4064),(4121,'Leduc',4064),(4122,'Lethbridge',4064),(4123,'Lloydminster',4064),(4124,'Magrath',4064),(4125,'Manning',4064),(4126,'Mayerthorpe',4064),(4127,'McMurray',4064),(4128,'Medicine Hat',4064),(4129,'Millet',4064),(4130,'Morinville',4064),(4131,'Nanton',4064),(4132,'Okotoks',4064),(4133,'Olds',4064),(4134,'Peace River',4064),(4135,'Penhold',4064),(4136,'Picture Butte',4064),(4137,'Pincher Creek',4064),(4138,'Ponoka',4064),(4139,'Provost',4064),(4140,'Raymond',4064),(4141,'Red Deer',4064),(4142,'Redwater',4064),(4143,'Rimbey',4064),(4144,'Rocky Mountain House',4064),(4145,'Rocky View',4064),(4146,'Saint Paul',4064),(4147,'Sexsmith',4064),(4148,'Sherwood Park',4064),(4149,'Slave Lake',4064),(4150,'Smoky Lake',4064),(4151,'Spirit River',4064),(4152,'Spruce Grove',4064),(4153,'Stettler',4064),(4154,'Stony Plain',4064),(4155,'Strathmore',4064),(4156,'Sundre',4064),(4157,'Swan Hills',4064),(4158,'Sylvan Lake',4064),(4159,'Taber',4064),(4160,'Three Hills',4064),(4161,'Tofield',4064),(4162,'Two Hills',4064),(4163,'Valleyview',4064),(4164,'Vegreville',4064),(4165,'Vermilion',4064),(4166,'Viking',4064),(4167,'Vulcan',4064),(4168,'Wainwright',4064),(4169,'Wembley',4064),(4170,'Westlock',4064),(4171,'Wetaskiwin',4064),(4172,'Whitecourt',4064),(4173,'Wood Buffalo',4064),(4174,'British Columbia',4063),(4175,'Manitoba',4063),(4176,'Altona',4175),(4177,'Beausejour',4175),(4178,'Boissevain',4175),(4179,'Brandon',4175),(4180,'Carberry',4175),(4181,'Carman',4175),(4182,'Dauphin',4175),(4183,'Deloraine',4175),(4184,'Dugald',4175),(4185,'Flin Flon',4175),(4186,'Gimli',4175),(4187,'Hamiota',4175),(4188,'Killarney',4175),(4189,'Lac du Bonnet',4175),(4190,'Leaf Rapids',4175),(4191,'Lorette',4175),(4192,'Melita',4175),(4193,'Minnedosa',4175),(4194,'Morden',4175),(4195,'Morris',4175),(4196,'Neepawa',4175),(4197,'Niverville',4175),(4198,'Pinawa',4175),(4199,'Portage la Prairie',4175),(4200,'Ritchot',4175),(4201,'Rivers',4175),(4202,'Roblin',4175),(4203,'Saint Adolphe',4175),(4204,'Sainte Anne',4175),(4205,'Sainte Rose du Lac',4175),(4206,'Selkirk',4175),(4207,'Shilo',4175),(4208,'Snow Lake',4175),(4209,'Souris',4175),(4210,'Springfield',4175),(4211,'Steinbach',4175),(4212,'Stonewall',4175),(4213,'Stony Mountain',4175),(4214,'Swan River',4175),(4215,'The Pas',4175),(4216,'Thompson',4175),(4217,'Virden',4175),(4218,'Winkler',4175),(4219,'Winnipeg',4175),(4220,'New Brunswick',4063),(4221,'Newfoundland and Labrador',4063),(4222,'Northwest Territories',4063),(4223,'Nova Scotia',4063),(4224,'Nunavut',4063),(4225,'Clyde River',4224),(4226,'Iqaluit',4224),(4227,'Kangerdlinerk',4224),(4228,'Oqsuqtooq',4224),(4229,'Pangnirtung',4224),(4230,'Tununirusiq',4224),(4231,'Ontario',4063),(4232,'Acton',4231),(4233,'Ajax',4231),(4234,'Alexandria',4231),(4235,'Alfred',4231),(4236,'Alliston',4231),(4237,'Almonte',4231),(4238,'Amherstburg',4231),(4239,'Amigo Beach',4231),(4240,'Angus-Borden',4231),(4241,'Arnprior',4231),(4242,'Arthur',4231),(4243,'Athens',4231),(4244,'Atikokan',4231),(4245,'Attawapiskat',4231),(4246,'Aylmer',4231),(4247,'Ayr',4231),(4248,'Barrie',4231),(4249,'Barry\'s Bay',4231),(4250,'Beamsville',4231),(4251,'Beaverton',4231),(4252,'Beeton',4231),(4253,'Belleville',4231),(4254,'Belmont',4231),(4255,'Blenheim',4231),(4256,'Blind River',4231),(4257,'Bobcaygeon',4231),(4258,'Bolton',4231),(4259,'Bourget',4231),(4260,'Bowmanville-Newcastle',4231),(4261,'Bracebridge',4231),(4262,'Bradford',4231),(4263,'Brampton',4231),(4264,'Brantford',4231),(4265,'Bridgenorth-Chemong Park Area',4231),(4266,'Brighton',4231),(4267,'Brockville',4231),(4268,'Brooklin',4231),(4269,'Brussels',4231),(4270,'Burford',4231),(4271,'Burlington',4231),(4272,'Caledon',4231),(4273,'Caledon East',4231),(4274,'Caledonia',4231),(4275,'Cambridge',4231),(4276,'Campbellford',4231),(4277,'Campbellville',4231),(4278,'Cannington',4231),(4279,'Capreol',4231),(4280,'Cardinal',4231),(4281,'Carleton Place',4231),(4282,'Carlisle',4231),(4283,'Casselman',4231),(4284,'Cayuga',4231),(4285,'Chalk River',4231),(4286,'Chapleau',4231),(4287,'Chatham',4231),(4288,'Chesley',4231),(4289,'Chesterville',4231),(4290,'Cobourg',4231),(4291,'Colborne',4231),(4292,'Colchester',4231),(4293,'Collingwood',4231),(4294,'Concord',4231),(4295,'Constance Bay',4231),(4296,'Cookstown',4231),(4297,'Cornwall',4231),(4298,'Creemore',4231),(4299,'Crystal Beach',4231),(4300,'Deep River',4231),(4301,'Delhi',4231),(4302,'Deseronto',4231),(4303,'Downsview',4231),(4304,'Drayton',4231),(4305,'Dresden',4231),(4306,'Dryden',4231),(4307,'Dundalk',4231),(4308,'Dunnville',4231),(4309,'Durham',4231),(4310,'Eganville',4231),(4311,'Elliot Lake',4231),(4312,'Elmira',4231),(4313,'Elmvale',4231),(4314,'Embrun',4231),(4315,'Englehart',4231),(4316,'Erin',4231),(4317,'Espanola',4231),(4318,'Essex',4231),(4319,'Etobicoke',4231),(4320,'Everett',4231),(4321,'Exeter',4231),(4322,'Fenelon Falls',4231),(4323,'Fergus',4231),(4324,'Forest',4231),(4325,'Fort Erie',4231),(4326,'Fort Frances',4231),(4327,'Frankford',4231),(4328,'Gananoque',4231),(4329,'Georgina',4231),(4330,'Goderich',4231),(4331,'Golden',4231),(4332,'Gormley',4231),(4333,'Grand Bend',4231),(4334,'Grand Valley',4231),(4335,'Gravenhurst',4231),(4336,'Guelph',4231),(4337,'Gullegem',4231),(4338,'Hagersville',4231),(4339,'Haileybury',4231),(4340,'Hanover',4231),(4341,'Harriston',4231),(4342,'Harrow',4231),(4343,'Hastings',4231),(4344,'Havelock',4231),(4345,'Hawkesbury',4231),(4346,'Hearst',4231),(4347,'Hensall',4231),(4348,'Hillsburgh',4231),(4349,'Hornepayne',4231),(4350,'Huntsville',4231),(4351,'Ingersoll',4231),(4352,'Innisfil',4231),(4353,'Iroquois',4231),(4354,'Iroquois Falls',4231),(4355,'Jarvis',4231),(4356,'Kanata',4231),(4357,'Kapuskasing',4231),(4358,'Kars',4231),(4359,'Kemptville',4231),(4360,'Kenora',4231),(4361,'Kincardine',4231),(4362,'Kingston',4231),(4363,'Kirkland Lake',4231),(4364,'Kitchener',4231),(4365,'L\'Original',4231),(4366,'Lakefield',4231),(4367,'Lanark',4231),(4368,'Langdorp',4231),(4369,'Leamington',4231),(4370,'Lindsay',4231),(4371,'Listowel',4231),(4372,'Little Current',4231),(4373,'Lively',4231),(4374,'London',4231),(4375,'Longlac',4231),(4376,'Lucan',4231),(4377,'Lucknow',4231),(4378,'Madoc',4231),(4379,'Manitouwadge',4231),(4380,'Maple',4231),(4381,'Marathon',4231),(4382,'Markdale',4231),(4383,'Markham',4231),(4384,'Marmora',4231),(4385,'Mattawa',4231),(4386,'Meaford',4231),(4387,'Metcalfe',4231),(4388,'Midland',4231),(4389,'Mildmay',4231),(4390,'Millbrook',4231),(4391,'Milton',4231),(4392,'Milverton',4231),(4393,'Mississauga',4231),(4394,'Mississauga Beach',4231),(4395,'Mitchell',4231),(4396,'Moose Factory',4231),(4397,'Morrisburg',4231),(4398,'Mount Albert',4231),(4399,'Mount Brydges',4231),(4400,'Mount Forest',4231),(4401,'Munster',4231),(4402,'Nanticoke',4231),(4403,'Napanee',4231),(4404,'Nepean',4231),(4405,'New Hamburg',4231),(4406,'Newmarket',4231),(4407,'Newtonville',4231),(4408,'Nobleton',4231),(4409,'North Bay',4231),(4410,'North Gower',4231),(4411,'North York',4231),(4412,'Norwich',4231),(4413,'Norwood',4231),(4414,'Oakville',4231),(4415,'Omemee',4231),(4416,'Onaping-Levack',4231),(4417,'Orangeville',4231),(4418,'Orillia',4231),(4419,'Orono',4231),(4420,'Osgoode',4231),(4421,'Oshawa',4231),(4422,'Ottawa',4231),(4423,'Owen Sound',4231),(4424,'Paisley',4231),(4425,'Palmerston',4231),(4426,'Paris',4231),(4427,'Parkhill',4231),(4428,'Parry Sound',4231),(4429,'Pembroke',4231),(4430,'Petawawa',4231),(4431,'Petrolia',4231),(4432,'Pickering',4231),(4433,'Picton',4231),(4434,'Point Edward',4231),(4435,'Porcupine',4231),(4436,'Port Credit',4231),(4437,'Port Dover',4231),(4438,'Port Elgin',4231),(4439,'Port Hope',4231),(4440,'Port Perry',4231),(4441,'Port Stanley',4231),(4442,'Powassan',4231),(4443,'Prescott',4231),(4444,'Queensville',4231),(4445,'Renfrew',4231),(4446,'Richmond',4231),(4447,'Richmond Hill',4231),(4448,'Ridgetown',4231),(4449,'Rockland',4231),(4450,'Rockwood',4231),(4451,'Rodney',4231),(4452,'Saint Catharines',4231),(4453,'Saint Catharines-Niagara',4231),(4454,'Saint Jacobs',4231),(4455,'Saint Marys',4231),(4456,'Sarnia',4231),(4457,'Sault Sainte Marie',4231),(4458,'Scarborough',4231),(4459,'Schomberg',4231),(4460,'Seaforth',4231),(4461,'Shelburne',4231),(4462,'Simcoe',4231),(4463,'Sioux Lookout',4231),(4464,'Smiths Falls',4231),(4465,'Smithville',4231),(4466,'South River',4231),(4467,'Southampton',4231),(4468,'Stayner',4231),(4469,'Stoney Creek',4231),(4470,'Stoney Point',4231),(4471,'Stouffville',4231),(4472,'Stratford',4231),(4473,'Strathroy',4231),(4474,'Sturgeon Falls',4231),(4475,'Sudbury',4231),(4476,'Sutton',4231),(4477,'Tavistock',4231),(4478,'Teeswater',4231),(4479,'Terrace Bay',4231),(4480,'Thamesford',4231),(4481,'Thessalon',4231),(4482,'Thornbury',4231),(4483,'Thornhill',4231),(4484,'Thunder Bay',4231),(4485,'Tilbury',4231),(4486,'Tilsonburg',4231),(4487,'Timmins',4231),(4488,'Toronto',4231),(4489,'Tory Hill',4231),(4490,'Tottenham',4231),(4491,'Tweed',4231),(4492,'Uxbridge',4231),(4493,'Valley East',4231),(4494,'Vankleek Hill',4231),(4495,'Vaughan',4231),(4496,'Vineland',4231),(4497,'Walkerton',4231),(4498,'Wallaceburg',4231),(4499,'Wasaga Beach',4231),(4500,'Waterdown',4231),(4501,'Waterford',4231),(4502,'Waterloo',4231),(4503,'Watford',4231),(4504,'Wawa',4231),(4505,'Welland',4231),(4506,'Wellesley',4231),(4507,'West Lorne',4231),(4508,'Wheatley',4231),(4509,'Whitby',4231),(4510,'Whitchurch-Stouffville',4231),(4511,'Wiarton',4231),(4512,'Wikwemikong',4231),(4513,'Willowdale',4231),(4514,'Winchester',4231),(4515,'Wingham',4231),(4516,'Woodbridge',4231),(4517,'Woodstock',4231),(4518,'Wyoming',4231),(4519,'Prince Edward Island',4063),(4520,'Quebec',4063),(4521,'Acton Vale',4520),(4522,'Albanel',4520),(4523,'Alencon',4520),(4524,'Alma',4520),(4525,'Amos',4520),(4526,'Amqui',4520),(4527,'Anjou',4520),(4528,'Asbestos',4520),(4529,'Bagotville',4520),(4530,'Baie-Comeau',4520),(4531,'Baie-Saint-Paul',4520),(4532,'Barraute',4520),(4533,'Beauceville',4520),(4534,'Beaupre',4520),(4535,'Bedford',4520),(4536,'Beloeil',4520),(4537,'Bernierville',4520),(4538,'Berthierville',4520),(4539,'Betsiamites',4520),(4540,'Boisbriand',4520),(4541,'Bonaventure',4520),(4542,'Boucherville',4520),(4543,'Bromont',4520),(4544,'Brossard',4520),(4545,'Brownsburg',4520),(4546,'Buckingham',4520),(4547,'Cabano',4520),(4548,'Candiac',4520),(4549,'Cap-aux-Meules',4520),(4550,'Cap-Chat',4520),(4551,'Carleton',4520),(4552,'Causapscal',4520),(4553,'Chandler',4520),(4554,'Chapais',4520),(4555,'Charlesbourg',4520),(4556,'Chateau-Richer',4520),(4557,'Chibougamou',4520),(4558,'Chicoutimi-Jonquiere',4520),(4559,'Chisasibi',4520),(4560,'Chute-aux-Outardes',4520),(4561,'Clermont',4520),(4562,'Coaticook',4520),(4563,'Coleraine',4520),(4564,'Contrecoeur',4520),(4565,'Cookshire',4520),(4566,'Cowansville',4520),(4567,'Crabtree',4520),(4568,'Danville',4520),(4569,'Daveluyville',4520),(4570,'Degelis',4520),(4571,'Desbiens',4520),(4572,'Disraeli',4520),(4573,'Dolbeau',4520),(4574,'Donnacona',4520),(4575,'Dorval',4520),(4576,'Drummondville',4520),(4577,'East Angus',4520),(4578,'East Broughton',4520),(4579,'Farnham',4520),(4580,'Ferme-Neuve',4520),(4581,'Fermont',4520),(4582,'Filion',4520),(4583,'Forestville',4520),(4584,'Fort-Coulonge',4520),(4585,'Gaspe',4520),(4586,'Gentilly',4520),(4587,'Granby',4520),(4588,'Grande-Riviere',4520),(4589,'Grenville',4520),(4590,'Ham Nord',4520),(4591,'Hampstead',4520),(4592,'Hauterive',4520),(4593,'Havre-Saint-Pierre',4520),(4594,'Hebertville',4520),(4595,'Huntingdon',4520),(4596,'Joliette',4520),(4597,'Kingsey Falls',4520),(4598,'L\'Annonciation',4520),(4599,'L\'Ascension-de-Notre-Seigneur',4520),(4600,'L\'Epiphanie',4520),(4601,'La Malbaie',4520),(4602,'La Pocatiere',4520),(4603,'La Sarre',4520),(4604,'La Tuque',4520),(4605,'Labelle',4520),(4606,'Lac-au-Saumon',4520),(4607,'Lac-Etchemin',4520),(4608,'Lac-Lapierre',4520),(4609,'Lac-Megantic',4520),(4610,'Lachine',4520),(4611,'Lachute',4520),(4612,'Lacolle',4520),(4613,'Lasalle',4520),(4614,'Laurentides',4520),(4615,'Laurier-Station',4520),(4616,'Laval',4520),(4617,'Lavaltrie',4520),(4618,'Le Bic',4520),(4619,'Lebel-sur-Quevillon',4520),(4620,'Les Cedres',4520),(4621,'Les Coteaux',4520),(4622,'Les Escoumins',4520),(4623,'Liniere',4520),(4624,'Longueuil',4520),(4625,'Louiseville',4520),(4626,'Luceville',4520),(4627,'Macamic',4520),(4628,'Magog',4520),(4629,'Malartic',4520),(4630,'Maniwaki',4520),(4631,'Marieville',4520),(4632,'Maskinonge',4520),(4633,'Matagami',4520),(4634,'Matane',4520),(4635,'Metabetchouan',4520),(4636,'Mirabel',4520),(4637,'Mistissini',4520),(4638,'Mont-Joli',4520),(4639,'Mont-Laurier',4520),(4640,'Montmagny',4520),(4641,'Montreal',4520),(4642,'Murdochville',4520),(4643,'Napierville',4520),(4644,'New Richmond',4520),(4645,'Nicolet',4520),(4646,'Normandin',4520),(4647,'Notre-Dame-du-Bon-Conseil',4520),(4648,'Notre-Dame-du-Lac',4520),(4649,'Notre-Dame-du-Mont-Carmel',4520),(4650,'Oka-Kanesatake',4520),(4651,'Ormstown',4520),(4652,'Papineauville',4520),(4653,'Pierreville',4520),(4654,'Plessisville',4520),(4655,'Pointe-Claire',4520),(4656,'Pont-Rouge',4520),(4657,'Port-Alfred-Bagotville',4520),(4658,'Port-Cartier',4520),(4659,'Portneuf',4520),(4660,'Princeville',4520),(4661,'Rawdon',4520),(4662,'Repentigny',4520),(4663,'Rigaud',4520),(4664,'Rimouski',4520),(4665,'Riviere-au-Renard',4520),(4666,'Riviere-du-Loup',4520),(4667,'Roberval',4520),(4668,'Rougemont',4520),(4669,'Rouyn-Noranda',4520),(4670,'Saint-Agapit',4520),(4671,'Saint-Alexandre',4520),(4672,'Saint-Alexis-des-Monts',4520),(4673,'Saint-Ambroise',4520),(4674,'Saint-Andre-Avellin',4520),(4675,'Saint-Anselme',4520),(4676,'Saint-Apollinaire',4520),(4677,'Saint-Augustin',4520),(4678,'Saint-Basile-Sud',4520),(4679,'Saint-Bruno',4520),(4680,'Saint-Canut',4520),(4681,'Saint-Cesaire',4520),(4682,'Saint-Cyrill-de-Wendover',4520),(4683,'Saint-Damase',4520),(4684,'Saint-Damien-de-Buckland',4520),(4685,'Saint-Denis',4520),(4686,'Saint-Donat-de-Montcalm',4520),(4687,'Saint-Ephrem-de-Tring',4520),(4688,'Saint-Fabien',4520),(4689,'Saint-Felicien',4520),(4690,'Saint-Felix-de-Valois',4520),(4691,'Saint-Gabriel',4520),(4692,'Saint-Gedeon',4520),(4693,'Saint-Georges',4520),(4694,'Saint-Germain-de-Grantham',4520),(4695,'Saint-Gregoire',4520),(4696,'Saint-Henri-de-Levis',4520),(4697,'Saint-Honore',4520),(4698,'Saint-Hyacinthe',4520),(4699,'Saint-Jacques',4520),(4700,'Saint-Jean-de-Dieu',4520),(4701,'Saint-Jean-Port-Joli',4520),(4702,'Saint-Jean-sur-Richelieu',4520),(4703,'Saint-Jerome',4520),(4704,'Saint-Josephe-de-Beauce',4520),(4705,'Saint-Josephe-de-la-Riviere-Bl',4520),(4706,'Saint-Josephe-de-Lanoraie',4520),(4707,'Saint-Jovite',4520),(4708,'Saint-Laurent',4520),(4709,'Saint-Liboire',4520),(4710,'Saint-Marc-des-Carrieres',4520),(4711,'Saint-Martin',4520),(4712,'Saint-Michel-des-Saints',4520),(4713,'Saint-Pacome',4520),(4714,'Saint-Pascal',4520),(4715,'Saint-Pie',4520),(4716,'Saint-Prosper',4520),(4717,'Saint-Raphael',4520),(4718,'Saint-Raymond',4520),(4719,'Saint-Remi',4520),(4720,'Saint-Roch-de-l\'Achigan',4520),(4721,'Saint-Sauveur-des-Monts',4520),(4722,'Saint-Tite',4520),(4723,'Sainte-Adele',4520),(4724,'Sainte-Agathe-des-Monts',4520),(4725,'Sainte-Anne-des-Monts',4520),(4726,'Sainte-Anne-des-Plaines',4520),(4727,'Sainte-Catherine',4520),(4728,'Sainte-Claire',4520),(4729,'Sainte-Julienne',4520),(4730,'Sainte-Justine',4520),(4731,'Sainte-Madeleine',4520),(4732,'Sainte-Marie',4520),(4733,'Sainte-Martine',4520),(4734,'Sainte-Sophie',4520),(4735,'Sainte-Thecle',4520),(4736,'Sainte-Therese',4520),(4737,'Salaberry-de-Valleyfield',4520),(4738,'Sayabec',4520),(4739,'Senneterre',4520),(4740,'Sept-Iles',4520),(4741,'Shawinigan',4520),(4742,'Shawville',4520),(4743,'Sherbrooke',4520),(4744,'Sorel',4520),(4745,'St Faustin',4520),(4746,'St. Hubert',4520),(4747,'St. Jean Chrysostome',4520),(4748,'Temiscaming',4520),(4749,'Terrebonne',4520),(4750,'Thetford Mines',4520),(4751,'Thurso',4520),(4752,'Trois-Pistoles',4520),(4753,'Trois-Rivieres',4520),(4754,'Val-d\'Or',4520),(4755,'Val-David',4520),(4756,'Valcourt',4520),(4757,'Vallee-Jonction',4520),(4758,'Vaudreuil',4520),(4759,'Vercheres',4520),(4760,'Victoriaville',4520),(4761,'Ville-Marie',4520),(4762,'Warwick',4520),(4763,'Weedon Centre',4520),(4764,'Westmount',4520),(4765,'Yamachiche',4520),(4766,'Saskatchewan',4063),(4767,'Assiniboia',4766),(4768,'Biggar',4766),(4769,'Canora',4766),(4770,'Carlyle',4766),(4771,'Carnduff',4766),(4772,'Caronport',4766),(4773,'Carrot',4766),(4774,'Dalmeny',4766),(4775,'Davidson',4766),(4776,'Esterhazy',4766),(4777,'Estevan',4766),(4778,'Eston',4766),(4779,'Foam Lake',4766),(4780,'Fort Qu\'Appelle',4766),(4781,'Gravelbourg',4766),(4782,'Grenfell',4766),(4783,'Gull Lake',4766),(4784,'Hudson Bay',4766),(4785,'Humboldt',4766),(4786,'Indian Head',4766),(4787,'Kamsack',4766),(4788,'Kelvington',4766),(4789,'Kerrobert',4766),(4790,'Kindersley',4766),(4791,'Kipling',4766),(4792,'La Ronge',4766),(4793,'Langenburg',4766),(4794,'Langham',4766),(4795,'Lanigan',4766),(4796,'Lumsden',4766),(4797,'Macklin',4766),(4798,'Maple Creek',4766),(4799,'Martensville',4766),(4800,'Meadow Lake',4766),(4801,'Melfort',4766),(4802,'Melville',4766),(4803,'Moose Jaw',4766),(4804,'Moosomin',4766),(4805,'Nipawin',4766),(4806,'North Battleford',4766),(4807,'Outlook',4766),(4808,'Oxbow',4766),(4809,'Pilot Butte',4766),(4810,'Preeceville',4766),(4811,'Prince Albert',4766),(4812,'Regina',4766),(4813,'Rosetown',4766),(4814,'Rosthem',4766),(4815,'Saskatoon',4766),(4816,'Shaunavon',4766),(4817,'Shellbrook',4766),(4818,'Swift Current',4766),(4819,'Tisdale',4766),(4820,'Unity',4766),(4821,'Wadena',4766),(4822,'Warman',4766),(4823,'Watrous',4766),(4824,'Weyburn',4766),(4825,'White City',4766),(4826,'Wilkie',4766),(4827,'Wynyard',4766),(4828,'Yorkton',4766),(4829,'Yukon',4063),(4830,'Haines Junction',4829),(4831,'Mayo',4829),(4832,'Whitehorse',4829),(4833,'Cape Verde',NULL),(4834,'Boavista',4833),(4835,'Sal Rei',4834),(4836,'Brava',4833),(4837,'Nova Sintra',4836),(4838,'Fogo',4833),(4839,'Mosteiros',4838),(4840,'Sao Filipe',4838),(4841,'Maio',4833),(4842,'Vila do Maio',4841),(4843,'Sal',4833),(4844,'Santa Maria',4843),(4845,'Santo Antao',4833),(4846,'Sao Nicolau',4833),(4847,'Sao Tiago',4833),(4848,'Sao Vicente',4833),(4849,'Cayman Islands',NULL),(4850,'Grand Cayman',4849),(4851,'Central African Republic',NULL),(4852,'Bamingui-Bangoran',4851),(4853,'Ndele',4852),(4854,'Bangui',4851),(4855,'Basse-Kotto',4851),(4856,'Alindao',4855),(4857,'Kembe',4855),(4858,'Mobaye',4855),(4859,'Haut-Mbomou',4851),(4860,'Obo',4859),(4861,'Zemio',4859),(4862,'Haute-Kotto',4851),(4863,'Bria',4862),(4864,'Ouadda',4862),(4865,'Kemo',4851),(4866,'Dekoa',4865),(4867,'Sibut',4865),(4868,'Lobaye',4851),(4869,'Boda',4868),(4870,'Mbaiki',4868),(4871,'Mongoumba',4868),(4872,'Mambere-Kadei',4851),(4873,'Berberati',4872),(4874,'Carnot',4872),(4875,'Gamboula',4872),(4876,'Mbomou',4851),(4877,'Bangassou',4876),(4878,'Gambo',4876),(4879,'Ouango',4876),(4880,'Rafai',4876),(4881,'Nana-Gribizi',4851),(4882,'Kaga-Bandoro',4881),(4883,'Nana-Mambere',4851),(4884,'Baboua',4883),(4885,'Baoro',4883),(4886,'Bouar',4883),(4887,'Ombella Mpoko',4851),(4888,'Ouaka',4851),(4889,'Bambari',4888),(4890,'Grimari',4888),(4891,'Ippy',4888),(4892,'Kouango',4888),(4893,'Ouham',4851),(4894,'Batangafo',4893),(4895,'Bossangoa',4893),(4896,'Bouca',4893),(4897,'Kabo',4893),(4898,'Ouham-Pende',4851),(4899,'Bocaranga',4898),(4900,'Bozoum',4898),(4901,'Paoua',4898),(4902,'Sangha-Mbaere',4851),(4903,'Nola',4902),(4904,'Vakaga',4851),(4905,'Birao',4904),(4906,'Chad',NULL),(4907,'Batha',4906),(4908,'Ati',4907),(4909,'Oum Hadjer',4907),(4910,'Biltine',4906),(4911,'Bourkou-Ennedi-Tibesti',4906),(4912,'Aouzou',4911),(4913,'Bardai',4911),(4914,'Fada',4911),(4915,'Faya',4911),(4916,'Chari-Baguirmi',4906),(4917,'Bokoro',4916),(4918,'Bousso',4916),(4919,'Dourbali',4916),(4920,'Massaguet',4916),(4921,'Massakory',4916),(4922,'Massenya',4916),(4923,'N\'Djamena',4916),(4924,'Ngama',4916),(4925,'Guera',4906),(4926,'Bitkine',4925),(4927,'Melfi',4925),(4928,'Mongo',4925),(4929,'Kanem',4906),(4930,'Mao',4929),(4931,'Moussoro',4929),(4932,'Rig-Rig',4929),(4933,'Lac',4906),(4934,'Bol',4933),(4935,'Logone Occidental',4906),(4936,'Logone Oriental',4906),(4937,'Mayo-Kebbi',4906),(4938,'Bongor',4937),(4939,'Fianga',4937),(4940,'Gounou Gaya',4937),(4941,'Guelengdeng',4937),(4942,'Lere',4937),(4943,'Pala',4937),(4944,'Moyen-Chari',4906),(4945,'Goundi',4944),(4946,'Koumra',4944),(4947,'Kyabe',4944),(4948,'Moissala',4944),(4949,'Sarh',4944),(4950,'Ouaddai',4906),(4951,'Abeche',4950),(4952,'Adre',4950),(4953,'Am Dam',4950),(4954,'Salamat',4906),(4955,'Abou Deia',4954),(4956,'Am Timan',4954),(4957,'Mangueigne',4954),(4958,'Tandjile',4906),(4959,'Benoy',4958),(4960,'Kelo',4958),(4961,'Lai',4958),(4962,'Chile',NULL),(4963,'Aisen',4962),(4964,'Chile Chico',4963),(4965,'Cisnes',4963),(4966,'Coihaique',4963),(4967,'Guaitecas',4963),(4968,'Lago Verde',4963),(4969,'O\'Higgins',4963),(4970,'Rio Ibanez',4963),(4971,'Tortel',4963),(4972,'Antofagasta',4962),(4973,'Calama',4972),(4974,'Maria Elena',4972),(4975,'Mejilones',4972),(4976,'Ollague',4972),(4977,'San Pedro de Atacama',4972),(4978,'Sierra Gorda',4972),(4979,'Taltal',4972),(4980,'Tocopilla',4972),(4981,'Araucania',4962),(4982,'Angol',4981),(4983,'Carahue',4981),(4984,'Collipulli',4981),(4985,'Cunco',4981),(4986,'Curacautin',4981),(4987,'Curarrehue',4981),(4988,'Ercilla',4981),(4989,'Freire',4981),(4990,'Galvarino',4981),(4991,'Gorbea',4981),(4992,'Lautaro',4981),(4993,'Loncoche',4981),(4994,'Lonquimay',4981),(4995,'Los Sauces',4981),(4996,'Lumaco',4981),(4997,'Melipeuco',4981),(4998,'Nueva Imperial',4981),(4999,'Padre las Casas',4981),(5000,'Perquenco',4981),(5001,'Pitrufquen',4981),(5002,'Pucon',4981),(5003,'Puren',4981),(5004,'Renaico',4981),(5005,'Saavedra',4981),(5006,'Temuco',4981),(5007,'Teodoro Schmidt',4981),(5008,'Tolten',4981),(5009,'Traiguen',4981),(5010,'Vilcun',4981),(5011,'Villarica',4981),(5012,'Atacama',4962),(5013,'Alto del Carmen',5012),(5014,'Caldera',5012),(5015,'Chanaral',5012),(5016,'Copiapo',5012),(5017,'Diego de Almagro',5012),(5018,'Freirina',5012),(5019,'Huasco',5012),(5020,'Tierra Amarilla',5012),(5021,'Vallenar',5012),(5022,'Bio Bio',4962),(5023,'Coquimbo',4962),(5024,'Andacollo',5023),(5025,'Canela',5023),(5026,'Combarbala',5023),(5027,'Illapel',5023),(5028,'La Higuera',5023),(5029,'La Serena',5023),(5030,'Los Vilos',5023),(5031,'Monte Patria',5023),(5032,'Ovalle',5023),(5033,'Paiguano',5023),(5034,'Punitaci',5023),(5035,'Rio Hurtado',5023),(5036,'Salamanca',5023),(5037,'Vicuna',5023),(5038,'Libertador General Bernardo O\'',4962),(5039,'Los Lagos',4962),(5040,'Magellanes',4962),(5041,'Cabo de Horno',5040),(5042,'Laguna Blanca',5040),(5043,'Natales',5040),(5044,'Porvenir',5040),(5045,'Primavera',5040),(5046,'Punta Arenas',5040),(5047,'San Gregorio',5040),(5048,'Timaukel',5040),(5049,'Torres del Paine',5040),(5050,'Maule',4962),(5051,'Cauquenes',5050),(5052,'Chanco',5050),(5053,'Colbun',5050),(5054,'Constitucion',5050),(5055,'Curepto',5050),(5056,'Curico',5050),(5057,'Empedrado',5050),(5058,'Hualane',5050),(5059,'Licanten',5050),(5060,'Linares',5050),(5061,'Longavi',5050),(5062,'Molina',5050),(5063,'Parral',5050),(5064,'Pelarco',5050),(5065,'Pelluhue',5050),(5066,'Pencahue',5050),(5067,'Rauco',5050),(5068,'Retiro',5050),(5069,'Rio Claro',5050),(5070,'Romeral',5050),(5071,'Sagrada Familia',5050),(5072,'San Clemente',5050),(5073,'San Javier',5050),(5074,'San Rafael',5050),(5075,'Talca',5050),(5076,'Teno',5050),(5077,'Vichuquen',5050),(5078,'Villa Alegre',5050),(5079,'Yerbas Buenas',5050),(5080,'Metropolitana',4962),(5081,'Alhue',5080),(5082,'Buin',5080),(5083,'Calera de Tango',5080),(5084,'Colina',5080),(5085,'Curacavi',5080),(5086,'El Monte',5080),(5087,'Isla de Maipo',5080),(5088,'Lampa',5080),(5089,'Maria Pinto',5080),(5090,'Melipilla',5080),(5091,'Padre Hurtado',5080),(5092,'Paine',5080),(5093,'Penaflor',5080),(5094,'Pirque',5080),(5095,'Puente Alto',5080),(5096,'Quilicura',5080),(5097,'San Bernardo',5080),(5098,'San Jose de Maipo',5080),(5099,'San Pedro',5080),(5100,'Santiago',5080),(5101,'Talagante',5080),(5102,'Tiltil',5080),(5103,'Metropolitana de Santiago',4962),(5104,'Tarapaca',4962),(5105,'Arica',5104),(5106,'Camarones',5104),(5107,'Camina',5104),(5108,'Colchane',5104),(5109,'General Lagos',5104),(5110,'Huara',5104),(5111,'Iquique',5104),(5112,'Pica',5104),(5113,'Pozo Almonte',5104),(5114,'Putre',5104),(5115,'Valparaiso',4962),(5116,'Algarrobo',5115),(5117,'Cabildo',5115),(5118,'Calera',5115),(5119,'Calle Larga',5115),(5120,'Cartagena',5115),(5121,'Casablanca',5115),(5122,'Catemu',5115),(5123,'Concon',5115),(5124,'El Quisco',5115),(5125,'El Tabo',5115),(5126,'Hijuelas',5115),(5127,'La Cruz',5115),(5128,'La Ligua',5115),(5129,'Limache',5115),(5130,'Llaillay',5115),(5131,'Los Andes',5115),(5132,'Nogales',5115),(5133,'Olmue',5115),(5134,'Panquehue',5115),(5135,'Papudo',5115),(5136,'Petorca',5115),(5137,'Puchuncavi',5115),(5138,'Putaendeo',5115),(5139,'Quillota',5115),(5140,'Quilpue',5115),(5141,'Quintero',5115),(5142,'Rinconada',5115),(5143,'San Antonio',5115),(5144,'San Esteban',5115),(5145,'San Felipe',5115),(5146,'Santo Domingo',5115),(5147,'Villa Alemana',5115),(5148,'Vina del Mar',5115),(5149,'Zapallar',5115),(5150,'China',NULL),(5151,'Anhui',5150),(5152,'Fengyang',5151),(5153,'Guangde',5151),(5154,'Liuan',5151),(5155,'Ningguo',5151),(5156,'Shucheng',5151),(5157,'Xinchang',5151),(5158,'Xuancheng',5151),(5159,'Aomen',5150),(5160,'Beijing',5150),(5161,'Changping',5160),(5162,'Fangshan',5160),(5163,'Huangcun',5160),(5164,'Liangxiang',5160),(5165,'Mentougou',5160),(5166,'Shunyi',5160),(5167,'Tongzhou',5160),(5168,'Beijing Shi',5150),(5169,'Chongqing',5150),(5170,'Beibei',5169),(5171,'Fuling',5169),(5172,'Longhua',5169),(5173,'Nantongkuang',5169),(5174,'Wanxian',5169),(5175,'Xiuma',5169),(5176,'Yubei',5169),(5177,'Yudong',5169),(5178,'Fujian',5150),(5179,'Bantou',5178),(5180,'Dongshan',5178),(5181,'Fuan',5178),(5182,'Fuqing',5178),(5183,'Fuzhou',5178),(5184,'Gantou',5178),(5185,'Hanyang',5178),(5186,'Jiangkou',5178),(5187,'Jiaocheng',5178),(5188,'Jinjiang',5178),(5189,'Jinshang',5178),(5190,'Longhai',5178),(5191,'Longyan',5178),(5192,'Luoyang',5178),(5193,'Nanan',5178),(5194,'Nanping',5178),(5195,'Nanpu',5178),(5196,'Putian',5178),(5197,'Qingyang',5178),(5198,'Quanzhou',5178),(5199,'Rongcheng',5178),(5200,'Sanming',5178),(5201,'Shaowu',5178),(5202,'Shima',5178),(5203,'Shishi',5178),(5204,'Tantou',5178),(5205,'Tongshan',5178),(5206,'Xiamen',5178),(5207,'Xiapu',5178),(5208,'Xiapu Ningde',5178),(5209,'Ximei',5178),(5210,'Yongan',5178),(5211,'Zhangzhou',5178),(5212,'Zhicheng',5178),(5213,'Gansu',5150),(5214,'Baiyin',5213),(5215,'Baoji',5213),(5216,'Beidao',5213),(5217,'Jiayuguan',5213),(5218,'Jinchang',5213),(5219,'Jiuquan',5213),(5220,'Lanzhou',5213),(5221,'Linxia',5213),(5222,'Pingliang',5213),(5223,'Qincheng',5213),(5224,'Wuwei',5213),(5225,'Yaojie',5213),(5226,'Yumen',5213),(5227,'Zhangye',5213),(5228,'Zhuanglang',5213),(5229,'Guangdong',5150),(5230,'Anbu',5229),(5231,'Chaozhou',5229),(5232,'Chenghai',5229),(5233,'Chuncheng',5229),(5234,'Daliang',5229),(5235,'Danshui',5229),(5236,'Dongguan',5229),(5237,'Donghai',5229),(5238,'Dongli',5229),(5239,'Dongzhen',5229),(5240,'Ducheng',5229),(5241,'Encheng',5229),(5242,'Foahn',5229),(5243,'Foshan',5229),(5244,'Gaozhou',5229),(5245,'Guangzhou',5229),(5246,'Guanjiao',5229),(5247,'Haicheng',5229),(5248,'Haimen',5229),(5249,'Hepo',5229),(5250,'Houpu',5229),(5251,'Huaicheng',5229),(5252,'Huanggang',5229),(5253,'Huangpu',5229),(5254,'Huazhou',5229),(5255,'Huicheng',5229),(5256,'Huizhou',5229),(5257,'Humen',5229),(5258,'Jiangmen',5229),(5259,'Jiazi',5229),(5260,'Jieshi',5229),(5261,'Jieyang',5229),(5262,'Lecheng',5229),(5263,'Leicheng',5229),(5264,'Liancheng',5229),(5265,'Lianzhou',5229),(5266,'Licheng',5229),(5267,'Liusha',5229),(5268,'Longgang',5229),(5269,'Lubu',5229),(5270,'Luocheng',5229),(5271,'Luohu',5229),(5272,'Maba',5229),(5273,'Maoming',5229),(5274,'Mata',5229),(5275,'Meilu',5229),(5276,'Meizhou',5229),(5277,'Mianchang',5229),(5278,'Nanfeng',5229),(5279,'Nanhai',5229),(5280,'Pingshan',5229),(5281,'Qingtang',5229),(5282,'Qingyuan',5229),(5283,'Sanbu',5229),(5284,'Shantou',5229),(5285,'Shanwei',5229),(5286,'Shaoguan',5229),(5287,'Shaping',5229),(5288,'Shenzhen',5229),(5289,'Shilong',5229),(5290,'Shiqiao',5229),(5291,'Shiwan',5229),(5292,'Shuizhai',5229),(5293,'Shunde',5229),(5294,'Suicheng',5229),(5295,'Taicheng',5229),(5296,'Tangping',5229),(5297,'Xiaolan',5229),(5298,'Xinan',5229),(5299,'Xingcheng',5229),(5300,'Xiongzhou',5229),(5301,'Xucheng',5229),(5302,'Yangjiang',5229),(5303,'Yingcheng',5229),(5304,'Yuancheng',5229),(5305,'Yuncheng',5229),(5306,'Yunfu',5229),(5307,'Zengcheng',5229),(5308,'Zhanjiang',5229),(5309,'Zhaoqing',5229),(5310,'Zhilong',5229),(5311,'Zhongshan',5229),(5312,'Zhuhai',5229),(5313,'Guangxi',5150),(5314,'Babu',5313),(5315,'Baihe',5313),(5316,'Baise',5313),(5317,'Beihai',5313),(5318,'Binzhou',5313),(5319,'Bose',5313),(5320,'Fangchenggang',5313),(5321,'Guicheng',5313),(5322,'Guilin',5313),(5323,'Guiping',5313),(5324,'Jinchengjiang',5313),(5325,'Jinji',5313),(5326,'Laibin',5313),(5327,'Liuzhou',5313),(5328,'Luorong',5313),(5329,'Matong',5313),(5330,'Nandu',5313),(5331,'Nanning',5313),(5332,'Pingnan',5313),(5333,'Pumiao',5313),(5334,'Qinzhou',5313),(5335,'Songhua',5313),(5336,'Wuzhou',5313),(5337,'Yashan',5313),(5338,'Yulin',5313),(5339,'Guizhou',5150),(5340,'Anshun',5339),(5341,'Bijie',5339),(5342,'Caohai',5339),(5343,'Duyun',5339),(5344,'Guiyang',5339),(5345,'Kaili',5339),(5346,'Liupanshui',5339),(5347,'Pingzhai',5339),(5348,'Tongren',5339),(5349,'Tongzi',5339),(5350,'Xiaoweizhai',5339),(5351,'Xingyi',5339),(5352,'Zunyi',5339),(5353,'Hainan',5150),(5354,'Chengmai',5353),(5355,'Dingan',5353),(5356,'Haikou',5353),(5357,'Lingao',5353),(5358,'Qiongshan',5353),(5359,'Sansha ',5353),(5360,'Sanya',5353),(5361,'Wanning',5353),(5362,'Hebei',5150),(5363,'Anping',5362),(5364,'Baoding',5362),(5365,'Botou',5362),(5366,'Cangzhou',5362),(5367,'Changli',5362),(5368,'Chengde',5362),(5369,'Dingzhou',5362),(5370,'Fengfeng',5362),(5371,'Fengrun',5362),(5372,'Guye',5362),(5373,'Handan',5362),(5374,'Hecun',5362),(5375,'Hejian',5362),(5376,'Hengshui',5362),(5377,'Huanghua',5362),(5378,'Jingxingkuang',5362),(5379,'Jinzhou',5362),(5380,'Langfang',5362),(5381,'Linshui',5362),(5382,'Linxi',5362),(5383,'Longyao County',5362),(5384,'Nangong',5362),(5385,'Pengcheng',5362),(5386,'Qinhuangdao',5362),(5387,'Renqiu',5362),(5388,'Shahe',5362),(5389,'Shijiazhuang',5362),(5390,'Tangjiazhuang',5362),(5391,'Tangshan',5362),(5392,'Wuan',5362),(5393,'Xian County',5362),(5394,'Xingtai',5362),(5395,'Xinji',5362),(5396,'Xinle',5362),(5397,'Xuanhua',5362),(5398,'Zhangjiakou',5362),(5399,'Zhaogezhuang',5362),(5400,'Zhuozhou',5362),(5401,'Heilongjiang',5150),(5402,'Acheng',5401),(5403,'Anda',5401),(5404,'Angangxi',5401),(5405,'Baiquan',5401),(5406,'Bamiantong',5401),(5407,'Baoqing',5401),(5408,'Baoshan',5401),(5409,'Bayan',5401),(5410,'Beian',5401),(5411,'Boli',5401),(5412,'Chaihe',5401),(5413,'Chengzihe',5401),(5414,'Cuiluan',5401),(5415,'Daqing',5401),(5416,'Didao',5401),(5417,'Dongning',5401),(5418,'Fujin',5401),(5419,'Fuli',5401),(5420,'Fulitun',5401),(5421,'Fuyu',5401),(5422,'Gannan',5401),(5423,'Hailin',5401),(5424,'Hailun',5401),(5425,'Harbin',5401),(5426,'Hegang',5401),(5427,'Heihe',5401),(5428,'Hengshan',5401),(5429,'Honggang',5401),(5430,'Huanan',5401),(5431,'Hulan',5401),(5432,'Hulan Ergi',5401),(5433,'Jiamusi',5401),(5434,'Jidong',5401),(5435,'Jixi',5401),(5436,'Keshan',5401),(5437,'Langxiang',5401),(5438,'Lanxi',5401),(5439,'Lingdong',5401),(5440,'Linkou',5401),(5441,'Lishu',5401),(5442,'Longfeng',5401),(5443,'Longjiang',5401),(5444,'Mingshui',5401),(5445,'Mishan',5401),(5446,'Mudanjiang',5401),(5447,'Nancha',5401),(5448,'Nehe',5401),(5449,'Nenjiang',5401),(5450,'Nianzishan',5401),(5451,'Ningan',5401),(5452,'Qingan',5401),(5453,'Qinggang',5401),(5454,'Qiqihar',5401),(5455,'Qitaihe',5401),(5456,'Ranghulu',5401),(5457,'Saertu',5401),(5458,'Shangzhi',5401),(5459,'Shanhetun',5401),(5460,'Shuangcheng',5401),(5461,'Shuangyashan',5401),(5462,'Sifantan',5401),(5463,'Suifenhe',5401),(5464,'Suihua',5401),(5465,'Suileng',5401),(5466,'Tahe',5401),(5467,'Taikang',5401),(5468,'Tailai',5401),(5469,'Tieli',5401),(5470,'Wangkui',5401),(5471,'Weihe',5401),(5472,'Wuchang',5401),(5473,'Xinglongzhen',5401),(5474,'Xinqing',5401),(5475,'Yian',5401),(5476,'Yichun',5401),(5477,'Yilan',5401),(5478,'Youhao',5401),(5479,'Zhaodong',5401),(5480,'Zhaoyuan',5401),(5481,'Zhaozhou',5401),(5482,'Henan',5150),(5483,'Anyang',5482),(5484,'Changying',5482),(5485,'Dancheng',5482),(5486,'Daokou',5482),(5487,'Dengzhou',5482),(5488,'Gongyi',5482),(5489,'Gushi',5482),(5490,'Hebi',5482),(5491,'Huaidian',5482),(5492,'Huangchuan',5482),(5493,'Huangzhai',5482),(5494,'Jiaozuo',5482),(5495,'Jishui',5482),(5496,'Kaifeng',5482),(5497,'Liupen',5482),(5498,'Luohe',5482),(5499,'Luyang',5482),(5500,'Mengzhou',5482),(5501,'Minggang',5482),(5502,'Nandun',5482),(5503,'Nanyang',5482),(5504,'Pingdingshan',5482),(5505,'Puyang',5482),(5506,'Sanmenxia',5482),(5507,'Shangqiu',5482),(5508,'Tanghe',5482),(5509,'Xiaoyi',5482),(5510,'Xihua',5482),(5511,'Xinxiang',5482),(5512,'Xinyang',5482),(5513,'Xinye',5482),(5514,'Xixiang',5482),(5515,'Xuanwu',5482),(5516,'Xuchang',5482),(5517,'Yigou',5482),(5518,'Yima',5482),(5519,'Yinzhuang',5482),(5520,'Yunyang',5482),(5521,'Yuzhou',5482),(5522,'Zhecheng',5482),(5523,'Zhengzhou',5482),(5524,'Zhenping',5482),(5525,'Zhoukou',5482),(5526,'Zhumadian',5482),(5527,'Hubei',5150),(5528,'Anlu',5527),(5529,'Baisha',5527),(5530,'Buhe',5527),(5531,'Caidian',5527),(5532,'Caohe',5527),(5533,'Danjiangkou',5527),(5534,'Daye',5527),(5535,'Duobao',5527),(5536,'Enshi',5527),(5537,'Ezhou',5527),(5538,'Fengkou',5527),(5539,'Guangshui',5527),(5540,'Gucheng',5527),(5541,'Hanchuan',5527),(5542,'Hongan',5527),(5543,'Honghu',5527),(5544,'Huangmei',5527),(5545,'Huangpi',5527),(5546,'Huangshi',5527),(5547,'Huangzhou',5527),(5548,'Jingmen',5527),(5549,'Jingzhou',5527),(5550,'Laohekou',5527),(5551,'Lichuan',5527),(5552,'Macheng',5527),(5553,'Nanzhang',5527),(5554,'Puqi',5527),(5555,'Qianjiang',5527),(5556,'Qingquan',5527),(5557,'Qixingtai',5527),(5558,'Shashi',5527),(5559,'Shishou',5527),(5560,'Shiyan',5527),(5561,'Suizhou',5527),(5562,'Tianmen',5527),(5563,'Tongcheng',5527),(5564,'Wuhan',5527),(5565,'Wuxue',5527),(5566,'Xiangfan',5527),(5567,'Xianning',5527),(5568,'Xiantao',5527),(5569,'Xiaogan',5527),(5570,'Xiaoxita',5527),(5571,'Xiaxindian',5527),(5572,'Xihe',5527),(5573,'Xinpu',5527),(5574,'Xinshi',5527),(5575,'Xinzhou',5527),(5576,'Yichang',5527),(5577,'Yicheng',5527),(5578,'Yingzhong',5527),(5579,'Zaoyang',5527),(5580,'Zhengchang',5527),(5581,'Zhifang',5527),(5582,'Zhongxiang',5527),(5583,'Hunan',5150),(5584,'Anjiang',5583),(5585,'Anxiang',5583),(5586,'Changde',5583),(5587,'Changsha',5583),(5588,'Chenzhou',5583),(5589,'Dayong',5583),(5590,'Hengyang',5583),(5591,'Hongjiang',5583),(5592,'Huaihua',5583),(5593,'Jinshi',5583),(5594,'Jishou',5583),(5595,'Leiyang',5583),(5596,'Lengshuijiang',5583),(5597,'Lengshuitan',5583),(5598,'Lianyuan',5583),(5599,'Liling',5583),(5600,'Liuyang',5583),(5601,'Loudi',5583),(5602,'Matian',5583),(5603,'Nanzhou',5583),(5604,'Ningxiang',5583),(5605,'Qidong',5583),(5606,'Qiyang',5583),(5607,'Shaoyang',5583),(5608,'Xiangtan',5583),(5609,'Xiangxiang',5583),(5610,'Xiangyin',5583),(5611,'Xinhua',5583),(5612,'Yiyang',5583),(5613,'Yongfeng',5583),(5614,'Yongzhou',5583),(5615,'Yuanjiang',5583),(5616,'Yueyang',5583),(5617,'Zhuzhou',5583),(5618,'Jiangsu',5150),(5619,'Baoying',5618),(5620,'Changzhou',5618),(5621,'Dachang',5618),(5622,'Dafeng',5618),(5623,'Danyang',5618),(5624,'Dingshu',5618),(5625,'Dongkan',5618),(5626,'Dongtai',5618),(5627,'Fengxian',5618),(5628,'Gaogou',5618),(5629,'Gaoyou',5618),(5630,'Guiren',5618),(5631,'Haian',5618),(5632,'Haizhou',5618),(5633,'Hede',5618),(5634,'Huaiyin',5618),(5635,'Huilong',5618),(5636,'Hutang',5618),(5637,'Jiangdu',5618),(5638,'Jiangyan',5618),(5639,'Jiangyin',5618),(5640,'Jiangyuan',5618),(5641,'Jianhu',5618),(5642,'Jingcheng',5618),(5643,'Jinsha',5618),(5644,'Jintan',5618),(5645,'Juegang',5618),(5646,'Jurong',5618),(5647,'Kunshan',5618),(5648,'Lianyungang',5618),(5649,'Liucheng',5618),(5650,'Liyang',5618),(5651,'Luodu',5618),(5652,'Mudu',5618),(5653,'Nanjing',5618),(5654,'Nantong',5618),(5655,'Pecheng',5618),(5656,'Pukou',5618),(5657,'Qinnan',5618),(5658,'Qixia',5618),(5659,'Rucheng',5618),(5660,'Songling',5618),(5661,'Sucheng',5618),(5662,'Suqian',5618),(5663,'Suzhou',5618),(5664,'Taicang',5618),(5665,'Taixing',5618),(5666,'Wujiang',5618),(5667,'Wuxi',5618),(5668,'Xiaolingwei',5618),(5669,'Xiaoshi',5618),(5670,'Xuzhou',5618),(5671,'Yancheng',5618),(5672,'Yangshe',5618),(5673,'Yangzhou',5618),(5674,'Yizheng',5618),(5675,'Yunhe',5618),(5676,'Yushan',5618),(5677,'Zhangjiagang',5618),(5678,'Zhangjiangang',5618),(5679,'Zhaoyang',5618),(5680,'Zhenjiang',5618),(5681,'Zhongxing',5618),(5682,'Jiangxi',5150),(5683,'Fengxin',5682),(5684,'Fenyi',5682),(5685,'Ganzhou',5682),(5686,'Jian',5682),(5687,'Jiangguang',5682),(5688,'Jingdezhen',5682),(5689,'Jiujiang',5682),(5690,'Leping',5682),(5691,'Linchuan',5682),(5692,'Nanchang',5682),(5693,'Pingxiang',5682),(5694,'Poyang',5682),(5695,'Shangrao',5682),(5696,'Xiangdong',5682),(5697,'Xingan',5682),(5698,'Xinjian',5682),(5699,'Xinyu',5682),(5700,'Xiongshi',5682),(5701,'Yingtai',5682),(5702,'Yingtan',5682),(5703,'Zhangshui',5682),(5704,'Jilin',5150),(5705,'Badaojiang',5704),(5706,'Baicheng',5704),(5707,'Baishishan',5704),(5708,'Changchun',5704),(5709,'Changling',5704),(5710,'Chaoyang',5704),(5711,'Daan',5704),(5712,'Dashitou',5704),(5713,'Dehui',5704),(5714,'Dongchang',5704),(5715,'Dongfeng',5704),(5716,'Dunhua',5704),(5717,'Erdaojiang',5704),(5718,'Gongzhuling',5704),(5719,'Helong',5704),(5720,'Hongmei',5704),(5721,'Huadian',5704),(5722,'Huangnihe',5704),(5723,'Huinan',5704),(5724,'Hunchun',5704),(5725,'Jiaohe',5704),(5726,'Jishu',5704),(5727,'Jiutai',5704),(5728,'Kaitong',5704),(5729,'Kouqian',5704),(5730,'Liaoyuan',5704),(5731,'Linjiang',5704),(5732,'Liuhe',5704),(5733,'Longjing',5704),(5734,'Meihekou',5704),(5735,'Mingyue',5704),(5736,'Nongan',5704),(5737,'Panshi',5704),(5738,'Pizhou',5704),(5739,'Qianan',5704),(5740,'Qianguo',5704),(5741,'Sanchazi',5704),(5742,'Shuangyang',5704),(5743,'Shulan',5704),(5744,'Siping',5704),(5745,'Songjianghe',5704),(5746,'Taonan',5704),(5747,'Tumen',5704),(5748,'Wangou',5704),(5749,'Wangqing',5704),(5750,'Xinglongshan',5704),(5751,'Yanji',5704),(5752,'Yantongshan',5704),(5753,'Yushu',5704),(5754,'Zhengjiatun',5704),(5755,'Zhenlai',5704),(5756,'Liaoning',5150),(5757,'Anshan',5756),(5758,'Beipiao',5756),(5759,'Benxi',5756),(5760,'Changtu',5756),(5761,'Dalian',5756),(5762,'Dalianwan',5756),(5763,'Dalinghe',5756),(5764,'Dandong',5756),(5765,'Dashiqiao',5756),(5766,'Dongling',5756),(5767,'Fengcheng',5756),(5768,'Fushun',5756),(5769,'Fuxin',5756),(5770,'Heishan',5756),(5771,'Huanren',5756),(5772,'Huludao',5756),(5773,'Hushitai',5756),(5774,'Jinxi',5756),(5775,'Jiupu',5756),(5776,'Kaiyuan',5756),(5777,'Kuandian',5756),(5778,'Langtou',5756),(5779,'Liaoyang',5756),(5780,'Liaozhong',5756),(5781,'Lingyuan',5756),(5782,'Liuerbao',5756),(5783,'Lushunkou',5756),(5784,'Nantai',5756),(5785,'Panjin',5756),(5786,'Pulandian',5756),(5787,'Shenyang',5756),(5788,'Sujiatun',5756),(5789,'Tieling',5756),(5790,'Wafangdian',5756),(5791,'Xifeng',5756),(5792,'Xinchengxi',5756),(5793,'Xinmin',5756),(5794,'Xiongyue',5756),(5795,'Xiuyan',5756),(5796,'Yebaishou',5756),(5797,'Yingkou',5756),(5798,'Yuhong',5756),(5799,'Zhuanghe',5756),(5800,'Nei Monggol',5150),(5801,'Ningxia Hui',5150),(5802,'Qinghai',5150),(5803,'Qiatou',5802),(5804,'Xining',5802),(5805,'Shaanxi',5150),(5806,'Ankang',5805),(5807,'Guozhen',5805),(5808,'Hancheng',5805),(5809,'Hanzhong',5805),(5810,'Lishan',5805),(5811,'Qili',5805),(5812,'Tongchuan',5805),(5813,'Weinan',5805),(5814,'Xian',5805),(5815,'Xianyang',5805),(5816,'Yanan',5805),(5817,'Yanliang',5805),(5818,'Yuxia',5805),(5819,'Shandong',5150),(5820,'Anqiu',5819),(5821,'Bianzhuang',5819),(5822,'Boshan',5819),(5823,'Boxing County',5819),(5824,'Caocheng',5819),(5825,'Changqing',5819),(5826,'Chengyang',5819),(5827,'Dezhou',5819),(5828,'Dingtao',5819),(5829,'Dongcun',5819),(5830,'Dongdu',5819),(5831,'Donge County',5819),(5832,'Dongying',5819),(5833,'Feicheng',5819),(5834,'Fushan',5819),(5835,'Gaomi',5819),(5836,'Haiyang',5819),(5837,'Hanting',5819),(5838,'Hekou',5819),(5839,'Heze',5819),(5840,'Jiaonan',5819),(5841,'Jiaozhou',5819),(5842,'Jiehu',5819),(5843,'Jimo',5819),(5844,'Jinan',5819),(5845,'Jining',5819),(5846,'Juxian',5819),(5847,'Juye',5819),(5848,'Kunlun',5819),(5849,'Laiwu',5819),(5850,'Laiyang',5819),(5851,'Laizhou',5819),(5852,'Leling',5819),(5853,'Liaocheng',5819),(5854,'Licung',5819),(5855,'Linqing',5819),(5856,'Linqu',5819),(5857,'Linshu',5819),(5858,'Linyi',5819),(5859,'Longkou',5819),(5860,'Mengyin',5819),(5861,'Nanchou',5819),(5862,'Nanding',5819),(5863,'Nanma',5819),(5864,'Ninghai',5819),(5865,'Ningyang',5819),(5866,'Pingdu',5819),(5867,'Pingyi',5819),(5868,'Pingyin',5819),(5869,'Qingdao',5819),(5870,'Qingzhou',5819),(5871,'Qufu',5819),(5872,'Rizhao',5819),(5873,'Shancheng',5819),(5874,'Shanting',5819),(5875,'Shengzhuang',5819),(5876,'Shenxian',5819),(5877,'Shizilu',5819),(5878,'Shouguang',5819),(5879,'Shuiji',5819),(5880,'Sishui',5819),(5881,'Suozhen',5819),(5882,'Taian',5819),(5883,'Tancheng',5819),(5884,'Taozhuang',5819),(5885,'Tengzhou',5819),(5886,'Weifang',5819),(5887,'Weihai',5819),(5888,'Wencheng',5819),(5889,'Wendeng',5819),(5890,'Wenshang',5819),(5891,'Wudi',5819),(5892,'Xiazhen',5819),(5893,'Xincheng',5819),(5894,'Xindian',5819),(5895,'Xintai',5819),(5896,'Yanggu',5819),(5897,'Yangshan',5819),(5898,'Yantai',5819),(5899,'Yanzhou',5819),(5900,'Yatou',5819),(5901,'Yidu',5819),(5902,'Yishui',5819),(5903,'Yucheng',5819),(5904,'Zaozhuang',5819),(5905,'Zhangdian',5819),(5906,'Zhangjiawa',5819),(5907,'Zhangqiu',5819),(5908,'Zhaocheng',5819),(5909,'Zhoucheng',5819),(5910,'Zhoucun',5819),(5911,'Zhucheng',5819),(5912,'Zhuwang',5819),(5913,'Zicheng',5819),(5914,'Zouping',5819),(5915,'Zouxian',5819),(5916,'Shanghai',5150),(5917,'Jiading',5916),(5918,'Minhang',5916),(5919,'Songjiang',5916),(5920,'Trencin',5916),(5921,'Shanxi',5150),(5922,'Changzhi',5921),(5923,'Datong',5921),(5924,'Houma',5921),(5925,'Jiexiu',5921),(5926,'Jincheng',5921),(5927,'Linfen',5921),(5928,'Taiyuan',5921),(5929,'Xinzhi',5921),(5930,'Yangquan',5921),(5931,'Yuanping',5921),(5932,'Yuci',5921),(5933,'Sichuan',5150),(5934,'Anju',5933),(5935,'Baoning',5933),(5936,'Chengdu',5933),(5937,'Dawan',5933),(5938,'Daxian',5933),(5939,'Deyang',5933),(5940,'Dujiangyan City',5933),(5941,'Guangkou',5933),(5942,'Guangyuan',5933),(5943,'Guihu',5933),(5944,'Heyang',5933),(5945,'Huayang',5933),(5946,'Jiancheng',5933),(5947,'Jiangyou',5933),(5948,'Jijiang',5933),(5949,'Leshan',5933),(5950,'Linqiong',5933),(5951,'Luzhou',5933),(5952,'Mianyang',5933),(5953,'Nanchong',5933),(5954,'Nanlong',5933),(5955,'Neijiang',5933),(5956,'Panzhihua',5933),(5957,'Shifang',5933),(5958,'Suining',5933),(5959,'Taihe',5933),(5960,'Tianpeng',5933),(5961,'Xichang',5933),(5962,'Xunchang',5933),(5963,'Yaan',5933),(5964,'Yibin',5933),(5965,'Yongchang',5933),(5966,'Zhonglong',5933),(5967,'Zigong',5933),(5968,'Ziyang',5933),(5969,'Tianjin',5150),(5970,'Beichen',5969),(5971,'Gangdong',5969),(5972,'Hangu',5969),(5973,'Jinghai',5969),(5974,'Nankai',5969),(5975,'Tanggu',5969),(5976,'Xianshuigu',5969),(5977,'Yangcun',5969),(5978,'Yangliuqing',5969),(5979,'Xianggang',5150),(5980,'Guiqing',5979),(5981,'Jiulong',5979),(5982,'Quanwan',5979),(5983,'Saigong',5979),(5984,'Shatin',5979),(5985,'Taipo',5979),(5986,'Tuanmun',5979),(5987,'Yuanlong',5979),(5988,'Xinjiang',5150),(5989,'Aksu',5988),(5990,'Baijiantan',5988),(5991,'Changji',5988),(5992,'Hami',5988),(5993,'Hetian',5988),(5994,'Karamay',5988),(5995,'Kashi',5988),(5996,'Korla',5988),(5997,'Kuche',5988),(5998,'Kuytun',5988),(5999,'Shache',5988),(6000,'Shihezi',5988),(6001,'Shuimogou',5988),(6002,'Toutunhe',5988),(6003,'Urumqi',5988),(6004,'Yining',5988),(6005,'Xizang',5150),(6006,'Egypt',NULL),(6007,'Cairo',6006),(6008,'6th of October City',6007),(6009,'Albania',NULL),(6010,'Dibre',6009),(6011,'Peshkopi',6010),(6012,'Armenia',NULL),(6013,'Ararat',6012),(6014,'Artashat',6013),(6015,'Egypt',NULL),(6016,'al-Fayyum',6015),(6017,'Itsa',6016),(6018,'American Samoa',NULL),(6019,'Manu\'a',6018),(6020,'Ofu',6019),(6021,'Angola',NULL),(6022,'Bie',6021),(6023,'Catumbela',6022),(6024,'Egypt',NULL),(6025,'al-Buhayrah',6024),(6026,'Kafr-ad-Dawwar',6025),(6027,'Egypt',NULL),(6028,'Cairo',6027),(6029,'Ataba',6028),(6030,'Egypt',NULL),(6031,'ad-Daqahliyah',6030),(6032,'Aja',6031),(6033,'Nasr City',6007),(6034,'Sanabu',0),(6035,'Egypt',NULL),(6036,'al-Gharbiyah',6035),(6037,'Zifta',6036),(6038,'Egypt',NULL),(6039,'al-Qahira',6038),(6040,'Badr City',6039),(6041,'al-Qahira',6039);
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginadmin`
--

DROP TABLE IF EXISTS `loginadmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginadmin` (
  `LoginAdminID` int NOT NULL,
  `LoginContextID` int DEFAULT NULL,
  PRIMARY KEY (`LoginAdminID`),
  KEY `LoginContextID` (`LoginContextID`),
  CONSTRAINT `loginadmin_ibfk_1` FOREIGN KEY (`LoginContextID`) REFERENCES `logincontext` (`LoginContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginadmin`
--

LOCK TABLES `loginadmin` WRITE;
/*!40000 ALTER TABLE `loginadmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginadmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logincontext`
--

DROP TABLE IF EXISTS `logincontext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logincontext` (
  `LoginContextID` int NOT NULL AUTO_INCREMENT,
  `LoginStrategyID` int DEFAULT NULL,
  PRIMARY KEY (`LoginContextID`),
  KEY `LoginStrategyID` (`LoginStrategyID`),
  CONSTRAINT `logincontext_ibfk_1` FOREIGN KEY (`LoginStrategyID`) REFERENCES `loginstrategy` (`LoginStrategyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logincontext`
--

LOCK TABLES `logincontext` WRITE;
/*!40000 ALTER TABLE `logincontext` DISABLE KEYS */;
/*!40000 ALTER TABLE `logincontext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginmethodcontext`
--

DROP TABLE IF EXISTS `loginmethodcontext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginmethodcontext` (
  `LoginMethodContextID` int NOT NULL AUTO_INCREMENT,
  `LoginMethodStrategyID` int DEFAULT NULL,
  PRIMARY KEY (`LoginMethodContextID`),
  KEY `LoginMethodStrategyID` (`LoginMethodStrategyID`),
  CONSTRAINT `loginmethodcontext_ibfk_1` FOREIGN KEY (`LoginMethodStrategyID`) REFERENCES `loginmethodstrategy` (`LoginMethodStrategyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginmethodcontext`
--

LOCK TABLES `loginmethodcontext` WRITE;
/*!40000 ALTER TABLE `loginmethodcontext` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginmethodcontext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginmethodemail`
--

DROP TABLE IF EXISTS `loginmethodemail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginmethodemail` (
  `LoginMethodEmailID` int NOT NULL AUTO_INCREMENT,
  `LoginMethodContextID` int DEFAULT NULL,
  PRIMARY KEY (`LoginMethodEmailID`),
  KEY `LoginMethodContextID` (`LoginMethodContextID`),
  CONSTRAINT `loginmethodemail_ibfk_1` FOREIGN KEY (`LoginMethodContextID`) REFERENCES `loginmethodcontext` (`LoginMethodContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginmethodemail`
--

LOCK TABLES `loginmethodemail` WRITE;
/*!40000 ALTER TABLE `loginmethodemail` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginmethodemail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginmethodfacebook`
--

DROP TABLE IF EXISTS `loginmethodfacebook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginmethodfacebook` (
  `LoginMethodFacebookID` int NOT NULL AUTO_INCREMENT,
  `LoginMethodContextID` int DEFAULT NULL,
  PRIMARY KEY (`LoginMethodFacebookID`),
  KEY `LoginMethodContextID` (`LoginMethodContextID`),
  CONSTRAINT `loginmethodfacebook_ibfk_1` FOREIGN KEY (`LoginMethodContextID`) REFERENCES `loginmethodcontext` (`LoginMethodContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginmethodfacebook`
--

LOCK TABLES `loginmethodfacebook` WRITE;
/*!40000 ALTER TABLE `loginmethodfacebook` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginmethodfacebook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginmethodgoogle`
--

DROP TABLE IF EXISTS `loginmethodgoogle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginmethodgoogle` (
  `LoginMethodGoogleID` int NOT NULL AUTO_INCREMENT,
  `LoginMethodContextID` int DEFAULT NULL,
  PRIMARY KEY (`LoginMethodGoogleID`),
  KEY `LoginMethodContextID` (`LoginMethodContextID`),
  CONSTRAINT `loginmethodgoogle_ibfk_1` FOREIGN KEY (`LoginMethodContextID`) REFERENCES `loginmethodcontext` (`LoginMethodContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginmethodgoogle`
--

LOCK TABLES `loginmethodgoogle` WRITE;
/*!40000 ALTER TABLE `loginmethodgoogle` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginmethodgoogle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginmethodstrategy`
--

DROP TABLE IF EXISTS `loginmethodstrategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginmethodstrategy` (
  `LoginMethodStrategyID` int NOT NULL,
  PRIMARY KEY (`LoginMethodStrategyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginmethodstrategy`
--

LOCK TABLES `loginmethodstrategy` WRITE;
/*!40000 ALTER TABLE `loginmethodstrategy` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginmethodstrategy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginorganization`
--

DROP TABLE IF EXISTS `loginorganization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginorganization` (
  `LoginOrganizationID` int NOT NULL,
  `LoginContextID` int DEFAULT NULL,
  PRIMARY KEY (`LoginOrganizationID`),
  KEY `LoginContextID` (`LoginContextID`),
  CONSTRAINT `loginorganization_ibfk_1` FOREIGN KEY (`LoginContextID`) REFERENCES `logincontext` (`LoginContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginorganization`
--

LOCK TABLES `loginorganization` WRITE;
/*!40000 ALTER TABLE `loginorganization` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginorganization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginstrategy`
--

DROP TABLE IF EXISTS `loginstrategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginstrategy` (
  `LoginStrategyID` int NOT NULL,
  PRIMARY KEY (`LoginStrategyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginstrategy`
--

LOCK TABLES `loginstrategy` WRITE;
/*!40000 ALTER TABLE `loginstrategy` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginstrategy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginvolunteer`
--

DROP TABLE IF EXISTS `loginvolunteer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loginvolunteer` (
  `LoginVolunteerID` int NOT NULL,
  `LoginContextID` int DEFAULT NULL,
  PRIMARY KEY (`LoginVolunteerID`),
  KEY `LoginContextID` (`LoginContextID`),
  CONSTRAINT `loginvolunteer_ibfk_1` FOREIGN KEY (`LoginContextID`) REFERENCES `logincontext` (`LoginContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginvolunteer`
--

LOCK TABLES `loginvolunteer` WRITE;
/*!40000 ALTER TABLE `loginvolunteer` DISABLE KEYS */;
/*!40000 ALTER TABLE `loginvolunteer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `masterbadgedecorator`
--

DROP TABLE IF EXISTS `masterbadgedecorator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `masterbadgedecorator` (
  `decorator_id` int NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`decorator_id`),
  CONSTRAINT `masterbadgedecorator_ibfk_1` FOREIGN KEY (`decorator_id`) REFERENCES `badgedecorator` (`decorator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `masterbadgedecorator`
--

LOCK TABLES `masterbadgedecorator` WRITE;
/*!40000 ALTER TABLE `masterbadgedecorator` DISABLE KEYS */;
/*!40000 ALTER TABLE `masterbadgedecorator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `NotificationID` int NOT NULL AUTO_INCREMENT,
  `NotificationMessage` varchar(255) NOT NULL,
  `NotificationTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `notificationtypeid` int DEFAULT NULL,
  PRIMARY KEY (`NotificationID`),
  KEY `fk_notification_type` (`notificationtypeid`),
  CONSTRAINT `fk_notification_type` FOREIGN KEY (`notificationtypeid`) REFERENCES `notificationtype` (`NotificationTypeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (2,'Welcome to our platform, you have successfully registered your account.','2025-01-15 12:12:01',1),(3,'Welcome to our platform, you have successfully registered your account.','2025-01-15 12:14:04',1),(4,'Welcome to our platform, you have successfully registered your account.','2025-01-15 19:30:42',1),(5,'Welcome to our platform, you have successfully registered your account.','2025-01-15 20:32:50',3),(7,'Welcome to our platform, you have successfully registered your account.','2025-01-15 22:57:19',2),(8,'Welcome to our platform, you have successfully registered your account.','2025-01-15 22:57:19',3);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificationtype`
--

DROP TABLE IF EXISTS `notificationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificationtype` (
  `NotificationTypeID` int NOT NULL AUTO_INCREMENT,
  `TypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`NotificationTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificationtype`
--

LOCK TABLES `notificationtype` WRITE;
/*!40000 ALTER TABLE `notificationtype` DISABLE KEYS */;
INSERT INTO `notificationtype` VALUES (1,'email'),(2,'push notification'),(3,'sms');
/*!40000 ALTER TABLE `notificationtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `observers`
--

DROP TABLE IF EXISTS `observers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `observers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `observer_type` varchar(50) DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `observers_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `observers`
--

LOCK TABLES `observers` WRITE;
/*!40000 ALTER TABLE `observers` DISABLE KEYS */;
/*!40000 ALTER TABLE `observers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization` (
  `OrganizationID` int NOT NULL AUTO_INCREMENT,
  `OrganizationName` varchar(50) NOT NULL,
  `OrganizationDescription` varchar(500) NOT NULL,
  `OrganizationEmail` varchar(50) NOT NULL,
  `OrganizationPhone` varchar(50) NOT NULL,
  `OrganizationTypeID` int DEFAULT NULL,
  `OrganizationWebsite` varchar(50) NOT NULL,
  `UserID` int DEFAULT NULL,
  `OrganizationUsername` varchar(50) NOT NULL,
  `OrganizationPASSWORD_HASH` varchar(100) NOT NULL,
  `LAST_LOGIN` date DEFAULT NULL,
  `ACCOUNT_CREATION_DATE` date DEFAULT NULL,
  `DateOfCreation` date DEFAULT NULL,
  PRIMARY KEY (`OrganizationID`),
  KEY `UserID` (`UserID`),
  KEY `organization_ibfk_1` (`OrganizationTypeID`),
  CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`OrganizationTypeID`) REFERENCES `organizationtype` (`OrganizationTypeID`) ON DELETE SET NULL,
  CONSTRAINT `organization_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
INSERT INTO `organization` VALUES (8,'Masr el Kheir','No description available.','Masr.ElKheir@example.com','12345678',NULL,'No website available.',121,'Masr.ElKheir@example.com','$2y$10$Ve5fcXXIOMJoKjBNJCyiz.p/UMOE73laR7o..XAb8S2LYq.iNnLdW','2024-12-29','2024-12-29','2002-02-02'),(9,'Resala','No description available.','Resala@example.com','12345678',13,'No website available.',122,'Resala@example.com','$2y$10$hCc09tuBqQE4AQlmGNkSIO3D3xGdQ6rRren9t9eLYnAFqZpYPppf2','2025-01-15','2025-01-15','2002-02-02'),(10,'Orman','No description available.','Orman@example.com','12345678',13,'No website available.',123,'Orman@example.com','$2y$10$9rQ9oJJLRFS7hOV.mp3mUOVxoVBhRNeCAaEWZOVDTl2uYGPIqI6de','2025-01-15','2025-01-15','2002-02-02'),(15,'57375','No description available.','57357@example.com','12345678',13,'No website available.',128,'57357@example.com','$2y$10$UFcET83ADtblLfPTZU/NmO7deDxoyvbIKu0SqINTZ6rzJJkrAhBlO','2025-01-15','2025-01-15','2002-02-02'),(16,'4040','No description available.','4040@example.com','12345678',13,'No website available.',129,'4040@example.com','$2y$10$D/hKG/Hv26aeEu1WMpckQ.3rP8g9RwTO24jPSQm5XBVY.rixEz0OO','2025-01-15','2025-01-15','2002-02-02'),(20,'baheya','No description available.','baheya@example.com','12345678',13,'No website available.',134,'baheya@example.com','$2y$10$GtPhEDL/B22.ssssc2WIWOusrSo1eZQgp15TgogJ6AMaNkSo8n34e','2025-01-15','2025-01-15','2002-02-02'),(21,'hahaha','No description available.','hahaha@example.com','12345678',13,'No website available.',135,'hahaha@example.com','$2y$10$x04uu8dL5qTfvW1CbDjxlujDlMRlBXhDh8YcqHDJItdRYow9WguOS','2025-01-15','2025-01-15','2002-01-01');
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_address`
--

DROP TABLE IF EXISTS `organization_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_address` (
  `OrganizationID` int NOT NULL,
  `AddressID` int NOT NULL,
  PRIMARY KEY (`OrganizationID`,`AddressID`),
  KEY `AddressID` (`AddressID`),
  CONSTRAINT `organization_address_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`),
  CONSTRAINT `organization_address_ibfk_2` FOREIGN KEY (`AddressID`) REFERENCES `location` (`AddressID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_address`
--

LOCK TABLES `organization_address` WRITE;
/*!40000 ALTER TABLE `organization_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_event`
--

DROP TABLE IF EXISTS `organization_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_event` (
  `OrganizationID` int NOT NULL,
  `EventID` int NOT NULL,
  PRIMARY KEY (`OrganizationID`,`EventID`),
  KEY `organization_event_ibfk_2` (`EventID`),
  CONSTRAINT `organization_event_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`) ON DELETE CASCADE,
  CONSTRAINT `organization_event_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_event`
--

LOCK TABLES `organization_event` WRITE;
/*!40000 ALTER TABLE `organization_event` DISABLE KEYS */;
INSERT INTO `organization_event` VALUES (8,32),(8,33),(8,34),(8,35),(8,36),(8,37),(8,38),(8,39),(8,40),(8,41),(8,42),(8,43),(8,44),(8,45),(8,46),(20,47),(9,48),(9,49);
/*!40000 ALTER TABLE `organization_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_notificationtype`
--

DROP TABLE IF EXISTS `organization_notificationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_notificationtype` (
  `organizationid` int NOT NULL,
  `notificationtypeid` int NOT NULL,
  PRIMARY KEY (`organizationid`,`notificationtypeid`),
  KEY `organization_notificationtype_ibfk_2` (`notificationtypeid`),
  CONSTRAINT `organization_notificationtype_ibfk_1` FOREIGN KEY (`organizationid`) REFERENCES `organization` (`OrganizationID`),
  CONSTRAINT `organization_notificationtype_ibfk_2` FOREIGN KEY (`notificationtypeid`) REFERENCES `notificationtype` (`NotificationTypeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_notificationtype`
--

LOCK TABLES `organization_notificationtype` WRITE;
/*!40000 ALTER TABLE `organization_notificationtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization_notificationtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_privilege`
--

DROP TABLE IF EXISTS `organization_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_privilege` (
  `OrganizationID` int NOT NULL AUTO_INCREMENT,
  `Organization_PrivilegeID` int DEFAULT NULL,
  PRIMARY KEY (`OrganizationID`),
  KEY `organization_privilege_ibfk_2` (`Organization_PrivilegeID`),
  CONSTRAINT `organization_privilege_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`),
  CONSTRAINT `organization_privilege_ibfk_2` FOREIGN KEY (`Organization_PrivilegeID`) REFERENCES `privilege` (`PrivilegeID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_privilege`
--

LOCK TABLES `organization_privilege` WRITE;
/*!40000 ALTER TABLE `organization_privilege` DISABLE KEYS */;
/*!40000 ALTER TABLE `organization_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizationtype`
--

DROP TABLE IF EXISTS `organizationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizationtype` (
  `OrganizationTypeID` int NOT NULL AUTO_INCREMENT,
  `OrganizationTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`OrganizationTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizationtype`
--

LOCK TABLES `organizationtype` WRITE;
/*!40000 ALTER TABLE `organizationtype` DISABLE KEYS */;
INSERT INTO `organizationtype` VALUES (1,'Non-Profit'),(2,'Educational'),(3,'Government'),(5,'Health'),(6,'Environmental'),(7,'Sports'),(8,'Cultural'),(9,'Religious'),(10,'Community'),(13,'Charity');
/*!40000 ALTER TABLE `organizationtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizedetails`
--

DROP TABLE IF EXISTS `organizedetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizedetails` (
  `OrganizeDetailsID` int NOT NULL AUTO_INCREMENT,
  `OrganizeEventId` int DEFAULT NULL,
  `EventID` int DEFAULT NULL,
  PRIMARY KEY (`OrganizeDetailsID`),
  KEY `OrganizeEventId` (`OrganizeEventId`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `organizedetails_ibfk_1` FOREIGN KEY (`OrganizeEventId`) REFERENCES `organizeevent` (`OrganizeEventID`),
  CONSTRAINT `organizedetails_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizedetails`
--

LOCK TABLES `organizedetails` WRITE;
/*!40000 ALTER TABLE `organizedetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `organizedetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizeevent`
--

DROP TABLE IF EXISTS `organizeevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizeevent` (
  `OrganizeEventID` int NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `OrganizationID` int DEFAULT NULL,
  PRIMARY KEY (`OrganizeEventID`),
  KEY `organizeevent_ibfk_1` (`OrganizationID`),
  CONSTRAINT `organizeevent_ibfk_1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizeevent`
--

LOCK TABLES `organizeevent` WRITE;
/*!40000 ALTER TABLE `organizeevent` DISABLE KEYS */;
/*!40000 ALTER TABLE `organizeevent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privilege`
--

DROP TABLE IF EXISTS `privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `privilege` (
  `PrivilegeID` int NOT NULL AUTO_INCREMENT,
  `PrivilegeName` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `AccessLevel` int NOT NULL,
  PRIMARY KEY (`PrivilegeID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privilege`
--

LOCK TABLES `privilege` WRITE;
/*!40000 ALTER TABLE `privilege` DISABLE KEYS */;
INSERT INTO `privilege` VALUES (1,'Admin Access','Full access to all system features',5),(2,'Editor Access','Can edit content but not manage system settings',3),(3,'Viewer Access','Can only view content without making changes',1),(4,'Event Manager','Can create and manage volunteer events',4),(9,'Report Access','Can view and edit reports',2);
/*!40000 ALTER TABLE `privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registermethodcontext`
--

DROP TABLE IF EXISTS `registermethodcontext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registermethodcontext` (
  `RegisterMethodContextID` int NOT NULL AUTO_INCREMENT,
  `RegisterMethodStrategyID` int DEFAULT NULL,
  PRIMARY KEY (`RegisterMethodContextID`),
  KEY `RegisterMethodStrategyID` (`RegisterMethodStrategyID`),
  CONSTRAINT `registermethodcontext_ibfk_1` FOREIGN KEY (`RegisterMethodStrategyID`) REFERENCES `registermethodstrategy` (`RegisterMethodStrategyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registermethodcontext`
--

LOCK TABLES `registermethodcontext` WRITE;
/*!40000 ALTER TABLE `registermethodcontext` DISABLE KEYS */;
/*!40000 ALTER TABLE `registermethodcontext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registermethodemail`
--

DROP TABLE IF EXISTS `registermethodemail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registermethodemail` (
  `RegisterMethodEmailID` int NOT NULL AUTO_INCREMENT,
  `RegisterMethodContextID` int DEFAULT NULL,
  PRIMARY KEY (`RegisterMethodEmailID`),
  KEY `RegisterMethodContextID` (`RegisterMethodContextID`),
  CONSTRAINT `registermethodemail_ibfk_1` FOREIGN KEY (`RegisterMethodContextID`) REFERENCES `registermethodcontext` (`RegisterMethodContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registermethodemail`
--

LOCK TABLES `registermethodemail` WRITE;
/*!40000 ALTER TABLE `registermethodemail` DISABLE KEYS */;
/*!40000 ALTER TABLE `registermethodemail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registermethodfacebook`
--

DROP TABLE IF EXISTS `registermethodfacebook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registermethodfacebook` (
  `RegisterMethodFacebookID` int NOT NULL AUTO_INCREMENT,
  `RegisterMethodContextID` int DEFAULT NULL,
  PRIMARY KEY (`RegisterMethodFacebookID`),
  KEY `RegisterMethodContextID` (`RegisterMethodContextID`),
  CONSTRAINT `registermethodfacebook_ibfk_1` FOREIGN KEY (`RegisterMethodContextID`) REFERENCES `registermethodcontext` (`RegisterMethodContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registermethodfacebook`
--

LOCK TABLES `registermethodfacebook` WRITE;
/*!40000 ALTER TABLE `registermethodfacebook` DISABLE KEYS */;
/*!40000 ALTER TABLE `registermethodfacebook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registermethodgoogle`
--

DROP TABLE IF EXISTS `registermethodgoogle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registermethodgoogle` (
  `RegisterMethodGoogleID` int NOT NULL AUTO_INCREMENT,
  `RegisterMethodContextID` int DEFAULT NULL,
  PRIMARY KEY (`RegisterMethodGoogleID`),
  KEY `RegisterMethodContextID` (`RegisterMethodContextID`),
  CONSTRAINT `registermethodgoogle_ibfk_1` FOREIGN KEY (`RegisterMethodContextID`) REFERENCES `registermethodcontext` (`RegisterMethodContextID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registermethodgoogle`
--

LOCK TABLES `registermethodgoogle` WRITE;
/*!40000 ALTER TABLE `registermethodgoogle` DISABLE KEYS */;
/*!40000 ALTER TABLE `registermethodgoogle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registermethodstrategy`
--

DROP TABLE IF EXISTS `registermethodstrategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registermethodstrategy` (
  `RegisterMethodStrategyID` int NOT NULL,
  PRIMARY KEY (`RegisterMethodStrategyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registermethodstrategy`
--

LOCK TABLES `registermethodstrategy` WRITE;
/*!40000 ALTER TABLE `registermethodstrategy` DISABLE KEYS */;
/*!40000 ALTER TABLE `registermethodstrategy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requirement`
--

DROP TABLE IF EXISTS `requirement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requirement` (
  `RequirementID` int NOT NULL AUTO_INCREMENT,
  `RequirementName` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `isMandatory` tinyint(1) NOT NULL,
  `minYearsExperience` int DEFAULT NULL,
  `maxParticipants` int DEFAULT NULL,
  PRIMARY KEY (`RequirementID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requirement`
--

LOCK TABLES `requirement` WRITE;
/*!40000 ALTER TABLE `requirement` DISABLE KEYS */;
/*!40000 ALTER TABLE `requirement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requirement_role`
--

DROP TABLE IF EXISTS `requirement_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requirement_role` (
  `RequirementID` int NOT NULL,
  `RoleID` int NOT NULL,
  PRIMARY KEY (`RequirementID`,`RoleID`),
  KEY `RoleID` (`RoleID`),
  CONSTRAINT `requirement_role_ibfk_1` FOREIGN KEY (`RequirementID`) REFERENCES `requirement` (`RequirementID`),
  CONSTRAINT `requirement_role_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requirement_role`
--

LOCK TABLES `requirement_role` WRITE;
/*!40000 ALTER TABLE `requirement_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `requirement_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `RoleID` int NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(50) NOT NULL,
  `RoleDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skill` (
  `SkillID` int NOT NULL AUTO_INCREMENT,
  `SkillName` varchar(255) NOT NULL,
  `SkillLevel` int DEFAULT NULL,
  PRIMARY KEY (`SkillID`),
  UNIQUE KEY `SkillName` (`SkillName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
INSERT INTO `skill` VALUES (1,'Test Skill',2),(2,'Leading Teams',4),(3,'new skill',3);
/*!40000 ALTER TABLE `skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_skilltype`
--

DROP TABLE IF EXISTS `skill_skilltype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skill_skilltype` (
  `SkillID` int NOT NULL,
  `SkillTypeID` int NOT NULL,
  PRIMARY KEY (`SkillID`,`SkillTypeID`),
  KEY `skill_skilltype_ibfk_2` (`SkillTypeID`),
  CONSTRAINT `skill_skilltype_ibfk_1` FOREIGN KEY (`SkillID`) REFERENCES `skill` (`SkillID`) ON DELETE CASCADE,
  CONSTRAINT `skill_skilltype_ibfk_2` FOREIGN KEY (`SkillTypeID`) REFERENCES `skilltype` (`SkillTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_skilltype`
--

LOCK TABLES `skill_skilltype` WRITE;
/*!40000 ALTER TABLE `skill_skilltype` DISABLE KEYS */;
INSERT INTO `skill_skilltype` VALUES (3,1),(1,3),(2,7),(2,8),(3,8),(1,9),(2,9);
/*!40000 ALTER TABLE `skill_skilltype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skilltype`
--

DROP TABLE IF EXISTS `skilltype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skilltype` (
  `SkillTypeID` int NOT NULL AUTO_INCREMENT,
  `SkillTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`SkillTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skilltype`
--

LOCK TABLES `skilltype` WRITE;
/*!40000 ALTER TABLE `skilltype` DISABLE KEYS */;
INSERT INTO `skilltype` VALUES (1,'Programming'),(2,'Design'),(3,'Project Management'),(4,'Data Analysis'),(5,'Marketing'),(6,'Communication'),(7,'Leadership'),(8,'Problem Solving'),(9,'Time Management'),(10,'Teamwork');
/*!40000 ALTER TABLE `skilltype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `starterbadge`
--

DROP TABLE IF EXISTS `starterbadge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `starterbadge` (
  `badge_id` int NOT NULL,
  `score` int NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`badge_id`),
  CONSTRAINT `starterbadge_ibfk_1` FOREIGN KEY (`badge_id`) REFERENCES `volunteerbadge` (`badge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `starterbadge`
--

LOCK TABLES `starterbadge` WRITE;
/*!40000 ALTER TABLE `starterbadge` DISABLE KEYS */;
/*!40000 ALTER TABLE `starterbadge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submiteventfeedback`
--

DROP TABLE IF EXISTS `submiteventfeedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submiteventfeedback` (
  `SubmitEventFeedbackID` int NOT NULL AUTO_INCREMENT,
  `FeedbackID` int DEFAULT NULL,
  `EventID` int DEFAULT NULL,
  PRIMARY KEY (`SubmitEventFeedbackID`),
  KEY `FeedbackID` (`FeedbackID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `submiteventfeedback_ibfk_1` FOREIGN KEY (`FeedbackID`) REFERENCES `feedback` (`FeedbackID`),
  CONSTRAINT `submiteventfeedback_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submiteventfeedback`
--

LOCK TABLES `submiteventfeedback` WRITE;
/*!40000 ALTER TABLE `submiteventfeedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `submiteventfeedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submitfeedbackcontext`
--

DROP TABLE IF EXISTS `submitfeedbackcontext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submitfeedbackcontext` (
  `SubmitFeedbackContextID` int NOT NULL AUTO_INCREMENT,
  `SubmitFeedbackStrategyID` int DEFAULT NULL,
  PRIMARY KEY (`SubmitFeedbackContextID`),
  KEY `SubmitFeedbackStrategyID` (`SubmitFeedbackStrategyID`),
  CONSTRAINT `submitfeedbackcontext_ibfk_1` FOREIGN KEY (`SubmitFeedbackStrategyID`) REFERENCES `submitfeedbackstrategy` (`SubmitFeedbackStrategyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submitfeedbackcontext`
--

LOCK TABLES `submitfeedbackcontext` WRITE;
/*!40000 ALTER TABLE `submitfeedbackcontext` DISABLE KEYS */;
/*!40000 ALTER TABLE `submitfeedbackcontext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submitfeedbackstrategy`
--

DROP TABLE IF EXISTS `submitfeedbackstrategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submitfeedbackstrategy` (
  `SubmitFeedbackStrategyID` int NOT NULL AUTO_INCREMENT,
  `strategy_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SubmitFeedbackStrategyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submitfeedbackstrategy`
--

LOCK TABLES `submitfeedbackstrategy` WRITE;
/*!40000 ALTER TABLE `submitfeedbackstrategy` DISABLE KEYS */;
/*!40000 ALTER TABLE `submitfeedbackstrategy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submitvolunteerfeedback`
--

DROP TABLE IF EXISTS `submitvolunteerfeedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `submitvolunteerfeedback` (
  `SubmitVolunteerFeedbackID` int NOT NULL AUTO_INCREMENT,
  `FeedbackID` int DEFAULT NULL,
  `VolunteerID` int DEFAULT NULL,
  PRIMARY KEY (`SubmitVolunteerFeedbackID`),
  KEY `FeedbackID` (`FeedbackID`),
  KEY `VolunteerID` (`VolunteerID`),
  CONSTRAINT `submitvolunteerfeedback_ibfk_1` FOREIGN KEY (`FeedbackID`) REFERENCES `feedback` (`FeedbackID`),
  CONSTRAINT `submitvolunteerfeedback_ibfk_2` FOREIGN KEY (`VolunteerID`) REFERENCES `volunteer` (`VolunteerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submitvolunteerfeedback`
--

LOCK TABLES `submitvolunteerfeedback` WRITE;
/*!40000 ALTER TABLE `submitvolunteerfeedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `submitvolunteerfeedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `PASSWORD_HASH` varchar(100) NOT NULL,
  `LAST_LOGIN` date DEFAULT NULL,
  `ACCOUNT_CREATION_DATE` date DEFAULT NULL,
  `UserTypeID` int DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `UserTypeID` (`UserTypeID`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`UserTypeID`) REFERENCES `usertype` (`UserTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (75,'Bob','Brown','bobb@example.com','5678901234','2002-08-07','bobbrown','$2a$12$2bpj2r6QPAjweqJrDCMNveqdu.G1YKMi2DGpxetxlXwOYsbyiHXZ.','2024-12-25','2024-12-05',2),(86,'Kelly','doe','kelly.mike@volunteer.com','927365382','2002-02-02','kelly.mike@example.com','$2y$10$8WkK9V2x89ab.WsNE6pQV.E9dTNQusQXFUTxqUqlulLRnqI/uB0mG','3333-03-02','0222-02-01',1),(93,'Farida','Elhusseiny','faridaelhussieny@gmail.com','01283103800','2002-08-28','faridaelhussieny@gmail.com','$2y$10$8PBJduw/pD6YWbbQw2chPunADS6m/QAHYCdgQs4VBRp8.FGkmYM7G','2002-02-02','2002-02-02',1),(95,'John','Doe','john.doe@example.com','12345678','2002-02-03','john@example.com','$2a$12$2bpj2r6QPAjweqJrDCMNveqdu.G1YKMi2DGpxetxlXwOYsbyiHXZ.','2002-02-02','2002-02-02',1),(96,'Ziko','Zaky','Ziko@example.com','01283103800','2009-02-02','Ziko@example.com','$2y$10$0lkVzJDkXdFc4TF70BgY8uEN8zJjjNMXeCvk0ZZiAtQLOjjSa.eku','2024-12-28','2024-12-28',1),(97,'Frank','Hank','Frank@example.com','01283103800','2002-02-02','Frank@example.com','$2y$10$zLUaGcH7lWN1I1wnfnPcgu/dRiWPfe6Xzj/ZwRdrqqeor1IjLYuJS','2024-12-28','2024-12-28',1),(98,'Serj','Tankian','Serj@example.com','01283103800','2002-02-02','Serj@example.com','$2y$10$f0HMDwLOADKo3WorbFGKiut7vRWFLAWXe0IPBLEW/yNpBppxzNd26','2024-12-28','2024-12-28',1),(118,'Jane','Smith','janesmith@example.com','01283103800','2002-02-02','janesmith@example.com','$2y$10$W5qgNO9kcEGtCFvAEAVlRuZtk1MA.wQO7vsEGQL0W37YX2FDmXJD.','2024-12-29','2024-12-29',2),(119,'Buzz','Fuzz','Buzz@examaple.com','01283103800','2002-08-02','Buzz@examaple.com','$2y$10$CIhU1A6h9OAYwDZO5KMNEuO/ePk9Zcz0pRgIG0mo8ma4GAyYKCFgu','2024-12-29','2024-12-29',2),(121,'Masr el Kheir','Masr el Kheir','Masr.ElKheir@example.com','12345678','2002-02-02','Masr.ElKheir@example.com','$2y$10$BfH9Tpy73UsnA8Oud7oUg.s3kEftvqeLwCMJKJih/od7T4O9sskKi','2024-12-29','2024-12-29',3),(122,'Resala','Org','Resala@example.com','12345678','2002-02-02','Resala@example.com','$2y$10$Wysv/wg7Yrtt4ssbOoYUQ.EmhrZt00orHLK8mujoBYuF5MZIQ7Qay','2025-01-15','2025-01-15',3),(123,'Orman','Org','Orman@example.com','12345678','2002-02-02','Orman@example.com','$2y$10$RMbijG54rmHJXQtK53267ehQLEdJs44PQs7pRbcw6dlPnrHIV0K3e','2025-01-15','2025-01-15',3),(128,'57375','Hospital','57357@example.com','12345678','2002-02-02','57357@example.com','$2y$10$E.gv5e3mfrKB.zNDJxMMR.dIK8JkiYUDz0ZhI6Xidm4UNEM5NjO26','2025-01-15','2025-01-15',3),(129,'4040','Hospital','4040@example.com','12345678','2002-02-02','4040@example.com','$2y$10$b9.AfllIOm23bFOM30h1duefmyF6geQ822dIpzGuOUDvgNejoZsFC','2025-01-15','2025-01-15',3),(134,'baheya','Hospital','baheya@example.com','12345678','2002-02-02','baheya@example.com','$2y$10$6c9pD5PPrkN6kl4kY/iMDOBS1H4MGOyTUQXZ3ocmHz6G3w3zTRSWu','2025-01-15','2025-01-15',3),(135,'hahaha','Hospital','hahaha@example.com','12345678','2002-01-01','hahaha@example.com','$2y$10$cJg7aN3QO3wqhtwpvmBlgOXsj1ACyQ98efnUmm0mPDCREKpZQbZ56','2025-01-15','2025-01-15',3),(159,'Admin','Example','20p6022@eng.asu.edu.eg','+201283103800','2002-02-02','20p6022@eng.asu.edu.eg','$2y$10$WTiK2G0udLCizhPE2rn3..oGTn1f8GkcMYnJNwfFp2gUL..3Jh.ru','2025-01-15','2025-01-15',2),(160,'Ahmed','Mohamed','ahmed@example.com','82725352171','2002-02-02','ahmed@example.com','$2y$10$giWzjLOz1/A9ezh9K3HSfO8REf75uVWvG/t5Ptos.LXw0smH2KDGa','2025-01-16','2025-01-16',1),(161,'Farida',' ','faridaelhussieny278@gmail.com',NULL,NULL,'faridaelhussieny278@gmail.com','$2y$10$fC.YoW/TAmwby0AJlu40POf1P6saTY6SZ8q9xtFG4ttoiBvCx2a0.','2025-01-16','2025-01-16',1),(163,'Farida',' ','faridaelhusseiny2782@gmail.com',NULL,NULL,'faridaelhusseiny2782@gmail.com','$2y$10$4Hf.WCDKkn8o6myVWUCu2uwKsn40JMSBtiHpaWCsdHmKYvwBG5Gce','2025-01-16','2025-01-16',1),(165,'Farida',' ','faridaelhusseinynew@gmail.com',NULL,NULL,'faridaelhusseinynew@gmail.com','$2y$10$zu6RUwyzD9uSIVo90J7asOfAqS0Hwggu/lRlIrCmOMRI3v6mZcih.','2025-01-16','2025-01-16',1),(167,'Farida','Smith','faridaelhussieny1123@gmail.com','01283103800','2009-02-03','faridaelhussieny1123@gmail.com','$2y$10$dQBWVrV4kVn4GN8OqC.AV.zBqcAshW71dNCTFJgliOY5rwPtr4iPe','2025-01-16','2025-01-16',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_address` (
  `UserID` int NOT NULL,
  `AddressID` int NOT NULL,
  PRIMARY KEY (`UserID`,`AddressID`),
  KEY `fk_user_address` (`AddressID`),
  CONSTRAINT `fk_user_address` FOREIGN KEY (`AddressID`) REFERENCES `location` (`AddressID`) ON DELETE CASCADE,
  CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_address`
--

LOCK TABLES `user_address` WRITE;
/*!40000 ALTER TABLE `user_address` DISABLE KEYS */;
INSERT INTO `user_address` VALUES (167,6008),(93,6026),(93,6040);
/*!40000 ALTER TABLE `user_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notifications`
--

DROP TABLE IF EXISTS `user_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notifications` (
  `user_id` int NOT NULL,
  `notification_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`notification_id`),
  KEY `notification_id` (`notification_id`),
  CONSTRAINT `user_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  CONSTRAINT `user_notifications_ibfk_2` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`NotificationID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notifications`
--

LOCK TABLES `user_notifications` WRITE;
/*!40000 ALTER TABLE `user_notifications` DISABLE KEYS */;
INSERT INTO `user_notifications` VALUES (134,2),(135,3),(93,4),(93,5),(159,5);
/*!40000 ALTER TABLE `user_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notificationtype`
--

DROP TABLE IF EXISTS `user_notificationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notificationtype` (
  `UserID` int NOT NULL,
  `NotificationTypeID` int NOT NULL,
  PRIMARY KEY (`UserID`,`NotificationTypeID`),
  KEY `fk_notificationtypeid` (`NotificationTypeID`),
  CONSTRAINT `fk_notificationtypeid` FOREIGN KEY (`NotificationTypeID`) REFERENCES `notificationtype` (`NotificationTypeID`) ON DELETE CASCADE,
  CONSTRAINT `fk_userid` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  CONSTRAINT `user_notificationtype_ibfk_2` FOREIGN KEY (`NotificationTypeID`) REFERENCES `notificationtype` (`NotificationTypeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notificationtype`
--

LOCK TABLES `user_notificationtype` WRITE;
/*!40000 ALTER TABLE `user_notificationtype` DISABLE KEYS */;
INSERT INTO `user_notificationtype` VALUES (93,1),(134,1),(135,1),(165,1),(167,1),(93,2),(93,3),(159,3),(163,3);
/*!40000 ALTER TABLE `user_notificationtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_privilege`
--

DROP TABLE IF EXISTS `user_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_privilege` (
  `User_ID` int NOT NULL,
  `User_PrivilegeID` int NOT NULL,
  PRIMARY KEY (`User_ID`,`User_PrivilegeID`),
  KEY `user_privilege_ibfk_2` (`User_PrivilegeID`),
  CONSTRAINT `user_privilege_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  CONSTRAINT `user_privilege_ibfk_2` FOREIGN KEY (`User_PrivilegeID`) REFERENCES `privilege` (`PrivilegeID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_privilege`
--

LOCK TABLES `user_privilege` WRITE;
/*!40000 ALTER TABLE `user_privilege` DISABLE KEYS */;
INSERT INTO `user_privilege` VALUES (95,1),(118,1),(121,1),(118,2),(75,3),(93,3),(160,3),(93,4),(86,9);
/*!40000 ALTER TABLE `user_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usertype` (
  `UserTypeID` int NOT NULL AUTO_INCREMENT,
  `UserType` varchar(50) NOT NULL,
  PRIMARY KEY (`UserTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usertype`
--

LOCK TABLES `usertype` WRITE;
/*!40000 ALTER TABLE `usertype` DISABLE KEYS */;
INSERT INTO `usertype` VALUES (1,'volunteer'),(2,'admin'),(3,'organization');
/*!40000 ALTER TABLE `usertype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer`
--

DROP TABLE IF EXISTS `volunteer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteer` (
  `VolunteerID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `PASSWORD_HASH` varchar(100) NOT NULL,
  `LAST_LOGIN` date DEFAULT NULL,
  `ACCOUNT_CREATION_DATE` date DEFAULT NULL,
  `hours_contributed` int DEFAULT NULL,
  `NumberOfEventsAttended` int DEFAULT NULL,
  `VolunteerBadgeID` int DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  `ImageUrl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`VolunteerID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `VolunteerBadgeID` (`VolunteerBadgeID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`VolunteerBadgeID`) REFERENCES `volunteerbadge` (`badge_id`),
  CONSTRAINT `volunteer_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer`
--

LOCK TABLES `volunteer` WRITE;
/*!40000 ALTER TABLE `volunteer` DISABLE KEYS */;
INSERT INTO `volunteer` VALUES (47,'Kelly','doe','kelly.mike@volunteer.com','927365382','2002-02-02','kelly.mike@example.com','$2y$10$8WkK9V2x89ab.WsNE6pQV.E9dTNQusQXFUTxqUqlulLRnqI/uB0mG','3333-03-02','0222-02-01',0,0,7,86,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\3d-illustration-with-online-avatar_23-2151303043.jpeg'),(49,'Farida','Elhusseiny','faridaelhussieny@gmail.com','01283103800','2002-08-28','faridaelhussieny@gmail.com','$2y$10$8PBJduw/pD6YWbbQw2chPunADS6m/QAHYCdgQs4VBRp8.FGkmYM7G','2002-02-02','2002-02-02',24,13,10,93,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\3d-illustration-with-online-avatar_23-2151303097.jpeg'),(51,'John','Doe','john.doe@example.com','12345678','2002-02-03','john@example.com','$2a$12$2bpj2r6QPAjweqJrDCMNveqdu.G1YKMi2DGpxetxlXwOYsbyiHXZ.','2002-02-02','2002-02-02',0,0,7,95,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\3d-illustration-with-online-avatar_23-2151303055.jpeg'),(52,'Ziko','Zaky','Ziko@example.com','01283103800','2009-02-02','Ziko@example.com','$2y$10$yJQ0mm86kf984pBXPvnwGu6GLDolfYaDq4aO3m.G3VGwQNqyfUhWm','2024-12-28','2024-12-28',0,0,7,96,NULL),(53,'Frank','Hank','Frank@example.com','01283103800','2002-02-02','Frank@example.com','$2y$10$r92GvTrRiBsAo2k0fHc9TuUVx1RPbDthh/NckJCUnmw3OXTTg4FWm','2024-12-28','2024-12-28',0,0,11,97,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\3d-illustration-with-online-avatar_23-2151303045.jpeg'),(54,'Serj','Tankian','Serj@example.com','01283103800','2002-02-02','Serj@example.com','$2y$10$qgr2MldxxEz7gJhs5n.6UuO99YbbdnAiz7spcWKXxAj8/kbr4y0lO','2024-12-28','2024-12-28',0,0,7,98,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\3d-illustration-with-online-avatar_23-2151303080.jpeg'),(55,'Ahmed','Mohamed','ahmed@example.com','82725352171','2002-02-02','ahmed@example.com','$2y$10$l3x4fsyIuiUkOgLxZteP/.e/R2cAIGfH7zgeI82C3Wg/8qq9Lq7qe','2025-01-16','2025-01-16',0,0,10,160,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\young-man-with-glasses-avatar_1308-173760.jpeg'),(56,'Farida',' ','faridaelhussieny278@gmail.com',NULL,NULL,'faridaelhussieny278@gmail.com','$2y$10$WUEX0zME3EoveNPbkf3o0OQdBjYys.TLXVdast3XWTPkMAVF35xqK','2025-01-16','2025-01-16',0,0,7,161,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\3d-rendering-hair-style-avatar-design_23-2151869153.jpeg'),(58,'Farida',' ','faridaelhusseiny2782@gmail.com',NULL,NULL,'faridaelhusseiny2782@gmail.com','$2y$10$61auRr8tAFV5WMmONDtCoO1j5XOHXDxaJb.TWUN6k.EFUkO8OiL.6','2025-01-16','2025-01-16',0,0,7,163,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\df5f5b1b174a2b4b6026cc6c8f9395c1.jpeg'),(59,'Farida',' ','faridaelhusseinynew@gmail.com',NULL,NULL,'faridaelhusseinynew@gmail.com','$2y$10$dpadJ4Frqa9HD2juEJtOY.mO/oFSCLzb.QOVEnGErZsc9j/yAbg.K','2025-01-16','2025-01-16',0,0,7,165,NULL),(61,'Farida','Smith','faridaelhussieny1123@gmail.com','01283103800','2009-02-03','faridaelhussieny1123@gmail.com','$2y$10$dQBWVrV4kVn4GN8OqC.AV.zBqcAshW71dNCTFJgliOY5rwPtr4iPe','2025-01-16','2025-01-16',14,8,7,167,'D:\\ASU\\Mobile Programming\\hedieatyfinalproject\\assets\\free\\3d-illustration-with-online-avatar_23-2151303043.jpeg');
/*!40000 ALTER TABLE `volunteer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer_location`
--

DROP TABLE IF EXISTS `volunteer_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteer_location` (
  `VolunteerID` int NOT NULL,
  `LocationID` int NOT NULL,
  PRIMARY KEY (`VolunteerID`,`LocationID`),
  KEY `LocationID` (`LocationID`),
  CONSTRAINT `volunteer_location_ibfk_1` FOREIGN KEY (`VolunteerID`) REFERENCES `volunteer` (`VolunteerID`),
  CONSTRAINT `volunteer_location_ibfk_2` FOREIGN KEY (`LocationID`) REFERENCES `location` (`AddressID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer_location`
--

LOCK TABLES `volunteer_location` WRITE;
/*!40000 ALTER TABLE `volunteer_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteer_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer_notificationtype`
--

DROP TABLE IF EXISTS `volunteer_notificationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteer_notificationtype` (
  `VolunteerID` int NOT NULL,
  `NotificationTypeID` int NOT NULL,
  PRIMARY KEY (`VolunteerID`,`NotificationTypeID`),
  KEY `volunteer_notificationtype_ibfk_2` (`NotificationTypeID`),
  CONSTRAINT `volunteer_notificationtype_ibfk_1` FOREIGN KEY (`VolunteerID`) REFERENCES `volunteer` (`VolunteerID`),
  CONSTRAINT `volunteer_notificationtype_ibfk_2` FOREIGN KEY (`NotificationTypeID`) REFERENCES `notificationtype` (`NotificationTypeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer_notificationtype`
--

LOCK TABLES `volunteer_notificationtype` WRITE;
/*!40000 ALTER TABLE `volunteer_notificationtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteer_notificationtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer_privilege`
--

DROP TABLE IF EXISTS `volunteer_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteer_privilege` (
  `VolunteerID` int NOT NULL AUTO_INCREMENT,
  `Volunteer_PrivilegeID` int DEFAULT NULL,
  PRIMARY KEY (`VolunteerID`),
  KEY `volunteer_privilege_ibfk_2` (`Volunteer_PrivilegeID`),
  CONSTRAINT `volunteer_privilege_ibfk_1` FOREIGN KEY (`VolunteerID`) REFERENCES `volunteer` (`VolunteerID`),
  CONSTRAINT `volunteer_privilege_ibfk_2` FOREIGN KEY (`Volunteer_PrivilegeID`) REFERENCES `privilege` (`PrivilegeID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer_privilege`
--

LOCK TABLES `volunteer_privilege` WRITE;
/*!40000 ALTER TABLE `volunteer_privilege` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteer_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer_skills`
--

DROP TABLE IF EXISTS `volunteer_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteer_skills` (
  `VolunteerID` int NOT NULL,
  `SkillID` int NOT NULL,
  PRIMARY KEY (`VolunteerID`,`SkillID`),
  KEY `SkillID` (`SkillID`),
  CONSTRAINT `volunteer_skills_ibfk_1` FOREIGN KEY (`VolunteerID`) REFERENCES `volunteer` (`VolunteerID`) ON DELETE CASCADE,
  CONSTRAINT `volunteer_skills_ibfk_2` FOREIGN KEY (`SkillID`) REFERENCES `skill` (`SkillID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer_skills`
--

LOCK TABLES `volunteer_skills` WRITE;
/*!40000 ALTER TABLE `volunteer_skills` DISABLE KEYS */;
INSERT INTO `volunteer_skills` VALUES (49,2);
/*!40000 ALTER TABLE `volunteer_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteer_volunteerhistory`
--

DROP TABLE IF EXISTS `volunteer_volunteerhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteer_volunteerhistory` (
  `VolunteerID` int NOT NULL,
  `HistoryID` int NOT NULL,
  PRIMARY KEY (`VolunteerID`,`HistoryID`),
  KEY `HistoryID` (`HistoryID`),
  CONSTRAINT `volunteer_volunteerhistory_ibfk_1` FOREIGN KEY (`VolunteerID`) REFERENCES `volunteer` (`VolunteerID`) ON DELETE CASCADE,
  CONSTRAINT `volunteer_volunteerhistory_ibfk_2` FOREIGN KEY (`HistoryID`) REFERENCES `volunteerhistory` (`VolunteerHistoryID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer_volunteerhistory`
--

LOCK TABLES `volunteer_volunteerhistory` WRITE;
/*!40000 ALTER TABLE `volunteer_volunteerhistory` DISABLE KEYS */;
INSERT INTO `volunteer_volunteerhistory` VALUES (49,29);
/*!40000 ALTER TABLE `volunteer_volunteerhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteerbadge`
--

DROP TABLE IF EXISTS `volunteerbadge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteerbadge` (
  `badge_id` int NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteerbadge`
--

LOCK TABLES `volunteerbadge` WRITE;
/*!40000 ALTER TABLE `volunteerbadge` DISABLE KEYS */;
INSERT INTO `volunteerbadge` VALUES (7,10,'Starter Badge'),(8,20,'Advanced Badge'),(9,30,'Expert Badge'),(10,40,'Master Badge'),(11,50,'Leader Badge');
/*!40000 ALTER TABLE `volunteerbadge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteerbadge_privilege`
--

DROP TABLE IF EXISTS `volunteerbadge_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteerbadge_privilege` (
  `VolunteerBadge_PrivilegeID` int NOT NULL AUTO_INCREMENT,
  `VolunteerBadgeID` int DEFAULT NULL,
  `PrivilegeID` int DEFAULT NULL,
  PRIMARY KEY (`VolunteerBadge_PrivilegeID`),
  KEY `VolunteerBadgeID` (`VolunteerBadgeID`),
  KEY `volunteerbadge_privilege_ibfk_2` (`PrivilegeID`),
  CONSTRAINT `volunteerbadge_privilege_ibfk_1` FOREIGN KEY (`VolunteerBadgeID`) REFERENCES `volunteerbadge` (`badge_id`),
  CONSTRAINT `volunteerbadge_privilege_ibfk_2` FOREIGN KEY (`PrivilegeID`) REFERENCES `privilege` (`PrivilegeID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteerbadge_privilege`
--

LOCK TABLES `volunteerbadge_privilege` WRITE;
/*!40000 ALTER TABLE `volunteerbadge_privilege` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteerbadge_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteerfeedback`
--

DROP TABLE IF EXISTS `volunteerfeedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteerfeedback` (
  `FeedbackID` int NOT NULL AUTO_INCREMENT,
  `Comments` text,
  `FeedbackDate` date DEFAULT NULL,
  `Rating` int DEFAULT NULL,
  `FeedbackTimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`FeedbackID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteerfeedback`
--

LOCK TABLES `volunteerfeedback` WRITE;
/*!40000 ALTER TABLE `volunteerfeedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteerfeedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteerfeedback_volunteerhistory`
--

DROP TABLE IF EXISTS `volunteerfeedback_volunteerhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteerfeedback_volunteerhistory` (
  `FeedbackID` int NOT NULL,
  `VolunteerHistoryID` int NOT NULL,
  PRIMARY KEY (`FeedbackID`,`VolunteerHistoryID`),
  KEY `VolunteerHistoryID` (`VolunteerHistoryID`),
  CONSTRAINT `volunteerfeedback_volunteerhistory_ibfk_1` FOREIGN KEY (`FeedbackID`) REFERENCES `volunteerfeedback` (`FeedbackID`) ON DELETE CASCADE,
  CONSTRAINT `volunteerfeedback_volunteerhistory_ibfk_2` FOREIGN KEY (`VolunteerHistoryID`) REFERENCES `volunteerhistory` (`VolunteerHistoryID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteerfeedback_volunteerhistory`
--

LOCK TABLES `volunteerfeedback_volunteerhistory` WRITE;
/*!40000 ALTER TABLE `volunteerfeedback_volunteerhistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteerfeedback_volunteerhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteerhistory`
--

DROP TABLE IF EXISTS `volunteerhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteerhistory` (
  `VolunteerHistoryID` int NOT NULL AUTO_INCREMENT,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `EventID` int NOT NULL,
  PRIMARY KEY (`VolunteerHistoryID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `volunteerhistory_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteerhistory`
--

LOCK TABLES `volunteerhistory` WRITE;
/*!40000 ALTER TABLE `volunteerhistory` DISABLE KEYS */;
INSERT INTO `volunteerhistory` VALUES (21,'2002-02-02','2009-02-03',40),(22,'2002-02-02','2002-02-02',33),(23,'2002-03-03','2009-03-03',34),(24,'2002-03-03','2009-03-03',36),(25,'2004-03-04','2003-03-03',39),(26,'2004-02-02','2009-03-03',41),(27,'2003-02-02','2003-02-02',46),(28,'2019-09-08','2019-09-12',47),(29,'2020-09-09','2020-09-10',49);
/*!40000 ALTER TABLE `volunteerhistory` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-16 23:47:26
