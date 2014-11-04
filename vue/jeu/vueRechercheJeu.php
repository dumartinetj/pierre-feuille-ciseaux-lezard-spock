<h3>Recherche d'un adversaire</h3>
<hr>
<p>Veuillez saisir le nombre de manches que vous voulez jouer au maximum<br/>
Pour connaître les règles du jeu et le déroulemen d'une partie, rendez-vous sur la <a href="index.php?action=regles">pages des règles du jeu</a></p>
<div class="col-md-3"></div>
<div class="col-md-6">
<form method="post" action="jouer.php?action=rechercher">
    <fieldset>
            <input type="number" class="form-control" placeholder="Nombre de manches" name="nbManche" id="id_nbManche" min="1" max="9" step="2" required/><br/>
            <input type="submit" class="btn" value="Rechercher votre partie !" />
    </fieldset>
</form>
</div>
