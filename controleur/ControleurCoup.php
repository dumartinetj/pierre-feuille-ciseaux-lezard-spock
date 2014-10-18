<?php
    //define('VIEW_PATH', ROOT . DS . 'view' . DS . 'utilisateur' . DS);
    //require_once MODEL_PATH . 'ModelUtilisateur.php';
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case "play":
                if(isset($_GET['figure'])){
                    
                }
            break;

        default:
            //require VIEW_PATH . 'viewErrorUtilisateur.php'; //redirige vers une vue d'erreur
        }
}
