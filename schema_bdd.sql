DROP TABLE IF EXISTS pfcls_Coups;
DROP TABLE IF EXISTS pfcls_StatistiquesPersonnelles;
DROP TABLE IF EXISTS pfcls_StatistiquesGlobales;
DROP TABLE IF EXISTS pfcls_Manches;
DROP TABLE IF EXISTS pfcls_Parties;
DROP TABLE IF EXISTS pfcls_Parties_en_attente;
DROP TABLE IF EXISTS pfcls_Joueurs;
DROP TABLE IF EXISTS pfcls_Figures;

CREATE TABLE pfcls_Figures
(
	idFigure INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(10) NOT NULL,
    forces VARCHAR(3) NOT NULL, /* on a INT,INT */
    faiblesses VARCHAR(3) NOT NULL, /* on a INT,INT */
	PRIMARY KEY (idFigure)
) ENGINE=INNODB ;

CREATE TABLE pfcls_Joueurs
(
	idJoueur INT NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(20) NOT NULL,
    sexe CHAR(1) NOT NULL, /* H ou F */
    age INT UNSIGNED NOT NULL, /* pas de signe donc toujours positif */
	nbV INT UNSIGNED NOT NULL, /* pas de signe donc toujours positif */
	nbD INT UNSIGNED NOT NULL, /* pas de signe donc toujours positif */
	pwd VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	PRIMARY KEY (idJoueur)
) ENGINE=INNODB ;

CREATE TABLE pfcls_Parties_en_attente
(
	idPartie_en_attente INT NOT NULL AUTO_INCREMENT,
	idJoueur INT NOT NULL, /* pas de signe donc toujours positif */
		nbManche INT UNSIGNED NOT NULL, /* pas de signe donc toujours positif */
	PRIMARY KEY (idPartie_en_attente),
	FOREIGN KEY (idJoueur) REFERENCES pfcls_Joueurs(idJoueur)
) ENGINE=INNODB;

CREATE TABLE pfcls_Parties
(
	idPartie INT NOT NULL AUTO_INCREMENT,
    nbManche INT UNSIGNED NOT NULL, /* pas de signe donc toujours positif */
    idJoueur1 INT NOT NULL, /* pas de signe donc toujours positif */
    idJoueur2 INT NOT NULL, /* pas de signe donc toujours positif */
	listeManches VARCHAR(255), /* de la forme idCoup1,idCoup2,idCoup3,etc. */
	idJoueurGagnant INT, /* pas de signe donc toujours positif */
	PRIMARY KEY (idPartie),
	FOREIGN KEY (idJoueur1) REFERENCES pfcls_Joueurs(idJoueur),
	FOREIGN KEY (idJoueur2) REFERENCES pfcls_Joueurs(idJoueur),
	FOREIGN KEY (idJoueurGagnant) REFERENCES pfcls_Joueurs(idJoueur)
) ENGINE=INNODB;

CREATE TABLE pfcls_Manches
(
	idManche INT NOT NULL AUTO_INCREMENT,
    listeCoups VARCHAR(255), /* de la forme idFigure1,idFigure2,idFigure3,etc. */
	idJoueurGagnant INT, /* pas de signe donc toujours positif */
	PRIMARY KEY (idManche),
	CONSTRAINT fk_manches_joueurgagnant_id FOREIGN KEY (idJoueurGagnant) REFERENCES pfcls_Joueurs(idJoueur)
) ENGINE = INNODB;

CREATE TABLE pfcls_Coups
(
	idCoup INT NOT NULL AUTO_INCREMENT,
    idFigure1 INT,
    idFigure2 INT,
    idJoueur1 INT NOT NULL,
    idJoueur2 INT NOT NULL,
	idJoueurGagnant INT, /* pas de signe donc toujours positif */
	PRIMARY KEY (idCoup),
	CONSTRAINT fk_coups_figure1_id FOREIGN KEY (idFigure1) REFERENCES pfcls_Figures(idFigure),
	CONSTRAINT fk_coups_figure2_id FOREIGN KEY (idFigure2) REFERENCES pfcls_Figures(idFigure),
	CONSTRAINT fk_coups_joueur1_id FOREIGN KEY (idJoueur1) REFERENCES pfcls_Joueurs(idJoueur),
	CONSTRAINT fk_coups_joueur2_id FOREIGN KEY (idJoueur2) REFERENCES pfcls_Joueurs(idJoueur),
	CONSTRAINT fk_coups_joueurgagnant_id FOREIGN KEY (idJoueurGagnant) REFERENCES pfcls_Joueurs(idJoueur)
) ENGINE = INNODB;

CREATE TABLE pfcls_StatistiquesPersonnelles
(
	idStatsPerso INT NOT NULL AUTO_INCREMENT,
    idJoueur INT NOT NULL,
	listeCoups VARCHAR(255), /* de la forme idFigure1,idFigure2,idFigure3,etc. */
	PRIMARY KEY (idStatsPerso),
	CONSTRAINT fk_statsperso_joueur_id FOREIGN KEY (idJoueur) REFERENCES pfcls_Joueurs(idJoueur)
) ENGINE = INNODB;

CREATE TABLE pfcls_StatistiquesGlobales
(
	idStatsGlob INT NOT NULL AUTO_INCREMENT,
    idJoueur1 INT NOT NULL,
    idJoueur2 INT NOT NULL,
	listeCoups VARCHAR(255), /* de la forme (idFigure1,idFigure2)(idFigure3,idFigure4),etc. */
	PRIMARY KEY (idStatsGlob),
	CONSTRAINT fk_statsperso_joueur1_id FOREIGN KEY (idJoueur1) REFERENCES pfcls_Joueurs(idJoueur),
	CONSTRAINT fk_statsperso_joueur2_id FOREIGN KEY (idJoueur2) REFERENCES pfcls_Joueurs(idJoueur)
) ENGINE = INNODB;

INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Pierre", "3,4", "2,5");
INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Feuille", "1,5", "3,4");
INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Ciseaux", "2,4", "5,1");
INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Lézard", "2,5", "3,1");
INSERT INTO pfcls_Figures (nom, forces, faiblesses) VALUES ("Spock", "1,3", "2,4");
