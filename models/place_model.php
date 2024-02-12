<?php 
require_once "connexion_model.php";

class place_model extends place_model
{
    private $idvoit;
    private $place;
    private $occupation;

    private $place;

    //init constructeur
    public function __construct($idvoit,$place,$occupation)
    {
        $this->idvoit = $idvoit;
        $this->$place = $place;
        $this->$occupation = $occupation;
    }
 
    /*********************** Init_Accesseur ************************/
 public function getidvoit()
 {
     return $this->idvoit;
 }
 public function setidvoit($idvoit)
 {
     $this->idvoit = $idvoit;
 }

 public function getplace()
 {
     return $this->place;
 }
 public function setplace($place)
 {
     $this->place = $place;
 }

 public function getoccupation()
 {
     return $this->occupation;
 }
 public function setoccupation($occupation)
 {
     $this->occupation = $occupation;
 }

 public function setplace($place)
 {
     $this->place[] = $place;
 }
 public function getplace()
 {
     return $this->place;
 }


 public function chargementplace()
    {
        $query = $this->getconnexionbd()->prepare("SELECT * FROM `place`");
        $query->execute();
        $placeDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        //inscription des donnees dans la  base dans le tableau d'affichage
        foreach($placeDatas as $place)
        {
            $placeListe = new place_model($place['idvoit'],$place['place'],$place['occupation']);
            $this->setplace($placeListe);
        }
    }

    public function getplaceById($place)
    {
        for($i=0; $i < count($this->place);$i++)
        {
            if($this->place[$i]->getidvoit() === $place)
            {
                return $this->place[$i];
            }
        }
    }

    public function ajoutplaceBd($idvoit,$place,$occupation)
    {
        $queryStr = "INSERT INTO place (idvoit, place, occupation) VALUES(:idvoit, :place, :occupation)";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $query->bindValue(":occupation",$occupation,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $place = new place_model($this->getconnexionbd()->lastInsertId(),$idvoit,$place,$occupation);
            $this->setplace($place);
        }        
    }

    public function suppressionplace($idvoit)
    {
        $queryStr = "DELETE FROM place WHERE idvoit = :idvoit";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $place = $this->getplaceById($idvoit);
            unset($place);
        }
    }

    public function modificationplaceBD($idvoit,$nom,$occupation)
    {
        $queryStr = "UPDATE place SET idvoit = :idvoit, place = :place WHERE occupation = :occupation";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $query->bindValue(":occupation",$occupation,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $this->getplaceById($idvoit)->setidvoit($idvoit);
            $this->getplaceById($idvoit)->setoccupation($occupation);
        }
    }
}
?>