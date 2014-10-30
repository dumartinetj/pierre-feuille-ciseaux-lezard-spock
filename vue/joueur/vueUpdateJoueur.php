echo <<< EOT
<form method="post" action="joueur.php?action=updated">
    <fieldset>
        <legend>Mettre à jour votre profil</legend>
        <p>
            <label for="pseudo">Pseudo</label> :
            <input type="text" value="$p" name="pseudo" id="id_pseudo" required/>
        </p>
        <p>
            <label for="id_age">Age</label> :
            <input type="number" value="$a" name="age" id="id_age" min="1" max="130" required/>
        </p>
        <p>Sexe : $s</p>
        <p>
            <label for="id_pwd">Nouveau mot de passe</label> :
            <input type="password" name="pwd" id="id_pwd" required/>
        </p>
        <p>
            <label for="id_pwd2">Confirmer Mot de passe</label> :
            <input type="password" name="pwd2" id="id_pwd2" required/>
        </p>
        <p>
            <label for="id_email">Email</label> :
            <input type="email" value="$e" name="email" id="id_email" required/>
        </p>
        <p>
            <input type="submit" value="MAJ profil !" />
        </p>
    </fieldset>
</form>
EOT
