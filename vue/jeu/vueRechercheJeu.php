<h1 id="mainhead">Recherche d'un adversaire</h1>
<hr>
<p>Veuillez saisir le nombre de manches que vous voulez jouer au maximum<br/>
Pour connaître les règles du jeu et le déroulement d'une partie, rendez-vous sur la <a href="index.php?action=regles">page des règles du jeu</a></p>
<form method="post" action="jouer.php?action=rechercher">
    <fieldset>
            <input type="number" class="form-control" placeholder="Nombre de manches" name="nbManche" id="id_nbManche" min="1" max="9" step="2" required/><br/>
            <input type="submit" class="btn" value="Rechercher votre partie !" />
    </fieldset>
</form>
