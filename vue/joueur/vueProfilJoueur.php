<div class="col-md-3"></div>
<div class="col-md-6">
<h3>Votre profil</h3>
<hr>
<p>
<?php
echo <<< EOT
Pseudo : $p <br/>
Age : $a <br/>
Sexe : $s <br/>
E-mail : $e <br/>
Nombre de victoire : $nbv <br/>
Nombre de défaite : $nbd <br/>
Ratio : $r <br/>
EOT;
?>
</p>
<hr>
<a href='joueur.php?action=update'>Mettre à jour votre profil</a><br/>
<a href='joueur.php?action=delete'>Supprimer votre profil de la matrice !</a><br/>
</div>
