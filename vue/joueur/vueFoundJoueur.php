<?php
function view1($u) {
	
    $a = $u->age;
    $s = $u->sexe;
    $e = $u->email;
	$nbv = $u->nbV;
    $nbd = $u->nbD;
    $r = 0;
    if($nbd!=0) $r = $nbv/$nbd;
echo <<< EOT

Age : $a <br/>
Sexe : $s <br/>
E-mail : $e <br/>
Nombre de victoire : $nbv <br/>
Nombre de défaite : $nbd <br/>
Ratio : $r <br/>
EOT;
}
?>
<div class="col-md-3"></div>
<div class="col-md-6">
<h3>Profil de <?php echo($u->pseudo) ?></h3>
<hr>
<p>
<?php view1($u); ?>
</p>
<hr>

</div>
