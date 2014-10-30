<?php
    session_start();
    require_once('config.inc.php');
    $page = 'joueur';
    if (isset($_GET['action']))
        $action = $_GET['action'];
    else
        $action = "no_action";
    include CTR_PATH.'controleurJoueur.php';
?>
