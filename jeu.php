<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Jeu</title>
    </head>
    <body>
        <?php
		
			include('modele/ModeleJoueur.php');
			include('modele/ModelePartie.php');
			include('modele/ModeleManche.php');
		
            //define('ROOT', dirname(__FILE__));
            //define('DS', dirname(DIRECTORY_SEPARATOR));
            //include ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            //AFTER CHRONO
            //require_once ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
			$j1 = new ModeleJoueur(1, "Jean", "Homme", 25);
			$j2 = new ModeleJoueur(2, "Jeanne", "Femme", 22);
			$p1 = new ModelePartie(1, $j1, $j2);
			$nbmanche = 1;
			while ($nbmanche =! 3) {
				$m = new Manche($nbmanche);
				//reste du code à faire
				$p1.ajoutManche($m);
				$nbmanche++;  
			}

        ?>
    </body>
</html>
