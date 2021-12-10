-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 28 sep. 2021 à 07:57
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jobboard`
--
CREATE DATABASE IF NOT EXISTS `jobboard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jobboard`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `phone` varchar(1024) NOT NULL,
  `activate_admin` boolean DEFAULT 0,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `advertisement`
--

DROP TABLE IF EXISTS `advertisement`;
CREATE TABLE IF NOT EXISTS `advertisement` (
  `id_advertisement` int NOT NULL AUTO_INCREMENT,
  `id_people` int NOT NULL ,
  `title` varchar(142) NOT NULL,
  `description` varchar(1042) NOT NULL,
  `creation_date` timestamp NOT NULL,
  `id_companies` int DEFAULT NULL,
  `id_type` int DEFAULT NULL,
  `id_city` int DEFAULT NULL,
  `id_sector` int DEFAULT NULL,
  PRIMARY KEY (`id_advertisement`),
  KEY `advertisement_companies_FK` (`id_companies`),
  KEY `advertisement_type_FK` (`id_type`),
  KEY `advertisement_people_FK` (`id_people`),
  KEY `advertisement_city0_FK` (`id_city`),
  KEY `advertisement_sector1_FK` (`id_sector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `applicant`
--

DROP TABLE IF EXISTS `applicant`;
CREATE TABLE IF NOT EXISTS `applicant` (
  `id_applicant` int NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) NOT NULL,
  `profil_picture` varchar(256) NOT NULL,
  `description` varchar(1024) NOT NULL,
  PRIMARY KEY (`id_applicant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `applicant_document`
--

DROP TABLE IF EXISTS `applicant_document`;
CREATE TABLE IF NOT EXISTS `applicant_document` (
  `id_document` int NOT NULL,
  `id_applicant` int NOT NULL,
  PRIMARY KEY (`id_document`,`id_applicant`),
  KEY `applicant_document_applicant1_FK` (`id_applicant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `id_application` int NOT NULL AUTO_INCREMENT,
  `title` varchar(142) NOT NULL,
  `description` varchar(1042) NOT NULL,
  PRIMARY KEY (`id_application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `application_document`
--

DROP TABLE IF EXISTS `application_document`;
CREATE TABLE IF NOT EXISTS `application_document` (
  `id_document` int NOT NULL,
  `id_application` int NOT NULL,
  PRIMARY KEY (`id_document`,`id_application`),
  KEY `application_document_application0_FK` (`id_application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id_city` int NOT NULL AUTO_INCREMENT,
  `label` varchar(42) NOT NULL,
  `zip_code` int NOT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id_companies` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `creation_date` varchar(1042) NOT NULL,
  `description` varchar(1042) NOT NULL,
  `id_city` int DEFAULT NULL,
  `id_people` int DEFAULT NULL,
  `id_sector` int DEFAULT NULL,
  `activate` boolean DEFAULT 1,
  PRIMARY KEY (`id_companies`),
  KEY `companies_people0_FK` (`id_people`),
  KEY `companies_city1_FK` (`id_city`),
  KEY `companies_sector2_FK` (`id_sector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id_document` int NOT NULL AUTO_INCREMENT,
  `name` varchar(42) NOT NULL,
  `path` varchar(1042) NOT NULL,
  PRIMARY KEY (`id_document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `id_link` int NOT NULL AUTO_INCREMENT,
  `label` varchar(42) NOT NULL,
  PRIMARY KEY (`id_link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `log_mail`
--

DROP TABLE IF EXISTS `log_mail`;
CREATE TABLE IF NOT EXISTS `log_mail` (
  `id_log_mail` int NOT NULL AUTO_INCREMENT,
  `id_recipient` int NOT NULL,
  `date` timestamp NOT NULL,
  `first_name_sender` varchar(142) NOT NULL,
  `last_name_sender` varchar(142) NOT NULL,
  `email_sender` varchar(142) NOT NULL,
  `tel_sender` varchar(15) NOT NULL,
  `obj` varchar(142) NOT NULL,
  `content` varchar(1042) NOT NULL,
  PRIMARY KEY (`id_log_mail`),
  KEY `id_recipient` (`id_recipient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `log_mail_doc`
--

DROP TABLE IF EXISTS `log_mail_doc`;
CREATE TABLE IF NOT EXISTS `log_mail_doc` (
  `id_log_mail` int NOT NULL,
  `id_document` int NOT NULL,
  PRIMARY KEY (`id_log_mail`,`id_document`),
  KEY `log_mail_doc_document0_FK` (`id_document`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `id_people` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `email` varchar(1024) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `activate` boolean DEFAULT 1,
  PRIMARY KEY (`id_people`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `people_status`
--

DROP TABLE IF EXISTS `people_status`;
CREATE TABLE IF NOT EXISTS `people_status` (
  `id_people_status` int NOT NULL AUTO_INCREMENT,
  `id_people` int NOT NULL,
  `id_companies` int DEFAULT NULL,
  `id_applicant` int DEFAULT NULL,
  `id_admin` int DEFAULT NULL,
  PRIMARY KEY (`id_people_status`),
  KEY `people_status_people0_FK` (`id_people`),
  KEY `people_status_companies1_FK` (`id_companies`),
  KEY `people_status_applicant2_FK` (`id_applicant`),
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sector`
--

DROP TABLE IF EXISTS `sector`;
CREATE TABLE IF NOT EXISTS `sector` (
  `id_sector` int NOT NULL AUTO_INCREMENT,
  `label` varchar(42) NOT NULL,
  `id_sector_parent` int DEFAULT NULL,
  PRIMARY KEY (`id_sector`),
  KEY `sector_sector0_FK` (`id_sector_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `to_link`
--

DROP TABLE IF EXISTS `to_link`;
CREATE TABLE IF NOT EXISTS `to_link` (
  `id_link` int NOT NULL,
  `id_applicant` int NOT NULL,
  `id_companies` int NOT NULL,
  PRIMARY KEY (`id_link`,`id_applicant`,`id_companies`),
  KEY `to_link_applicant1_FK` (`id_applicant`),
  KEY `to_link_companies2_FK` (`id_companies`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `label` varchar(142) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `advertisement_companies_FK` FOREIGN KEY (`id_companies`) REFERENCES `companies` (`id_companies`),
  ADD CONSTRAINT `advertisement_city0_FK` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`),
  ADD CONSTRAINT `advertisement_sector1_FK` FOREIGN KEY (`id_sector`) REFERENCES `sector` (`id_sector`),
  ADD CONSTRAINT `advertisement_type_FK` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);
  ADD CONSTRAINT `advertisement_people_FK` FOREIGN KEY (`id_people`) REFERENCES `people` (`id_people`);

--
-- Contraintes pour la table `applicant_document`
--
ALTER TABLE `applicant_document`
  ADD CONSTRAINT `applicant_document_applicant1_FK` FOREIGN KEY (`id_applicant`) REFERENCES `applicant` (`id_applicant`),
  ADD CONSTRAINT `applicant_document_document0_FK` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`);

--
-- Contraintes pour la table `application_document`
--
ALTER TABLE `application_document`
  ADD CONSTRAINT `application_document_application0_FK` FOREIGN KEY (`id_application`) REFERENCES `application` (`id_application`),
  ADD CONSTRAINT `application_document_document_FK` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`);

--
-- Contraintes pour la table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_city1_FK` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`),
  ADD CONSTRAINT `companies_people0_FK` FOREIGN KEY (`id_people`) REFERENCES `people` (`id_people`),
  ADD CONSTRAINT `companies_sector2_FK` FOREIGN KEY (`id_sector`) REFERENCES `sector` (`id_sector`);

--
-- Contraintes pour la table `log_mail`
--
ALTER TABLE `log_mail`
  ADD CONSTRAINT `log_mail_ibfk_1` FOREIGN KEY (`id_recipient`) REFERENCES `people` (`id_people`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `log_mail_doc`
--
ALTER TABLE `log_mail_doc`
  ADD CONSTRAINT `log_mail_doc_document0_FK` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`),
  ADD CONSTRAINT `log_mail_doc_log_mail_FK` FOREIGN KEY (`id_log_mail`) REFERENCES `log_mail` (`id_log_mail`);

--
-- Contraintes pour la table `people_status`
--
-- ALTER TABLE `people_status`
  -- ADD CONSTRAINT `people_status_applicant2_FK` FOREIGN KEY (`id_applicant`) REFERENCES `applicant` (`id_applicant`),
  -- ADD CONSTRAINT `people_status_companies1_FK` FOREIGN KEY (`id_companies`) REFERENCES `companies` (`id_companies`),
  -- ADD CONSTRAINT `people_status_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  -- ADD CONSTRAINT `people_status_people0_FK` FOREIGN KEY (`id_people`) REFERENCES `people` (`id_people`);

--
-- Contraintes pour la table `sector`
--
ALTER TABLE `sector`
  ADD CONSTRAINT `sector_sector0_FK` FOREIGN KEY (`id_sector_parent`) REFERENCES `sector` (`id_sector`);

--
-- Contraintes pour la table `to_link`
--
ALTER TABLE `to_link`
  ADD CONSTRAINT `to_link_applicant1_FK` FOREIGN KEY (`id_applicant`) REFERENCES `applicant` (`id_applicant`),
  ADD CONSTRAINT `to_link_companies2_FK` FOREIGN KEY (`id_companies`) REFERENCES `companies` (`id_companies`),
  ADD CONSTRAINT `to_link_link0_FK` FOREIGN KEY (`id_link`) REFERENCES `link` (`id_link`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO people VALUES (null,'Michel','Potiron','mp@gmail.com','$2y$10$1XcTEdjXSHAhlxixW2A3t.6uptWEYWPT0GyvD/XuCkpHPDQDWbvKu',1);
INSERT INTO people VALUES (null,'Potiron','Michel','pm@gmail.com','$2y$10$1XcTEdjXSHAhlxixW2A3t.6uptWEYWPT0GyvD/XuCkpHPDQDWbvKu',1);
INSERT INTO people VALUES (null,'Potiron','Michel','test@gmail.com','$2y$10$1XcTEdjXSHAhlxixW2A3t.6uptWEYWPT0GyvD/XuCkpHPDQDWbvKu',true);

INSERT INTO type VALUES (1,'CDD');
INSERT INTO type VALUES (2,'CDI');
INSERT INTO type VALUES (3,'Stage');
INSERT INTO type VALUES (4,'Alternace');

INSERT INTO city (label) VALUES ('Paris');
INSERT INTO city (label) VALUES ('Lyon');
INSERT INTO city (label) VALUES ('Lille');
INSERT INTO city (label) VALUES ('Nantes');

INSERT INTO sector (label) VALUES ('Informatique');
INSERT INTO sector (label, id_sector_parent) VALUES ('Programmation',1);
INSERT INTO sector (label, id_sector_parent) VALUES ('Réseaux', 1);
INSERT INTO sector (label, id_sector_parent) VALUES ('IA', 1);

INSERT INTO companies VALUES (1,'Test company','email@email.com','00 00 00 00 00','','description', 1, 1, 1,1);
INSERT INTO companies VALUES (2,'Test2 company','email2@email.com','22 00 00 00 00','','description2', 2, 2, 1,1);

INSERT INTO advertisement VALUES (1,1,'dev Web H/F',"Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page, le texte définitif venant remplacer le faux-texte dès qu'il est prêt ou que la mise en page est achevée. Généralement, on utilise un texte en faux latin, le Lorem ipsum ou Lipsum",null, 2, 1, 1, 1);
INSERT INTO advertisement VALUES (2,1,'dev IA/IV H/F',"Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire pour calibrer une mise en page, le texte définitif venant remplacer le faux-texte dès qu'il est prêt ou que la mise en page est achevée. Généralement, on utilise un texte en faux latin, le Lorem ipsum ou Lipsum",null, 1, 2, 3, 1);

INSERT INTO applicant VALUES (1, "06 01 45 68 75", "", "Je s'appelle GROOT");
INSERT INTO applicant VALUES (2, "06 01 45 68 75", "", "Je s'appelle pas GROOT");

insert into admin VALUES(1, "02 00 00 00 00");

INSERT INTO people_status VALUES (null, 1, null, 2, null);
INSERT INTO people_status VALUES (null, 2, null, 1, null);
INSERT INTO people_status VALUES (NULL,3,1,NULL,NULL);