<?php

require_once MODEL_PATH."Jeu.php";
require_once MODEL_PATH.'Partie.php';
require_once MODEL_PATH.'Coup.php';

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
                        $idJoueurAdverse=$search;
                        $data2 = array(
                            "idJoueur1" => $_SESSION['idJoueur'],
                            "idJoueur2" => $idJoueurAdverse,
                            "nbManche" => $_POST['nbManche']
                        );
                        Jeu::deleteAttente($_SESSION['idJoueur']);
                        Jeu::deleteAttente($idJoueurAdverse);
                        $_SESSION['idPartieEnCours'] = Partie::ajouterPartie($data2);
                        $_SESSION['idMancheEnCours'] = Manche::ajoutManche($_SESSION['idPartieEnCours']);
                        $data3 = array(
                            "idJoueur1" => $_SESSION['idJoueur'],
                            "idJoueur2" => $idJoueurAdverse,
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
                        $vue="choix";
                        $pagetitle="Choisissez votre figure";
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

            case "jouer":
                if(estConnecte()){
                    // test si isset post idfigure
                    // fonction de test si partie est finie
                    //fonction de test si manche finie
                    $idFigure=$_POST['idFigure'];
                    var_dump($idFigure);
                    $data = array(
                        "idFigure" => $_POST['idFigure'],
                        "idJoueur" => $_SESSION['idJoueur']
                    );
                    var_dump($data);
                    Coup::updateCoup($data);
                    $vue="resulatCoup";
                    $pagetitle="Résulat du coup !";
                }
                else{
                    $messageErreur="Vous n'êtes pas encore connecté!";
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
