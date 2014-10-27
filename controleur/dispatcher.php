<?php

define('MODEL_PATH', ROOT . DS . 'modele' . DS);

if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = "index";

if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "no_action";

switch ($page) {
    case "index":
        require_once "controleurIndex.php";
        break;

    case "autre":
        require_once "controleurAutre.php";
        break;

    default:

}
?>