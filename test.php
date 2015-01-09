<?php
	
	require_once('config.inc.php');	
	require_once MODEL_PATH."JeuIA.php";
	
	$sequence = "1,2,3";
	
	$array = array();
    $test=JeuIA::coupSuiv($array,$sequence);
	echo $test;
	$test=JeuIA::reducSeq($sequence);
	echo $test;
?>