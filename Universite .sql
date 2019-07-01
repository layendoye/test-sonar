-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Sam 29 Juin 2019 à 00:38
-- Version du serveur :  5.7.26-0ubuntu0.18.04.1
-- Version de PHP :  7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Universite`
--

-- --------------------------------------------------------

--
-- Structure de la table `Batiment`
--

CREATE TABLE `Batiment` (
  `id_Batiment` int(11) NOT NULL,
  `Nom_bat` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Batiment`
--

INSERT INTO `Batiment` (`id_Batiment`, `Nom_bat`) VALUES
(1, 'Batiment 1'),
(2, 'Batiment 2'),
(3, 'Batiment 3'),
(4, 'Batiment 4'),
(9, 'Batiment 6');

-- --------------------------------------------------------

--
-- Structure de la table `Boursiers`
--

CREATE TABLE `Boursiers` (
  `id_Boursier` int(11) NOT NULL,
  `Matricule` int(100) NOT NULL,
  `id_Categ_Bourse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Boursiers`
--

INSERT INTO `Boursiers` (`id_Boursier`, `Matricule`, `id_Categ_Bourse`) VALUES
(82, 5, 1),
(83, 6, 1),
(85, 8, 1),
(86, 9, 1),
(88, 11, 1),
(89, 12, 1),
(90, 13, 1),
(91, 14, 1),
(93, 16, 1),
(96, 19, 1),
(97, 20, 1),
(99, 22, 1),
(100, 23, 1),
(101, 24, 1),
(102, 25, 1),
(103, 26, 1),
(104, 10, 1),
(106, 29, 1),
(75, 2, 2),
(80, 4, 2),
(92, 1, 2),
(98, 21, 2),
(105, 28, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Categorie_Bourse`
--

CREATE TABLE `Categorie_Bourse` (
  `id_Categ_Bourse` int(11) NOT NULL,
  `Libelle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Montant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Categorie_Bourse`
--

INSERT INTO `Categorie_Bourse` (`id_Categ_Bourse`, `Libelle`, `Montant`) VALUES
(1, 'Bourse complète', 40000),
(2, 'Demi-pension', 20000);

-- --------------------------------------------------------

--
-- Structure de la table `Chambres`
--

CREATE TABLE `Chambres` (
  `id_Chambre` int(11) NOT NULL,
  `Numero_Ch` int(11) NOT NULL,
  `id_Batiment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Chambres`
--

INSERT INTO `Chambres` (`id_Chambre`, `Numero_Ch`, `id_Batiment`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(12, 4, 1),
(13, 5, 1),
(14, 6, 1),
(15, 7, 1),
(5, 1, 2),
(6, 2, 2),
(16, 3, 2),
(17, 4, 2),
(18, 5, 2),
(19, 6, 2),
(21, 1, 4),
(22, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Etudiants`
--

CREATE TABLE `Etudiants` (
  `Matricule` int(100) NOT NULL,
  `Nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Naissance` date NOT NULL,
  `Email` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telephone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Etudiants`
--

INSERT INTO `Etudiants` (`Matricule`, `Nom`, `Prenom`, `Naissance`, `Email`, `Telephone`) VALUES
(1, 'Ndoye', 'Abdoulaye', '2019-06-17', 'layendoyesn@gmail.com', 771050106),
(2, 'Diop', 'Maimouna', '2019-06-22', 'maimou@gmail.com', 774563621),
(3, 'Ndoye', 'Assane', '2019-06-19', 'azou@gmail.com', 779398484),
(4, 'Ndoye', 'Oumou', '2019-06-04', 'OKN@gmail.com', 775462535),
(5, 'Ndiaye', 'Omar', '2019-05-27', 'omar@gmail.com', 771524623),
(6, 'Mbaye', 'Ndiaga', '2019-06-02', 'Ndiaga@gmail.com', 77456525),
(7, 'Thiam', 'Astou', '2019-06-02', 'astou@gmail.com', 774521365),
(8, 'Fall', 'Lala', '2019-06-01', 'lala@hotmail.com', 701425684),
(9, 'Seck', 'Mor', '2019-05-29', 'Mor@gmail.com', 778456532),
(10, 'Diop', 'Ousmane', '2019-05-30', 'ous@gmail.com', 774215356),
(11, 'Ba', 'Abdoul', '2019-05-10', 'Abdou@gmail.com', 771546253),
(12, 'Ndoye', 'Astou', '2019-06-07', 'astou@gmail.com', 774536254),
(13, 'Diop', 'Ousmane', '2019-06-07', 'ousm2@gmail.com', 77452545),
(14, 'Ba', 'Omar', '2019-06-06', 'ousm2@gmail.com', 774525547),
(15, 'Ba', 'Abdou', '2019-01-01', 'abBa@gmail.com', 77452135),
(16, 'Ndoye', 'Abdoulaye', '2019-06-16', 'abdouNd@gmail.com', 779055107),
(19, 'Ndoye', 'Oumou', '2019-06-04', 'OKN@gmail.com', 775462535),
(20, 'Seck', 'Matar', '2019-05-31', 'matar@gmail.com', 774521365),
(21, 'Ndao', 'Amadou', '2019-06-01', 'amadou@gmail.com', 774512026),
(22, 'Ndiaye', 'Makhtar', '2019-06-04', 'makhou@gmail.com', 701425364),
(23, 'Ndiaye', 'Amadou', '2019-06-05', 'amadou@gmail.com', 777854631),
(24, 'Ly', 'Abdou', '2019-06-08', 'al@gmail.com', 774123438),
(25, 'Diop', 'Assane', '2019-06-06', 'aDiop@gmail.com', 701236584),
(26, 'Pouye', 'Fama', '2019-05-28', 'faP@gmail.com', 776412357),
(27, 'Sall', 'Cheikh', '2019-05-30', 'cheikh@gmail.com', 77100),
(28, 'Ndoye', 'Abdoulaye', '2019-06-17', 'layendoyesn@gmail.com', 771050106),
(29, 'Ndiaye', 'Aminata', '2019-05-29', 'ndiayeAminata@gmail.com', 774138798);

-- --------------------------------------------------------

--
-- Structure de la table `Loges`
--

CREATE TABLE `Loges` (
  `id_Loge` int(11) NOT NULL,
  `Matricule` int(100) NOT NULL,
  `id_Chambre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Loges`
--

INSERT INTO `Loges` (`id_Loge`, `Matricule`, `id_Chambre`) VALUES
(23, 12, 2),
(26, 14, 3),
(25, 13, 5),
(20, 9, 13),
(32, 20, 15),
(31, 1, 16),
(38, 28, 16),
(30, 19, 17),
(19, 8, 18),
(22, 11, 18),
(36, 26, 21),
(37, 10, 21),
(27, 16, 22),
(33, 23, 22),
(34, 24, 22),
(39, 29, 22);

-- --------------------------------------------------------

--
-- Structure de la table `Non_Boursiers`
--

CREATE TABLE `Non_Boursiers` (
  `id_Non_Boursiers` int(11) NOT NULL,
  `Matricule` int(11) NOT NULL,
  `Adresse` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Non_Boursiers`
--

INSERT INTO `Non_Boursiers` (`id_Non_Boursiers`, `Matricule`, `Adresse`) VALUES
(2, 3, 'NF'),
(3, 7, 'NF'),
(5, 15, 'Ouakam'),
(6, 27, 'sac');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Batiment`
--
ALTER TABLE `Batiment`
  ADD PRIMARY KEY (`id_Batiment`);

--
-- Index pour la table `Boursiers`
--
ALTER TABLE `Boursiers`
  ADD PRIMARY KEY (`id_Boursier`,`Matricule`),
  ADD KEY `id_Categ_Bourse` (`id_Categ_Bourse`),
  ADD KEY `Matricule` (`Matricule`);

--
-- Index pour la table `Categorie_Bourse`
--
ALTER TABLE `Categorie_Bourse`
  ADD PRIMARY KEY (`id_Categ_Bourse`);

--
-- Index pour la table `Chambres`
--
ALTER TABLE `Chambres`
  ADD PRIMARY KEY (`id_Chambre`,`Numero_Ch`,`id_Batiment`),
  ADD KEY `id_Batiment` (`id_Batiment`);

--
-- Index pour la table `Etudiants`
--
ALTER TABLE `Etudiants`
  ADD PRIMARY KEY (`Matricule`);

--
-- Index pour la table `Loges`
--
ALTER TABLE `Loges`
  ADD PRIMARY KEY (`id_Loge`,`Matricule`),
  ADD KEY `Loges_ibfk_1` (`id_Chambre`),
  ADD KEY `Matricule` (`Matricule`);

--
-- Index pour la table `Non_Boursiers`
--
ALTER TABLE `Non_Boursiers`
  ADD PRIMARY KEY (`id_Non_Boursiers`,`Matricule`),
  ADD KEY `Matricule` (`Matricule`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Batiment`
--
ALTER TABLE `Batiment`
  MODIFY `id_Batiment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `Boursiers`
--
ALTER TABLE `Boursiers`
  MODIFY `id_Boursier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT pour la table `Categorie_Bourse`
--
ALTER TABLE `Categorie_Bourse`
  MODIFY `id_Categ_Bourse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Chambres`
--
ALTER TABLE `Chambres`
  MODIFY `id_Chambre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `Loges`
--
ALTER TABLE `Loges`
  MODIFY `id_Loge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `Non_Boursiers`
--
ALTER TABLE `Non_Boursiers`
  MODIFY `id_Non_Boursiers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Boursiers`
--
ALTER TABLE `Boursiers`
  ADD CONSTRAINT `Boursiers_ibfk_2` FOREIGN KEY (`id_Categ_Bourse`) REFERENCES `Categorie_Bourse` (`id_Categ_Bourse`),
  ADD CONSTRAINT `Boursiers_ibfk_3` FOREIGN KEY (`Matricule`) REFERENCES `Etudiants` (`Matricule`);

--
-- Contraintes pour la table `Chambres`
--
ALTER TABLE `Chambres`
  ADD CONSTRAINT `Chambres_ibfk_1` FOREIGN KEY (`id_Batiment`) REFERENCES `Batiment` (`id_Batiment`);

--
-- Contraintes pour la table `Loges`
--
ALTER TABLE `Loges`
  ADD CONSTRAINT `Loges_ibfk_1` FOREIGN KEY (`id_Chambre`) REFERENCES `Chambres` (`id_Chambre`),
  ADD CONSTRAINT `Loges_ibfk_2` FOREIGN KEY (`Matricule`) REFERENCES `Etudiants` (`Matricule`);

--
-- Contraintes pour la table `Non_Boursiers`
--
ALTER TABLE `Non_Boursiers`
  ADD CONSTRAINT `Non_Boursiers_ibfk_1` FOREIGN KEY (`Matricule`) REFERENCES `Etudiants` (`Matricule`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
