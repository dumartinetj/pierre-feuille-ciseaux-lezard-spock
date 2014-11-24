<h1 id="mainhead">Votre profil</h1>
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
<p> <a href="joueur.php?action=update" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-refresh"></span> Mettre à jour votre profil</a> </p>
<p> <a href="joueur.php?action=delete" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-trash"></span> Supprimer votre profil</a> </p>
