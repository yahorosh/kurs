-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: kurs
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dean`
--

DROP TABLE IF EXISTS `dean`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dean` (
  `id_dean` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_dean`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dean`
--

LOCK TABLES `dean` WRITE;
/*!40000 ALTER TABLE `dean` DISABLE KEYS */;
INSERT INTO `dean` VALUES (1,'ÐœÐµÑ…Ð°Ð½Ð¸Ñ‡ÐµÑÐºÐ¾Ð³Ð¾ Ñ„-Ñ‚Ð°'),(2,'ÐœÐµÑ‚ÐµÐ¼Ð°Ñ‚Ð¸Ñ‡ÐµÑÐºÐ¾Ð³Ð¾ Ñ„-Ñ‚Ð°'),(3,'Ð®Ñ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¾Ð³Ð¾ Ñ„-Ñ‚Ð°'),(4,'Ð¤Ð¸Ð·Ð¸Ñ‡ÐµÑÐºÐ¾Ð³Ð¾ Ñ„-Ñ‚Ð°');
/*!40000 ALTER TABLE `dean` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id_department` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `id_faculty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_department`),
  KEY `fk_department_faculty1_idx` (`id_faculty`),
  CONSTRAINT `fk_department_faculty1` FOREIGN KEY (`id_faculty`) REFERENCES `faculty` (`id_faculty`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'Ð”Ð½ÐµÐ²Ð½Ð¾Ðµ Ð¾Ñ‚Ð´ÐµÐ»ÐµÐ½Ð¸Ðµ',3),(2,'Ð’ÐµÑ‡ÐµÑ€Ð½ÐµÐµ Ð¾Ñ‚Ð´ÐµÐ»ÐµÐ½Ð¸Ðµ',3),(3,'Ð”Ð½ÐµÐ²Ð½Ð¾Ðµ Ð¾Ñ‚Ð´ÐµÐ»ÐµÐ½Ð¸Ðµ',1),(4,'Ð’ÐµÑ‡ÐµÑ€Ð½ÐµÐµ Ð¾Ñ‚Ð´ÐµÐ»ÐµÐ½Ð¸Ðµ',1),(5,'Ð”Ð½ÐµÐ²Ð½Ð¾Ðµ Ð¾Ñ‚Ð´ÐµÐ»ÐµÐ½Ð¸Ðµ',2),(6,'Ð”Ð½ÐµÐ²Ð½Ð¾Ðµ Ð¾Ñ‚Ð´ÐµÐ»ÐµÐ½Ð¸Ðµ',4),(7,'Ð—Ð°Ð¾Ñ‡Ð½Ð¾Ðµ',4);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dept`
--

DROP TABLE IF EXISTS `dept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dept` (
  `id_dept` int(11) NOT NULL AUTO_INCREMENT,
  `id_student` int(11) DEFAULT NULL,
  `id_group_has_subject` int(11) DEFAULT NULL,
  `value_credit` varchar(45) DEFAULT NULL,
  `value_exam` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_dept`),
  KEY `fk_sdudent_subject_dept_subject1_idx` (`id_student`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dept`
--

LOCK TABLES `dept` WRITE;
/*!40000 ALTER TABLE `dept` DISABLE KEYS */;
INSERT INTO `dept` VALUES (1,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,NULL),(37,4,84,NULL,''),(38,1,76,'Ð·Ð°Ñ‡ÐµÑ‚',NULL),(39,1,77,NULL,'Ð¾Ñ‚Ð»Ð¸Ñ‡Ð½Ð¾');
/*!40000 ALTER TABLE `dept` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty` (
  `id_faculty` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `id_dean` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_faculty`),
  KEY `fk_faculty_dean1_idx` (`id_dean`),
  CONSTRAINT `fk_faculty_dean1` FOREIGN KEY (`id_dean`) REFERENCES `dean` (`id_dean`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES (1,'ÐœÐ°Ñ‚ÐµÐ¼Ð°Ñ‚Ð¸ÐºÐ¸',NULL),(2,'ÐœÐµÑ…Ð°Ð½Ð¸ÐºÐ¸',NULL),(3,'Ð¤Ð¸Ð·Ð¸ÐºÐ¸',NULL),(4,'Ð®Ñ€Ð¸Ð´Ð¸Ñ‡ÐµÑÐºÐ¸Ð¹',NULL);
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_group`),
  KEY `fk_group_department1_idx` (`id_department`),
  CONSTRAINT `fk_group_department1` FOREIGN KEY (`id_department`) REFERENCES `department` (`id_department`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'ÐœÐ’-1.1',4),(2,'Ðœ-1.1',3),(3,'Ð¤Ð’-1.1',5),(5,'ÐœÑ…-1.1',5),(7,'Ð®-2.3',7),(10,'Ð¤Ð’-2.3',2),(12,'Ðœ-4.2',3),(19,'ÐœÐœ-22',3),(20,'ÐœÐœ-12',1);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_has_subject`
--

DROP TABLE IF EXISTS `group_has_subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_has_subject` (
  `id_group_has_subject` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) DEFAULT NULL,
  `id_subject` int(11) DEFAULT NULL,
  `id_lecturer` int(11) DEFAULT NULL,
  `type` enum('exam','credit','both') DEFAULT NULL,
  PRIMARY KEY (`id_group_has_subject`),
  KEY `fk_group_has_subject_subject1_idx` (`id_subject`),
  KEY `fk_group_has_subject_group1_idx` (`id_group`),
  CONSTRAINT `fk_group_has_subject_group1` FOREIGN KEY (`id_group`) REFERENCES `group` (`id_group`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_group_has_subject_subject1` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_has_subject`
--

LOCK TABLES `group_has_subject` WRITE;
/*!40000 ALTER TABLE `group_has_subject` DISABLE KEYS */;
INSERT INTO `group_has_subject` VALUES (70,1,1,6,'exam'),(71,1,2,7,'exam'),(72,1,4,8,'exam'),(73,5,1,5,NULL),(74,5,3,5,NULL),(75,5,5,5,NULL),(76,10,1,6,'credit'),(77,10,2,7,'exam'),(78,NULL,1,NULL,NULL),(79,NULL,1,NULL,NULL),(80,19,1,5,'exam'),(81,19,2,7,'exam'),(82,19,3,5,'exam'),(83,19,4,8,'credit'),(89,NULL,NULL,NULL,'exam'),(90,NULL,NULL,NULL,'credit'),(91,NULL,NULL,NULL,'exam'),(92,NULL,NULL,NULL,'credit'),(93,NULL,NULL,NULL,'exam'),(94,NULL,NULL,NULL,'exam'),(95,NULL,NULL,NULL,'exam'),(96,NULL,NULL,NULL,'exam'),(97,NULL,1,7,'exam'),(98,NULL,1,6,'credit'),(99,NULL,1,6,'credit'),(100,NULL,1,5,'credit'),(116,NULL,1,6,'exam'),(117,NULL,2,7,'exam'),(118,NULL,1,9,'exam'),(119,NULL,1,9,'exam'),(120,NULL,1,9,'exam'),(121,NULL,1,9,'exam'),(122,NULL,1,9,'exam'),(123,NULL,1,9,'exam'),(124,NULL,NULL,NULL,'exam'),(125,NULL,NULL,NULL,'exam'),(126,NULL,1,NULL,NULL),(127,NULL,NULL,NULL,NULL),(128,NULL,NULL,NULL,NULL),(129,NULL,1,NULL,NULL),(130,NULL,NULL,NULL,NULL),(131,NULL,NULL,NULL,NULL),(132,NULL,NULL,NULL,'both'),(133,NULL,NULL,NULL,'both'),(134,NULL,NULL,NULL,'both'),(135,NULL,1,NULL,'both'),(136,NULL,1,NULL,'both'),(137,NULL,1,NULL,'both'),(138,NULL,1,NULL,'both'),(139,NULL,1,NULL,'both'),(140,NULL,1,NULL,'both'),(148,12,1,6,NULL),(149,12,4,8,'credit'),(150,12,5,5,'both'),(151,12,9,9,'both'),(152,NULL,1,NULL,'both'),(153,20,1,7,'exam'),(154,20,6,11,NULL),(155,20,8,9,NULL),(156,20,10,12,'credit'),(157,NULL,1,NULL,'both');
/*!40000 ALTER TABLE `group_has_subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lecturer` (
  `id_lecturer` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `id_department` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `degree` varchar(45) DEFAULT NULL,
  `id_chief` int(11) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_lecturer`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecturer`
--

LOCK TABLES `lecturer` WRITE;
/*!40000 ALTER TABLE `lecturer` DISABLE KEYS */;
INSERT INTO `lecturer` VALUES (5,'Ð£Ñ‡ÐµÐ½Ð¾Ð² Ð¡.Ð’.','','','','','','ÐšÐœÐ',6,0.00),(6,'Ð“Ð»Ð°Ð²Ð½Ð¾Ð² Ð‘.ÐŸ.','','','','','','ÐšÐ¤Ð',0,10000.00),(7,'ÐœÐ°Ñ‚ÐµÐ¼Ð°Ñ‚Ð¸ÐºÐ¾Ð² Ð’.Ð˜','','','','','','ÐšÐ',0,0.00),(8,'Ð¤Ð¸Ð·Ð¸ÐºÐ¾Ð² Ð.Ð.','','','','','','ÐšÐ',0,0.00),(9,'Ð“Ð¾Ð½Ñ‡Ð°Ñ€Ð¾Ð² Ð.Ð.','','','','Ð°Ñ„Ð²Ñ‹Ð°Ñ„Ð²Ð°','Ð°Ñ„Ð²Ñ‹Ð°','ÐšÐ“Ðœ',8,0.00),(10,'Ð‘ÐµÐ»ÐºÐ° Ð¡.ÐŸ.','','','','','','ÐÐšÐ',6,40000.00),(11,'ÐšÐ¾Ð½ÑŒ Ð’.Ð˜','','','','','','Ð”ÐœÐ',6,50.00),(12,'Ð¡Ð¿Ð¾Ñ€Ñ‚ÑÐ¼ÐµÐ½Ð¾Ð² Ð’.Ð¡.','','','','','','ÐšÐœÐ¡',6,20.00);
/*!40000 ALTER TABLE `lecturer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecturer_has_subject`
--

DROP TABLE IF EXISTS `lecturer_has_subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lecturer_has_subject` (
  `id_lecturer` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  PRIMARY KEY (`id_lecturer`,`id_subject`),
  KEY `fk_lecturer_has_subject_subject1_idx` (`id_subject`),
  KEY `fk_lecturer_has_subject_lecturer1_idx` (`id_lecturer`),
  CONSTRAINT `fk_lecturer_has_subject_lecturer1` FOREIGN KEY (`id_lecturer`) REFERENCES `lecturer` (`id_lecturer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecturer_has_subject_subject1` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecturer_has_subject`
--

LOCK TABLES `lecturer_has_subject` WRITE;
/*!40000 ALTER TABLE `lecturer_has_subject` DISABLE KEYS */;
INSERT INTO `lecturer_has_subject` VALUES (5,1),(6,1),(7,1),(10,1),(7,2),(5,3),(6,3),(7,3),(10,3),(7,4),(8,4),(11,4),(5,5),(10,5),(9,6),(11,6),(9,7),(9,8),(9,9),(12,10);
/*!40000 ALTER TABLE `lecturer_has_subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id_student` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `passport` varchar(145) DEFAULT NULL,
  `rec_date` int(11) DEFAULT NULL,
  `order_no` varchar(45) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_student`),
  KEY `fk_student_group_idx` (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'ÐŸÐµÑ‚Ñ€Ð¾Ð²','',1361390400,'123',10,NULL),(2,'Ð˜Ð²Ð°Ð½Ð¾Ð²','',1361390400,'',3,NULL),(3,'Ð¡Ð¸Ð´Ð¾Ñ€Ð¾Ð²','',1361390400,'',3,NULL),(4,'Ð¤Ñ€Ð¾Ð»Ð¾Ð²','60 00 212121',1361736000,'',20,NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_subject`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'Ð’Ñ‹ÑÑˆÐ°Ñ Ð¼Ð°Ñ‚ÐµÐ¼Ð°Ñ‚Ð¸ÐºÐ°'),(2,'ÐÐ»Ð³ÐµÐ±Ñ€Ð° Ð¸ Ð½Ð°Ñ‡Ð°Ð»Ð° Ð°Ð½Ð°Ð»Ð¸Ð·Ð°'),(3,'ÐÐ½Ð°Ð»Ð¸Ñ‚Ð¸Ñ‡ÐµÑÐºÐ°Ñ Ð³ÐµÐ¾Ð¼ÐµÑ‚Ñ€Ð¸Ñ'),(4,'Ð¤Ð¸Ð·Ð¸ÐºÐ° Ñ‚Ð²ÐµÐµÑ€Ð´Ñ‹Ñ… Ñ‚ÐµÐ»'),(5,'Ð¢ÐµÐ¾Ñ€Ð¸Ñ‚Ð¸Ñ‡ÐµÑÑ‚ÐºÐ°Ñ Ð¼ÐµÑ…Ð°Ð½Ð¸ÐºÐ°'),(6,'ÐŸÑÐ¸Ñ…Ð¾Ð»Ð¾Ð³Ð¸Ñ'),(7,'Ð¤Ð¸Ð»Ð¾ÑÐ¾Ñ„Ð¸Ñ'),(8,'Ð¥Ð¸Ð¼Ð¸Ñ'),(9,'ÐŸÐ¾Ð»Ð¸Ñ‚Ð¾Ð»Ð¾Ð³Ð¸Ñ'),(10,'Ð¤Ð¸Ð·Ð¸Ñ‡ÐµÑÐºÐ°Ñ ÐºÑƒÐ»ÑŒÑ‚ÑƒÑ€Ð°');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-26 13:40:23
