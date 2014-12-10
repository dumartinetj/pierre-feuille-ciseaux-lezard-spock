<h1 id="mainhead">Connexion</h1>
<hr>
<form method="post" action="joueur.php?action=connect">
    <fieldset>
        <p>
            <input type="text" id="id_pseudo" class="form-control" name="pseudo" placeholder="Pseudo" required/><br/>
            <input type="password" id="id_pwd" class="form-control" name="pwd" placeholder="Mot de passe" required/><br/>
            <input type="hidden" name="redirurl" value="<?php if(isset($_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER']; ?>" />
            <input type="submit" class="btn btn-default btn-lg" name="submit" value="Se connecter !"/>
        </p>
    </fieldset>
</form>
