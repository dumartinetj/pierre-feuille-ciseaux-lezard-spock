<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Jeu</title>
    </head>
    <body>
        <?php
<<<<<<< HEAD
		
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
=======
           
>>>>>>> 0984ac332d3ea45819d991059892f842792c4b89
			
		
            //define('ROOT', dirname(__FILE__));
            //define('DS', dirname(DIRECTORY_SEPARATOR));
            //include ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            //AFTER CHRONO
            //require_once ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
<<<<<<< HEAD
			$j1 = new Joueur(1, "Jean", "Homme", 25);
			$j2 = new Joueur(2, "Jeanne", "Femme", 22);
			$p1 = new Partie(1, $j1, $j2);
			$nbmanche = 1;
			while ($nbmanche != 3) {
				echo 'Début de la manche '.$nbmanche.'<br/>';
                $m = new Manche($nbmanche);
                $nbcoup=1;
                $coup = new Coup($nbcoup,new Ciseaux(),new Ciseaux());
				echo 'Joueur 1 a joué '.($coup.getFigureJoueur1()).afficher().'<br/>';
				echo 'Joueur 2 a joué '.($coup.getFigureJoueur2()).afficher().'<br/>';
                if($coup.estUnDraw){
					while($coup.estUnDraw()){
						echo 'Le coup joué est un draw !<br/>';
						$m.ajoutCoup($coup);
						$nbcoup++;
						$coup=new Coup($nbcoup,new Lezard(), new Pierre());
						echo 'Joueur 1 a joué '.($coup.getFigureJoueur1()).afficher().'<br/>';
						echo 'Joueur 1 a joué '.($coup.getFigureJoueur2()).afficher().'<br/>';
					}   
				}
=======
            $j1 = new ModeleJoueur(1, "Jean", "Homme", 25);
            $j2 = new ModeleJoueur(2, "Jeanne", "Femme", 22);
            $p1 = new ModelePartie(1, $j1, $j2);
            $nbmanche = 1;
            while ($nbmanche != 3) {
		echo 'Début de la manche '.$nbmanche.'<br/>';
                $m = new ModeleManche($nbmanche);
                $nbcoup=1;
                $coup = new ModeleCoup($nbcoup,new ModeleCiseaux(),new ModeleCiseaux());
		echo 'Joueur 1 a joué '.($coup.getFigureJoueur1()).afficher().'<br/>';
		echo 'Joueur 2 a joué '.($coup.getFigureJoueur2()).afficher().'<br/>';
                if($coup.estUnDraw){
                    while($coup.estUnDraw()){
			echo 'Le coup joué est un draw !<br/>';
			$m.ajoutCoup($coup);
			$nbcoup++;
			$coup=new ModeleCoup($nbcoup,new ModeleLezard(), new ModelePierre());
			echo 'Joueur 1 a joué '.($coup.getFigureJoueur1()).afficher().'<br/>';
			echo 'Joueur 1 a joué '.($coup.getFigureJoueur2()).afficher().'<br/>';
                    }   
		}
>>>>>>> 0984ac332d3ea45819d991059892f842792c4b89
                else{
                    $coup.evaluer();
                    echo 'Le coup joué est validé !';
                    $m.ajoutCoup($coup);
                }
                $p1.ajoutManche($m);
                $nbmanche++;  
		echo 'Manche terminé';
            }
            echo 'Partie terminé';
        ?>
    </body>
</html>
