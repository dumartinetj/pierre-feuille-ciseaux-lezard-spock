<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Jeu</title>
    </head>
    <body>
        <?php

			include('modele/Joueur.php');
			include('modele/Partie.php');
			include('modele/Manche.php');
			include('modele/Coup.php');
			include('modele/Figure.php');
			include('modele/Ciseaux.php');
			include('modele/Lezard.php');
			include('modele/Spock.php');
			include('modele/Feuille.php');
			include('modele/Pierre.php');

            //define('ROOT', dirname(__FILE__));
            //define('DS', dirname(DIRECTORY_SEPARATOR));
            //include ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            //AFTER CHRONO
            //require_once ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';

			$j1 = new Joueur(1, "Jean", "Homme", 25);
			$j2 = new Joueur(2, "Jeanne", "Femme", 22);
			$p1 = new Partie(1, $j1, $j2);
			$nbmanche = 1;
			while ($nbmanche <= 3) {
				echo 'Début de la manche '.$nbmanche.'<br/>';
                $m = new Manche($nbmanche);
                $nbcoup=1;
                $coup = new Coup($nbcoup,new Ciseaux(),new Ciseaux());
				$f1 = $coup->getFigureJoueur1();
				$f2 = $coup->getFigureJoueur2();
				echo 'Joueur 1 a joué '.$f1->quiSuisJe().'<br/>';
				echo 'Joueur 2 a joué '.$f2->quiSuisJe().'<br/>';
                if($m->verfiFinManche($coup)){
					while($m->verfiFinManche($coup)){
						echo 'Le coup joué est un draw !<br/>';
						$m->ajoutCoup($coup);
						$nbcoup++;
						$coup=new Coup($nbcoup,new Lezard(), new Pierre());
						$f1 = $coup->getFigureJoueur1();
						$f2 = $coup->getFigureJoueur2();
						echo 'Joueur 1 a joué '.$f1->quiSuisJe().'<br/>';
						echo 'Joueur 1 a joué '.$f2->quiSuisJe().'<br/>';
					}
				}
                else{
                    $coup->evaluer();
                    echo 'Le coup joué est validé !<br/>';
                    $m->ajoutCoup($coup);
                }
                $p1->ajoutManche($m);
                $nbmanche++;
		echo 'Manche terminé<br/>';
            }
            echo 'Partie terminé<br/>';
        ?>
    </body>
</html>
