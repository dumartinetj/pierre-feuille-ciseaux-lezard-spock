<?php
    define('VIEW_PATH', ROOT . DS . 'vues' . DS . 'jeu' . DS);
    define('VIEW_PATH_IMG', ROOT . DS . 'vues' . DS . 'jeu' . DS.'img'.DS);
    //require_once MODEL_PATH . 'ModelUtilisateur.php';
    if(isset($_GET['action'])){ //Verifie si une action est bien passé en paramètre.
        $action = $_GET['action']; //Récupère l'action.
        switch ($action) { //Switch différentes actions.
            
            case "jouer": //si action=play    
                if(isset($_GET['figure'])){ //Verifie qu'une figure est saisie en paramètre
                    $figure = $_GET['figure'];
                    switch ($figure){
                        case "pierre":
                            require VIEW_PATH.'vueCoup.php';
                        break;
                        case "feuille":
                            require VIEW_PATH.'vueCoup.php';
                        break;
                        case "ciseaux":
                            require VIEW_PATH.'vueCoup.php';
                        break;
                        case "lezard":
                            require VIEW_PATH.'vueCoup.php';
                        break;
                        case "spock":
                            require VIEW_PATH.'vueCoup.php';
                        break;
                        default:
                            require VIEW_PATH.'vueErreurFigure.php';
                    }
                }
                else{echo "Saisir une Figure.";}
            break;
        

        default:
            require VIEW_PATH.'vueErreurAction.php';
        }
    }
    else{
        echo 'Saisir Action.';
    }
?>
