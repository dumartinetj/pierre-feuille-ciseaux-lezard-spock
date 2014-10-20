
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Test du static</title>
    </head>
    <body>
<?php

include ('modele/Figure.php');
include('modele/Ciseaux.php');
include('modele/Lezard.php');
include('modele/Spock.php');
include('modele/Feuille.php');
include('modele/Pierre.php');

$f1 = new Lezard();
$f2 = new Ciseaux();
$f3 = new Spock();
$f4 = new Pierre();

echo($f1.quiSuisJe());
echo($f2.quiSuisJe());
echo($f3.quiSuisJe());
echo($f4.quiSuisJe());



?>

    </body>
</html>
