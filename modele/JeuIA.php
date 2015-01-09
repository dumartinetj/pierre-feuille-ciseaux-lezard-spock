<?php

require_once 'Modele.php';
require_once 'Partie.php';
require_once MODEL_PATH.'Joueur.php'; 

class JeuIA extends Modele{
	
	protected static $table = "pfcls_Parties_en_attente";
	protected static $primary_index = "idPartie_en_attente";
	
	
	/*public static function recupSequence(){//permet de récup la séquence de coup en cour du joueur 
		//if (estConnecte()){
		    $data = array("listeCoups" => "%".$sequence."%");
			try{
			
			 $req = self::$pdo->prepare('SELECT listeCoups FROM pfcls_statistiquespersonnelles WHERE listeCoups LIKE :listeCoups');
			 $req -> execute($data);
			} catch (PDOException $e) {
                echo $e->getMessage();
                $messageErreur="Erreur lors de la récupération de la séquence";
            }
        
		//}
            
            $resultat = $pdo->query($requete);
            $check=$resultat->fetch(PDO::FETCH_NUM);
             
            
            
    }
	*/
	

    public static function reducSeq($sequence){
		
        return $sequenceRed = substr($sequence,2);
        
    }
	
    public static function coupSuiv($array, $sequence){
         // on va y mettre les séquences qui ont une valeur après la séquence que l'ont recherche
        foreach($array as $value){
            $arrayValeurs = array(strstr($value,"$sequence",true),); //ajoute les séquence qui contiennent la séquence recherché 
            //avec la séquence recherchée en début de chaine de caractère et la suite de la chaine. 
            //exemple: on cherche la séquence 123 dans la chaine 241312345 on obtiendra la chaine 12345 dans le tableau.
        }
        foreach($arrayValeurs as $value){
            $value = substr($value,strlen($sequence),1);   //strlen(string) renvoie la longueur de string.
            // substr renvoie les n premier caractère de $value en commençant par le caractère n°"strlen(string)" (dans "abcd" le n°0="a")
            // donc on va aller chercher le caractère juste après la séquence
            // les n premiers caractères sont déterminer par "1" (on ne veut que le coup jouer après la séquence).
        }
		
        return (self::occurence($arrayValeurs)); // renvoie le nombre d'occurence du caractère q
    } 
	
	
    public static function occurence($arrayValeur){
        $a = $b = $c = $d = $e = 0;
        foreach ($arrayValeur as $value){
            if ($value == "1"){
                $a = $a+1;
            } elseif ($value == "2") {
                $b = $b+1;
            } elseif ($value == "3") {
                $c = $c+1;
            } elseif ($value == "4") {
                $d= $d+1;
            } elseif ($value == "5") {
                $e = $e+1;
            }
        } 
        if ($a>$b and $a>$c and $a>$d and $a>$e){
            return ($a);
        } elseif ($b>$a and $b>$c and $b>$d and $b>$e){
            return($b);
        } elseif ($c>$a and $c>$b and $c>$d and $c>$e){
            return($c);
        } elseif ($d>$a and $d>$c and $d>$b and $d>$e){
            return($d);
        } elseif ($e>$a and $e>$c and $e>$d and $e>$b){
            return($e);
        }
        
    }

}

?>
