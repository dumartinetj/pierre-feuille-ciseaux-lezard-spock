<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Page de Jeu</title>
    </head>
    <body>
        <?php
            // ROOT permet de gérer différentes racines du projet
            define('ROOT', dirname(__FILE__));
            // DS contient le slash des chemins de fichiers, c'est-à-dire '/' sur Linux et '\' sur Windows
            define('DS', dirname(DIRECTORY_SEPARATOR));
            // include fait une inclusion textuelle (comme un copier/coller) du fichier
            // ./controller/dispatcher.php (sous Linux)
            include ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            require_once ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
        ?>
    </body>
</html>
