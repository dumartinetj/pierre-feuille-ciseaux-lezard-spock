<?php

require_once('config.inc.php');

$page = 'index';
if (isset($_GET['action']))
    $action = $_GET['action'];
else
    $action = "no_action";
include CTR_PATH.'controleurIndex.php';

?>
