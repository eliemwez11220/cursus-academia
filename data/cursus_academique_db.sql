-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 14 sep. 2023 à 05:36
-- Version du serveur : 8.0.30
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cursus_academique_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `ts_acces`
--

CREATE TABLE `ts_acces` (
  `acces_uid` varchar(75) NOT NULL,
  `acces_libelle` varchar(75) DEFAULT NULL,
  `acces_type` varchar(50) DEFAULT NULL COMMENT '(allow | deny)',
  `acces_observation` text,
  `acces_status` varchar(25) DEFAULT NULL COMMENT '(actif | inactif)',
  `acces_ordre` int DEFAULT NULL,
  `acces_created_at` datetime DEFAULT NULL,
  `acces_updated_at` datetime DEFAULT NULL,
  `acces_deleted_at` datetime DEFAULT NULL,
  `acces_created_by` varchar(75) DEFAULT NULL,
  `acces_updated_by` varchar(75) DEFAULT NULL,
  `acces_deleted_by` varchar(75) DEFAULT NULL,
  `acces_annee_uid` varchar(75) DEFAULT NULL,
  `acces_ecole_uid` varchar(75) DEFAULT NULL,
  `acces_objet` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_admins`
--

CREATE TABLE `ts_admins` (
  `admin_uid` varchar(75) NOT NULL,
  `admin_fullname` varchar(75) NOT NULL,
  `admin_email` varchar(75) NOT NULL,
  `admin_password` varchar(75) NOT NULL,
  `admin_oldpass` varchar(100) DEFAULT NULL,
  `admin_statut` varchar(25) NOT NULL,
  `admin_pseudo` varchar(25) NOT NULL,
  `admin_profile` varchar(25) DEFAULT 'sysadmin',
  `admin_type` varchar(25) DEFAULT 'client',
  `admin_avatar` varchar(200) DEFAULT NULL,
  `admin_created_at` datetime NOT NULL,
  `admin_ecole_uid` varchar(75) DEFAULT NULL,
  `admin_lastchange_pass` datetime DEFAULT NULL,
  `admin_updated_at` datetime DEFAULT NULL,
  `admin_session` varchar(25) DEFAULT NULL COMMENT '(online | offline | pause)',
  `admin_session_nbr` int DEFAULT NULL,
  `admin_nbr_trylogin` int DEFAULT '3',
  `admin_lastlogin_at` datetime DEFAULT NULL,
  `admin_lastlogout_at` datetime DEFAULT NULL,
  `admin_question1` varchar(75) DEFAULT NULL,
  `admin_question2` varchar(75) DEFAULT NULL,
  `admin_question3` varchar(75) DEFAULT NULL,
  `admin_reponse1` varchar(75) DEFAULT NULL,
  `admin_reponse2` varchar(75) DEFAULT NULL,
  `admin_reponse3` varchar(75) DEFAULT NULL,
  `admin_client_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_agents`
--

CREATE TABLE `ts_agents` (
  `agent_uid` varchar(75) NOT NULL,
  `agent_matricule` varchar(75) NOT NULL,
  `agent_nom` varchar(25) NOT NULL,
  `agent_prenom` varchar(25) NOT NULL,
  `agent_postnom` varchar(25) NOT NULL,
  `agent_numero_securite` varchar(75) DEFAULT NULL,
  `agent_nombre_enfants` varchar(25) DEFAULT NULL,
  `agent_nom_conjoint` varchar(25) DEFAULT NULL,
  `agent_nationalite` varchar(75) DEFAULT NULL,
  `agent_langues_parlees` varchar(75) DEFAULT NULL,
  `agent_sexe` varchar(25) DEFAULT NULL,
  `agent_secteur_uid` varchar(75) DEFAULT NULL,
  `agent_fonction_uid` varchar(75) DEFAULT NULL,
  `agent_grade_uid` varchar(75) NOT NULL,
  `agent_email` varchar(75) DEFAULT NULL,
  `agent_telephone` varchar(75) DEFAULT NULL,
  `agent_date_naissance` date DEFAULT NULL,
  `agent_lieu_naissance` varchar(75) NOT NULL,
  `agent_statut` varchar(20) NOT NULL,
  `agent_adresse` text,
  `agent_ville` varchar(75) DEFAULT NULL,
  `agent_province` varchar(75) DEFAULT NULL,
  `agent_groupe_sanguin` varchar(75) DEFAULT NULL,
  `agent_caracteristiques` text,
  `agent_observation` text,
  `agent_poids` varchar(75) DEFAULT NULL,
  `agent_taille` varchar(75) DEFAULT NULL,
  `agent_application` varchar(75) DEFAULT NULL,
  `agent_attitude` varchar(75) DEFAULT NULL,
  `agent_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `agent_updated_at` datetime DEFAULT NULL,
  `agent_deleted_at` datetime DEFAULT NULL,
  `agent_created_by` varchar(75) DEFAULT NULL,
  `agent_updated_by` varchar(75) DEFAULT NULL,
  `agent_deleted_by` varchar(75) DEFAULT NULL,
  `agent_ecole_uid` varchar(75) DEFAULT NULL,
  `agent_competences` text,
  `agent_biographie` text,
  `agent_education` text,
  `agent_date_embauche` date DEFAULT NULL,
  `agent_lieu_embauche` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_agents`
--

INSERT INTO `ts_agents` (`agent_uid`, `agent_matricule`, `agent_nom`, `agent_prenom`, `agent_postnom`, `agent_numero_securite`, `agent_nombre_enfants`, `agent_nom_conjoint`, `agent_nationalite`, `agent_langues_parlees`, `agent_sexe`, `agent_secteur_uid`, `agent_fonction_uid`, `agent_grade_uid`, `agent_email`, `agent_telephone`, `agent_date_naissance`, `agent_lieu_naissance`, `agent_statut`, `agent_adresse`, `agent_ville`, `agent_province`, `agent_groupe_sanguin`, `agent_caracteristiques`, `agent_observation`, `agent_poids`, `agent_taille`, `agent_application`, `agent_attitude`, `agent_created_at`, `agent_updated_at`, `agent_deleted_at`, `agent_created_by`, `agent_updated_by`, `agent_deleted_by`, `agent_ecole_uid`, `agent_competences`, `agent_biographie`, `agent_education`, `agent_date_embauche`, `agent_lieu_embauche`) VALUES
('202105221621692795caRFfUZ1dUkGuh', 'AM20218565', 'Ilunga', 'Patient', 'Ngoy', '52002021', '0', '', NULL, NULL, 'feminin', '202105141620966111arrz98iuwP4cib', '202105131620895997bh7lPOB4nZgFkH', '202105131620897711bU7g5RiMU42nK9', 'ilunga@ditotase.com', '+243858533285', '2020-01-01', 'LUBUMBASHI', 'actif', '25, des rosiers, Bel-Air, Lubumbashi, RDC', 'Lubumbashi', 'Haut-Katanga', 'O+', 'RAS', 'Anemique', '65kg', '1.75cm', 'Autonome', 'Trop tumide', '2021-05-22 16:13:15', '2022-10-15 15:37:44', NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz', 'Informatique, Marketing, Comptabilite, Management', 'Licencie en Sciences commerciales et Financieres de formation universitaire de l\'Universite de Lubumbashi. Diplome en commerciale informatique et gestion du complexe scolaire CHERAAD', 'Licencie en Sciences commerciales et Financieres de formation universitaire de l\'Universite de Lubumbashi. Diplome en commerciale informatique et gestion du complexe scolaire CHERAAD', '2022-06-01', ''),
('202206041654342301NcWOC5oP15K0e5', 'AM20225851', 'Kazadi', 'Jeancy', 'Mwema', '', '', 'Jeanne Kelina', NULL, NULL, 'feminin', '202206041654342037rc6Gb9nEQoITrf', '2021051316208956564n6Z9eyTiKGSA1', '202105131620897575b2sq678qI17YMY', 'kazadimj@gmail.com', '', '0000-00-00', '', 'actif', '', '', '', '', '', '', '', '', '', '', '2022-06-04 13:31:41', '2022-10-16 00:58:36', NULL, 'Mwila-Betty - Gestionnaire', 'Ilunga-Patient - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz', NULL, NULL, NULL, '0000-00-00', ''),
('202210161665876557wsli7UDgRICPhs', 'AM20222836', 'Kelina', 'jeanne', 'kenda', NULL, NULL, NULL, NULL, NULL, 'feminin', '202105141620965992cSHH2ePHVffjtC', '2021051316208956564n6Z9eyTiKGSA1', '202105131620897575b2sq678qI17YMY', 'kelina.kenda@gmail.com', '', '0000-00-00', '', 'actif', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-16 01:29:17', NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz', NULL, NULL, NULL, '0000-00-00', ''),
('202210161665876981G6oeG4jC4n6Drk', 'AM20228303', 'Mwema', 'Simon', 'Ilunga', NULL, NULL, NULL, NULL, NULL, 'masculin', '202105141620965992cSHH2ePHVffjtC', '2021051316208956564n6Z9eyTiKGSA1', '202105131620897711bU7g5RiMU42nK9', 'mwema.ilunga@yahoo.fr', '', '0000-00-00', '', 'actif', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-16 01:36:21', NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz', NULL, NULL, NULL, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Structure de la table `ts_annees`
--

CREATE TABLE `ts_annees` (
  `annee_uid` varchar(75) NOT NULL,
  `annee_code` varchar(75) NOT NULL,
  `annee_libelle` varchar(200) NOT NULL,
  `annee_statut` varchar(200) NOT NULL,
  `annee_gestionnaire` varchar(75) DEFAULT NULL,
  `annee_effectif_etudiants` int DEFAULT NULL,
  `annee_effectif_agents` int DEFAULT NULL,
  `annee_prefet` varchar(75) DEFAULT NULL,
  `annee_disciplinaire` varchar(75) DEFAULT NULL,
  `annee_directeur` varchar(75) DEFAULT NULL,
  `annee_date_ouverture` varchar(25) DEFAULT NULL,
  `annee_date_cloture` varchar(75) DEFAULT NULL,
  `annee_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `annee_updated_at` datetime DEFAULT NULL,
  `annee_deleted_at` datetime DEFAULT NULL,
  `annee_comment` text,
  `annee_created_by` varchar(75) DEFAULT NULL,
  `annee_updated_by` varchar(75) DEFAULT NULL,
  `annee_deleted_by` varchar(75) DEFAULT NULL,
  `annee_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_annees`
--

INSERT INTO `ts_annees` (`annee_uid`, `annee_code`, `annee_libelle`, `annee_statut`, `annee_gestionnaire`, `annee_effectif_etudiants`, `annee_effectif_agents`, `annee_prefet`, `annee_disciplinaire`, `annee_directeur`, `annee_date_ouverture`, `annee_date_cloture`, `annee_created_at`, `annee_updated_at`, `annee_deleted_at`, `annee_comment`, `annee_created_by`, `annee_updated_by`, `annee_deleted_by`, `annee_ecole_uid`) VALUES
('202205141652485786CkMrqvuqytlT2r', 'ANN93378', '2021-2022', 'inactif', NULL, NULL, NULL, NULL, NULL, NULL, '2022-05-14', '2022-06-18', '2022-05-14 01:49:46', NULL, NULL, NULL, 'Mwila-Betty - Gestionnaire', NULL, NULL, NULL),
('202206181655545804ULTWktFmz15L2K', 'ANN36621', '2022-2023', 'actif', NULL, NULL, NULL, NULL, NULL, NULL, '2022-06-18', NULL, '2022-06-18 11:50:04', NULL, NULL, NULL, 'Eduschool-. - Gestionnaire', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ts_branches`
--

CREATE TABLE `ts_branches` (
  `branche_uid` varchar(75) NOT NULL,
  `branche_code` varchar(50) DEFAULT NULL,
  `branche_libelle` varchar(75) NOT NULL,
  `branche_comment` text,
  `branche_statut` varchar(50) DEFAULT NULL COMMENT 'Actif, Inactif',
  `branche_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `branche_updated_at` datetime DEFAULT NULL,
  `branche_deleted_at` datetime DEFAULT NULL,
  `branche_deleted_by` varchar(75) DEFAULT NULL,
  `branche_created_by` varchar(75) DEFAULT NULL,
  `branche_updated_by` varchar(75) DEFAULT NULL,
  `branche_annee_uid` varchar(75) DEFAULT NULL,
  `branche_ecole_uid` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_branches`
--

INSERT INTO `ts_branches` (`branche_uid`, `branche_code`, `branche_libelle`, `branche_comment`, `branche_statut`, `branche_created_at`, `branche_updated_at`, `branche_deleted_at`, `branche_deleted_by`, `branche_created_by`, `branche_updated_by`, `branche_annee_uid`, `branche_ecole_uid`) VALUES
('202105171621233167GuMkMjj8wmmnRw', 'CYC70779', 'planification nutritionnelle et élaboration des projets', NULL, 'actif', '2021-05-17 08:32:47', '2022-10-16 01:06:47', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Ilunga-Patient-Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('2021051716212331923vV41H2wQLOncs', 'CYC04638', 'technologie des denrées alimentaires', NULL, 'actif', '2021-05-17 08:33:12', '2022-10-16 01:06:01', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Ilunga-Patient-Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202105171621233248msqdBTWhOlQJcn', 'CYC67661', 'nutrition humaine', NULL, 'actif', '2021-05-17 08:34:08', '2022-10-16 01:05:32', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Ilunga-Patient-Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202107241627159332ryKJOClRKhfvHt', 'CB02105', 'administration et Gestion', NULL, 'actif', '2021-07-24 22:42:12', '2022-10-16 01:04:42', NULL, NULL, 'Total Assist Admin-administrateur systeme', 'Ilunga-Patient-Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202107241627159378pFayncVwKomniV', 'CB50440', 'Anglais', NULL, 'actif', '2021-07-24 22:42:58', '2022-10-16 01:04:18', NULL, NULL, 'Total Assist Admin-administrateur systeme', 'Ilunga-Patient-Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202107251627200852R5WOH3W0SFVvvq', 'CB14178', 'informatique', NULL, 'actif', '2021-07-25 10:14:12', NULL, NULL, NULL, 'Total Assist Admin-administrateur systeme', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202210161665875495T5Zdrmt5mHSlqr', 'CB76361', 'Physiologie spéciale', NULL, 'actif', '2022-10-16 01:11:35', NULL, NULL, NULL, 'Ilunga-Patient-Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202210161665875510v3E51joOTjv6z2', 'CB65130', 'Maladies métaboliques et la diététique', NULL, 'actif', '2022-10-16 01:11:50', NULL, NULL, NULL, 'Ilunga-Patient-Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('2022101616658755217IOztENcAKoS3d', 'CB46350', 'Biochimie spéciale', NULL, 'actif', '2022-10-16 01:12:01', '2022-10-16 01:12:29', NULL, NULL, 'Ilunga-Patient-Gestionnaire', 'Ilunga-Patient-Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202210161665875604LdI4z8JZQDKr71', 'CB20952', 'Maladies de la nutrition et la diététique', NULL, 'actif', '2022-10-16 01:13:24', NULL, NULL, NULL, 'Ilunga-Patient-Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202210161665875675DoE6QtEbwfCnJS', 'CB22358', 'Microbiologie alimentaire', NULL, 'actif', '2022-10-16 01:14:35', NULL, NULL, NULL, 'Ilunga-Patient-Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202210161665875802sHGy3F0trMm5L9', 'CB70333', 'Pathologie spéciale', NULL, 'actif', '2022-10-16 01:16:42', NULL, NULL, NULL, 'Ilunga-Patient-Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202210161665875845GRQPkuhFFr88UV', 'CB23117', 'Biochimie des maladies métaboliques', NULL, 'actif', '2022-10-16 01:17:25', NULL, NULL, NULL, 'Ilunga-Patient-Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_bulletins`
--

CREATE TABLE `ts_bulletins` (
  `bulletin_uid` varchar(75) NOT NULL,
  `bulletin_matiere_uid` varchar(75) NOT NULL,
  `bulletin_etudiant_uid` varchar(75) NOT NULL,
  `bulletin_promotion_uid` varchar(75) NOT NULL,
  `bulletin_ecole_uid` varchar(75) NOT NULL,
  `bulletin_annee_uid` varchar(75) NOT NULL,
  `bulletin_cote_per1` decimal(10,0) DEFAULT NULL,
  `bulletin_cote_per2` decimal(10,0) DEFAULT NULL,
  `bulletin_cote_exam1` decimal(10,0) DEFAULT NULL,
  `bulletin_cote_per3` decimal(10,0) DEFAULT NULL,
  `bulletin_cote_per4` decimal(10,0) DEFAULT NULL,
  `bulletin_cote_exam2` decimal(10,0) DEFAULT NULL,
  `bulletin_cote_per5` decimal(10,0) DEFAULT NULL,
  `bulletin_cote_per6` decimal(10,0) DEFAULT NULL,
  `bulletin_cote_exam3` decimal(10,0) DEFAULT NULL,
  `bulletin_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bulletin_created_by` varchar(75) DEFAULT NULL,
  `bulletin_updated_at` datetime DEFAULT NULL,
  `bulletin_updated_by` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ts_bulletins`
--

INSERT INTO `ts_bulletins` (`bulletin_uid`, `bulletin_matiere_uid`, `bulletin_etudiant_uid`, `bulletin_promotion_uid`, `bulletin_ecole_uid`, `bulletin_annee_uid`, `bulletin_cote_per1`, `bulletin_cote_per2`, `bulletin_cote_exam1`, `bulletin_cote_per3`, `bulletin_cote_per4`, `bulletin_cote_exam2`, `bulletin_cote_per5`, `bulletin_cote_per6`, `bulletin_cote_exam3`, `bulletin_created_at`, `bulletin_created_by`, `bulletin_updated_at`, `bulletin_updated_by`) VALUES
('2022101616658789053u7IeEpns4uyVg', '202210161665877055PyMfCvIwnrGHYh', '202210161665877196kP0cGdeQzFUUdO', '202210161665876285sGApHH3RR5E64O', '20210426161941706701LLd4KS3GVRFz', '202206181655545804ULTWktFmz15L2K', '24', '0', '0', '0', '0', '0', NULL, NULL, NULL, '2022-10-16 02:08:25', 'Ilunga-Patient - Gestionnaire', '2022-10-16 02:27:27', 'Ilunga-Patient - Gestionnaire'),
('202210161665879418JDgyfnGk8Bwl2r', '202210161665876327P6i3R802k3pJgO', '202210161665877196kP0cGdeQzFUUdO', '202210161665876285sGApHH3RR5E64O', '20210426161941706701LLd4KS3GVRFz', '202206181655545804ULTWktFmz15L2K', '8', '0', '0', '0', '0', '0', NULL, NULL, NULL, '2022-10-16 02:16:58', 'Ilunga-Patient - Gestionnaire', '2022-10-16 02:16:58', 'Ilunga-Patient - Gestionnaire'),
('202210161665879503vElaH7h8N9RpEs', '202210161665877041UYdsPHgCongfLb', '202210161665877196kP0cGdeQzFUUdO', '202210161665876285sGApHH3RR5E64O', '20210426161941706701LLd4KS3GVRFz', '202206181655545804ULTWktFmz15L2K', '15', '0', '0', '0', '0', '0', NULL, NULL, NULL, '2022-10-16 02:18:23', 'Ilunga-Patient - Gestionnaire', '2022-10-16 02:18:23', 'Ilunga-Patient - Gestionnaire'),
('202210171666023387fciWmDJvG1ro3V', '202210161665877019YPRqwDlWlrrFvG', '202210171666017572urNdKrRG4OtmN7', '202210161665876285sGApHH3RR5E64O', '20210426161941706701LLd4KS3GVRFz', '202206181655545804ULTWktFmz15L2K', '15', '0', '0', '0', '0', '0', NULL, NULL, NULL, '2022-10-17 18:16:27', 'Ilunga-Patient - Gestionnaire', '2022-10-17 06:16:27', 'Ilunga-Patient - Gestionnaire'),
('202210171666023404QS3pUcYd2cVcqy', '202210161665876890N9q5EYrZI2lFDD', '202210171666017572urNdKrRG4OtmN7', '202210161665876285sGApHH3RR5E64O', '20210426161941706701LLd4KS3GVRFz', '202206181655545804ULTWktFmz15L2K', '13', '0', '0', '0', '0', '0', NULL, NULL, NULL, '2022-10-17 18:16:44', 'Ilunga-Patient - Gestionnaire', '2022-10-17 06:16:44', 'Ilunga-Patient - Gestionnaire');

-- --------------------------------------------------------

--
-- Structure de la table `ts_clients`
--

CREATE TABLE `ts_clients` (
  `client_uid` varchar(75) NOT NULL,
  `client_name` varchar(75) NOT NULL,
  `client_phone` varchar(25) NOT NULL,
  `client_email` varchar(75) NOT NULL,
  `client_address` text NOT NULL,
  `client_type` varchar(25) NOT NULL,
  `client_statut` varchar(75) DEFAULT NULL,
  `client_created_at` datetime NOT NULL,
  `client_created_by` varchar(75) NOT NULL,
  `client_updated_at` datetime DEFAULT NULL,
  `client_updated_by` varchar(75) DEFAULT NULL,
  `client_deleted_at` datetime DEFAULT NULL,
  `client_deleted_by` varchar(75) DEFAULT NULL,
  `client_city` varchar(75) NOT NULL,
  `client_country` varchar(75) NOT NULL,
  `client_comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_comptes`
--

CREATE TABLE `ts_comptes` (
  `compte_uid` varchar(75) NOT NULL,
  `compte_username` varchar(50) DEFAULT NULL,
  `compte_email` varchar(75) DEFAULT NULL,
  `compte_avatar` varchar(200) DEFAULT NULL,
  `compte_type` varchar(75) NOT NULL DEFAULT 'agent',
  `compte_password` varchar(75) DEFAULT NULL,
  `compte_password_expire` int NOT NULL DEFAULT '0',
  `compte_oldpass` varchar(75) DEFAULT NULL,
  `compte_changepass_at` varchar(25) DEFAULT NULL,
  `compte_resetpass_at` varchar(75) DEFAULT NULL,
  `compte_resetpass_by` varchar(75) DEFAULT NULL,
  `compte_resetpass_nbr` int DEFAULT NULL,
  `compte_observation` text,
  `compte_status` varchar(25) DEFAULT NULL COMMENT '(actif | inactif | blocked)',
  `compte_session` varchar(25) DEFAULT NULL COMMENT '(online | offline | pause)',
  `compte_session_nbr` int DEFAULT NULL,
  `compte_nbr_trylogin` int DEFAULT '3',
  `compte_lastlogin_at` datetime DEFAULT NULL,
  `compte_lastlogout_at` datetime DEFAULT NULL,
  `compte_activated_at` datetime DEFAULT NULL,
  `compte_created_at` datetime DEFAULT NULL,
  `compte_updated_at` datetime DEFAULT NULL,
  `compte_deleted_at` datetime DEFAULT NULL,
  `compte_created_by` varchar(75) DEFAULT NULL,
  `compte_updated_by` varchar(75) DEFAULT NULL,
  `compte_deleted_by` varchar(75) DEFAULT NULL,
  `compte_question1` varchar(75) DEFAULT NULL,
  `compte_question2` varchar(75) DEFAULT NULL,
  `compte_question3` varchar(75) DEFAULT NULL,
  `compte_reponse1` varchar(75) DEFAULT NULL,
  `compte_reponse2` varchar(75) DEFAULT NULL,
  `compte_reponse3` varchar(75) DEFAULT NULL,
  `compte_agent_uid` varchar(75) DEFAULT NULL,
  `compte_groupe_uid` varchar(75) NOT NULL,
  `compte_annee_uid` varchar(75) DEFAULT NULL,
  `compte_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_comptes`
--

INSERT INTO `ts_comptes` (`compte_uid`, `compte_username`, `compte_email`, `compte_avatar`, `compte_type`, `compte_password`, `compte_password_expire`, `compte_oldpass`, `compte_changepass_at`, `compte_resetpass_at`, `compte_resetpass_by`, `compte_resetpass_nbr`, `compte_observation`, `compte_status`, `compte_session`, `compte_session_nbr`, `compte_nbr_trylogin`, `compte_lastlogin_at`, `compte_lastlogout_at`, `compte_activated_at`, `compte_created_at`, `compte_updated_at`, `compte_deleted_at`, `compte_created_by`, `compte_updated_by`, `compte_deleted_by`, `compte_question1`, `compte_question2`, `compte_question3`, `compte_reponse1`, `compte_reponse2`, `compte_reponse3`, `compte_agent_uid`, `compte_groupe_uid`, `compte_annee_uid`, `compte_ecole_uid`) VALUES
('202105221621692967e2C1r3pE4EF26I', 'admin', 'admin@ditotase.com', NULL, 'sysadmin', '$2y$12$1T2.Bj.7vrvSuEtWuzy.9OZMwEW9734oFkGYuWtjVj//R9l3JsLKa', 0, '$2y$12$L9EKAclBxcBNw0AQJUgaK.chJm/C8UQTQx.sDJpvjlqLT6hEtwEVi', '2022-11-04 17:19:14', '2022-11-04 17:13:24', 'Admin-. - Gestionnaire', 5, 'Ce compte concerne mes infos personnelles de connexion', 'actif', 'online', 1, 3, '2023-09-12 17:47:54', '2023-09-11 19:15:56', NULL, '2021-05-22 16:16:06', '2022-03-10 16:50:18', NULL, 'Élie Mwez Rubuz - Administrateur', 'Total Assist Admin - gestionnaire', NULL, 'nom_fille_ainee', 'animal_domestique', 'marque_voiture', 'mewen', 'chien', 'harrier', '202105221621692795caRFfUZ1dUkGuh', '202203101646922024A1HnBZAJQS2eka', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_coordinations`
--

CREATE TABLE `ts_coordinations` (
  `coordination_uid` varchar(75) NOT NULL,
  `coordination_code` varchar(75) NOT NULL,
  `coordination_libelle` varchar(200) NOT NULL,
  `coordination_statut` varchar(200) NOT NULL,
  `coordination_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `coordination_updated_at` datetime DEFAULT NULL,
  `coordination_deleted_at` datetime DEFAULT NULL,
  `coordination_comment` text,
  `coordination_created_by` varchar(75) DEFAULT NULL,
  `coordination_updated_by` varchar(75) DEFAULT NULL,
  `coordination_deleted_by` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_coordinations`
--

INSERT INTO `ts_coordinations` (`coordination_uid`, `coordination_code`, `coordination_libelle`, `coordination_statut`, `coordination_created_at`, `coordination_updated_at`, `coordination_deleted_at`, `coordination_comment`, `coordination_created_by`, `coordination_updated_by`, `coordination_deleted_by`) VALUES
('202105221621669645j3BFvhLtBIVpIo', 'CTE90808', 'catholique', 'actif', '2021-05-22 09:47:25', '2021-05-22 09:50:32', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Élie Mwez Rubuz-Administrateur', NULL),
('202105221621669743SDmy3DgWomv7fP', 'CTE40469', 'methodiste', 'actif', '2021-05-22 09:49:03', NULL, NULL, NULL, 'Élie Mwez Rubuz-Administrateur', NULL, NULL),
('2021052216216697588bhqBs2O6vUtLR', 'CTE56764', 'protestante', 'actif', '2021-05-22 09:49:18', NULL, NULL, NULL, 'Élie Mwez Rubuz-Administrateur', NULL, NULL),
('202105251621939724HyLKCzFM685pgc', 'CTE67379', 'ECOLES OFFICIELLES', 'actif', '2021-05-25 12:48:44', NULL, NULL, NULL, 'Mwila-Betty-Coordonnateur', NULL, NULL),
('202105251621939789ObHsY47yf4uiIi', 'CTE09769', 'Écoles privées', 'actif', '2021-05-25 12:49:49', '2021-09-23 23:11:42', NULL, NULL, 'Mwila-Betty-Coordonnateur', 'Ilunga Kasongo Dany-Administrator', NULL),
('202105271622093745oHdmfRTrg3RczQ', 'CTE79466', 'ecole adventiste', 'actif', '2021-05-27 07:35:45', NULL, NULL, NULL, 'Mwila-Betty-Coordonnateur', NULL, NULL),
('202105271622094050MjqyQfuKKe83aM', 'CTE58856', 'ecole missionnaire', 'actif', '2021-05-27 07:40:50', NULL, NULL, NULL, 'Mwila-Betty-Coordonnateur', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ts_cotations_agents`
--

CREATE TABLE `ts_cotations_agents` (
  `cotation_uid` varchar(75) NOT NULL,
  `cotation_agent_uid` varchar(75) DEFAULT NULL,
  `cotation_periode_uid` varchar(75) DEFAULT NULL,
  `cotation_critere_uid` varchar(75) DEFAULT NULL,
  `cotation_statut` varchar(50) DEFAULT NULL COMMENT 'Actif, Inactif',
  `cotation_cote_directeur` decimal(10,2) DEFAULT NULL,
  `cotation_cote_insp_division` decimal(10,2) DEFAULT NULL,
  `cotation_cote_insp_coordination` decimal(10,2) DEFAULT NULL,
  `cotation_cote_moyenne` decimal(10,2) DEFAULT NULL,
  `cotation_description` text,
  `cotation_observation` text,
  `cotation_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `cotation_updated_at` datetime DEFAULT NULL,
  `cotation_deleted_at` datetime DEFAULT NULL,
  `cotation_deleted_by` varchar(75) DEFAULT NULL,
  `cotation_created_by` varchar(75) DEFAULT NULL,
  `cotation_updated_by` varchar(75) DEFAULT NULL,
  `cotation_annee_uid` varchar(75) DEFAULT NULL,
  `cotation_ecole_uid` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_cotes`
--

CREATE TABLE `ts_cotes` (
  `cote_uid` varchar(75) NOT NULL,
  `cote_type` varchar(25) DEFAULT 'periode',
  `cote_etudiant_uid` varchar(75) NOT NULL,
  `cote_periode_uid` varchar(75) DEFAULT NULL,
  `cote_matiere_uid` varchar(75) DEFAULT NULL,
  `cote_epreuve_uid` varchar(75) NOT NULL,
  `cote_point_obtenu` varchar(25) DEFAULT NULL,
  `cote_application` text,
  `cote_point_bonus` varchar(25) DEFAULT NULL,
  `cote_raison_bonus` text,
  `cote_statut` varchar(50) DEFAULT NULL COMMENT 'Actif, Inactif',
  `cote_observation` text,
  `cote_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `cote_updated_at` datetime DEFAULT NULL,
  `cote_deleted_at` datetime DEFAULT NULL,
  `cote_deleted_by` varchar(75) DEFAULT NULL,
  `cote_created_by` varchar(75) DEFAULT NULL,
  `cote_updated_by` varchar(75) DEFAULT NULL,
  `cote_annee_uid` varchar(75) DEFAULT NULL,
  `cote_ecole_uid` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_cotes`
--

INSERT INTO `ts_cotes` (`cote_uid`, `cote_type`, `cote_etudiant_uid`, `cote_periode_uid`, `cote_matiere_uid`, `cote_epreuve_uid`, `cote_point_obtenu`, `cote_application`, `cote_point_bonus`, `cote_raison_bonus`, `cote_statut`, `cote_observation`, `cote_created_at`, `cote_updated_at`, `cote_deleted_at`, `cote_deleted_by`, `cote_created_by`, `cote_updated_by`, `cote_annee_uid`, `cote_ecole_uid`) VALUES
('202210161665879418yZJa1A721rriAY', 'annuelle', '202210161665877196kP0cGdeQzFUUdO', '2021042516193818348l1lNV51ZKfuNY', '202210161665876327P6i3R802k3pJgO', '', '8', NULL, NULL, NULL, 'actif', NULL, '2022-10-16 02:16:58', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665879503QIH77YyNYoOno8', 'annuelle', '202210161665877196kP0cGdeQzFUUdO', '2021042516193818348l1lNV51ZKfuNY', '202210161665877041UYdsPHgCongfLb', '', '15', NULL, NULL, NULL, 'actif', NULL, '2022-10-16 02:18:23', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665880047mtqHsUNfCO7yz8', 'annuelle', '202210161665877196kP0cGdeQzFUUdO', '2021042516193818348l1lNV51ZKfuNY', '202210161665877055PyMfCvIwnrGHYh', '', '16', NULL, NULL, NULL, 'actif', NULL, '2022-10-16 02:27:27', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('2022101716660233864q5g5NsL8iJQwB', 'annuelle', '202210171666017572urNdKrRG4OtmN7', '2021042516193818348l1lNV51ZKfuNY', '202210161665877019YPRqwDlWlrrFvG', '', '15', NULL, NULL, NULL, 'actif', NULL, '2022-10-17 06:16:26', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('2022101716660234042pVcC6wgBrB05o', 'annuelle', '202210171666017572urNdKrRG4OtmN7', '2021042516193818348l1lNV51ZKfuNY', '202210161665876890N9q5EYrZI2lFDD', '', '13', NULL, NULL, NULL, 'actif', NULL, '2022-10-17 06:16:44', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_criteres_agents`
--

CREATE TABLE `ts_criteres_agents` (
  `critere_uid` varchar(75) NOT NULL,
  `critere_code` varchar(75) NOT NULL,
  `critere_libelle` varchar(200) NOT NULL,
  `critere_statut` varchar(200) NOT NULL,
  `critere_cotes_max` varchar(200) NOT NULL,
  `critere_comment` text,
  `critere_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `critere_updated_at` datetime DEFAULT NULL,
  `critere_deleted_at` datetime DEFAULT NULL,
  `critere_created_by` varchar(75) DEFAULT NULL,
  `critere_updated_by` varchar(75) DEFAULT NULL,
  `critere_deleted_by` varchar(75) DEFAULT NULL,
  `critere_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_cycles`
--

CREATE TABLE `ts_cycles` (
  `cycle_uid` varchar(75) NOT NULL,
  `cycle_code` varchar(75) NOT NULL,
  `cycle_libelle` varchar(200) NOT NULL,
  `cycle_statut` varchar(200) NOT NULL,
  `cycle_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cycle_updated_at` datetime DEFAULT NULL,
  `cycle_deleted_at` datetime DEFAULT NULL,
  `cycle_comment` text,
  `cycle_created_by` varchar(75) DEFAULT NULL,
  `cycle_updated_by` varchar(75) DEFAULT NULL,
  `cycle_deleted_by` varchar(75) DEFAULT NULL,
  `cycle_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_cycles`
--

INSERT INTO `ts_cycles` (`cycle_uid`, `cycle_code`, `cycle_libelle`, `cycle_statut`, `cycle_created_at`, `cycle_updated_at`, `cycle_deleted_at`, `cycle_comment`, `cycle_created_by`, `cycle_updated_by`, `cycle_deleted_by`, `cycle_ecole_uid`) VALUES
('202104261619410630zjBCOaWJpJreY5', 'CYC46100', 'DEA', 'actif', '2021-04-26 06:17:10', '2022-10-15 15:07:29', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202104261619410837qED5e9Zp15FVL4', 'CYC70647', 'Doctorat', 'actif', '2021-04-26 06:20:37', '2022-10-15 15:07:23', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202107311627724593mAcpavTkrB8DE9', 'CYC50340', 'Master', 'actif', '2021-07-31 11:43:13', '2022-10-15 15:07:03', NULL, NULL, 'Total Assist Admin - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202107311627724617WzaH6FtwB0GLJJ', 'CYC46110', 'Licence', 'actif', '2021-07-31 11:43:37', '2022-10-15 15:06:56', NULL, NULL, 'Total Assist Admin - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202111041636035805VqIKLgKDv9D5Md', 'CYC17012', 'graduat', 'actif', '2021-11-04 16:23:25', '2022-10-15 15:06:47', NULL, NULL, 'nicolas beya - coordonateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202207021656751563usviKUyluheLlu', 'all', 'Tout', 'actif', '2022-07-02 03:46:03', '2022-10-15 15:06:37', NULL, NULL, 'Eduschool-. - Gestionnaire', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_degrespromotions`
--

CREATE TABLE `ts_degrespromotions` (
  `degres_uid` varchar(75) NOT NULL,
  `degres_code` varchar(75) NOT NULL,
  `degres_libelle` varchar(200) NOT NULL,
  `degres_statut` varchar(200) NOT NULL,
  `degres_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `degres_updated_at` datetime DEFAULT NULL,
  `degres_deleted_at` datetime DEFAULT NULL,
  `degres_comment` text,
  `degres_created_by` varchar(75) DEFAULT NULL,
  `degres_updated_by` varchar(75) DEFAULT NULL,
  `degres_deleted_by` varchar(75) DEFAULT NULL,
  `degres_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_degrespromotions`
--

INSERT INTO `ts_degrespromotions` (`degres_uid`, `degres_code`, `degres_libelle`, `degres_statut`, `degres_created_at`, `degres_updated_at`, `degres_deleted_at`, `degres_comment`, `degres_created_by`, `degres_updated_by`, `degres_deleted_by`, `degres_ecole_uid`) VALUES
('202104251619344894plBQj6MMpiedsb', 'CCE68012', '1er Degr&eacute;s', 'actif', '2021-04-25 12:01:34', '2022-05-27 19:42:30', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Mwila-Betty - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202104251619345130lV4vqO1oOQ7JCu', 'CCE78009', '2&egrave;me Degr&eacute;s', 'actif', '2021-04-25 12:05:30', '2022-05-27 19:42:18', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Mwila-Betty - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202104251619345918c45hLhPyHKDQFn', 'CCE82930', '3&egrave;me Degr&eacute;s', 'actif', '2021-04-25 12:18:38', '2022-05-27 19:41:53', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Mwila-Betty - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106241624559683UJU4PblmGeSChe', 'CCE19274', '1&egrave;r', 'actif', '2021-06-24 20:34:43', '2021-06-24 20:36:38', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', 'Kapinga Mwinda - administrateur systeme', NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624559697VsluHISzOiAcdA', 'CCE39109', '2&egrave;me', 'actif', '2021-06-24 20:34:57', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624559713Q7unGvVBmvSFrp', 'CCE68635', '3&egrave;me', 'actif', '2021-06-24 20:35:13', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('2021062416245597261AOULUmrAlMEg3', 'CCE09810', '4&egrave;me', 'actif', '2021-06-24 20:35:26', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('2021062416245597405zEUPV4w2tfICk', 'CCE77136', '5&egrave;me', 'actif', '2021-06-24 20:35:40', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624559752Vo1pVV8iOug1fg', 'CCE33083', '6&egrave;me', 'actif', '2021-06-24 20:35:52', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('2021100516334650189Hc5hrwB2KIMSc', 'CCE80192', '1er', 'actif', '2021-10-05 22:16:58', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633465029e30FuL0iPAKOoE', 'CCE35151', '2&egrave;me', 'actif', '2021-10-05 22:17:09', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633465039ljV8UejC8L5ePv', 'CCE56008', '3&egrave;me', 'actif', '2021-10-05 22:17:19', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633465047ykH7kVBKFByqud', 'CCE13478', '4&egrave;me', 'actif', '2021-10-05 22:17:27', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633465071pJzzFd7FEPTimb', 'CCE42806', '5&egrave;me', 'actif', '2021-10-05 22:17:51', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633465086h3kNuaFy6ovva9', 'CCE64356', '6&egrave;me', 'actif', '2021-10-05 22:18:06', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202111041636036033lkB5UyLDMqLm6T', 'CCE12611', '1er degre', 'actif', '2021-11-04 16:27:13', NULL, NULL, NULL, 'nicolas beya - coordonateur', NULL, NULL, '202111041636035453PGBbdiT8ivrOlM'),
('202111041636036043b0cAKZgJ6n0Jjc', 'CCE62715', '2e degre', 'actif', '2021-11-04 16:27:23', NULL, NULL, NULL, 'nicolas beya - coordonateur', NULL, NULL, '202111041636035453PGBbdiT8ivrOlM'),
('2022052716536733702iQdflUr0FdOoV', 'CCE74349', '4&egrave;me degr&eacute;s', 'actif', '2022-05-27 19:42:50', NULL, NULL, NULL, 'Mwila-Betty - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202205271653673386gy97M0P1MFkQ6s', 'CCE97642', '5&egrave;me degr&eacute;s', 'actif', '2022-05-27 19:43:06', NULL, NULL, NULL, 'Mwila-Betty - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202205271653673405YiNuEZnr0EtyMe', 'CCE41614', '6&egrave;me degr&eacute;s', 'actif', '2022-05-27 19:43:25', NULL, NULL, NULL, 'Mwila-Betty - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202205271653684838b2RrvMplEou1Lu', 'CCE25989', '7&egrave;me degr&eacute;s', 'actif', '2022-05-27 22:53:58', NULL, NULL, NULL, 'Mwila-Betty - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202205271653684851zn82V9UqHZ5MGg', 'CCE86467', '8&egrave;me degr&eacute;s', 'actif', '2022-05-27 22:54:11', NULL, NULL, NULL, 'Mwila-Betty - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_ecoles`
--

CREATE TABLE `ts_ecoles` (
  `ecole_uid` varchar(75) NOT NULL,
  `ecole_code` varchar(75) NOT NULL,
  `ecole_libelle` varchar(200) NOT NULL,
  `typesecole_uid` varchar(75) NOT NULL,
  `typesens_uid` varchar(75) NOT NULL,
  `ecole_statut` varchar(200) NOT NULL,
  `ecole_gestionnaire` varchar(75) DEFAULT NULL,
  `ecole_coordination` varchar(75) DEFAULT NULL,
  `ecole_devise` varchar(75) DEFAULT NULL,
  `ecole_prefet` varchar(75) DEFAULT NULL,
  `ecole_disciplinaire` varchar(75) DEFAULT NULL,
  `ecole_directeur` varchar(75) DEFAULT NULL,
  `ecole_adresse` text,
  `ecole_email` varchar(75) DEFAULT NULL,
  `ecole_telephone` varchar(25) DEFAULT NULL,
  `ecole_province` varchar(75) DEFAULT NULL,
  `ecole_ville` varchar(75) DEFAULT NULL,
  `ecole_siteweb` varchar(75) DEFAULT NULL,
  `ecole_logo` varchar(200) DEFAULT NULL,
  `ecole_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ecole_updated_at` datetime DEFAULT NULL,
  `ecole_deleted_at` datetime DEFAULT NULL,
  `ecole_comment` text,
  `ecole_created_by` varchar(75) DEFAULT NULL,
  `ecole_updated_by` varchar(75) DEFAULT NULL,
  `ecole_deleted_by` varchar(75) DEFAULT NULL,
  `ecole_ecole_uid` varchar(75) DEFAULT NULL,
  `ecole_client_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_ecoles`
--

INSERT INTO `ts_ecoles` (`ecole_uid`, `ecole_code`, `ecole_libelle`, `typesecole_uid`, `typesens_uid`, `ecole_statut`, `ecole_gestionnaire`, `ecole_coordination`, `ecole_devise`, `ecole_prefet`, `ecole_disciplinaire`, `ecole_directeur`, `ecole_adresse`, `ecole_email`, `ecole_telephone`, `ecole_province`, `ecole_ville`, `ecole_siteweb`, `ecole_logo`, `ecole_created_at`, `ecole_updated_at`, `ecole_deleted_at`, `ecole_comment`, `ecole_created_by`, `ecole_updated_by`, `ecole_deleted_by`, `ecole_ecole_uid`, `ecole_client_uid`) VALUES
('20210426161941706701LLd4KS3GVRFz', 'CEC72335', 'complexe scolaire La ribambelle', '202104231619161287PcS4FO5zIGmhSC', '202104251619334206tJiA5Z3na1vgKb', 'actif', '', '202105251621939789ObHsY47yf4uiIi', 'travail, excellence et discipline', NULL, NULL, NULL, 'N° 839 avenue de la ribambelle, lubumbashi', 'complexescolairelaribambelle@gmail.com', '', 'Haut-Katanga', 'Lubumbashi', '', '', '2021-04-26 08:04:27', '2022-07-02 05:58:21', NULL, 'Ecole d\'excellence et de merite. Plus de 10 ans d\'enseignement et formation des jeunes', 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ts_epreuves`
--

CREATE TABLE `ts_epreuves` (
  `epreuve_uid` varchar(75) NOT NULL,
  `epreuve_libelle` varchar(75) NOT NULL,
  `epreuve_numero` varchar(75) NOT NULL,
  `epreuve_statut` varchar(50) DEFAULT NULL COMMENT 'Actif, Inactif',
  `epreuve_type_uid` varchar(75) DEFAULT NULL,
  `epreuve_periode_uid` varchar(75) DEFAULT NULL,
  `epreuve_branche_uid` varchar(75) DEFAULT NULL,
  `epreuve_date` date DEFAULT NULL,
  `epreuve_cote_max` decimal(10,2) DEFAULT NULL,
  `epreuve_ponderation` varchar(75) NOT NULL,
  `epreuve_lecon` text NOT NULL,
  `epreuve_duree_minute` varchar(75) NOT NULL,
  `epreuve_methode` varchar(75) DEFAULT NULL,
  `epreuve_nombre_etudiants` int DEFAULT NULL,
  `epreuve_nombre_questions` int DEFAULT NULL,
  `epreuve_description` text,
  `epreuve_observation` text,
  `epreuve_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `epreuve_updated_at` datetime DEFAULT NULL,
  `epreuve_deleted_at` datetime DEFAULT NULL,
  `epreuve_deleted_by` varchar(75) DEFAULT NULL,
  `epreuve_created_by` varchar(75) DEFAULT NULL,
  `epreuve_updated_by` varchar(75) DEFAULT NULL,
  `epreuve_annee_uid` varchar(75) DEFAULT NULL,
  `epreuve_ecole_uid` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_etudiants`
--

CREATE TABLE `ts_etudiants` (
  `etudiant_uid` varchar(75) NOT NULL,
  `etudiant_matricule` varchar(75) NOT NULL,
  `etudiant_nom` varchar(25) NOT NULL,
  `etudiant_prenom` varchar(25) NOT NULL,
  `etudiant_postnom` varchar(25) NOT NULL,
  `etudiant_numero_serni` varchar(25) DEFAULT NULL,
  `etudiant_photo` varchar(200) DEFAULT NULL,
  `etudiant_type_uid` varchar(75) DEFAULT NULL,
  `etudiant_tuteur_uid` varchar(75) NOT NULL,
  `etudiant_lien_tuteur` varchar(75) DEFAULT NULL,
  `etudiant_email` varchar(25) DEFAULT NULL,
  `etudiant_telephone` varchar(25) DEFAULT NULL,
  `etudiant_sexe` varchar(25) DEFAULT NULL,
  `etudiant_date_naissance` date DEFAULT NULL,
  `etudiant_lieu_naissance` varchar(75) NOT NULL,
  `etudiant_contact_urgence` varchar(25) DEFAULT NULL,
  `etudiant_statut` varchar(20) NOT NULL,
  `etudiant_adresse` text,
  `etudiant_ville` varchar(75) DEFAULT NULL,
  `etudiant_province` varchar(75) DEFAULT NULL,
  `etudiant_groupe_sanguin` varchar(75) DEFAULT NULL,
  `etudiant_caracteristiques` text,
  `etudiant_observation` text,
  `etudiant_poids` varchar(75) DEFAULT NULL,
  `etudiant_taille` varchar(75) DEFAULT NULL,
  `etudiant_application` varchar(75) DEFAULT NULL,
  `etudiant_attitude` varchar(75) DEFAULT NULL,
  `etudiant_paiement_frais` varchar(75) DEFAULT NULL,
  `etudiant_fiche` varchar(200) DEFAULT NULL,
  `etudiant_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etudiant_updated_at` datetime DEFAULT NULL,
  `etudiant_deleted_at` datetime DEFAULT NULL,
  `etudiant_created_by` varchar(75) DEFAULT NULL,
  `etudiant_updated_by` varchar(75) DEFAULT NULL,
  `etudiant_deleted_by` varchar(75) DEFAULT NULL,
  `etudiant_ecole_uid` varchar(75) DEFAULT NULL,
  `etudiant_pseudo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_etudiants`
--

INSERT INTO `ts_etudiants` (`etudiant_uid`, `etudiant_matricule`, `etudiant_nom`, `etudiant_prenom`, `etudiant_postnom`, `etudiant_numero_serni`, `etudiant_photo`, `etudiant_type_uid`, `etudiant_tuteur_uid`, `etudiant_lien_tuteur`, `etudiant_email`, `etudiant_telephone`, `etudiant_sexe`, `etudiant_date_naissance`, `etudiant_lieu_naissance`, `etudiant_contact_urgence`, `etudiant_statut`, `etudiant_adresse`, `etudiant_ville`, `etudiant_province`, `etudiant_groupe_sanguin`, `etudiant_caracteristiques`, `etudiant_observation`, `etudiant_poids`, `etudiant_taille`, `etudiant_application`, `etudiant_attitude`, `etudiant_paiement_frais`, `etudiant_fiche`, `etudiant_created_at`, `etudiant_updated_at`, `etudiant_deleted_at`, `etudiant_created_by`, `etudiant_updated_by`, `etudiant_deleted_by`, `etudiant_ecole_uid`, `etudiant_pseudo`) VALUES
('202210151665841781tlZOzICwLRZw01', 'CSR22359', 'ilunga', 'jeannot', 'kazadi', NULL, NULL, '202203101646914101rKECVaLH34U95P', '202203101646914101rKECVaLH34U95P', NULL, NULL, NULL, 'masculin', '0000-00-00', '', NULL, 'actif', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-15 15:49:41', NULL, NULL, 'Eduschool-. - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz', 'c20224715c'),
('202210161665877196kP0cGdeQzFUUdO', 'CSR22683', 'kamwanga', 'paul', 'kazadi', NULL, NULL, '202203101646914101rKECVaLH34U95P', '202203101646914101rKECVaLH34U95P', NULL, NULL, NULL, 'masculin', '2000-10-16', 'kolwezi', NULL, 'actif', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-16 01:39:56', NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz', 'c20229046c'),
('202210171666017572urNdKrRG4OtmN7', 'CSR22268', 'Bobly', 'Ken', 'Swagger', NULL, NULL, '202203101646914101rKECVaLH34U95P', '202203101646914101rKECVaLH34U95P', NULL, NULL, NULL, 'masculin', '0000-00-00', '', NULL, 'actif', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-10-17 16:39:32', NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz', 'c20222505c'),
('202301241674593696GD86VodUTj61YD', 'CSR23170', 'mwila', 'betty', 'ngoie', '23001', 'https://webapps.dev/cursus/global/uploads/images/1674595690_d0429c78ea1a9ee848ee.jpg', '202203101646914101rKECVaLH34U95P', '202203101646914101rKECVaLH34U95P', NULL, 'mwila@trecaz.com', '099830028', 'feminin', '2000-11-06', 'Likasi', '', 'actif', 'KALUBWE', 'LUBUMBASHI', 'HK', 'A+', '', '', '', '', '', '', NULL, '', '2023-01-24 22:54:56', '2023-01-24 23:28:10', NULL, 'Ilunga-Patient - Gestionnaire', 'Ilunga-Patient - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz', '');

-- --------------------------------------------------------

--
-- Structure de la table `ts_filieres`
--

CREATE TABLE `ts_filieres` (
  `filiere_uid` varchar(75) NOT NULL,
  `filiere_code` varchar(75) NOT NULL,
  `filiere_libelle` varchar(200) NOT NULL,
  `filiere_statut` varchar(200) NOT NULL,
  `option_libelle` varchar(200) NOT NULL,
  `filiere_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filiere_updated_at` datetime DEFAULT NULL,
  `filiere_deleted_at` datetime DEFAULT NULL,
  `filiere_comment` text,
  `filiere_created_by` varchar(75) DEFAULT NULL,
  `filiere_updated_by` varchar(75) DEFAULT NULL,
  `filiere_deleted_by` varchar(75) DEFAULT NULL,
  `filiere_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_filieres`
--

INSERT INTO `ts_filieres` (`filiere_uid`, `filiere_code`, `filiere_libelle`, `filiere_statut`, `option_libelle`, `filiere_created_at`, `filiere_updated_at`, `filiere_deleted_at`, `filiere_comment`, `filiere_created_by`, `filiere_updated_by`, `filiere_deleted_by`, `filiere_ecole_uid`) VALUES
('202104271619475567ANiSL6D4ny9KVR', 'CYC84461', 'ESP', 'actif', 'Nutrition', '2021-04-27 00:19:27', '2022-10-16 01:24:12', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Ilunga-Patient - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202104271619475607fK6z1EuPlO2ukw', 'CYC30505', 'ESP', 'actif', 'Pr&eacute;vention et Contr&ocirc;le des infections', '2021-04-27 00:20:07', '2022-10-15 14:50:54', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202104271619475637keldfuQp69ZqBn', 'CYC72761', 'ESP', 'actif', 'Surveillance Epid&eacute;miologique', '2021-04-27 00:20:37', '2022-10-15 14:50:31', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202104271619475700J4JsAeBbpmtpcK', 'CYC33767', 'ESP', 'actif', 'Conception des bases de donn&eacute;es de ressources en sant&eacute;', '2021-04-27 00:21:40', '2022-10-15 14:49:52', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106241624549686w1jefNciARldfU', 'CYC37961', 'Maternelle', 'actif', '.', '2021-06-24 17:48:06', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624549775BC91BcmmylkemI', 'CYC09260', 'Primaire', 'actif', '.', '2021-06-24 17:49:35', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624549820rUn80bvQ1rk4FL', 'CYC32798', 'Scientifique', 'actif', 'Math-physique', '2021-06-24 17:50:20', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624549830cIA3TrGaBEkgfo', 'CYC95622', 'Scientifique', 'actif', 'Biochimie', '2021-06-24 17:50:30', '2021-06-24 17:51:46', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', 'Kapinga Mwinda - administrateur systeme', NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624559541YqYkH6QucGdNE4', 'CYC77570', 'Pedagogique', 'actif', 'Peda-Generale', '2021-06-24 20:32:21', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624559635I8BtV1hD2K8aiA', 'CYC00616', 'M&eacute;canique', 'actif', 'M&eacute;canique G&eacute;n&eacute;rale', '2021-06-24 20:33:55', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202107311627724549J9FgyHpZItGLho', 'CYC78478', 'ESP', 'actif', 'Gestion des bases de donn&eacute;es sanitaires', '2021-07-31 11:42:29', '2022-10-15 14:49:33', NULL, NULL, 'Total Assist Admin - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202107311627724569KEVGiwvwRHGMLn', 'CYC47539', 'ESP', 'actif', 'Gestion des ressources', '2021-07-31 11:42:49', '2022-10-15 14:46:08', NULL, NULL, 'Total Assist Admin - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202110051633464750PKdiKQ6dBlgevV', 'CYC75683', 'maternelle', 'actif', '', '2021-10-05 22:12:30', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633464764Yzz4qbARYyibEc', 'CYC71604', 'Primaire', 'actif', '', '2021-10-05 22:12:44', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633464800V2dG0JB0lYstfC', 'CYC14073', 'scientifique', 'actif', 'Math-physique', '2021-10-05 22:13:20', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633464814mzdzoY5z8R4A84', 'CYC03498', 'scientifique', 'actif', 'Bio-chimie', '2021-10-05 22:13:34', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('2021100516334648721aftSC6kJGhEZA', 'CYC99791', 'P&eacute;dagogique', 'actif', 'P&eacute;dagogie g&eacute;n&eacute;rale', '2021-10-05 22:14:32', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633464923akDN0sf1KHViG4', 'CYC40264', 'technique', 'actif', 'Electricit&eacute;', '2021-10-05 22:15:23', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633464946AcEmf0W6RsHYYB', 'CYC27089', 'technique', 'actif', 'agriculture', '2021-10-05 22:15:46', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('2021100516334649755PojqCaTmFFPVQ', 'CYC93559', 'technique', 'actif', 'construction', '2021-10-05 22:16:15', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633464995GZo9YW69Lzi2rV', 'CYC63485', 'technique', 'actif', 'architecture', '2021-10-05 22:16:35', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633465505HITDCAaOuF93kF', 'CYC50075', 'Secondaire', 'actif', 'Orientation (C.O)', '2021-10-05 22:25:05', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202111041636035848GDJyNR6HwqEcT9', 'CYC89129', 'pedagogique', 'actif', 'peda-generale', '2021-11-04 16:24:08', NULL, NULL, NULL, 'nicolas beya - coordonateur', NULL, NULL, '202111041636035453PGBbdiT8ivrOlM'),
('202111041636035880fvwSIwuuzgKKCV', 'CYC04008', 'scientifique', 'actif', 'math-physique', '2021-11-04 16:24:40', NULL, NULL, NULL, 'nicolas beya - coordonateur', NULL, NULL, '202111041636035453PGBbdiT8ivrOlM'),
('202111041636035897LknSyZtVUqnard', 'CYC12185', 'scientifique', 'actif', 'bio-chimie', '2021-11-04 16:24:57', NULL, NULL, NULL, 'nicolas beya - coordonateur', NULL, NULL, '202111041636035453PGBbdiT8ivrOlM'),
('2021110416360359441McNCLRS8yyi2a', 'CYC34299', 'commerciale', 'inactif', 'gestion', '2021-11-04 16:25:44', '2021-11-04 16:26:42', NULL, NULL, 'nicolas beya - coordonateur', 'nicolas beya - coordonateur', NULL, '202111041636035453PGBbdiT8ivrOlM'),
('202111041636035964eHhL7Tja4as4iw', 'CYC36936', 'commerciale', 'actif', 'Informatique', '2021-11-04 16:26:04', '2021-11-04 16:26:17', NULL, NULL, 'nicolas beya - coordonateur', 'nicolas beya - coordonateur', NULL, '202111041636035453PGBbdiT8ivrOlM'),
('202203101646913921jUt8lLKc1ViHck', 'CYC02521', 'ESP', 'actif', 'Communication et promotion de la sant&eacute;', '2022-03-10 14:05:21', '2022-10-15 14:51:32', NULL, NULL, 'Total Assist Admin - gestionnaire', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202205271653684936dA7mhWbH51efSC', 'CYC38585', 'ESP', 'actif', 'Hygi&egrave;nes environnementales', '2022-05-27 22:55:36', '2022-10-15 14:51:49', NULL, NULL, 'Mwila-Betty - Gestionnaire', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202206011654036540YgSdinhBdklMbF', 'CYC96057', 'ESP', 'actif', 'Mobilisation des ressources', '2022-06-01 00:35:40', '2022-10-15 14:52:17', NULL, NULL, 'Mwila-Betty - Gestionnaire', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_fonctions_agents`
--

CREATE TABLE `ts_fonctions_agents` (
  `fonction_uid` varchar(75) NOT NULL,
  `fonction_code` varchar(75) NOT NULL,
  `fonction_libelle` varchar(200) NOT NULL,
  `fonction_statut` varchar(200) NOT NULL,
  `fonction_comment` text,
  `fonction_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fonction_updated_at` datetime DEFAULT NULL,
  `fonction_deleted_at` datetime DEFAULT NULL,
  `fonction_created_by` varchar(75) DEFAULT NULL,
  `fonction_updated_by` varchar(75) DEFAULT NULL,
  `fonction_deleted_by` varchar(75) DEFAULT NULL,
  `fonction_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_fonctions_agents`
--

INSERT INTO `ts_fonctions_agents` (`fonction_uid`, `fonction_code`, `fonction_libelle`, `fonction_statut`, `fonction_comment`, `fonction_created_at`, `fonction_updated_at`, `fonction_deleted_at`, `fonction_created_by`, `fonction_updated_by`, `fonction_deleted_by`, `fonction_ecole_uid`) VALUES
('2021051316208956564n6Z9eyTiKGSA1', 'enseignant', 'enseignant', 'actif', NULL, '2021-05-13 10:47:36', '2022-10-15 03:41:11', NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202105131620895997bh7lPOB4nZgFkH', 'PFA56523', 'Gestionnaire', 'actif', NULL, '2021-05-13 10:53:17', '2021-06-01 01:07:11', NULL, 'Élie Mwez Rubuz - Administrateur', 'Mwila-Betty - Coordonnateur', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106241624564248QJ6sIl95u5YSgB', 'PFA99068', 'caissier', 'actif', NULL, '2021-06-24 09:50:48', '2021-06-24 09:54:15', NULL, 'Kapinga Mwinda - administrateur systeme', 'Kapinga Mwinda - administrateur systeme', NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564476JWCQvmn6PkoLwG', 'PFA54525', 'enseignant', 'actif', NULL, '2021-06-24 09:54:36', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564484MCeZOFKDhCQdBo', 'PFA02252', 'directeur', 'actif', NULL, '2021-06-24 09:54:44', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564515HCg0UKi2dhCw5Q', 'PFA03542', 'gestionnaire', 'actif', NULL, '2021-06-24 09:55:15', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564533bfMdKS0qlT7Z74', 'PFA67492', 'coordonnateur', 'actif', NULL, '2021-06-24 09:55:33', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('20211005163346628502hDWe0424YsWv', 'PFA73196', 'directeur', 'actif', NULL, '2021-10-05 10:38:05', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633466295RKMOz8sgQiVTWF', 'PFA83929', 'enseignant', 'actif', NULL, '2021-10-05 10:38:15', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633466306kMa2NmPaVluY95', 'PFA50299', 'caissier', 'actif', NULL, '2021-10-05 10:38:26', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633466346DeS1LRBgzgh676', 'PFA63537', 'disciplinaire', 'actif', NULL, '2021-10-05 10:39:06', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633466358tg93b1qu3YA1Rq', 'PFA90689', 'titulaire', 'actif', NULL, '2021-10-05 10:39:18', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202210151665841385iyKfM6EeHca8tu', 'PFA88046', 'administratif', 'actif', NULL, '2022-10-15 03:43:05', NULL, NULL, 'Eduschool-. - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_grades_agents`
--

CREATE TABLE `ts_grades_agents` (
  `grade_uid` varchar(75) NOT NULL,
  `grade_code` varchar(75) NOT NULL,
  `grade_libelle` varchar(200) NOT NULL,
  `grade_statut` varchar(200) NOT NULL,
  `grade_comment` text,
  `grade_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grade_updated_at` datetime DEFAULT NULL,
  `grade_deleted_at` datetime DEFAULT NULL,
  `grade_created_by` varchar(75) DEFAULT NULL,
  `grade_updated_by` varchar(75) DEFAULT NULL,
  `grade_deleted_by` varchar(75) DEFAULT NULL,
  `grade_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_grades_agents`
--

INSERT INTO `ts_grades_agents` (`grade_uid`, `grade_code`, `grade_libelle`, `grade_statut`, `grade_comment`, `grade_created_at`, `grade_updated_at`, `grade_deleted_at`, `grade_created_by`, `grade_updated_by`, `grade_deleted_by`, `grade_ecole_uid`) VALUES
('202105131620897575b2sq678qI17YMY', 'PGA35110', 'licencié', 'actif', NULL, '2021-05-13 11:19:35', '2022-10-15 03:43:30', NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202105131620897691jS8vS4H33muomB', 'PGA84724', 'gradué', 'actif', NULL, '2021-05-13 11:21:31', '2022-10-15 03:43:21', NULL, 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202105131620897711bU7g5RiMU42nK9', 'PGA30327', 'master', 'actif', NULL, '2021-05-13 11:21:51', '2021-05-13 11:25:36', NULL, 'Élie Mwez Rubuz - Administrateur', 'Élie Mwez Rubuz - Administrateur', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106241624564728AKgiHLqOwOutAt', 'PGA69270', 'licencié', 'actif', NULL, '2021-06-24 09:58:48', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564740g3FOV3oOUfHniw', 'PGA91619', 'gradué', 'actif', NULL, '2021-06-24 09:59:00', '2021-06-24 09:59:49', NULL, 'Kapinga Mwinda - administrateur systeme', 'Kapinga Mwinda - administrateur systeme', NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564752PF87BZAFimLbN3', 'PGA59008', 'master', 'actif', NULL, '2021-06-24 09:59:12', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564762IEcJBwP52AI1g2', 'PGA82209', 'doctorant', 'actif', NULL, '2021-06-24 09:59:22', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564770m6UhgCuodhphHh', 'PGA42845', 'd4', 'actif', NULL, '2021-06-24 09:59:30', '2021-06-24 22:00:13', NULL, 'Kapinga Mwinda - administrateur systeme', 'Kapinga Mwinda - administrateur systeme', NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564779jlvVZkSNnWsAre', 'PGA77341', 'd6', 'actif', NULL, '2021-06-24 09:59:39', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202110051633466395gjvz48BgZjno8v', 'PGA00762', 'Niveau A1', 'actif', NULL, '2021-10-05 10:39:55', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633466402lJR9enj3R9tnqz', 'PGA73103', 'Niveau A2', 'actif', NULL, '2021-10-05 10:40:02', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633466410R78hkBTb2yr4oe', 'PGA39977', 'Niveau A3', 'actif', NULL, '2021-10-05 10:40:10', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633466420VVJ4AZL16mnzQO', 'PGA12939', 'Niveau A4', 'actif', NULL, '2021-10-05 10:40:20', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0'),
('202110051633466429yknu6j9hUggelI', 'PGA12119', 'Niveau A5', 'actif', NULL, '2021-10-05 10:40:29', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110051633463606btcLJbpGgGPlW0');

-- --------------------------------------------------------

--
-- Structure de la table `ts_groupes`
--

CREATE TABLE `ts_groupes` (
  `groupe_uid` varchar(75) NOT NULL,
  `groupe_libelle` varchar(50) DEFAULT NULL,
  `groupe_observation` text,
  `groupe_status` varchar(25) DEFAULT NULL COMMENT '(actif | inactif)',
  `groupe_created_at` datetime DEFAULT NULL,
  `groupe_updated_at` datetime DEFAULT NULL,
  `groupe_deleted_at` datetime DEFAULT NULL,
  `groupe_created_by` varchar(75) DEFAULT NULL,
  `groupe_updated_by` varchar(75) DEFAULT NULL,
  `groupe_deleted_by` varchar(75) DEFAULT NULL,
  `groupe_annee_uid` varchar(75) DEFAULT NULL,
  `groupe_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_groupes`
--

INSERT INTO `ts_groupes` (`groupe_uid`, `groupe_libelle`, `groupe_observation`, `groupe_status`, `groupe_created_at`, `groupe_updated_at`, `groupe_deleted_at`, `groupe_created_by`, `groupe_updated_by`, `groupe_deleted_by`, `groupe_annee_uid`, `groupe_ecole_uid`) VALUES
('202105221621676984DS7tubrkqyaFDH', 'Directeurs', 'ce groupe ne concerne que les directeurs', 'actif', '2021-05-22 11:49:44', '2021-11-09 00:38:16', NULL, 'Élie Mwez Rubuz - Administrateur', 'Total Assist Admin - gestionnaire', NULL, '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('2021052216216771555sHppWdokwqR81', 'enseignants', 'ce groupe ne concerne que les Enseignants de  tous les cycles', 'actif', '2021-05-22 11:52:35', '2021-05-22 11:53:07', NULL, 'Élie Mwez Rubuz - Administrateur', 'Élie Mwez Rubuz - Administrateur', NULL, '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202106081623155813Zoqt3J7qysuAJV', 'secrétaire', '', 'actif', '2021-06-08 14:36:53', '2022-10-16 03:42:24', NULL, 'Total Assist Admin - administrateur systeme', 'Ilunga-Patient - Gestionnaire', NULL, '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202110061633475912AlioAUmhcnqvEV', 'directeur', '', 'actif', '2021-10-06 01:18:32', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0'),
('202110061633475923jelyDao9QGrhDu', 'enseignant', '', 'actif', '2021-10-06 01:18:43', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0'),
('202110061633475932uKKPQsf4MzulWC', 'caissier', '', 'actif', '2021-10-06 01:18:52', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0'),
('202110061633475942ON9pyJnhL04wGu', 'Titulaire', '', 'actif', '2021-10-06 01:19:02', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0'),
('202111091636411083vCZF0AYnmL2KwB', 'jury', '', 'actif', '2021-11-09 00:38:03', '2022-10-16 03:42:08', NULL, 'Total Assist Admin - gestionnaire', 'Ilunga-Patient - Gestionnaire', NULL, '2122042716195233337YRCLwCyvHIzOX', '20210426161941706701LLd4KS3GVRFz'),
('202203101646922024A1HnBZAJQS2eka', 'admin', 'Les administrateurs', 'actif', '2022-03-10 16:20:24', NULL, NULL, 'Total Assist Admin - gestionnaire', NULL, NULL, '2122042716195233337YRCLwCyvHIzOX', '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_inscriptions`
--

CREATE TABLE `ts_inscriptions` (
  `inscription_uid` varchar(75) NOT NULL,
  `inscription_etudiant_uid` varchar(75) NOT NULL,
  `inscription_promotion_uid` varchar(75) NOT NULL,
  `inscription_annee_uid` varchar(75) NOT NULL,
  `inscription_date` date DEFAULT NULL,
  `inscription_mode` varchar(25) NOT NULL,
  `inscription_type` varchar(25) DEFAULT 'inscription',
  `inscription_statut` varchar(25) NOT NULL,
  `inscription_validation` datetime DEFAULT NULL,
  `inscription_comment` text,
  `inscription_provenance` varchar(75) DEFAULT NULL,
  `inscription_pourcentage` varchar(75) DEFAULT NULL,
  `inscription_mention` varchar(75) DEFAULT NULL,
  `inscription_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inscription_updated_at` datetime DEFAULT NULL,
  `inscription_deleted_at` datetime DEFAULT NULL,
  `inscription_created_by` varchar(75) DEFAULT NULL,
  `inscription_updated_by` varchar(75) DEFAULT NULL,
  `inscription_deleted_by` varchar(75) DEFAULT NULL,
  `inscription_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_inscriptions`
--

INSERT INTO `ts_inscriptions` (`inscription_uid`, `inscription_etudiant_uid`, `inscription_promotion_uid`, `inscription_annee_uid`, `inscription_date`, `inscription_mode`, `inscription_type`, `inscription_statut`, `inscription_validation`, `inscription_comment`, `inscription_provenance`, `inscription_pourcentage`, `inscription_mention`, `inscription_created_at`, `inscription_updated_at`, `inscription_deleted_at`, `inscription_created_by`, `inscription_updated_by`, `inscription_deleted_by`, `inscription_ecole_uid`) VALUES
('202210151665841781Y1plKLOJEDeulu', '202210151665841781tlZOzICwLRZw01', '202210151665841704zj2iLAAkeDrVhw', '202206181655545804ULTWktFmz15L2K', '2022-10-15', 'locale', 'inscription', 'validee', NULL, NULL, NULL, NULL, NULL, '2022-10-15 15:49:41', NULL, NULL, 'Eduschool-. - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202210161665877196Sle5e8GM9g0a0O', '202210161665877196kP0cGdeQzFUUdO', '202210161665876285sGApHH3RR5E64O', '202206181655545804ULTWktFmz15L2K', '2022-10-16', 'locale', 'inscription', 'validee', NULL, NULL, NULL, NULL, NULL, '2022-10-16 01:39:56', NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202210171666017572Az1r1jl2Qg9cSP', '202210171666017572urNdKrRG4OtmN7', '202210161665876285sGApHH3RR5E64O', '202206181655545804ULTWktFmz15L2K', '2022-10-17', 'locale', 'inscription', 'validee', NULL, NULL, NULL, NULL, NULL, '2022-10-17 16:39:32', NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202301241674593696RKR1FhSFiwiHt7', '202301241674593696GD86VodUTj61YD', '202210161665876285sGApHH3RR5E64O', '202206181655545804ULTWktFmz15L2K', '2023-01-24', 'locale', 'inscription', 'validee', NULL, NULL, 'iss', NULL, NULL, '2023-01-24 22:54:56', '2023-01-24 23:28:10', NULL, 'Ilunga-Patient - Gestionnaire', 'Ilunga-Patient - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202301241674595898kHgoayvNbOnLuB', '202301241674593696GD86VodUTj61YD', '202210151665841704zj2iLAAkeDrVhw', '202205141652485786CkMrqvuqytlT2r', '2021-01-24', 'locale', 'inscription', 'validee', NULL, NULL, 'ISES', NULL, NULL, '2023-01-24 23:31:38', NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_logs`
--

CREATE TABLE `ts_logs` (
  `log_uid` varchar(75) NOT NULL,
  `log_created_at` datetime NOT NULL,
  `log_content` text NOT NULL,
  `log_user` varchar(75) NOT NULL,
  `log_ecole` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_logs`
--

INSERT INTO `ts_logs` (`log_uid`, `log_created_at`, `log_content`, `log_user`, `log_ecole`) VALUES
('202301241674591631KaPvDm8yCZH7Dz', '2023-01-24 22:20:31', 'Plusieurs tentatives d\'accès au compte de [eduschool@ditotase.com] ont été detectées approximatiif à [] sur [Windows 10 on Edge 109.0.1518.61] dont l\'adresse IP utilisée est [127.0.0.1]', 'eduschool@ditotase.com', '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_matieres`
--

CREATE TABLE `ts_matieres` (
  `matiere_uid` varchar(75) NOT NULL,
  `matiere_subtitle` varchar(75) DEFAULT NULL,
  `matiere_branche_uid` varchar(75) NOT NULL,
  `matiere_promotion_uid` varchar(75) NOT NULL,
  `matiere_agent_uid` varchar(75) DEFAULT NULL,
  `matiere_ponderation` decimal(10,0) DEFAULT NULL,
  `matiere_credit_horaire` decimal(10,0) DEFAULT NULL,
  `matiere_volume_horaire` decimal(10,0) DEFAULT NULL,
  `matiere_type` varchar(25) DEFAULT NULL,
  `matiere_statut` varchar(50) DEFAULT NULL COMMENT 'Actif, Inactif',
  `matiere_comment` text,
  `matiere_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `matiere_updated_at` datetime DEFAULT NULL,
  `matiere_deleted_at` datetime DEFAULT NULL,
  `matiere_deleted_by` varchar(75) DEFAULT NULL,
  `matiere_created_by` varchar(75) DEFAULT NULL,
  `matiere_updated_by` varchar(75) DEFAULT NULL,
  `matiere_annee_uid` varchar(75) DEFAULT NULL,
  `matiere_ecole_uid` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_matieres`
--

INSERT INTO `ts_matieres` (`matiere_uid`, `matiere_subtitle`, `matiere_branche_uid`, `matiere_promotion_uid`, `matiere_agent_uid`, `matiere_ponderation`, `matiere_credit_horaire`, `matiere_volume_horaire`, `matiere_type`, `matiere_statut`, `matiere_comment`, `matiere_created_at`, `matiere_updated_at`, `matiere_deleted_at`, `matiere_deleted_by`, `matiere_created_by`, `matiere_updated_by`, `matiere_annee_uid`, `matiere_ecole_uid`) VALUES
('202210161665876327P6i3R802k3pJgO', '', '202210161665875675DoE6QtEbwfCnJS', '202210161665876285sGApHH3RR5E64O', '202206041654342301NcWOC5oP15K0e5', '4', '20', '80', NULL, 'actif', NULL, '2022-10-16 01:25:27', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665876410DtStdpNWofjYvM', '', '202107241627159332ryKJOClRKhfvHt', '202210161665876285sGApHH3RR5E64O', '202206041654342301NcWOC5oP15K0e5', '2', '20', '40', NULL, 'actif', NULL, '2022-10-16 01:26:50', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('20221016166587661740zTaJjz0i4PED', '', '202105171621233248msqdBTWhOlQJcn', '202210161665876285sGApHH3RR5E64O', '202206041654342301NcWOC5oP15K0e5', '8', '20', '160', NULL, 'actif', NULL, '2022-10-16 01:30:17', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665876667MbS2e5jjwP5EUB', '', '2021051716212331923vV41H2wQLOncs', '202210161665876285sGApHH3RR5E64O', '202206041654342301NcWOC5oP15K0e5', '5', '20', '100', NULL, 'actif', NULL, '2022-10-16 01:31:07', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665876689gz6l2ypV0uUMBm', '', '202105171621233167GuMkMjj8wmmnRw', '202210161665876285sGApHH3RR5E64O', '202206041654342301NcWOC5oP15K0e5', '3', '20', '60', NULL, 'actif', NULL, '2022-10-16 01:31:29', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('2022101616658767337cpKE72ZIQiMWv', '', '202210161665875802sHGy3F0trMm5L9', '202210161665876285sGApHH3RR5E64O', '202210161665876557wsli7UDgRICPhs', '5', '20', '100', NULL, 'actif', NULL, '2022-10-16 01:32:13', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665876764p83PltqZEfGoMl', '', '202210161665875845GRQPkuhFFr88UV', '202210161665876285sGApHH3RR5E64O', '202210161665876557wsli7UDgRICPhs', '2', '20', '40', NULL, 'actif', NULL, '2022-10-16 01:32:44', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665876796v7eiYHRERBfkCe', '', '202210161665875495T5Zdrmt5mHSlqr', '202210161665876285sGApHH3RR5E64O', '202210161665876557wsli7UDgRICPhs', '3', '20', '60', NULL, 'actif', NULL, '2022-10-16 01:33:16', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('2022101616658768301PRQ8UrdCj7fVZ', '', '202210161665875510v3E51joOTjv6z2', '202210161665876285sGApHH3RR5E64O', '202210161665876557wsli7UDgRICPhs', '3', '20', '60', NULL, 'actif', NULL, '2022-10-16 01:33:50', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665876890N9q5EYrZI2lFDD', '', '202210161665875604LdI4z8JZQDKr71', '202210161665876285sGApHH3RR5E64O', '202210161665876557wsli7UDgRICPhs', '1', '20', '20', NULL, 'actif', NULL, '2022-10-16 01:34:50', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665877019YPRqwDlWlrrFvG', '', '2022101616658755217IOztENcAKoS3d', '202210161665876285sGApHH3RR5E64O', '202210161665876981G6oeG4jC4n6Drk', '3', '20', '60', NULL, 'actif', NULL, '2022-10-16 01:36:59', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665877041UYdsPHgCongfLb', '', '202107251627200852R5WOH3W0SFVvvq', '202210161665876285sGApHH3RR5E64O', '202210161665876981G6oeG4jC4n6Drk', '2', '20', '40', NULL, 'actif', NULL, '2022-10-16 01:37:21', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz'),
('202210161665877055PyMfCvIwnrGHYh', '', '202107241627159378pFayncVwKomniV', '202210161665876285sGApHH3RR5E64O', '202210161665876981G6oeG4jC4n6Drk', '2', '20', '40', NULL, 'actif', NULL, '2022-10-16 01:37:35', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, '202206181655545804ULTWktFmz15L2K', '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_maximas`
--

CREATE TABLE `ts_maximas` (
  `maxima_uid` varchar(75) NOT NULL,
  `maxima_libelle` varchar(75) NOT NULL,
  `maxima_max_periode` int NOT NULL,
  `maxima_max_examen` int NOT NULL,
  `maxima_created_at` datetime NOT NULL,
  `maxima_created_by` varchar(75) NOT NULL,
  `maxima_updated_at` datetime NOT NULL,
  `maxima_updated_by` varchar(75) DEFAULT NULL,
  `maxima_statut` varchar(25) DEFAULT NULL,
  `maxima_ecole_uid` varchar(75) NOT NULL,
  `maxima_annee_uid` varchar(75) DEFAULT NULL,
  `maxima_cycle_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ts_maximas`
--

INSERT INTO `ts_maximas` (`maxima_uid`, `maxima_libelle`, `maxima_max_periode`, `maxima_max_examen`, `maxima_created_at`, `maxima_created_by`, `maxima_updated_at`, `maxima_updated_by`, `maxima_statut`, `maxima_ecole_uid`, `maxima_annee_uid`, `maxima_cycle_uid`) VALUES
('202107251627197894zrFfup63nIlgAv', 'GROUPE I', 10, 20, '2021-07-25 09:24:54', 'Total Assist Admin - administrateur systeme', '2021-07-25 09:31:17', 'Total Assist Admin - administrateur systeme', 'actif', '20210426161941706701LLd4KS3GVRFz', '2021042716195233337YRCLwCyvHIzOB', '202104261619410837qED5e9Zp15FVL4'),
('202107251627198402z7r8OpJfZ9vPlW', 'GROUPE II', 20, 40, '2021-07-25 09:33:22', 'Total Assist Admin - administrateur systeme', '2021-07-25 09:33:35', 'Total Assist Admin - administrateur systeme', 'actif', '20210426161941706701LLd4KS3GVRFz', '2021042716195233337YRCLwCyvHIzOB', '202104261619410837qED5e9Zp15FVL4'),
('202107251627198436Fha0dBBRpjaDP2', 'GROUPE III', 40, 80, '2021-07-25 09:33:56', 'Total Assist Admin - administrateur systeme', '0000-00-00 00:00:00', NULL, 'actif', '20210426161941706701LLd4KS3GVRFz', '2021042716195233337YRCLwCyvHIzOB', '202104261619410837qED5e9Zp15FVL4'),
('202107251627198471wLVKDNgMMlKFQ3', 'GROUPE IV', 50, 100, '2021-07-25 09:34:31', 'Total Assist Admin - administrateur systeme', '0000-00-00 00:00:00', NULL, 'actif', '20210426161941706701LLd4KS3GVRFz', '2021042716195233337YRCLwCyvHIzOB', '202104261619410837qED5e9Zp15FVL4'),
('202107251627198501HzJT9NTgfBIpZu', 'Maxima Groupe I', 10, 20, '2021-07-25 09:35:01', 'Total Assist Admin - administrateur systeme', '2021-07-30 11:20:54', 'Total Assist Admin - administrateur systeme', 'actif', '20210426161941706701LLd4KS3GVRFz', '2021042716195233337YRCLwCyvHIzOB', '202104261619410630zjBCOaWJpJreY5'),
('202107301627636907dgqBipt2j1uq5m', 'maxima groupe II', 20, 40, '2021-07-30 11:21:47', 'Total Assist Admin - administrateur systeme', '0000-00-00 00:00:00', NULL, 'actif', '20210426161941706701LLd4KS3GVRFz', '2021042716195233337YRCLwCyvHIzOB', '202104261619410630zjBCOaWJpJreY5'),
('2021073016276369512DSqTAjbT3ai4S', 'MAXIMA GROUPE III', 40, 80, '2021-07-30 11:22:31', 'Total Assist Admin - administrateur systeme', '0000-00-00 00:00:00', NULL, 'actif', '20210426161941706701LLd4KS3GVRFz', '2021042716195233337YRCLwCyvHIzOB', '202104261619410630zjBCOaWJpJreY5'),
('202107301627636987hcOI0JMGDLpM95', 'MAX GROUPE IV', 50, 100, '2021-07-30 11:23:07', 'Total Assist Admin - administrateur systeme', '0000-00-00 00:00:00', NULL, 'actif', '20210426161941706701LLd4KS3GVRFz', '2021042716195233337YRCLwCyvHIzOB', '202104261619410630zjBCOaWJpJreY5'),
('202110051633466202RJ3H4H6MFPpVjb', 'Maxima I', 10, 20, '2021-10-05 10:36:42', 'RUBUZ EMMANUEL - gestionnaire', '0000-00-00 00:00:00', NULL, 'actif', '202110051633463606btcLJbpGgGPlW0', '2122042716195233337YRCLwCyvHIzOX', '2021100516334646973V08UtTvZNcO1b'),
('202110051633466223NKN9MNVaIotDAB', 'Maxima II', 20, 40, '2021-10-05 10:37:03', 'RUBUZ EMMANUEL - gestionnaire', '0000-00-00 00:00:00', NULL, 'actif', '202110051633463606btcLJbpGgGPlW0', '2122042716195233337YRCLwCyvHIzOX', '2021100516334646973V08UtTvZNcO1b'),
('202110051633466245hFHqvNfshchTqf', 'Maxima III', 40, 80, '2021-10-05 10:37:25', 'RUBUZ EMMANUEL - gestionnaire', '0000-00-00 00:00:00', NULL, 'actif', '202110051633463606btcLJbpGgGPlW0', '2122042716195233337YRCLwCyvHIzOX', '2021100516334646973V08UtTvZNcO1b'),
('202110051633466263wmn41qaZrsI1sc', 'Maxima IV', 50, 100, '2021-10-05 10:37:43', 'RUBUZ EMMANUEL - gestionnaire', '0000-00-00 00:00:00', NULL, 'actif', '202110051633463606btcLJbpGgGPlW0', '2122042716195233337YRCLwCyvHIzOX', '2021100516334646973V08UtTvZNcO1b'),
('202111041636036506B4Z7oZWhIgQshn', 'Maxima I', 10, 20, '2021-11-04 04:35:06', 'nicolas beya - coordonateur', '0000-00-00 00:00:00', NULL, 'actif', '202111041636035453PGBbdiT8ivrOlM', '2122042716195233337YRCLwCyvHIzOX', '202111041636035767S9vQ4lOz84OM2e');

-- --------------------------------------------------------

--
-- Structure de la table `ts_messages`
--

CREATE TABLE `ts_messages` (
  `message_uid` varchar(75) NOT NULL,
  `message_objet` varchar(200) NOT NULL,
  `message_contenu` text NOT NULL,
  `message_attaches` varchar(75) DEFAULT NULL,
  `message_statut` varchar(25) DEFAULT 'actif',
  `message_destinateur` varchar(75) DEFAULT NULL,
  `message_type` varchar(75) DEFAULT NULL COMMENT 'invitation, message, communique, avis, convocation',
  `message_codepin` varchar(25) DEFAULT NULL,
  `message_observation` text NOT NULL,
  `message_mode_envoie` varchar(75) DEFAULT NULL COMMENT 'sms, mail',
  `message_etat` varchar(75) DEFAULT NULL COMMENT 'lu, nonlu, archive',
  `message_degres` varchar(75) DEFAULT NULL,
  `message_created_at` datetime DEFAULT NULL,
  `message_updated_at` datetime DEFAULT NULL,
  `message_deleted_at` datetime DEFAULT NULL,
  `message_created_by` varchar(75) DEFAULT NULL,
  `message_updated_by` varchar(75) DEFAULT NULL,
  `message_deleted_by` varchar(75) DEFAULT NULL,
  `message_cycle_uid` varchar(75) DEFAULT NULL,
  `message_annee_uid` varchar(75) DEFAULT NULL,
  `message_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_messages`
--

INSERT INTO `ts_messages` (`message_uid`, `message_objet`, `message_contenu`, `message_attaches`, `message_statut`, `message_destinateur`, `message_type`, `message_codepin`, `message_observation`, `message_mode_envoie`, `message_etat`, `message_degres`, `message_created_at`, `message_updated_at`, `message_deleted_at`, `message_created_by`, `message_updated_by`, `message_deleted_by`, `message_cycle_uid`, `message_annee_uid`, `message_ecole_uid`) VALUES
('202206111654947363FzqbcLr3YkeTec', 'TEST', 'UUUUUUU', NULL, 'actif', '202206111654941456fOS8Nzh1A0574F', 'invitation', NULL, '', NULL, 'lu', NULL, '2022-06-11 01:36:03', NULL, NULL, 'Eduschool-. - Gestionnaire', NULL, NULL, NULL, '202205141652485786CkMrqvuqytlT2r', '20210426161941706701LLd4KS3GVRFz'),
('202206111654947410Hdfk0IGegUnv3C', 'TEST', 'UUUUUUU', NULL, 'actif', '202206041654322413C3ouHNtdDvwsjy', 'invitation', NULL, '', NULL, 'lu', NULL, '2022-06-11 01:36:50', NULL, NULL, 'Eduschool-. - Gestionnaire', NULL, NULL, NULL, '202205141652485786CkMrqvuqytlT2r', '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_mois`
--

CREATE TABLE `ts_mois` (
  `mois_uid` int NOT NULL,
  `mois_libelle` varchar(50) NOT NULL,
  `ordre_mois` int NOT NULL,
  `mois_statut` varchar(50) DEFAULT 'Actif' COMMENT 'Actif, Inactif',
  `mois_comments` text,
  `mois_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `mois_updated_at` datetime DEFAULT NULL,
  `mois_deleted_at` datetime DEFAULT NULL,
  `mois_deleted_by` varchar(75) DEFAULT NULL,
  `mois_created_by` varchar(75) DEFAULT NULL,
  `mois_updated_by` varchar(75) DEFAULT NULL,
  `mois_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_mois`
--

INSERT INTO `ts_mois` (`mois_uid`, `mois_libelle`, `ordre_mois`, `mois_statut`, `mois_comments`, `mois_created_at`, `mois_updated_at`, `mois_deleted_at`, `mois_deleted_by`, `mois_created_by`, `mois_updated_by`, `mois_ecole_uid`) VALUES
(1, 'octobre', 2, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'novembre', 3, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'decembre', 4, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'janvier', 5, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'fevrier', 6, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'mars', 7, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'avril', 8, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'mai', 9, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'juin', 10, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'juillet', 11, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Aout', 12, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'septembre', 1, 'Actif', NULL, '2021-05-04 22:08:05', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ts_passwords`
--

CREATE TABLE `ts_passwords` (
  `pass_uid` varchar(75) NOT NULL,
  `pass_digicode` varchar(10) DEFAULT NULL,
  `pass_time` varchar(25) DEFAULT NULL,
  `pass_token` text,
  `pass_ipaddress` varchar(75) DEFAULT NULL,
  `pass_system` varchar(75) DEFAULT NULL,
  `pass_status` varchar(75) DEFAULT NULL,
  `pass_created_at` datetime DEFAULT NULL,
  `pass_resetpass_at` datetime DEFAULT NULL,
  `pass_user_uid` varchar(75) DEFAULT NULL,
  `pass_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_periodes`
--

CREATE TABLE `ts_periodes` (
  `periode_uid` varchar(75) NOT NULL,
  `periode_code` varchar(75) NOT NULL,
  `periode_libelle` varchar(200) NOT NULL,
  `periode_type` varchar(75) NOT NULL,
  `periode_date_debut` date DEFAULT NULL,
  `periode_date_fin` date DEFAULT NULL,
  `periode_statut` varchar(200) NOT NULL,
  `periode_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `periode_updated_at` datetime DEFAULT NULL,
  `periode_deleted_at` datetime DEFAULT NULL,
  `periode_comment` text,
  `periode_created_by` varchar(75) DEFAULT NULL,
  `periode_updated_by` varchar(75) DEFAULT NULL,
  `periode_deleted_by` varchar(75) DEFAULT NULL,
  `periode_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_periodes`
--

INSERT INTO `ts_periodes` (`periode_uid`, `periode_code`, `periode_libelle`, `periode_type`, `periode_date_debut`, `periode_date_fin`, `periode_statut`, `periode_created_at`, `periode_updated_at`, `periode_deleted_at`, `periode_comment`, `periode_created_by`, `periode_updated_by`, `periode_deleted_by`, `periode_ecole_uid`) VALUES
('2021042516193818348l1lNV51ZKfuNY', 'P1', '1ère session', 'cotation', '2021-04-26', '2021-05-26', 'actif', '2021-04-25 22:17:14', '2022-10-15 14:57:33', NULL, '', 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202104251619381959Apo8qQ1v7pvtWD', 'P2', '2ème session', 'cotation', '2021-04-30', '2021-05-08', 'actif', '2021-04-25 22:19:19', '2022-10-15 14:57:22', NULL, '2EME PERIODE DE COTATION', 'Élie Mwez Rubuz - Administrateur', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106081623151813FS0MenwjEMCPFj', 'P3', 'Application', 'cotation', '2021-06-08', '2021-07-10', 'actif', '2021-06-08 13:30:13', '2022-10-15 14:59:27', NULL, '', 'Total Assist Admin - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106081623151856RbcODsqqyjvjqH', 'm1', 'moyenne', 'cotation', '2021-06-08', '2021-07-08', 'actif', '2021-06-08 13:30:56', '2022-10-16 00:12:12', NULL, '', 'Total Assist Admin - administrateur systeme', 'Ilunga-Patient - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106081623152002Zl4K98FcKSQQIB', 'E1', 'Examen Mi-session', 'cotation', '0000-00-00', '0000-00-00', 'actif', '2021-06-08 13:33:22', '2022-10-15 14:54:49', NULL, '', 'Total Assist Admin - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106081623152026LRI1IpnydHptMV', 'E2', 'Examen ordinaire', 'cotation', '0000-00-00', '0000-00-00', 'actif', '2021-06-08 13:33:46', '2022-10-15 14:55:01', NULL, '', 'Total Assist Admin - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz'),
('202106241624560234dsmlpfOOT6AFYk', 't1', 'Travaux pratiques', 'cotation', '0000-00-00', '0000-00-00', 'actif', '2021-06-24 20:43:54', '2022-10-15 14:58:09', NULL, '', 'Kapinga Mwinda - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624560262DU59SoFP09w5Zq', 'T2', 'Interrogation', 'cotation', '0000-00-00', '0000-00-00', 'actif', '2021-06-24 20:44:22', '2022-10-15 14:58:47', NULL, '', 'Kapinga Mwinda - administrateur systeme', 'Eduschool-. - Gestionnaire', NULL, '202106211624303230qZ2aaTCEMGBPdP');

-- --------------------------------------------------------

--
-- Structure de la table `ts_photos`
--

CREATE TABLE `ts_photos` (
  `user_uid` varchar(75) NOT NULL,
  `image` varchar(200) NOT NULL,
  `photo_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo_uid` varchar(75) NOT NULL,
  `photo_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_privileges`
--

CREATE TABLE `ts_privileges` (
  `privilege_uid` varchar(75) NOT NULL,
  `privilege_lecture` varchar(75) DEFAULT NULL COMMENT '(allow|deny)',
  `privilege_ecriture` varchar(75) DEFAULT NULL COMMENT '(allow|deny)',
  `privilege_execute` varchar(75) DEFAULT NULL COMMENT '(allow|deny)',
  `privilege_tout` varchar(75) DEFAULT NULL COMMENT '(allow|deny)',
  `privilege_observation` text,
  `privilege_status` varchar(25) DEFAULT NULL COMMENT '(actif | inactif)',
  `privilege_created_at` datetime DEFAULT NULL,
  `privilege_updated_at` datetime DEFAULT NULL,
  `privilege_deleted_at` datetime DEFAULT NULL,
  `privilege_created_by` varchar(75) DEFAULT NULL,
  `privilege_updated_by` varchar(75) DEFAULT NULL,
  `privilege_deleted_by` varchar(75) DEFAULT NULL,
  `privilege_groupe_uid` varchar(75) DEFAULT NULL,
  `privilege_acces_uid` varchar(75) DEFAULT NULL,
  `privilege_annee_uid` varchar(75) DEFAULT NULL,
  `privilege_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_privileges`
--

INSERT INTO `ts_privileges` (`privilege_uid`, `privilege_lecture`, `privilege_ecriture`, `privilege_execute`, `privilege_tout`, `privilege_observation`, `privilege_status`, `privilege_created_at`, `privilege_updated_at`, `privilege_deleted_at`, `privilege_created_by`, `privilege_updated_by`, `privilege_deleted_by`, `privilege_groupe_uid`, `privilege_acces_uid`, `privilege_annee_uid`, `privilege_ecole_uid`) VALUES
('202105231621740643b1CpY2De3s60Ep', 'deny', 'deny', 'deny', 'allow', 'Accordes les droits d\'acces au dossier etudiants a chaque utilisateur du groupe admin', 'actif', '2021-05-23 05:30:43', '2021-09-29 11:00:42', NULL, 'Élie Mwez Rubuz - Administrateur', 'Total Assist Admin - gestionnaire', NULL, '2021052216216771555sHppWdokwqR81', '2021052216216980430VfQ2rHcWfeW0K', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202105281622211852YMmfDiojIj2jGI', 'deny', 'deny', 'deny', 'allow', 'finances', 'actif', '2021-05-28 16:24:12', NULL, NULL, 'Mwila-Betty - Coordonnateur', NULL, NULL, '202105221621676984DS7tubrkqyaFDH', '2021052816222117740uuIf9FpAtLo90', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202105281622211875td9henknNIjJoN', 'deny', 'deny', 'deny', 'allow', '', 'inactif', '2021-05-28 16:24:35', '2021-06-06 22:11:17', NULL, 'Mwila-Betty - Coordonnateur', 'Total Assist Admin - administrateur systeme', NULL, '2021052216216771555sHppWdokwqR81', '2021052816222117740uuIf9FpAtLo90', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202106081623156391PU3tbblnRgsb8m', 'deny', 'deny', 'deny', 'allow', 'bbbbbbbbbbbbb', 'actif', '2021-06-08 14:46:31', NULL, NULL, 'Total Assist Admin - administrateur systeme', NULL, NULL, '202106081623155813Zoqt3J7qysuAJV', '202106081623156362tWP6dDe5e17o36', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202106081623157023ATeZ0hWNaarfK8', 'deny', 'deny', 'deny', 'allow', '', 'actif', '2021-06-08 14:57:03', NULL, NULL, 'Total Assist Admin - administrateur systeme', NULL, NULL, '202106081623155813Zoqt3J7qysuAJV', '2021052816222117740uuIf9FpAtLo90', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202106081623157037Bk4DFlp6Vg2E7U', 'deny', 'deny', 'deny', 'allow', '', 'actif', '2021-06-08 14:57:17', NULL, NULL, 'Total Assist Admin - administrateur systeme', NULL, NULL, '202106081623155813Zoqt3J7qysuAJV', '2021052216216980430VfQ2rHcWfeW0K', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('2021061016233243847yf7hJtnKVj9Um', 'deny', 'deny', 'deny', 'allow', '', 'actif', '2021-06-10 13:26:24', NULL, NULL, 'Total Assist Admin - administrateur systeme', NULL, NULL, '2021052216216771555sHppWdokwqR81', '202106101623319038ZporZYHR1DWaek', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202106101623324446TROpkMBiVEGDDt', 'deny', 'deny', 'deny', 'allow', '', 'inactif', '2021-06-10 13:27:26', '2021-11-09 00:52:49', NULL, 'Total Assist Admin - administrateur systeme', 'Total Assist Admin - gestionnaire', NULL, '202105221621676984DS7tubrkqyaFDH', '202106101623319378nlHrfBOrIMSDP1', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202106101623324684dqy3WWpUYHPsIL', 'deny', 'deny', 'deny', 'allow', '', 'actif', '2021-06-10 13:31:24', NULL, NULL, 'Total Assist Admin - administrateur systeme', NULL, NULL, '202105221621676984DS7tubrkqyaFDH', '202106101623318962FITZzjkhf7CYo6', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('2021100616334761039G7c8dwms8q7q1', 'deny', 'deny', 'deny', 'allow', '', 'actif', '2021-10-06 01:21:43', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110061633475912AlioAUmhcnqvEV', '202110061633476041SvrAEJv0qNcpto', '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0'),
('202110061633476112ta9f9p6HBWgDMM', 'deny', 'deny', 'deny', 'allow', '', 'actif', '2021-10-06 01:21:52', NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, NULL, '202110061633475912AlioAUmhcnqvEV', '202110061633476065Y9273RRakikMHZ', '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0');

-- --------------------------------------------------------

--
-- Structure de la table `ts_promotions`
--

CREATE TABLE `ts_promotions` (
  `promotion_uid` varchar(75) NOT NULL,
  `promotion_code` varchar(75) NOT NULL,
  `promotion_libelle` varchar(200) NOT NULL,
  `promotion_degres_uid` varchar(75) NOT NULL,
  `promotion_cycle_uid` varchar(75) NOT NULL,
  `promotion_filiere_uid` varchar(75) NOT NULL,
  `promotion_statut` varchar(200) NOT NULL,
  `promotion_titulaire` varchar(75) DEFAULT NULL,
  `promotion_effectif` int DEFAULT NULL,
  `promotion_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `promotion_updated_at` datetime DEFAULT NULL,
  `promotion_deleted_at` datetime DEFAULT NULL,
  `promotion_comment` text,
  `promotion_created_by` varchar(75) DEFAULT NULL,
  `promotion_updated_by` varchar(75) DEFAULT NULL,
  `promotion_deleted_by` varchar(75) DEFAULT NULL,
  `promotion_ecole_uid` varchar(75) DEFAULT NULL,
  `annee_affectation` varchar(75) DEFAULT NULL,
  `affectation_destination` varchar(25) DEFAULT 'false',
  `affectation_provenance` varchar(25) DEFAULT 'false',
  `promotion_lastday_pointage` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_promotions`
--

INSERT INTO `ts_promotions` (`promotion_uid`, `promotion_code`, `promotion_libelle`, `promotion_degres_uid`, `promotion_cycle_uid`, `promotion_filiere_uid`, `promotion_statut`, `promotion_titulaire`, `promotion_effectif`, `promotion_created_at`, `promotion_updated_at`, `promotion_deleted_at`, `promotion_comment`, `promotion_created_by`, `promotion_updated_by`, `promotion_deleted_by`, `promotion_ecole_uid`, `annee_affectation`, `affectation_destination`, `affectation_provenance`, `promotion_lastday_pointage`) VALUES
('202210151665841704zj2iLAAkeDrVhw', 'CCL98140', 'G1HOSPI', '202104251619344894plBQj6MMpiedsb', '202111041636035805VqIKLgKDv9D5Md', '202205271653684936dA7mhWbH51efSC', 'actif', NULL, NULL, '2022-10-15 15:48:24', NULL, NULL, NULL, 'Eduschool-. - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz', NULL, 'false', 'false', NULL),
('202210161665876285sGApHH3RR5E64O', 'CCL89823', 'L1NUTRI', '202104251619344894plBQj6MMpiedsb', '202107311627724617WzaH6FtwB0GLJJ', '202104271619475567ANiSL6D4ny9KVR', 'actif', NULL, NULL, '2022-10-16 01:24:45', NULL, NULL, NULL, 'Ilunga-Patient - Gestionnaire', NULL, NULL, '20210426161941706701LLd4KS3GVRFz', NULL, 'false', 'false', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ts_resultats`
--

CREATE TABLE `ts_resultats` (
  `resultat_uid` varchar(75) NOT NULL,
  `resultat_etudiant_uid` varchar(75) DEFAULT NULL,
  `resultat_annee_uid` varchar(75) DEFAULT NULL,
  `resultat_ecole_uid` varchar(75) DEFAULT NULL,
  `resultat_promotion_uid` varchar(50) DEFAULT NULL,
  `resultat_pourcentage` decimal(10,2) DEFAULT NULL,
  `resultat_place` varchar(25) DEFAULT NULL,
  `resultat_mention` varchar(75) DEFAULT NULL,
  `resultat_observation` text NOT NULL,
  `resultat_statut` varchar(25) NOT NULL COMMENT 'Correction(corrigee | annulee | encours)',
  `resultat_created_at` datetime DEFAULT NULL,
  `resultat_updated_at` datetime DEFAULT NULL,
  `resultat_deleted_at` datetime DEFAULT NULL,
  `resultat_created_by` varchar(75) DEFAULT NULL,
  `resultat_updated_by` varchar(75) DEFAULT NULL,
  `resultat_deleted_by` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ts_secteurs`
--

CREATE TABLE `ts_secteurs` (
  `secteur_uid` varchar(75) NOT NULL,
  `secteur_code` varchar(50) DEFAULT NULL,
  `secteur_libelle` varchar(75) NOT NULL,
  `secteur_comment` text,
  `secteur_type` varchar(25) DEFAULT NULL COMMENT 'AGENT & etudiant',
  `secteur_statut` varchar(50) DEFAULT NULL COMMENT 'Actif, Inactif',
  `secteur_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `secteur_updated_at` datetime DEFAULT NULL,
  `secteur_deleted_at` datetime DEFAULT NULL,
  `secteur_deleted_by` varchar(75) DEFAULT NULL,
  `secteur_created_by` varchar(75) DEFAULT NULL,
  `secteur_updated_by` varchar(75) DEFAULT NULL,
  `secteur_annee_uid` varchar(75) DEFAULT NULL,
  `secteur_ecole_uid` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_secteurs`
--

INSERT INTO `ts_secteurs` (`secteur_uid`, `secteur_code`, `secteur_libelle`, `secteur_comment`, `secteur_type`, `secteur_statut`, `secteur_created_at`, `secteur_updated_at`, `secteur_deleted_at`, `secteur_deleted_by`, `secteur_created_by`, `secteur_updated_by`, `secteur_annee_uid`, `secteur_ecole_uid`) VALUES
('202105141620965992cSHH2ePHVffjtC', 'PSA85617', 'enseignements', NULL, NULL, 'actif', '2021-05-14 06:19:52', '2021-05-14 06:22:20', NULL, NULL, 'Élie Mwez Rubuz - Administrateur', 'Élie Mwez Rubuz - Administrateur', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202105141620966111arrz98iuwP4cib', 'PSA47554', 'finance & comptabilite', NULL, NULL, 'actif', '2021-05-14 06:21:51', NULL, NULL, NULL, 'Élie Mwez Rubuz - Administrateur', NULL, '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('2021062416245645633fO48K6090atwu', 'PSA38588', 'administration', NULL, NULL, 'actif', '2021-06-24 09:56:03', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, '2021042716195233337YRCLwCyvHIzOB', '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564581wEUGwIt41qmtet', 'PSA21397', 'secrétariat', NULL, NULL, 'actif', '2021-06-24 09:56:21', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, '2021042716195233337YRCLwCyvHIzOB', '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564605p7Sp9vP0FImiwF', 'PSA38656', 'enseignements', NULL, NULL, 'actif', '2021-06-24 09:56:45', '2021-06-24 09:57:06', NULL, NULL, 'Kapinga Mwinda - administrateur systeme', 'Kapinga Mwinda - administrateur systeme', '2021042716195233337YRCLwCyvHIzOB', '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564614iQdp15mvp8uCIe', 'PSA61827', 'finances', NULL, NULL, 'actif', '2021-06-24 09:56:54', NULL, NULL, NULL, 'Kapinga Mwinda - administrateur systeme', NULL, '2021042716195233337YRCLwCyvHIzOB', '202106211624303230qZ2aaTCEMGBPdP'),
('202110061633475469OtaOnhTZqhZte9', 'PSA69990', 'enseignement', NULL, NULL, 'actif', '2021-10-06 01:11:09', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0'),
('202110061633475484KKUiHz8Pp5kgGP', 'PSA44629', 'administration', NULL, NULL, 'actif', '2021-10-06 01:11:24', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0'),
('202110061633475494wQcDEvrfjKMHwy', 'PSA42961', 'comptabilité', NULL, NULL, 'actif', '2021-10-06 01:11:34', NULL, NULL, NULL, 'RUBUZ EMMANUEL - gestionnaire', NULL, '2122042716195233337YRCLwCyvHIzOX', '202110051633463606btcLJbpGgGPlW0'),
('202206041654342037rc6Gb9nEQoITrf', 'PSA85589', 'administration', NULL, NULL, 'actif', '2022-06-04 01:27:17', NULL, NULL, NULL, 'Mwila-Betty - Gestionnaire', NULL, '202205141652485786CkMrqvuqytlT2r', '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_taches`
--

CREATE TABLE `ts_taches` (
  `tache_uid` varchar(75) NOT NULL,
  `tache_code` varchar(25) DEFAULT NULL,
  `tache_libelle` varchar(100) DEFAULT NULL,
  `tache_description` text,
  `tache_comment` text,
  `tache_date_debut` date DEFAULT NULL,
  `tache_date_fin` date DEFAULT NULL,
  `tache_statut` varchar(25) DEFAULT NULL,
  `tache_created_at` datetime DEFAULT NULL,
  `tache_created_by` varchar(75) DEFAULT NULL,
  `tache_updated_at` datetime DEFAULT NULL,
  `tache_updated_by` varchar(75) DEFAULT NULL,
  `tache_deleted_at` datetime DEFAULT NULL,
  `tache_deleted_by` varchar(75) DEFAULT NULL,
  `tache_type_uid` varchar(75) DEFAULT NULL,
  `tache_agent_uid` varchar(75) DEFAULT NULL,
  `tache_annee_uid` varchar(75) DEFAULT NULL,
  `tache_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_taches`
--

INSERT INTO `ts_taches` (`tache_uid`, `tache_code`, `tache_libelle`, `tache_description`, `tache_comment`, `tache_date_debut`, `tache_date_fin`, `tache_statut`, `tache_created_at`, `tache_created_by`, `tache_updated_at`, `tache_updated_by`, `tache_deleted_at`, `tache_deleted_by`, `tache_type_uid`, `tache_agent_uid`, `tache_annee_uid`, `tache_ecole_uid`) VALUES
('202105151621104401YA0VojDvFwQ1ll', 'CPR36415', 'Formation Agents', '<p><span style=\"font-weight: bolder; color: rgb(101, 138, 186);\">Formation de tous les agents du secteur enseignement</span><br></p>', NULL, '2021-05-15', '2021-05-20', 'actif', '2021-05-15 08:46:41', 'Élie Mwez Rubuz - Administrateur', NULL, NULL, NULL, NULL, NULL, NULL, '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202105151621104583VDFq2m0CMBZbwk', 'CPR56902', 'Formation de tous les agents du secteur enseignement', '<p><span style=\"font-weight: bolder; color: rgb(101, 138, 186);\">Formation de tous les agents du secteur enseignement</span><span style=\"color: rgb(101, 138, 186); font-weight: bolder; font-size: 1rem;\">Formation de tous les agents du secteur enseignement</span><span style=\"color: rgb(101, 138, 186); font-weight: bolder; font-size: 1rem;\">Formation de tous les agents du secteur enseignement</span><span style=\"color: rgb(101, 138, 186); font-weight: bolder; font-size: 1rem;\">Formation de tous les agents du secteur enseignement</span><span style=\"color: rgb(101, 138, 186); font-weight: bolder; font-size: 1rem;\">Formation de tous les agents du secteur enseignement</span><br></p>', NULL, '2021-05-16', '2021-06-05', 'actif', '2021-05-15 08:49:43', 'Élie Mwez Rubuz - Administrateur', NULL, NULL, NULL, NULL, NULL, NULL, '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('2021051516211053819IJ562AnmStA4j', 'CPR02771', 'Formation  agents corps enseignants', '<ul><li style=\"color: rgb(0, 0, 0);\"><ul><li><span style=\"color: rgb(101, 138, 186); font-weight: bolder; font-size: 1rem;\">Formation de tous les agents du secteur enseignement</span></li></ul></li><li><span style=\"font-weight: bolder; color: rgb(101, 138, 186);\">Formation de tous les agents du secteur enseignement</span></li><li><span style=\"color: rgb(101, 138, 186); font-weight: bolder; font-size: 1rem;\">Formation de tous les agents du secteur enseignement</span></li><li><span style=\"color: rgb(101, 138, 186); font-weight: bolder; font-size: 1rem;\">Formation de tous les agents du secteur enseignement</span></li></ul><h2 style=\"text-align: center; \">Formation de tous les agents du secteur enseignement</h2>', NULL, '2021-05-18', '2021-07-10', 'actif', '2021-05-15 09:03:01', 'Élie Mwez Rubuz - Administrateur', '2021-05-15 09:20:59', 'Élie Mwez Rubuz - Administrateur', NULL, NULL, '202105131620901244pVdnDPb01y8F12', '202105141620989439K1gw0OBWSYDayC', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202105301622369171WzBMsInDTVUi4w', 'CPR38562', 'Execution des travaux et activités evenementielles ', '<p>Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;Execution des travaux et activités evenementielles&nbsp;<br></p>', NULL, '0000-00-00', '0000-00-00', 'actif', '2021-05-30 12:06:11', 'Mwila-Betty - Coordonnateur', NULL, NULL, NULL, NULL, '202105131620901244pVdnDPb01y8F12', '202105221621692795caRFfUZ1dUkGuh', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `ts_typesecoles`
--

CREATE TABLE `ts_typesecoles` (
  `typesecole_uid` varchar(75) NOT NULL,
  `typesecole_code` varchar(75) NOT NULL,
  `typesecole_libelle` varchar(200) NOT NULL,
  `typesecole_statut` varchar(200) NOT NULL,
  `typesecole_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `typesecole_updated_at` datetime DEFAULT NULL,
  `typesecole_deleted_at` datetime DEFAULT NULL,
  `typesecole_comment` text,
  `typesecole_created_by` varchar(75) DEFAULT NULL,
  `typesecole_updated_by` varchar(75) DEFAULT NULL,
  `typesecole_deleted_by` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_typesecoles`
--

INSERT INTO `ts_typesecoles` (`typesecole_uid`, `typesecole_code`, `typesecole_libelle`, `typesecole_statut`, `typesecole_created_at`, `typesecole_updated_at`, `typesecole_deleted_at`, `typesecole_comment`, `typesecole_created_by`, `typesecole_updated_by`, `typesecole_deleted_by`) VALUES
('2021042216191268742NUPZR2LYfaSRE', 'CTE90847', 'Collège', 'actif', '2021-04-22 16:27:54', '2021-09-23 23:18:01', NULL, NULL, '-', 'Ilunga Kasongo Dany - Administrator', NULL),
('202104221619127350jrC16eWVEOIP', 'CTE37423', 'Ecole des garcons', 'actif', '2021-04-22 16:35:50', '2021-04-26 18:41:54', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Élie Mwez Rubuz-Administrateur', NULL),
('2021042216191279300m56LtlytqKLR7', 'CTE86848', 'Lycée', 'actif', '2021-04-22 16:45:30', '2021-09-23 23:18:24', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Ilunga Kasongo Dany-Administrator', NULL),
('202104231619131772OMCHs7mE8P0e8W', 'CTE61254', 'ecole des filles', 'actif', '2021-04-23 00:49:32', '2021-05-25 12:43:07', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Mwila-Betty-Coordonnateur', NULL),
('202104231619161287PcS4FO5zIGmhSC', 'CTE42598', 'ecole mixte', 'actif', '2021-04-23 09:01:27', '2021-04-23 09:59:11', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Élie Mwez Rubuz-Administrateur', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ts_typesenseignements`
--

CREATE TABLE `ts_typesenseignements` (
  `typesens_uid` varchar(75) NOT NULL,
  `typesens_code` varchar(75) NOT NULL,
  `typesens_libelle` varchar(200) NOT NULL,
  `typesens_statut` varchar(200) NOT NULL,
  `typesens_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `typesens_updated_at` datetime DEFAULT NULL,
  `typesens_deleted_at` datetime DEFAULT NULL,
  `typesens_comment` text,
  `typesens_created_by` varchar(75) DEFAULT NULL,
  `typesens_updated_by` varchar(75) DEFAULT NULL,
  `typesens_deleted_by` varchar(75) DEFAULT NULL,
  `typesens_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_typesenseignements`
--

INSERT INTO `ts_typesenseignements` (`typesens_uid`, `typesens_code`, `typesens_libelle`, `typesens_statut`, `typesens_created_at`, `typesens_updated_at`, `typesens_deleted_at`, `typesens_comment`, `typesens_created_by`, `typesens_updated_by`, `typesens_deleted_by`, `typesens_ecole_uid`) VALUES
('202104231619166887T3DGAbrA1us7Ab', 'CTE16690', 'enseignement Medical', 'actif', '2021-04-23 10:34:47', '2021-04-23 10:38:23', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Élie Mwez Rubuz-Administrateur', NULL, NULL),
('202104231619166951E3hT2ds6hELvre', 'CTE58142', 'enseignement de base', 'actif', '2021-04-23 10:35:51', '2021-09-23 23:11:59', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Ilunga Kasongo Dany - Administrator', NULL, NULL),
('202104231619167129V4YUuED3hKC2b8', 'CTE52535', 'Enseignement général', 'actif', '2021-04-23 10:38:49', '2021-09-23 23:12:22', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Ilunga Kasongo Dany-Administrator', NULL, '1619333956'),
('202104251619334206tJiA5Z3na1vgKb', 'CTE73414', 'enseignement professionnel', 'actif', '2021-04-25 09:03:26', NULL, NULL, NULL, 'Élie Mwez Rubuz-Administrateur', NULL, NULL, '1619333956'),
('202105251621939499DlHoMoZD02iBAN', 'CTE05288', 'Enseignement Technique', 'actif', '2021-05-25 12:44:59', '2021-09-23 23:14:58', NULL, NULL, 'Mwila-Betty-Coordonnateur', 'Ilunga Kasongo Dany-Administrator', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ts_typesepreuves`
--

CREATE TABLE `ts_typesepreuves` (
  `typesepreuve_uid` varchar(75) NOT NULL,
  `typesepreuve_code` varchar(50) DEFAULT NULL,
  `typesepreuve_libelle` varchar(75) NOT NULL,
  `typesepreuve_comment` text,
  `typesepreuve_statut` varchar(50) DEFAULT NULL COMMENT 'Actif, Inactif',
  `typesepreuve_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `typesepreuve_updated_at` datetime DEFAULT NULL,
  `typesepreuve_deleted_at` datetime DEFAULT NULL,
  `typesepreuve_deleted_by` varchar(75) DEFAULT NULL,
  `typesepreuve_created_by` varchar(75) DEFAULT NULL,
  `typesepreuve_updated_by` varchar(75) DEFAULT NULL,
  `typesepreuve_annee_uid` varchar(75) DEFAULT NULL,
  `typesepreuve_ecole_uid` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_typesepreuves`
--

INSERT INTO `ts_typesepreuves` (`typesepreuve_uid`, `typesepreuve_code`, `typesepreuve_libelle`, `typesepreuve_comment`, `typesepreuve_statut`, `typesepreuve_created_at`, `typesepreuve_updated_at`, `typesepreuve_deleted_at`, `typesepreuve_deleted_by`, `typesepreuve_created_by`, `typesepreuve_updated_by`, `typesepreuve_annee_uid`, `typesepreuve_ecole_uid`) VALUES
('202105171621234589N6nzEq8dj5HTca', 'CCE98194', 'INTERROGATION', NULL, 'actif', '2021-05-17 08:56:29', '2021-05-17 08:57:59', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Élie Mwez Rubuz-Administrateur', '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('202105171621234666jDCHcSvY2d1G4y', 'CCE58119', 'EXAMEN', NULL, 'actif', '2021-05-17 08:57:46', NULL, NULL, NULL, 'Élie Mwez Rubuz-Administrateur', NULL, '2021042716195233337YRCLwCyvHIzOB', '20210426161941706701LLd4KS3GVRFz'),
('2021062416245641373R8bBMTS6cH9dg', 'CCE36346', 'interrogation', NULL, 'actif', '2021-06-24 21:48:57', NULL, NULL, NULL, 'Kapinga Mwinda-administrateur systeme', NULL, NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564150tL6QBLM3UlLh25', 'CCE85639', 'devoirs', NULL, 'actif', '2021-06-24 21:49:10', '2021-06-24 21:49:24', NULL, NULL, 'Kapinga Mwinda-administrateur systeme', 'Kapinga Mwinda-administrateur systeme', NULL, '202106211624303230qZ2aaTCEMGBPdP'),
('202106241624564197PS0gGaPbE0vZiO', 'CCE28770', 'travaux pratiques', NULL, 'actif', '2021-06-24 21:49:57', '2021-06-24 21:50:28', NULL, NULL, 'Kapinga Mwinda-administrateur systeme', 'Kapinga Mwinda-administrateur systeme', NULL, '202106211624303230qZ2aaTCEMGBPdP');

-- --------------------------------------------------------

--
-- Structure de la table `ts_typesetudiants`
--

CREATE TABLE `ts_typesetudiants` (
  `typesetudiant_uid` varchar(75) NOT NULL,
  `typesetudiant_code` varchar(75) NOT NULL,
  `typesetudiant_libelle` varchar(200) NOT NULL,
  `typesetudiant_statut` varchar(200) NOT NULL,
  `typesetudiant_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `typesetudiant_updated_at` datetime DEFAULT NULL,
  `typesetudiant_deleted_at` datetime DEFAULT NULL,
  `typesetudiant_comment` text,
  `typesetudiant_created_by` varchar(75) DEFAULT NULL,
  `typesetudiant_updated_by` varchar(75) DEFAULT NULL,
  `typesetudiant_deleted_by` varchar(75) DEFAULT NULL,
  `typesetudiant_ecole_uid` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ts_typesetudiants`
--

INSERT INTO `ts_typesetudiants` (`typesetudiant_uid`, `typesetudiant_code`, `typesetudiant_libelle`, `typesetudiant_statut`, `typesetudiant_created_at`, `typesetudiant_updated_at`, `typesetudiant_deleted_at`, `typesetudiant_comment`, `typesetudiant_created_by`, `typesetudiant_updated_by`, `typesetudiant_deleted_by`, `typesetudiant_ecole_uid`) VALUES
('2021042516193404858CFdWkUPqGNPd6', 'CCE36106', 'Enfants tiers', 'actif', '2021-04-25 10:48:05', '2021-04-25 10:54:00', NULL, NULL, 'Élie Mwez Rubuz-Administrateur', 'Élie Mwez Rubuz-Administrateur', NULL, '20210426161941706701LLd4KS3GVRFz'),
('2021042516193408605AZOeieZ1aMCtr', 'CCE37224', 'enfants agents', 'actif', '2021-04-25 10:54:20', NULL, NULL, NULL, 'Élie Mwez Rubuz-Administrateur', NULL, NULL, '20210426161941706701LLd4KS3GVRFz'),
('202203101646914101rKECVaLH34U95P', 'none', 'Aucune', 'actif', '2022-03-10 14:08:21', '2022-10-15 15:15:25', NULL, NULL, 'Total Assist Admin-gestionnaire', 'Eduschool-.-Gestionnaire', NULL, '20210426161941706701LLd4KS3GVRFz');

-- --------------------------------------------------------

--
-- Structure de la table `vs_parcours_scolaires`
--

CREATE TABLE `vs_parcours_scolaires` (
  `annee_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `annee_code` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `annee_libelle` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `annee_statut` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `annee_gestionnaire` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_effectif_etudiants` int DEFAULT NULL,
  `annee_effectif_agents` int DEFAULT NULL,
  `annee_prefet` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_disciplinaire` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_directeur` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_date_ouverture` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_date_cloture` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_created_at` datetime NOT NULL,
  `annee_updated_at` datetime DEFAULT NULL,
  `annee_deleted_at` datetime DEFAULT NULL,
  `annee_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `annee_created_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_updated_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_deleted_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_ecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ecole_code` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ecole_libelle` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `typesecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `typesens_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ecole_statut` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ecole_gestionnaire` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_coordination` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_devise` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_prefet` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_disciplinaire` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_directeur` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_adresse` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `ecole_email` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_telephone` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_province` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_ville` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_siteweb` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_logo` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_created_at` datetime NOT NULL,
  `ecole_updated_at` datetime DEFAULT NULL,
  `ecole_deleted_at` datetime DEFAULT NULL,
  `ecole_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `ecole_created_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_updated_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_deleted_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_ecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ecole_client_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `promotion_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `promotion_code` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `promotion_libelle` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `promotion_degres_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `promotion_cycle_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `promotion_filiere_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `promotion_statut` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `promotion_titulaire` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `promotion_effectif` int DEFAULT NULL,
  `promotion_created_at` datetime NOT NULL,
  `promotion_updated_at` datetime DEFAULT NULL,
  `promotion_deleted_at` datetime DEFAULT NULL,
  `promotion_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `promotion_created_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `promotion_updated_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `promotion_deleted_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `promotion_ecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `annee_affectation` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `affectation_destination` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `affectation_provenance` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `promotion_lastday_pointage` date DEFAULT NULL,
  `filiere_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `filiere_code` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `filiere_libelle` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `filiere_statut` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `option_libelle` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `filiere_created_at` datetime NOT NULL,
  `filiere_updated_at` datetime DEFAULT NULL,
  `filiere_deleted_at` datetime DEFAULT NULL,
  `filiere_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `filiere_created_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `filiere_updated_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `filiere_deleted_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `filiere_ecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cycle_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cycle_code` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cycle_libelle` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cycle_statut` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cycle_created_at` datetime NOT NULL,
  `cycle_updated_at` datetime DEFAULT NULL,
  `cycle_deleted_at` datetime DEFAULT NULL,
  `cycle_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `cycle_created_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cycle_updated_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cycle_deleted_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cycle_ecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `etudiant_matricule` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `etudiant_nom` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `etudiant_prenom` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `etudiant_postnom` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `etudiant_numero_serni` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_photo` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_type_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_tuteur_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `etudiant_lien_tuteur` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_email` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_telephone` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_sexe` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_date_naissance` date DEFAULT NULL,
  `etudiant_lieu_naissance` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `etudiant_contact_urgence` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_statut` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `etudiant_adresse` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `etudiant_ville` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_province` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_groupe_sanguin` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_caracteristiques` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `etudiant_observation` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `etudiant_poids` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_taille` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_application` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_attitude` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_paiement_frais` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_fiche` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_created_at` datetime NOT NULL,
  `etudiant_updated_at` datetime DEFAULT NULL,
  `etudiant_deleted_at` datetime DEFAULT NULL,
  `etudiant_created_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_updated_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_deleted_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_ecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `etudiant_pseudo` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inscription_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `inscription_etudiant_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `inscription_promotion_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `inscription_annee_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `inscription_date` date DEFAULT NULL,
  `inscription_mode` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `inscription_type` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inscription_statut` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `inscription_validation` datetime DEFAULT NULL,
  `inscription_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `inscription_provenance` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inscription_created_at` datetime NOT NULL,
  `inscription_updated_at` datetime DEFAULT NULL,
  `inscription_deleted_at` datetime DEFAULT NULL,
  `inscription_created_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inscription_updated_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inscription_deleted_by` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inscription_ecole_uid` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ts_acces`
--
ALTER TABLE `ts_acces`
  ADD PRIMARY KEY (`acces_uid`),
  ADD KEY `acces_annee_uid` (`acces_annee_uid`),
  ADD KEY `acces_ecole_uid` (`acces_ecole_uid`);

--
-- Index pour la table `ts_admins`
--
ALTER TABLE `ts_admins`
  ADD PRIMARY KEY (`admin_uid`);

--
-- Index pour la table `ts_agents`
--
ALTER TABLE `ts_agents`
  ADD PRIMARY KEY (`agent_uid`),
  ADD UNIQUE KEY `agent_matricule` (`agent_matricule`),
  ADD KEY `agent_ecole_uid` (`agent_ecole_uid`),
  ADD KEY `agent_fonction_uid` (`agent_fonction_uid`),
  ADD KEY `agent_grade_uid` (`agent_grade_uid`),
  ADD KEY `agent_secteur_uid` (`agent_secteur_uid`);

--
-- Index pour la table `ts_annees`
--
ALTER TABLE `ts_annees`
  ADD PRIMARY KEY (`annee_uid`),
  ADD UNIQUE KEY `annee_code` (`annee_code`);

--
-- Index pour la table `ts_branches`
--
ALTER TABLE `ts_branches`
  ADD PRIMARY KEY (`branche_uid`),
  ADD KEY `branche_ecole_uid` (`branche_ecole_uid`);

--
-- Index pour la table `ts_bulletins`
--
ALTER TABLE `ts_bulletins`
  ADD PRIMARY KEY (`bulletin_uid`);

--
-- Index pour la table `ts_clients`
--
ALTER TABLE `ts_clients`
  ADD PRIMARY KEY (`client_uid`);

--
-- Index pour la table `ts_comptes`
--
ALTER TABLE `ts_comptes`
  ADD PRIMARY KEY (`compte_uid`),
  ADD KEY `compte_agent_uid` (`compte_agent_uid`),
  ADD KEY `compte_groupe_uid` (`compte_groupe_uid`),
  ADD KEY `compte_ecole_uid` (`compte_ecole_uid`);

--
-- Index pour la table `ts_coordinations`
--
ALTER TABLE `ts_coordinations`
  ADD PRIMARY KEY (`coordination_uid`);

--
-- Index pour la table `ts_cotations_agents`
--
ALTER TABLE `ts_cotations_agents`
  ADD PRIMARY KEY (`cotation_uid`),
  ADD KEY `cotation_agent_uid` (`cotation_agent_uid`),
  ADD KEY `cotation_annee_uid` (`cotation_annee_uid`),
  ADD KEY `cotation_periode_uid` (`cotation_periode_uid`),
  ADD KEY `cotation_critere_uid` (`cotation_critere_uid`),
  ADD KEY `cotation_ecole_uid` (`cotation_ecole_uid`);

--
-- Index pour la table `ts_cotes`
--
ALTER TABLE `ts_cotes`
  ADD PRIMARY KEY (`cote_uid`),
  ADD KEY `cote_annee_uid` (`cote_annee_uid`),
  ADD KEY `cote_ecole_uid` (`cote_ecole_uid`),
  ADD KEY `cote_etudiant_uid` (`cote_etudiant_uid`),
  ADD KEY `cote_matiere_uid` (`cote_matiere_uid`),
  ADD KEY `cote_periode_uid` (`cote_periode_uid`);

--
-- Index pour la table `ts_criteres_agents`
--
ALTER TABLE `ts_criteres_agents`
  ADD PRIMARY KEY (`critere_uid`),
  ADD UNIQUE KEY `critere_code` (`critere_code`),
  ADD KEY `critere_ecole_uid` (`critere_ecole_uid`);

--
-- Index pour la table `ts_cycles`
--
ALTER TABLE `ts_cycles`
  ADD PRIMARY KEY (`cycle_uid`),
  ADD UNIQUE KEY `cycle_code` (`cycle_code`),
  ADD KEY `cycle_ecole_uid` (`cycle_ecole_uid`);

--
-- Index pour la table `ts_degrespromotions`
--
ALTER TABLE `ts_degrespromotions`
  ADD PRIMARY KEY (`degres_uid`),
  ADD UNIQUE KEY `degres_code` (`degres_code`),
  ADD KEY `degres_ecole_uid` (`degres_ecole_uid`);

--
-- Index pour la table `ts_ecoles`
--
ALTER TABLE `ts_ecoles`
  ADD PRIMARY KEY (`ecole_uid`),
  ADD UNIQUE KEY `ecole_code` (`ecole_code`),
  ADD KEY `typesecole_uid` (`typesecole_uid`),
  ADD KEY `typesens_uid` (`typesens_uid`),
  ADD KEY `ecole_coordination` (`ecole_coordination`);

--
-- Index pour la table `ts_epreuves`
--
ALTER TABLE `ts_epreuves`
  ADD PRIMARY KEY (`epreuve_uid`),
  ADD KEY `epreuve_annee_uid` (`epreuve_annee_uid`),
  ADD KEY `epreuve_periode_uid` (`epreuve_periode_uid`),
  ADD KEY `epreuve_ecole_uid` (`epreuve_ecole_uid`),
  ADD KEY `epreuve_type_uid` (`epreuve_type_uid`),
  ADD KEY `epreuve_branche_uid` (`epreuve_branche_uid`);

--
-- Index pour la table `ts_etudiants`
--
ALTER TABLE `ts_etudiants`
  ADD PRIMARY KEY (`etudiant_uid`),
  ADD UNIQUE KEY `etudiant_matricule` (`etudiant_matricule`),
  ADD KEY `etudiant_ecole_uid` (`etudiant_ecole_uid`),
  ADD KEY `etudiant_tuteur_uid` (`etudiant_tuteur_uid`),
  ADD KEY `etudiant_type_uid` (`etudiant_type_uid`);

--
-- Index pour la table `ts_filieres`
--
ALTER TABLE `ts_filieres`
  ADD PRIMARY KEY (`filiere_uid`),
  ADD UNIQUE KEY `filiere_code` (`filiere_code`),
  ADD KEY `filiere_ecole_uid` (`filiere_ecole_uid`);

--
-- Index pour la table `ts_fonctions_agents`
--
ALTER TABLE `ts_fonctions_agents`
  ADD PRIMARY KEY (`fonction_uid`),
  ADD UNIQUE KEY `fonction_code` (`fonction_code`),
  ADD KEY `fonction_ecole_uid` (`fonction_ecole_uid`);

--
-- Index pour la table `ts_grades_agents`
--
ALTER TABLE `ts_grades_agents`
  ADD PRIMARY KEY (`grade_uid`),
  ADD UNIQUE KEY `grade_code` (`grade_code`),
  ADD KEY `grade_ecole_uid` (`grade_ecole_uid`);

--
-- Index pour la table `ts_groupes`
--
ALTER TABLE `ts_groupes`
  ADD PRIMARY KEY (`groupe_uid`),
  ADD KEY `groupe_ecole_uid` (`groupe_ecole_uid`);

--
-- Index pour la table `ts_inscriptions`
--
ALTER TABLE `ts_inscriptions`
  ADD PRIMARY KEY (`inscription_uid`),
  ADD KEY `inscription_annee_uid` (`inscription_annee_uid`),
  ADD KEY `inscription_promotion_uid` (`inscription_promotion_uid`),
  ADD KEY `inscription_ecole_uid` (`inscription_ecole_uid`),
  ADD KEY `inscription_etudiant_uid` (`inscription_etudiant_uid`);

--
-- Index pour la table `ts_logs`
--
ALTER TABLE `ts_logs`
  ADD PRIMARY KEY (`log_uid`);

--
-- Index pour la table `ts_matieres`
--
ALTER TABLE `ts_matieres`
  ADD PRIMARY KEY (`matiere_uid`),
  ADD KEY `matiere_agent_uid` (`matiere_agent_uid`),
  ADD KEY `matiere_annee_uid` (`matiere_annee_uid`),
  ADD KEY `matiere_branche_uid` (`matiere_branche_uid`),
  ADD KEY `matiere_promotion_uid` (`matiere_promotion_uid`),
  ADD KEY `matiere_ecole_uid` (`matiere_ecole_uid`);

--
-- Index pour la table `ts_maximas`
--
ALTER TABLE `ts_maximas`
  ADD PRIMARY KEY (`maxima_uid`);

--
-- Index pour la table `ts_messages`
--
ALTER TABLE `ts_messages`
  ADD PRIMARY KEY (`message_uid`),
  ADD KEY `message_annee_uid` (`message_annee_uid`),
  ADD KEY `message_ecole_uid` (`message_ecole_uid`);

--
-- Index pour la table `ts_mois`
--
ALTER TABLE `ts_mois`
  ADD PRIMARY KEY (`mois_uid`);

--
-- Index pour la table `ts_passwords`
--
ALTER TABLE `ts_passwords`
  ADD PRIMARY KEY (`pass_uid`);

--
-- Index pour la table `ts_periodes`
--
ALTER TABLE `ts_periodes`
  ADD PRIMARY KEY (`periode_uid`),
  ADD UNIQUE KEY `periode_code` (`periode_code`),
  ADD KEY `periode_ecole_uid` (`periode_ecole_uid`);

--
-- Index pour la table `ts_photos`
--
ALTER TABLE `ts_photos`
  ADD PRIMARY KEY (`photo_uid`),
  ADD KEY `user_uid` (`user_uid`),
  ADD KEY `photo_ecole_uid` (`photo_ecole_uid`);

--
-- Index pour la table `ts_privileges`
--
ALTER TABLE `ts_privileges`
  ADD PRIMARY KEY (`privilege_uid`),
  ADD KEY `privilege_acces_uid` (`privilege_acces_uid`),
  ADD KEY `privilege_groupe_uid` (`privilege_groupe_uid`),
  ADD KEY `privilege_ecole_uid` (`privilege_ecole_uid`);

--
-- Index pour la table `ts_promotions`
--
ALTER TABLE `ts_promotions`
  ADD PRIMARY KEY (`promotion_uid`),
  ADD UNIQUE KEY `promotion_code` (`promotion_code`),
  ADD KEY `promotion_cycle_uid` (`promotion_cycle_uid`),
  ADD KEY `promotion_degres_uid` (`promotion_degres_uid`),
  ADD KEY `promotion_filiere_uid` (`promotion_filiere_uid`),
  ADD KEY `promotion_ecole_uid` (`promotion_ecole_uid`);

--
-- Index pour la table `ts_resultats`
--
ALTER TABLE `ts_resultats`
  ADD PRIMARY KEY (`resultat_uid`),
  ADD KEY `resultat_ecole_uid` (`resultat_ecole_uid`),
  ADD KEY `resultat_annee_uid` (`resultat_annee_uid`),
  ADD KEY `resultat_promotion_uid` (`resultat_promotion_uid`),
  ADD KEY `resultat_etudiant_uid` (`resultat_etudiant_uid`);

--
-- Index pour la table `ts_secteurs`
--
ALTER TABLE `ts_secteurs`
  ADD PRIMARY KEY (`secteur_uid`),
  ADD KEY `secteur_ecole_uid` (`secteur_ecole_uid`);

--
-- Index pour la table `ts_taches`
--
ALTER TABLE `ts_taches`
  ADD PRIMARY KEY (`tache_uid`),
  ADD KEY `tache_agent_uid` (`tache_agent_uid`),
  ADD KEY `tache_ecole_uid` (`tache_ecole_uid`),
  ADD KEY `tache_type_uid` (`tache_type_uid`);

--
-- Index pour la table `ts_typesecoles`
--
ALTER TABLE `ts_typesecoles`
  ADD PRIMARY KEY (`typesecole_uid`),
  ADD UNIQUE KEY `typesecole_code` (`typesecole_code`);

--
-- Index pour la table `ts_typesenseignements`
--
ALTER TABLE `ts_typesenseignements`
  ADD PRIMARY KEY (`typesens_uid`),
  ADD UNIQUE KEY `typesens_code` (`typesens_code`);

--
-- Index pour la table `ts_typesepreuves`
--
ALTER TABLE `ts_typesepreuves`
  ADD PRIMARY KEY (`typesepreuve_uid`),
  ADD KEY `typesepreuve_ecole_uid` (`typesepreuve_ecole_uid`),
  ADD KEY `typesepreuve_annee_uid` (`typesepreuve_annee_uid`);

--
-- Index pour la table `ts_typesetudiants`
--
ALTER TABLE `ts_typesetudiants`
  ADD PRIMARY KEY (`typesetudiant_uid`),
  ADD UNIQUE KEY `typesetudiant_code` (`typesetudiant_code`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ts_acces`
--
ALTER TABLE `ts_acces`
  ADD CONSTRAINT `ts_acces_ibfk_1` FOREIGN KEY (`acces_annee_uid`) REFERENCES `ts_annees` (`annee_uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ts_acces_ibfk_2` FOREIGN KEY (`acces_ecole_uid`) REFERENCES `ts_ecoles` (`ecole_uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ts_agents`
--
ALTER TABLE `ts_agents`
  ADD CONSTRAINT `ts_agents_ibfk_1` FOREIGN KEY (`agent_ecole_uid`) REFERENCES `ts_ecoles` (`ecole_uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ts_agents_ibfk_2` FOREIGN KEY (`agent_fonction_uid`) REFERENCES `ts_fonctions_agents` (`fonction_uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ts_agents_ibfk_3` FOREIGN KEY (`agent_grade_uid`) REFERENCES `ts_grades_agents` (`grade_uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ts_agents_ibfk_4` FOREIGN KEY (`agent_secteur_uid`) REFERENCES `ts_secteurs` (`secteur_uid`);

--
-- Contraintes pour la table `ts_branches`
--
ALTER TABLE `ts_branches`
  ADD CONSTRAINT `ts_branches_ibfk_1` FOREIGN KEY (`branche_ecole_uid`) REFERENCES `ts_ecoles` (`ecole_uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
