<?php

require_once MODEL_PATH."JeuIA.php";

if (empty($_GET)) {
  if(estConnecte()){
    $messageErreur="Erreur cette partie n'est pas encore construite";
  }

}
else if (isset($action)) {
  switch ($action) {

    case "begin":
    if(estConnecte()){
      $messageErreur="Erreur cette partie n'est pas encore construite";
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
