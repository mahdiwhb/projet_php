-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 02 mars 2025 à 15:24
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tp_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('En attente','Payée','Expédiée','Annulée') DEFAULT 'En attente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `description`) VALUES
(1, 'Bague Solitaire', 'bagues', 500.00, 'images/bague_solitaire.jpg', 'Bague solitaire en diamant.'),
(2, 'Bague Émeraude', 'bagues', 450.00, 'images/emauraude.png', 'Bague ornée d\'une émeraude et de diamants.'),
(3, 'Bague Royale', 'bagues', 600.00, 'images/royal.png', 'Bague au saphir et diamants, style royal.'),
(4, 'Bracelet LV', 'bracelets', 300.00, 'images/bracelet_lv.jpg', 'Bracelet tendance de la maison LV.'),
(5, 'Bracelet Love', 'bracelets', 400.00, 'images/bracelet_love.jpg', 'Bracelet emblématique Love en or.'),
(6, 'Bracelets Cartier', 'bracelets', 800.00, 'images/bracelets-cartier.jpg', 'Ensemble de bracelets Cartier en or et diamants.'),
(7, 'Bracelet Juste Un Clou', 'bracelets', 350.00, 'images/juste_un_clou.jpg', 'Bracelet Juste un Clou iconique.'),
(8, 'Boucles d\'oreilles Alhambra', 'boucles', 250.00, 'images/alhembra.jpg', 'Boucles d\'oreilles Alhambra.'),
(9, 'Boucles d\'oreilles Joséphine', 'boucles', 300.00, 'images/josephine.jpg', 'Boucles d\'oreilles Joséphine serties de diamants.'),
(10, 'Boucles d\'oreilles Perle d\'Or', 'boucles', 200.00, 'images/perle_d_or.jpeg', 'Boucles d\'oreilles en perle d\'or.'),
(11, 'Boucles d\'oreilles Hoop', 'boucles', 280.00, 'images/boucle.jpg', 'Boucles d\'oreilles créoles en or.'),
(12, 'Collier Malachite', 'colliers', 500.00, 'images/colier.jpg', 'Collier Alhambra avec pendentif en malachite.');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`) VALUES
(1, 'Mattéo', 'Ferrari', 'ferrarimatteo666@gmail.com', '$2y$10$r6Xqorjudmx4zgNLtM8gqegu8i9Bzqwh2QipL6Z.joRSUGMrxCi62', '2025-03-02 14:11:47'),
(2, 'Mahdi', 'Wouhaibi', 'mahdi@gmail.com', '$2y$10$/xKKpwMQtB1eqIl2RgPQ9ezKc3kuo.z8hyHZtHvKgDAZhQmfqSpKu', '2025-03-02 14:50:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
