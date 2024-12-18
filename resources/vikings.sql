-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 16 nov. 2024 à 21:47
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vikings`
--

-- --------------------------------------------------------

--
-- Structure de la table `viking`
--

CREATE TABLE `viking` (
  `id` int NOT NULL,
  `name` varchar(16) NOT NULL,
  `attack` int NOT NULL,
  `defense` int NOT NULL,
  `health` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
;


CREATE TABLE `weapon`(
  `id` int NOT NULL,
  `type` varchar(25) NOT NULL,
  `damage` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
;
--
-- Déchargement des données de la table `viking`
--

INSERT INTO `viking` (`id`, `name`, `attack`, `defense`, `health`) VALUES
  (1, 'Ragnar', 200, 150, 300),
  (2, 'Floki', 150, 80, 350),
  (3, 'Lagertha', 300, 200, 200),
  (4, 'Björn', 350, 200, 100);

INSERT INTO `weapon` (`id`, `type`, `damage`) VALUES
  (1, 'Spear', 80),
  (2, 'Great Sword', 300),
  (3, 'Sword', 100 ),
  (4, 'Axe', 150);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `viking`
--
ALTER TABLE `viking`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `weapon`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `viking`
--
ALTER TABLE `viking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
  ALTER TABLE `weapon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


-- Ajout de la colonne `weaponId` à la table `viking` et création de la clé étrangère
ALTER TABLE `viking`
  ADD COLUMN `weaponId` INT NULL;

ALTER TABLE `viking`
  ADD FOREIGN KEY (`weaponId`) REFERENCES `weapon`(`id`);


-- Liason d'armes aux vikings
UPDATE `viking` SET `weaponId` = 4 WHERE `id` = 1;
UPDATE `viking` SET `weaponId` = 3 WHERE `id` = 2;
UPDATE `viking` SET `weaponId` = 2 WHERE `id` = 3;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
