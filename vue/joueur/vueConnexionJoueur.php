<form method="post" action="joueur.php?action=connect">
    <fieldset>
        <legend>Connexion</legend>
        <p>
            <label for="pseudo">Pseudo</label> :
            <input type="text" name="pseudo" id="id_pseudo" required/>
            <label for="id_pwd">Mot de passe</label> :
            <input type="password" name="pwd" id="id_pwd" required/>
            <input type="submit" value="Se connecter" />
        </p>
    </fieldset>
</form>