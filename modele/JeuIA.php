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
	
    public static function coupSuiv(array $array, $sequence){
         // on va y mettre les séquences qui ont une valeur après la séquence que l'ont recherche
		
        for($i=0;$i<count($array);$i++){
			if(strstr($array[$i], $sequence ,  $before_sequence = false)!=false){
            $arrayValeurs[] = strstr($array[$i], $sequence ,  $before_sequence = false); //ajoute les séquence qui contiennent la séquence recherché 
            //avec la séquence recherchée en début de chaine de caractère et la suite de la chaine. 
            //exemple: on cherche la séquence 123 dans la chaine 241312345 on obtiendra la chaine 12345 dans le tableau.
			}
			else{
				
			}
			
        }
        for($j=0;$j<count($arrayValeurs);$j++){
			if(strlen(substr($arrayValeurs[$j],strlen($sequence)+1))>1){
				$arrayValeur[] = substr($arrayValeurs[$j],strlen($sequence)+1,-(strlen(substr($arrayValeurs[$j],strlen($sequence)+1))-1));   //strlen(string) renvoie la longueur de string.
				// substr renvoie les n premier caractère de $value en commençant par le caractère n°"strlen(string)" (dans "abcd" le n°0="a")
				// donc on va aller chercher le caractère juste après la séquence
				// les n premiers caractères sont déterminer par "1" (on ne veut que le coup jouer après la séquence).
			}
			else{
				$arrayValeur[] = substr($arrayValeurs[$j],strlen($sequence)+1);
			}
        }
		
        return $arrayValeur; // renvoie le nombre d'occurence du caractère q
    } 
	
	
    public static function occurence(array $arrayValeur){
        $a = $b = $c = $d = $e = 0;
		$f="1";
		$g="2";
		$h="3";
		$i="4";
		$j="5";
        for($i=0;$i>count($arrayValeur);$i++){
            if (strcasecmp($arrayValeur[$i],$f)==0){
                $a++;
            } elseif (strcasecmp($arrayValeur[$i],$g)==0) {
                $b++;
            } elseif (strcasecmp($arrayValeur[$i],$f)==0) {
                $c++;
            } elseif (strcasecmp($arrayValeur[$i],$h)==0) {
                $d++;
            } elseif (strcasecmp($arrayValeur[$i],$j)==0) {
                $e++;
            }
			
			
        }
		
		
		$arrayValeur=array(1 => $a,$b,$c,$d,$e);
						
		return $arrayValeur;//array_search(max($arrayValeur),$arrayValeur);
		
		/*
		$rand= rand(0,1);
		
        if ($a>$b && $a>$c && $a>$d && $a>$e){
            return ($a);
        } elseif ($b>$c && $b>$d && $b>$e){
            return($b);
        } elseif ($c>$d && $c>$e){
            return($c);
        } elseif ($d>$e){
            return($d);
        } else{
            return($e);
        }
		
		if ($a==$b){
			if(rand==0){
				return $a;
			}else{
				return $b;
			}
		}
		elseif ($a==$c){
			if(rand==0){
				return $a;
			}else{
				return $c;
			}
		}
		elseif ($a==$d){
			if(rand==0){
				return $a;
			}else{
				return $d;
			}
		}
		elseif ($a==$e){
			if(rand==0){
				return $a;
			}else{
				return $e;
			}
		}
		elseif ($b==$c){
			if(rand==0){
				return $c;
			}else{
				return $b;
			}
		}
		elseif ($b==$d){
			if(rand==0){
				return $d;
			}else{
				return $b;
			}
		}
		elseif ($b==$e){
			if(rand==0){
				return $e;
			}else{
				return $b;
			}
		}
		elseif ($c==$d){
			if(rand==0){
				return $d;
			}else{
				return $c;
			}
		}
		elseif ($c==$e){
			if(rand==0){
				return $e;
			}else{
				return $c;
			}
		}
		elseif ($d==$e){
			if(rand==0){
				return $e;
			}else{
				return $d;
			}
		}
		else{
			return $e;
		}
		*/
        
    }

}

?>
