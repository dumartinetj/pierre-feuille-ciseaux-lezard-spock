<?php
require_once('config.inc.php');
$page = 'jeuIA';
if (isset($_GET['action']))
$action = $_GET['action'];
include CTR_PATH.'ControleurJeuIA.php';
?>
