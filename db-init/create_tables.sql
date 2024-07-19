USE arcadia;

CREATE TABLE IF NOT EXISTS `animaux` (
 `Prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `race` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `images_liste` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `habitat_ID` int NOT NULL,
 `ID` int NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `avis` (
 `ID` int NOT NULL AUTO_INCREMENT,
 `Pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `Avis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `Valider` tinyint(1) NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `comm_habitat` (
 `ID` int NOT NULL AUTO_INCREMENT,
 `Avis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `ETAT` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `Amelioration` tinyint(1) NOT NULL,
 `ID_Habitat` int NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cr_veto` (
 `ID` int NOT NULL AUTO_INCREMENT,
 `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `nourriture` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `grammage` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `date` date NOT NULL,
 `details` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `ID_Animal` int NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `habitat` (
 `Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `images_liste` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `ID` int NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `horaire` (
 `lundi` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 `mardi` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 `mercredi` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 `jeudi` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 `vendredi` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 `samedi` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 `dimanche` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `images` (
 `ID` int NOT NULL AUTO_INCREMENT,
 `Fichier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `nourriture` (
 `ID` int NOT NULL AUTO_INCREMENT,
 `ID_Animal` int NOT NULL,
 `Date` date NOT NULL,
 `heure` time NOT NULL,
 `nourriture` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `Quantité` decimal(10,0) NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `services` (
 `ID` int NOT NULL AUTO_INCREMENT,
 `Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `Description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `stats` (
 `ID_Animal` int NOT NULL,
 `Vues` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `utilisateur` (
 `mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `pwd` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
 `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `ID` int NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO utilisateur (mail, pwd, role) VALUES ('admin@gmail.com', '$2y$12$6/8J3DFQ9EUcWX1zgVqSneRZgM22fcNho5GsgWp7wEvfbvFTvN/zO', '1');

INSERT INTO `horaire`(`lundi`, `mardi`, `mercredi`, `jeudi`, `vendredi`, `samedi`, `dimanche`) VALUES ('08:00/11:00/12:00/19:00','08:00/11:00/12:00/19:00','08:00/11:00/12:00/19:00','08:00/11:00/12:00/19:00','08:00/11:00/12:00/19:00','08:00/11:00/12:00/19:00','08:00/11:00/12:00/19:00');