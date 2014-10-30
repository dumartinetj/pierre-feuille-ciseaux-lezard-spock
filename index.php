<?php

define('ROOT', dirname(__FILE__));
define('DS', dirname(DIRECTORY_SEPARATOR));
define('BASE', str_replace('//', '/', dirname($_SERVER['PHP_SELF']). '/'));
define('VIEW_PATH', ROOT.DS.'vue'.DS);
define('CTR_PATH', ROOT.DS.'controleur'.DS);
define('MODEL_PATH', ROOT.DS.'modele'.DS);
define('VIEW_PATH_BASE', BASE.'vue/');

$page = 'index';
if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "no_action";
include CTR_PATH.'controleurIndex.php';

?>
