<li <?php if (isset($vue)) if ($page=="joueur" && ($vue=="creation" || $vue=="created")) echo 'class="active"'; ?>><a href="joueur.php?action=inscription">S'inscrire</a>
<li <?php if (isset($vue)) if ($page=="joueur" && $vue=="connexion") echo 'class="active"'; ?>><a href="joueur.php?action=connexion">Se connecter</a></li>
