-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: janberdy39
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

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
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (1,'dupka@wp.pl','2016-07-16 07:51:44'),(2,'dopler@wp.pl','2016-07-16 07:52:07'),(3,'rooter@wp.pl','2016-07-16 10:33:51');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interview`
--

DROP TABLE IF EXISTS `interview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `message_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `datetime_history` datetime NOT NULL,
  `id_operator_history` int(11) NOT NULL,
  `id_runner_history` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interview`
--

LOCK TABLES `interview` WRITE;
/*!40000 ALTER TABLE `interview` DISABLE KEYS */;
INSERT INTO `interview` VALUES (2,'htehethgj','rgetgetgesgsfrger','2017-03-08 11:27:06',1,1),(3,'asereje','a he he','2017-03-10 02:06:46',1,6);
/*!40000 ALTER TABLE `interview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `list_payments`
--

DROP TABLE IF EXISTS `list_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idu` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_cash` varchar(255) DEFAULT NULL,
  `datetime_payment` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `list_payments`
--

LOCK TABLES `list_payments` WRITE;
/*!40000 ALTER TABLE `list_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `list_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marathons`
--

DROP TABLE IF EXISTS `marathons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marathons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `distance` float DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `date_term` date DEFAULT NULL,
  `time_term` time DEFAULT NULL,
  `start_register` date DEFAULT NULL,
  `end_register` date DEFAULT NULL,
  `road_type` varchar(255) DEFAULT NULL,
  `limit_time_on_road` float DEFAULT NULL,
  `buy` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `link_road` varchar(255) DEFAULT NULL,
  `available` int(11) DEFAULT NULL,
  `attention` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marathons`
--

LOCK TABLES `marathons` WRITE;
/*!40000 ALTER TABLE `marathons` DISABLE KEYS */;
INSERT INTO `marathons` VALUES (1,'Bieg Krakowski',15.5,'Kraków','2016-02-04','17:30:00','2016-01-01','2016-01-17','górska',2.5,'','',NULL,150,'UWAGA: Spośród zgłoszeń organizatorzy losują 100 uczestników. Obowiązuje opłata rejestracyjna'),(2,'Maraton Warszawski',35.2,'Warszawa','2016-04-04','12:30:00','0000-00-00','0000-00-00','miejska',1,NULL,NULL,NULL,250,''),(6,'Testowy bieg',13,'Poznań','2017-01-01','02:02:02','2017-01-01','2017-01-01','podmiejska',13,'20','srgerwgrewg',NULL,250,'akum doom');
/*!40000 ALTER TABLE `marathons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operator`
--

DROP TABLE IF EXISTS `operator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authKey` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accessToken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator`
--

LOCK TABLES `operator` WRITE;
/*!40000 ALTER TABLE `operator` DISABLE KEYS */;
INSERT INTO `operator` VALUES (1,'admin','Gall','Anonim','admin',NULL,NULL);
/*!40000 ALTER TABLE `operator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reminder`
--

DROP TABLE IF EXISTS `password_reminder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reminder` (
  `passkey` varchar(255) DEFAULT NULL,
  `created_datatime` datetime DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT NULL,
  `by_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reminder`
--

LOCK TABLES `password_reminder` WRITE;
/*!40000 ALTER TABLE `password_reminder` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reminder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminder`
--

DROP TABLE IF EXISTS `reminder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_operator` int(11) DEFAULT NULL,
  `idu` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `datetime_reminder` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminder`
--

LOCK TABLES `reminder` WRITE;
/*!40000 ALTER TABLE `reminder` DISABLE KEYS */;
INSERT INTO `reminder` VALUES (1,NULL,NULL,'hfdhrthrth','2017-05-01 03:30:00'),(2,NULL,1,'jhtyjyt','2017-03-12 10:50:13'),(3,1,1,'jgguygu','2017-05-11 10:50:56'),(4,1,0,'asereje a he he','2017-03-22 22:50:58');
/*!40000 ALTER TABLE `reminder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roads_of_marathons`
--

DROP TABLE IF EXISTS `roads_of_marathons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roads_of_marathons` (
  `idm` int(11) DEFAULT NULL,
  `pkt` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roads_of_marathons`
--

LOCK TABLES `roads_of_marathons` WRITE;
/*!40000 ALTER TABLE `roads_of_marathons` DISABLE KEYS */;
/*!40000 ALTER TABLE `roads_of_marathons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `sex` int(11) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `zip_code` varchar(64) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `code_country` varchar(64) DEFAULT NULL,
  `walking_for` varchar(255) DEFAULT NULL,
  `walking_count` varchar(255) DEFAULT NULL,
  `walking_because` varchar(255) DEFAULT NULL,
  `shirt_size` varchar(255) DEFAULT NULL,
  `nr_card` varchar(255) DEFAULT NULL,
  `date_card` date DEFAULT NULL,
  `uname_card` varchar(255) DEFAULT NULL,
  `surname_card` varchar(255) DEFAULT NULL,
  `cvv_cvc` varchar(12) DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `from_medium` varchar(24) DEFAULT NULL,
  `assignment` varchar(255) DEFAULT NULL,
  `assignment2` varchar(255) DEFAULT NULL,
  `assignment3` varchar(255) DEFAULT NULL,
  `ip_adress` varchar(64) DEFAULT NULL,
  `is_online` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mahuda94@interia.pl','0192023a7bbd73250516f069df18b500','Michał','Hudaszek',2,'1234567869',NULL,'małopolskie','Rudniczek mójek','',NULL,'lubię rywalizację','20-49 km','lubię rywalizację','LX','1234123412344321','2016-09-17','Michał','Hudaszek',NULL,'2016-09-21 21:35:38','3','https://www.facebook.com/albert.kowalski.3154?fref=hovercard','dhgtegetrt','gethgteh',NULL,1,'Pc8oJPWQaz6eLnorRJEHeD0iLkzYtPdQdRyXWoOHdLJ9IjUCqUpWlL3NHAnz'),(3,'Benoits@interia.pl','feb4151417d34e5d13a816110dcc292e','allah','berge',2,'123',NULL,NULL,'Prostki',NULL,NULL,'','','bo tak',NULL,'1244543465754345','2016-09-01','allah','berge',NULL,'2016-09-28 20:37:20',NULL,NULL,NULL,NULL,NULL,0,NULL),(5,'berkel@wp.pl','feb4151417d34e5d13a816110dcc292e','Mojko','Borejko',2,'512421532',NULL,NULL,'rudnik',NULL,NULL,'','','bo tak',NULL,'1234567812345678','2016-10-30','Mojko','Borejko','CVV','2016-10-08 17:08:35',NULL,NULL,NULL,NULL,NULL,0,NULL),(6,'gothic@wp.pl','feb4151417d34e5d13a816110dcc292e','Michał','Kapiszon',2,'537416523','32-440',NULL,'Rudnik','Słoneczna','PL','','','bo tak',NULL,'1234123412341234','2016-10-27','Michał','Kapiszon','CVV','2016-10-10 23:15:19',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(7,'fallout@wp.pl','feb4151417d34e5d13a816110dcc292e','Piotr','Kukuła',2,'537416523','32-440',NULL,'rudnik','Słoneczna, 19','PL','','','bo tak',NULL,'1234123412341234','2016-10-28','Piotr','Kukuła','CVV','2016-10-10 23:25:39',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(8,'fallouter@wp.pl','8c7433f59f986ef5ed8cc39216669c9c','Piotr','Kukuła',2,'537416523','32-440',NULL,'rudnik','Słoneczna, 19','PL','','','bo tak',NULL,'1234123412341234','2016-10-26','Piotr','Kukuła','123','2016-10-11 19:07:48',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(9,'','d41d8cd98f00b204e9800998ecf8427e','','',2,'','','','','','','','','bo tak',NULL,'1234123412341234','2016-10-12','Piotr','Opryszek','321','2016-10-11 19:56:19',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(10,'elder@wp.pl','90b698368d61e82e055989fe02ab2810','Michał','Kapiszon',2,'537416523','32-440','małopolskie','Rudnik','Słoneczna','PL','','','bo tak',NULL,'1234123412341234','2016-10-08','Michał','Kapiszon','321','2016-10-11 19:57:32',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(11,'elders@wp.pl','76ef7d921b016252afe689b8f58bcf5c','Michał','Kapiszon',2,'537416523','32-440','małopolskie','Rudnik','Słoneczna','PL','','','bo tak',NULL,'1234123412341234','2016-10-03','Michał','Kapiszon','321','2016-10-11 20:07:52',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(12,'elderscroll@wp.pl','8c7433f59f986ef5ed8cc39216669c9c','Michał','Hudaszek',2,'537416523','32-440','małopolskie','Rudnik','Słoneczna','PL','','','bo tak',NULL,'1234123412341234','2016-10-15','Michał','Hudaszek','','2016-10-11 20:10:53',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(13,'moharius@wp.pl','da46d39137253e6b490a555a12281535','Michał','Kapiszon',2,'537416523','32-440','świętokrzyskie','kielce','Słoneczna','PL','','','bo tak',NULL,'1234123412341234','2016-10-06','Michał','Kapiszon','','2016-10-11 20:13:51',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(14,'yreczek123@wp.pl','feb4151417d34e5d13a816110dcc292e','Piotr','Opryszek',2,'537416523','32-440','pomorskie','Kraków','Słoneczna','PL','','','bo tak',NULL,'1234123412341234','2016-10-27','Piotr','Opryszek','','2016-10-11 20:15:16',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(15,'michaeljackson@wp.pl','feb4151417d34e5d13a816110dcc292e','Michael','Jackson',2,'512421532','452354','małopolskie','Rudnik, Krakow, Poland','Słonedca,19','PL','','','',NULL,'1244543465754345','2017-03-31','Michael','Jackson','123','2017-02-12 22:49:11',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL),(16,'przebacz@wp.pl','b2dd24e00e631c5040b292ed2728d5d9','Moher','Bejharło',1,'413','32453','małopolskie','Rudnik, Krakow, Poland','Mazowsza 54','PL','odkąd pamiętam','20-49 km','bo tak sobie lubie dresik','XL','1234567812345678','2017-03-25','Moher','Bejharło','123','2017-02-12 23:11:27',NULL,NULL,NULL,NULL,'127.0.0.1',0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_of_marathons`
--

DROP TABLE IF EXISTS `users_of_marathons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_of_marathons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idm` int(11) DEFAULT NULL,
  `idu` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `passing` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_of_marathons`
--

LOCK TABLES `users_of_marathons` WRITE;
/*!40000 ALTER TABLE `users_of_marathons` DISABLE KEYS */;
INSERT INTO `users_of_marathons` VALUES (1,1,1,1,NULL),(2,2,1,1,NULL),(3,1,6,1,NULL);
/*!40000 ALTER TABLE `users_of_marathons` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-18 22:56:14
