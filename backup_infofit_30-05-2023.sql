-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.9.2-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour infofit
CREATE DATABASE IF NOT EXISTS `infofit` /*!40100 DEFAULT CHARACTER SET utf8mb3 */;
USE `infofit`;

-- Listage de la structure de table infofit. foodstuffs
CREATE TABLE IF NOT EXISTS `foodstuffs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `title` varchar(100) NOT NULL,
  `kcal_100g` float unsigned NOT NULL DEFAULT 0,
  `carbohydrates_100g` float unsigned NOT NULL DEFAULT 0,
  `lipids_100g` float unsigned NOT NULL DEFAULT 0,
  `proteins_100g` float unsigned NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uniquefoodstuff` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table infofit.foodstuffs : ~9 rows (environ)
INSERT INTO `foodstuffs` (`id`, `code`, `title`, `kcal_100g`, `carbohydrates_100g`, `lipids_100g`, `proteins_100g`, `updated_at`, `created_at`) VALUES
	(8, '3174780000363', 'Coca-Cola goût original', 42, 11, 0, 0, '2023-05-23 09:49:20', '2023-05-23 09:49:20'),
	(9, '3250392996369', 'Jambon de Bayonne', 247, 1, 15, 28, '2023-05-23 11:39:48', '2023-05-23 11:39:48'),
	(10, '3033610083573', 'Saumon fumé', 198, 0.6, 12, 22, '2023-05-24 05:01:47', '2023-05-24 05:01:47'),
	(11, '8424306010013', 'Jambon serrano', 191.2, 0.6, 4.7, 37.3, '2023-05-25 09:52:07', '2023-05-25 09:52:07'),
	(12, '3245413841391', 'Carpaccio', 222, 0.6, 16, 19, '2023-05-25 09:52:36', '2023-05-25 09:52:36'),
	(13, '3599741006763', 'Crousti\' express', 239, 32, 10, 3.2, '2023-05-25 09:53:08', '2023-05-25 09:53:08'),
	(14, '3770003264514', 'Spaghetti', 285, 53.8, 3.1, 10.3, '2023-05-25 10:10:26', '2023-05-25 10:10:26'),
	(15, '3300663330665', 'Ketchup', 78, 14.8, 1, 1.4, '2023-05-25 10:11:34', '2023-05-25 10:11:34'),
	(16, '8019290998906', 'Pizza margherita biologique', 189, 22.9, 6.4, 8.7, '2023-05-25 12:19:58', '2023-05-25 12:19:58'),
	(17, '3302749910020', 'Le Paris sans couenne - 4tr', 116, 0.5, 2.8, 22, '2023-05-30 07:27:33', '2023-05-30 07:27:33'),
	(18, '8008835002116', 'Jambon cru affiné', 256, 0.9, 16, 28, '2023-05-30 11:35:03', '2023-05-30 11:35:03'),
	(19, '8008835002154', 'Jambon Cuit Parmacotto', 150, 0.5, 8, 19, '2023-05-30 11:42:13', '2023-05-30 11:42:13');

-- Listage de la structure de table infofit. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(320) NOT NULL,
  `password` varchar(64) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthdate` date NOT NULL,
  `height` smallint(3) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uniqueuser` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table infofit.users : ~2 rows (environ)
INSERT INTO `users` (`id`, `email`, `password`, `lastname`, `firstname`, `gender`, `birthdate`, `height`, `updated_at`, `created_at`) VALUES
	(7, 'thierry.koetschet@cpnv.ch', '$2y$10$3nPD44rTdxoWbjrbmpYDeOH3xBs3fLaREtgd9vOAFE1ZNhUhk9Dym', 'Koetschet', 'Thierry', 'Male', '1998-03-19', 192, '2023-05-30 07:10:22', '2023-05-16 05:12:59'),
	(10, 'jessica@gmail.com', '$2y$10$M5ADXIDzdSADbfLUOY4dE.QtgceX66r2n6sUprSqv.JZ33YmoZQTe', 'Koetschet', 'Jessica', 'Female', '2003-03-28', 181, '2023-05-25 11:49:19', '2023-05-25 11:01:50');

