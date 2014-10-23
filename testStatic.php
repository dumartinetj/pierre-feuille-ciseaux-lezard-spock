
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Test du static</title>
    </head>
    <body>
<?php

include('modele/Figure.php');
include('modele/Ciseaux.php');
include('modele/Lezard.php');
include('modele/Spock.php');
include('modele/Feuille.php');
include('modele/Pierre.php');

$f1 = new Pierre();
$f2 = new Feuille();
$f3 = new Ciseaux();
$f4 = new Lezard();
$f5 = new Spock();

echo($f1->quiSuisJe());
echo($f2->quiSuisJe());
echo($f3->quiSuisJe());
echo($f4->quiSuisJe());
echo($f5->quiSuisJe());
echo($f1->getIdentifiant());
echo($f2->getIdentifiant());
echo($f3->getIdentifiant());
echo($f4->getIdentifiant());
echo($f5->getIdentifiant());
echo(implode($f2->getForces())); //Equivalent toString arrayList Forces



?>

    </body>
</html>
