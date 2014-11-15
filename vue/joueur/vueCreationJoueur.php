<h1 id="mainhead">Inscription</h1>
<hr>
<form method="post" action="joueur.php?action=save">
    <fieldset>
            <input type="text" class="form-control" placeholder="Pseudo" name="pseudo" id="id_pseudo" required/><br/>
            <div>
              <input type="radio" name="sexe" id="id_sexe" value="H" required> ♂<br/>
              <input type="radio" name="sexe" id="id_sexe" value="F" required> ♀<br/>
            </div><br/>
            <input type="number" class="form-control" placeholder="Âge" name="age" id="id_age" min="1" max="130" required/><br/>
            <input type="password" class="form-control" name="pwd" placeholder="Mot de passe" id="id_pwd" required/><br/>
            <input type="password" class="form-control" name="pwd2" placeholder="Confirmer votre mot de passe" id="id_pwd2" required/><br/>
            <div class="input-group"><span class="input-group-addon">@</span><input type="email" class="form-control" placeholder="E-mail" name="email" id="id_email" required/></div><br/>
            <input type="submit" class="btn" value="Valider votre inscription" />
    </fieldset>
</form>
