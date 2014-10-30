<h3>Bienvenue sur la page Joueur!</h3>
<p><a href="joueur.php?action=inscription"> Cliquez ici pour vous inscrire!</a></p>
<p><a href="joueur.php?action=connexion"> Cliquez ici pour vous connecter!</a></p>
<p><a href="joueur.php?action=deconnexion"> Cliquez ici pour vous déconnecter!</a></p>
<p> Connecté? : <?php if(Joueur::estConnecte()==1){echo 'Oui';} else{echo 'Non';} ?> </p> 
<p> IDJoueur: <?php echo $_SESSION['idJoueur'];?> </p>