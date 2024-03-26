-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 26 mars 2024 à 23:06
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `tab_idetudiant`
--

CREATE TABLE `tab_idetudiant` (
  `ID_etudiant` bigint(20) NOT NULL COMMENT 'id auto increment',
  `maticuleEtudiant` bigint(20) NOT NULL COMMENT 'matricule universitaire etudiant',
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `anneNaissance` date NOT NULL,
  `lieuNAISSANCE` varchar(50) NOT NULL,
  `willayaResidence` varchar(20) NOT NULL,
  `univercite` varchar(50) NOT NULL,
  `specialite` varchar(40) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `timeInscription` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_admin` int(5) NOT NULL DEFAULT 0 COMMENT 'if is admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='identification d etudiant';

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tab_idetudiant`
--
ALTER TABLE `tab_idetudiant`
  ADD PRIMARY KEY (`maticuleEtudiant`),
  ADD UNIQUE KEY `ID_etudiant` (`ID_etudiant`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tab_idetudiant`
--
ALTER TABLE `tab_idetudiant`
  MODIFY `ID_etudiant` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'id auto increment', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
