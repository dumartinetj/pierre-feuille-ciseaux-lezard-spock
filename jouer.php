<?php
    require_once('config.inc.php');
    if (isset($_GET['action'])){
        $action = $_GET['action'];       
    }
    if(isset($_GET['controleur'])){
        $page=$_GET['controleur'];
    }
    switch ($page){
        case "jeu":
            include CTR_PATH.'ControleurJeu.php';
        break;
        case "coup":
            include CTR_PATH.'ControleurCoup.php';
        break;
    }
?>
