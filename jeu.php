<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Jeu</title>
    </head>
    <body>
        <?php
            define('ROOT', dirname(__FILE__));
            define('DS', dirname(DIRECTORY_SEPARATOR));
            //include ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            //AFTER CHRONO
            //require_once ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
			j1 = new Joueur(1, "Jean", "Homme", 25);
			j2 = new Joueur(2, "Jeanne", "Femme", 22);
			p1 = new Partie(1, j1, j2);
			$nbmanche = 1;
			while($nbmanche != 3) {
				// et là on fait les coups ect
			}

        ?>
    </body>
</html>
