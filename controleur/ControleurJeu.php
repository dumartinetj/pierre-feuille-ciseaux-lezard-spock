<?php

require_once MODEL_PATH."Partie.php";

    if (empty($_GET)) {
      if(estConnecte()){
        $vue="defaut";
        $pagetitle="Jouer !";

      }
      else {
          $messageErreur="Vous n'êtes pas connecté, vous ne pouvez pas jouer (pas encore) !";
      }

    }
    else if (isset($action)) {
        switch ($action) {

        default :
            $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
        }
      }
      else {
        $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
      }
require VIEW_PATH."vue.php";
