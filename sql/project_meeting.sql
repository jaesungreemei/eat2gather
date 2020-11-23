-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: project
-- ------------------------------------------------------
-- Server version	5.6.36

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
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meeting` (
  `meeting_id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_name` varchar(45) NOT NULL,
  `meeting_datetime` datetime NOT NULL,
  `max_participants` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `timepassed` tinyint(1) NOT NULL DEFAULT '0',
  `upcoming_meeting_id` int(11) DEFAULT NULL,
  `happened_meeting_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  PRIMARY KEY (`meeting_id`),
  UNIQUE KEY `meeting_id_UNIQUE` (`meeting_id`),
  KEY `fk_meeting_upcoming1_idx` (`upcoming_meeting_id`),
  KEY `fk_meeting_happened1_idx` (`happened_meeting_id`),
  KEY `fk_meeting_restaurant1_idx` (`restaurant_id`),
  CONSTRAINT `fk_meeting_restaurant1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_meeting_upcoming1` FOREIGN KEY (`upcoming_meeting_id`) REFERENCES `upcoming` (`meeting_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meeting`
--

LOCK TABLES `meeting` WRITE;
/*!40000 ALTER TABLE `meeting` DISABLE KEYS */;
INSERT INTO `meeting` VALUES (15,'Test Meeting #1','2017-12-25 12:00:00',4,'Give a Brief Description about the Meeting!',0,NULL,NULL,1),(16,'Test Meeting #2','2017-12-31 13:00:00',4,'Give a Brief Description about the Meeting!',0,NULL,NULL,7),(17,'Test Meeting #3','2017-12-25 12:30:00',5,'Give a Brief Description about the Meeting!',0,NULL,NULL,12),(18,'Test Meeting #4','2017-12-28 19:00:00',6,'Give a Brief Description about the Meeting!',0,NULL,NULL,20),(19,'TimePass','2017-12-07 19:45:00',4,'Give a Brief Description about the Meeting!',1,NULL,NULL,1);
/*!40000 ALTER TABLE `meeting` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-07 20:22:50
