-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 08 Janvier 2014 à 19:04
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `canneapeche`
--
CREATE DATABASE IF NOT EXISTS `canneapeche` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `canneapeche`;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `statut` enum('actif','inactif','detruit') NOT NULL,
  `nom` varchar(50) NOT NULL,
  `imageFacade` varchar(200) NOT NULL,
  `imageInterieur1` varchar(200) NOT NULL,
  `imageInterieur2` varchar(200) NOT NULL,
  `imageInterieur3` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `nombre_de_chambre` tinyint(4) NOT NULL,
  `nombre_de_salle_de_bain` tinyint(4) NOT NULL,
  `emplacement` varchar(50) NOT NULL,
  `prix_par_jour` float NOT NULL,
  `prix_par_semaine` float NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `nombre_de_semaine` tinyint(4) NOT NULL,
  `nom_carte` enum('Mastercard','Visa','American Express') NOT NULL,
  `numero_carte` int(11) NOT NULL,
  `id_carte` int(11) NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `statiques`
--

CREATE TABLE IF NOT EXISTS `statiques` (
  `id_statique` int(11) NOT NULL AUTO_INCREMENT,
  `statut` enum('actif','inactif','detruit') NOT NULL,
  `nom` varchar(35) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id_statique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `statut` enum('actif','inactif','detruit') NOT NULL,
  `courriel` varchar(40) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `mot_de_passe` varchar(30) NOT NULL,
  `date_de_naissance` date NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`),
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
