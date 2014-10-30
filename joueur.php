<?php
    define('ROOT', dirname(__FILE__));
    define('DS', dirname(DIRECTORY_SEPARATOR));
    define('VIEW_PATH', ROOT.DS.'vue'.DS);
    define('CTR_PATH', ROOT.DS.'controleur'.DS);
    define('MODEL_PATH', ROOT.DS.'modele'.DS);
    $page = 'joueur';
    if (isset($_GET['action']))
        $action = $_GET['action'];
    else
        $action = "no_action";
    include CTR_PATH.'controleurJoueur.php';
?>
