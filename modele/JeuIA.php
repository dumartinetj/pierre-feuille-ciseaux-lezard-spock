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

	public static function IA($idJoueur,$sequence,$age,$sexe){

		$sequenceClone=$sequence;
		$listeSequences = JeuIA::recupSequence($idJoueur,$sequence);
		$boolean=false;
		if($sexe=="M")  $sexeOpposer="F";
		else{ $sexeOpposer="M";}

		while($boolean==false){
			if($listeSequences!=null){
				$coupSuiv=JeuIA::coupSuiv($listeSequences,$sequenceClone);
				$boolean=true;
			}
			// si y'a pas de séquences trouvées
			else {
				//on réduit si on peut
				if(strlen($sequenceClone)>3){
					$sequenceCloner=JeuIA::reducSeq($sequenceClone);
					// mieux !
				}
				//sinon on sort
				else{
					$boolean=true;
				}
			}
		}

		//ici il faut pas check si $coupSuiv existe ?
		// si oui on fait return $coupSuiv;
		//sinon on continue à chercher

		if($coupSuiv!=0) return $coupSuiv; //one line bitch, yes i know biatch
		else{
			$sequenceClone=$sequence;

			$listeSequenceAutre=JeuIA::recupSequenceAll($sexe,$age-2,$age+2,$sequence);
			$boolean=false;
			while($boolean==false){
				if($listeSequenceAutre!=null){
					$coupSuiv=JeuIA::coupSuiv($listeSequenceAutre,$sequenceClone);
					$boolean=true;
				}
				else {
					//on réduit si on peut
					if(strlen($sequenceClone)>3){
						$sequenceClone=JeuIA::reducSeq($sequenceClone);
						// mieux !
					}
					//sinon on sort
					else{
						$boolean=true;
					}
				}
			}


		}
		if($coupSuiv!=0) return $coupSuiv;
		else{
			$sequenceClone=$sequence;

			$listeSequenceAutre=JeuIA::recupSequenceAll($sexeOpposer,$age-2,$age+2,$sequence);
			$boolean=false;
			while($boolean==false){
				if($listeSequenceAutre!=null){
					$coupSuiv=JeuIA::coupSuiv($listeSequenceAutre,$sequenceClone);
					$boolean=true;
				}
				else {
					//on réduit si on peut
					if(strlen($sequenceClone)>3){
						$sequenceClone=JeuIA::reducSeq($sequenceClone);
						// mieux !
					}
					//sinon on sort
					else{
						$boolean=true;
					}
				}
			}
		}
		if($coupSuiv!=0) return $coupSuiv;
		else{
			$sequenceClone=$sequence;

			$listeSequenceAutre=JeuIA::recupSequenceAll($sexe,$age-5,$age+5,$sequence);
			$boolean=false;
			while($boolean==false){
				if($listeSequenceAutre!=null){
					$coupSuiv=JeuIA::coupSuiv($listeSequenceAutre,$sequenceClone);
					$boolean=true;
				}
				else {
					//on réduit si on peut
					if(strlen($sequenceClone)>3){
						$sequenceClone=JeuIA::reducSeq($sequenceClone);
						// mieux !
					}
					//sinon on sort
					else{
						$boolean=true;
					}
				}
			}
		}
		if($coupSuiv!=0) return $coupSuiv;
		else{
			$sequenceClone=$sequence;

			$listeSequenceAutre=JeuIA::recupSequenceAll($sexeOpposer,$age-5,$age+5,$sequence);
			$boolean=false;
			while($boolean==false){
				if($listeSequenceAutre!=null){
					$coupSuiv=JeuIA::coupSuiv($listeSequenceAutre,$sequenceClone);
					$boolean=true;
				}
				else {
					//on réduit si on peut
					if(strlen($sequenceClone)>3){
						$sequenceClone=JeuIA::reducSeq($sequenceClone);
						// mieux !
					}
					//sinon on sort
					else{
						$boolean=true;
					}
				}
			}
		}
		if($coupSuiv!=0) return $coupSuiv;
		else{ return mt_rand(1,5);}

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

	public static function coupSuiv($array, $sequence){

		// maintenant on récupère uniquement le coup jouer après les séquences stocker dans $arrayValeurs
		for($j=0;$j<count($array);$j++){
			if(strlen($array[$j])<=strlen($sequence));
			else{
				if(strlen(substr($array[$j],strlen($sequence)+1))>1){
					$arrayValeur[] = substr($array[$j],strlen($sequence)+1,-(strlen(substr($array[$j],strlen($sequence)+1))-1));
				}
				else{
					$arrayValeur[] = substr($array[$j],strlen($sequence)+1);
				}
			}
		}
		if ($arrayValeur==NULL) return 0;
		else return JeuIA::figureAJouer(JeuIA::occurence($arrayValeur)); // renvoie le nombre d'occurence du caractère q
	}

	public static function recupSequence($idJoueur,$sequence){
		$data = array(
			"listeCoups" => "%".$sequence."%",
			"idJoueur" => $idJoueur
		);
		$donnees = array();
		try{
			$req = self::$pdo->prepare('SELECT listeCoups FROM pfcls_StatistiquesPersonnelles WHERE idJoueur = :idJoueur AND listeCoups LIKE :listeCoups');
			$req->execute($data);
			while ($ligne = $req->fetch()) {
				array_push($donnees, $ligne['listeCoups']);
			}
			return $donnees;
		} catch (PDOException $e) {
       echo $e->getMessage();
       $messageErreur="Erreur lors de la récupération de la séquence 1";
      }
  }

	public static function recupSequenceAll($sexe,$agemini,$agemaxi,$sequence){
		$data = array(
			"listeCoups" => "%".$sequence."%",
		);
		$donnees = array();
		try{
			$sql = "SELECT listeCoups FROM pfcls_StatistiquesPersonnelles sp ";
			$sql .= "INNER JOIN pfcls_Joueurs jo ON sp.idJoueur = jo.idJoueur ";
			$sql .= "AND jo.sexe = '".$sexe."' ";
			$sql .= "AND jo.age >= ".$agemini." ";
			$sql .= "AND jo.age <= ".$agemaxi." ";
			$sql .= "AND sp.listeCoups LIKE :listeCoups";
			$req = self::$pdo->prepare($sql);
			$req->execute($data);
			while ($ligne = $req->fetch()) {
				array_push($donnees, $ligne['listeCoups']);
			}
			return $donnees;
		} catch (PDOException $e) {
			echo $e->getMessage();
			$messageErreur="Erreur lors de la récupération de la séquence 2";
		}
	}

}

?>
