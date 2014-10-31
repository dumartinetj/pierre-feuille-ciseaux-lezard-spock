<?php
    if (empty($_GET)) {
      $vue='default';
      $pagetitle='Bienvenue sur PFCLS !';
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
    require VIEW_PATH . 'vue.php';
