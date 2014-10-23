
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

echo($f3->getIdentifiant());
echo($f3->quiSuisJe());
print_r ($f3->getForces());
print_r ($f3->getFaiblesses());
$id2 = $f2->getIdentifiant();
$res = $f3->estDansSesForces($id2);
var_dump($res); 
/*$res = $f3->estDansSesFaiblesses($id2);
var_dump($res);*/
if ($res)
  {
  echo "Dans ses forces";
  }
else
  {
  echo "Dans ses faiblesses";
  } 


?>

    </body>
</html>
