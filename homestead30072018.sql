-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: homestead
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `shipment_id` int(10) unsigned NOT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_shipment_id_foreign` (`shipment_id`),
  CONSTRAINT `comments_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,4,'gfdg','2018-07-17 10:06:20','2018-07-17 10:06:20'),(2,1,2,'fsdfdsfdsffsdffdfd','2018-07-17 14:10:04','2018-07-17 14:10:04'),(3,1,2,';kl\'k\';','2018-07-18 07:03:06','2018-07-18 07:03:06'),(4,1,5,'gfdg','2018-07-18 07:10:40','2018-07-18 07:10:40'),(5,1,2,';lkl;','2018-07-19 04:54:47','2018-07-19 04:54:47'),(6,1,4,'fsdf','2018-07-19 14:47:58','2018-07-19 14:47:58'),(7,1,2,'sdasd','2018-07-19 14:49:37','2018-07-19 14:49:37'),(8,1,61,'dsad','2018-07-23 09:56:16','2018-07-23 09:56:16'),(9,1,61,'dsad','2018-07-23 09:56:19','2018-07-23 09:56:19'),(10,1,60,'hkl','2018-07-23 10:30:46','2018-07-23 10:30:46'),(11,1,61,'kjl','2018-07-24 09:31:11','2018-07-24 09:31:11'),(12,1,61,'hjkhk','2018-07-24 10:22:41','2018-07-24 10:22:41'),(13,1,64,'suriya is normal','2018-07-24 10:49:03','2018-07-24 10:49:03'),(14,1,61,'fsdf','2018-07-24 10:53:42','2018-07-24 10:53:42'),(15,1,64,'klhk','2018-07-24 10:54:01','2018-07-24 10:54:01'),(16,1,63,'fgdfg','2018-07-24 10:59:42','2018-07-24 10:59:42'),(17,1,61,'gfdg','2018-07-24 10:59:59','2018-07-24 10:59:59'),(18,1,62,NULL,'2018-07-24 11:00:38','2018-07-24 11:00:38'),(19,1,58,NULL,'2018-07-24 11:01:24','2018-07-24 11:01:24'),(20,1,64,NULL,'2018-07-24 11:02:38','2018-07-24 11:02:38'),(21,1,64,NULL,'2018-07-24 11:08:50','2018-07-24 11:08:50'),(22,1,64,NULL,'2018-07-24 11:11:47','2018-07-24 11:11:47'),(23,1,64,NULL,'2018-07-24 11:12:11','2018-07-24 11:12:11'),(24,1,3,NULL,'2018-07-24 11:12:56','2018-07-24 11:12:56'),(25,1,64,NULL,'2018-07-24 11:18:51','2018-07-24 11:18:51'),(26,1,62,'hkjhl','2018-07-24 11:33:02','2018-07-24 11:33:02'),(27,1,58,'dfsdfsdff','2018-07-24 13:54:49','2018-07-24 13:54:49'),(28,1,70,'fsdfsdf','2018-07-24 13:55:11','2018-07-24 13:55:11'),(29,1,70,'fsdf','2018-07-24 13:55:20','2018-07-24 13:55:20'),(30,1,58,'ghjgh','2018-07-24 14:28:23','2018-07-24 14:28:23'),(31,1,72,'Contrary to popular belief, Lorem Ipsu','2018-07-24 14:32:00','2018-07-24 14:32:00'),(32,1,72,'jhgh','2018-07-24 14:39:06','2018-07-24 14:39:06'),(33,1,61,'fsdf','2018-07-24 14:44:26','2018-07-24 14:44:26'),(34,1,58,'fdsfds','2018-07-24 14:44:30','2018-07-24 14:44:30'),(35,1,58,'sadsadsadddsadd','2018-07-24 14:45:09','2018-07-24 14:45:09'),(36,1,65,'dfsdf','2018-07-24 14:49:18','2018-07-24 14:49:18');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (13,'2014_10_12_000000_create_users_table',1),(14,'2014_10_12_100000_create_password_resets_table',1),(15,'2018_07_05_072144_shipments',1),(16,'2018_07_12_134202_shipment',2),(17,'2018_07_13_050320_comments',3),(18,'2018_07_16_053822_shipments',4),(19,'2018_07_20_091059_shipments',5),(20,'2018_07_20_091354_shipments',6),(21,'2018_07_20_091622_shipments',7),(22,'2018_07_23_070652_shipments',8),(23,'2018_07_23_073748_shipments',9),(24,'2018_07_23_074119_shipments',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('kayalvizhi.manavalan@excelenciaconsulting.com','$2y$10$d7gXYHMIRKkaovvhWbWzKek1rJFKut9HXLv7SQD5Ccgso/3V2DxHa','2018-07-26 09:10:01');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipments`
--

DROP TABLE IF EXISTS `shipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ff` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contnr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_del` date DEFAULT NULL,
  `doc_co` date DEFAULT NULL,
  `pier_co` date DEFAULT NULL,
  `rep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `items` bigint(20) DEFAULT NULL,
  `cases` bigint(20) DEFAULT NULL,
  `shpd` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipments`
--

LOCK TABLES `shipments` WRITE;
/*!40000 ALTER TABLE `shipments` DISABLE KEYS */;
INSERT INTO `shipments` VALUES (1,'vel','8575','D','ffj',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-17 11:08:09','2018-07-23 10:55:44','IAS_ Dray Management  Process Flow.pdf',1),(2,'df','43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-17 11:47:25','2018-07-23 13:44:11','Shipments upload.xlsx',0),(3,'kaviyarasan','654656',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'+919944145573',NULL,'2018-07-17 11:54:11','2018-07-23 10:56:44','IAS_ Dray Management  Process Flow.pdf',1),(4,'gfdg','435435',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-17 12:23:01','2018-07-23 10:57:22','IAS_ Dray Management  Process Flow.pdf',0),(5,'gfdg','43543',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-17 12:23:12','2018-07-23 10:57:46',NULL,0),(57,'Ali Bin Ali','21804090','D','Safmrn','40 R ','2018-05-14','2018-05-21','2018-05-21','TF',1,136,NULL,'X',NULL,'2018-07-23 09:29:59','2018-07-23 13:42:37',NULL,0),(58,'Gulf West','21805006','M','HPL','40','2018-05-15','2018-05-18','2018-05-21','TF',1,960,NULL,'X',NULL,'2018-07-23 09:29:59','2018-07-24 11:36:29','IAS_ Dray Management  Process Flow.pdf',1),(59,'Multi Foods','21805071','M','Safmrn','40','2018-05-15','2018-05-18','2018-05-21','NS',1,850,NULL,'X',NULL,'2018-07-23 09:29:59','2018-07-23 13:37:48',NULL,0),(60,'Ali Bin Ali','21804090','D','Safmrn','40 R ','2018-05-14','2018-05-21','2018-05-21','TF',1,136,NULL,'X',NULL,'2018-07-23 09:35:10','2018-07-23 13:37:05',NULL,0),(61,'Gulf West','21805006','M','HPL','40','2018-05-15','2018-05-18','2018-05-21','TF',1,960,NULL,'X',NULL,'2018-07-23 09:35:10','2018-07-23 15:41:44','IAS_ Dray Management  Process Flow.pdf',1),(62,'Multi Foods','21805071','M','Safmrn','40','2018-05-15','2018-05-18','2018-05-21','NS',1,850,NULL,'X',NULL,'2018-07-23 09:35:10','2018-07-23 10:55:41','IAS_ Dray Management  Process Flow.pdf',1),(63,'kjhk','7878',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-24 10:48:15','2018-07-24 11:43:07','dockReceipt 37994.pdf',1),(64,'suriya','43234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-24 10:48:29','2018-07-24 11:33:47','dockReceipt 37994.pdf',1),(65,'khjkjhk','8678',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-24 11:43:25','2018-07-24 11:52:26','IAS_ Dray Management  Process Flow.pdf',1),(66,'sfdsdf','5436',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-24 11:59:04','2018-07-24 11:59:23','IAS_ Dray Management  Process Flow.pdf',1),(67,'jghj','56756',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-07-24 13:12:01','2018-07-24 13:12:01',NULL,1),(69,'Ali Bin Ali','21804090','D','Safmrn','40 R ','2018-05-14','2018-05-21','2018-05-21','TF',1,136,NULL,'X',NULL,'2018-07-24 13:49:37','2018-07-24 14:35:14',NULL,0),(70,'Gulf West','21805006','M','HPL','40','2018-05-15','2018-05-18','2018-05-21','TF',1,960,NULL,'X',NULL,'2018-07-24 13:49:37','2018-07-24 13:49:37',NULL,1),(71,'Multi Foods','21805071','M','Safmrn','40','2018-05-15','2018-05-18','2018-05-21','NS',1,850,NULL,'X',NULL,'2018-07-24 13:49:37','2018-07-24 13:49:37',NULL,1),(72,'Ali Bin Ali','21804090','D','Safmrn','40 R ','2018-05-14','2018-05-21','2018-05-21','TF',1,136,NULL,'X',NULL,'2018-07-24 13:57:42','2018-07-24 13:57:42',NULL,1),(73,'Gulf West','21805006','M','HPL','40','2018-05-15','2018-05-18','2018-05-21','TF',1,960,NULL,'X',NULL,'2018-07-24 13:57:42','2018-07-24 13:57:42',NULL,1),(74,'Multi Foods','21805071','M','Safmrn','40','2018-05-15','2018-05-18','2018-05-21','NS',1,850,NULL,'X',NULL,'2018-07-24 13:57:42','2018-07-24 13:57:42',NULL,1);
/*!40000 ALTER TABLE `shipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kayal','kayalvizhi.manavalan@excelenciaconsulting.com','$2y$10$1Pcp9Fb3J.6Zo2Acoj6GSOTXXNfOj0suTV0SeigJGbTnt46PQ7SBK',1,'yKdEg4RLoGnF9uOwIivIEQ3CqBZhlGf7RhFmBCvaIv8PkS7lYnPl17ZfbLEa','2018-07-05 07:43:21','2018-07-05 07:43:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-30  9:24:50
