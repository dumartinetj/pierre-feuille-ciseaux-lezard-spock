<h3>Votre profil</h3>

<p>
<?php
if($joueur->nbD!=0){
$r = $joueur->nbV/$joueur->nbD;
}
else{ $r=$joueur->nbV; }
echo <<< EOT
Pseudo : $joueur->pseudo <br/>
Age : $joueur->age <br/>
Sexe : $joueur->sexe <br/>
E-mail : $joueur->email <br/>
Nombre de victoire : $joueur->nbV <br/>
Nombre de défaite : $joueur->nbD <br/>
Ratio : $r <br/>
EOT;
?>
</p>
