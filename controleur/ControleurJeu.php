<?php

require_once MODEL_PATH."Jeu.php";

    if (empty($_GET)) {
      if(estConnecte()){

        if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){
            $pagetitle="En attente d'un adversaire !";
            $vue="attente";
        }
        else{
            $pagetitle="Jouer !";
            $vue="recherche";
        }


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
                        $_SESSION['idJoueurAdverse']=$search;
                        $data2 = array(
                            "idJoueur1" => $_SESSION['idJoueur'],
                            "idJoueur2" => $_SESSION['idJoueurAdverse'],
                            "nbManche" => $_POST['nbManche']
                        );
                        Jeu::deleteAttente($_SESSION['idJoueur']);
                        Jeu::deleteAttente($_SESSION['idJoueurAdverse']);
                        $_SESSION['JoueurMaster'] = true;
                        $_SESSION['idPartieEnCours'] = Partie::ajouterPartie($data2);
                        $_SESSION['idMancheEnCours'] = Manche::ajoutManche($_SESSION['idPartieEnCours']);
                        $data3 = array(
                            "idJoueur1" => $_SESSION['idJoueur'],
                            "idJoueur2" => $_SESSION['idJoueurAdverse'],
                            "idManche" => $_SESSION['idMancheEnCours']
                        );
                        $_SESSION['idCoupEnCours'] = Coup::ajoutCoup($data3);
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté!";
                }
            break;

            case "waiting":
                if(estConnecte()){
                    $en_attente = Jeu::checkDejaAttente($_SESSION['idJoueur']);
                    if($en_attente){
                        $vue="attente";
                        $pagetitle="En attente d'un adversaire !";
                    }
                    else{
                        $data = array(
                            "idJoueur1" => $_SESSION['idJoueur'],
                            "idJoueur2" => $_SESSION['idJoueur']
                        );
                        $_SESSION['idJoueurAdverse'] = Partie::getIDAdversaire($data); // recup l'id de l'adverse
                        $_SESSION['JoueurMaster'] = false;
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté!";
                }
            break;

            case "rejouerCoup":
                if(estConnecte()){
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
                    }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
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

            case "jouer":
                if(estConnecte()){
                    // test si isset post idfigure
                    // fonction de test si partie est finie
                    //fonction de test si manche finie
                    $data = array(
                        "idFigure" => $_POST['idFigure'],
                        "idJoueur" => $_SESSION['idJoueur']
                    );
                    Coup::updateCoup($data);
                    if($_SESSION['JoueurMaster'] == true) {
                      $idCoup = $_SESSION['idCoupEnCours'];
                    }
                    else {
                      $data = array(
                          "idJoueur1" => $_SESSION['idJoueurAdverse'],
                          "idJoueur2" => $_SESSION['idJoueur']
                      );
                      $idCoup = Coup::getDernierCoup($data);
                    }
                    if(Coup::checkCoupPretAEvaluer($idCoup)){
                        if($_SESSION['JoueurMaster'] == true) {
                          if (!Coup::estUnDraw($_SESSION['idCoupEnCours'])) {
                              Coup::evaluer($_SESSION['idCoupEnCours']);
                              $coup = Coup::getCoup($_SESSION['idCoupEnCours']);
                              $idF1 = $coup->idFigure1;
                              $idF2 = $coup->idFigure2;
                              $idJG = $coup->idJoueurGagnant;
                              $message = "Vous avez perdu !";
                              if($_SESSION['idJoueur']==$idJG) $message = "Vous avez gagné !";
                              $vue="resulatCoup";
                              $pagetitle="Résulat du coup !";
                          }
                          else {
                            $idj1 = Coup::getIDJoueur1($_SESSION['idCoupEnCours']);
                            $idj2 = Coup::getIDJoueur2($_SESSION['idCoupEnCours']);
                            $data3 = array(
                                "idJoueur1" => $idj1,
                                "idJoueur2" => $idj2,
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            $_SESSION['idCoupEnCours'] = Coup::ajoutCoup($data3);
                            $vue="resultatDraw";
                            $pagetitle="Et c'est le draw !";
                          }
                        }
                        else { //on est pas le master
                            $data = array(
                                "idJoueur1" => $_SESSION['idJoueurAdverse'],
                                "idJoueur2" => $_SESSION['idJoueur']
                            );
                            $idCoup = Coup::getDernierCoup($data);
                            if (Coup::estUnDraw($idCoup)) {
                              $vue="resultatDraw";
                              $pagetitle="Et c'est le draw !";
                            }
                            else {
                              $coup = Coup::getCoup($idCoup);
                              $idF1 = $coup->idFigure1;
                              $idF2 = $coup->idFigure2;
                              $idJG = $coup->idJoueurGagnant;
                              $message = "Vous avez perdu !";
                              if($_SESSION['idJoueur']==$idJG) $message = "Vous avez gagné !";
                              $vue="resulatCoup";
                              $pagetitle="Résulat du coup !";
                            }
                        }
                    }
                    else {
                      $idFigure=$_POST['idFigure'];
                      $vue="waitCoup";
                      $pagetitle="En attente du coup de votre adversaire !";
                    }

                }
                else{
                    $messageErreur="Vous n'êtes pas encore connecté!";
                }
            break;

            case "waitingCoup":
                if(estConnecte()){
                    if($_SESSION['JoueurMaster'] == true) {
                      $idCoup = $_SESSION['idCoupEnCours'];
                    }
                    else {
                      if(Coup::whoUpdateCoup(array('idJoueur2' => $_SESSION['idJoueur']))) {
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
                        break;
                      }
                      $data = array(
                          "idJoueur1" => $_SESSION['idJoueurAdverse'],
                          "idJoueur2" => $_SESSION['idJoueur']
                      );
                      $idCoup = Coup::getDernierCoup($data);
                    }
                    if(Coup::checkCoupPretAEvaluer($idCoup)){
                        if($_SESSION['JoueurMaster'] == true) {
                          if (!Coup::estUnDraw($_SESSION['idCoupEnCours'])) {
                              //Coup::evaluer($_SESSION['idCoupEnCours']);
                              $coup = Coup::getCoup($_SESSION['idCoupEnCours']);
                              $idF1 = $coup->idFigure1;
                              $idF2 = $coup->idFigure2;
                              $idJG = $coup->idJoueurGagnant;
                              $message = "Vous avez perdu !";
                              if($_SESSION['idJoueur']==$idJG) $message = "Vous avez gagné !";
                              $vue="resulatCoup";
                              $pagetitle="Résulat du coup !";
                          }
                          else {
                            $idj1 = Coup::getIDJoueur1($_SESSION['idCoupEnCours']);
                            $idj2 = Coup::getIDJoueur2($_SESSION['idCoupEnCours']);
                            $data3 = array(
                                "idJoueur1" => $idj1,
                                "idJoueur2" => $idj2,
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            $_SESSION['idCoupEnCours'] = Coup::ajoutCoup($data3);
                            $vue="resultatDraw";
                            $pagetitle="Et c'est le draw !";
                          }
                        }
                        else { //on est pas le master
                            $data = array(
                                "idJoueur1" => $_SESSION['idJoueurAdverse'],
                                "idJoueur2" => $_SESSION['idJoueur']
                            );
                            $idCoup = Coup::getDernierCoup($data);
                            if (Coup::estUnDraw($idCoup)) {
                              $vue="resultatDraw";
                              $pagetitle="Et c'est le draw !";
                            }
                            else {
                              $coup = Coup::getCoup($idCoup);
                              $idF1 = $coup->idFigure1;
                              $idF2 = $coup->idFigure2;
                              $idJG = $coup->idJoueurGagnant;
                              $message = "Vous avez perdu !";
                              if($_SESSION['idJoueur']==$idJG) $message = "Vous avez gagné !";
                              $vue="resulatCoup";
                              $pagetitle="Résulat du coup !";
                            }
                        }
                    }
                    else {
                      $idFigure=$_POST['idFigure'];
                      $vue="waitCoup";
                      $pagetitle="En attente du coup de votre adversaire !";
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
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
