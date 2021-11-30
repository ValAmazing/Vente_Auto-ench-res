-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour vente_auto
CREATE DATABASE IF NOT EXISTS `vente_auto` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `vente_auto`;

-- Listage de la structure de la table vente_auto. encheres
CREATE TABLE IF NOT EXISTS `encheres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `montant_enchere` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_produit` (`id_produit`) USING BTREE,
  KEY `id_users` (`id_user`),
  CONSTRAINT `FK1_encheres_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `FK2_enchere_product` FOREIGN KEY (`id_produit`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- Listage des données de la table vente_auto.encheres : ~0 rows (environ)
/*!40000 ALTER TABLE `encheres` DISABLE KEYS */;
/*!40000 ALTER TABLE `encheres` ENABLE KEYS */;

-- Listage de la structure de la table vente_auto. products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_owner` int(11) NOT NULL,
  `prix_depart` float NOT NULL DEFAULT '0',
  `date_fin` date NOT NULL,
  `model` varchar(255) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `puissance` int(11) NOT NULL,
  `annee` varchar(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `titre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `Index 2` (`id_owner`) USING BTREE,
  CONSTRAINT `FK1_products_users` FOREIGN KEY (`id_owner`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- Listage des données de la table vente_auto.products : ~0 rows (environ)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Listage de la structure de la table vente_auto. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- Listage des données de la table vente_auto.users : ~1 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `mdp`) VALUES
	(33, 'Valentin', 'ELLIOT', 'test@test.fr', '$2y$10$Vlu8W7dIRPUw0E3I4Lh5O.althP7/5slwhIF9Gj18vMn7REMLdizm');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;