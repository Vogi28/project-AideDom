-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
<<<<<<< HEAD
-- Hôte : localhost
-- Généré le :  mer. 20 nov. 2019 à 10:28
-- Version du serveur :  8.0.17-0ubuntu2
-- Version de PHP :  7.3.11-0ubuntu0.19.10.1
=======
-- Client :  localhost:3306
-- Généré le :  Lun 18 Novembre 2019 à 16:12
-- Version du serveur :  5.7.27-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.1
>>>>>>> origin/dev

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `AideDom`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login_admin` varchar(50) NOT NULL,
  `mdp_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
=======
-- --------------------------------------------------------

--
-- Structure de la table `categorie_demandeur`
--

CREATE TABLE `categorie_demandeur` (
  `id` int(11) NOT NULL,
  `categorie_demandeur` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_service`
--

CREATE TABLE `categorie_service` (
  `id` int(11) NOT NULL,
  `categorie_service` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `demandeur`
--

CREATE TABLE `demandeur` (
  `id` int(11) NOT NULL,
  `id_cat_demandeur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `societe` varchar(50) DEFAULT NULL,
  `siret` varchar(20) DEFAULT NULL,
  `telephone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `details_presta`
--

CREATE TABLE `details_presta` (
  `id` int(11) NOT NULL,
  `id_prestation` int(11) NOT NULL,
  `id_categorie_service` int(11) NOT NULL,
  `nb_heures_menages` int(11) NOT NULL,
  `surface_menage` int(11) NOT NULL,
  `details_menage` text NOT NULL,
  `nnb_heures_repassage` int(11) NOT NULL,
  `poids_coton` int(11) NOT NULL,
  `poids_autres` int(11) NOT NULL,
  `poids_linge_lit` int(11) NOT NULL,
  `poids_linge_table` int(11) NOT NULL,
  `nb_heures_jardin` int(11) NOT NULL,
  `surface_jardin` int(11) NOT NULL,
  `details_jardinage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `id` int(11) NOT NULL,
  `id_demandeur` int(11) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `commune` varchar(50) NOT NULL,
  `etage` int(11) NOT NULL,
  `num_appart` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `prestation`
--

CREATE TABLE `prestation` (
  `id` int(11) NOT NULL,
  `id_demandeur` int(11) NOT NULL,
  `id_lieu` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `id_prestation` int(11) NOT NULL,
  `id_demandeur` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

>>>>>>> origin/dev
--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
<<<<<<< HEAD
-- AUTO_INCREMENT pour les tables déchargées
=======
-- Index pour la table `categorie_demandeur`
--
ALTER TABLE `categorie_demandeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_service`
--
ALTER TABLE `categorie_service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demandeur`
--
ALTER TABLE `demandeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat_demandeur` (`id_cat_demandeur`);

--
-- Index pour la table `details_presta`
--
ALTER TABLE `details_presta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prestation` (`id_prestation`),
  ADD KEY `id_categorie_service` (`id_categorie_service`);

--
-- Index pour la table `Lieu`
--
ALTER TABLE `Lieu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_demandeur` (`id_demandeur`) USING BTREE;

--
-- Index pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_demandeur` (`id_demandeur`),
  ADD KEY `id_lieu` (`id_lieu`);

--
-- Index pour la table `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prestation` (`id_prestation`),
  ADD KEY `id_demandeur` (`id_demandeur`);

--
-- AUTO_INCREMENT pour les tables exportées
>>>>>>> origin/dev
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
<<<<<<< HEAD
COMMIT;
=======
--
-- AUTO_INCREMENT pour la table `categorie_demandeur`
--
ALTER TABLE `categorie_demandeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categorie_service`
--
ALTER TABLE `categorie_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `demandeur`
--
ALTER TABLE `demandeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `details_presta`
--
ALTER TABLE `details_presta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Lieu`
--
ALTER TABLE `Lieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `prestation`
--
ALTER TABLE `prestation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Review`
--
ALTER TABLE `Review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `demandeur`
--
ALTER TABLE `demandeur`
  ADD CONSTRAINT `demandeur_ibfk_1` FOREIGN KEY (`id_cat_demandeur`) REFERENCES `categorie_demandeur` (`id`);

--
-- Contraintes pour la table `details_presta`
--
ALTER TABLE `details_presta`
  ADD CONSTRAINT `details_presta_ibfk_1` FOREIGN KEY (`id_prestation`) REFERENCES `prestation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `details_presta_ibfk_2` FOREIGN KEY (`id_categorie_service`) REFERENCES `categorie_service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Lieu`
--
ALTER TABLE `Lieu`
  ADD CONSTRAINT `Lieu_ibfk_1` FOREIGN KEY (`id_demandeur`) REFERENCES `demandeur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `prestation`
--
ALTER TABLE `prestation`
  ADD CONSTRAINT `prestation_ibfk_1` FOREIGN KEY (`id_demandeur`) REFERENCES `demandeur` (`id`),
  ADD CONSTRAINT `prestation_ibfk_2` FOREIGN KEY (`id_lieu`) REFERENCES `Lieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Review`
--
ALTER TABLE `Review`
  ADD CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`id_prestation`) REFERENCES `prestation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
>>>>>>> origin/dev

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
