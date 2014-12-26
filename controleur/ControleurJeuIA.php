<?php

require_once MODEL_PATH."JeuIA.php";
require_once MODEL_PATH."Jeu.php";
require_once MODEL_PATH."StatsPerso.php";

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
      $_SESSION['idPartieEnCours'] = Partie::insertion($data2);
      $dataManche = array(
        "idPartie" => $_SESSION['idPartieEnCours']
      );
      $_SESSION['idMancheEnCours'] = Manche::insertion($dataManche);
      $data5 = array(
        "listeManches" =>   $_SESSION['idMancheEnCours'],
        "idPartie" => $_SESSION['idPartieEnCours']
      );
      Partie::update($data5); // ajout la manche dans listeManches de la partie
      $data3 = array(
        "idJoueur1" => $_SESSION['idJoueur'],
        "idJoueur2" => 0,
        "idManche" => $_SESSION['idMancheEnCours']
      );
      $_SESSION['idCoupEnCours'] = Coup::insertion($data3); 
      $_SESSION['idPremierCoup']= $_SESSION['idCoupEnCours'];
      $data4 = array(
        "listeCoups" =>   $_SESSION['idCoupEnCours'],
        "idManche" => $_SESSION['idMancheEnCours']
      );
      Manche::update($data4); // ajout le coup dans listeCoups de la manche
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
      Coup::update($data);
      $dataDejaJoue = array(
          'idJoueur'=>$_SESSION['idJoueur']
      );
      $dejaJoue=StatsPerso::selectWhere($dataDejaJoue);
      if($_SESSION['idPremierCoup']==$_SESSION['idCoupEnCours']){ //Si c'est le premier coup de la partie
            echo'C LE PREMIER COUP TAHVU';
            if($dejaJoue!=NULL){ //Si il y'a déjà des données sur le joueur
                $listeCoupsJoueur="";
                foreach ($dejaJoue as $key => $value) {
                    $listeCoupsJoueur .= str_replace(',', '', $value->listeCoups);
                }
                $figureCount = array( //Listes figures avec nb d'utilisations par le joueur
                    '1'=>substr_count($listeCoupsJoueur,'1',0,strlen($listeCoupsJoueur)),
                    '2'=>substr_count($listeCoupsJoueur,'2',0,strlen($listeCoupsJoueur)),
                    '3'=>substr_count($listeCoupsJoueur,'3',0,strlen($listeCoupsJoueur)),
                    '4'=>substr_count($listeCoupsJoueur,'4',0,strlen($listeCoupsJoueur)),
                    '5'=>substr_count($listeCoupsJoueur,'5',0,strlen($listeCoupsJoueur))
                );
                $nbOccumax=0;
                $figuremax=0;
                foreach($figureCount as $figure => $nbOccu){ //On check quelle est la figure la plus utilisée.
                    if($nbOccu>$nbOccumax){
                        $nbOccumax=$nbOccu;
                        $figuremax=$figure;
                    }
                }
                $dataFaiblesses = array(
                    'idFigure'=>$figuremax
                );
                $faiblesses=Figure::select($dataFaiblesses)->faiblesses;
                var_dump($faiblesses);
                $valeurs = explode(",",$faiblesses);
                $faiblesserandom = array_rand($valeurs);
                $choixFigure = $valeurs[$faiblesserandom];
                $dataCas1 = array(
                    "idFigure2" => $choixFigure,
                    "idCoup" => $_SESSION['idCoupEnCours']
                );
                Coup::update($dataCas1);
            }
            else{ //Si le FDP a jamais joué
                $idFigureRand = mt_rand(1,5); //random pour le moment
                $dataCas2 = array(
                    "idFigure2" => $idFigureRand,
                    "idCoup" => $_SESSION['idCoupEnCours']
                );
                Coup::update($dataCas2);
            }
      }
      else{
          
      }
          if (!Coup::estUnDraw($_SESSION['idCoupEnCours'])) {
            Coup::evaluer($_SESSION['idCoupEnCours']);
            $data= array(
              "idCoup" =>$_SESSION['idCoupEnCours']
            );
            $coup = Coup::select($data);
            $idF1 = $coup->idFigure1;
            $idF2 = $coup->idFigure2;
            $idJG = $coup->idJoueurGagnant;
            $data= array(
              "idJoueur"=> $idJG
            );
            $nomJoueurGagnant = Joueur::select($data)->pseudo;
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
            $r = Manche::update($data5); // stocke le gagnant
            $vue="resulatCoup";
            $pagetitle="Résultat du coup !";
          }
          else {
            $data3 = array(
            "idJoueur1" => $_SESSION['idJoueur'],
            "idJoueur2" => 0,
            "idManche" => $_SESSION['idMancheEnCours']
            );
            $_SESSION['idCoupEnCours'] = Coup::insertion($data3);
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
          $data= array(
            "idPartie"=> $_SESSION['idPartieEnCours']
          );
          $idJoueurGagnant = Partie::select($data)->idJoueurGagnant;
          $data= array(
            "idJoueur"=> $idJoueurGagnant
          );
          $nomJoueurGagnant = Joueur::select($data)->pseudo;
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
          $dataManche = array(
            "idPartie" => $_SESSION['idPartieEnCours']
          );
          $_SESSION['idMancheEnCours'] = Manche::insertion($dataManche);
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
            $_SESSION['idCoupEnCours'] = Coup::insertion($data3);
            $data4 = array(
            "listeCoups" =>   $_SESSION['idCoupEnCours'],
            "idManche" => $_SESSION['idMancheEnCours']
            );
            Manche::update($data4);
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
