<?php
require_once "configs/database.php";
abstract class connexion_class{
    public static $pdo;

    private static function setconnexionbd(){

        try{
            self::$pdo = new PDO("mysql:host=".bdd_HOST.";dbname=".bdd_NAME.";charset=utf8",bdd_USER,bdd_PSWD);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            echo 'connexion réussie';
        }
        catch(PDOException $e){
            echo "Erreur de connexion : " . $e->getMessage();
        }  
              
    }

    protected function getconnexionbd(){
        if(self::$pdo === null){
            self::setconnexionbd();
        }
        return self::$pdo;
    }
}