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
-- Table structure for table `dish`
--

DROP TABLE IF EXISTS `dish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dish` (
  `dish_id` int(11) NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(75) NOT NULL,
  `price` int(11) NOT NULL,
  `foodtype_id` int(11) NOT NULL,
  `restaurant_id` varchar(45) NOT NULL,
  PRIMARY KEY (`dish_id`),
  UNIQUE KEY `dish_id_UNIQUE` (`dish_id`),
  KEY `fk_dish_food_type1_idx` (`foodtype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dish`
--

LOCK TABLES `dish` WRITE;
/*!40000 ALTER TABLE `dish` DISABLE KEYS */;
INSERT INTO `dish` VALUES (1,'Steak, Egg & Cheese Combo',4500,4,'1'),(2,'Turkey Ham Set',4500,4,'1'),(3,'Egg Mayo Set',3900,4,'1'),(4,'Turkey Bacon Set',4700,4,'1'),(5,'Bacon, Egg & Cheese Set',3900,4,'1'),(6,'Beef Burrito',5000,5,'13'),(7,'Chickenbreast Burrito',4500,5,'13'),(8,'Beef Rice Bowl',5500,5,'13'),(9,'Chickenbreast Rice Bowl',5000,5,'13'),(10,'Seasoning Chicken Rice Bowl',5000,5,'13'),(11,'Vanilla Latte',5100,6,'11'),(12,'Cafe Mocha',5100,6,'11'),(13,'Espresso',3300,6,'11'),(14,'Plain Yogurt Drink',4300,6,'11'),(15,'Waffle Yogurt Ice Cream',4800,6,'11'),(16,'Pizza Bread',1400,4,'2'),(17,'Cheese Vegetable Bread',1500,4,'2'),(18,'Caramel Macchiato',3000,6,'2'),(19,'Capuccino',2700,6,'2'),(20,'Hot Chocolate',3000,6,'2'),(21,'Chili Ciabatta Ham & Cream',3500,4,'6'),(22,'Chili Ciabatta Chicken',3500,4,'6'),(23,'Bagel',2000,4,'6'),(24,'Fresh Cream Castella',3800,6,'6'),(25,'Cafe Latte',4300,6,'6'),(26,'Honey Ham & Egg Slider',3900,4,'3'),(27,'Bacon & Egg English Muffin',4000,4,'3'),(28,'Ham & Egg English Muffin',4000,4,'3'),(29,'Chili Sausage Hotdog',4500,4,'3'),(30,'Choco Bubble',5000,6,'3'),(31,'Pepperoni Large',15000,4,'4'),(32,'Vegetarian',15000,4,'4'),(33,'Cheese Pizza',15000,4,'4'),(34,'Cheese Pizza Slice',2000,4,'4'),(35,'Pepperoni Slice',2000,4,'4'),(36,'Korean Green Tea',5500,1,'7'),(37,'Chai',4800,2,'7'),(38,'Tropical Passion Latte',5500,6,'7'),(39,'Hot Double Chocolate',5300,6,'7'),(40,'Hazelnut Latte',5900,6,'7'),(41,'High Protein Almond',4900,6,'14'),(42,'Peanut Power Plus',4700,6,'14'),(43,'Banana Island',4700,6,'14'),(44,'Coconut Surprise',4900,6,'14'),(45,'Blackberry Smoothie',5700,6,'14'),(46,'Affogato',4500,6,'8'),(47,'Capuccino',4600,6,'8'),(48,'Espresso',3500,6,'8'),(49,'Earl Grey Tea',4000,6,'8'),(50,'Strawberry Latte',4800,6,'8'),(51,'Vanilla Latte',2800,6,'10'),(52,'Cafe Mocha',2800,6,'10'),(53,'Capuccino',2800,6,'10'),(54,'Lemon Iced Tea',1900,6,'10'),(55,'Blueberry Yogurt',3800,6,'10'),(56,'Hot Crispy Burger Set',6500,4,'5'),(57,'Bulgogi Burger Set',5600,4,'5'),(58,'Big Bulgogi Burger Set',7000,4,'5'),(59,'Shrimp Burger Set',5600,4,'5'),(60,'Chicken Burger Set',5100,4,'5'),(61,'Rice',400,1,'17'),(62,'Kimchi',400,1,'17'),(63,'Fried Rice',0,1,'18'),(64,'Pork Stew',0,1,'18'),(65,'Sausage Stew',0,1,'18'),(66,'Seafood Stew',0,1,'18'),(67,'Salted Beef and Rice',0,1,'18'),(68,'Gimbap ',0,1,'19'),(69,'Instant Noodles',0,1,'19'),(70,'Seafood Stew',0,1,'19'),(71,'Kimchi Fried Rice',0,1,'19'),(72,'Tonkatsu',0,1,'19'),(73,'Onigiri',0,2,'20'),(74,'Japanese-style Noodles',0,2,'20'),(75,'Egg Gyudong',0,2,'20'),(76,'Chicken Mayo Gyudong',0,2,'20'),(77,'Curry Gyudong',0,2,'20'),(78,'Black Soybean Sauce Noodles',0,3,'21'),(79,'Spicy Seafood Noodle Soup',0,3,'21'),(80,'Sweet and Sour Pork ',0,3,'21'),(81,'Mapo Tofu on Rice',0,3,'21'),(82,'Rice Cakes',0,1,'22'),(83,'Chicken Breast Salad',0,1,'22'),(84,'Salmon Salad',0,1,'22'),(85,'Fried Shrimp Salad',0,1,'22'),(86,'Fruit Salad',0,1,'22');
/*!40000 ALTER TABLE `dish` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-07 20:22:49
