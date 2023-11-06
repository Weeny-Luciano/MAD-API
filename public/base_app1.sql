-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 06 nov. 2023 à 18:34
-- Version du serveur :  5.7.32-log
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `base_app1`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `quartier_id` int(11) DEFAULT NULL,
  `nom_agent` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `sexe` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `propriete` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unite_id` int(11) DEFAULT NULL,
  `commune_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `quartier_id`, `nom_agent`, `prenom`, `date_naissance`, `sexe`, `propriete`, `unite_id`, `commune_id`, `region_id`) VALUES
(1, 301001001, 'RAKOTO', 'Jean', '2005-10-02', 'Homme', 'Quartier', NULL, NULL, NULL),
(2, 301002003, 'RANDRIANDRAINA', 'Patrique', '1993-10-01', 'Homme', 'Quartier', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `audit`
--

CREATE TABLE `audit` (
  `id` int(11) NOT NULL,
  `type_operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `identite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `propriete` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relation_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `audit`
--

INSERT INTO `audit` (`id`, `type_operation`, `date`, `identite`, `propriete`, `agent`, `relation_1`, `relation_2`) VALUES
(1, 'ajouté', '2023-11-04 00:00:00', 'dsvfsfdsd', 'personne', '301001001', NULL, NULL),
(2, 'modifié', '2023-11-04 00:00:00', 'dqsd12', 'personne', '301001001', NULL, NULL),
(3, 'ajouté', '2023-11-05 00:00:00', '156', 'maison', '301001001', NULL, NULL),
(4, 'ajouté', '2023-11-05 00:00:00', '6', 'location', '301001001', '156', 'M23'),
(5, 'ajouté', '2023-11-05 11:37:45', 'P9898', 'personne', '301001001', NULL, NULL),
(6, 'ajouter', '2023-11-05 11:38:43', '32', 'membre menage', '301001001', 'P9898', 'M003'),
(7, 'ajouté', '2023-11-05 11:56:08', 'PA01', 'personne', '301001001', NULL, NULL),
(8, 'ajouter', '2023-11-05 11:56:33', '33', 'membre menage', '301001001', 'PA01', 'M001'),
(9, 'modifié', '2023-11-05 17:38:38', 'P5656', 'personne', '301001001', NULL, NULL),
(10, 'ajouté', '2023-11-06 08:35:49', 'P077', 'personne', '301001001', NULL, NULL),
(11, 'ajouter', '2023-11-06 08:36:08', '34', 'membre menage', '301001001', 'P077', 'M001'),
(12, 'ajouté', '2023-11-06 09:00:36', 'P56', 'personne', '301001001', NULL, NULL),
(13, 'ajouter', '2023-11-06 09:00:58', '35', 'membre menage', '301001001', 'P56', 'M001'),
(14, 'ajouté', '2023-11-06 09:01:35', 'ooooo', 'personne', '301001001', NULL, NULL),
(15, 'ajouté', '2023-11-06 09:03:33', 'uuu', 'personne', '301001001', NULL, NULL),
(16, 'supprimé', '2023-11-06 09:05:48', 'P56', 'personne', '301001001', NULL, NULL),
(17, 'supprimé', '2023-11-06 09:06:08', 'P7878787', 'personne', '301001001', NULL, NULL),
(18, 'modifié', '2023-11-06 09:13:32', 'P365', 'personne', '301001001', NULL, NULL),
(19, 'modifié', '2023-11-06 09:14:10', 'P001', 'personne', '301001001', NULL, NULL),
(20, 'modifié', '2023-11-06 09:14:38', 'P002', 'personne', '301001001', NULL, NULL),
(21, 'modifié', '2023-11-06 09:15:28', 'P365', 'personne', '301001001', NULL, NULL),
(22, 'modifié', '2023-11-06 09:16:04', 'P365', 'personne', '301001001', NULL, NULL),
(23, 'modifié', '2023-11-06 09:17:50', 'P365', 'personne', '301001001', NULL, NULL),
(24, 'modifié', '2023-11-06 09:19:09', 'P365', 'personne', '301001001', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
  `code_commune` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `nom_commune` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`code_commune`, `region_id`, `nom_commune`) VALUES
(301, 31, 'TOAMASINA I'),
(501, 51, 'Toliara I');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231003132618', '2023-10-03 13:26:31', 1789),
('DoctrineMigrations\\Version20231003141822', '2023-10-03 14:24:22', 1546),
('DoctrineMigrations\\Version20231004194012', '2023-10-04 19:40:37', 4028),
('DoctrineMigrations\\Version20231005065021', '2023-10-05 06:51:51', 1551),
('DoctrineMigrations\\Version20231005065317', '2023-10-05 06:53:50', 2618),
('DoctrineMigrations\\Version20231005183538', '2023-10-05 18:35:48', 3811),
('DoctrineMigrations\\Version20231005183827', '2023-10-05 18:38:36', 1613),
('DoctrineMigrations\\Version20231005184123', '2023-10-05 18:41:40', 2101),
('DoctrineMigrations\\Version20231008193014', '2023-10-08 19:30:27', 2765),
('DoctrineMigrations\\Version20231009060941', '2023-10-09 06:13:00', 511),
('DoctrineMigrations\\Version20231009061353', '2023-10-09 06:13:57', 1766),
('DoctrineMigrations\\Version20231009062123', '2023-10-09 06:22:03', 1917),
('DoctrineMigrations\\Version20231009183930', '2023-10-09 18:39:40', 2306),
('DoctrineMigrations\\Version20231010074743', '2023-10-10 07:48:16', 2988),
('DoctrineMigrations\\Version20231010182738', '2023-10-10 18:28:26', 4165),
('DoctrineMigrations\\Version20231011070516', '2023-10-11 07:07:02', 2090),
('DoctrineMigrations\\Version20231011075641', '2023-10-11 07:56:59', 4201),
('DoctrineMigrations\\Version20231013055659', '2023-10-13 05:57:10', 3029),
('DoctrineMigrations\\Version20231021074451', '2023-10-21 07:45:50', 2698),
('DoctrineMigrations\\Version20231021074655', '2023-10-21 07:47:03', 1385),
('DoctrineMigrations\\Version20231021075518', '2023-10-21 07:55:24', 1421),
('DoctrineMigrations\\Version20231021080840', '2023-10-21 08:08:46', 5879),
('DoctrineMigrations\\Version20231104142604', '2023-11-04 14:26:16', 2696),
('DoctrineMigrations\\Version20231105071037', '2023-11-05 07:11:06', 1765),
('DoctrineMigrations\\Version20231105083333', '2023-11-05 08:33:43', 567);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `code_entreprise` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proprietaire_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_entreprise` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secteur_activite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quartier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`code_entreprise`, `proprietaire_id`, `nom_entreprise`, `secteur_activite`, `date_creation`, `tel`, `quartier_id`) VALUES
('E2310', NULL, 'PAKO', 'autre', '2023-10-04', '0343689562', 301001001);

--
-- Déclencheurs `entreprise`
--
DELIMITER $$
CREATE TRIGGER `after_insert_entreprise` AFTER INSERT ON `entreprise` FOR EACH ROW INSERT INTO audit(id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'ajouté', NOW(), NEW.code_entreprise, 'entreprise', '301001001')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_entreprise` BEFORE UPDATE ON `entreprise` FOR EACH ROW INSERT INTO audit(id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'modifié', NOW(), NEW.code_entreprise, 'entreprise', '301001001')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_entreprise` BEFORE DELETE ON `entreprise` FOR EACH ROW INSERT INTO audit(id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'supprimé', NOW(), OLD.code_entreprise, 'entreprise', '301001001')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `maison_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menage_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_entre` date NOT NULL,
  `date_sortie` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id`, `maison_id`, `menage_id`, `date_entre`, `date_sortie`) VALUES
(3, 'S-20', 'M001', '2014-10-08', NULL),
(4, 'S-102', 'M6555', '2014-10-08', NULL),
(5, 'S-102', 'M783', '2014-10-08', NULL),
(6, '156', 'M23', '2023-11-01', NULL);

--
-- Déclencheurs `location`
--
DELIMITER $$
CREATE TRIGGER `after_insert_location` AFTER INSERT ON `location` FOR EACH ROW INSERT INTO audit (id, type_operation, date, propriete, identite, agent, relation_1, relation_2) VALUES (NULL, 'ajouté', NOW(), 'location', NEW.id, '301001001', NEW.maison_id, NEW.menage_id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `maison`
--

CREATE TABLE `maison` (
  `lot_maison` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_maison` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_map` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nb_chambre` int(11) NOT NULL,
  `surface` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_construction` date DEFAULT NULL,
  `type_maison_id` int(11) DEFAULT NULL,
  `proprietaire_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quartier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `maison`
--

INSERT INTO `maison` (`lot_maison`, `nom_maison`, `adresse_map`, `nb_chambre`, `surface`, `annee_construction`, `type_maison_id`, `proprietaire_id`, `quartier_id`) VALUES
('156', 'villa Orange', NULL, 8, '65m ²', '2023-11-01', 4, 'P68', 301001001),
('S-102', 'villa dope', NULL, 4, '84 m²', '2023-10-03', 4, NULL, 301001001),
('S-20', NULL, NULL, 4, ' 84 m²', '2003-10-01', 2, 'P001', 301002003);

--
-- Déclencheurs `maison`
--
DELIMITER $$
CREATE TRIGGER `after_insert_maison` AFTER INSERT ON `maison` FOR EACH ROW INSERT INTO audit(id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'ajouté', NOW(), NEW.lot_maison, 'maison', '301001001')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_maison` AFTER UPDATE ON `maison` FOR EACH ROW INSERT INTO audit(id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'modifié', NOW(), NEW.lot_maison, 'maison', '301001001')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_maison` BEFORE DELETE ON `maison` FOR EACH ROW INSERT INTO audit(id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'supprimé', NOW(), OLD.lot_maison, 'maison', '301001001')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `membre_menage`
--

CREATE TABLE `membre_menage` (
  `id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `personne_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menage_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre_menage`
--

INSERT INTO `membre_menage` (`id`, `date_debut`, `date_fin`, `personne_id`, `menage_id`) VALUES
(2, '1998-03-25', NULL, 'P001', 'M001'),
(3, '1998-03-25', NULL, 'P002', 'M001'),
(7, '2023-10-07', NULL, 'P68', 'M23'),
(8, '2000-06-15', NULL, 'P456', 'M23'),
(9, '1888-02-12', NULL, 'P365', 'M001'),
(11, '2005-02-12', NULL, 'P035', 'M001'),
(17, '1233-03-12', NULL, 'sfdfdfgfg', 'M003'),
(21, '5222-02-12', NULL, 'P45666', 'M001'),
(22, '2000-11-11', NULL, 'P546', 'M001'),
(23, '2200-02-10', NULL, 'P21211', 'M001'),
(28, '2017-11-05', NULL, 'P0012', 'M783'),
(29, '2004-02-14', NULL, 'P5656', 'M783'),
(32, '2000-02-15', NULL, 'P9898', 'M003'),
(33, '2006-02-12', NULL, 'PA01', 'M001'),
(34, '2005-08-08', NULL, 'P077', 'M001');

--
-- Déclencheurs `membre_menage`
--
DELIMITER $$
CREATE TRIGGER `after_insert_membre` AFTER INSERT ON `membre_menage` FOR EACH ROW INSERT INTO audit (id, type_operation, date, propriete, identite, agent, relation_1, relation_2) VALUES (NULL, 'ajouter', NOW(), 'membre menage', NEW.id, '301001001', NEW.personne_id, NEW.menage_id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `menage`
--

CREATE TABLE `menage` (
  `nom_menage` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_menage` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_menage` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menage`
--

INSERT INTO `menage` (`nom_menage`, `tel_menage`, `code_menage`) VALUES
('Menage de RASOARIVONY', '03406203158', 'M001'),
('Menage de RABE', '034302319', 'M003'),
('Menage de JEAN', '0346985212', 'M23'),
('Menage de LUCAS', '0325698478', 'M6555'),
('Menage de ALANIS', '0346985721', 'M783');

--
-- Déclencheurs `menage`
--
DELIMITER $$
CREATE TRIGGER `after_insert_menage` AFTER INSERT ON `menage` FOR EACH ROW INSERT INTO audit(id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'ajouté', NOW(), NEW.code_menage, 'menage', '301001001')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_menage` AFTER UPDATE ON `menage` FOR EACH ROW INSERT INTO audit (id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'modifié', NOW(), NEW.code_menage, 'menage', '301001001')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_menage` BEFORE DELETE ON `menage` FOR EACH ROW INSERT INTO audit(id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'supprimé', NOW(), OLD.code_menage, 'menage', '301001001')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `code_personne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pere_personne_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mere_personne_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_personne` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_personne` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`code_personne`, `pere_personne_id`, `mere_personne_id`, `nom_personne`, `prenom_personne`, `date_naissance`, `sexe`) VALUES
('dqsd12', 'P456', 'P456', 'dqsdq', 'qsdqsd', '2121-12-12', 'Homme'),
('dsvfsfdsd', 'P002', 'P035', 'fsdf', 'fdsdf', '2023-11-01', 'Homme'),
('gtt', NULL, NULL, 'gtg', 'gtgt', '2422-02-04', 'Homme'),
('ooooo', NULL, NULL, 'oooo', 'ooo', '2002-02-12', 'Homme'),
('P001', NULL, NULL, 'RASOARIVONY', 'Weeny', '1998-07-15', 'Homme'),
('P0012', NULL, NULL, 'Lekamisy', 'alanis ulrich', '2007-10-27', 'Homme'),
('P002', NULL, NULL, 'RAZAFIMANDIMBY', 'Olandine', '2003-01-24', 'Femme'),
('P035', NULL, NULL, 'RAKOTO', 'Patrique Patrique', '2005-02-24', 'Homme'),
('P077', 'PA01', NULL, 'Champion', 'Boy', '2005-08-08', 'Homme'),
('P21211', NULL, NULL, 'RAZAFIMANDIMBY', 'Vanne Jauvanie', '5422-04-12', 'Homme'),
('P365', 'P001', 'P002', 'RASOARIVONY', 'Iron Jade', '2006-05-04', 'Homme'),
('P456', NULL, NULL, 'LEMAZAVA', 'Angelo', '1899-05-12', 'Homme'),
('P45666', 'P035', 'P546', 'RAZAFIMANDIMBY', 'Soaravo Ornelah', '2005-10-09', 'Femme'),
('P546', NULL, NULL, 'SOARAVO', 'Georgine', '2222-02-12', 'Femme'),
('P5656', NULL, NULL, 'HIRMANCE', 'LUCO', '2023-10-31', 'Homme'),
('P68', NULL, NULL, 'RAKOTO', 'Jean', '2005-03-12', 'Homme'),
('P8787', NULL, NULL, 'RAZAFIMANDIMBY', 'Soaravo Trichiah', '2016-02-12', 'Femme'),
('P9898', NULL, NULL, 'Tonton', 'alex', '2000-02-15', 'Homme'),
('P9999', NULL, NULL, 'RAZAFIMANDIMBY', 'Roland', '2222-02-10', 'Homme'),
('PA01', NULL, NULL, 'Patrique', 'agent', '2003-02-02', 'Homme'),
('sfdfdfgfg', NULL, NULL, 'ghjghjgh', 'kjhkjkh', '5222-02-10', ''),
('sqdq', NULL, NULL, 'dqsdq', 'dqsdq', '2002-02-12', 'Homme'),
('uuu', NULL, NULL, 'uuuu', 'uuuu', '2001-02-12', 'Homme');

--
-- Déclencheurs `personne`
--
DELIMITER $$
CREATE TRIGGER `after_update` AFTER UPDATE ON `personne` FOR EACH ROW INSERT INTO audit (id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'modifié', NOW(), NEW.code_personne, 'personne','301001001')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete` BEFORE DELETE ON `personne` FOR EACH ROW INSERT INTO audit (id, type_operation,date,identite, propriete, agent) VALUES (NULL,'supprimé', NOW(), OLD.code_personne, 'personne', '301001001')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `create_personne` AFTER INSERT ON `personne` FOR EACH ROW INSERT INTO audit (id, type_operation, date, identite, propriete, agent) VALUES (NULL, 'ajouté', NOW(), NEW.code_personne, 'personne','301001001')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `quartier`
--

CREATE TABLE `quartier` (
  `code_quartier` int(11) NOT NULL,
  `unite_id` int(11) DEFAULT NULL,
  `nom_quartier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parcelle` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `quartier`
--

INSERT INTO `quartier` (`code_quartier`, `unite_id`, `nom_quartier`, `parcelle`) VALUES
(301001001, 301001, 'Depot analakininina', '23/44'),
(301002003, 301002, 'Ambolmadininka', '21/41');

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `code_region` int(11) NOT NULL,
  `nom_region` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`code_region`, `nom_region`) VALUES
(31, 'Antsinanana'),
(51, 'Haut Matsiatra'),
(61, 'Behily');

-- --------------------------------------------------------

--
-- Structure de la table `type_maison`
--

CREATE TABLE `type_maison` (
  `id` int(11) NOT NULL,
  `nom_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_maison`
--

INSERT INTO `type_maison` (`id`, `nom_type`) VALUES
(1, 'en dure'),
(2, 'semi-dure'),
(3, 'Bulding'),
(4, 'villa');

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

CREATE TABLE `unite` (
  `code_unite` int(11) NOT NULL,
  `commune_id` int(11) DEFAULT NULL,
  `nom_unite` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `unite`
--

INSERT INTO `unite` (`code_unite`, `commune_id`, `nom_unite`) VALUES
(301001, 301, 'Anjoma'),
(301002, 301, 'Ambolimadinika'),
(301003, 301, 'Ampasimbe'),
(301004, 301, 'Tsarakofafa'),
(301005, 301, 'Tanambao V'),
(301006, 301, 'Tanambao I'),
(301007, 301, 'Tanambao II');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `agent_id`) VALUES
(6, 'weeny@gmail.com', '[\"ROLE_USER\"]', '$2y$13$iJcowJpTOyqPGuDnSomLpuz84roMP7eu.Guhds2ddg3pPpEXpKS82', 1),
(7, 'tontonweeny@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$9FjnReMlPfP5PIbtdZbgvO3TdQwkRSSUb0ZOjE5aJhPen3AcVycw6', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_268B9C9DDF1E57AB` (`quartier_id`),
  ADD UNIQUE KEY `UNIQ_268B9C9DEC4A74AB` (`unite_id`),
  ADD UNIQUE KEY `UNIQ_268B9C9D131A4F72` (`commune_id`),
  ADD UNIQUE KEY `UNIQ_268B9C9D98260155` (`region_id`);

--
-- Index pour la table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`code_commune`),
  ADD KEY `IDX_E2E2D1EE98260155` (`region_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`code_entreprise`),
  ADD KEY `IDX_D19FA6076C50E4A` (`proprietaire_id`),
  ADD KEY `IDX_D19FA60DF1E57AB` (`quartier_id`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5E9E89CB9D67D8AF` (`maison_id`),
  ADD KEY `IDX_5E9E89CB75E5878B` (`menage_id`);

--
-- Index pour la table `maison`
--
ALTER TABLE `maison`
  ADD PRIMARY KEY (`lot_maison`),
  ADD KEY `IDX_F90CB66D29A199BF` (`type_maison_id`),
  ADD KEY `IDX_F90CB66D76C50E4A` (`proprietaire_id`),
  ADD KEY `IDX_F90CB66DDF1E57AB` (`quartier_id`);

--
-- Index pour la table `membre_menage`
--
ALTER TABLE `membre_menage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4BFB9933A21BD112` (`personne_id`),
  ADD KEY `IDX_4BFB993375E5878B` (`menage_id`);

--
-- Index pour la table `menage`
--
ALTER TABLE `menage`
  ADD PRIMARY KEY (`code_menage`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`code_personne`),
  ADD KEY `IDX_FCEC9EFDDCAB802` (`pere_personne_id`),
  ADD KEY `IDX_FCEC9EF32A7C4C5` (`mere_personne_id`);

--
-- Index pour la table `quartier`
--
ALTER TABLE `quartier`
  ADD PRIMARY KEY (`code_quartier`),
  ADD KEY `IDX_FEE8962DEC4A74AB` (`unite_id`);

--
-- Index pour la table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`code_region`);

--
-- Index pour la table `type_maison`
--
ALTER TABLE `type_maison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`code_unite`),
  ADD KEY `IDX_1D64C118131A4F72` (`commune_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D6493414710B` (`agent_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `membre_menage`
--
ALTER TABLE `membre_menage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_maison`
--
ALTER TABLE `type_maison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `FK_268B9C9D131A4F72` FOREIGN KEY (`commune_id`) REFERENCES `commune` (`code_commune`),
  ADD CONSTRAINT `FK_268B9C9D98260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`code_region`),
  ADD CONSTRAINT `FK_268B9C9DDF1E57AB` FOREIGN KEY (`quartier_id`) REFERENCES `quartier` (`code_quartier`),
  ADD CONSTRAINT `FK_268B9C9DEC4A74AB` FOREIGN KEY (`unite_id`) REFERENCES `unite` (`code_unite`);

--
-- Contraintes pour la table `commune`
--
ALTER TABLE `commune`
  ADD CONSTRAINT `FK_E2E2D1EE98260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`code_region`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `FK_D19FA6076C50E4A` FOREIGN KEY (`proprietaire_id`) REFERENCES `personne` (`code_personne`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_D19FA60DF1E57AB` FOREIGN KEY (`quartier_id`) REFERENCES `quartier` (`code_quartier`);

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_5E9E89CB75E5878B` FOREIGN KEY (`menage_id`) REFERENCES `menage` (`code_menage`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_5E9E89CB9D67D8AF` FOREIGN KEY (`maison_id`) REFERENCES `maison` (`lot_maison`) ON DELETE SET NULL;

--
-- Contraintes pour la table `maison`
--
ALTER TABLE `maison`
  ADD CONSTRAINT `FK_F90CB66D29A199BF` FOREIGN KEY (`type_maison_id`) REFERENCES `type_maison` (`id`),
  ADD CONSTRAINT `FK_F90CB66D76C50E4A` FOREIGN KEY (`proprietaire_id`) REFERENCES `personne` (`code_personne`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_F90CB66DDF1E57AB` FOREIGN KEY (`quartier_id`) REFERENCES `quartier` (`code_quartier`);

--
-- Contraintes pour la table `membre_menage`
--
ALTER TABLE `membre_menage`
  ADD CONSTRAINT `FK_4BFB993375E5878B` FOREIGN KEY (`menage_id`) REFERENCES `menage` (`code_menage`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_4BFB9933A21BD112` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`code_personne`) ON DELETE SET NULL;

--
-- Contraintes pour la table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `FK_FCEC9EF32A7C4C5` FOREIGN KEY (`mere_personne_id`) REFERENCES `personne` (`code_personne`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_FCEC9EFDDCAB802` FOREIGN KEY (`pere_personne_id`) REFERENCES `personne` (`code_personne`) ON DELETE SET NULL;

--
-- Contraintes pour la table `quartier`
--
ALTER TABLE `quartier`
  ADD CONSTRAINT `FK_FEE8962DEC4A74AB` FOREIGN KEY (`unite_id`) REFERENCES `unite` (`code_unite`);

--
-- Contraintes pour la table `unite`
--
ALTER TABLE `unite`
  ADD CONSTRAINT `FK_1D64C118131A4F72` FOREIGN KEY (`commune_id`) REFERENCES `commune` (`code_commune`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6493414710B` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