-- Listage de la structure de table infofit. users_has_foodstuffs
CREATE TABLE IF NOT EXISTS `users_has_foodstuffs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `foodstuffs_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `quantity` float NOT NULL DEFAULT 1,
  `period` varchar(9) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_has_foodstuffs_foodstuffs1_idx` (`foodstuffs_id`),
  KEY `fk_users_has_foodstuffs_users_idx` (`users_id`),
  CONSTRAINT `fk_users_has_foodstuffs_foodstuffs1` FOREIGN KEY (`foodstuffs_id`) REFERENCES `foodstuffs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_users_has_foodstuffs_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table infofit.users_has_foodstuffs : ~7 rows (environ)
INSERT INTO `users_has_foodstuffs` (`id`, `users_id`, `foodstuffs_id`, `date`, `quantity`, `period`, `updated_at`, `created_at`) VALUES
	(1, 7, 8, '2023-05-23', 1.5, 'breakfast', '2023-05-23 09:50:52', '2023-05-23 09:50:52'),
	(2, 7, 9, '2023-05-23', 2, 'diner', '2023-05-23 11:39:48', '2023-05-23 11:39:48'),
	(3, 7, 10, '2023-05-24', 1, 'supper', '2023-05-24 05:01:47', '2023-05-24 05:01:47'),
	(4, 7, 11, '2023-05-25', 1, 'breakfast', '2023-05-25 09:52:07', '2023-05-25 09:52:07'),
	(5, 7, 12, '2023-05-25', 1, 'diner', '2023-05-25 09:52:36', '2023-05-25 09:52:36'),
	(9, 7, 16, '2023-05-25', 1, 'supper', '2023-05-25 12:19:58', '2023-05-25 12:19:58'),
	(11, 7, 17, '2023-05-30', 1, 'breakfast', '2023-05-30 07:27:33', '2023-05-30 07:27:33');

-- Listage de la structure de table infofit. weights
CREATE TABLE IF NOT EXISTS `weights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `value` smallint(3) unsigned NOT NULL,
  `date` date NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uniqueweight` (`value`,`date`,`users_id`),
  KEY `fk_weights_users1_idx` (`users_id`),
  CONSTRAINT `fk_weights_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table infofit.weights : ~11 rows (environ)
INSERT INTO `weights` (`id`, `value`, `date`, `users_id`, `updated_at`, `created_at`) VALUES
	(1, 88, '2023-05-16', 7, '2023-05-16 05:12:59', '2023-05-16 05:12:59'),
	(2, 90, '2023-05-16', 7, '2023-05-16 06:37:25', '2023-05-16 06:37:25'),
	(3, 86, '2023-05-17', 7, '2023-05-17 07:19:47', '2023-05-17 07:19:47'),
	(5, 89, '2023-05-22', 7, '2023-05-22 05:59:20', '2023-05-22 05:59:20'),
	(6, 88, '2023-05-22', 7, '2023-05-22 09:40:33', '2023-05-22 09:40:33'),
	(7, 85, '2023-05-23', 7, '2023-05-23 06:42:23', '2023-05-23 06:42:23'),
	(8, 95, '2023-05-24', 7, '2023-05-24 04:25:17', '2023-05-24 04:25:17'),
	(11, 70, '2023-05-25', 10, '2023-05-25 11:01:50', '2023-05-25 11:01:50'),
	(12, 71, '2023-05-25', 10, '2023-05-25 11:02:01', '2023-05-25 11:02:01'),
	(14, 72, '2023-05-25', 10, '2023-05-25 11:49:19', '2023-05-25 11:49:19'),
	(15, 93, '2023-05-25', 7, '2023-05-25 12:29:48', '2023-05-25 12:29:48'),
	(16, 86, '2023-05-30', 7, '2023-05-30 07:10:22', '2023-05-30 07:10:22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
