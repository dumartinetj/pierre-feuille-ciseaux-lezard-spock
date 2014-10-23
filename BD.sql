DROP TABLE Figure;
DROP TABLE Joueur;
DROP TABLE StatsPerso;
DROP TABLE StatsGlobales;

CREATE TABLE Figure 
(
	idFigure INTEGER ,
    nom VARCHAR(10),
    forces INTEGER,
    faiblesses INTEGER
);

CREATE TABLE Joueur 
(
	idJoueur INTEGER ,
    pseudo VARCHAR(20) ,
    sexe VARCHAR(1) ,
    age VARCHAR(100),
	nbV INTEGER,
	nvD INTEGER,
	passw VARCHAR(255) ,
	email VARCHAR(255)
);

CREATE TABLE StatsPerso
(
	idCoup INTEGER ,
	idJoueur INTEGER ,
	listeCoupManche VARCHAR(255) 
	/* utiliser une méthode pour séparé une string éléments par éléments*/
);

CREATE TABLE StatsGlobales
(
	idManche INTEGER ,
	idJoueur1 VARCHAR(20) ,
	idJoueur2 VARCHAR(20) ,
	listeCoups VARCHAR(255)  
	/*utiliser une méthode pour séparer une string tout les deux éléments 
	pour obtenir les deux coups jouer par les joueurs, 
	utilisé une méthode qui sépare les string éléments par éléments pour obtenir les coup de chaque joueur
	coups du joueur1= chiffres impairs et coup joueur2=chiffres pairs*/
);

/*CREATE TEMPORARY TABLE  Coup_temp 
AS (
	idCoupTemp INTEGER ,
	idFig1 INTEGER,
	idFig2 INTEGER,
	idJ1 INTEGER,
	idJ2 INTEGER,
	idGagnant INTEGER,
);*/



	
