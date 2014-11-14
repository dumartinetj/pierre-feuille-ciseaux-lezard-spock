<?php

require_once MODEL_PATH."Jeu.php";
require_once MODEL_PATH."Joueur.php";

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
                        // check if partie avec notre id et delete partie (cascade ok) si c'est le cas
                        $_SESSION['idPartieEnCours'] = Partie::ajouterPartie($data2);
                        $_SESSION['idMancheEnCours'] = Manche::ajoutManche($_SESSION['idPartieEnCours']);
                        $data5 = array(
                            "listeManches" =>   $_SESSION['idMancheEnCours'],
                            "idPartie" => $_SESSION['idPartieEnCours']
                        );
                        Partie::ajoutListeManche($data5); // ajout la manche dans listeManches de la partie
                        $data3 = array(
                            "idJoueur1" => $_SESSION['idJoueur'],
                            "idJoueur2" => $_SESSION['idJoueurAdverse'],
                            "idManche" => $_SESSION['idMancheEnCours']
                        );
                        $_SESSION['idCoupEnCours'] = Coup::ajoutCoup($data3);
                        $data4 = array(
                            "listeCoups" =>   $_SESSION['idCoupEnCours'],
                            "idManche" => $_SESSION['idMancheEnCours']
                        );
                        Manche::ajoutListeCoup($data4); // ajout le coup dans listeCoups de la manche
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
                        $data2 = array(
                            "idJoueur1" => $_SESSION['idJoueurAdverse'],
                            "idJoueur2" => $_SESSION['idJoueur']
                        );
                        $_SESSION['idPartieEnCours'] = Partie::getIDPartie($data2);
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

            case "jouer":
                if(estConnecte()){
                        if($_SESSION['JoueurMaster'] == true) {
                          if(Partie::estTerminee($_SESSION['idPartieEnCours'],$_SESSION['idJoueur'],$_SESSION['idJoueurAdverse'])) {
                            $idJoueurGagnant = Partie::getIDJoueurGagnant($_SESSION['idPartieEnCours']);
                            $nomJoueurGagnant = Joueur::getPseudo($idJoueurGagnant);
                            if($idJoueurGagnant == $_SESSION['idJoueur']) {
                              Joueur::updateNbVictoire($_SESSION['idJoueur']);
                              Joueur::updateNbDefaite($_SESSION['idJoueurAdverse']);
                              $messageFinal = "Vous remportez la partie !";
                            }
                            else {
                              Joueur::updateNbVictoire($_SESSION['idJoueurAdverse']);
                              Joueur::updateNbDefaite($_SESSION['idJoueur']);
                              $messageFinal = $nomJoueurGagnant." remporte la partie !";
                            }
                            // supprimer les variables de session de lea partie
                            $vue="resultatPartie";
                            $pagetitle="Partie terminée";
                          }
                          else {
                            $_SESSION['idMancheEnCours'] = Manche::ajoutManche($_SESSION['idPartieEnCours']);
                            $data5 = array(
                                "listeManches" =>   $_SESSION['idMancheEnCours'],
                                "idPartie" => $_SESSION['idPartieEnCours']
                            );
                            Partie::updateListeManche($data5);
                            $data3 = array(
                                "idJoueur1" => $_SESSION['idJoueur'],
                                "idJoueur2" => $_SESSION['idJoueurAdverse'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            $_SESSION['idCoupEnCours'] = Coup::ajoutCoup($data3);
                            $data4 = array(
                                "listeCoups" =>   $_SESSION['idCoupEnCours'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            Manche::ajoutListeCoup($data4);
                            $vue="choix";
                            $pagetitle="Choisissez votre figure";
                          }
                        }
                        else {
                          $vue="waitLoad";
                          $pagetitle="Chargement en cours des nouvelles données...";
                        }
                    }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
                }
            break;

            case "waitingLoad":
                if(estConnecte()){
                    $idJoueurGagnant = Partie::getIDJoueurGagnant($_SESSION['idPartieEnCours']);
                    if ($idJoueurGagnant == NULL) {
                      $vue="choix";
                      $pagetitle="Choisissez votre figure";
                    }
                    else {
                      $nomJoueurGagnant = Joueur::getPseudo($idJoueurGagnant);
                      if($idJoueurGagnant == $_SESSION['idJoueur']) {
                        $messageFinal = "Vous remportez la partie !";
                      }
                      else {
                        $messageFinal = $nomJoueurGagnant." remporte la partie !";
                      }
                      $vue="resultatPartie";
                      $pagetitle="Partie terminée";
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

            case "eval":
                if(estConnecte()){
                    // test si isset post idfigure
                    if($_SESSION['JoueurMaster'] == true) {
                      $data = array(
                          "idFigure1" => $_POST['idFigure'],
                          "idCoup" => $_SESSION['idCoupEnCours']
                      );
                      $idCoup = $_SESSION['idCoupEnCours'];
                    }
                    else {
                      $data2 = array(
                          "idJoueur1" => $_SESSION['idJoueurAdverse'],
                          "idJoueur2" => $_SESSION['idJoueur']
                      );
                      $idCoup = Coup::getDernierCoup($data2);
                      $data = array(
                          "idFigure2" => $_POST['idFigure'],
                          "idCoup" => $idCoup
                      );

                    }
                    Coup::updateCoup($data);
                    if(Coup::checkCoupPretAEvaluer($idCoup)){
                        if($_SESSION['JoueurMaster'] == true) {
                          if (!Coup::estUnDraw($_SESSION['idCoupEnCours'])) {
                              Coup::evaluer($_SESSION['idCoupEnCours']);
                              $coup = Coup::getCoup($_SESSION['idCoupEnCours']);
                              $idF1 = $coup->idFigure1;
                              $idF2 = $coup->idFigure2;
                              $idJG = $coup->idJoueurGagnant;
                              $nomJoueurGagnant = Joueur::getPseudo($idJG);
                              if($idJG == $_SESSION['idJoueur']) {
                                $message = "Vous remportez la manche !";
                              }
                              else {
                                $message = $nomJoueurGagnant." remporte la manche !";
                              }
                              $data5 = array(
                                  "idManche" => $_SESSION['idMancheEnCours'],
                                  "idJoueurGagnant" => $idJG
                              );
                              Manche::setGagnantManche($data5); // stocke le gagnant
                              $vue="resulatCoup";
                              $pagetitle="Résulat du coup !";
                          }
                          else {
                            $data3 = array(
                                "idJoueur1" => $_SESSION['idJoueur'],
                                "idJoueur2" => $_SESSION['idJoueurAdverse'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            $_SESSION['idCoupEnCours'] = Coup::ajoutCoup($data3);
                            $data4 = array(
                                "listeCoups" =>   $_SESSION['idCoupEnCours'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            Manche::updateListeCoup($data4); // ajout le coup dans listeCoup de la manche
                            $vue="resultatDraw";
                            $pagetitle="Et c'est le draw !";
                          }
                        }
                        else { //on est pas le master
                            if (Coup::estUnDraw($idCoup)) {
                              $vue="resultatDraw";
                              $pagetitle="Et c'est le draw !";
                            }
                            else {
                              if(Coup::checkCoupEstEvaluer($idCoup)){
                                $vue="waitCoup";
                                $pagetitle="En attente du coup de votre adversaire !";
                                break;
                              }
                              $coup = Coup::getCoup($idCoup);
                              $idF2 = $coup->idFigure1;
                              $idF1 = $coup->idFigure1;
                              $idJG = $coup->idJoueurGagnant;
                              $nomJoueurGagnant = Joueur::getPseudo($idJG);
                              if($idJG == $_SESSION['idJoueur']) {
                                $message = "Vous remportez la manche !";
                              }
                              else {
                                $message = $nomJoueurGagnant." remporte la manche !";
                              }
                              $vue="resulatCoup";
                              $pagetitle="Résulat du coup !";
                            }
                        }
                    }
                    else {
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
                              Coup::evaluer($_SESSION['idCoupEnCours']);
                              $coup = Coup::getCoup($_SESSION['idCoupEnCours']);
                              $idF1 = $coup->idFigure1;
                              $idF2 = $coup->idFigure2;
                              $idJG = $coup->idJoueurGagnant;
                              $nomJoueurGagnant = Joueur::getPseudo($idJG);
                              if($idJG == $_SESSION['idJoueur']) {
                                $message = "Vous remportez la manche !";
                              }
                              else {
                                $message = $nomJoueurGagnant." remporte la manche !";
                              }
                              $data5 = array(
                                  "idManche" => $_SESSION['idMancheEnCours'],
                                  "idJoueurGagnant" => $idJG
                              );
                              Manche::setGagnantManche($data5); // stocke le gagnant
                              $vue="resulatCoup";
                              $pagetitle="Résulat du coup !";
                          }
                          else {
                            $data3 = array(
                                "idJoueur1" => $_SESSION['idJoueur'],
                                "idJoueur2" => $_SESSION['idJoueurAdverse'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            $_SESSION['idCoupEnCours'] = Coup::ajoutCoup($data3);
                            $data4 = array(
                                "listeCoups" =>   $_SESSION['idCoupEnCours'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            Manche::updateListeCoup($data4); // ajout le coup dans listeCoup de la manche
                            $vue="resultatDraw";
                            $pagetitle="Et c'est le draw !";
                          }
                        }
                        else { //on est pas le master
                            if (Coup::estUnDraw($idCoup)) {
                              $vue="resultatDraw";
                              $pagetitle="Et c'est le draw !";
                            }
                            else {
                              if(Coup::checkCoupEstEvaluer($idCoup)){
                                $vue="waitCoup";
                                $pagetitle="En attente du coup de votre adversaire !";
                                break;
                              }
                              $coup = Coup::getCoup($idCoup);
                              $idF2 = $coup->idFigure2;
                              $idF1 = $coup->idFigure1;
                              $idJG = $coup->idJoueurGagnant;
                              $nomJoueurGagnant = Joueur::getPseudo($idJG);
                              if($idJG == $_SESSION['idJoueur']) {
                                $message = "Vous remportez la manche !";
                              }
                              else {
                                $message = $nomJoueurGagnant." remporte la manche !";
                              }
                              $vue="resulatCoup";
                              $pagetitle="Résulat du coup !";
                            }
                        }
                    }
                    else {
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
