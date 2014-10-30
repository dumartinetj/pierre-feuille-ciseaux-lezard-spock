        <form method="get" action="">
            <fieldset>
                <legend>Créer un utilisateur</legend>
                <p>
                    <label for="pseudo">Pseudo</label> :
                    <input type="text" placeholder="Jack235334" name="pseudo" id="id_pseudo" required/>
                </p>
                <p>
                    <label for="id_sexe">Sexe</label> :<br>
                    <input type="radio" name="sexe" id="id_sexe" value="H" required/>Homme<br>
                    <input type="radio" name="sexe" id="id_sexe" value="F">Femme
                </p>
                <p>
                    <label for="id_age">Age</label> :
                    <input type="number" placeholder="22" name="age" id="id_age" min="1" max="130" required/>
                </p>
                <p>
                    <label for="id_pwd">Mot de passe</label> :
                    <input type="password" name="pwd" id="id_pwd" required/>
                </p>
                <p>
                    <label for="id_pwd2">Confirmer Mot de passe</label> :
                    <input type="password" name="pwd2" id="id_pwd2" required/>
                </p>
                <p>
                    <label for="id_email">Email</label> :
                    <input type="email" placeholder="test@email.com" name="email" id="id_email" required/>
                </p>
                <input type="hidden" name="action" value="save" />
                <input type="hidden" name="page" value="joueur" />                
                <p>
                    <input type="submit" value="Créer l'utilisateur" />
                </p>
            </fieldset>
        </form>

