<?php
    require_once MODEL_PATH."Jeu.php";
    if (empty($_GET)) {
      if(estConnecte()){
        header('Location: index.php?action=choixmode');
      }
      else {
        $vue="default";
        $pagetitle='Le jeu';
      }
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
              $dataWaiting = array(
                "idJoueur" => $_SESSION['idJoueur']
              );
              $attente = Jeu::selectWhere($dataWaiting);
                if($attente != null) { // on est en recherche d'un adversaire ?
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
    require VIEW_PATH . "vue.php";
