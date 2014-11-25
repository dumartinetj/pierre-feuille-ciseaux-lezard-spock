<?php
    require_once MODEL_PATH."Jeu.php";
    if (empty($_GET)) {
      $vue="default";
      $pagetitle='Le jeu';
    }
    else if (isset($action)) {
      switch ($action) {

        case "regles":
                $vue="regles";
                $pagetitle="Règles du jeu";
                break;
        break;

        case "apropos":
                $vue="apropos";
                $pagetitle="À propos";
                break;
        break;

        case "choixmode":

            if(estConnecte()){
                if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
                    $pagetitle="En attente d'un adversaire !";
                    $page="jeu";
                    $vue="attente";
                    break;
                }
                if (isset($_SESSION['idJoueurAdverse'])) { // on est dans une partie ?
                    $vue="waitLoad";
                    $page="jeu";
                    $pagetitle="Chargement en cours des nouvelles données...";
                    break;
                }
                $vue="choixMode";
                $pagetitle="Choix du mode de jeu";
                break;
            }
            else {
                $messageErreur="Vous n'êtes pas connecté, vous ne pouvez pas jouer !";
            }
        break;

        default :
        $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
      }
    }
    else {
      $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
    }
    require VIEW_PATH . "vue.php";
