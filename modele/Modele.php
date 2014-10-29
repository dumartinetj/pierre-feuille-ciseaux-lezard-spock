<?php

require_once ROOT . DS . 'config' . DS . 'Config.php';
class Modele {

    public static $pdo;

    public static function set_static() {
        $host = Config::getHostname();
        $dbname = Config::getDatabase();
        $login = Config::getLogin();
        $pass = Config::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            if (Config::getDebug()) {
                echo $ex->getMessage();
                die ("Problème lors de la connexion à la base de données");
            } else {
                echo "Une erreur est survenue.";
            }
            die();
        }
    }
}
Modele::set_static();

?>
