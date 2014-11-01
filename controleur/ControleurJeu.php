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
                if(estConnecte()){
                    $search=Jeu::recherchePartie($_POST['nbManche']);
                    $data = array(
                        "idJoueur" => $_SESSION['idJoueur'],
                        "nbManche" => $_POST['nbManche']
                    );
                    if($search==NULL){
                        Jeu::ajouterAttente($data);
                        $vue="attente";
                        $pagetitle="En attente d'un adversaire !";
                    }
                    else{
                        $idJoueurAdverse=$search;
                        $data2 = array(
                            "idJoueur" => $_SESSION['idJoueur'],
                            "idJoueur2" => $idJoueurAdverse,
                            "nbManche" => $_POST['nbManche']
                        );
                        Jeu::deleteAttente($_SESSION['idJoueur']);
                        Jeu::deleteAttente($idJoueurAdverse);
                        Partie::ajouterPartie($data2);
                        //TO DO: Créer la partie entre les deux hippies
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté!";
                }
            break;

            case "annuler":
                if(estConnecte()){
                    if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){
                        Jeu::deleteAttente($_SESSION['idJoueur']);
                        $vue="deleted";
                        $pagetitle="Annulation de la recherche d'une partie!";
                    }
                    else{
                        $messageErreur="Vous n'êtes pas dans la liste d'attente!";
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté!";
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
