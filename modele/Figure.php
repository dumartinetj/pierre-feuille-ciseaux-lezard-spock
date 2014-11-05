<?php

/*
 * Classe Figure
 */

require_once 'Modele.php';

class Figure extends Modele {

    public static function getNom($id) {
			try {
							$req = self::$pdo->prepare("SELECT nom FROM pfcls_Figures WHERE idFigure=".$id);
							$req->execute();
							if ($req->rowCount() != 0) {
									$data_recup = $req->fetch(PDO::FETCH_OBJ);
									return $data_recup->nom;
							}
					} catch (PDOException $e) {
							echo $e->getMessage();
							die("Erreur lors de la récupération du nom de la figure dans la BDD");
					}
		}

		public static function getForces($id){ // retourne un array
				try {
							$req = self::$pdo->prepare("SELECT forces FROM pfcls_Figures WHERE idFigure=".$id);
							$req->execute();
							if ($req->rowCount() != 0) {
									$data_recup = $req->fetch(PDO::FETCH_OBJ);
									$forces = explode(",",$data_recup->forces);
									return $forces;
							}
				} catch (PDOException $e) {
							echo $e->getMessage();
							die("Erreur lors de la récupération des forces de la figure dans la BDD");
					}
			}

			public static function getFaiblesses($id){ //retourne un array
					try {
								$req = self::$pdo->prepare("SELECT faiblesses FROM pfcls_Figures WHERE idFigure=".$id);
								$req->execute();
								if ($req->rowCount() != 0) {
										$data_recup = $req->fetch(PDO::FETCH_OBJ);
										$faiblesses = explode(",",$data_recup->faiblesses);
										return $faiblesses;
								}
					} catch (PDOException $e) {
								echo $e->getMessage();
								die("Erreur lors de la récupération des faiblesses de la figure dans la BDD");
						}
			}

	/*
	 * Vérifie si la figure passé en premier paramètre est dans les forces de la figure en deuxième param
	 * @return un booléen, vrai si elle est dans ses forces, faux sinon
	 */
			public static function estDansSesForces($idFigure1, $idFigure2) {
					$forcesFigure2 = self::getForces($idFigure2);
					return in_array($idFigure1, $forcesFigure2);
			}

	/*
	 * Vérifie si la figure passé en premier paramètre est dans les faiblesses de la figure en deuxième param
	 * @return un booléen, vrai si elle est dans ses faiblesses, faux sinon
	 */
			public static function estDansSesFaiblesses($idFigure1, $idFigure2) {
					$faiblessesFigure2 = self::getFaiblesses($idFigure2);
					return in_array($idFigure1, $faiblessesFigure2);
			}

}

?>
