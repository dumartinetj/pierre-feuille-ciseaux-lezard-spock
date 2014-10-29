<?php

define('VIEW_PATH', ROOT.DS.'view'.DS);

// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH.'Joueur.php';

    switch ($action) {
    case "save":
        if (!(isset($_GET['idJoueur']) && isset($_GET['pseudo']) && isset($_GET['sexe']) && isset($_GET['age']) && isset($_GET['nbV']) && isset($_GET['nbD']) && isset($_GET['passw']) && isset($_GET['email']))) {
            $view='Error';
            $pagetitle='Erreur Utilisateur';
            break;
        }
        $data = array(
            "idJoueur" => $_GET["idJoueur"],
            "pseudo" => $_GET["pseudo"],
            "sexe" => $_GET["sexe"],
            "age" => $_GET["age"],
            "nbV" => $_GET["nbV"],
            "nbD" => $_GET["nbD"],
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
}
require VIEW_PATH.'view.php';