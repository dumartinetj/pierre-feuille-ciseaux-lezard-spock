<?php
    define('VIEW_PATH', ROOT . DS . 'vue' . DS);
    switch ($action) {
            
        case "no_action":  
			$pagetitle = "Bienvenue sur PFCLS !";
			$vue = "";
            break;

		default:
			$pagetitle = "Erreur";
			$vue = "erreur";
			break;
    }
	require VIEW_PATH . 'vue.php';

?>
