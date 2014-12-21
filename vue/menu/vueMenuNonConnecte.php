<li <?php if (isset($vue)) if ($page=="joueur" && ($vue=="creation" || $vue=="created")) echo 'class="active"'; ?>><a href="joueur.php?action=inscription"><span class="fa fa-coffee"></span> S'inscrire</a>
<li <?php if (isset($vue)) if ($page=="joueur" && $vue=="connexion") echo 'class="active"'; ?>><a href="joueur.php?action=connexion"><span class="fa fa-toggle-on"></span> Se connecter</a></li>
