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


-- Listage de la structure de la base pour tkoetschet_db
CREATE DATABASE IF NOT EXISTS `tkoetschet_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 */;
USE `tkoetschet_db`;

-- Listage de la structure de table tkoetschet_db. foodstuffs
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Listage de la structure de table tkoetschet_db. users
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Listage de la structure de table tkoetschet_db. users_has_foodstuffs
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Listage de la structure de table tkoetschet_db. weights
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
