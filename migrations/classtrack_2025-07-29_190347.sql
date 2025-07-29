-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: classtrack
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `assignmentTitle` text DEFAULT NULL COMMENT 'Title of the assignment',
  `assignmentDescription` text DEFAULT NULL COMMENT 'Description of the assignment',
  `departmentId` int(11) DEFAULT NULL COMMENT 'Department ID',
  `startDate` datetime DEFAULT NULL COMMENT 'Start Date of the assignment',
  `endDate` datetime DEFAULT NULL COMMENT 'End Date of the assignment',
  `allowedFileTypes` varchar(255) DEFAULT NULL COMMENT 'Allowed file types for submission',
  `file` longblob DEFAULT NULL COMMENT 'File data for the assignment',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='this is for assignments';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime NOT NULL COMMENT 'Create Time',
  `departmentName` varchar(255) NOT NULL,
  `facultyId` int(11) NOT NULL,
  `departmentCode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='this is for departments';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'0000-00-00 00:00:00','English',16,'ENG'),(2,'0000-00-00 00:00:00','Computer Science',17,'CSC'),(3,'0000-00-00 00:00:00','Cyber Security',17,'CYB'),(4,'0000-00-00 00:00:00','Information Communication Technology',17,'ICT'),(5,'0000-00-00 00:00:00','Software Engineering',17,'SWE'),(6,'0000-00-00 00:00:00','Literature In English',16,'LIE'),(7,'0000-00-00 00:00:00','Medicine and Surgery',19,'MAS'),(8,'0000-00-00 00:00:00','BioChemistry',20,'BCHM'),(9,'0000-00-00 00:00:00','Music',23,'MUS'),(10,'0000-00-00 00:00:00','Computer Studies',22,'COS');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculties` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `facultyName` varchar(255) DEFAULT NULL,
  `facultyCode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='this is for faculty';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculties`
--

/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` VALUES (16,NULL,'Faculty of Arts','ART'),(17,NULL,'Faculty of Computing','CMP'),(19,NULL,'Faculty of BMS','BMS'),(20,NULL,'Faculty of Science','SCS'),(21,NULL,'Faculty of Agriculture','FOA'),(22,NULL,'Faculty of Education','EDU'),(23,NULL,'Faculty of Theatre Arts','FTA');
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime NOT NULL COMMENT 'Create Time',
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `matricNo` varchar(255) DEFAULT NULL,
  `departmentId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'0000-00-00 00:00:00','Testing','Testing','TES1001001',7),(2,'0000-00-00 00:00:00','Reuben','Uweh','CMP2203716',5),(3,'0000-00-00 00:00:00','Tony Onyekachukwu','Abaye','CMP2203650',5),(4,'0000-00-00 00:00:00','John','Samuel','ART',6),(5,'0000-00-00 00:00:00','John','Samuel','ART1001001',6);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `title` varchar(255) NOT NULL COMMENT 'Title of the submission',
  `uploadFile` longblob DEFAULT NULL COMMENT 'File uploaded with the submission',
  `assignmentId` int(11) NOT NULL COMMENT 'Foreign Key to assignments table',
  `fileName` text DEFAULT NULL COMMENT 'Name of the uploaded file',
  `status` enum('pending','submitted','invalid') NOT NULL DEFAULT 'pending' COMMENT 'Status of the submission',
  `studentId` int(11) NOT NULL COMMENT 'Foreign Key to students table',
  PRIMARY KEY (`id`),
  UNIQUE KEY `assignmentId` (`assignmentId`,`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='this is for submissions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;

--
-- Dumping routines for database 'classtrack'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-29 19:03:56
