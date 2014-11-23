<?php

require_once MODEL_PATH."JeuIA.php";
require_once MODEL_PATH."Jeu.php";

if (empty($_GET)) {
  if(estConnecte()){
    $vue="choixIA";
    $pagetitle="Choisissez votre nombre de manches";
  }

}
else if (isset($action)) {
  switch ($action) {

    case "begin":
    if(estConnecte()){
      $data2 = array(
        "idJoueur1" => $_SESSION['idJoueur'],
        "idJoueur2" => 0,
        "nbManche" => $_POST['nbManche']
      );
      $_SESSION['idPartieEnCours'] = Partie::ajouterPartie($data2);
      $_SESSION['idMancheEnCours'] = Manche::ajoutManche($_SESSION['idPartieEnCours']);
      $data5 = array(
        "listeManches" =>   $_SESSION['idMancheEnCours'],
        "idPartie" => $_SESSION['idPartieEnCours']
      );
      Partie::ajoutListeManche($data5); // ajout la manche dans listeManches de la partie
      $data3 = array(
        "idJoueur1" => $_SESSION['idJoueur'],
        "idJoueur2" => 0,
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
    else{
      $messageErreur="Vous n'êtes pas connecté !";
    }
    break;

    case "eval":
    if(estConnecte()){

      $data = array(
          "idFigure1" => $_POST['idFigure'],
          "idCoup" => $_SESSION['idCoupEnCours']
      );
      Coup::updateCoup($data);
      $idFigureRand = mt_rand(1,5); //random pour le moment
      $data2 = array(
        "idFigure2" => $idFigureRand,
        "idCoup" => $_SESSION['idCoupEnCours']
      );
      Coup::updateCoup($data2);
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
            "idJoueur2" => 0,
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
    else{
      $messageErreur="Vous n'êtes pas encore connecté !";
    }
    break;

    case "jouer":
    if(estConnecte()){
        if(Partie::estTerminee($_SESSION['idPartieEnCours'],$_SESSION['idJoueur'],0)) {
          $idJoueurGagnant = Partie::getIDJoueurGagnant($_SESSION['idPartieEnCours']);
          $nomJoueurGagnant = Joueur::getPseudo($idJoueurGagnant);
          if($idJoueurGagnant == $_SESSION['idJoueur']) {
            Joueur::updateNbVictoire($_SESSION['idJoueur']);
            Joueur::updateNbDefaite(0);
            $messageFinal = "Vous remportez la partie !";
          }
          else {
            Joueur::updateNbVictoire(0);
            Joueur::updateNbDefaite($_SESSION['idJoueur']);
            $messageFinal = $nomJoueurGagnant." remporte la partie !";
          }
          $resultat = Partie::getResultat($_SESSION['idPartieEnCours'],$_SESSION['idJoueur'],0);
          $victoireJ1 = $resultat['nbVictoireJ1'];
          $victoireJ2 = $resultat['nbVictoireJ2'];
          $dataStats = array(
            "idJoueur1" =>   $_SESSION['idJoueur'],
            "idJoueur2" => 0,
            "idPartie" => $_SESSION['idPartieEnCours']
          );
          Partie::ajoutStatsGlobales($dataStats);
          // supprimer les variables de session de la partie
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
            "idJoueur2" => 0,
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
      else{
        $messageErreur="Vous n'êtes pas connecté !";
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

    default :
        $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
  }
}
else {

        $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
}
require VIEW_PATH."vue.php";
