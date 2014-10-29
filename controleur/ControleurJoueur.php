<?php

define('VIEW_PATH', ROOT.DS.'view'.DS);

// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH.'Joueur.php';

    switch ($action) {
    case "save":
        if (!(isset($_GET['pseudo']) && isset($_GET['sexe']) && isset($_GET['age']) && isset($_GET['passw']) && isset($_GET['email']))) {
            die("Veuillez remplir tous les champs du formulaire.");
            break;
        }
        $data = array(
            "pseudo" => $_GET["pseudo"],
            "sexe" => $_GET["sexe"],
            "age" => $_GET["age"],
            "passw" => $_GET["passw"],
            "email" => $_GET["email"]
        );
        Joueur::insert($data);
        //$login = $_GET['login'];
        //$tab_util = ModelUtilisateur::selectAll();
        $view='Created';
        $pagetitle='Utilisateur Créé';
    break;
    default:
	
	case "delete":
        if (!isset($_GET['pseudo'])) {
            $view="error";
            $pagetitle="ERREUR!";
        }
        $data = array("pseudo" => $_GET['pseudo']);
        $u = Joueur::delete($data);
        // Initialisation des variables pour la vue
        $pseudo = $_GET['pseudo'];
        $tab_util = Joueur::select();
        // Chargement de la vue
        $view="deleted";
        $pagetitle="Utilisateur supprimé";
    default:
    // Si l'action est inconnue, nous effectuerons 'read'
	
	case "read":
        if (!isset($_GET['pseudo'])) {
            $view= "error";
            $pagetitle="ERREUR!";
            break;
        }
        // Initialisation des variables pour la vue        
        $data = array("pseudo" => $_GET['pseudo']);
        $u = Joueur::select($data);
        // Chargement de la vue
        if (is_null($u)){
            $view= "error";
            $pagetitle="ERREUR!";
            break;
                    
        } //redirige vers une vue d'erreur
        else{
            // Initialisation des variables pour la vue
            $view="find";
			$nom="joueur";
            $pagetitle="Détails d'un joueur";
        }
        break;
  
        
}
require VIEW_PATH.'vue.php';