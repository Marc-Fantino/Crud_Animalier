-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 mars 2022 à 08:30
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(255) NOT NULL,
  `description_produit` text NOT NULL,
  `prix_produit` float NOT NULL,
  `stock_produit` tinyint(1) NOT NULL,
  `image_produit` varchar(255) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `image_produit`) VALUES
(1, 'Crane de décoration ', 'crane de décoration pour Vivarium et pour tenir compagnie a votre animal de compagnie préféré.', 25, 20, '../assets/img/crane.jpg'),
(2, 'Vivarium XXL', 'Ce terrarium en verre est l\'habitat idéal pour les reptiles, tortues et les amphibiens. Le couvercle grillagé coulissant facilite l\'entretien et le nourrissage et permet aux rayons U.V.B. et infrarouges de pénétrer. Un loquet est spécialement conçu pour empêcher les reptiles de s\'enfuir.\r\n', 1250, 5, '../assets/img/vivarium_XXL.jpg'),
(3, 'Sable de décoration', 'Ces graviers épais 6-9 mm pour fond d\'aquarium Coloré seront parfaits pour agrémenter votre aquarium et lui amener une petite touche de couleur.\r\nConditionnement : Vendu à l\'unité\r\nMatière : Pierre\r\nMarque : Aqua Della\r\nCouleur : Blanc, Gris, Noir, Vert, Bleu, Rose, Mauve\r\nContenance : Sac 2 Kg\r\nType de décoration : Gravier', 45.5, 50, '../assets/img/sable_seul.jpg'),
(4, 'Meuble pour aquarium', 'Meuble pour aquarium Iseo 100 inspiré des tendances actuelles, pourvu de 6 niches dont 3 avec porte. Iloffre un espace important de rangement et de décoration. Charge maximale du meuble : 160 Kg. Coloris : blanc.', 799.99, 2, '../assets/img/meuble_vivarium.jpg'),
(5, 'Kit aquarium Aqua clear 50 noir - Noir', 'Aquarium de 32 litres pour poissons d\'eau froide et exotiques , Doté de plots en silicone à installer sous la cuve avant mise en eau pour amortir l\'appui et éviter le glissement , Avec couvercle en verre qui permet la diffusion de l\'éclairage et évite les éclaboussures , En verre d\'épaisseur 4 mm , Basse consommation avec un luminaire LED 3.6W 15000K 230Lm avec interrupteur tactile 3 positions : jour/bleu/off , filtre cascade de 280L/h (consommation environ 4W) comprenant un bloc de mousse pour stopper les impuretés et une cartouche de charbon actif et zéolite pour une épuration chimique de l\'eau , Dimensions de la cuve : L 50 x p 25 x h 30 cm , Volume : 32L', 119, 20, '../assets/img/vivarium.jpg'),
(6, 'belles-décorations-aquarium', 'La racine de Mopani est idéale pour créer vos propres arrangements avec vos tillandsias préférées. Laissez libre cours à votre imagination et mettez ainsi de nouveaux accents dans votre espace de vie.\r\n\r\nAstuce : Appliquer les tillandsias uniquement avec de la colle froide. La colle chaude peut brûler votre plante et la faire mourir.', 79.5, 20, '../assets/img/belles-decorations-aquarium.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(255) NOT NULL,
  `description_produit` text NOT NULL,
  `prix_produit` float NOT NULL,
  `stock_produit` tinyint(1) NOT NULL,
  `date_depot` datetime NOT NULL,
  `image_produit` varchar(255) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `date_depot`, `image_produit`) VALUES
