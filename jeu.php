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
            //----DEBUT de La Partie
            $j1 = new Joueur(1, "Jean", "Homme", 25);
            $j2 = new Joueur(2, "Jeanne", "Femme", 22);
            $partie = new Partie(1, $j1, $j2);
            $nbmanche = 1;
            while ($nbmanche <= 3) {
		echo 'Début de la manche '.$nbmanche.'<br/>';
                $manche = new Manche($nbmanche);
                $nbcoup=1;
                $coup = new Coup($nbcoup,new Ciseaux(),new Ciseaux(),$j1,$j2);
                $manche->ajoutCoup($coup);
		$f1 = $coup->getFigureJoueur1();
		$f2 = $coup->getFigureJoueur2();
		echo $j1->getPseudo().' a joué '.$f1->quiSuisJe().'<br/>';
		echo $j2->getPseudo().' a joué '.$f2->quiSuisJe().'<br/>';
                if(!$manche->verifFinManche()){
                    while(!$manche->verifFinManche()){
                        echo 'Le coup joué est un draw !<br/>';
                        $nbcoup++;
                        $coup=new Coup($nbcoup,new Lezard(), new Pierre(),$j1,$j2);
                        $manche->ajoutCoup($coup);
                        $f1 = $coup->getFigureJoueur1();
                        $f2 = $coup->getFigureJoueur2();
                        echo $j1->getPseudo().' a joué '.$f1->quiSuisJe().'<br/>';
                        echo $j2->getPseudo().' a joué '.$f2->quiSuisJe().'<br/>';
                    }
		}
                $coup->evaluer();
                echo 'Le coup joué est validé !<br/>';
                $gagnantCoup = $coup->getJoueurGagnantCoup();
                echo ''.$gagnantCoup->getPseudo().' a gagné la manche !<br/>';
                $manche->ajoutCoup($coup);
		$gagnantManche = $manche->getJoueurGagnantManche();				
		echo ''.$gagnantManche->getPseudo().' a gagné la manche !<br/>';
		$partie->ajoutManche($manche);
                $nbmanche++;
		echo 'Manche terminé<br/>';
            }
            echo 'Partie terminé<br/>';
            //----FIN de la partie
        ?>
    </body>
</html>
