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

        case "statistiques":
          $donneesDeJeuAll = StatsPerso::selectAll();
          $listeCoupsAll=array();
          foreach ($donneesDeJeuAll as $key => $value) {
            array_push($listeCoupsAll, $value->listeCoups);
          }
          $premierCoup = Joueur::premierCoupStats($listeCoupsAll);
          $compte = 0;
          foreach($premierCoup as $numFi => $nb){
            $compte += $nb;
          }


          $vue="statistiques";
          $pagetitle="Statistiques";
        break;

        case "apropos":
                $vue="apropos";
                $pagetitle="À propos";
        break;

        case "classement":
          $tableau = Joueur::getClassement();

          $tableauVue = '<div class="table-responsive"><table class="table table-bordered table-hover"><thead>
          <tr><th> Classement </th><th> Pseudo </th><th> Ratio </th></tr></thead><tbody>';
          $compteur = 1;
          foreach ($tableau as $pseudo=>$ratio) {
            $tableauVue .= '<tr';
            if ($compteur == 1) $tableauVue .= ' style ="background-color: #FDD017;"';
            else if ($compteur == 2) $tableauVue .= ' style ="background-color: #C0C0C0;"';
            else if ($compteur == 3) $tableauVue .= ' style ="background-color: #B87333;"';
            $tableauVue .= '><td>'.$compteur.'</td><td>'.$pseudo.'</td><td>'.$ratio.'</td></tr>';
            $compteur += 1;
          }
          $tableauVue .= '</tbody></table></div>';
          $vue="classement";
          $pagetitle="Classement";
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
