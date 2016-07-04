-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 04 Juillet 2016 à 12:17
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
