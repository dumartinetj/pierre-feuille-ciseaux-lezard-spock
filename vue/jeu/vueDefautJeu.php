<?php 
if(estConnecte()){
    if(Jeu::checkDejaAttente($_SESSION['idJoueur'])){
        include VIEW_PATH.'jeu'.DS.'vueAttenteJeu.php';
    }
    else{
        include VIEW_PATH.'jeu'.DS.'vueRechercheJeu.php';
    }
}
else{
    $messageErreur="Vous n'êtes pas connecté, vous ne pouvez pas jouer (pas encore) !";
}