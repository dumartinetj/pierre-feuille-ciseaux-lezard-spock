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
			include('modele/ModeleCoup.php');
			include('modele/ModeleFigure.php');
			include('modele/ModeleCiseaux.php');
			include('modele/ModeleLezard.php');
			include('modele/ModeleSpock.php');
			include('modele/ModeleFeuille.php');
			include('modele/ModelePierre.php');
			
		
            //define('ROOT', dirname(__FILE__));
            //define('DS', dirname(DIRECTORY_SEPARATOR));
            //include ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            //AFTER CHRONO
            //require_once ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
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
