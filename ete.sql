-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 22 nov. 2021 à 09:25
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ete`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `avatar` text,
  `couleur` int(11) NOT NULL DEFAULT '0',
  `derniereConnexion` datetime DEFAULT NULL,
  `nbJours` int(11) NOT NULL,
  `avancementJeu` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `DonneesJeuMatrice` text,
  `DonneesJeuCroises` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `prenom`, `nom`, `avatar`, `couleur`, `derniereConnexion`, `nbJours`, `avancementJeu`, `score`, `DonneesJeuMatrice`, `DonneesJeuCroises`) VALUES
(1, 'abascop@ensc.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'Arnaud', '', '1', 1, '2021-11-22 00:00:00', 3, 2, 137, '[\"2021-11-21\",\"7.0055\",\"2021-11-22\",\"9.9245\"]', '[\"2021-11-21\",\"35.415\",\"2021-11-22\",\"69.212\"]'),
(2, 'azerty@azer.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'azert', 'azerty', '4', 4, '2021-11-22 00:00:00', 1, 1, 4, '[\"2021-11-22\",\"11.803\"]', NULL),
(3, 'arnaudbcp@gmail.com', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'zoé', 'minondo', '4', 4, '2021-11-21 00:00:00', 1, 0, 0, NULL, NULL),
(4, 'ghj@ghj', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'bhjk', 'arnaud', '4', 4, '2021-11-15 15:30:23', 0, 0, 0, NULL, NULL),
(5, 'mrouffelaer@ensc.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'bascop', 'arnaud', '4', 4, '2021-11-22 00:00:00', 1, 1, 21, '[\"2021-11-22\",\"11.8108\"]', NULL),
(6, 'sdfvg@sdfg', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'azert', 'arnaud', '4', 4, '2021-11-15 15:42:31', 0, 0, 0, NULL, NULL),
(7, 'claudine@ensc.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'dfg', 'minondo', '4', 4, '2021-11-15 15:53:45', 0, 0, 0, NULL, NULL),
(8, 'qsdf@qsdf', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'azert', 'arnaud', '4', 4, '2021-11-15 15:55:20', 0, 0, 0, NULL, NULL),
(9, 'test@test.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'Test', 'Test', '4', 4, '2021-11-15 15:59:50', 0, 0, 0, NULL, NULL),
(10, 'arnaudbscp@outlook.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'Arnaud', 'Bascop', '2', 3, '2021-11-15 16:13:43', 0, 0, 0, NULL, NULL),
(11, 'mrouf@ensc.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'marine', 'rouffelaers', '3', 1, '2021-11-17 10:45:05', 0, 0, 0, NULL, NULL),
(12, 'claudillllne@ensc.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'bascop', 'arnaud', '1', 1, '2021-11-17 13:06:29', 0, 0, 0, NULL, NULL),
(13, 'abc@abc.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'abc', 'abc', '3', 3, '2021-11-21 00:00:00', 1, 0, 0, NULL, NULL),
(14, '1234@s.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'Bush', '&lt;B&gt;Georges&lt;/B&gt;', '1', 2, '2021-11-21 00:00:00', 1, 0, 0, NULL, NULL),
(15, 't@t.fr', '$2y$10$PCb2GfDo/.k4dg3ZrRBUoOhbL1DaRL0C9Kh0Bw.IWUbjUdV5c4lwO', 'Pourvoir', 'Testons', '2', 3, '2021-11-22 00:00:00', 1, 1, 3, '[\"2021-11-22\",\"29.1465\"]', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
