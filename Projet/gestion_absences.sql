-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 14 fév. 2025 à 17:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_absences`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

CREATE TABLE `absences` (
  `id` int(11) NOT NULL,
  `stagiaire_id` int(11) NOT NULL,
  `date_absence` date NOT NULL,
  `cours` varchar(100) NOT NULL,
  `raison` text DEFAULT NULL,
  `justifie` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `absences`
--

INSERT INTO `absences` (`id`, `stagiaire_id`, `date_absence`, `cours`, `raison`, `justifie`) VALUES
(1, 1, '2025-01-14', 'jjks', '', 1),
(2, 1, '2025-01-14', 'français', 'asssaaa', 1),
(6, 1, '2025-01-18', 'anglais', 'bbb', 1),
(7, 2, '2025-01-17', 'fgqsdtsdt', 'rterteryter', 0),
(10, 2, '2025-02-22', 'phy', 'zzzz', 1),
(11, 1, '2025-02-13', 'java', 'gfygjhkkl', 1),
(12, 1, '2025-02-07', 'aa', 'aaa', 1),
(13, 1, '2025-02-09', 'aa', 'aaa', 0),
(14, 1, '2025-02-19', 'aa', 'aaa', 0),
(15, 1, '2025-02-20', 'aa', 'aa', 0),
(16, 1, '2025-02-14', 'aa', 'aa', 0),
(17, 1, '2025-02-21', 'aa', 'aaa', 0),
(18, 1, '2025-02-14', 'français', '', 0),
(19, 1, '2025-02-15', 'sss', '', 0),
(20, 1, '2025-02-14', 'aaaaaa', '', 0),
(21, 1, '2025-02-19', 'sss', '', 0),
(22, 1, '2025-02-19', 'ssss', '', 0),
(23, 1, '2025-02-20', 'ssss', '', 0),
(24, 1, '2025-02-15', 'sss', '', 0),
(25, 4, '2025-02-08', 'arabe', '', 0),
(26, 4, '2025-02-10', 'fr', '', 0),
(27, 4, '2025-02-12', 'mat', '', 0),
(28, 4, '2025-02-14', 'phy', '', 0),
(29, 4, '2025-02-18', 'aa', '', 0),
(30, 4, '2025-02-18', 'aa', '', 0),
(31, 4, '2025-02-20', 'ss', '', 0),
(32, 4, '2025-02-18', 'zz', '', 0),
(33, 4, '2025-02-21', 'qq', '', 0),
(34, 4, '2025-02-21', 'dd', '', 0),
(35, 5, '2025-02-08', 'aq', '', 0),
(36, 5, '2025-02-18', 'ff', '', 0),
(37, 5, '2025-02-21', 'qqqdd', '', 0),
(38, 1, '2025-02-19', 'français', '', 0),
(39, 1, '2025-02-13', 'qq', '', 0),
(40, 1, '2025-02-21', 'eee', '', 0),
(41, 1, '2025-02-21', 'yyy', '', 0),
(42, 3, '2025-02-06', 'qqq', '', 0),
(43, 2, '2025-02-20', 'qqq', '', 0),
(44, 3, '2025-02-13', 'qqq', '', 0),
(45, 3, '2025-02-21', 'qqq', 'qq', 0),
(46, 7, '2025-02-14', 'aa', '', 0),
(47, 7, '2025-02-19', 'aa', '', 0),
(48, 7, '2025-02-28', 'aaa', '', 0),
(49, 7, '2025-02-27', 'aaa', '', 0),
(50, 1, '2025-02-26', 'français', '', 0),
(51, 1, '2025-02-20', 'aa', '', 0),
(52, 1, '2025-02-13', 'aa', '', 0),
(53, 1, '2025-02-13', 'français', '', 0),
(54, 1, '2025-02-20', 'français', '', 0),
(55, 1, '2025-02-23', 'français', '', 0),
(56, 1, '2025-02-20', 'français', '', 0),
(57, 7, '2025-02-12', 'qqq', '', 0),
(58, 7, '2025-02-14', 'français', '', 0),
(59, 7, '2025-02-20', 'français', '', 0),
(60, 7, '2025-02-27', 'sss', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_notification` timestamp NOT NULL DEFAULT current_timestamp(),
  `lu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `utilisateur_id`, `message`, `date_notification`, `lu`) VALUES
(1, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:01:04', 0),
(2, 4, 'Attention ! Le stagiaire a dépassé 3 absences.', '2025-02-08 19:01:05', 0),
(3, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:01:05', 0),
(4, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:01:19', 0),
(5, 4, 'Attention ! Le stagiaire a dépassé 3 absences.', '2025-02-08 19:01:20', 0),
(6, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:01:20', 0),
(7, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:01:37', 0),
(8, 4, 'Attention ! Le stagiaire a dépassé 3 absences.', '2025-02-08 19:01:37', 0),
(9, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:01:38', 0),
(10, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:01:49', 0),
(11, 4, 'Attention ! Le stagiaire a dépassé 3 absences.', '2025-02-08 19:01:49', 0),
(12, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:01:49', 0),
(13, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:01', 0),
(14, 4, 'Attention ! Le stagiaire a dépassé 3 absences.', '2025-02-08 19:02:01', 0),
(15, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:01', 0),
(16, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:14', 0),
(17, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:14', 0),
(18, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:25', 0),
(19, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:25', 0),
(20, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:36', 0),
(21, 5, 'Attention ! Le stagiaire a dépassé 3 absences.', '2025-02-08 19:02:36', 1),
(22, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:36', 0),
(23, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:50', 0),
(24, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:02:54', 0),
(25, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:09:51', 0),
(26, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:11:32', 0),
(27, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:11:59', 0),
(28, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:12:09', 0),
(29, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:14:38', 0),
(30, 1, 'Attention ! Le stagiaire  a dépassé 3 absences.', '2025-02-08 19:15:44', 0),
(31, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:18:34', 0),
(32, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:18:53', 0),
(33, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:21:10', 0),
(34, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:24:36', 0),
(35, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:24:37', 0),
(36, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:24:39', 0),
(37, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:24:41', 0),
(38, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:24:42', 0),
(39, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:25:51', 0),
(40, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:25:56', 0),
(41, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:25:57', 0),
(42, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:26:14', 0),
(43, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:26:17', 0),
(44, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:26:56', 0),
(45, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:26:57', 0),
(46, 1, 'Attention ! Le stagiaire  dépassé 3 absences.', '2025-02-08 19:26:58', 0),
(47, 1, 'Attention ! Le stagiaire ID 1 a dépassé 3 absences.', '2025-02-08 19:34:48', 0),
(48, 1, 'Attention ! Le stagiaire ID 1 a dépassé 3 absences.', '2025-02-08 19:34:58', 0),
(49, 1, 'Attention ! Le stagiaire ID 1 a dépassé 3 absences.', '2025-02-08 19:35:07', 0),
(50, 1, 'Attention ! Le stagiaire ID 1 a dépassé 3 absences.', '2025-02-08 19:35:22', 0),
(51, 1, 'Attention ! Le stagiaire ID 2 a dépassé 3 absences.', '2025-02-08 19:35:52', 0),
(52, 1, 'Attention ! Le stagiaire ID 3 a dépassé 3 absences.', '2025-02-08 19:36:11', 0),
(53, 1, 'Attention ! Le stagiaire mali kamal a dépassé 3 absences.', '2025-02-08 19:40:05', 0),
(54, 1, 'Attention ! Le stagiaire mali kamal a dépassé 3 absences.', '2025-02-08 19:40:16', 0),
(55, 1, 'Attention ! Le stagiaire hamza izend a dépassé 3 absences.', '2025-02-10 20:35:48', 0),
(56, 1, 'Attention ! Le stagiaire hamza izend a dépassé 3 absences.', '2025-02-10 20:35:59', 0),
(57, 1, 'Attention ! Le stagiaire hamza izend a dépassé 3 absences.', '2025-02-10 20:36:15', 0),
(58, 1, '⚠️ Le stagiaire hamza izend a dépassé 3 absences.', '2025-02-12 20:47:09', 0),
(59, 1, '⚠️ Le stagiaire hamza izend a dépassé 3 absences.', '2025-02-12 20:47:18', 0),
(60, 1, '⚠️ Le stagiaire hamza izend a dépassé 3 absences.', '2025-02-12 20:47:28', 0),
(61, 1, '⚠️ Le stagiaire hamza izend a dépassé 3 absences.', '2025-02-12 20:47:38', 0),
(62, 1, '⚠️ Le stagiaire mali kamal a dépassé 3 absences.', '2025-02-12 20:49:03', 0),
(63, 1, '⚠️ Le stagiaire mali kamal a dépassé 3 absences.', '2025-02-12 20:49:14', 0),
(64, 1, '⚠️ Le stagiaire mali kamal a dépassé 3 absences.', '2025-02-12 20:49:27', 0),
(65, 1, '⚠️ Le stagiaire mali kamal a dépassé 3 absences.', '2025-02-12 20:49:38', 0);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaires`
--

