<?php

require_once 'Modele.php';
require_once 'Partie.php';
require_once MODEL_PATH.'Joueur.php';

class JeuIA extends Modele{

	protected static $table = "pfcls_StatistiquesPersonnelles";
	protected static $primary_index = "idStatsPerso";

	public static function premierCoup($idJoueur){
		$dataDejaJoue = array('idJoueur'=>$idJoueur);
		$dejaJoue=StatsPerso::selectWhere($dataDejaJoue);
		if($dejaJoue!=NULL){
			$listeCoupsJoueur="";
			foreach ($dejaJoue as $key => $value) {
				$listeCoupsJoueur .= str_replace(',', '', $value->listeCoups);
			}
			$figureCount = array(
				'1'=>substr_count($listeCoupsJoueur,'1',0,strlen($listeCoupsJoueur)),
				'2'=>substr_count($listeCoupsJoueur,'2',0,strlen($listeCoupsJoueur)),
				'3'=>substr_count($listeCoupsJoueur,'3',0,strlen($listeCoupsJoueur)),
				'4'=>substr_count($listeCoupsJoueur,'4',0,strlen($listeCoupsJoueur)),
				'5'=>substr_count($listeCoupsJoueur,'5',0,strlen($listeCoupsJoueur))
			);
			$nbOccumax=$figuremax=0;
			foreach($figureCount as $figure => $nbOccu){
				if($nbOccu>$nbOccumax){
					$nbOccumax=$nbOccu;
					$figuremax=$figure;
				}
			}
			$dataFaiblesses = array('idFigure'=>$figuremax);
			$faiblesses=Figure::select($dataFaiblesses)->faiblesses;
			$valeurs = explode(",",$faiblesses);
			$faiblesserandom = array_rand($valeurs);
			$choixFigure = $valeurs[$faiblesserandom];
		}
		else{
			$choixFigure = mt_rand(1,5);
		}
		return $choixFigure;
	}

	public static function reducSeq($sequence){
		return substr($sequence,2);
	}

	public static function occurence($arrayValeur){
		$a = $b = $c = $d = $e = 0;
		for($i=0;$i<count($arrayValeur);$i++){
			if ((strcasecmp($arrayValeur[$i],"1"))==0){
				$a=$a+1;
			} elseif ((strcasecmp($arrayValeur[$i],"2"))==0) {
				$b=$b+1;
			} elseif ((strcasecmp($arrayValeur[$i],"3"))==0) {
				$c=$c+1;
			} elseif ((strcasecmp($arrayValeur[$i],"4"))==0) {
				$d=$d+1;
			} elseif ((strcasecmp($arrayValeur[$i],"5"))==0) {
				$e=$e+1;
			}
		}
		$arrayValeur=array(1 => $a,$b,$c,$d,$e);
		return array_search(max($arrayValeur),$arrayValeur);
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
				$arrayValeur = array();
				$arrayValeur[] = substr($arrayValeurs[$j],strlen($sequence)+1,-(strlen(substr($arrayValeurs[$j],strlen($sequence)+1))-1));   //strlen(string) renvoie la longueur de string.
				// substr renvoie les n premier caractère de $value en commençant par le caractère n°"strlen(string)" (dans "abcd" le n°0="a")
				// donc on va aller chercher le caractère juste après la séquence
				// les n premiers caractères sont déterminer par "1" (on ne veut que le coup jouer après la séquence).
			}
			else{
				$arrayValeur[] = substr($arrayValeurs[$j],strlen($sequence)+1);
			}
		}
		return JeuIA::occurence($arrayValeur); // renvoie le nombre d'occurence du caractère q
	}

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

}

?>
