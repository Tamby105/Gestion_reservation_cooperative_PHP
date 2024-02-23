<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservation cooperative</title>
</head>
<body>
    <h1>fandehany</h1>
</body>
</html>-->
<?php
   /* require_once "models/connexion_model.php";
    connexion_class test = new Connexion_class();
    test.getconnexionbd(); */
    //echo "djutdjycjytdutfiytdu6rd"
    //require_once "../configs/database.php";
    //public class connexion{

    

    //private static $pdo;

   /* try{
        $shit= new PDO("mysql:host=".bdd_HOST.";dbname=".bdd_NAME.";charset=utf8",bdd_USER,bdd_PSWD);
        $shit->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "connexion réussie";       
    }*/
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
require_once "controllers/client_controller.php";
require_once "controllers/voiture_controller.php";
//require_once "controllers/place_controller.php";
require_once "controllers/reserver_controller.php";
$clients = new client_controller();
$voitures = new voiture_controller();
//$places = new place_controller();
$reserver = new reserver_controller();

try{
    if(empty($_GET['page']))
    {
        require "views/accueil_view.php";
    } 
    else{
        $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);
    
        if($url[0]=="accueil")
        {
            require "views/accueil_view.php";
        }
        elseif($url[0]=="client")
        {
            if(empty($url[1]))
            {
                $clients->controller_vue_client();
            } 
            else if($url[1] === "interfaceajout") 
            {
                $clients->controller_page_ajoutclient();
            }
            else if($url[1] === "ajouterbdd") 
            {
                $clients->controller_ajoutclient();
            }
            else if($url[1] === "interfacemodif") 
            {
                $clients->controller_page_modification_client($url[2]);
            } 
            else if($url[1] === "modifBdd") 
            {
                $clients->controller_modification_client();
            }
            else if($url[1] === "suppr") 
            {
                $clients->controller_suppression_client($url[2]);
            } 
            /*else if($url[1] === "cprmo") 
            {
                $voitures->controller_page_retour_modificationlivre();
            }*/
            else
            {
                throw new Exception("La page n'existe pas");
            }
        }
        elseif($url[0]=="voiture")
        {
            if(empty($url[1]))
            {
                $voitures->controller_vue_voiture();
            } 
            else if($url[1] === "interfaceajout") 
            {
                $voitures->controller_page_ajoutvoiture();
            }
            else if($url[1] === "ajouterbdd") 
            {
                $voitures->controller_ajoutvoiture();
            }
            else if($url[1] === "interfacemodif") 
            {
                $voitures->controller_page_modification_voitures($url[2]);
            } 
            else if($url[1] === "modifBdd") 
            {
                $voitures->controller_modification_voiture();
            }
            else if($url[1] === "suppr") 
            {
                $voitures->controller_suppression_voiture($url[2]);
            } 
            /*else if($url[1] === "cprmo") 
            {
                $clients->controller_page_retour_modificationlivre();
            }*/
            else
            {
                throw new Exception("La page n'existe pas");
            }
        }
    }        
}
catch(Exception $e)
{
    echo $e->getMessage();
}
/*gfjytdfhhhhhhhhhhhhhhhhhhhhhhhhdddddddddddddddddddddddddfffffffffffffffff*/
?>
