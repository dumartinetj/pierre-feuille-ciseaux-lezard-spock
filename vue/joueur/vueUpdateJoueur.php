<?php
echo <<< EOT
<h1 id="mainhead">Mettre à jour votre profil</h1>
<hr>
<form method="post" action="joueur.php?action=updated">
    <fieldset>
        <p>
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" value="$p" name="pseudo" id="id_pseudo" required/>
        </p>
        <p>
            <label for="id_age">Âge</label>
            <input type="number" class="form-control" value="$a" name="age" id="id_age" min="1" max="130" required/>
        </p>
        <p><label for="id_pwd">Sexe :</label> $s</p>
        <p>
            <label for="id_pwd">Nouveau mot de passe</label>
            <input type="password" class="form-control" name="pwd" id="id_pwd" required/>
        </p>
        <p>
            <label for="id_pwd2">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control" name="pwd2" id="id_pwd2" required/>
        </p>
        <p>
            <label for="id_email">Email</label>
            <input type="email" class="form-control" value="$e" name="email" id="id_email" required/>
        </p>
        <p>
            <input type="submit" class="btn" value="MAJ profil !" />
        </p>
    </fieldset>
</form>
EOT;
