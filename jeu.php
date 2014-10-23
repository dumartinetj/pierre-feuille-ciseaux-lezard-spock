<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Jeu</title>
    </head>
    <body>
        <?php
            include_once('modele/Joueur.php');
            include_once('modele/Partie.php');
            include_once('modele/Manche.php');
            include_once('modele/Coup.php');
            include_once('modele/Figure.php');
            include_once('modele/Ciseaux.php');
            include_once('modele/Lezard.php');
            include_once('modele/Spock.php');
            include_once('modele/Feuille.php');
            include_once('modele/Pierre.php');
            //define('ROOT', dirname(__FILE__));
            //define('DS', dirname(DIRECTORY_SEPARATOR));
            //include ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            //AFTER CHRONO
            //require_once ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            $j1 = new Joueur(1, "Jean", "Homme", 25, "a@a.com", "1234567879");
            $j2 = new Joueur(2, "Jeanne", "Femme", 22, "a@a.com", "1234567879");
            $partie = new Partie(1, 5, $j1, $j2);
            $nbmanche = 1;
			$nbcoup=1;
            while ($nbmanche <= 3) { // changer la condition par $this->checkPartieFini()
				echo 'Début de la manche '.$nbmanche.'<br/>';
                $manche = new Manche($nbmanche);
                $nbcoup=1;
                $coup = new Coup($nbcoup,new Ciseaux(),new Ciseaux(),$j1,$j2);
                $manche->ajoutCoup($coup);
				$f1 = $coup->getFigureJoueur1();
				$f2 = $coup->getFigureJoueur2();
				echo $j1->getPseudo().' a joué '.$f1->quiSuisJe().'<br/>';
				echo $j2->getPseudo().' a joué '.$f2->quiSuisJe().'<br/>';
                if($coup->estUnDraw()){
                    do {
						echo 'Le coup joué est un draw !<br/>';
						echo 'On rejout le coup !<br/>';
                        $nbcoup++;
                        $coup=new Coup($nbcoup,new Lezard(), new Pierre(),$j1,$j2);
                        $manche->ajoutCoup($coup);
                        $f1 = $coup->getFigureJoueur1();
                        $f2 = $coup->getFigureJoueur2();
                        echo $j1->getPseudo().' a joué '.$f1->quiSuisJe().'<br/>';
                        echo $j2->getPseudo().' a joué '.$f2->quiSuisJe().'<br/>';
					} while($coup->estUnDraw());
				}
                $coup->evaluer();
                echo 'Le coup joué est validé !<br/>';
                $manche->ajoutCoup($coup);
				$gagnantManche = $manche->getJoueurGagnantManche();				
				echo ''.$gagnantManche->getPseudo().' a gagné la manche !<br/>';
				$partie->ajoutManche($manche);
				$nbmanche++;
				echo 'Manche terminé<br/>';
            }
			// il faut afficher le gagnant de la partie ici
            echo 'Partie terminé<br/>';
        ?>
    </body>
</html>
