-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 03 Avril 2016 à 15:08
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `comptes`
--

-- --------------------------------------------------------

--
-- Structure de la table `allocations`
--

CREATE TABLE IF NOT EXISTS `allocations` (
  `IdAllocation` int(20) NOT NULL AUTO_INCREMENT,
  `IdEtablissement` int(20) NOT NULL,
  `montantBrut` decimal(20,2) NOT NULL,
  `montantNet` decimal(20,2) NOT NULL,
  `dateVersement` date NOT NULL,
  `paiementTiers` tinyint(1) NOT NULL,
  `Created` date NOT NULL,
  PRIMARY KEY (`IdAllocation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `employeur`
--

CREATE TABLE IF NOT EXISTS `employeur` (
  `IdEmployeur` int(20) NOT NULL AUTO_INCREMENT,
  `RaisonSociale` varchar(30) NOT NULL,
  `Adresse` text NOT NULL,
  `CodePostal` int(5) NOT NULL,
  `Ville` varchar(50) NOT NULL,
  `Created` date NOT NULL,
  PRIMARY KEY (`IdEmployeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Contenu de la table `employeur`
--

INSERT INTO `employeur` (`IdEmployeur`, `RaisonSociale`, `Adresse`, `CodePostal`, `Ville`, `Created`) VALUES
(68, 'Quasar Conseil', '115 avenue Paul PainLevé', 86100, 'Chatellerault', '2016-04-02'),
(69, 'Snri', 'Chemin du treuil CS40107', 16700, 'Ruffec', '2016-04-03');

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE IF NOT EXISTS `etablissement` (
  `IdEtablissement` int(20) NOT NULL AUTO_INCREMENT,
  `RaisonSociale` varchar(30) NOT NULL,
  `TypePresta` varchar(30) NOT NULL,
  `Created` date NOT NULL,
  PRIMARY KEY (`IdEtablissement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `salaires`
--

CREATE TABLE IF NOT EXISTS `salaires` (
  `IdSalaire` int(20) NOT NULL AUTO_INCREMENT,
  `IdEmployeur` int(20) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `datePaie` date NOT NULL,
  `montantBrut` decimal(20,2) NOT NULL,
  `montantNet` decimal(20,2) NOT NULL,
  `montantNetImp` decimal(20,2) NOT NULL,
  `nbreHeureMois` decimal(20,2) NOT NULL,
  `nbreHeureTotal` decimal(20,2) NOT NULL,
  `divers` varchar(30) NOT NULL,
  `Created` date NOT NULL,
  PRIMARY KEY (`IdSalaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table des salaires' AUTO_INCREMENT=21 ;

--
-- Contenu de la table `salaires`
--

INSERT INTO `salaires` (`IdSalaire`, `IdEmployeur`, `dateDebut`, `dateFin`, `datePaie`, `montantBrut`, `montantNet`, `montantNetImp`, `nbreHeureMois`, `nbreHeureTotal`, `divers`, `Created`) VALUES
(1, 68, '2015-09-14', '2015-09-30', '2015-09-30', '874.51', '687.59', '702.21', '91.00', '91.00', '', '2016-04-02'),
(2, 68, '2015-10-01', '2015-10-31', '2015-10-30', '1457.55', '1102.03', '1170.40', '151.67', '242.67', '', '2016-04-02'),
(3, 68, '2015-11-01', '2015-11-30', '2015-11-30', '1457.52', '1085.00', '1170.37', '151.67', '394.34', '', '2016-04-02'),
(4, 68, '2015-12-01', '2015-12-31', '2015-12-31', '1457.52', '1095.20', '1170.37', '130.67', '525.01', '', '2016-04-02'),
(5, 68, '2016-01-01', '2016-01-31', '2016-01-31', '1466.65', '1107.59', '1257.03', '151.67', '151.67', '', '2016-04-03'),
(6, 68, '2016-02-01', '2016-02-29', '2016-02-29', '1466.65', '1080.39', '1257.03', '151.67', '303.34', '', '2016-04-03'),
(7, 68, '2016-03-01', '2016-03-31', '2016-03-31', '1466.65', '1076.99', '1264.66', '144.67', '448.01', '', '2016-04-03'),
(8, 69, '2014-08-01', '2014-08-31', '2014-08-31', '3325.57', '2313.42', '2675.43', '132.62', '1130.69', '', '2016-04-03'),
(9, 69, '2014-07-01', '2014-07-31', '2014-07-31', '1742.68', '1282.33', '1400.84', '152.46', '978.23', '', '2016-04-03'),
(10, 69, '2014-06-01', '2014-06-30', '2014-06-30', '2545.68', '1287.59', '2047.41', '138.60', '839.63', '', '2016-04-03'),
(12, 69, '2014-05-01', '2014-05-31', '2014-05-31', '1742.68', '1282.33', '1400.84', '131.67', '707.96', '', '2016-04-03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
