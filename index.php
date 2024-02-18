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
$clients = new client_controller();

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
           //pour le detail

            /*else if($url[1] === "caf") 
            {
                $client_controller->controller_afficherlivre($url[2]);
            } */
            else if($url[1] === "interfaceajout") 
            {
                $clients->controller_page_ajoutclient();
            } 
            /*else if($url[1] === "cpmo") 
            {
                $client_controller->controller_page_modificationlivre($url[2]);
            } 
            else if($url[1] === "csu") 
            {
                $client_controller->controller_suppressionlivre($url[2]);
            } 
            else if($url[1] === "caj") 
            {
                $client_controller->controller_ajoutlivre();
            } 
            else if($url[1] === "cmo") 
            {
                $client_controller->controller_modificationlivre();
            }
            else if($url[1] === "cprmo") 
            {
                $client_controller->controller_page_retour_modificationlivre();
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
?>
