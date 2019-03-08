-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: rakordir
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.37-MariaDB

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
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (1,1,'5tmL1vbMqe','9yhx763QFIF7465Yvb9cPa7ymQuZ6WCBXN3ipS9kgFsxcj1SDwjzM8gg1nan24JnOqhts1PICOHCtkSaoz8QxIKGhZ7uXz2e9M3l.pdf','2019-02-26 09:02:44','2019-02-26 09:02:44'),(2,1,'ff0SNu7pUB','LM0t3WivYwyzXz3FIfBXTTUREpbXH8EBmY5KPubcp79BuXMdKvgeWAQ8jf4ogx53sCVDAPC41psI0llqYTAUfNdvTJykM3dWf0Zz.pdf','2019-02-26 09:02:44','2019-02-26 09:02:44');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materi_user`
--

DROP TABLE IF EXISTS `materi_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materi_user` (
  `materi_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`materi_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materi_user`
--

LOCK TABLES `materi_user` WRITE;
/*!40000 ALTER TABLE `materi_user` DISABLE KEYS */;
INSERT INTO `materi_user` VALUES (1,5),(1,6);
/*!40000 ALTER TABLE `materi_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materis`
--

DROP TABLE IF EXISTS `materis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `agenda_no` int(11) NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keluar` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_dokumen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presenter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materis`
--

LOCK TABLES `materis` WRITE;
/*!40000 ALTER TABLE `materis` DISABLE KEYS */;
INSERT INTO `materis` VALUES (1,'2019-02-28',1,'kurob','08:00','09:00','Test rakoor','NO/Rakoor/112','Admin','2019-02-26 09:02:44','2019-02-28 08:53:54'),(2,'2019-02-28',3,'kurob','14:00','16:00','TEST RAKORDIR AGENDA KE 3','TEST RAKORDIR AGENDA KE 3','Presentasi 1','2019-02-28 08:57:39','2019-02-28 08:57:39');
/*!40000 ALTER TABLE `materis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=395 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (387,'2014_10_12_000000_create_users_table',1),(388,'2014_10_12_100000_create_password_resets_table',1),(389,'2019_01_10_054850_create_rakoor_materi',1),(390,'2019_01_10_073504_create_permission_tables',1),(391,'2019_01_13_114236_create_partisipan_table',1),(392,'2019_01_15_084459_create_notulens_table',1),(393,'2019_01_15_185830_reporters',1),(394,'2019_02_26_154451_create_progresses_tabel',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(2,'App\\User',2),(2,'App\\User',3),(3,'App\\User',3),(3,'App\\User',4),(3,'App\\User',5),(3,'App\\User',6),(3,'App\\User',7),(4,'App\\User',2),(4,'App\\User',7),(5,'App\\User',2),(5,'App\\User',6),(5,'App\\User',7);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notulens`
--

DROP TABLE IF EXISTS `notulens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notulens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'PIC',
  `start` date NOT NULL,
  `end` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notulens`
--

LOCK TABLES `notulens` WRITE;
/*!40000 ALTER TABLE `notulens` DISABLE KEYS */;
INSERT INTO `notulens` VALUES (1,1,'<p>Test 123</p>',7,'2019-02-24','2019-02-28','2019-02-26 09:04:24','2019-02-26 09:04:24'),(2,1,'Memantau Pekerjaan sehari2',6,'2019-03-01','2019-03-31','2019-02-27 00:14:10','2019-02-27 00:14:10'),(3,2,'<p>asadsad</p>',2,'2019-03-01','2019-03-31','2019-02-28 09:09:57','2019-02-28 09:09:57');
/*!40000 ALTER TABLE `notulens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'create materis','web','2019-02-26 09:02:45','2019-02-26 09:02:45'),(2,'read materis','web','2019-02-26 09:02:45','2019-02-26 09:02:45'),(3,'update materis','web','2019-02-26 09:02:45','2019-02-26 09:02:45'),(4,'delete materis','web','2019-02-26 09:02:45','2019-02-26 09:02:45'),(5,'create partisipans','web','2019-02-26 09:02:45','2019-02-26 09:02:45'),(6,'read partisipans','web','2019-02-26 09:02:45','2019-02-26 09:02:45'),(7,'update partisipans','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(8,'delete partisipans','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(9,'create notulens','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(10,'read notulens','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(11,'update notulens','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(12,'delete notulens','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(13,'create pic','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(14,'read pic','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(15,'update pic','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(16,'delete pic','web','2019-02-26 09:02:46','2019-02-26 09:02:46');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progresses`
--

DROP TABLE IF EXISTS `progresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `progresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notulen_id` int(11) NOT NULL,
  `proker` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'PIC',
  `realisasi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progresses`
--

LOCK TABLES `progresses` WRITE;
/*!40000 ALTER TABLE `progresses` DISABLE KEYS */;
INSERT INTO `progresses` VALUES (2,2,'Test',2,35,'2019-02-27 19:47:11','2019-02-28 08:02:03'),(3,2,'Tes 2',3,66,'2019-02-27 20:40:43','2019-02-27 20:40:43'),(5,3,'asdasda',3,80,'2019-02-28 09:10:23','2019-02-28 09:22:13');
/*!40000 ALTER TABLE `progresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporters`
--

DROP TABLE IF EXISTS `reporters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `materi_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporters`
--

LOCK TABLES `reporters` WRITE;
/*!40000 ALTER TABLE `reporters` DISABLE KEYS */;
INSERT INTO `reporters` VALUES (1,7,1,'2019-02-26 09:03:44','2019-02-26 09:03:44'),(2,2,2,'2019-02-28 09:09:32','2019-02-28 09:09:32');
/*!40000 ALTER TABLE `reporters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(1,2),(2,1),(2,2),(2,3),(2,4),(2,5),(3,1),(3,2),(4,1),(4,2),(5,1),(5,2),(6,1),(6,2),(6,3),(6,4),(6,5),(7,1),(7,2),(8,1),(8,2),(9,1),(9,2),(9,4),(10,1),(10,4),(11,1),(11,4),(12,1),(12,2),(12,4),(13,1),(13,5),(14,1),(14,5),(15,1),(15,5),(16,1),(16,5);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrator','web','2019-02-26 09:02:46','2019-02-26 09:02:46'),(2,'admin','web','2019-02-26 09:02:47','2019-02-26 09:02:47'),(3,'user','web','2019-02-26 09:02:47','2019-02-26 09:02:47'),(4,'notulis','web','2019-02-26 09:02:48','2019-02-26 09:02:48'),(5,'pic','web','2019-02-26 09:02:48','2019-02-26 09:02:48');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'administrator','administrator','administrator@gmail.com','2019-02-26 09:02:48','$2y$10$AnIJavNgpAHWCc1K5NVkq.HdN.qbwl7r8Fyz0bRHYZv88JNqIgyYS','bHw602r84scznPSlMpYAd6PFR7JD7UWBTif2MHld3vFXatnRJ2QjtPavjHC3','2019-02-26 09:02:49','2019-02-26 09:02:49'),(2,'kurob','kurob','kurob@gmail.com','2019-02-26 09:02:49','$2y$10$7nVuDwcbnONzhvb5ImeuDuQMx2Q81iUE2GTEM1.Vp7HgooC6B5GY6','Fl3rgYC39tMy2xnxESuUso3kC8R5NKwtG8EmycIX6f61DDTmT4skQu0NHrLC','2019-02-26 09:02:49','2019-02-26 09:02:49'),(3,'user1','user1','user1@gmail.com','2019-02-26 09:02:49','$2y$10$EC3ecLDmHCvpHGikYA9ux.AcgpJJOtZpzry.KPWWdYjWqzKzoU.hK',NULL,'2019-02-26 09:02:49','2019-02-26 09:02:49'),(4,'user2','user2','user2@gmail.com','2019-02-26 09:02:49','$2y$10$kNrrxQv/qZ7.wddpyoRXde6V6sLNbXewDrU5SK.jJCmsk28pEVJyu',NULL,'2019-02-26 09:02:50','2019-02-26 09:02:50'),(5,'user3','user3','user3@gmail.com','2019-02-26 09:02:50','$2y$10$hgRNnCxSr7zUarNoX82Rv.NagQ7IxtOPLTYXd7byLm5vwUqOR6lt.','7AT4ZBfBZ5OakENI8d977Uf3NUDbKhnwbyukhsLvpHp9mALgMkvMUpyXTyd7','2019-02-26 09:02:50','2019-02-26 09:02:50'),(6,'user4','user4','user4@gmail.com','2019-02-26 09:02:50','$2y$10$pnFfUDoudK9.qusVn5P3mOUI8Q2sDqFkjB/5YhbMrAsPm7N4Pam.e','SgR8TxtZQloJMFiGPV29GO0Axb7DYO6lJCKUILWS7y7TaaoXIAKAJzNo5Fro','2019-02-26 09:02:50','2019-02-26 09:02:50'),(7,'user5','user5','user5@gmail.com','2019-02-26 09:02:50','$2y$10$mmRAX4rz8M519AnrOT.OwucqVqs13ZCbK9VzkVX72pulXq.5qUcYW','9VtnwuGZoEtojCDUHxwF6hqwGjTRwiY9flHlnDa1W0bj5d0lpBIG11ZPkSWu','2019-02-26 09:02:50','2019-02-26 09:02:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'rakordir'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-08 22:04:49
