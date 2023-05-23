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
  `code` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `kcal_100g` smallint(4) unsigned NOT NULL,
  `carbohydrates_100g` smallint(4) unsigned NOT NULL,
  `lipids_100g` smallint(4) unsigned NOT NULL,
  `proteins_100g` smallint(4) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uniquefoodstuff` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table infofit.foodstuffs : ~0 rows (environ)

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table infofit.users : ~2 rows (environ)
INSERT INTO `users` (`id`, `email`, `password`, `lastname`, `firstname`, `gender`, `birthdate`, `height`, `updated_at`, `created_at`) VALUES
	(7, 'thierry.koetschet@cpnv.ch', '$2y$10$c2ub9Nx0.7ZGQFt0OHzcteFCRuhkr2qDHDCcIjrt0cGyd1ck3nTWC', 'Koetschet', 'Thierry', 'Male', '1998-03-19', 192, '2023-05-16 05:12:59', '2023-05-16 05:12:59'),
	(8, 'beatriz@cpnv.ch', '$2y$10$w1tgGf7bNUAQmtea/WHUQ.6YaiMZtvLlliUWrTAOX02O4qBnkVc12', 'Martin Peñalosa', 'Beatriz', 'Female', '1998-03-19', 165, '2023-05-22 05:58:43', '2023-05-22 05:58:43');

-- Listage de la structure de table infofit. users_has_foodstuffs
CREATE TABLE IF NOT EXISTS `users_has_foodstuffs` (
  `id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `foodstuffs_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `quantity` smallint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_has_foodstuffs_foodstuffs1_idx` (`foodstuffs_id`),
  KEY `fk_users_has_foodstuffs_users_idx` (`users_id`),
  CONSTRAINT `fk_users_has_foodstuffs_foodstuffs1` FOREIGN KEY (`foodstuffs_id`) REFERENCES `foodstuffs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_users_has_foodstuffs_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table infofit.users_has_foodstuffs : ~0 rows (environ)

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table infofit.weights : ~6 rows (environ)
INSERT INTO `weights` (`id`, `value`, `date`, `users_id`, `updated_at`, `created_at`) VALUES
	(1, 88, '2023-05-16', 7, '2023-05-16 05:12:59', '2023-05-16 05:12:59'),
	(2, 90, '2023-05-16', 7, '2023-05-16 06:37:25', '2023-05-16 06:37:25'),
	(3, 86, '2023-05-17', 7, '2023-05-17 07:19:47', '2023-05-17 07:19:47'),
	(4, 60, '2023-05-22', 8, '2023-05-22 05:58:43', '2023-05-22 05:58:43'),
	(5, 89, '2023-05-22', 7, '2023-05-22 05:59:20', '2023-05-22 05:59:20'),
	(6, 88, '2023-05-22', 7, '2023-05-22 09:40:33', '2023-05-22 09:40:33');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
