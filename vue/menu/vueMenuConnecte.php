<li <?php if (isset($vue)) if ($page=='joueur' && ($vue=="defaut" || $vue=="profil" || $vue=='update' || $vue=='updated'|| $vue=='delete')) echo 'class="active"'; ?>><a href="joueur.php?action=profil"><span class="fa fa-user"></span> Profil</a></li>
<li><a href="joueur.php?action=deconnexion"><span class="fa fa-toggle-off"></span> Se déconnecter (<?php echo $_SESSION['pseudo']; ?>)</a></li>
