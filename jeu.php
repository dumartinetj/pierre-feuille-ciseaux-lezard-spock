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
            define('ROOT', dirname(__FILE__));
            define('DS', dirname(DIRECTORY_SEPARATOR));
            include ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
            //AFTER CHRONO
            require_once ROOT . DS . 'controleur' . DS . 'ControleurCoup.php';
        ?>
    </body>
</html>
