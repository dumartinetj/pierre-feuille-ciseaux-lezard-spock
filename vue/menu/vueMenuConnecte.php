<li <?php if (isset($vue)) if (($page=="index" && $vue=="choixMode") || $page=="jeu" || $page=="jeuIA") echo 'class="active"'; ?>><a href="index.php?action=choixmode"><span class="fa fa-gamepad"></span> Jouer</a></li>
<li <?php if (isset($vue)) if ($page=="index" && $vue=="classement") echo 'class="active"'; ?>><a href="index.php?action=classement"><span class="fa fa-sort-amount-asc"></span> Classement</a></li>
<li <?php if (isset($vue)) if ($page=="index" && $vue=="statistiques") echo 'class="active"'; ?>><a href="index.php?action=statistiques"><span class="fa fa-pie-chart"></span> Statistiques</a></li>
<li <?php if (isset($vue)) if ($page=="index" && $vue=="regles") echo 'class="active"'; ?>><a href="index.php?action=regles"><span class="fa fa-file-text"></span> Règles du jeu</a></li>
<li <?php if (isset($vue)) if ($page=='joueur' && ($vue=="defaut" || $vue=="profil" || $vue=='update' || $vue=='updated'|| $vue=='delete')) echo 'class="active"'; ?>><a href="joueur.php?action=profil"><span class="fa fa-user"></span> Profil</a></li>
<li><a href="joueur.php?action=deconnexion"><span class="fa fa-toggle-off"></span> Se déconnecter (<?php echo $_SESSION['pseudo']; ?>)</a></li>
