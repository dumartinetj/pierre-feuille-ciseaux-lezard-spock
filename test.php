<?php
	
	require_once('config.inc.php');	
	require_once MODEL_PATH."JeuIA.php";
	
	$sequence = "1,2,3";
	$sequence2 = "1,2,3,4";
	$sequence3 = "1,2,3,5";
	$sequence4 = "1,2,3,4";
	$sequence5 = "1,2,4,5";
	$sequence6 = "3,4,1,2,3,4,7";
	
	/*$arrayValeurs = array();
	$arrayValeurs[] = strstr($sequence2, $sequence ,  $before_sequence = false);
	$arrayValeurs[] = strstr($sequence5, $sequence ,  $before_sequence = false);
	$arrayValeurs[] = strstr($sequence3, $sequence ,  $before_sequence = false);
	//for($i=0;$i<=1;$i++){ 
	echo $arrayValeurs[0]."\n";
	echo ", ".$arrayValeurs[1]."\n";
	//$arrayValeurs[2]."\n";
	//break; 
	
	//}*/
	var_dump($sequence);
	$array = array($sequence3,$sequence2,$sequence4,$sequence5,$sequence6);
	var_dump($array);
    $test2=JeuIA::coupSuiv($array , $sequence);
	var_dump($test2);
	/*for($i=0;$i<=count($test2);$i++){ 
			echo $test2[$i]."\r";
	}*/
	$test=JeuIA::reducSeq($sequence);
	var_dump($test);
	echo $test;
?>