<?php

// On va chercher le modele dans "./model/ModelUtilisateur.php"
require_once MODEL_PATH.'Joueur.php';

    switch ($action) {

    /*
     * action=inscription
     * Permet d'accéder au formulaire d'inscription
     */
    case "inscription":
        if(!estConnecte()){
            $vue="Creation";
            $pagetitle="Formulaire d'inscription.";
            break;
        }
        else{
            $vue='Erreur';
            $contenuErreur="Vous êtes déjà connecté.";
        }
    break;
    /*
     * action=save
     * Insertion d'un joueur dans la BDD (après une inscription)
     */
    case "save":
        if (!(isset($_POST['pseudo']) && isset($_POST['sexe']) && isset($_POST['age']) && isset($_POST['pwd']) && isset($_POST['pwd2']) && isset($_POST['email']))) {
            $vue='Erreur';
            $contenuErreur="Veuillez remplir tous les champs du formulaire.";
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
            $vue='Erreur';
            $contenuErreur="Veuillez re-confirmer votre mot de passe.";
        }
        $vue='created';
        $pagetitle='Utilisateur Créé';
    break;

    /*
     * action=connexion
     * Permet d'accéder au formulaire de connexion
     */
    case "connexion":
        if(!estConnecte()){
            $vue="connexion";
            $pagetitle="Connexion";
            break;
        }
        else{
          $vue='Erreur';
          $contenuErreur="Vous êtes déjà connecté.";
        }
    /*
     * action=connect
     * Verifie que les données saisies dans le formulaire sont bonnes et ouvre la session
     */
    case "connect":
        if (!(isset($_POST['pseudo']) && isset($_POST['pwd']))){
            $vue='Erreur';
            $contenuErreur="Veuillez saisir les informations de connexion.";
        }
        $data = array(
            "pseudo" => $_POST['pseudo'],
            "pwd" => $_POST['pwd']
        );
        if((Joueur::checkExisteConnexion($data))) {
            Joueur::connexion($data);
            $vue="connecte";
            $pagetitle="Connexion réussie!";
        }
        else{
            $vue='Erreur';
            $contenuErreur="Pseudo ou mot de passe erroné!";
        }
    break;

    case "deconnexion":
        if(estConnecte()){
            Joueur::deconnexion();
            $vue="deconnexion";
            $pagetitle="Deconnexion Réussie!";
        }
        else{
            $vue='Erreur';
            $contenuErreur="Vous n'êtes pas connecté.";
        }
    break;

    case "delete":
        if (!isset($_POST['pseudo'])) {
            $vue='Erreur';
            $contenuErreur="Veuillez saisir le pseudo du joueur à supprimer.";
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

    case "profil":
        if(estConnecte()){
            $joueur = Joueur::getProfil();
            $p = $joueur->pseudo;
            $a = $joueur->age;
            $s = $joueur->sexe;
            $e = $joueur->email;
            $nbv = $joueur->nbV;
            $nbd = $joueur->nbD;
            $r = 0;
            if($nbd!=0) $r = $nbv/$nbd;
            $vue="profil";
            $pagetitle="Votre profil";
        }
        else{
            $vue='Erreur';
            $contenuErreur="Vous n'êtes pas connecté.";
        }
    break;

    case "update":
        if(estConnecte()){
            $joueur = Joueur::getProfil();
            $p = $joueur->pseudo;
            $a = $joueur->age;
            $s = $joueur->sexe;
            $e = $joueur->email;
            $vue="update";
            $pagetitle="Mise à jour de votre profil";
            break;
        }
        else{
            $vue='Erreur';
            $contenuErreur="Vous n'êtes pas connecté.";
        }
    break;

    case "updated":
        if(estConnecte()){
        if (!(isset($_POST['pseudo']) && isset($_POST['age']) && isset($_POST['pwd']) && isset($_POST['pwd2']) && isset($_POST['email']))) {
            $vue='Erreur';
            $contenuErreur="Veuillez remplir tous les champs du formulaire.";
        }
        $data = array(
            "pseudo" => $_POST["pseudo"],
            "age" => $_POST["age"],
            "pwd" => $_POST["pwd"],
            "email" => $_POST["email"]
        );
        if($data['pwd']==$_POST["pwd2"]){
            Joueur::updateProfil($data);
        }
        else {
            $vue='Erreur';
            $contenuErreur="Veuillez re-confirmer votre mot de passe.";
        }
        $vue='updated';
        $pagetitle='Profil mis à jour !';
        }
        else{
            $vue='Erreur';
            $contenuErreur="Vous n'êtes pas connecté!";
        }
    break;

    case "read":
        if (!isset($_POST['pseudo'])) {
            $vue='Erreur';
            $contenuErreur="Veuillez saisir un pseudo.";
            break;
        }
        // Initialisation des variables pour la vue
        $data = array("pseudo" => $_POST['pseudo']);
        $u = Joueur::select($data);
        // Chargement de la vue
        if (is_null($u)){
            $vue='Erreur';
            $contenuErreur="Utilisateur invalide.";
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
