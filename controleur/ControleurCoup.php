<?php
    //define('VIEW_PATH', ROOT . DS . 'view' . DS . 'utilisateur' . DS);
    //require_once MODEL_PATH . 'ModelUtilisateur.php';
    if(isset($_GET['action'])){ //Verifie si une action est bien passé en paramètre.
        $action = $_GET['action']; //Récupère l'action.
        switch ($action) { //Switch différentes actions.
            
            case "jouer": //si action=play    
                if(isset($_GET['figure'])){ //Verifie qu'une figure est saisie en paramètre
                    $figure = $_GET['figure'];
                    switch ($figure){
                        case "pierre":
                            require_once '';
                        break;
                        case "feuille":
                        break;
                        case "ciseaux":
                        break;
                        case "lezard":
                        break;
                        case "spock":
                        break;
                    }
                }
            break;
        

        default:
            //require VIEW_PATH . 'viewErrorUtilisateur.php'; //redirige vers une vue d'erreur
            echo "Cette action n'existe pas.";
        }
    }
    else{
        echo 'Saisir Action.';
    }
?>
