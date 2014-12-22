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
              $dataCheck = array(
                "pseudo" => $_POST["pseudo"],
                "email" => $_POST["email"]
              );
              $existe = Joueur::selectWhereOr($dataCheck);
              if ($existe != null) {
                $messageErreur="Ce pseudo ou cet e-mail est déjà utilisé !";
                break;
              }
			        else if($_POST['pwd']==$_POST["pwd2"]){
                  $data['pwd'] = hash('sha256',$data['pwd'].Config::getSeed());
                  $idUser = Joueur::insertion($data);
                  $vue="created";
                  $pagetitle="Inscription terminée !";
              }
              else {
                $messageErreur="Vous avez saisi deux mots de passe différents !";
                break;
              }
            }
            else{
              header('Location: .');
            }
        break;

        /*
         * action=connect
         * Verifie que les données saisies dans le formulaire sont bonnes et ouvre la session
         */
        case "connect":
            if(!estConnecte()){
              if (!(isset($_POST['pseudo']) || isset($_POST['pwd']))){
                  header('Location: .');
              }
                $data = array(
                "pseudo" => $_POST['pseudo'],
                "pwd" => hash('sha256',$_POST['pwd'].Config::getSeed()),
                );
                $user = Joueur::selectWhere($data);
                if($user != null) {
                    $data2 = array(
                      "idJoueur" => $user[0]->idJoueur,
                      "pseudo" => $user[0]->pseudo
                    );
                    Joueur::connexion($data2);
                    if(isset($_POST['redirurl'])) $url = $_POST['redirurl'];
                    else $url = ".";
                    header("Location:$url");
                }
                else{
                    $messageErreur="Le pseudo ou le mot de passe est erroné !";
                }
            }
            else{
              header('Location: .');
            }
        break;

        case "deconnexion":
            if(estConnecte()){
              $dataWaiting = array(
                "idJoueur" => $_SESSION['idJoueur']
              );
              $attente = Jeu::selectWhere($dataWaiting);
              if($attente != null) { // on est en recherche d'un adversaire ?
                $dataDel = array(
                  "idJoueur" => $_SESSION['idJoueur']
                );
                Jeu::suppressionWhere($dataDel);
              }
                Joueur::deconnexion();
                header('Location: .');
            }
            else{
              header('Location: .');
            }
        break;

        case "delete":
            if(estConnecte()){
                $vue="delete";
                $pagetitle="Confirmation suppression de votre profil";
            }
            else{
              header('Location: .');
            }
        break;

        case "deleted":
            if(estConnecte()){
              $data = array(
                "idJoueur" => $_SESSION['idJoueur'],
              );
              Joueur::suppression($data);
              $dataWaiting = array(
                "idJoueur" => $_SESSION['idJoueur']
              );
              $attente = Jeu::selectWhere($dataWaiting);
              if($attente != null) { // on est en recherche d'un adversaire ?
                $dataDel = array(
                  "idJoueur" => $_SESSION['idJoueur']
                );
                Jeu::suppressionWhere($dataDel);
              }
              Joueur::deconnexion();
              $vue="deleted";
              $pagetitle="Profil supprimé !";
              }
            else{
              header('Location: .');
            }
        break;

        case "profil":
            if(estConnecte()){
                $data= array(
                  "idJoueur"=>$_SESSION['idJoueur']
                );
                $joueur = Joueur::select($data);
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
              header('Location: .');
            }
        break;

        case "update":
            if(estConnecte()){
                $data= array(
                  "idJoueur"=>$_SESSION['idJoueur']
                );
                $joueur = Joueur::select($data);
                $p = $joueur->pseudo;
                $a = $joueur->age;
                $s = $joueur->sexe;
                $e = $joueur->email;
                $vue="update";
                $pagetitle="Mise à jour de votre profil";
                break;
            }
            else{
              header('Location: .');
            }
        break;

        case "updated":
            if(estConnecte()){
              if (empty($_POST)) {
                  header('Location: joueur.php?action=update');
                  break;
              }
              else {
                $data = array(
                  "idJoueur" => $_SESSION["idJoueur"],
                  "pseudo" => $_POST["pseudo"],
                  "age" => $_POST["age"],
                  "email" => $_POST["email"]
                );
                if(!empty($_POST["pwd"])){
                  $data['pwd']=hash('sha256',$_POST["pwd"].Config::getSeed());
                }
                $dataCheck = array(
                  "pseudo" => $_POST["pseudo"],
                  "email" => $_POST["email"]
                );
                $existe = Joueur::selectWhereOr($dataCheck);
                if ($existe != null && $existe[0]->idJoueur!=$_SESSION['idJoueur']) {
                  $messageErreur="Ce pseudo ou cet e-mail est déjà utilisé !";
                  break;
                }
    			      else {
                    $r = Joueur::update($data);
                    $_SESSION['pseudo'] = $_POST["pseudo"];
                    $vue="updated";
                    $pagetitle='Profil mis à jour !';
                }
              }
            }
            else{
              header('Location: .');
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
