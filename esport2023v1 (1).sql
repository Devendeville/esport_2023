-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 sep. 2023 à 15:27
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `esport2023`
--
CREATE DATABASE IF NOT EXISTS `esport2023` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `esport2023`;

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `id_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_equipe` varchar(45) DEFAULT NULL,
  `fk_id_j_chef_equipe` int(11) NOT NULL,
  PRIMARY KEY (`id_equipe`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `nom_equipe`, `fk_id_j_chef_equipe`) VALUES
(1, 'Equipe1', 1),
(2, 'Equipe2', 2),
(3, 'Equipe3', 3),
(4, 'Equipe4', 4);

-- --------------------------------------------------------

--
-- Structure de la table `equipe_has_match`
--

DROP TABLE IF EXISTS `equipe_has_match`;
CREATE TABLE IF NOT EXISTS `equipe_has_match` (
  `equipe_id_equipe` int(11) NOT NULL,
  `Match_id_match` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `victoire` tinyint(1) DEFAULT NULL,
  `presence` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`equipe_id_equipe`,`Match_id_match`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe_has_match`
--

INSERT INTO `equipe_has_match` (`equipe_id_equipe`, `Match_id_match`, `score`, `victoire`, `presence`) VALUES
(1, 1, NULL, NULL, NULL),
(1, 3, NULL, NULL, NULL),
(1, 4, NULL, NULL, NULL),
(2, 1, NULL, NULL, NULL),
(2, 5, NULL, NULL, NULL),
(2, 6, NULL, NULL, NULL),
(3, 2, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL),
(3, 5, NULL, NULL, NULL),
(4, 2, NULL, NULL, NULL),
(4, 4, NULL, NULL, NULL),
(4, 6, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE IF NOT EXISTS `joueur` (
  `id_joueur` int(11) NOT NULL AUTO_INCREMENT,
  `log_joueur` varchar(45) DEFAULT NULL,
  `mdp_joueur` varchar(45) DEFAULT NULL,
  `email_joueur` varchar(45) DEFAULT NULL,
  `id_equipe_joueur` int(11) DEFAULT NULL,
  `changeMdp_joueur` varchar(45) DEFAULT NULL,
  `Rang_id_rang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_joueur`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`id_joueur`, `log_joueur`, `mdp_joueur`, `email_joueur`, `id_equipe_joueur`, `changeMdp_joueur`, `Rang_id_rang`) VALUES
(1, 'Joueur1', 'Joueur1ACrypter', 'joueur1@gmail.com', 1, NULL, 1),
(2, 'Joueur2', 'Joueur2ACrypter', 'joueur2@gmail.com', 2, NULL, 2),
(3, 'Joueur3', 'Joueur3ACrypter', 'Joueur3@gmail.com', 3, NULL, 3),
(4, 'Joueur4', 'Joueur4ACrypter', 'Joueur4@gmail.com', 4, NULL, 1),
(5, 'Joueur5', 'Joueur5ACrypter', 'Joueur5@gmail.com', 1, NULL, 2),
(6, 'Joueur6', 'Joueur6ACrypter', 'Joueur6@gmail.com', 2, NULL, 3),
(7, 'Joueur7', 'Joueur7ACrypter', 'Joueur7@gmail.com', 3, NULL, 1),
(8, 'Joueur8', 'Joueur8ACrypter', 'Joueur8@gmail.com', 4, NULL, 2),
(9, 'Joueur9', 'Joueur9ACrypter', 'Joueur9@gmail.com', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `joueur_demande_equipe`
--

DROP TABLE IF EXISTS `joueur_demande_equipe`;
CREATE TABLE IF NOT EXISTS `joueur_demande_equipe` (
  `Joueur_id_joueur` int(11) NOT NULL,
  `equipe_id_equipe` int(11) NOT NULL,
  PRIMARY KEY (`Joueur_id_joueur`,`equipe_id_equipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `joueur_demande_equipe`
--

INSERT INTO `joueur_demande_equipe` (`Joueur_id_joueur`, `equipe_id_equipe`) VALUES
(9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

DROP TABLE IF EXISTS `match`;
CREATE TABLE IF NOT EXISTS `match` (
  `id_match` int(11) NOT NULL AUTO_INCREMENT,
  `date_match` datetime DEFAULT NULL,
  `effectue_match` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_match`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `match`
--

INSERT INTO `match` (`id_match`, `date_match`, `effectue_match`) VALUES
(1, '2023-09-14 00:00:00', NULL),
(2, '2023-09-14 00:00:00', NULL),
(3, '2023-09-15 15:21:58', NULL),
(4, '2023-09-15 15:21:58', NULL),
(5, '2023-09-16 15:21:58', NULL),
(6, '2023-09-16 15:21:58', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rang`
--

DROP TABLE IF EXISTS `rang`;
CREATE TABLE IF NOT EXISTS `rang` (
  `id_rang` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_rang` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_rang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rang`
--

INSERT INTO `rang` (`id_rang`, `libelle_rang`) VALUES
(1, 'Bronze'),
(2, 'Argent'),
(3, 'Or');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
