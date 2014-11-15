<li <?php if (isset($vue)) if ($page=='joueur' && ($vue=="find" || $vue=="found" || $vue=="notFound")) echo 'class="active"'; ?>><a href="joueur.php?action=search">Rechercher un joueur</a></li>
<li <?php if (isset($vue)) if ($page=='joueur' && ($vue=="defaut" || $vue=="profil" || $vue=='update' || $vue=='updated'|| $vue=='delete')) echo 'class="active"'; ?>><a href="joueur.php?action=profil">Votre profil</a></li>
<li><a href="joueur.php?action=deconnexion">Se déconnecter (<?php echo $_SESSION['pseudo']; ?>)</a></li>
