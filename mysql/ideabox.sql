-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 29 Novembre 2012 à 16:50
-- Version du serveur: 5.5.27
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ideabox`
--

-- --------------------------------------------------------

--
-- Structure de la table `assoc_tag_project`
--

CREATE DATABASE IF NOT EXISTS ideabox;
USE ideabox;

CREATE TABLE IF NOT EXISTS `assoc_tag_project` (
  `fktag` int(11) NOT NULL,
  `fkproject` int(11) NOT NULL,
  PRIMARY KEY (`fktag`,`fkproject`),
  KEY `fkproject` (`fkproject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `assoc_user_project`
--

CREATE TABLE IF NOT EXISTS `assoc_user_project` (
  `fkuser` int(11) NOT NULL,
  `fkproject` int(11) NOT NULL,
  `fkrole` int(11) NOT NULL,
  PRIMARY KEY (`fkuser`,`fkproject`,`fkrole`),
  KEY `fkproject` (`fkproject`),
  KEY `fkrole` (`fkrole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `assoc_user_project`
--

INSERT INTO `assoc_user_project` (`fkuser`, `fkproject`, `fkrole`) VALUES
(1, 1, 1),
(1, 1, 5),
(1, 2, 1),
(1, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `assoc_user_skill`
--

CREATE TABLE IF NOT EXISTS `assoc_user_skill` (
  `fkuser` int(11) NOT NULL,
  `fkskill` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`fkuser`,`fkskill`),
  KEY `fkskill` (`fkskill`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `assoc_user_skill`
--

INSERT INTO `assoc_user_skill` (`fkuser`, `fkskill`, `level`, `description`) VALUES
(1, 1, 75, 'J''adore la POO.'),
(1, 3, 95, 'Je suis un guru de Python 8-)'),
(2, 0, 25, 'Les langages bas niveau c''est pas trop mon truc...'),
(2, 1, 35, 'C++ ça passe déjà un peu mieux.'),
(21, 0, 66, 'asdf');

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `pkproject` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `short_description` text,
  `long_description` text,
  `image` text,
  `fkowner` int(11) NOT NULL,
  `ispublic` tinyint(1) NOT NULL,
  PRIMARY KEY (`pkproject`),
  UNIQUE KEY `name` (`name`),
  KEY `fkowner` (`fkowner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`pkproject`, `name`, `creationdate`, `short_description`, `long_description`, `image`, `fkowner`, `ispublic`) VALUES
(1, 'RandomProject', '0000-00-00 00:00:00', 'project description (short)', 'project description (long)', NULL, 1, 1),
(2, 'Ideabox', '2012-11-20 10:22:05', 'Super projet web', 'Super projet web qui rox du poney évolué en pokemon feu.', '/images/logo.png', 1, 1),
(3, 'TEst Projecta', '2012-11-20 14:46:54', 'asdf', 'asfd', 'http://www.leggett-immo.com/img/confidentiality.jpg', 1, 1),
(4, '', '2012-11-21 13:19:00', '', '', '', 1, 0),
(5, 'asdf', '2012-11-21 13:19:17', 'asdfa', 'sdfasdf', 'asdf', 1, 1),
(7, 'dsf', '2012-11-29 14:22:53', 'lkj', 'lkj', 'dsf', 1, 1),
(8, 'asdlkfj', '2012-11-29 14:23:15', 'lkj', 'lkj', 'lkj', 1, 1),
(9, 'HelloWorldProject', '2012-11-29 14:24:11', 'Write Hello World in Javascript', 'Boom', 'www.google.ro', 1, 1),
(10, 'alskfdj', '2012-11-29 14:33:54', 'lkjl', 'kj', 'lkj', 21, 0);

-- --------------------------------------------------------

--
-- Structure de la table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fkuser_source` int(11) NOT NULL,
  `fkuser_destination` int(11) NOT NULL,
  `fkrole` int(11) NOT NULL,
  `fkproject` int(11) NOT NULL,
  `comment` text NOT NULL,
  `state` int(11) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fkuser_source`,`fkuser_destination`,`fkrole`,`fkproject`),
  UNIQUE KEY `id` (`id`),
  KEY `fkuser_destination` (`fkuser_destination`),
  KEY `fkrole` (`fkrole`),
  KEY `fkproject` (`fkproject`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `request`
--

INSERT INTO `request` (`id`, `fkuser_source`, `fkuser_destination`, `fkrole`, `fkproject`, `comment`, `state`, `creationdate`) VALUES
(9, 1, 1, 1, 1, 'kjh', 1, '2012-11-22 11:25:22'),
(10, 1, 1, 1, 2, '', 1, '2012-11-22 11:28:22'),
(11, 1, 1, 1, 3, '', 1, '2012-11-22 11:29:36'),
(8, 1, 1, 3, 1, 'oj', 2, '2012-11-22 11:25:36'),
(12, 1, 1, 5, 1, '', 1, '2012-11-22 11:29:51'),
(13, 1, 20, 1, 1, '', 0, '2012-11-22 11:30:22');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `request_view`
--
CREATE TABLE IF NOT EXISTS `request_view` (
`id` int(11)
,`fkuser_source` int(11)
,`fkuser_destination` int(11)
,`state` int(11)
,`source_firstname` text
,`source_lastname` text
,`destination_firstname` text
,`destination_lastname` text
,`role` text
,`name` varchar(255)
);
-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `pkrole` int(11) NOT NULL AUTO_INCREMENT,
  `role` text NOT NULL,
  PRIMARY KEY (`pkrole`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`pkrole`, `role`) VALUES
(1, 'Programmeur'),
(2, 'Chef de projet'),
(3, 'Testeur'),
(4, 'Assurance qualité'),
(5, 'Relations humaines'),
(6, 'Directeur technique'),
(7, 'Responsable sécurité');

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `pkskill` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`pkskill`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `skill`
--

INSERT INTO `skill` (`pkskill`, `name`) VALUES
(0, 'C'),
(1, 'C++'),
(2, 'Java'),
(3, 'Python');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `pktag` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`pktag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `pkuser` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` text,
  `password` text NOT NULL,
  PRIMARY KEY (`pkuser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`pkuser`, `firstname`, `lastname`, `email`, `description`, `password`) VALUES
(1, 'jean', 'dupont', 'foobar@domain.tld', 'description', 'password'),
(2, 'arthur', 'leroi', 'a@a.com', 'description', 'password'),
(10, 'Arthur', 'bidon', 'ab@c.com', 'description', 'password'),
(20, 'A', 'B', 'a@b.com', 'descr', 'password'),
(21, 'aslkdjf', 'lkj', 'b@a.com', 'alsdf', 'password');

-- --------------------------------------------------------

--
-- Structure de la vue `request_view`
--
DROP TABLE IF EXISTS `request_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `request_view` AS select `request`.`id` AS `id`,`request`.`fkuser_source` AS `fkuser_source`,`request`.`fkuser_destination` AS `fkuser_destination`,`request`.`state` AS `state`,`user1`.`firstname` AS `source_firstname`,`user1`.`lastname` AS `source_lastname`,`user2`.`firstname` AS `destination_firstname`,`user2`.`lastname` AS `destination_lastname`,`role`.`role` AS `role`,`project`.`name` AS `name` from ((((`user` `user1` join `user` `user2`) join `role`) join `project`) join `request`) where ((`user1`.`pkuser` = `request`.`fkuser_source`) and (`user2`.`pkuser` = `request`.`fkuser_destination`) and (`role`.`pkrole` = `request`.`fkrole`) and (`project`.`pkproject` = `request`.`fkproject`));

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `assoc_tag_project`
--
ALTER TABLE `assoc_tag_project`
  ADD CONSTRAINT `assoc_tag_project_ibfk_1` FOREIGN KEY (`fktag`) REFERENCES `tag` (`pktag`),
  ADD CONSTRAINT `assoc_tag_project_ibfk_2` FOREIGN KEY (`fkproject`) REFERENCES `project` (`pkproject`);

--
-- Contraintes pour la table `assoc_user_project`
--
ALTER TABLE `assoc_user_project`
  ADD CONSTRAINT `assoc_user_project_ibfk_1` FOREIGN KEY (`fkuser`) REFERENCES `user` (`pkuser`),
  ADD CONSTRAINT `assoc_user_project_ibfk_2` FOREIGN KEY (`fkproject`) REFERENCES `project` (`pkproject`),
  ADD CONSTRAINT `assoc_user_project_ibfk_3` FOREIGN KEY (`fkrole`) REFERENCES `role` (`pkrole`);

--
-- Contraintes pour la table `assoc_user_skill`
--
ALTER TABLE `assoc_user_skill`
  ADD CONSTRAINT `assoc_user_skill_ibfk_1` FOREIGN KEY (`fkuser`) REFERENCES `user` (`pkuser`),
  ADD CONSTRAINT `assoc_user_skill_ibfk_2` FOREIGN KEY (`fkskill`) REFERENCES `skill` (`pkskill`);

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`fkowner`) REFERENCES `user` (`pkuser`);

--
-- Contraintes pour la table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`fkuser_source`) REFERENCES `user` (`pkuser`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`fkuser_destination`) REFERENCES `user` (`pkuser`),
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`fkrole`) REFERENCES `role` (`pkrole`),
  ADD CONSTRAINT `request_ibfk_4` FOREIGN KEY (`fkproject`) REFERENCES `project` (`pkproject`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
