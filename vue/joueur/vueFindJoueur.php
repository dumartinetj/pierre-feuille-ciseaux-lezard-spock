<?php

function view1($u) {
    $p = $u->pseudo;
    $a = $u->age;
    $s = $u->sexe;
    $e = $u->email;
	$v = $u->nbV;
	$d = $u->nbD;
	if($d!=0){
		$r = $v/$d;
	}
	else{ $r=$v; }

    // La syntaxe suivante permet de cr�er facilement des cha�nes de caract�res multi-lignes
    echo <<< EOT
    $p
	Age : $a
	Sexe : $s
	E-mail : $e
	Nombre de victoire : $v
	Nombre de d�faite : $d
	Ratio : $r
	
    <a href='?action=update&controleur=Joueur&pseudo=$p'>Mettre � jour</a>, 
    <a href='?action=delete&controleur=Joueur&pseudo=$p'>Supprimer</a>
EOT;
}
?>
<!DOCTYPE html>

        <?php view1($u); ?>
        <p>
            Retour � la <a href="?">page principale</a>.
        </p>