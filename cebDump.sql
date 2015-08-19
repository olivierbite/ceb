# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.6.25)
# Database: ceb
# Generation Time: 2015-08-19 20:10:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entitled` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_nature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;

INSERT INTO `accounts` (`id`, `account_number`, `entitled`, `account_nature`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'1','Capital','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(2,'28','Reserve','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(3,'25','Provisions pour charges','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(4,'2','Immobilisations Corporelles','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(5,'35','Autres Immobilisations Corporelles','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(6,'8','Prets aux membres','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(7,'36','Pret a Risque','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(8,'3','Personnels','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(9,'4','Avance sur salaire','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(10,'5','Taxe Professionnelle','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(11,'6','CSR','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(12,'7','Ms/UNR','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(13,'9','Epargne des membres','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(14,'31','Epargne des membres inactif','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(15,'49','Epargne des autres institutions','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(16,'26','Debiteurs Divers','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(17,'27','Crediteurs Divers','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(18,'42','Creances sur IRST','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(19,'44','Creances sur CHUB','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(20,'45','Creances sur UNR','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(21,'46','Creances sur CHUK','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(22,'47','Creances sur MS UNR','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(23,'48','Creances sur LABOPHAR','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(24,'56','Creance sur INMR','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(25,'33','Regularisation Actif','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(26,'55','Interet a retirer','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(27,'34','Regularisation Passif','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(28,'10','BK Butare','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(29,'11','BCR','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(30,'29','Compte Epargne BK','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(31,'30','Compte Epargne BCR','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(32,'32','Compte 4 to 4 BCR','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(33,'59','COGEBANQUE','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(34,'60','COMPTE EPARGNE COGEBANQUE','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(35,'50','Petite Caisse','ACTIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(36,'12','Matieres et fournitures','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(37,'13','Transports et Cons','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(38,'14','Autres services cons','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(39,'15','Charges et pertes diverses','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(40,'16','Frais du personnel','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(41,'51','Impot et Taxes','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(42,'17','Interets payes','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(43,'19','Interets retournes','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(44,'20','Amortissements','CHARGES','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(45,'21','Profits divers','PRODUITS','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(46,'22','Interets sur P.0','PRODUITS','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(47,'23','Interets sur PS','PRODUITS','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(48,'24','Resultats','PASSIF','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table activity_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;

INSERT INTO `activity_log` (`id`, `user_id`, `text`, `ip_address`, `created_at`, `updated_at`)
VALUES
	(4,NULL,'Article \"\" was created','::1','2015-08-05 20:59:06','2015-08-05 20:59:06'),
	(5,NULL,'Article \"\" was created','::1','2015-08-05 20:59:06','2015-08-05 20:59:06'),
	(6,NULL,'Article \"\" was created','::1','2015-08-05 20:59:06','2015-08-05 20:59:06'),
	(7,NULL,'Article \"\" was created','::1','2015-08-05 20:59:06','2015-08-05 20:59:06'),
	(8,NULL,'Article \"\" was created','::1','2015-08-05 20:59:06','2015-08-05 20:59:06'),
	(9,NULL,'Article \"\" was created','::1','2015-08-05 21:00:37','2015-08-05 21:00:37'),
	(10,NULL,'Article \"\" was created','::1','2015-08-05 21:00:37','2015-08-05 21:00:37'),
	(11,NULL,'Article \"\" was created','::1','2015-08-05 21:00:37','2015-08-05 21:00:37'),
	(12,NULL,'Article \"\" was created','::1','2015-08-05 21:00:37','2015-08-05 21:00:37'),
	(13,NULL,'Article \"\" was created','::1','2015-08-05 21:00:37','2015-08-05 21:00:37'),
	(14,NULL,'Article \"\" was created','::1','2015-08-05 21:00:50','2015-08-05 21:00:50'),
	(15,NULL,'Article \"\" was created','::1','2015-08-05 21:00:50','2015-08-05 21:00:50'),
	(16,NULL,'Article \"\" was created','::1','2015-08-05 21:00:50','2015-08-05 21:00:50'),
	(17,NULL,'Article \"\" was created','::1','2015-08-05 21:00:50','2015-08-05 21:00:50'),
	(18,NULL,'Article \"\" was created','::1','2015-08-05 21:00:50','2015-08-05 21:00:50'),
	(30,NULL,'Article \"\" was created','::1','2015-08-08 19:23:46','2015-08-08 19:23:46'),
	(31,NULL,'Article \"\" was created','::1','2015-08-08 19:23:46','2015-08-08 19:23:46'),
	(32,NULL,'Article \"\" was created','::1','2015-08-08 19:23:46','2015-08-08 19:23:46'),
	(33,NULL,'Article \"\" was created','::1','2015-08-08 19:25:59','2015-08-08 19:25:59'),
	(34,NULL,'Article \"\" was created','::1','2015-08-08 19:25:59','2015-08-08 19:25:59'),
	(35,NULL,'Article \"\" was created','::1','2015-08-08 19:25:59','2015-08-08 19:25:59'),
	(38,NULL,'Article \"\" was created','::1','2015-08-10 08:49:42','2015-08-10 08:49:42'),
	(39,NULL,'Article \"\" was created','::1','2015-08-10 08:49:42','2015-08-10 08:49:42'),
	(40,NULL,'Article \"\" was created','::1','2015-08-10 08:49:42','2015-08-10 08:49:42'),
	(43,NULL,'Article \"\" was created','::1','2015-08-10 08:51:36','2015-08-10 08:51:36'),
	(44,NULL,'Article \"\" was created','::1','2015-08-10 08:51:36','2015-08-10 08:51:36'),
	(45,NULL,'Article \"\" was created','::1','2015-08-10 08:51:36','2015-08-10 08:51:36'),
	(49,NULL,'Article \"\" was created','::1','2015-08-10 08:53:59','2015-08-10 08:53:59'),
	(50,NULL,'Article \"\" was created','::1','2015-08-10 08:53:59','2015-08-10 08:53:59'),
	(51,NULL,'Article \"\" was created','::1','2015-08-10 08:53:59','2015-08-10 08:53:59'),
	(52,NULL,'Article \"\" was created','::1','2015-08-10 08:54:20','2015-08-10 08:54:20'),
	(53,NULL,'Article \"\" was created','::1','2015-08-10 08:54:20','2015-08-10 08:54:20'),
	(54,NULL,'Article \"\" was created','::1','2015-08-10 08:54:21','2015-08-10 08:54:21'),
	(55,NULL,'Article \"\" was created','::1','2015-08-10 08:54:49','2015-08-10 08:54:49'),
	(56,NULL,'Article \"\" was created','::1','2015-08-10 08:54:49','2015-08-10 08:54:49'),
	(57,NULL,'Article \"\" was created','::1','2015-08-10 08:54:49','2015-08-10 08:54:49'),
	(58,NULL,'Article \"\" was created','::1','2015-08-10 08:56:57','2015-08-10 08:56:57'),
	(59,NULL,'Article \"\" was created','::1','2015-08-10 08:56:57','2015-08-10 08:56:57'),
	(60,NULL,'Article \"\" was created','::1','2015-08-10 08:56:57','2015-08-10 08:56:57'),
	(61,NULL,'Article \"\" was created','::1','2015-08-10 08:57:29','2015-08-10 08:57:29'),
	(62,NULL,'Article \"\" was created','::1','2015-08-10 08:57:29','2015-08-10 08:57:29'),
	(63,NULL,'Article \"\" was created','::1','2015-08-10 08:57:29','2015-08-10 08:57:29'),
	(64,NULL,'Article \"\" was created','::1','2015-08-10 08:57:40','2015-08-10 08:57:40'),
	(65,NULL,'Article \"\" was created','::1','2015-08-10 08:57:40','2015-08-10 08:57:40'),
	(66,NULL,'Article \"\" was created','::1','2015-08-10 08:57:40','2015-08-10 08:57:40'),
	(67,NULL,'Article \"\" was created','::1','2015-08-10 09:00:38','2015-08-10 09:00:38'),
	(68,NULL,'Article \"\" was created','::1','2015-08-10 09:00:38','2015-08-10 09:00:38'),
	(69,NULL,'Article \"\" was created','::1','2015-08-10 09:00:38','2015-08-10 09:00:38'),
	(70,NULL,'Article \"\" was created','::1','2015-08-10 09:08:15','2015-08-10 09:08:15'),
	(71,NULL,'Article \"\" was created','::1','2015-08-10 09:08:15','2015-08-10 09:08:15'),
	(72,NULL,'Article \"\" was created','::1','2015-08-10 09:08:15','2015-08-10 09:08:15'),
	(73,NULL,'Article \"\" was created','::1','2015-08-10 09:09:26','2015-08-10 09:09:26'),
	(74,NULL,'Article \"\" was created','::1','2015-08-10 09:09:26','2015-08-10 09:09:26'),
	(75,NULL,'Article \"\" was created','::1','2015-08-10 09:09:26','2015-08-10 09:09:26'),
	(76,NULL,'Article \"\" was created','::1','2015-08-10 09:11:08','2015-08-10 09:11:08'),
	(77,NULL,'Article \"\" was created','::1','2015-08-10 09:11:08','2015-08-10 09:11:08'),
	(78,NULL,'Article \"\" was created','::1','2015-08-10 09:11:08','2015-08-10 09:11:08'),
	(79,NULL,'Article \"\" was created','::1','2015-08-10 09:11:31','2015-08-10 09:11:31'),
	(80,NULL,'Article \"\" was created','::1','2015-08-10 09:11:31','2015-08-10 09:11:31'),
	(81,NULL,'Article \"\" was created','::1','2015-08-10 09:11:31','2015-08-10 09:11:31'),
	(82,NULL,'Article \"\" was created','::1','2015-08-10 09:12:43','2015-08-10 09:12:43'),
	(83,NULL,'Article \"\" was created','::1','2015-08-10 09:12:43','2015-08-10 09:12:43'),
	(84,NULL,'Article \"\" was created','::1','2015-08-10 09:12:43','2015-08-10 09:12:43'),
	(86,NULL,'Article \"\" was created','::1','2015-08-11 10:27:59','2015-08-11 10:27:59'),
	(87,NULL,'Article \"\" was created','::1','2015-08-11 10:27:59','2015-08-11 10:27:59'),
	(88,NULL,'Article \"\" was created','::1','2015-08-11 10:27:59','2015-08-11 10:27:59'),
	(90,NULL,'Article \"\" was created','::1','2015-08-11 13:57:52','2015-08-11 13:57:52'),
	(91,NULL,'Article \"\" was created','::1','2015-08-11 13:57:52','2015-08-11 13:57:52'),
	(92,NULL,'Article \"\" was created','::1','2015-08-11 13:57:52','2015-08-11 13:57:52'),
	(93,NULL,'Article \"\" was created','::1','2015-08-11 13:59:58','2015-08-11 13:59:58'),
	(94,NULL,'Article \"\" was created','::1','2015-08-11 13:59:58','2015-08-11 13:59:58'),
	(95,NULL,'Article \"\" was created','::1','2015-08-11 13:59:58','2015-08-11 13:59:58'),
	(112,NULL,'Article \"\" was created','::1','2015-08-11 14:32:12','2015-08-11 14:32:12'),
	(113,NULL,'Article \"\" was created','::1','2015-08-11 14:32:12','2015-08-11 14:32:12'),
	(114,NULL,'Article \"\" was created','::1','2015-08-11 14:32:12','2015-08-11 14:32:12'),
	(115,NULL,'Article \"\" was created','::1','2015-08-11 14:41:09','2015-08-11 14:41:09'),
	(116,NULL,'Article \"\" was created','::1','2015-08-11 14:41:09','2015-08-11 14:41:09'),
	(117,NULL,'Article \"\" was created','::1','2015-08-11 14:41:09','2015-08-11 14:41:09'),
	(118,NULL,'Article \"\" was created','::1','2015-08-12 09:39:51','2015-08-12 09:39:51'),
	(119,NULL,'Article \"\" was created','::1','2015-08-12 09:39:51','2015-08-12 09:39:51'),
	(120,NULL,'Article \"\" was created','::1','2015-08-12 09:39:51','2015-08-12 09:39:51'),
	(121,NULL,'Article \"\" was created','::1','2015-08-12 09:39:51','2015-08-12 09:39:51'),
	(122,NULL,'Article \"\" was created','::1','2015-08-12 09:39:51','2015-08-12 09:39:51'),
	(124,NULL,'Article \"\" was created','::1','2015-08-12 09:49:04','2015-08-12 09:49:04'),
	(125,NULL,'Article \"\" was created','::1','2015-08-12 09:49:04','2015-08-12 09:49:04'),
	(126,NULL,'Article \"\" was created','::1','2015-08-12 09:49:04','2015-08-12 09:49:04'),
	(137,NULL,'Article \"\" was created','::1','2015-08-12 10:57:52','2015-08-12 10:57:52'),
	(138,NULL,'Article \"\" was created','::1','2015-08-12 10:57:52','2015-08-12 10:57:52'),
	(139,NULL,'Article \"\" was created','::1','2015-08-12 10:57:52','2015-08-12 10:57:52'),
	(140,NULL,'Article \"\" was created','::1','2015-08-12 10:57:52','2015-08-12 10:57:52'),
	(141,NULL,'Article \"\" was created','::1','2015-08-12 11:00:13','2015-08-12 11:00:13'),
	(142,NULL,'Article \"\" was created','::1','2015-08-12 11:00:13','2015-08-12 11:00:13'),
	(143,NULL,'Article \"\" was created','::1','2015-08-12 11:00:13','2015-08-12 11:00:13'),
	(144,NULL,'Article \"\" was created','::1','2015-08-12 11:00:13','2015-08-12 11:00:13');

/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table attacher_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attacher_images`;

CREATE TABLE `attacher_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` int(10) unsigned NOT NULL,
  `subject_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_size` smallint(5) unsigned DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `attacher_images_subject_id_index` (`subject_id`),
  KEY `attacher_images_subject_type_index` (`subject_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table attorney
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attorney`;

CREATE TABLE `attorney` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `names` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table contributions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contributions`;

CREATE TABLE `contributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adhersion_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `month` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `transactionid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contract_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `contributions` WRITE;
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;

INSERT INTO `contributions` (`id`, `adhersion_id`, `institution_id`, `month`, `amount`, `state`, `created_at`, `updated_at`, `deleted_at`, `transactionid`, `year`, `contract_number`)
VALUES
	(1,201500000,6,'08',54000.00,'Ancien','2015-08-05 21:00:50','2015-08-05 21:00:50',NULL,'2015080521001','2015','CONTRACT201508051'),
	(2,201500004,6,'08',5000000.00,'Ancien','2015-08-05 21:00:50','2015-08-05 21:00:50',NULL,'2015080521001','2015','CONTRACT201508052'),
	(3,201500006,6,'08',2500823.00,'Ancien','2015-08-05 21:00:50','2015-08-05 21:00:50',NULL,'2015080521001','2015','CONTRACT201508053'),
	(4,201500000,6,'08',54000.00,'Ancien','2015-08-12 09:39:50','2015-08-12 09:39:50',NULL,'2015081209391','2015','CONTRACT201508120939501'),
	(5,201500004,6,'08',5000000.00,'Ancien','2015-08-12 09:39:51','2015-08-12 09:39:51',NULL,'2015081209391','2015','CONTRACT201508120939511'),
	(6,201500006,6,'08',2500823.00,'Ancien','2015-08-12 09:39:51','2015-08-12 09:39:51',NULL,'2015081209391','2015','CONTRACT201508120939511');

/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;

INSERT INTO `files` (`id`, `filename`, `mime`, `original_filename`, `created_at`, `updated_at`)
VALUES
	(4,'1435902852phpGzGKlT.png','image/png','1435902852phpGzGKlT','2015-07-03 05:54:12','2015-07-03 05:54:12'),
	(5,'1435902882phpsXd8Wh.png','image/png','1435902882phpsXd8Wh','2015-07-03 05:54:42','2015-07-03 05:54:42'),
	(6,'1435902899phpbmTVdy.png','image/png','1435902899phpbmTVdy','2015-07-03 05:54:59','2015-07-03 05:54:59'),
	(7,'1435994220kamaro-lambert201500003-photo.jpg','image/jpeg','1435994220kamaro-lambert201500003-photo','2015-07-04 07:17:01','2015-07-04 07:17:01'),
	(8,'1435994220kamaro-lambert201500003-signature.png','image/png','1435994220kamaro-lambert201500003-signature','2015-07-04 07:17:01','2015-07-04 07:17:01'),
	(9,'1435994259kamaro-lambert201500003-photo.jpg','image/jpeg','1435994259kamaro-lambert201500003-photo','2015-07-04 07:17:39','2015-07-04 07:17:39'),
	(10,'1435994281olivier-gaspard201500004-photo.jpg','image/jpeg','1435994281olivier-gaspard201500004-photo','2015-07-04 07:18:01','2015-07-04 07:18:01'),
	(11,'1435994281olivier-gaspard201500004-signature.jpg','image/jpeg','1435994281olivier-gaspard201500004-signature','2015-07-04 07:18:01','2015-07-04 07:18:01'),
	(12,'1435994295olivier-gaspard201500004-signature.jpg','image/jpeg','1435994295olivier-gaspard201500004-signature','2015-07-04 07:18:15','2015-07-04 07:18:15'),
	(13,'1435994303olivier-gaspard201500004-signature.jpg','image/jpeg','1435994303olivier-gaspard201500004-signature','2015-07-04 07:18:23','2015-07-04 07:18:23'),
	(14,'1436002010admin-of-the-system-photo.jpg','image/jpeg','1436002010admin-of-the-system-photo','2015-07-04 09:26:50','2015-07-04 09:26:50'),
	(15,'1436005735gaspard-bayigane201500004-photo.jpg','image/jpeg','1436005735gaspard-bayigane201500004-photo','2015-07-04 10:28:56','2015-07-04 10:28:56'),
	(16,'1436005735gaspard-bayigane201500004-signature.jpeg','image/jpeg','1436005735gaspard-bayigane201500004-signature','2015-07-04 10:28:56','2015-07-04 10:28:56'),
	(17,'1436006291gaspard-bayigane201500005-photo.jpg','image/jpeg','1436006291gaspard-bayigane201500005-photo','2015-07-04 10:38:11','2015-07-04 10:38:11'),
	(18,'1436006291gaspard-bayigane201500005-signature.jpeg','image/jpeg','1436006291gaspard-bayigane201500005-signature','2015-07-04 10:38:11','2015-07-04 10:38:11'),
	(19,'1436006325olivier-bitege201500004-signature.png','image/png','1436006325olivier-bitege201500004-signature','2015-07-04 10:38:45','2015-07-04 10:38:45'),
	(20,'1436006340kamaro-lambert201500003-signature.png','image/png','1436006340kamaro-lambert201500003-signature','2015-07-04 10:39:00','2015-07-04 10:39:00'),
	(21,'1436020649admin-of-the-system201500000-signature.jpeg','image/jpeg','1436020649admin-of-the-system201500000-signature','2015-07-04 14:37:29','2015-07-04 14:37:29'),
	(22,'1436020701olivier-bitege201500004-photo.jpg','image/jpeg','1436020701olivier-bitege201500004-photo','2015-07-04 14:38:21','2015-07-04 14:38:21'),
	(23,'1436021365kamaro-lambert201500003-photo.png','image/png','1436021365kamaro-lambert201500003-photo','2015-07-04 14:49:25','2015-07-04 14:49:25'),
	(24,'1436021380kamaro-lambert201500003-photo.jpg','image/jpeg','1436021380kamaro-lambert201500003-photo','2015-07-04 14:49:40','2015-07-04 14:49:40'),
	(25,'1438418111nibeza-kevin201500006-photo.jpeg','image/jpeg','1438418111nibeza-kevin201500006-photo','2015-08-01 08:35:11','2015-08-01 08:35:11'),
	(26,'1438418111nibeza-kevin201500006-signature.jpeg','image/jpeg','1438418111nibeza-kevin201500006-signature','2015-08-01 08:35:11','2015-08-01 08:35:11');

/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`)
VALUES
	(1,'Users','{\"users\":1}','2015-07-01 12:33:41','2015-07-01 12:33:41'),
	(2,'Admins','{\"admin\":1,\"users\":1,\"member.list\":1,\"member.view\":1,\"member.edit\":1,\"member.create\":1,\"member.delete\":1}','2015-07-01 12:33:41','2015-08-01 08:23:53'),
	(3,'GERANT','{\"member.edit\":1}','2015-08-01 08:47:07','2015-08-01 08:47:07');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table institutions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `institutions`;

CREATE TABLE `institutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `institutions` WRITE;
/*!40000 ALTER TABLE `institutions` DISABLE KEYS */;

INSERT INTO `institutions` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'UNR','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(2,'IRST','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(3,'MS UNR','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(4,'CHUB','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(5,'CHUK','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(6,'LABOPHAR','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(7,'CEB','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),
	(8,'INMR','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `institutions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table journals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `journals`;

CREATE TABLE `journals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `movement_nature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `journals` WRITE;
/*!40000 ALTER TABLE `journals` DISABLE KEYS */;

INSERT INTO `journals` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `movement_nature`)
VALUES
	(1,'Deposit','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,''),
	(2,'Withdrawal','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,''),
	(3,'Transfer','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,''),
	(4,'Withdrawal','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,'');

/*!40000 ALTER TABLE `journals` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table loans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `loans`;

CREATE TABLE `loans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loan_contract` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adhersion_id` int(11) NOT NULL,
  `movement_nature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `operation_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `letter_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `right_to_loan` decimal(10,2) NOT NULL,
  `wished_amount` decimal(10,2) NOT NULL,
  `loan_to_repay` decimal(10,2) NOT NULL,
  `interests` decimal(10,2) NOT NULL,
  `InteretsPU` decimal(10,2) NOT NULL,
  `amount_received` decimal(10,2) NOT NULL,
  `tranches_number` int(11) NOT NULL,
  `monthly_fees` decimal(10,2) NOT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `security_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cautionneur1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cautionneur2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `average_refund` decimal(10,2) NOT NULL,
  `amount_refounded` decimal(10,2) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `special_loan_contract_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `remaining_tranches` int(11) NOT NULL DEFAULT '0',
  `special_loan_tranches` decimal(8,2) NOT NULL DEFAULT '0.00',
  `special_loan_interests` decimal(8,2) NOT NULL DEFAULT '0.00',
  `special_loan_amount_to_receive` decimal(8,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;

INSERT INTO `loans` (`id`, `transactionid`, `loan_contract`, `adhersion_id`, `movement_nature`, `operation_type`, `letter_date`, `right_to_loan`, `wished_amount`, `loan_to_repay`, `interests`, `InteretsPU`, `amount_received`, `tranches_number`, `monthly_fees`, `cheque_number`, `bank_id`, `security_type`, `cautionneur1`, `cautionneur2`, `average_refund`, `amount_refounded`, `comment`, `special_loan_contract_number`, `remaining_tranches`, `special_loan_tranches`, `special_loan_interests`, `special_loan_amount_to_receive`, `user_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(2,'2015081110271','CONTRACT201508111027591',201500004,'Test movement_nature','ordinary_loan','2015-08-11 00:00:00',3125000.00,3125000.00,1250000.00,3531.66,0.00,1189343.00,1,1246468.34,'234234234','BK','0','0','0',0.00,0.00,'No comment so far','0',17,0.00,0.00,0.00,1,'2015-08-11 10:27:59','2015-08-11 10:27:59',NULL),
	(4,'2015081113571','CONTRACT201508111357521',201500004,'Test movement_nature','ordinary_loan','2015-08-11 00:00:00',3750000.00,3750000.00,1500000.00,4237.99,0.00,1431298.00,1,1495762.01,'91028312','BK','0','0','0',0.00,0.00,'No comment so far','0',16,0.00,0.00,0.00,1,'2015-08-11 13:57:52','2015-08-11 13:57:52',NULL),
	(5,'2015081113591','CONTRACT201508111359581',201500004,'Test movement_nature','ordinary_loan','2015-08-11 00:00:00',56077.50,56077.50,22431.00,63.37,0.00,20096.00,1,22367.63,'2342342','BK','0','0','0',0.00,0.00,'No comment so far','0',34,0.00,0.00,0.00,1,'2015-08-11 13:59:58','2015-08-11 13:59:58',NULL),
	(6,'2015081114321','CONTRACT201508111432111',201500004,'Test movement_nature','ordinary_loan','2015-08-11 00:00:00',56077.50,56077.50,22431.00,63.37,0.00,20096.00,1,22367.63,'022898923','BK','0','0','0',0.00,0.00,'No comment so far','0',34,0.00,0.00,0.00,1,'2015-08-11 14:32:11','2015-08-11 14:32:11',NULL),
	(7,'2015081114411','CONTRACT201508111441091',201500004,'Test movement_nature','ordinary_loan','2015-08-11 00:00:00',56078.00,56078.00,22431.00,2335.00,0.00,20096.00,34,660.00,'223423423','BK','0','0','0',0.00,0.00,'No comment so far','0',34,0.00,0.00,0.00,1,'2015-08-11 14:41:09','2015-08-11 14:41:09',NULL),
	(9,'2015081209491','CONTRACT201508120949041',201500006,'Test movement_nature','ordinary_loan','2015-08-12 00:00:00',3126028.00,3126028.00,1250411.00,64063.00,0.00,1186348.00,18,69467.00,'82892893','BK','0','0','0',0.00,0.00,'No comment so far','0',18,0.00,0.00,0.00,1,'2015-08-12 09:49:04','2015-08-12 09:49:04',NULL);

/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ltm_translations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ltm_translations`;

CREATE TABLE `ltm_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `ltm_translations` WRITE;
/*!40000 ALTER TABLE `ltm_translations` DISABLE KEYS */;

INSERT INTO `ltm_translations` (`id`, `status`, `locale`, `group`, `key`, `value`, `created_at`, `updated_at`)
VALUES
	(1,0,'en','contribution','institutions','Institutions','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(2,1,'en','contribution','month','ukwezi','2015-08-01 12:47:55','2015-08-01 12:50:52'),
	(3,0,'en','contribution','date','Date','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(4,0,'en','contribution','totalAmount','Total amount','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(5,0,'en','contribution','debit_account','Debit account','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(6,0,'en','contribution','credit_account','Credit account','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(7,0,'en','contribution','complete_transaction','Complete transaction','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(9,0,'en','general','sorry_there_is_no_item_here','Sorry, there is no item here','2015-08-01 12:47:55','2015-08-01 12:53:26'),
	(10,0,'en','member','adhersion_number','Adhersion #','2015-08-01 12:47:55','2015-08-01 13:04:25'),
	(11,0,'en','member','names','Names','2015-08-01 12:47:55','2015-08-01 13:04:25'),
	(12,0,'en','member','institution','Institution','2015-08-01 12:47:55','2015-08-01 13:04:25'),
	(13,0,'en','member','service','Service','2015-08-01 12:47:55','2015-08-01 13:04:25'),
	(14,0,'en','member','nid','National ID','2015-08-01 12:47:55','2015-08-01 13:04:25'),
	(15,0,'en','member','district','District','2015-08-01 12:47:55','2015-08-01 13:04:25'),
	(16,0,'en','member','adhersion_date','Adhersion date','2015-08-01 12:47:55','2015-08-01 13:04:25'),
	(17,0,'en','member','monthly_fee','Monthly fees','2015-08-01 12:47:55','2015-08-01 13:04:25'),
	(18,0,'en','navigations','dashboard','Dashboard','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(19,0,'en','navigations','members','Members','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(20,0,'en','navigations','contributions_and_savings','Contributions & savings','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(21,0,'en','navigations','loans_and_repayments','Loans & repayments','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(22,0,'en','navigations','accounting','Accounting','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(23,0,'en','navigations','reports','Reports','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(24,0,'en','navigations','settings','Settings','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(25,0,'en','navigations','institutions','institutions','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(26,0,'en','navigations','accounting_plan','Accounting plan','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(27,0,'en','navigations','closing_exercise','Closing Exercise','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(28,0,'en','navigations','contributions','Contributions','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(29,0,'en','pagination','previous','&laquo; Previous','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(30,0,'en','pagination','next','Next &raquo;','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(31,0,'en','passwords','password','Passwords must be at least six characters and match the confirmation.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(32,0,'en','passwords','user','We can\'t find a user with that e-mail address.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(33,0,'en','passwords','token','This password reset token is invalid.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(34,0,'en','passwords','sent','We have e-mailed your password reset link!','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(35,0,'en','passwords','reset','Your password has been reset!','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(36,0,'en','validation','accepted','The :attribute must be accepted.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(37,0,'en','validation','active_url','The :attribute is not a valid URL.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(38,0,'en','validation','after','The :attribute must be a date after :date.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(39,0,'en','validation','alpha','The :attribute may only contain letters.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(40,0,'en','validation','alpha_dash','The :attribute may only contain letters, numbers, and dashes.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(41,0,'en','validation','alpha_num','The :attribute may only contain letters and numbers.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(42,0,'en','validation','array','The :attribute must be an array.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(43,0,'en','validation','before','The :attribute must be a date before :date.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(44,0,'en','validation','between.numeric','The :attribute must be between :min and :max.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(45,0,'en','validation','between.file','The :attribute must be between :min and :max kilobytes.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(46,0,'en','validation','between.string','The :attribute must be between :min and :max characters.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(47,0,'en','validation','between.array','The :attribute must have between :min and :max items.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(48,0,'en','validation','boolean','The :attribute field must be true or false.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(49,0,'en','validation','confirmed','The :attribute confirmation does not match.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(50,0,'en','validation','date','The :attribute is not a valid date.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(51,0,'en','validation','date_format','The :attribute does not match the format :format.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(52,0,'en','validation','different','The :attribute and :other must be different.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(53,0,'en','validation','digits','The :attribute must be :digits digits.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(54,0,'en','validation','digits_between','The :attribute must be between :min and :max digits.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(55,0,'en','validation','email','The :attribute must be a valid email address.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(56,0,'en','validation','filled','The :attribute field is required.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(57,0,'en','validation','exists','The selected :attribute is invalid.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(58,0,'en','validation','image','The :attribute must be an image.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(59,0,'en','validation','in','The selected :attribute is invalid.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(60,0,'en','validation','integer','The :attribute must be an integer.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(61,0,'en','validation','ip','The :attribute must be a valid IP address.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(62,0,'en','validation','max.numeric','The :attribute may not be greater than :max.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(63,0,'en','validation','max.file','The :attribute may not be greater than :max kilobytes.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(64,0,'en','validation','max.string','The :attribute may not be greater than :max characters.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(65,0,'en','validation','max.array','The :attribute may not have more than :max items.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(66,0,'en','validation','mimes','The :attribute must be a file of type: :values.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(67,0,'en','validation','min.numeric','The :attribute must be at least :min.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(68,0,'en','validation','min.file','The :attribute must be at least :min kilobytes.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(69,0,'en','validation','min.string','The :attribute must be at least :min characters.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(70,0,'en','validation','min.array','The :attribute must have at least :min items.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(71,0,'en','validation','not_in','The selected :attribute is invalid.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(72,0,'en','validation','numeric','The :attribute must be a number.','2015-08-01 12:47:55','2015-08-01 12:54:23'),
	(73,0,'en','validation','regex','The :attribute format is invalid.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(74,0,'en','validation','required','The :attribute field is required.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(75,0,'en','validation','required_if','The :attribute field is required when :other is :value.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(76,0,'en','validation','required_with','The :attribute field is required when :values is present.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(77,0,'en','validation','required_with_all','The :attribute field is required when :values is present.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(78,0,'en','validation','required_without','The :attribute field is required when :values is not present.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(79,0,'en','validation','required_without_all','The :attribute field is required when none of :values are present.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(80,0,'en','validation','same','The :attribute and :other must match.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(81,0,'en','validation','size.numeric','The :attribute must be :size.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(82,0,'en','validation','size.file','The :attribute must be :size kilobytes.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(83,0,'en','validation','size.string','The :attribute must be :size characters.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(84,0,'en','validation','size.array','The :attribute must contain :size items.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(85,0,'en','validation','timezone','The :attribute must be a valid zone.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(86,0,'en','validation','unique','The :attribute has already been taken.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(87,0,'en','validation','url','The :attribute format is invalid.','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(88,0,'en','validation','custom.attribute-name.rule-name','custom-message','2015-08-01 12:47:56','2015-08-01 12:54:23'),
	(89,0,'en','loan','adhersion_number_you_are_looking_for_cannot_be_found','Adhersion number you are looking for cannot be found','2015-08-01 12:51:33','2015-08-01 12:58:43'),
	(90,0,'en','loan','cautionneur_should_not_be_the_same_as_the_member_requesting_loan',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(91,0,'en','loan','cautionneur_has_been_added_successfully',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(92,0,'en','loan','cautionneur_removed_successfully',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(93,0,'en','contribution','contribution_well_saved',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(94,0,'en','contribution','something_went_wrong_while_saving_contribution',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(95,0,'en','institutions','select_institution',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(96,0,'en','contribution','contribution_cancelled',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(97,0,'en','loan','loan_completed',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(98,0,'en','loan','loan_cancelled',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(99,0,'en','member','created',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(100,0,'en','member','exists',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(101,0,'en','member','updated',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(102,0,'en','loan','credit_account',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(103,0,'en','accounting','debit_account',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(104,0,'en','accounting','amount',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(105,0,'en','loan','debit_account',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(106,0,'en','accounting','accounting',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(107,0,'en','contribution','cancel_transaction','Cancel transaction','2015-08-01 12:51:33','2015-08-01 12:57:11'),
	(108,0,'en','contribution','add_new_contribution',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(109,0,'en','contribution','add_new',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(110,0,'en','member','details',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(111,0,'en','member','edit',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(112,0,'en','loan','cautions',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(113,0,'en','loan','movement_nature',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(114,0,'en','loan','saving',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(115,0,'en','loan','saving_caution',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(116,0,'en','loan','cautionneur_number1',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(117,0,'en','loan','cautionneur_number2',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(118,0,'en','loan','amount_bonded','Amount bonded','2015-08-01 12:51:33','2015-08-01 12:58:43'),
	(119,0,'en','loan','client_information',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(120,0,'en','member','contributions','Contributions','2015-08-01 12:51:33','2015-08-01 13:04:25'),
	(121,0,'en','member','right_to_loan','Right to loan','2015-08-01 12:51:33','2015-08-01 13:04:25'),
	(122,0,'en','member','balance_of_loan',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(123,0,'en','member','letter_date',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(124,0,'en','member','date_of_today',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(125,0,'en','loans','give_loan',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(126,0,'en','repayments','register_repayment',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(127,0,'en','loan','loan',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(128,0,'en','loan','loan_contract_number',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(129,0,'en','loan','number_of_installments',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(130,0,'en','loan','wished_amount',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(131,0,'en','loan','operation_type',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(132,0,'en','loan','loan_to_repay',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(133,0,'en','loan','monthly_installments',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(134,0,'en','loan','interests',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(135,0,'en','loan','interest_on_urgently_loan ',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(136,0,'en','loan','net_to_receive',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(137,0,'en','loan','number_of_cheque',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(138,0,'en','loan','bank',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(139,0,'en','loans','saving',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(140,0,'en','loans','cancel',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(141,0,'en','member','add_new_member',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(142,0,'en','member','add_new',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(143,0,'en','general','upload_photo','Upload photo','2015-08-01 12:51:33','2015-08-01 12:53:26'),
	(144,0,'en','general','photo_selected','Photo selected','2015-08-01 12:51:33','2015-08-01 12:53:26'),
	(145,0,'en','member','province',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(146,0,'en','member','termination_date',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(147,0,'en','general','upload_signature','Upload signature','2015-08-01 12:51:33','2015-08-01 12:53:26'),
	(148,0,'en','general','signature_selected','Signature selected','2015-08-01 12:51:33','2015-08-01 12:53:26'),
	(149,0,'en','member','date_of_birth',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(150,0,'en','member','sex',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(151,0,'en','member','nationality',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(152,0,'en','member','email',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(153,0,'en','member','telephone',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(154,0,'en','member','member_attornes',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(155,0,'en','member','add_new_attorney',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(156,0,'en','general','are_you_sure_you_want_to_delete_this_item','Are you sure you want to delete this item?','2015-08-01 12:51:33','2015-08-01 12:53:26'),
	(157,0,'en','member','add',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(158,0,'en','footer','version',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(159,0,'en','footer','copy_right',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(160,0,'en','footer','ceb',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(161,0,'en','footer','all_right_reserved',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(162,0,'en','member','profile',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(163,0,'en','member','logout',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(164,0,'en','navigations','main_navigation',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(165,0,'en','navigations','report_contrats',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(166,0,'en','navigations','report_files',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(167,0,'en','navigations','help',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(168,0,'en','passwords','throttle',NULL,'2015-08-01 12:51:33','2015-08-01 12:51:33'),
	(169,1,'fr','contribution','institutions','Institutions','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(170,1,'fr','contribution','month','Month','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(171,1,'fr','contribution','date','Date','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(172,1,'fr','contribution','totalAmount','Total amount','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(173,1,'fr','contribution','debit_account','Debit account','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(174,1,'fr','contribution','credit_account','Credit account','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(175,1,'fr','contribution','complete_transaction','Complete transaction','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(176,1,'fr','contribution','cancel_transaction','Cancel transaction','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(177,1,'fr','general','sorry_there_is_no_item_here','Sorry, there is no item here','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(178,1,'fr','general','upload_photo','Upload photo','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(179,1,'fr','general','photo_selected','Photo selected','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(180,1,'fr','general','upload_signature','Upload signature','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(181,1,'fr','general','signature_selected','Signature selected','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(182,1,'fr','general','are_you_sure_you_want_to_delete_this_item','Are you sure you want to delete this item?','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(183,0,'fr','member','adhersion_number','Adhersion #','2015-08-01 12:57:11','2015-08-01 13:04:25'),
	(184,0,'fr','member','names','Names','2015-08-01 12:57:11','2015-08-01 13:04:25'),
	(185,0,'fr','member','institution','Institution','2015-08-01 12:57:11','2015-08-01 13:04:25'),
	(186,0,'fr','member','service','Service','2015-08-01 12:57:11','2015-08-01 13:04:25'),
	(187,0,'fr','member','nid','National ID','2015-08-01 12:57:11','2015-08-01 13:04:25'),
	(188,0,'fr','member','district','District','2015-08-01 12:57:11','2015-08-01 13:04:25'),
	(189,0,'fr','member','adhersion_date','Adhersion date','2015-08-01 12:57:11','2015-08-01 13:04:25'),
	(190,0,'fr','member','monthly_fee','Monthly fees','2015-08-01 12:57:11','2015-08-01 13:04:25'),
	(191,1,'fr','navigations','dashboard','Dashboard','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(192,1,'fr','navigations','members','Members','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(193,1,'fr','navigations','contributions_and_savings','Contributions & savings','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(194,1,'fr','navigations','loans_and_repayments','Loans & repayments','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(195,1,'fr','navigations','accounting','Accounting','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(196,1,'fr','navigations','reports','Reports','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(197,1,'fr','navigations','settings','Settings','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(198,1,'fr','navigations','institutions','institutions','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(199,1,'fr','navigations','accounting_plan','Accounting plan','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(200,1,'fr','navigations','closing_exercise','Closing Exercise','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(201,1,'fr','navigations','contributions','Contributions','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(202,1,'fr','pagination','previous','&laquo; Previous','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(203,1,'fr','pagination','next','Next &raquo;','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(204,1,'fr','passwords','password','Passwords must be at least six characters and match the confirmation.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(205,1,'fr','passwords','user','We can\'t find a user with that e-mail address.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(206,1,'fr','passwords','token','This password reset token is invalid.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(207,1,'fr','passwords','sent','We have e-mailed your password reset link!','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(208,1,'fr','passwords','reset','Your password has been reset!','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(209,1,'fr','validation','accepted','The :attribute must be accepted.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(210,1,'fr','validation','active_url','The :attribute is not a valid URL.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(211,1,'fr','validation','after','The :attribute must be a date after :date.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(212,1,'fr','validation','alpha','The :attribute may only contain letters.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(213,1,'fr','validation','alpha_dash','The :attribute may only contain letters, numbers, and dashes.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(214,1,'fr','validation','alpha_num','The :attribute may only contain letters and numbers.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(215,1,'fr','validation','array','The :attribute must be an array.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(216,1,'fr','validation','before','The :attribute must be a date before :date.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(217,1,'fr','validation','between.numeric','The :attribute must be between :min and :max.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(218,1,'fr','validation','between.file','The :attribute must be between :min and :max kilobytes.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(219,1,'fr','validation','between.string','The :attribute must be between :min and :max characters.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(220,1,'fr','validation','between.array','The :attribute must have between :min and :max items.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(221,1,'fr','validation','boolean','The :attribute field must be true or false.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(222,1,'fr','validation','confirmed','The :attribute confirmation does not match.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(223,1,'fr','validation','date','The :attribute is not a valid date.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(224,1,'fr','validation','date_format','The :attribute does not match the format :format.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(225,1,'fr','validation','different','The :attribute and :other must be different.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(226,1,'fr','validation','digits','The :attribute must be :digits digits.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(227,1,'fr','validation','digits_between','The :attribute must be between :min and :max digits.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(228,1,'fr','validation','email','The :attribute must be a valid email address.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(229,1,'fr','validation','filled','The :attribute field is required.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(230,1,'fr','validation','exists','The selected :attribute is invalid.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(231,1,'fr','validation','image','The :attribute must be an image.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(232,1,'fr','validation','in','The selected :attribute is invalid.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(233,1,'fr','validation','integer','The :attribute must be an integer.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(234,1,'fr','validation','ip','The :attribute must be a valid IP address.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(235,1,'fr','validation','max.numeric','The :attribute may not be greater than :max.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(236,1,'fr','validation','max.file','The :attribute may not be greater than :max kilobytes.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(237,1,'fr','validation','max.string','The :attribute may not be greater than :max characters.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(238,1,'fr','validation','max.array','The :attribute may not have more than :max items.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(239,1,'fr','validation','mimes','The :attribute must be a file of type: :values.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(240,1,'fr','validation','min.numeric','The :attribute must be at least :min.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(241,1,'fr','validation','min.file','The :attribute must be at least :min kilobytes.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(242,1,'fr','validation','min.string','The :attribute must be at least :min characters.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(243,1,'fr','validation','min.array','The :attribute must have at least :min items.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(244,1,'fr','validation','not_in','The selected :attribute is invalid.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(245,1,'fr','validation','numeric','The :attribute must be a number.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(246,1,'fr','validation','regex','The :attribute format is invalid.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(247,1,'fr','validation','required','The :attribute field is required.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(248,1,'fr','validation','required_if','The :attribute field is required when :other is :value.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(249,1,'fr','validation','required_with','The :attribute field is required when :values is present.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(250,1,'fr','validation','required_with_all','The :attribute field is required when :values is present.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(251,1,'fr','validation','required_without','The :attribute field is required when :values is not present.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(252,1,'fr','validation','required_without_all','The :attribute field is required when none of :values are present.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(253,1,'fr','validation','same','The :attribute and :other must match.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(254,1,'fr','validation','size.numeric','The :attribute must be :size.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(255,1,'fr','validation','size.file','The :attribute must be :size kilobytes.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(256,1,'fr','validation','size.string','The :attribute must be :size characters.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(257,1,'fr','validation','size.array','The :attribute must contain :size items.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(258,1,'fr','validation','timezone','The :attribute must be a valid zone.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(259,1,'fr','validation','unique','The :attribute has already been taken.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(260,1,'fr','validation','url','The :attribute format is invalid.','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(261,1,'fr','validation','custom.attribute-name.rule-name','custom-message','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(262,1,'kin','contribution','institutions','Institutions','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(263,1,'kin','contribution','month','Month','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(264,1,'kin','contribution','date','Date','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(265,1,'kin','contribution','totalAmount','Total amount','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(266,1,'kin','contribution','debit_account','Debit account','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(267,1,'kin','contribution','credit_account','Credit account','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(268,1,'kin','contribution','complete_transaction','Complete transaction','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(269,1,'kin','contribution','cancel_transaction','Cancel transaction','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(270,1,'kin','general','sorry_there_is_no_item_here','Sorry, there is no item here','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(271,1,'kin','general','upload_photo','Upload photo','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(272,1,'kin','general','photo_selected','Photo selected','2015-08-01 12:57:11','2015-08-01 12:57:11'),
	(273,1,'kin','general','upload_signature','Upload signature','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(274,1,'kin','general','signature_selected','Signature selected','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(275,1,'kin','general','are_you_sure_you_want_to_delete_this_item','Are you sure you want to delete this item?','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(276,0,'kin','member','adhersion_number','Adhersion #','2015-08-01 12:57:12','2015-08-01 13:04:25'),
	(277,0,'kin','member','names','Names','2015-08-01 12:57:12','2015-08-01 13:04:25'),
	(278,0,'kin','member','institution','Institution','2015-08-01 12:57:12','2015-08-01 13:04:25'),
	(279,0,'kin','member','service','Service','2015-08-01 12:57:12','2015-08-01 13:04:25'),
	(280,0,'kin','member','nid','National ID','2015-08-01 12:57:12','2015-08-01 13:04:25'),
	(281,0,'kin','member','district','District','2015-08-01 12:57:12','2015-08-01 13:04:25'),
	(282,0,'kin','member','adhersion_date','Adhersion date','2015-08-01 12:57:12','2015-08-01 13:04:25'),
	(283,0,'kin','member','monthly_fee','Monthly fees','2015-08-01 12:57:12','2015-08-01 13:04:25'),
	(284,1,'kin','navigations','dashboard','Dashboard','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(285,1,'kin','navigations','members','Members','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(286,1,'kin','navigations','contributions_and_savings','Contributions & savings','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(287,1,'kin','navigations','loans_and_repayments','Loans & repayments','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(288,1,'kin','navigations','accounting','Accounting','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(289,1,'kin','navigations','reports','Reports','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(290,1,'kin','navigations','settings','Settings','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(291,1,'kin','navigations','institutions','institutions','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(292,1,'kin','navigations','accounting_plan','Accounting plan','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(293,1,'kin','navigations','closing_exercise','Closing Exercise','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(294,1,'kin','navigations','contributions','Contributions','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(295,1,'kin','pagination','previous','&laquo; Previous','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(296,1,'kin','pagination','next','Next &raquo;','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(297,1,'kin','passwords','password','Passwords must be at least six characters and match the confirmation.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(298,1,'kin','passwords','user','We can\'t find a user with that e-mail address.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(299,1,'kin','passwords','token','This password reset token is invalid.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(300,1,'kin','passwords','sent','We have e-mailed your password reset link!','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(301,1,'kin','passwords','reset','Your password has been reset!','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(302,1,'kin','validation','accepted','The :attribute must be accepted.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(303,1,'kin','validation','active_url','The :attribute is not a valid URL.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(304,1,'kin','validation','after','The :attribute must be a date after :date.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(305,1,'kin','validation','alpha','The :attribute may only contain letters.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(306,1,'kin','validation','alpha_dash','The :attribute may only contain letters, numbers, and dashes.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(307,1,'kin','validation','alpha_num','The :attribute may only contain letters and numbers.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(308,1,'kin','validation','array','The :attribute must be an array.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(309,1,'kin','validation','before','The :attribute must be a date before :date.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(310,1,'kin','validation','between.numeric','The :attribute must be between :min and :max.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(311,1,'kin','validation','between.file','The :attribute must be between :min and :max kilobytes.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(312,1,'kin','validation','between.string','The :attribute must be between :min and :max characters.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(313,1,'kin','validation','between.array','The :attribute must have between :min and :max items.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(314,1,'kin','validation','boolean','The :attribute field must be true or false.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(315,1,'kin','validation','confirmed','The :attribute confirmation does not match.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(316,1,'kin','validation','date','The :attribute is not a valid date.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(317,1,'kin','validation','date_format','The :attribute does not match the format :format.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(318,1,'kin','validation','different','The :attribute and :other must be different.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(319,1,'kin','validation','digits','The :attribute must be :digits digits.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(320,1,'kin','validation','digits_between','The :attribute must be between :min and :max digits.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(321,1,'kin','validation','email','The :attribute must be a valid email address.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(322,1,'kin','validation','filled','The :attribute field is required.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(323,1,'kin','validation','exists','The selected :attribute is invalid.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(324,1,'kin','validation','image','The :attribute must be an image.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(325,1,'kin','validation','in','The selected :attribute is invalid.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(326,1,'kin','validation','integer','The :attribute must be an integer.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(327,1,'kin','validation','ip','The :attribute must be a valid IP address.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(328,1,'kin','validation','max.numeric','The :attribute may not be greater than :max.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(329,1,'kin','validation','max.file','The :attribute may not be greater than :max kilobytes.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(330,1,'kin','validation','max.string','The :attribute may not be greater than :max characters.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(331,1,'kin','validation','max.array','The :attribute may not have more than :max items.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(332,1,'kin','validation','mimes','The :attribute must be a file of type: :values.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(333,1,'kin','validation','min.numeric','The :attribute must be at least :min.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(334,1,'kin','validation','min.file','The :attribute must be at least :min kilobytes.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(335,1,'kin','validation','min.string','The :attribute must be at least :min characters.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(336,1,'kin','validation','min.array','The :attribute must have at least :min items.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(337,1,'kin','validation','not_in','The selected :attribute is invalid.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(338,1,'kin','validation','numeric','The :attribute must be a number.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(339,1,'kin','validation','regex','The :attribute format is invalid.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(340,1,'kin','validation','required','The :attribute field is required.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(341,1,'kin','validation','required_if','The :attribute field is required when :other is :value.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(342,1,'kin','validation','required_with','The :attribute field is required when :values is present.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(343,1,'kin','validation','required_with_all','The :attribute field is required when :values is present.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(344,1,'kin','validation','required_without','The :attribute field is required when :values is not present.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(345,1,'kin','validation','required_without_all','The :attribute field is required when none of :values are present.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(346,1,'kin','validation','same','The :attribute and :other must match.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(347,1,'kin','validation','size.numeric','The :attribute must be :size.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(348,1,'kin','validation','size.file','The :attribute must be :size kilobytes.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(349,1,'kin','validation','size.string','The :attribute must be :size characters.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(350,1,'kin','validation','size.array','The :attribute must contain :size items.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(351,1,'kin','validation','timezone','The :attribute must be a valid zone.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(352,1,'kin','validation','unique','The :attribute has already been taken.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(353,1,'kin','validation','url','The :attribute format is invalid.','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(354,1,'kin','validation','custom.attribute-name.rule-name','custom-message','2015-08-01 12:57:12','2015-08-01 12:57:12'),
	(355,0,'fr','loan','amount_bonded','Montant cautionnee','2015-08-01 12:58:22','2015-08-01 12:58:43'),
	(356,0,'fr','member','right_to_loan','Droit au pret','2015-08-01 13:02:45','2015-08-01 13:04:25'),
	(357,0,'fr','member','contributions','Contributions','2015-08-01 13:04:11','2015-08-01 13:04:25');

/*!40000 ALTER TABLE `ltm_translations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table member_monthly_fees_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member_monthly_fees_logs`;

CREATE TABLE `member_monthly_fees_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_monthly_fee` decimal(10,2) NOT NULL,
  `new_monthly_fee` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table membershipfees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `membershipfees`;

CREATE TABLE `membershipfees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2012_12_06_225921_migration_cartalyst_sentry_install_users',1),
	('2012_12_06_225929_migration_cartalyst_sentry_install_groups',1),
	('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot',1),
	('2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1),
	('2015_01_14_053439_migration_sentinel_add_username',1),
	('2015_07_01_094525_AddMemberFieldsToUser',1),
	('2015_07_02_211153_CreateAttorneyTable',2),
	('2015_03_28_000000_create_attacher_images_table',3),
	('2015_07_03_051346_create_file_table',4),
	('2015_07_04_120058_create_membershipfees_table',5),
	('2015_07_10_084519_create_institutions_table',5),
	('2015_07_10_084833_create_accounts_table',5),
	('2015_07_10_085237_create_Contributions_table',5),
	('2015_07_18_084718_AddInstitutionIdToUserTable',6),
	('2015_07_21_184904_create_journals_table',7),
	('2015_07_21_185011_create_postings_table',7),
	('2015_07_21_201225_RenameDocumentId',7),
	('2015_07_29_131608_CreateLoansTable',8),
	('2015_08_01_101717_createMonthlyFeeTable',9),
	('2015_08_01_101859_AddYearToContributionTable',9),
	('2015_08_01_102759_create_activity_log_table',10),
	('2014_04_02_193005_create_translations_table',11),
	('2015_08_04_055114_AddContractNumberInContribution',12),
	('2015_08_04_055205_AddMovementNatureToJournalsTable',12),
	('2015_08_04_055234_AddTransactionTypeAndPeriodInPostings',12),
	('2015_08_10_105920_create_refunds_table',13);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table postings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `postings`;

CREATE TABLE `postings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `asset_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_period` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `transaction_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `postings` WRITE;
/*!40000 ALTER TABLE `postings` DISABLE KEYS */;

INSERT INTO `postings` (`id`, `transactionid`, `account_id`, `journal_id`, `asset_type`, `amount`, `user_id`, `account_period`, `created_at`, `updated_at`, `deleted_at`, `transaction_type`)
VALUES
	(1,'2015080521001',13,1,NULL,7554823.00,1,'2015','2015-08-05 21:00:37','2015-08-05 21:00:37',NULL,'Debit'),
	(2,'2015080521001',26,1,NULL,7554823.00,1,'2015','2015-08-05 21:00:37','2015-08-05 21:00:37',NULL,'Credit'),
	(3,'2015080521001',13,1,NULL,7554823.00,1,'2015','2015-08-05 21:00:50','2015-08-05 21:00:50',NULL,'Debit'),
	(4,'2015080521001',26,1,NULL,7554823.00,1,'2015','2015-08-05 21:00:50','2015-08-05 21:00:50',NULL,'Credit'),
	(48,'2015081110271',5,1,NULL,1250000.00,1,'2015','2015-08-11 10:27:59','2015-08-11 10:27:59',NULL,'Debit'),
	(49,'2015081110271',3,1,NULL,1250000.00,1,'2015','2015-08-11 10:27:59','2015-08-11 10:27:59',NULL,'Credit'),
	(50,'2015081113571',6,1,NULL,10000.00,1,'2015','2015-08-11 13:57:52','2015-08-11 13:57:52',NULL,'Debit'),
	(51,'2015081113571',1,1,NULL,10000.00,1,'2015','2015-08-11 13:57:52','2015-08-11 13:57:52',NULL,'Credit'),
	(52,'2015081113591',1,1,NULL,22431.00,1,'2015','2015-08-11 13:59:58','2015-08-11 13:59:58',NULL,'Debit'),
	(53,'2015081113591',5,1,NULL,22431.00,1,'2015','2015-08-11 13:59:58','2015-08-11 13:59:58',NULL,'Credit'),
	(70,'2015081114321',1,1,NULL,90000.00,1,'2015','2015-08-11 14:32:12','2015-08-11 14:32:12',NULL,'Debit'),
	(71,'2015081114321',6,1,NULL,90000.00,1,'2015','2015-08-11 14:32:12','2015-08-11 14:32:12',NULL,'Credit'),
	(72,'2015081114411',5,1,NULL,6000.00,1,'2015','2015-08-11 14:41:09','2015-08-11 14:41:09',NULL,'Debit'),
	(73,'2015081114411',1,1,NULL,6000.00,1,'2015','2015-08-11 14:41:09','2015-08-11 14:41:09',NULL,'Credit'),
	(74,'2015081209391',13,1,NULL,7554823.00,1,'2015','2015-08-12 09:39:51','2015-08-12 09:39:51',NULL,'Debit'),
	(75,'2015081209391',26,1,NULL,7554823.00,1,'2015','2015-08-12 09:39:51','2015-08-12 09:39:51',NULL,'Credit'),
	(76,'2015081209491',1,1,NULL,1250411.00,1,'2015','2015-08-12 09:49:04','2015-08-12 09:49:04',NULL,'Debit'),
	(77,'2015081209491',3,1,NULL,1250411.00,1,'2015','2015-08-12 09:49:04','2015-08-12 09:49:04',NULL,'Credit'),
	(82,'2015081210571',9,1,NULL,70127.00,1,'2015','2015-08-12 10:57:52','2015-08-12 10:57:52',NULL,'Debit'),
	(83,'2015081210571',2,1,NULL,70127.00,1,'2015','2015-08-12 10:57:52','2015-08-12 10:57:52',NULL,'Credit'),
	(84,'2015081211001',9,1,NULL,70127.00,1,'2015','2015-08-12 11:00:13','2015-08-12 11:00:13',NULL,'Debit'),
	(85,'2015081211001',2,1,NULL,70127.00,1,'2015','2015-08-12 11:00:13','2015-08-12 11:00:13',NULL,'Credit');

/*!40000 ALTER TABLE `postings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table refunds
# ------------------------------------------------------------

DROP TABLE IF EXISTS `refunds`;

CREATE TABLE `refunds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adhersion_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contract_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(16,2) NOT NULL,
  `tranche_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `refunds` WRITE;
/*!40000 ALTER TABLE `refunds` DISABLE KEYS */;

INSERT INTO `refunds` (`id`, `adhersion_id`, `contract_number`, `month`, `amount`, `tranche_number`, `transaction_id`, `member_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(7,'201500004','CONTRACT201508111441091','201508',660.00,NULL,'2015081210571',17,1,'2015-08-12 10:57:52','2015-08-12 10:57:52',NULL),
	(8,'201500006','CONTRACT201508120949041','201508',69467.00,NULL,'2015081210571',21,1,'2015-08-12 10:57:52','2015-08-12 10:57:52',NULL),
	(9,'201500004','CONTRACT201508111441091','201508',660.00,NULL,'2015081211001',17,1,'2015-08-12 11:00:13','2015-08-12 11:00:13',NULL),
	(10,'201500006','CONTRACT201508120949041','201508',69467.00,NULL,'2015081211001',21,1,'2015-08-12 11:00:13','2015-08-12 11:00:13',NULL);

/*!40000 ALTER TABLE `refunds` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table throttle
# ------------------------------------------------------------

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`)
VALUES
	(1,1,NULL,0,0,0,NULL,NULL,NULL),
	(2,2,NULL,0,0,0,NULL,NULL,NULL),
	(3,15,NULL,0,0,0,NULL,NULL,NULL),
	(4,16,NULL,0,0,0,NULL,NULL,NULL),
	(5,17,NULL,0,0,0,NULL,NULL,NULL),
	(6,18,NULL,0,0,0,NULL,NULL,NULL),
	(7,20,NULL,0,0,0,NULL,NULL,NULL),
	(8,21,NULL,0,0,0,NULL,NULL,NULL);

/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adhersion_id` int(11) DEFAULT NULL,
  `savings_contract_id` int(11) DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_nid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `termination_date` timestamp NULL DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `monthly_fee` decimal(10,2) DEFAULT NULL,
  `attorney` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attorney_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attorney_signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `institution_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_adhersion_id_unique` (`adhersion_id`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `username`, `adhersion_id`, `savings_contract_id`, `date_of_birth`, `district`, `province`, `sex`, `member_nid`, `telephone`, `termination_date`, `nationality`, `service`, `monthly_fee`, `attorney`, `photo`, `signature`, `attorney_image`, `attorney_signature`, `status`, `institution_id`)
VALUES
	(1,'admin@admin.com','$2y$10$MhGKgwA6wGzllmq4C9u9W.aM9ULdSOaT66lqCHRzc2bA62fDoMfD2',NULL,1,NULL,NULL,'2015-08-05 20:38:14','$2y$10$NerXk15iljbM7vaaz51.aOSnPjW80/UfxtyRNpfoLW92xATRurfVq',NULL,'Admin','of the System','2015-07-01 12:33:42','2015-08-05 20:38:14','admin',201500000,NULL,'1970-01-01','Huye','Butare','Male','201500000',NULL,NULL,'Rwandan','System administrator',54000.00,NULL,'1436002010admin-of-the-system-photo.jpg','1436020649admin-of-the-system201500000-signature.jpeg',NULL,NULL,NULL,6),
	(17,'olivier@gmail.com','Test1234',NULL,0,NULL,NULL,NULL,NULL,NULL,'Olivier','Bitege','2015-01-01 14:34:16','2015-07-20 20:38:17',NULL,201500004,NULL,'2015-07-14','Kanombe','Kigarama','Male','1123812983192312','0722123028',NULL,'Rwandan','Billing officer',5000000.00,NULL,'1436020701olivier-bitege201500004-photo.jpg','1436006325olivier-bitege201500004-signature.png',NULL,NULL,NULL,6),
	(18,'kamaroly@gmail.com','Test1234',NULL,0,NULL,NULL,NULL,NULL,NULL,'kamaro','lambert','2015-01-01 14:39:41','2015-07-18 08:50:51',NULL,201500003,NULL,'1990-01-01','Kicukiro','Kigali','Male','1198980007884211','+250722123127',NULL,'Rwandan','IT',1000000.00,NULL,'1436021380kamaro-lambert201500003-photo.jpg','1436006340kamaro-lambert201500003-signature.png',NULL,NULL,NULL,4),
	(20,'gasapard.bayigane@gmail.com','Test1234',NULL,0,NULL,NULL,NULL,NULL,NULL,'Gaspard','bayigane','2015-01-04 10:38:11','2015-07-21 21:46:12',NULL,201500005,NULL,'1980-01-01','Gasabo','Kigali','Male','1198080007884211','0722123120',NULL,'Rwanda','New product Manager',5000000.00,NULL,'1436006291gaspard-bayigane201500005-photo.jpg','1436006291gaspard-bayigane201500005-signature.jpeg',NULL,NULL,NULL,1),
	(21,'nibeza@gmail.com','Test1234',NULL,0,NULL,NULL,NULL,NULL,NULL,'Nibeza','NibezaKezin','2015-01-01 08:35:11','2015-08-01 10:34:40',NULL,201500006,NULL,'2015-08-12','Gasabo','KIGALI','Male','1198980007884211','250722127123','2015-08-20 00:00:00','Rwanda','TEACHER',2500823.00,NULL,'1438418111nibeza-kevin201500006-photo.jpeg','1438418111nibeza-kevin201500006-signature.jpeg',NULL,NULL,NULL,6);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`user_id`, `group_id`)
VALUES
	(1,1),
	(1,2),
	(11,1),
	(12,1),
	(13,1),
	(17,1),
	(18,1),
	(20,1),
	(21,1);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
