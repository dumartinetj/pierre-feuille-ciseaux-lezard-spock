<?php

// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH.'Joueur.php';

    switch ($action) {
    case "inscription":
        if(!estConnecte()){
            $vue="Creation";
            $pagetitle="Formulaire d'inscription.";
            break;
        }
        else{
          die('Vous êtes déjà connecté.');
        }
    
    case "connexion":
        if(!estConnecte()){
            $vue="connexion";
            $pagetitle="connexion";
            break;
        }
        else{
          die('Vous êtes déjà connecté.');
        }
    
    case "save":
        if (!(isset($_POST['pseudo']) && isset($_POST['sexe']) && isset($_POST['age']) && isset($_POST['pwd']) && isset($_POST['pwd2']) && isset($_POST['email']))) {
            die("Veuillez remplir tous les champs du formulaire.");
            break;
        }
        $data = array(
            "pseudo" => $_POST["pseudo"],
            "sexe" => $_POST["sexe"],
            "age" => $_POST["age"],
            "pwd" => $_POST["pwd"],
            "email" => $_POST["email"]
        );
        if($data['pwd']==$_POST["pwd2"]){
            Joueur::inscription($data);
        }
        else {
            die("Veuillez re-confirmer votre mot de passe.");
        }
        //$login = $_POST['login'];
        //$tab_util = ModelUtilisateur::selectAll();
        $vue='created';
        $pagetitle='Utilisateur Créé';
    break;
    
    case "delete":
        if (!isset($_POST['pseudo'])) {
            $vue="error";
            $pagetitle="ERREUR!";
        }
        $data = array("pseudo" => $_POST['pseudo']);
        $u = Joueur::delete($data);
        // Initialisation des variables pour la vue
        $pseudo = $_POST['pseudo'];
        $tab_util = Joueur::select();
        // Chargement de la vue
        $vue="deleted";
        $pagetitle="Utilisateur supprimé";
    break;

    case "read":
        if (!isset($_POST['pseudo'])) {
            $vue= "error";
            $pagetitle="ERREUR!";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("pseudo" => $_POST['pseudo']);
        $u = Joueur::select($data);
        // Chargement de la vue
        if (is_null($u)){
            $vue= "error";
            $pagetitle="ERREUR!";
            break;
                    
        } //redirige vers une vue d'erreur
        else{
            // Initialisation des variables pour la vue
            $vue="find";
            $pagetitle="Détails d'un joueur";
        }
    break;
    
    default :
        $vue='default';
        $pagetitle='Page Joueur!';
        
}
require VIEW_PATH.'vue.php';