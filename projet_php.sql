-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 19 avr. 2020 à 11:22
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
-- Structure de la table `friendships`
--

DROP TABLE IF EXISTS `friendships`;
CREATE TABLE IF NOT EXISTS `friendships` (
  `friendship_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_a_id` int(11) NOT NULL,
  `user_b_id` int(11) NOT NULL,
  PRIMARY KEY (`friendship_id`),
  KEY `user_b_id` (`user_b_id`),
  KEY `user_a_id` (`user_a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friendships`
--

INSERT INTO `friendships` (`friendship_id`, `user_a_id`, `user_b_id`) VALUES
(12, 1, 8),
(13, 1, 7),
(14, 1, 11),
(15, 1, 9),
(16, 1, 10);

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
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`task_id`, `user_id`, `list_id`, `name`, `status`) VALUES
(25, 1, 1, 'dsdqsdqs', 1),
(3, 1, 1, 'Tâche 3', 1),
(4, 1, 1, 'Tâche 4', 0),
(5, 1, 1, 'Tâche 5', 1),
(6, 1, 12, 'Ça marche ?', 1),
(7, 1, 12, 'Ça marche ?', 0),
(8, 1, 12, 'fsdfdsf', 0),
(9, 1, 12, ',n,nb,nb', 1),
(43, 1, 1, 'a', 0),
(54, 11, 71, 'dqsdqsdqsd', 0),
(42, 1, 1, 'a', 0),
(34, 1, 1, 'dsfsd', 0),
(30, 1, 1, 'Maxou est un noob', 1),
(41, 1, 1, 'a', 1),
(53, 11, 71, 'sdfdsfsd', 1),
(44, 1, 1, 'a', 0),
(45, 1, 1, 'a', 1),
(46, 1, 1, 'a', 1),
(47, 1, 54, 'fdsfsdfsdfsdf', 0),
(48, 1, 54, 'fsdfdsfsdfs', 1),
(49, 1, 54, 'sdfsdfdsfdsfsdfsd', 1),
(50, 1, 12, 'fgdfg', 0),
(51, 1, 1, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 0),
(52, 1, 1, 'ffffffffffffffffffffffffffffffff', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `todo_lists`
--

INSERT INTO `todo_lists` (`list_id`, `user_id`, `name`, `color`) VALUES
(1, 1, 'Première ToDo list', 'purple'),
(71, 11, 'Partage avec Frangipanus', 'pinkorange'),
(64, 1, '50 Nuances de Grey', 'grey'),
(54, 1, 'max le super noob', 'red'),
(70, 1, 'FOLLOW THE DAMN TRAIN CJ', 'black'),
(12, 1, 'Ça marche ?', 'blue'),
(57, 1, 'Mange mes graines', 'pinkorange'),
(58, 1, 'Salut c\'est Julien', 'coral'),
(73, 12, 'Ma première liste', 'pinkorange'),
(55, 1, '              ', 'orange'),
(59, 1, 'Qu\'est-ce qui est jaune', 'yellow'),
(63, 1, 'agrougrou hulk méchant', 'green');

-- --------------------------------------------------------

--
-- Structure de la table `todo_lists_share`
--

DROP TABLE IF EXISTS `todo_lists_share`;
CREATE TABLE IF NOT EXISTS `todo_lists_share` (
  `share_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`share_id`),
  KEY `list_id` (`list_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `todo_lists_share`
--

INSERT INTO `todo_lists_share` (`share_id`, `list_id`, `user_id`, `accepted`) VALUES
(1, 54, 7, 1),
(2, 54, 9, 1),
(3, 54, 11, 1),
(40, 54, 12, 1),
(39, 1, 12, 1),
(38, 71, 12, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'Frangipanus', 'alexislecomte777@yahoo.fr', '$argon2id$v=19$m=65536,t=4,p=1$aTdyeDdWN2N5S1hWYlFpQQ$kPXVaqoMV6plTqauEVPZJUM3RKdd8Vf6Wdaj8agDBUk'),
(7, 'Louan', 'louan.leplae@supinfo.com', '$argon2id$v=19$m=65536,t=4,p=1$b09yRng5V2Z0UThTOHp0aw$m2BjYZ55hKU8b9cy+13Oy70n6MbaCyNBwpU5UBKDVp0'),
(8, 'Empire Démocratique du Poulpe', 'nounours7000.gaming@yahoo.fr', '$argon2id$v=19$m=65536,t=4,p=1$eFQ2b0RMM1dFRThuOXhhYQ$NKQyUgMDCaqVP4wn326dBkvSUFBDqX3WiOc5qepGCfE'),
(9, 'David Goodenough', 'bohcestpassimal@atari.us', '$argon2id$v=19$m=65536,t=4,p=1$cldVSmM2UGM1dzdNVVB4aA$BqDJ+Dcv8kNczC/GS8Yb4Xe4SHrJ0VcK/BmiRL3n2RA'),
(10, 'Mange mes graines', 'miammiamlesbonnesgraines@farm.de', '$argon2id$v=19$m=65536,t=4,p=1$dzk1dzNnL2dGRFcvQnpKZA$gD9AuZk05pQvi5jW3PCAu1GP20EvKNy+lVVMC39OFy8'),
(11, 'Albus HumbleBundleDore', 'silence@silence.ohvosgueules', '$argon2id$v=19$m=65536,t=4,p=1$TGhPWWh6SUNOdHZTSnE0UA$0mjXofj+D469+8Dk1iGmQZ6bUcfptyEoGIXe+mu/oGc'),
(12, 'Alexis', '293287@supinfo.com', '$argon2id$v=19$m=65536,t=4,p=1$eEREWmRWRzk3QS5hQjguSQ$Q/MRzhNz40jRPNwVnXYVwM6lUU9vl9VmV109I5oQUE0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
