-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 27 mars 2020 à 16:11
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`task_id`),
  KEY `list_id` (`list_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`task_id`, `user_id`, `list_id`, `name`, `status`) VALUES
(1, 1, 1, 'Tâche 1', 0),
(2, 1, 1, 'Tâche 2', 1),
(3, 1, 1, 'Tâche 3', 0),
(4, 1, 1, 'Tâche 4', 0),
(5, 1, 1, 'Tâche 5', 1);

-- --------------------------------------------------------

--
-- Structure de la table `todo_lists`
--

DROP TABLE IF EXISTS `todo_lists`;
CREATE TABLE IF NOT EXISTS `todo_lists` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`list_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `todo_lists`
--

INSERT INTO `todo_lists` (`list_id`, `user_id`, `name`, `color`) VALUES
(1, 1, 'Première ToDo list', 'pinkorange'),
(12, 1, 'Ça marche ?', 'grey'),
(13, 1, 'Et maintenant ?', 'grey'),
(14, 1, 'Ah oui', 'grey');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'Frangipanus', 'alexislecomte777@yahoo.fr', '$argon2id$v=19$m=65536,t=4,p=1$aTdyeDdWN2N5S1hWYlFpQQ$kPXVaqoMV6plTqauEVPZJUM3RKdd8Vf6Wdaj8agDBUk'),
(7, 'Louan', 'louan.leplae@supinfo.com', '$argon2id$v=19$m=65536,t=4,p=1$b09yRng5V2Z0UThTOHp0aw$m2BjYZ55hKU8b9cy+13Oy70n6MbaCyNBwpU5UBKDVp0'),
(8, 'Empire Démocratique du Poulpe', 'nounours7000.gaming@yahoo.fr', '$argon2id$v=19$m=65536,t=4,p=1$eFQ2b0RMM1dFRThuOXhhYQ$NKQyUgMDCaqVP4wn326dBkvSUFBDqX3WiOc5qepGCfE');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
