<?php
	
	require_once('config.inc.php');	
	require_once MODEL_PATH."JeuIA.php";
	
	$sequence = "1,2,3";
	$sequence2 = "1,2,3,4";
	$sequence3 = "1,2,3,5";
	$sequence4 = "1,2,3,4";
	
	
	$array = array($sequence3,$sequence2,$sequence4);
    $test2=JeuIA::coupSuiv($array,$sequence);
	//var_dump(test2);
	echo $test2;
	$test=JeuIA::reducSeq($sequence);
	echo $test;
?>