<?php 
require_once "connexion_model.php";

class place_model extends connexion_class
{
    private $idvoit;
    private $place;
    private $occupation;

    private $places;

    //init constructeur
    public function __construct($idvoit,$place,$occupation)
    {
        $this->idvoit = $idvoit;
        $this->place = $place;
        $this->occupation = $occupation;
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

 public function setplaces($places)
 {
     $this->places[] = $places;
 }
 public function getplaces()
 {
     return $this->places;
 }


 public function chargementplace()
    {
        $query = $this->getconnexionbd()->prepare("SELECT * FROM place");
        $query->execute();
        $placeDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        //inscription des donnees dans la  base dans le tableau d'affichage
        foreach($placeDatas as $places)
        {
            $placeListe = new place_model($places['idvoit'],$places['place'],$places['occupation']);
            $this->setplaces($placeListe);
        }
    }

    public function getplaceById($places)
    {
        for($i=0; $i < count($this->places); $i++)
        {
            if($this->places[$i]->getidvoit() === $places)
            {
                return $this->places[$i];
            }
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
        /*if($resultat > 0)
        {
            $place = $this->getplaceById($idvoit);
            unset($place);
        }*/
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
            $this->getplaceById($idvoit)->setplace($place);
            $this->getplaceById($idvoit)->setoccupation($occupation);
        }
    }
/////////////////////////////////////////////////////////////pour la place
                    //////////ajout a travers l'ajout de voiture
    public function ajoutplaceBd($idvoit,$i)
    {
        $queryStr = "INSERT INTO place (idvoit, place, occupation) VALUES(:idvoit, :place, 'non')";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$i,PDO::PARAM_INT);
        //$query->bindValue(":occupation",$occupation,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $place = new place_model($this->getconnexionbd()->lastInsertId(),$idvoit,$place,$occupation);
            $this->setplaces($places);
        }        
    }
                
    /*public function ajoutplaceBd($idvoit,$place)
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
            $this->setplaces($places);
        }        
    }*/

    public function modificationajoutoccupationBD($idvoit,$place)
    {
        $queryStr = "UPDATE place WHERE idvoit = :idvoit AND place = :place SET occupation = 'oui'";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $resultat = $query->execute();
        $query->closeCursor();
             
        //actualisation interface
        if($resultat > 0)
        {
            $this->getplaceById($idvoit)->setplace($place);
            $this->getplaceById($idvoit)->setoccupation($occupation);//a corriger kely ilay $occupation tsy anaty parametre
        }
    }   


    public function modificationsupproccupationBD($idvoit,$place)
    {
        $queryStr = "UPDATE place WHERE idvoit = :idvoit and place = :place SET occupation = 'non'";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $resultat = $query->execute();
        $query->closeCursor();
             
        //actualisation interface
        if($resultat > 0)
        {
            $this->getplaceById($idvoit)->setplace($place);
            $this->getplaceById($idvoit)->setoccupation($occupation);//a corriger kely ilay $occupation tsy anaty parametre
        }
    }   
}
?>