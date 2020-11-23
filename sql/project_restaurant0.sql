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
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(100) NOT NULL,
  `restaurant_email` varchar(100) NOT NULL,
  `restaurant_location` varchar(200) NOT NULL,
  `restaurant_phone` varchar(11) NOT NULL,
  `restaurant_type` enum('cafe','restaurant','pub','cafeteria','fastfood') NOT NULL,
  `foodtype_id` int(11) NOT NULL,
  PRIMARY KEY (`restaurant_id`),
  UNIQUE KEY `restaurant_id_UNIQUE` (`restaurant_id`),
  KEY `fk_restaurant_food_type1_idx` (`foodtype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` VALUES (1,'Subway','kim_sm@subway.co.kr','E16','0428637001','fastfood',4),(2,'Tous les Jours','anthonychung@naver.com','E6-5','0423500899','cafe',6),(3,'Dunkin Donuts','01095552847@hanmail.net','E3-2','0423507607','cafe',6),(4,'DDDN Pizza','dddnpizza@hotmail.com','W2','0423504787','fastfood',4),(5,'Lotteria','la12244@lotte.net','N13-1 Chang Young Shin Student Center','0428638944','fastfood',4),(6,'Mangosix','none','KI Building(E4) 1F','0423500896','cafe',6),(7,'The Coffee Bean','cbk209@coffeebeankorea.com','International Center(W2-1) 1F','0428673751','cafe',6),(8,'Cafe DropTop','sintansss@naver.com','Startup Studio (W8) 1F','0423500890','cafe',6),(9,'Caf','sr4112.hong@ourhome.co.kr','Student Cafeteria(N11)','0428610419','cafe',6),(10,'Handel & Gretel','ciabatta@handelandgretel.com','Mechanical Engineering B/D (N7) 1F','0423500851','cafe',6),(11,'A Twosome Place','lsj07150@hanmail.net','ITC Building(N1) 1F','0423500871','cafe',6),(12,'Pepper','kdy1175@gmail.com','Student Center-1(W2) 2F','0423500875','restaurant',4),(13,'Pulbit Maru','none','N12 1F','none','restaurant',5),(14,'Smoothie King','none','W1-1 1F','none','cafe',6),(15,'East Cafeteria','none','E5','0423500864','cafeteria',1),(16,'West Cafeteria','wsk2871@ibfood.co.kr','W2','0423502046','cafeteria',1),(17,'Shinsegae Food (KAIMARU)','034176@shinsegae.com','N11','0423502060','cafeteria',1),(18,'TTuk Bae Gi','mjfood8998@hanmail.net','N11','0423500891','restaurant',1),(19,'Hue Gimbap','hotwing@letssystem.com','N11','0423500892','restaurant',1),(20,'Onigiri Gyudong','sos622@daum.net','N11','0423500893','restaurant',2),(21,'MEILU','hao2002@naver.com','N11','0423500867','restaurant',3),(22,'Secret','none','N11','0423500873','restaurant',1);
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-07 20:22:47
