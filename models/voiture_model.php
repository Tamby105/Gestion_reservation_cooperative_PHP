<?php 
require_once "connexion_model.php";

class voiture_model extends voiture_model
{
    private $idvoit;
    private $design;
    private $types;
    private $nbrplace;
    private $frais;

    private $voiture;

    //init constructeur
    public function __construct($idvoit,$design,$types,$nbrplace,$frais)
    {
        $this->idvoit = $idvoit;
        $this->$design = $design;
        $this->$types = $types;
        $this->$nbrplace = $nbrplace;
        $this->$frais = $frais;
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
  
   public function getdesign()
   {
       return $this->design;
   }
   public function setdesign($design)
   {
       $this->design = $design;
   }
  
   public function gettypes()
   {
       return $this->types;
   }
   public function settypes($types)
   {
       $this->types = $types;
   }
  
   public function getnbrplace()
   {
       return $this->nbrplace;
   }
   public function setnbrplace($nbrplace)
   {
       $this->nbrplace = $nbrplace;
   }

   public function getfrais()
   {
       return $this->frais;
   }
   public function setfrais($frais)
   {
       $this->frais = $frais;
   }

   public function setvoiture($voiture)
   {
       $this->voiture[] = $voiture;
   }
   public function getvoiture()
   {
       return $this->voiture;
   }

   public function chargementvoiture()
   {
       $query = $this->getconnexionbd()->prepare("SELECT * FROM `voiture`");
       $query->execute();
       $voitureDatas = $query->fetchAll(PDO::FETCH_ASSOC);
       $query->closeCursor();
       //inscription des donnees dans la  base dans le tableau d'affichage
       foreach($voitureDatas as $voiture)
       {
           $voitureListe = new voiture_model($voiture['idvoit'],$voiture['design'],$voiture['types'],$voiture['nbrplace'],$voiture['frais']);
           $this->setplace($voitureListe);
       }
   }

   public function getvoitureById($voiture)
   {
       for($i=0; $i < count($this->voiture);$i++)
       {
           if($this->voiture[$i]->getidvoit() === $voiture)
           {
               return $this->voiture[$i];
           }
       }
   }

   public function ajoutvoitureBd($idvoit,$design,$type,$nbrplace,$occupation)
   {
       $queryStr = "INSERT INTO voiture (idvoit, design, types, nbrplace, frais) VALUES(:idvoit, :design, :types, :nbrplace, :frais)";
       $query = $this->getconnexionbd()->prepare($queryStr);
       $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
       $query->bindValue(":design",$design,PDO::PARAM_STR);
       $query->bindValue(":types",$types,PDO::PARAM_STR);
       $query->bindValue(":nbrplace",$nbrplace,PDO::PARAM_INT);
       $query->bindValue(":frais",$frais,PDO::PARAM_INT);
       $resultat = $query->execute();
       $query->closeCursor();
        //actualisation interface
       if($resultat > 0)
       {
           $voiture = new voiture_model($this->getconnexionbd()->lastInsertId(),$idvoit,$design,$types,$nbrplace,$frais);
           $this->setvoiture($voiture);
       }        
   }

   public function suppressionvoiture($idvoit)
   {
       $queryStr = "DELETE FROM voiture WHERE idvoit = :idvoit";
       $query = $this->getconnexionbd()->prepare($queryStr);
       $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
       $resultat = $query->execute();
       $query->closeCursor();
        //actualisation interface
       if($resultat > 0)
       {
           $voiture = $this->getvoitureById($idvoit);
           unset($voiture);
       }
   }

   public function modificationvoitureBD($idvoit,$design,$types,$nbrplace,$frais)
   {
       $queryStr = "UPDATE voiture SET design = :design, types = :types, nbrplace = :nbrplace, frais = :frais WHERE idvoit = :idvoit";
       $query = $this->getconnexionbd()->prepare($queryStr);
       $query->bindValue(":design",$design,PDO::PARAM_STR);
       $query->bindValue(":types",$types,PDO::PARAM_STR);
       $query->bindValue(":nbrplace",$nbrplace,PDO::PARAM_INT);
       $query->bindValue(":frais",$frais,PDO::PARAM_INT);
       $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
       $resultat = $query->execute();
       $query->closeCursor();
       /////////////////////////////////////////////
       if($resultat > 0)
       {
           $this->getvoitureById($idvoit)->setdesign($design);
           $this->getvoitureById($idvoit)->settypes($types);
           $this->getvoitureById($idvoit)->setnbrplace($nbrplace);
           $this->getvoitureById($idvoit)->setfrais($frais);
       }
   }
}
?>