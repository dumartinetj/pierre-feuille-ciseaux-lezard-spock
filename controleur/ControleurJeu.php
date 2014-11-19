<?php

require_once MODEL_PATH."Jeu.php";

    if (empty($_GET)) {
      if(estConnecte()){
        if (isset($_SESSION['idJoueurAdverse'])) { // on est dans une partie ?
          $vue="waitLoad";
          $pagetitle="Chargement en cours des nouvelles données...";
        }
        else if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
            $pagetitle="En attente d'un adversaire !";
            $vue="attente";
        }
        else {
            $pagetitle="Jouer !";
            $vue="recherche";
        }

      }
      else {
          $messageErreur="Vous n'êtes pas connecté, vous ne pouvez pas jouer !";
      }

    }
    else if (isset($action)) {
        switch ($action) {

            case "rechercher":
                if(estConnecte()){
                    if (isset($_SESSION['idJoueurAdverse'])) { // on est dans une partie ?
                      $vue="waitLoad";
                      $pagetitle="Chargement en cours des nouvelles données...";
                      break;
                    }
                    else if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
                        $pagetitle="En attente d'un adversaire !";
                        $vue="attente";
                        break;
                    }
                    else if (!isset($_POST['nbManche'])) {
                      $messageErreur='Vous n\'avez pas saisi un nombre de manches !<br/><br/><a href="jouer.php">Saisir un nombre de manches</a>';
                      break;
                    }
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
                        unset($_SESSION['idJoueurAdverse']);
                        unset($_SESSION['idPartieEnCours']);
                        unset($_SESSION['idMancheEnCours']);
                        unset($_SESSION['idCoupEnCours']);
                        unset($_SESSION['JoueurMaster']);
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
                    $messageErreur="Vous n'êtes pas connecté !";
                }
            break;

            case "waiting":
                if(estConnecte()){
                    if (isset($_SESSION['idJoueurAdverse'])) { // on est dans une partie ?
                      $vue="waitLoad";
                      $pagetitle="Chargement en cours des nouvelles données...";
                      break;
                    } // donc on est attente ou non attente
                    $en_attente = Jeu::checkDejaAttente($_SESSION['idJoueur']);
                    if($en_attente){
                        $vue="attente";
                        $pagetitle="En attente d'un adversaire !";
                    }
                    else{ // on est plus en attente, mais est-on nous dans une nouvelle partie ?
                        unset($_SESSION['idJoueurAdverse']);
                        unset($_SESSION['idPartieEnCours']);
                        unset($_SESSION['idCoupEnCours']);
                        unset($_SESSION['JoueurMaster']);
                        $data = array(
                            "idJoueur1" => $_SESSION['idJoueur'],
                            "idJoueur2" => $_SESSION['idJoueur']
                        );
                        $_SESSION['idJoueurAdverse'] = Partie::getIDAdversaire($data); // recup l'id de l'adverse
                        if (!isset($_SESSION['idJoueurAdverse'])) {
                          // si par exemple on s'est co à deux endroits et qu'on se deco d'un
                          // l'autre sera toujours en recherche, on doit donc check
                          $pagetitle="Jouer !";
                          $vue="recherche";
                          break;
                        }
                        $data2 = array(
                            "idJoueur1" => $_SESSION['idJoueurAdverse'],
                            "idJoueur2" => $_SESSION['idJoueur']
                        );
                        $_SESSION['idPartieEnCours'] = Partie::getIDPartie($data2);
                        $_SESSION['JoueurMaster'] = false;
                        $data2 = array(
                            "idJoueur1" => $_SESSION['idJoueurAdverse'],
                            "idJoueur2" => $_SESSION['idJoueur']
                        );
                        $_SESSION['idCoupEnCours'] = Coup::getDernierCoup($data2);
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
                }
            break;

            case "rejouerCoup":
                if(estConnecte()){
                        if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
                            $pagetitle="En attente d'un adversaire !";
                            $vue="attente";
                            break;
                        }
                        else if (!isset($_SESSION['idJoueurAdverse'])) { // on est pas dans une partie ?
                          $pagetitle="Jouer !";
                          $vue="recherche";
                          break;
                        } // donc on est dans une partie
                        if($_SESSION['JoueurMaster'] == false) {
                          $dataCheckDonnes = array(
                            "idJoueur1" => $_SESSION['idJoueurAdverse'],
                            "idJoueur2" => $_SESSION['idJoueur']
                          );
                          if (Coup::getDernierCoupNul($dataCheckDonnes) == null) { // le nouveau a-til été créé ?
                            $vue="waitLoad";
                            $pagetitle="Chargement en cours des nouvelles données...";
                            break;
                          }
                          else {
                            $_SESSION['idCoupEnCours'] = Coup::getDernierCoup($dataCheckDonnes);
                            $vue="choix";
                            $pagetitle="Choisissez votre figure";
                            break;
                          }
                        }
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
                    }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
                }
            break;

            case "jouer":
                if(estConnecte()){
                        if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
                            $pagetitle="En attente d'un adversaire !";
                            $vue="attente";
                            break;
                        }
                        else if (!isset($_SESSION['idJoueurAdverse'])) { // on est pas dans une partie ?
                          $pagetitle="Jouer !";
                          $vue="recherche";
                          break;
                        } // donc on est dans une partie
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
                            $resultat = Partie::getResultat($_SESSION['idPartieEnCours'],$_SESSION['idJoueur'],$_SESSION['idJoueurAdverse']);
                            $victoireJ1 = $resultat['nbVictoireJ1'];
                            $victoireJ2 = $resultat['nbVictoireJ2'];
                            $dataStats = array(
                                "idJoueur1" =>   $_SESSION['idJoueur'],
                                "idJoueur2" => $_SESSION['idJoueurAdverse'],
                                "idPartie" => $_SESSION['idPartieEnCours']
                            );
                            Partie::ajoutStatsGlobales($dataStats);
                            // supprimer les variables de session de la partie
                            unset($_SESSION['idJoueurAdverse']);
                            unset($_SESSION['idPartieEnCours']);
                            unset($_SESSION['idMancheEnCours']);
                            unset($_SESSION['idCoupEnCours']);
                            unset($_SESSION['JoueurMaster']);
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
                  if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
                      $pagetitle="En attente d'un adversaire !";
                      $vue="attente";
                      break;
                  }
                  else if (!isset($_SESSION['idJoueurAdverse'])) { // on est pas dans une partie ?
                    $pagetitle="Jouer !";
                    $vue="recherche";
                    break;
                  } // donc on est dans une partie
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
                        $resultat = Partie::getResultat($_SESSION['idPartieEnCours'],$_SESSION['idJoueur'],$_SESSION['idJoueurAdverse']);
                        $victoireJ1 = $resultat['nbVictoireJ1'];
                        $victoireJ2 = $resultat['nbVictoireJ2'];
                        $dataStats = array(
                            "idJoueur1" =>   $_SESSION['idJoueur'],
                            "idJoueur2" => $_SESSION['idJoueurAdverse'],
                            "idPartie" => $_SESSION['idPartieEnCours']
                        );
                        Partie::ajoutStatsGlobales($dataStats);
                        // supprimer les variables de session de la partie
                        unset($_SESSION['idJoueurAdverse']);
                        unset($_SESSION['idPartieEnCours']);
                        unset($_SESSION['idMancheEnCours']);
                        unset($_SESSION['idCoupEnCours']);
                        unset($_SESSION['JoueurMaster']);
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
                    $idJoueurGagnant = Partie::getIDJoueurGagnant($_SESSION['idPartieEnCours']);
                    if ($idJoueurGagnant == NULL) {
                      $dataAnnul = array(
                          "idJoueur1" => $_SESSION['idJoueur'],
                          "idJoueur2" => $_SESSION['idJoueur']
                      );
                      if(Partie::getIDAdversaire($dataAnnul) == null){ // la partie a t-elle été annulée ?
                          unset($_SESSION['idJoueurAdverse']);
                          unset($_SESSION['idPartieEnCours']);
                          unset($_SESSION['idMancheEnCours']); // si elle existe pas, rien ne sera fait
                          unset($_SESSION['idCoupEnCours']);
                          unset($_SESSION['JoueurMaster']);
                          $messageErreur="Vous n'avez pas été assez rapide, la partie a donc été annulée !";
                          break;
                      }
                      $dataCheckDonnes = array(
                          "idJoueur1" => $_SESSION['idJoueurAdverse'],
                          "idJoueur2" => $_SESSION['idJoueur']
                      );
                      $data2 = array(
                          "idJoueur1" => $_SESSION['idJoueurAdverse'],
                          "idJoueur2" => $_SESSION['idJoueur']
                      );
                      if(Coup::whoUpdateCoup(array('idJoueur2' => $_SESSION['idJoueur']))== Coup::getDernierCoup($data2)) {
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
                      }
                      else if (Coup::getDernierCoupNul($dataCheckDonnes) == null) {
                        $vue="waitLoad";
                        $pagetitle="Chargement en cours des nouvelles données...";
                      }
                      else {
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
                      }
                    }
                    else {
                      $nomJoueurGagnant = Joueur::getPseudo($idJoueurGagnant);
                      if($idJoueurGagnant == $_SESSION['idJoueur']) {
                        $messageFinal = "Vous remportez la partie !";
                      }
                      else {
                        $messageFinal = $nomJoueurGagnant." remporte la partie !";
                      }
                      $resultat = Partie::getResultat($_SESSION['idPartieEnCours'],$_SESSION['idJoueur'],$_SESSION['idJoueurAdverse']);
                      $victoireJ1 = $resultat['nbVictoireJ1'];
                      $victoireJ2 = $resultat['nbVictoireJ2'];
                      // supprimer les variables de session de la partie
                      unset($_SESSION['idJoueurAdverse']);
                      unset($_SESSION['idPartieEnCours']);
                      unset($_SESSION['idCoupEnCours']);
                      unset($_SESSION['JoueurMaster']);
                      $vue="resultatPartie";
                      $pagetitle="Partie terminée";
                    }
                  }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
                }
            break;

            case "annulerPartie":
                if(estConnecte()){
                    if (isset($_SESSION['idJoueurAdverse'])) { // on est dans une partie ?
                      $data = array(
                          "idPartie" => $_SESSION['idPartieEnCours']
                      );
                      Partie::deletePartie($data);
                      unset($_SESSION['idJoueurAdverse']);
                      unset($_SESSION['idPartieEnCours']);
                      unset($_SESSION['idMancheEnCours']); // si elle existe pas, rien ne sera fait
                      unset($_SESSION['idCoupEnCours']);
                      unset($_SESSION['JoueurMaster']);
                      $vue="partieAnnulee";
                      $pagetitle="Partie annulée !";
                    }
                    else if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en attente ?
                        $pagetitle="En attente d'un adversaire !";
                        $vue="attente";
                    }
                    else {
                        $pagetitle="Jouer !";
                        $vue="recherche";
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
                }
            break;

            case "annuler":
                if(estConnecte()){
                    if (isset($_SESSION['idJoueurAdverse'])) { // on est dans une partie ?
                      $vue="waitLoad";
                      $pagetitle="Chargement en cours des nouvelles données...";
                      break;
                    }
                    else if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en attente ?
                        Jeu::deleteAttente($_SESSION['idJoueur']);
                        $vue="deleted";
                        $pagetitle="Annulation de la recherche d'une partie !";
                        break;
                    }
                    else{
                        $messageErreur="Vous n'êtes pas dans la liste d'attente !";
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
                }
            break;

            case "eval":
                if(estConnecte()){
                    if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
                        $pagetitle="En attente d'un adversaire !";
                        $vue="attente";
                        break;
                    }
                    if (!isset($_SESSION['idJoueurAdverse'])) { // on est pas dans une partie ?
                      $pagetitle="Jouer !";
                      $vue="recherche";
                      break;
                    } // donc on est dans une partie
                    if (!isset($_POST['idFigure'])) {
                      $messageErreur='Vous n\'avez pas choisi la figure que vous souhaitez jouer !<br/><a href="jouer.php">Choisir votre figure</a>';
                      break;
                    }
                    $dataAnnul = array(
                        "idJoueur1" => $_SESSION['idJoueur'],
                        "idJoueur2" => $_SESSION['idJoueur']
                    );
                    if(Partie::getIDAdversaire($dataAnnul) == null){ // la partie a t-elle été annulée ?
                        unset($_SESSION['idJoueurAdverse']);
                        unset($_SESSION['idPartieEnCours']);
                        unset($_SESSION['idMancheEnCours']); // si elle existe pas, rien ne sera fait
                        unset($_SESSION['idCoupEnCours']);
                        unset($_SESSION['JoueurMaster']);
                        $messageErreur="Vous n'avez pas été assez rapide, la partie a donc été annulée !";
                        break;
                    }
                    if($_SESSION['JoueurMaster'] == true) {
                      $data = array(
                          "idFigure1" => $_POST['idFigure'],
                          "idCoup" => $_SESSION['idCoupEnCours']
                      );
                    }
                    else {
                      $data2 = array(
                          "idJoueur1" => $_SESSION['idJoueurAdverse'],
                          "idJoueur2" => $_SESSION['idJoueur']
                      );
                      $_SESSION['idCoupEnCours'] = Coup::getDernierCoup($data2);
                      $data = array(
                          "idFigure2" => $_POST['idFigure'],
                          "idCoup" => $_SESSION['idCoupEnCours']
                      );

                    }
                    Coup::updateCoup($data);
                    if(Coup::checkCoupPretAEvaluer($_SESSION['idCoupEnCours'])){
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
                              $pagetitle="Résultat du coup !";
                          }
                          else {
                            $data3 = array(
                                "idJoueur1" => $_SESSION['idJoueur'],
                                "idJoueur2" => $_SESSION['idJoueurAdverse'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            $_SESSION['idCoupEnCours'] = Coup::ajoutCoup($data3);
                            $data4 = array(
                                "listeCoups" =>  $_SESSION['idCoupEnCours'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            Manche::updateListeCoup($data4); // ajout le coup dans listeCoup de la manche
                            $idF = $_POST['idFigure'];
                            $vue="resultatDraw";
                            $pagetitle="Et c'est le draw !";
                          }
                        }
                        else { //on est pas le master
                            if (Coup::estUnDraw($_SESSION['idCoupEnCours'])) {
                              $idF = $_POST['idFigure'];
                              $vue="resultatDraw";
                              $pagetitle="Et c'est le draw !";
                            }
                            else {
                              if(Coup::checkCoupEstEvaluer($_SESSION['idCoupEnCours'])){ // des fois le coup est joué
                                $temps_attente = 0;
                                $vue="waitCoup";                                         // mais pas encore évalué
                                $pagetitle="En attente du coup de votre adversaire !";
                                break;
                              }
                              $coup = Coup::getCoup($_SESSION['idCoupEnCours']);
                              $idF2 = $coup->idFigure1; // on échange pour afficher notre figure
                              $idF1 = $coup->idFigure2; // en premier sur la vue
                              $idJG = $coup->idJoueurGagnant;
                              $nomJoueurGagnant = Joueur::getPseudo($idJG);
                              if($idJG == $_SESSION['idJoueur']) {
                                $message = "Vous remportez la manche !";
                              }
                              else {
                                $message = $nomJoueurGagnant." remporte la manche !";
                              }
                              $vue="resulatCoup";
                              $pagetitle="Résultat du coup !";
                            }
                        }
                    }
                    else {
                      $temps_attente = 0;
                      $vue="waitCoup";
                      $pagetitle="En attente du coup de votre adversaire !";
                    }

                }
                else{
                    $messageErreur="Vous n'êtes pas encore connecté !";
                }
            break;

            case "waitingCoup":
                if(estConnecte()){
                    if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
                        $pagetitle="En attente d'un adversaire !";
                        $vue="attente";
                        break;
                    }
                    else if (!isset($_SESSION['idJoueurAdverse'])) { // on est pas dans une partie ?
                      $pagetitle="Jouer !";
                      $vue="recherche";
                      break;
                    } // donc on est dans une partie
                    if(Coup::checkCoupPretAEvaluer($_SESSION['idCoupEnCours'])){
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
                              $pagetitle="Résultat du coup !";
                          }
                          else {
                            $data3 = array(
                                "idJoueur1" => $_SESSION['idJoueur'],
                                "idJoueur2" => $_SESSION['idJoueurAdverse'],
                                "idManche" => $_SESSION['idMancheEnCours']
                            );
                            $idF = Coup::getCoup($_SESSION['idCoupEnCours'])->idFigure1;
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
                            if (Coup::estUnDraw($_SESSION['idCoupEnCours'])) {
                              $idF = Coup::getCoup($_SESSION['idCoupEnCours'])->idFigure1;
                              $vue="resultatDraw";
                              $pagetitle="Et c'est le draw !";
                            }
                            else {
                              if(Coup::checkCoupEstEvaluer($_SESSION['idCoupEnCours'])){
                                $vue="waitCoup";
                                $pagetitle="En attente du coup de votre adversaire !";
                                break;
                              }
                              $coup = Coup::getCoup($_SESSION['idCoupEnCours']);
                              $idF2 = $coup->idFigure1; // on échange pour afficher notre figure
                              $idF1 = $coup->idFigure2; // en premier sur la vue
                              $idJG = $coup->idJoueurGagnant;
                              $nomJoueurGagnant = Joueur::getPseudo($idJG);
                              if($idJG == $_SESSION['idJoueur']) {
                                $message = "Vous remportez la manche !";
                              }
                              else {
                                $message = $nomJoueurGagnant." remporte la manche !";
                              }
                              $vue="resulatCoup";
                              $pagetitle="Résultat du coup !";
                            }
                        }
                    }
                    else {
                      $temps_attente = $_POST['temps_attente'];
                        $vue="waitCoup";
                        $pagetitle="En attente du coup de votre adversaire !";
                    }
                }
                else{
                    $messageErreur="Vous n'êtes pas connecté !";
                }
            break;

        default :
            if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
                $pagetitle="En attente d'un adversaire !";
                $vue="attente";
                break;
            }
            else if (isset($_SESSION['idJoueurAdverse'])) { // on est dans une partie ?
              $vue="waitLoad";
              $pagetitle="Chargement en cours des nouvelles données...";
              break;
            } // donc une erreur
            $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
        }
      }
      else {
        if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){ // on est en recherche d'un adversaire ?
            $pagetitle="En attente d'un adversaire !";
            $vue="attente";
        }
        else if (isset($_SESSION['idJoueurAdverse'])) { // on est dans une partie ?
          $vue="waitLoad";
          $pagetitle="Chargement en cours des nouvelles données...";
        } // donc une erreur
        $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
      }
require VIEW_PATH."vue.php";
