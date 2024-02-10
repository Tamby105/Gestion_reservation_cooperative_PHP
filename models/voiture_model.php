<?php 
require_once "connexion_model.php";

class voiture_model extends voiture_model
{
    private $idvoit;
    private $design;
    private $type;
    private $nbrplace;
    private $frais;

    private $voiture;

    //init constructeur
    public function __construct($idvoit,$design,$type,$nbrplace,$frais)
    {
        $this->idvoit = $idvoit;
        $this->$design = $design;
        $this->$type = $type;
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
  
   public function gettype()
   {
       return $this->type;
   }
   public function settype($type)
   {
       $this->type = $type;
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
}
?>