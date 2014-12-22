<h1 id="mainhead">Mettre à jour votre profil</h1>
<hr>
<form method="post" action="joueur.php?action=updated">
    <fieldset>
        <p>
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" value="<?php echo $p ?>" name="pseudo" id="id_pseudo" required/>
        </p>
        <p>
            <label for="id_age">Âge</label>
            <input type="number" class="form-control" value="<?php echo $a ?>" name="age" id="id_age" min="1" max="130" required/>
        </p>
        <p><label for="id_pwd">Sexe :</label> <?php echo $s ?></p>
        <p>
            <label for="id_pwd">Nouveau mot de passe</label>
            <input type="password" class="form-control" name="pwd" id="id_pwd" autocomplete="off" />
        </p>
        <p>
            <label for="id_email">Email</label>
            <input type="email" class="form-control" value="<?php echo $e ?>" name="email" id="id_email" required/>
        </p>
        <p>
            <input type="submit" class="btn btn-default btn-lg" value="MAJ profil !" />
        </p>
    </fieldset>
</form>
