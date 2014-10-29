        <p>
			<?php
			if($u->nbD!=0){
				$r = $u->nbV/$u->nbD;
			}
			else{ $r=$u->nbV; }
			echo <<< EOT
			Pseudo : $u->pseudo <br/>
			Age : $u->age <br/>
			Sexe : $u->sexe <br/>
			E-mail : $u->email <br/>
			Nombre de victoire : $u->nbV <br/>
			Nombre de défaite : $u->nbD <br/>
			Ratio : $r <br/>
EOT;
			?>
			<a href='?action=update&controleur=Joueur&pseudo=$p'>Mettre à jour</a><br/>
			<a href='?action=delete&controleur=Joueur&pseudo=$p'>Supprimer</a><br/>
            Retour à la <a href="?">page principale</a>
        </p>