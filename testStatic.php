
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Test du static</title>
    </head>
    <body>
<?php

define('ROOT', dirname(__FILE__));
define('DS', dirname(DIRECTORY_SEPARATOR));
include_once('modele/Figure.php');
include_once('modele/Joueur.php');
include_once('modele/Partie.php');
include_once('modele/Manche.php');
include_once('modele/Coup.php');



/*$data = array(
            'pseudo' => "testinscription2",
            'sexe' => "M",
            'age' => 25,
            'nbV' => 0,
            'nbD' => 0,
            'pwd' => "123456789",
            'email' => "testinsc2@gmail.com"
);
$var = Joueur::inscription($data);
var_dump($var);

$data2 = array(
            'pseudo' => "testinscription2",
            'pwd' => "123456789"
);
Joueur::connexion($data2);
var_dump($_SESSION);
var_dump(Joueur::estConnecte());

$j1 = new Joueur(1, "Jean", "Homme", 25, "a@a.com", "1234567879");
$j2 = new Joueur(2, "Jeanne", "Femme", 22, "a@a.com", "1234567879");
$partie = new Partie(1, 5, $j1, $j2);
$nbmanche = 1;
$nbcoup=1;

echo '-- Début de la partie! --<br/>';

	        // nom: jeu
		// description: contient toutes les instructions pour jouer une partie
		// param: rien
		// retourne: retourne le gagnant de la partie

            while (!$partie->checkPartieFinie()) {
		echo '--- Début de la manche '.$nbmanche.'! ---<br/>';
                $manche = new Manche($nbmanche);
                $nbcoup=1;
                $coup = new Coup($nbcoup,new Figure(2),new Figure(2),$j1,$j2);
                $manche->ajoutCoup($coup);
		$f1 = $coup->getFigureJoueur1();
		$f2 = $coup->getFigureJoueur2();
		echo $j1->getPseudo().' a joué '.$f1->getNom().'<br/>';
		echo $j2->getPseudo().' a joué '.$f2->getNom().'<br/>';
                if($coup->estUnDraw()){
                    do {
			echo 'Le coup joué est un draw !<br/>';
			echo 'On rejout le coup !<br/>';
                        $nbcoup++;
                        $coup=new Coup($nbcoup,new Figure(1), new Figure(4),$j1,$j2);
                        $manche->ajoutCoup($coup);
                        $f1 = $coup->getFigureJoueur1();
                        $f2 = $coup->getFigureJoueur2();
                        echo $j1->getPseudo().' a joué '.$f1->getNom().'<br/>';
                        echo $j2->getPseudo().' a joué '.$f2->getNom().'<br/>';
                    } while($coup->estUnDraw());
		}
                $coup->evaluer();
                echo 'Le coup joué est validé !<br/>';

		$gagnantManche = $manche->getJoueurGagnantManche();
		$manche->ajoutStatsGlobales();
		echo ''.$gagnantManche->getPseudo().' a gagné la manche'.$nbmanche. '!<br/>';
		$partie->ajoutManche($manche);
		echo '--- Manche '.$nbmanche.' terminée! ---<br/><br/>';
                $nbmanche++;
            }
            $gagnantPartie = $partie->getJoueurGagnantPartie();
            echo ''.$gagnantPartie->getPseudo().' gagne la partie!<br/>';
            echo '-- Partie terminée! --<br/>';

$f1 = new Figure(1);
$f2 = new Figure(2);
$f3 = new Figure(3);
$f4 = new Figure(4);
$f5 = new Figure(5);


echo(Figure::getNom(1));
echo(Figure::getNom(5));
print_r (Figure::getForces(3));
print_r (Figure::getFaiblesses(2));
$res = Figure::estDansSesFaiblesses(1,2);
var_dump($res);
$res2 = Figure::estDansSesForces(1,2);
var_dump($res2); */

$data = array(
            'idJoueur1' => 7,
            'idJoueur2' => 8,
);
//$id = Coup::ajoutCoup($data);
var_dump(Coup::getIDFigureJoueur1(5));
var_dump(Coup::getIDFigureJoueur2(5));
var_dump(Coup::getIDJoueur1(5));
var_dump(Coup::getIDJoueur2(5));
var_dump(Coup::estUnDraw(5));
var_dump(Coup::retourneIDs(5));
Coup::evaluer(5);
var_dump(Coup::getIDJoueurGagnantCoup(5));

?>

    </body>
</html>
