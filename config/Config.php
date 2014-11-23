<?php

class Config {

    private static $database = array(
        'hostname' => 'localhost',
        'database' => 'pfcls',
        'login'    => 'root',
        'password' => ''
    );

    private static $debug = true;
	private static $seed = "Un Anneau pour les amener tous et dans les ténèbres les lier";
	
    static public function getLogin() {
        return self::$database['login'];
    }

    static public function getHostname() {
        return self::$database['hostname'];
    }

    static public function getDatabase() {
        return self::$database['database'];
    }

    static public function getPassword() {
        return self::$database['password'];
    }

    static public function getDebug() {
        return self::$debug;
    }
	
	static public function getSeed() {
        return self::$seed;
    
    }

}

?>
