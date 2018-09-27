-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: 172.16.0.208    Database: Sandbox
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.36-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `lnk_task_statuses`
--

DROP TABLE IF EXISTS `lnk_task_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lnk_task_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id статуса',
  `task_id` int(11) NOT NULL COMMENT 'Id мероприятия',
  `status_id` int(11) NOT NULL COMMENT 'Id статуса',
  `createdatetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания запаси',
  `createuserid` int(11) NOT NULL COMMENT 'Пользователь создавший запись',
  PRIMARY KEY (`id`),
  KEY `fk_task_statuses_idx` (`status_id`),
  KEY `fk_task_statuses2_idx` (`task_id`),
  KEY `fk_task_statuses3` (`createuserid`),
  CONSTRAINT `fk_task_statuses1` FOREIGN KEY (`status_id`) REFERENCES `spr_task_statuses` (`id`),
  CONSTRAINT `fk_task_statuses2` FOREIGN KEY (`task_id`) REFERENCES `spr_tasks` (`id`),
  CONSTRAINT `fk_task_statuses3` FOREIGN KEY (`createuserid`) REFERENCES `spr_users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lnk_task_statuses`
--

LOCK TABLES `lnk_task_statuses` WRITE;
/*!40000 ALTER TABLE `lnk_task_statuses` DISABLE KEYS */;
INSERT INTO `lnk_task_statuses` VALUES (1,1,1,'2018-09-26 07:11:16',1),(2,2,3,'2018-09-26 09:33:00',1);
/*!40000 ALTER TABLE `lnk_task_statuses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-27 17:00:33
