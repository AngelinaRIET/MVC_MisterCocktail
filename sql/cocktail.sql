SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `MisterCocktail`
--
CREATE DATABASE IF NOT EXISTS `MisterCocktail` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `MisterCocktail`;

-- --------------------------------------------------------

--
-- Structure de la table `Cocktail`
--

CREATE TABLE `Cocktail` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `urlPhoto` varchar(50) NOT NULL,
  `dateConception` date NOT NULL,
  `prixMoyen` float NOT NULL,
  `idFamille` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Cocktail`
--

INSERT INTO `Cocktail` (`id`, `nom`, `description`, `urlPhoto`, `dateConception`, `prixMoyen`, `idFamille`) VALUES
(1, 'Aperol Spritz', 'Le Spritz est un cocktail datant du siècle dernier. Il aurait été inventé par des soldats autrichiens qui trouvaient le vin italien trop chargé en alcool.<br><br>L’auriez-vous deviné ?', 'aperol-spritz.jpg', '1938-01-01', 9.75, 1),
(2, 'Mojito', 'La création du Mojito remonte au XVIe siècle lorsque Francis Draque, le célèbre corsaire anglais, avait pour habitude de célébrer ses pillages en sirotant à La Havane, du tafia (l’ancêtre du rhum), aromatisé de quelques feuilles de menthe et de citron.', 'mojito.jpg', '1583-01-01', 10, 2),
(3, 'Piña Colada', 'Le cocktail Piña Colada puise ses origines à Puerto Rico où il a été inventé par un barman de l’hôtel Caribe Hilton en 1954. Décrétée 30 ans plus tard boisson nationale, cet élixir doux et fruité concentre dans le verre toutes les saveurs ensoleillées des Caraïbes.', 'pina-colada.jpg', '1954-01-01', 8.85, 2),
(6, 'Punch', 'Historiquement, le punch date du XVIe siècle. Il aurait été créé par des marins britanniques en mélangeant du Tafia (un genre de rhum brut) qui était embarqué sur les navires, avec d’autres ingrédients.', 'punch.jpg', '1532-01-01', 9, 2),
(7, 'Punch Exotique', 'Historiquement, le punch date du XVIe siècle. Il aurait été créé par des marins britanniques en mélangeant du Tafia (un genre de rhum brut) qui était embarqué sur les navires, avec d’autres ingrédients.', 'punch-exotique.jpg', '1532-01-01', 10.55, 2),
(8, 'Soupe de Champagne', 'À l’origine, c’était Pierre «Dom» Pérignon (1635-1713) qui dirigeait un monastère à Reims et qui a marqué l’histoire du champagne tout en contribuant beaucoup à sa renommée.', 'soupe-champagne.jpg', '1621-01-01', 12.35, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Cocktail_Ingredient`
--

CREATE TABLE `Cocktail_Ingredient` (
  `id` int(11) NOT NULL,
  `idCocktail` int(11) NOT NULL,
  `idIngredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Cocktail_Ingredient`
--

INSERT INTO `Cocktail_Ingredient` (`id`, `idCocktail`, `idIngredient`) VALUES
(1, 1, 1),
(2, 1, 6),
(3, 8, 5),
(4, 6, 6),
(5, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Famille`
--

CREATE TABLE `Famille` (
  `id` int(11) NOT NULL,
  `nomFamille` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Famille`
--

INSERT INTO `Famille` (`id`, `nomFamille`) VALUES
(1, 'Vodka'),
(2, 'Rhum'),
(3, 'Whisky'),
(4, 'Champagne'),
(5, 'Sans alcool'),
(6, 'Aperol');

-- --------------------------------------------------------

--
-- Structure de la table `Ingredient`
--

CREATE TABLE `Ingredient` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Ingredient`
--

INSERT INTO `Ingredient` (`id`, `nom`) VALUES
(1, 'Aperol'),
(2, 'Citron'),
(3, 'Sucre'),
(4, 'Menthe'),
(5, 'Cointreau'),
(6, 'Orange');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Cocktail`
--
ALTER TABLE `Cocktail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFamille` (`idFamille`);

--
-- Index pour la table `Cocktail_Ingredient`
--
ALTER TABLE `Cocktail_Ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCocktail` (`idCocktail`),
  ADD KEY `idIngredient` (`idIngredient`);

--
-- Index pour la table `Famille`
--
ALTER TABLE `Famille`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Ingredient`
--
ALTER TABLE `Ingredient`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Cocktail`
--
ALTER TABLE `Cocktail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Cocktail_Ingredient`
--
ALTER TABLE `Cocktail_Ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Famille`
--
ALTER TABLE `Famille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Ingredient`
--
ALTER TABLE `Ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Cocktail`
--
ALTER TABLE `Cocktail`
  ADD CONSTRAINT `cocktail_ibfk_1` FOREIGN KEY (`idFamille`) REFERENCES `Famille` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Cocktail_Ingredient`
--
ALTER TABLE `Cocktail_Ingredient`
  ADD CONSTRAINT `cocktail_ingredient_ibfk_1` FOREIGN KEY (`idCocktail`) REFERENCES `Cocktail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cocktail_ingredient_ibfk_2` FOREIGN KEY (`idIngredient`) REFERENCES `Ingredient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
