<?php
    require_once MODEL_PATH."Coup.php";
    
    if(isset($_GET['action'])){ 
        $action = $_GET['action']; 
        switch ($action) {
            case "play":
                if(estConnecte()){
                    $vue='play';
                    $pagetitle="Manche N° - Coup N°";
                }
                else{
                    $messageErreur="Vous n'êtes pas encore connecté!";
                }
            break;
      
            case "jouer":
                if(estConnecte()){
                    $figure=$_POST['idFigure'];
                    $vue="jouer";
                    $pagetitle="Coup Joué!";
                }
                else{
                    $messageErreur="Vous n'êtes pas encore connecté!";
                }
            break;
        

        default:
            require VIEW_PATH.'vueErreurAction.php';
        }
    }
require VIEW_PATH."vue.php";
?>
