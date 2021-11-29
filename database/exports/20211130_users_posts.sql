-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 29 nov. 2021 à 23:59
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `roddit`
--

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created_at`, `created_by`) VALUES
(1, 'Article Wikipedia Kiwi', 'Les kiwis sont des fruits de plusieurs espèces de lianes du genre Actinidia, famille des Actinidiaceae. Ils sont originaires de Chine1,2, notamment de la province de Shaanxi. On en trouve par ailleurs dans des climats dits montagnards tropicaux. En France, les kiwis de l\'Adour sont les seuls à disposer d\'une indication géographique protégée (IGP)2 et d\'un label rouge.\r\n\r\nÀ maturité, la pulpe du kiwi généralement verte (parfois jaune pour certaines variétés) est sucrée et acidulée, entourée d\'une peau souvent brune et duveteuse, et contient une centaine de minuscules graines noires comestibles.\r\n\r\nLe kiwi est exceptionnellement riche en vitamine C, il est aussi source de vitamines K et B9 (acide folique) ainsi que de cuivre et de potassium.\r\n\r\nLes kiwis sont des fruits de différentes espèces, principalement : Actinidia chinensis, Actinidia deliciosa, Actinidia arguta (kiwaï), Actinidia kolomikta (kiwi arctique) ou Actinidia polygama.\r\n\r\nLes autres noms vernaculaires du kiwi sont entre a', '2021-11-29', 1),
(2, 'Qu\'est-ce que l\'énergie nucléaire ?', 'Une centrale nucléaire se compose de 4 parties principales :\r\n\r\n    le bâtiment contenant le réacteur dans lequel a lieu la fission\r\n    la salle des machines où est produite l\'électricité\r\n    les départs de lignes électriques qui évacuent et transportent l\'électricité\r\n    des tours de refroidissement uniquement en bord de rivière\r\n\r\nEn France, un réacteur d\'essai est mis au point en 1948 (6 ans après la construction du premier réacteur dans le monde, implanté aux États-Unis).\r\n\r\nLa production d\'électricité d\'origine nucléaire est développée plus largement à partir de 1974, au lendemain du 1er choc pétrolier, révélateur de la dépendance énergétique du pays vis-à-vis des hydrocarbures.\r\n\r\nAujourd\'hui, le parc nucléaire géré par EDF compte 56 réacteurs de niveaux de puissance différents répartis sur 18 sites.\r\n\r\nL\'énergie nucléaire n\'émet pas de gaz à effet de serre. Elle est utilisable en grandes quantités grâce aux puissances qu\'elle génère et elle est très compétitive.', '2020-12-29', 1),
(3, 'Ceci est un test de retour à la ligne', 'Bonjour,\r\nComment allez-vous\r\naujourd\'hui?\r\n\r\nJ\'espère que.', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `dateNaissance` date NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `dateNaissance`, `username`, `password`, `role`, `email`) VALUES
(1, 'Doe', 'John', '1990-11-10', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'john.doe@mail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
