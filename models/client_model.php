<?php 
require_once "connexion_model.php";

class client_model extends connexion_class
{
    private $idcli;
    private $nom;
    private $numtel;

    private $client;

    //init constructeur
    public function __construct($idcli,$nom,$numtel)
    {
        $this->idcli = $idcli;
        $this->nom = $nom;
        $this->numtel = $numtel;
    }

    /*********************** Init_Accesseur ************************/
    public function getIdcli()
    {
        return $this->idcli;
    }
    public function setIdcli($idcli)
    {
        $this->idcli = $idcli;
    }
    public function getnom()
    {
        return $this->nom;
    }
    public function setnom($nom)
    {
        $this->nom = $nom;
    }
    public function getnumtel()
    {
        return $this->numtel;
    }
    public function setnumtel($numtel)
    {
        $this->numtel = $numtel;
    }

    public function setclient($client)
    {
        $this->client[] = $client;
    }
    public function getclient()
    {
        return $this->client;
    }

    public function chargementclient()
    {
        $query = $this->getconnexionbd()->prepare("SELECT * FROM client");
        $query->execute();
        $clientDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        //inscription des donnees dans la  base dans le tableau d'affichage
        foreach($clientDatas as $client)
        {
            $clientListe = new client_model($client['idcli'],$client['nom'],$client['numtel']);
            $this->setclient($clientListe);
        }
    }

    public function getclientById($idcli)
    {
        for($i=0; $i < count($this->client);$i++)
        {
            if($this->client[$i]->getIdcli() === $idcli)
            {
                return $this->client[$i];
            }
        }
    }

    public function ajoutclientBd($idcli,$nom,$numtel)
    {
        $queryStr = "INSERT INTO client (idcli, nom, numtel) VALUES(:idcli, :nom, :numtel)";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
        $query->bindValue(":nom",$nom,PDO::PARAM_STR);
        $query->bindValue(":numtel",$numtel,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $client = new client_model($this->getconnexionbd()->lastInsertId(),$idcli,$nom,$numtel);
            $this->setclient($client);
        }     
        /*else{
            return confirm('la voiture existe deja');
        }   */
    }

    public function suppressionclient($idcli)
    {
        $queryStr = "DELETE FROM client WHERE idcli = :idcli";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $client = $this->getclientById($idcli);
            unset($client);
        }
    }

    public function modificationclientBD($idcli,$nom,$numtel,$idcli_obsolete)
    {
        $queryStr = "UPDATE client SET idcli = :idcli, nom = :nom, numtel = :numtel WHERE idcli = :idcli_obsolete" ;
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
        $query->bindValue(":nom",$nom,PDO::PARAM_STR);
        $query->bindValue(":numtel",$numtel,PDO::PARAM_STR);
        $query->bindValue(":idcli_obsolete",$idcli_obsolete,PDO::PARAM_STR);

        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $this->getclientById($idcli_obsolete)->setIdcli($idcli);
            $this->getclientById($idcli_obsolete)->setnom($nom);
            $this->getclientById($idcli_obsolete)->setnumtel($numtel);
        }
    }
}
?>