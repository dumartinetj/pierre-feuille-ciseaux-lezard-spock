<?php
    if (empty($_GET)) {
      $vue="default";
      $pagetitle='Bienvenue sur PFCLS !';
    }
    else if (isset($action)) {
      switch ($action) {

        case "regles":
                $vue="regles";
                $pagetitle="Règles du jeu";
                break;
        break;

        default :
        $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
      }
    }
    else {
      $messageErreur="Il semblerait que vous ayez trouvé un glitch dans le système !";
    }
    require VIEW_PATH . "vue.php";
