<?php

require_once MODEL_PATH."Joueur.php";

    if (empty($_GET)) {
      $vue="defaut";
      $pagetitle="Joueur : vos actions disponibles";
    }
    else if (isset($action)) {
        switch ($action) {

        /*
         * action=inscription
         * Permet d'accéder au formulaire d'inscription
         */
        case "inscription":
            if(!estConnecte()){
                $vue="creation";
                $pagetitle="Formulaire d'inscription";
                break;
            }
            else{
              header('Location: .');
            }
        break;
        /*
         * action=save
         * Insertion d'un joueur dans la BDD (après une inscription)
         */
        case "save":
            if(!estConnecte()){
              if (!(isset($_POST['pseudo']) && isset($_POST['sexe']) && isset($_POST['age']) && isset($_POST['pwd']) && isset($_POST['pwd2']) && isset($_POST['email']))) {
                  header('Location: joueur.php?action=inscription');
              }
              $data = array(
                "pseudo" => $_POST["pseudo"],
                "sexe" => $_POST["sexe"],
                "age" => $_POST["age"],
                "pwd" => $_POST["pwd"],
                "email" => $_POST["email"]
              );
			        if($_POST['pwd']==$_POST["pwd2"]){
                if(!(Joueur::checkAlreadyExist($data))) {
                    Joueur::inscription($data);
                  }
                  else {
                    $messageErreur="Ce pseudo ou cet email est déjà utilisé !";
                    break;
                  }
              }
              else {
                  $messageErreur="Vous avez saisi deux mots de passe différents !";
                  break;
              }
              $vue="created";
              $pagetitle="Inscription terminée !";
            }
            else{
              header('Location: .');
            }
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
              header('Location: .');
            }
        /*
         * action=connect
         * Verifie que les données saisies dans le formulaire sont bonnes et ouvre la session
         */
        case "connect":
            if(!estConnecte()){
              if (!(isset($_POST['pseudo']) || isset($_POST['pwd']))){
                  header('Location: joueur.php?action=connexion');
              }
                $data = array(
                "pseudo" => $_POST['pseudo'],
                "pwd" => $_POST["pwd"],
                );
                if((Joueur::checkExisteConnexion($data))) {
                    Joueur::connexion($data);
                    if(isset($_POST['redirurl'])) $url = $_POST['redirurl'];
                    else $url = ".";
                    header("Location:$url");
                }
                else{
                    $messageErreur="Pseudo ou mot de passe erroné !";
                }
            }
            else{
              header('Location: .');
            }
        break;

        case "deconnexion":
            if(estConnecte()){
                Joueur::deconnexion();
                header('Location: .');
            }
            else{
              header('Location: joueur.php?action=connexion');
            }
        break;

        case "delete":
            if(estConnecte()){
                $vue="delete";
                $pagetitle="Confirmation suppression de votre profil";
            }
            else{
              header('Location: joueur.php?action=connexion');
            }
        break;

        case "deleted":
            if(estConnecte()){
              Joueur::deleteProfil();
              Joueur::deconnexion();
              $vue="deleted";
              $pagetitle="Profil supprimé !";
              }
            else{
              header('Location: joueur.php?action=connexion');
            }
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
				        if($nbv==0 && $nbd!=0) $r = 0;
				        if($nbv!=0 && $nbd==0) {
					         $r = $nbv;
					         $r = substr($r, 0, 4);
                }
                if($nbv!=0 && $nbd!=0) {
					         $r = $nbv/$nbd;
					         $r = substr($r, 0, 4); // on coupe la chaine de caractère $r 2 chiffres après la virgule
				        }
                $vue="profil";
                $pagetitle="Votre profil";
            }
            else{
              header('Location: joueur.php?action=connexion');
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
              header('Location: joueur.php?action=connexion');
            }
        break;

        case "updated":
            if(estConnecte()){
            if (!(isset($_POST['pseudo']) && isset($_POST['age']) && isset($_POST['pwd']) && isset($_POST['pwd2']) && isset($_POST['email']))) {
                header('Location: joueur.php?action=update');
            }
            $data = array(
              "pseudo" => $_POST["pseudo"],
              "age" => $_POST["age"],
              "pwd" => $_POST["pwd"],
              "email" => $_POST["email"]
            );
			      if($_POST['pwd']==$_POST["pwd2"]){
              if(!(Joueur::checkAlreadyExist($data))) {
                Joueur::updateProfil($data);
              }
              else{
                $messageErreur="Ce pseudo ou cet email déjà utilisé !";
                break;
              }
            }
            else {
                $messageErreur="Vous avez saisi deux mots de passe différents !";
                break;
            }
            $_SESSION['pseudo'] = $_POST["pseudo"];
            $vue="updated";
            $pagetitle='Profil mis à jour !';
            }
            else{
              header('Location: joueur.php?action=connexion');
            }
        break;

    		case "search":
    		    if(estConnecte()){
        				$vue='find';
        				$pagetitle="Recherche d'un joueur";
            }
            else{
              header('Location: joueur.php?action=connexion');
            }
    				break;


        case "searched":
            if(estConnecte()){
              if (!isset($_POST['pseudo'])) {
                  header('Location: joueur.php?action=search');
              }
              $data = array("pseudo" => "%".$_POST['pseudo']."%");
              $joueur = Joueur::search($data);
              if (is_null($joueur)){
                  $vue="notFound";
                  $pagetitle="Aucun résultat";
                  break;
              }
              else{
                  $p = $joueur->pseudo;
                  $a = $joueur->age;
                  $s = $joueur->sexe;
                  $e = $joueur->email;
                  $nbv = $joueur->nbV;
                  $nbd = $joueur->nbD;
                  $r = 0;
                  if($nbd!=0) $r = $nbv/$nbd;
                  $vue="found";
                  $pagetitle="Résultat trouvé";
              }
            }
              else{
                header('Location: joueur.php?action=connexion');
              }
              break;

        default :
            $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";

        }
      }
      else {
        $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
      }
require VIEW_PATH."vue.php";