(5, 'python serpent', 'Le terme Python est un nom vernaculaire ambigu désignant en français plusieurs espèces de serpents appartenant à différents genres des familles des Pythonidae et des Loxocemidae. Python est le nom scientifique d\'un genre de serpents de la famille des Pythonidae.\r\nCe serpent mesure entre un mètre et un mètre et demi. Son corps est trapu et couvert d\'écailles jaunes, beiges et brunes.\r\nSa force est extraordinaire. En cas de danger il s\'enroule sur lui même et il ne faut surtout pas essayer de le dérouler car il pourrait mordre et se venger.\r\n\r\nIl est actif surtout la nuit et se nourrit de rongeurs vivants. Certains pythons de grande taille peuvent s\'attaquer à des petits cochons, des moutons et des chèvres.\r\n\r\nLe python n\'est pas venimeux, il tue ses proies en s\'enroulant autour d\'elles et en les serrant jusqu\'à ce qu\'elles meurent et les avale ensuite.', 500.2, 0, '2022-03-07 16:02:48', '../assets/img/python_serpent.jpg'),
(6, 'Serpent Orange', 'Le serpent-tigre (Notechis scutatus) est généralement de couleur jaune orange avec des bandes vertes, mais peut également arborer un vert uni ou encore un noir brillant\r\nLa première chose à remarquer, c\'est que les serpents n\'ont pas de membres, ou pattes, pour se déplacer. Ils se déplacent donc pas des mouvements oscillatoires de leur corps, ou en accordéon, utilisant leurs larges écailles ventrales pour s\'aider.\r\n\r\nLes oreilles, orifices et tympans sont inexistants, comme chez certains autres reptiles, et ils utilisent donc les vibrations du sol et de l\'air pour détecter les animaux qui peuvent s\'approcher de lui.\r\n\r\nLa peau de serpent est recouverte d\'écailles, habituellement plus larges sur le ventre. Elles sont alternées sur le dos, mais sont plus larges et successives sur le ventre. Le nombre d\'écailles dans une rangée dépend de l\'espèce de serpent et de la grosseur des écailles, variant de 13 à 150 par rangée. Le nombre peut être constant en diminuant de grosseur, ou varier en nombre pour diminuer vers la queue qui est plus petite. Les serpents muent afin de remplacer périodiquement leur peau.', 355.2, 0, '2022-03-07 15:06:02', '../assets/img/serpent_orange.jpg'),
(7, 'Gecko Blanc', 'Les geckos forment une famille de reptiles de l\'ordre des squamates : ce sont des cousins des serpents. Il en existe plusieurs espèces. Les geckos français mesurent jusqu\'à 15 cm, pour la plus grande espèce\r\nIl est possible de maintenir un gecko en captivité dans un terrarium cependant, même s\'il est relativement facile de les maintenir en vie il y a des règles à respecter ainsi qu\'un code éthique.\r\n\r\nL\'ADN \"simple\" de ces petits reptiles est capable d\'évoluer très rapidement, il est donc prédisposé aux dégénérescences liées à la consanguinité lors d\'élevages en captivité.\r\n\r\nQuelques règles éthiques :\r\n\r\nAssurer un environnement sain et de taille suffisante,\r\nNe pas maintenir différentes espèces de geckos dans un même terrarium,\r\nRespecter le régime alimentaire de l\'espèce,\r\nNe pas faire se reproduire un \"couple\" issu d\'une même famille (d\'une même lignée) ceci pouvant entrainer des malformations...\r\nPour que le gecko s\'habitue à votre compagnie, il faut le laisser 24 h dans sa cage puis le sortir et le laisser 2 minutes hors de sa cage. Si on achète un autre gecko, habituez-le avec le premier gecko pour qu’ils ne se battent pas.', 200.2, 1, '2022-03-08 09:37:21', '../assets/img/gecko_1.jpg'),
(8, 'Gecko des sables', 'Les geckos forment une famille de reptiles de l\'ordre des squamates : ce sont des cousins des serpents. Il en existe plusieurs espèces. Les geckos français mesurent jusqu\'à 15 cm, pour la plus grande espèce\r\nIl est possible de maintenir un gecko en captivité dans un terrarium cependant, même s\'il est relativement facile de les maintenir en vie il y a des règles à respecter ainsi qu\'un code éthique.\r\n\r\nL\'ADN \"simple\" de ces petits reptiles est capable d\'évoluer très rapidement, il est donc prédisposé aux dégénérescences liées à la consanguinité lors d\'élevages en captivité.\r\n\r\nQuelques règles éthiques :\r\n\r\nAssurer un environnement sain et de taille suffisante,\r\nNe pas maintenir différentes espèces de geckos dans un même terrarium,\r\nRespecter le régime alimentaire de l\'espèce,\r\nNe pas faire se reproduire un \"couple\" issu d\'une même famille (d\'une même lignée) ceci pouvant entrainer des malformations...\r\nPour que le gecko s\'habitue à votre compagnie, il faut le laisser 24 h dans sa cage puis le sortir et le laisser 2 minutes hors de sa cage. Si on achète un autre gecko, habituez-le avec le premier gecko pour qu’ils ne se battent pas.', 500.2, 1, '2022-03-08 09:38:27', '../assets/img/gecko_2.jpg'),
(9, 'Lezard Vert', 'Les lézards appartiennent à la grande famille des reptiles et doivent leur nom au Grec sauros (Lézard) qui constitue le sous-ordre des Sauriens. Il existe une petite vingtaine de familles de lézardsdans le monde\r\nLes lézards sont en général des ovipares, mais quelques espèces sont vivipares. Après l\'accouplement, la femelle va pondre et enterrer ses oeufs dans un endroit chaud et humide, comme l\'humus, la vase, ou un trou dans le sol. Les parents ne s\'occupent pas des petits, qui sont laissés à eux-même, et sont autonomes immédiatement sortit de l\'oeuf.\r\n\r\nDans les régions tempérées, ils vont devenir de plus en plus léthargiques, et se cacher pour hiverner jusqu\'au retour de la saison chaude.\r\n\r\n', 355.2, 1, '2022-03-08 09:39:18', '../assets/img/lezard.jpg'),
(10, 'Grand dragon Komodo', 'Varanus komodoensis Le Dragon de Komodo ou Varan de Komodo (Varanus komodoensis ) est une espèce de varan qui se rencontre dans les îles de Komodo, Rinca, Florès, Gili Motang et Gili Dasami en Indonésie centrale . Membre de la famille des varanidés, c\'est la plus grande espèce vivante\r\nse rencontre dans les îles de Komodo, Rinca, Florès, Gili Motang et Gili Dasami en Indonésie centrale2. Membre de la famille des varanidés, c\'est la plus grande espèce vivante de lézard, avec une longueur moyenne 2,59 mètres et une masse d\'environ 79 à 91 kg. Sa taille inhabituelle est parfois attribuée au gigantisme insulaire car il n\'existe pas, dans son habitat naturel, d\'autres animaux carnivores pouvant occuper ou partager sa niche écologique, ainsi qu\'à ses faibles besoins en énergie3,4. Il est possible que cet animal soit au contraire une forme naine du Mégalania, un varan géant de 8 mètres de long ayant vécu en Australie au moins jusqu\'à l\'arrivée des premiers aborigènes. En raison de leur taille, ces varans, avec l\'aide de bactéries symbiotiques, dominent les écosystèmes dans lesquels ils vivent5. Bien que les dragons de Komodo mangent surtout des charognes, ils se nourrissent également d\'animaux qu\'ils chassent (invertébrés, oiseaux ou mammifères).', 10000, 10, '2022-03-08 09:41:35', '../assets/img/dragon-komodo-grande.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `login_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `prenom_user` varchar(255) NOT NULL,
  `creation_user` date NOT NULL,
  `password_user` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`login_user`, `email_user`, `prenom_user`, `creation_user`, `password_user`) VALUES
('Login', 'essai@gmail.fr', '\r\nmarc', '2022-03-10', '1234'),
('login1', 'essai1@gmail.fr', 'Alice', '2022-03-10', 'azerty');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
