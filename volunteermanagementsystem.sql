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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (4,'Jane','Smith','janesmith@example.com','01283103800','2002-02-02','janesmith@example.com','$2y$10$W5qgNO9kcEGtCFvAEAVlRuZtk1MA.wQO7vsEGQL0W37YX2FDmXJD.','2024-12-29','2024-12-29',118),(5,'Buzz','Fuzz','Buzz@examaple.com','01283103800','2002-08-02','Buzz@examaple.com','$2y$10$FQgGLJC.r0dUKmPXZxwCIuEO/A5FYUc2e/s8Z9BQjjbYvROlAlZrS','2024-12-29','2024-12-29',119);
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
  KEY `NotificationTypeID` (`NotificationTypeID`),
  CONSTRAINT `admin_notificationtype_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminId`),
  CONSTRAINT `admin_notificationtype_ibfk_2` FOREIGN KEY (`NotificationTypeID`) REFERENCES `notificationtype` (`NotificationTypeID`)
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencycontact`
--

LOCK TABLES `emergencycontact` WRITE;
/*!40000 ALTER TABLE `emergencycontact` DISABLE KEYS */;
INSERT INTO `emergencycontact` VALUES (6,'John Doe','01283103800'),(7,'alice John','01272636563'),(10,'Jane Smith','012722382'),(11,'Sara','01272636563');
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
INSERT INTO `emergencycontact_volunteer` VALUES (10,49),(11,49);
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
  KEY `EventLocationID` (`EventLocationID`),
  CONSTRAINT `event_ibfk_1` FOREIGN KEY (`EventLocationID`) REFERENCES `location` (`AddressID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (32,'anything','2002-02-02',141,'please work');
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
  KEY `ParentID` (`ParentID`),
  CONSTRAINT `location_ibfk_1` FOREIGN KEY (`ParentID`) REFERENCES `location` (`AddressID`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (126,'Egypt',NULL),(127,'Cairo',126),(128,'Tagamoa',127),(129,'Maadi',127),(130,'Cairo, Egypt',126),(131,'Nasr City',130),(132,'Gatwick',127),(133,'masr el gedida',130),(134,'Damietta',126),(135,'idk',134),(136,'Madinet Nasr',127),(137,'Dakahleya',127),(139,'Madinaty',127),(141,'New Cairo',127);
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
  PRIMARY KEY (`NotificationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificationtype`
--

DROP TABLE IF EXISTS `notificationtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificationtype` (
  `NotificationTypeID` int NOT NULL,
  `TypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`NotificationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificationtype`
--

LOCK TABLES `notificationtype` WRITE;
/*!40000 ALTER TABLE `notificationtype` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
INSERT INTO `organization` VALUES (8,'Masr el Kheir','No description available.','Masr.ElKheir@example.com','12345678',NULL,'No website available.',121,'Masr.ElKheir@example.com','$2y$10$Ve5fcXXIOMJoKjBNJCyiz.p/UMOE73laR7o..XAb8S2LYq.iNnLdW','2024-12-29','2024-12-29','2002-02-02');
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
INSERT INTO `organization_event` VALUES (8,32);
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
  KEY `notificationtypeid` (`notificationtypeid`),
  CONSTRAINT `organization_notificationtype_ibfk_1` FOREIGN KEY (`organizationid`) REFERENCES `organization` (`OrganizationID`),
  CONSTRAINT `organization_notificationtype_ibfk_2` FOREIGN KEY (`notificationtypeid`) REFERENCES `notificationtype` (`NotificationTypeID`)
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
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
  `SkillDescription` text,
  `SkillLevel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SkillID`),
  UNIQUE KEY `SkillName` (`SkillName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill`
--

LOCK TABLES `skill` WRITE;
/*!40000 ALTER TABLE `skill` DISABLE KEYS */;
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
  KEY `SkillTypeID` (`SkillTypeID`),
  CONSTRAINT `skill_skilltype_ibfk_1` FOREIGN KEY (`SkillID`) REFERENCES `skill` (`SkillID`) ON DELETE CASCADE,
  CONSTRAINT `skill_skilltype_ibfk_2` FOREIGN KEY (`SkillTypeID`) REFERENCES `skilltype` (`SkillTypeID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_skilltype`
--

LOCK TABLES `skill_skilltype` WRITE;
/*!40000 ALTER TABLE `skill_skilltype` DISABLE KEYS */;
/*!40000 ALTER TABLE `skill_skilltype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skilltype`
--

DROP TABLE IF EXISTS `skilltype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skilltype` (
  `SkillTypeID` int NOT NULL,
  `SkillTypeName` varchar(50) NOT NULL,
  PRIMARY KEY (`SkillTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skilltype`
--

LOCK TABLES `skilltype` WRITE;
/*!40000 ALTER TABLE `skilltype` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (75,'Bob','Brown','bobb@example.com','5678901234','2002-08-07','bobbrown','$2a$12$2bpj2r6QPAjweqJrDCMNveqdu.G1YKMi2DGpxetxlXwOYsbyiHXZ.','2024-12-25','2024-12-05',2),(86,'Kellyyy','doe','kelly.mike@volunteer.com','01283103800','2002-02-02','kelly.mike@example.com','$2a$12$2bpj2r6QPAjweqJrDCMNveqdu.G1YKMi2DGpxetxlXwOYsbyiHXZ.','3333-03-02','0222-02-01',1),(93,'Farida','Elhusseiny','faridaelhussieny@gmail.com','01283103800','2002-08-27','faridaelhusseiny@gmail.com','$2y$10$kUwMOEKVh9mmLxA89OGZj.8rF6BRHSSAHztwZ4UVgvxqJRi9bhSba','2002-02-02','2002-02-02',1),(95,'John','Doe','john.doe@example.com','12345678','2002-02-03','john@example.com','$2a$12$2bpj2r6QPAjweqJrDCMNveqdu.G1YKMi2DGpxetxlXwOYsbyiHXZ.','2002-02-02','2002-02-02',1),(96,'Ziko','Zaky','Ziko@example.com','01283103800','2009-02-02','Ziko@example.com','$2y$10$0lkVzJDkXdFc4TF70BgY8uEN8zJjjNMXeCvk0ZZiAtQLOjjSa.eku','2024-12-28','2024-12-28',1),(97,'Frank','Hank','Frank@example.com','01283103800','2002-02-02','Frank@example.com','$2y$10$zLUaGcH7lWN1I1wnfnPcgu/dRiWPfe6Xzj/ZwRdrqqeor1IjLYuJS','2024-12-28','2024-12-28',1),(98,'Serj','Tankian','Serj@example.com','01283103800','2002-02-02','Serj@example.com','$2y$10$f0HMDwLOADKo3WorbFGKiut7vRWFLAWXe0IPBLEW/yNpBppxzNd26','2024-12-28','2024-12-28',1),(118,'Jane','Smith','janesmith@example.com','01283103800','2002-02-02','janesmith@example.com','$2y$10$W5qgNO9kcEGtCFvAEAVlRuZtk1MA.wQO7vsEGQL0W37YX2FDmXJD.','2024-12-29','2024-12-29',2),(119,'Buzz','Fuzz','Buzz@examaple.com','01283103800','2002-08-02','Buzz@examaple.com','$2y$10$CIhU1A6h9OAYwDZO5KMNEuO/ePk9Zcz0pRgIG0mo8ma4GAyYKCFgu','2024-12-29','2024-12-29',2),(121,'Masr el Kheir','Masr el Kheir','Masr.ElKheir@example.com','12345678','2002-02-02','Masr.ElKheir@example.com','$2y$10$BfH9Tpy73UsnA8Oud7oUg.s3kEftvqeLwCMJKJih/od7T4O9sskKi','2024-12-29','2024-12-29',3);
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
INSERT INTO `user_address` VALUES (93,128),(93,136);
/*!40000 ALTER TABLE `user_address` ENABLE KEYS */;
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
  KEY `NotificationTypeID` (`NotificationTypeID`),
  CONSTRAINT `user_notificationtype_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  CONSTRAINT `user_notificationtype_ibfk_2` FOREIGN KEY (`NotificationTypeID`) REFERENCES `notificationtype` (`NotificationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notificationtype`
--

LOCK TABLES `user_notificationtype` WRITE;
/*!40000 ALTER TABLE `user_notificationtype` DISABLE KEYS */;
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
INSERT INTO `user_privilege` VALUES (95,1),(118,1),(121,1),(118,2),(75,3),(86,3),(93,3),(86,4),(93,4),(93,9);
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
  PRIMARY KEY (`VolunteerID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `VolunteerBadgeID` (`VolunteerBadgeID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`VolunteerBadgeID`) REFERENCES `volunteerbadge` (`badge_id`),
  CONSTRAINT `volunteer_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteer`
--

LOCK TABLES `volunteer` WRITE;
/*!40000 ALTER TABLE `volunteer` DISABLE KEYS */;
INSERT INTO `volunteer` VALUES (47,'Kellyyy','doe','kelly.mike@volunteer.com','01283103800','2002-02-02','kelly.mike@example.com','$2a$12$2bpj2r6QPAjweqJrDCMNveqdu.G1YKMi2DGpxetxlXwOYsbyiHXZ.','3333-03-02','0222-02-01',0,0,9,86),(49,'Farida','Elhusseiny','faridaelhussieny@gmail.com','01283103800','2002-08-27','faridaelhusseiny@gmail.com','$2y$10$kUwMOEKVh9mmLxA89OGZj.8rF6BRHSSAHztwZ4UVgvxqJRi9bhSba','2002-02-02','2002-02-02',0,0,7,93),(51,'John','Doe','john.doe@example.com','12345678','2002-02-03','john@example.com','$2a$12$2bpj2r6QPAjweqJrDCMNveqdu.G1YKMi2DGpxetxlXwOYsbyiHXZ.','2002-02-02','2002-02-02',0,0,7,95),(52,'Ziko','Zaky','Ziko@example.com','01283103800','2009-02-02','Ziko@example.com','$2y$10$yJQ0mm86kf984pBXPvnwGu6GLDolfYaDq4aO3m.G3VGwQNqyfUhWm','2024-12-28','2024-12-28',0,0,7,96),(53,'Frank','Hank','Frank@example.com','01283103800','2002-02-02','Frank@example.com','$2y$10$r92GvTrRiBsAo2k0fHc9TuUVx1RPbDthh/NckJCUnmw3OXTTg4FWm','2024-12-28','2024-12-28',0,0,11,97),(54,'Serj','Tankian','Serj@example.com','01283103800','2002-02-02','Serj@example.com','$2y$10$qgr2MldxxEz7gJhs5n.6UuO99YbbdnAiz7spcWKXxAj8/kbr4y0lO','2024-12-28','2024-12-28',0,0,7,98);
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
  KEY `NotificationTypeID` (`NotificationTypeID`),
  CONSTRAINT `volunteer_notificationtype_ibfk_1` FOREIGN KEY (`VolunteerID`) REFERENCES `volunteer` (`VolunteerID`),
  CONSTRAINT `volunteer_notificationtype_ibfk_2` FOREIGN KEY (`NotificationTypeID`) REFERENCES `notificationtype` (`NotificationTypeID`)
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
INSERT INTO `volunteer_volunteerhistory` VALUES (49,21);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteerhistory`
--

LOCK TABLES `volunteerhistory` WRITE;
/*!40000 ALTER TABLE `volunteerhistory` DISABLE KEYS */;
INSERT INTO `volunteerhistory` VALUES (21,'2002-02-02','2008-02-03',32);
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

-- Dump completed on 2024-12-31 22:50:10
