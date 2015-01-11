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

	public static function figureAJouer($figure){
		$dataFaiblesses = array('idFigure'=>$figure);
		$faiblesses=Figure::select($dataFaiblesses)->faiblesses;
		$valeurs = explode(",",$faiblesses);
		$faiblesserandom = array_rand($valeurs);
		$choixFigure = $valeurs[$faiblesserandom];
		return $choixFigure;
	}

	public static function coupSuiv(array $array, $sequence){
		// on va y mettre les séquences qui ont une valeur après la séquence que l'ont recherche
		for($i=0;$i<count($array);$i++){
			if(strstr($array[$i], $sequence ,  $before_sequence = false)!=false){
				$arrayValeurs[] = strstr($array[$i], $sequence ,  $before_sequence = false);
			}
			else{

			}
		}
		// maintenant on récupère uniquement le coup jouer après les séquences stocker dans $arrayValeurs
		for($j=0;$j<count($arrayValeurs);$j++){
			if(strlen(substr($arrayValeurs[$j],strlen($sequence)+1))>1){
				$arrayValeur[] = substr($arrayValeurs[$j],strlen($sequence)+1,-(strlen(substr($arrayValeurs[$j],strlen($sequence)+1))-1));
			}
			else{
				$arrayValeur[] = substr($arrayValeurs[$j],strlen($sequence)+1);
			}

		}
		return JeuIA::figureAJouer(JeuIA::occurence($arrayValeur)); // renvoie le nombre d'occurence du caractère q
	}

	public static function recupSequence($idJoueur,$sequence){
		$data = array(
			"listeCoups" => "%".$sequence."%",
			"idJoueur" => $idJoueur
		);
		$donnees = array();
		try{
			$req = self::$pdo->prepare('SELECT listeCoups FROM pfcls_statistiquespersonnelles WHERE idJoueur = :idJoueur AND listeCoups LIKE :listeCoups');
			$req->execute($data);
			while ($ligne = $req->fetch()) {
				array_push($donnees, $ligne['listeCoups']);
			}
			return $donnees;
		} catch (PDOException $e) {
       echo $e->getMessage();
       $messageErreur="Erreur lors de la récupération de la séquence 1";
      }
            //$resultat = $pdo->query($requete);
            //$check=$resultat->fetch(PDO::FETCH_NUM);
    }

}

?>
