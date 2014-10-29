<?php

class modeleJoueur extends Modele{
    //protected static $table='joueur'; Plus tard si adaptation dans un seul modele
    //protected static $clefprimaire='idJoueur'; Pareil
    
    public static function insert($data) {
        try {
            $req = self::$pdo->prepare('INSERT INTO joueur (idJoueur, pseudo, sexe, age, nbV, nbD, passw, email) VALUES (:idJoueur, :pseudo, :sexe, :age, :nbV, :nbD, :passw :email)');
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die('Erreur lors de l\'insertion dans la BDD joueur');
        }
    }
}
