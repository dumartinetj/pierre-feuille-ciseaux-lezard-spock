<?php

class Joueur {

    private $identifiant;
    private $pseudo;
    private $sexe; // doit être seulement Homme ou Femme
	private $age; // compris entre 0 et 100 ?
	private $nbVictoire;
	private $nbDefaite;
	private $password;
	private $email;
	
    public function __construct($i, $p, $s, $a, $em, $pw) {
        $this->identifiant = $i;
        $this->pseudo = $p;
        $this->sexe = $s;
		$this->age = $a;
		$this->nbVictoire = 0;
		$this->nbDefaite = 0;		
		$this->password = $pw;		
		$this->email = $em;		
    }
	
	public function getIdentifiant() {
		return $this->identifiant;
	}
	
	public function getPseudo() {
		return $this->pseudo;
	}
	
	public function getSexe() {
		return $this->sexe;
	}
	
	public function getAge() {
		return $this->age;
	}
	
	public function getNbVictoire() {
		return $this->nbVictoire;
	}
	
	public function getNbDefaite() {
		return $this ->nbDefaite;
	}	
	
	public function getEmail() {
		return $this ->nbDefaite;
	}
}

?>