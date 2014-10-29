<?php

/*
 * Classe Figure
 */

require_once 'Modele.php';

class Figure extends Modele {

	protected $identifiant;
	/* Liste des forces de la figure */
	protected $forces;
	/* Liste des faiblesses de la figure */
	protected $faiblesses;

	/*
	 * Constructeur de la classe qui instancie une nouvelle Figure
	 */

    public function __construct($id) {
		$this->identifiant = $id;
		try {
            $req = self::$pdo->prepare("SELECT * FROM pfcls_Figures WHERE idFigure=".$id);
            $req->execute();
            if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                $this->forces = explode(",",$data_recup->forces);
								$this->faiblesses = explode(",",$data_recup->faiblesses);
						}
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de l'instanciation d'une figure");
        }

	}

	/*
	 * Getter de l'identifiant de la figure
	 * @return l'identifiant de la figure
	 */
	public function getIdentifiant() {
		return $this->identifiant;
	}

	/*
	 * Retourne le nom de la figure à partir de son id
	 * @return le nom de la figure
	 */
	public function getNom() {
		try {
            $req = self::$pdo->prepare("SELECT nom FROM pfcls_Figures WHERE idFigure=".$this->identifiant);
            $req->execute();
            if ($req->rowCount() != 0) {
                $data_recup = $req->fetch(PDO::FETCH_OBJ);
                 return $data_recup->nom;
						}
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur lors de la r?cup?ration du nom d'une figure");
        }

	/*
	 * Getter des forces de la figure
	 * @return la liste des forces de la figure
	 */
	public function getForces(){
        return $this->forces;
    }

	/*
	 * Getter des faiblesses de la figure
	 * @return la liste des faiblesses de la figure
	 */
    public function getFaiblesses(){
        return $this->faiblesses;
    }

	/*
	 * Vérifie si la figure passé en paramètre est dans les forces de la figure
	 * @param l'id de la figure à comparer
	 * @return un booléen, vrai si elle est dans ses forces, faux sinon
	 */
	public function estDansSesForces($idfigure) {
		return in_array($idfigure, $this->forces);
	}

	/*
	 * Vérifie si la figure passé en paramètre est dans les forces de la figure
	 * @param l'id de la figure à comparer
	 * @return un booléen, vrai si elle est dans ses faiblesses, faux sinon
	 */
	public function estDansSesFaiblesses($idfigure) {
		return in_array($idfigure, $this->faiblesses);
	}

}

?>
