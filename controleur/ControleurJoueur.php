<?php

define('VIEW_PATH', ROOT.DS.'vue'.DS);

// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH.'Joueur.php';

    switch ($action) {
    case "inscription":
        $vue="Creation";
        $pagetitle="Creation d'un utilisateur.";
        break;
    
    case "save":
        if (!(isset($_GET['pseudo']) && isset($_GET['sexe']) && isset($_GET['age']) && isset($_GET['pwd']) && isset($_GET['pwd2']) && isset($_GET['email']))) {
            die("Veuillez remplir tous les champs du formulaire.");
            break;
        }
        $data = array(
            "pseudo" => $_GET["pseudo"],
            "sexe" => $_GET["sexe"],
            "age" => $_GET["age"],
            "pwd" => $_GET["pwd"],
            "email" => $_GET["email"]
        );
        if($data['pwd']==$_GET["pwd2"]){
            Joueur::inscription($data);
        }
        else {
            die("Veuillez re-confirmer votre mot de passe.");
        }
        //$login = $_GET['login'];
        //$tab_util = ModelUtilisateur::selectAll();
        $vue='created';
        $pagetitle='Utilisateur Créé';
    break;
    default:
	
	case "delete":
        if (!isset($_GET['pseudo'])) {
            $vue="error";
            $pagetitle="ERREUR!";
        }
        $data = array("pseudo" => $_GET['pseudo']);
        $u = Joueur::delete($data);
        // Initialisation des variables pour la vue
        $pseudo = $_GET['pseudo'];
        $tab_util = Joueur::select();
        // Chargement de la vue
        $vue="deleted";
        $pagetitle="Utilisateur supprimé";
    default:
    // Si l'action est inconnue, nous effectuerons 'read'
	
	case "read":
        if (!isset($_GET['pseudo'])) {
            $vue= "error";
            $pagetitle="ERREUR!";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("pseudo" => $_GET['pseudo']);
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
  
        
}
require VIEW_PATH.'vue.php';