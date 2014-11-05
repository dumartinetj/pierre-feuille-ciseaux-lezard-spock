<?php
    require_once MODEL_PATH."Coup.php";
    
    /*
     * en gros avant d'insert il check si l'autre à joué ou pas, 
     * si c'est pas le cas il insert son coup, 
     * sinon il récupère celui de l'autre et il effectue les 
     * tests pour s'avoir qui gagne et après seulement il insert
     */
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
