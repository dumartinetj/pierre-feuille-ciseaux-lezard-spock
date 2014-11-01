<?php

require_once MODEL_PATH."Jeu.php";

    if (empty($_GET)) {
      if(estConnecte()){
        $vue="defaut";
        $pagetitle="Jouer !";

      }
      else {
          $messageErreur="Vous n'êtes pas connecté, vous ne pouvez pas jouer (pas encore) !";
      }

    }
    else if (isset($action)) {
        switch ($action) {
            
            case "rechercher":
                $search=Jeu::recherchePartie($_POST['nbManche']);
                $data = array(
                    "idJoueur" => $_SESSION['idJoueur'],
                    "nbManche" => $_POST['nbManche']
                );
                if($search==NULL){
                    //while($search==NULL) ??
                    Jeu::ajouterAttente($data);
                    $vue="attente";
                    $pagetitle="En attente d'un adversaire!";
                }
                else{
                    $idJoueurAdverse=$search;
                    Jeu::deleteAttente($_SESSION['idJoueur']);
                    Jeu::deleteAttente($idJoueurAdverse);
                    //TO DO: Créer la partie entre les deux hippies
                }
            break;
            
            case "annuler":
                if(estConnecte()){
                    if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){
                        Jeu::deleteAttente($_SESSION['idJoueur']);
                    }
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
