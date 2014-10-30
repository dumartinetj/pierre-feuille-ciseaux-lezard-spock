<?php

define('ROOT', dirname(__FILE__));
define('DS', dirname(DIRECTORY_SEPARATOR));
define('BASE', str_replace('//', '/', dirname($_SERVER['PHP_SELF']). '/'));
define('VIEW_PATH_BASE', BASE.'vue/');

include ROOT . DS . 'controleur' . DS . 'dispatcher.php';

?>
