-- Désactiver les contraintes de clés étrangères temporairement
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Création de la base de données
CREATE DATABASE IF NOT EXISTS `tp_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `tp_web`;

-- --------------------------------------------------------

-- Suppression et création de la table `product`
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `P_NAME` VARCHAR(100) NOT NULL,
  `P_Price` DECIMAL(10,2) NOT NULL,
  `P_Type` VARCHAR(50) NOT NULL,
  `P_Status` VARCHAR(50) NOT NULL,
  `P_picture` VARCHAR(255) DEFAULT NULL -- Stocker le chemin de l'image au lieu de BLOB
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

-- Suppression et création de la table `user`
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `F_NAME` VARCHAR(50) NOT NULL,
  `L_NAME` VARCHAR(50) NOT NULL,
  `EMAIL` VARCHAR(200) NOT NULL UNIQUE,
  `LOGIN` VARCHAR(50) NOT NULL UNIQUE,
  `PASSWORD` VARCHAR(255) NOT NULL -- Stockage sécurisé avec password_hash
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insertion de nouvelles données anonymisées
INSERT INTO `user` (`F_NAME`, `L_NAME`, `EMAIL`, `LOGIN`, `PASSWORD`) VALUES
('Lucas', 'Martin', 'lucas.martin@example.com', 'lucasM', '2y$10$Tkb8Qo5z/v4tGJsAE7tLf.TGc3b4clilwDdVhwo6H1EkD2ZW5dBHK'), 
('Emma', 'Dubois', 'emma.dubois@example.com', 'emmaD', '2y$10$Tkb8Qo5z/v4tGJsAE7tLf.TGc3b4clilwDdVhwo6H1EkD2ZW5dBHd'),
('Hugo', 'Lemoine', 'hugo.lemoine@example.com', 'hugoL', '2y$10$Tkb8Qo5z/v4tGJsAE7tLf.TGc3b4clilwDdVhwo6H1EkD2ZW5dBHKa'),
('Sophie', 'Gauthier', 'sophie.gauthier@example.com', 'sophieG', '2y$10$Tkb8Qo5z/v4tGJsAE7tLf.TGc3b4clilwDdVhwo6H1EkD2ZW5dBHKq'),
('Noah', 'Clement', 'noah.clement@example.com', 'noahC', '2y$10$Tkb8Qo5z/v4tGJsAE7tLf.TGc3b4clilwDdVhwo6H1EkD2ZW5dBHKw'),
('Lea', 'Morel', 'lea.morel@example.com', 'leaM', '2y$10$Tkb8Qo5z/v4tGJsAE7tLf.TGc3b4clilwDdVhwo6H1EkD2ZW5dBHKp');

-- Réactiver les contraintes de clés étrangères
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