CREATE TABLE `stagiaires` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `programme` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stagiaires`
--

INSERT INTO `stagiaires` (`id`, `nom`, `prenom`, `programme`, `email`, `date_inscription`) VALUES
(1, 'hamza', 'izend', 'etude', 'hamza@hky.com', '2025-01-31 19:41:39'),
(2, 'hhfihgd', 'hjfdh', 'iojh', 'joik@kjfk.com', '2025-01-31 19:44:12'),
(3, 'fdtefte', 'reyrtyrtyt', 'yrthgrhrt', 'gfgh@ityuity', '2025-01-31 21:02:18'),
(4, 'mansouri', 'khalid', 'java', 'khalidmansouri@gmail.com', '2025-02-01 20:34:44'),
(5, 'aa', 'aa', 'aaaaa', 'aaaa@aaaa.com', '2025-02-06 20:16:48'),
(6, 'zz', 'zz', 'zz', 'zz@zzz.com', '2025-02-06 20:19:51'),
(7, 'mali', 'kamal', 'info', 'kamal@gmail.com', '2025-02-08 19:38:51');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('administrateur','professeur') NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`, `date_creation`) VALUES
(1, 'izend', 'hamza', 'hamza@gmail.com', '$2y$10$ZJq4p00Qo9M5L167GaL9.esAcG17eh/YL0K8VIiV/OgRqI6CKjN5G', 'administrateur', '2025-01-31 20:04:20'),
(3, 'hamid', 'aa', 'mohammeddddxmansouri@gmail.com', '$2y$10$cd8nWhf97Xv2ZinfQetUL.eS0hEJrI94a0SAVn5UzhKonp027sxGS', 'administrateur', '2025-01-31 20:04:38'),
(4, 'hamza', 'izend', 'hamzaiz@gmail.com', '$2y$10$axtB.5yHuPcaCK64s3An0uDF8hvFpYXvD.Dr/yX28CX7usK6OaORq', 'professeur', '2025-01-31 20:21:47'),
(5, 'ahmed', 'ghali', 'ahmedghali@gmail.com', '$2y$10$puTXUp2qxYIrJwWFWJGJ4O3DBYqLvQNVzzH5rE6AbQFMGLg1uGxmS', 'professeur', '2025-02-01 19:58:06'),
(6, 'taoussi', 'amine', 'aminetaoussi@gmail.com', '$2y$10$lmkkDgvmWYoO9C2Lz3rfh.y9VxRNNIOrvDaJFUiMdVoUZhD19yA8W', 'administrateur', '2025-02-01 20:29:57');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stagiaire_id` (`stagiaire_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_ibfk_1` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
