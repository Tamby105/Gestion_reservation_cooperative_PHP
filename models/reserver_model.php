<?php 
require_once "connexion_model.php";

class reserver_model extends connexion_class
{
    private $idreserv;
    private $idvoit;
    private $idcli;
    private $place;
    private $date_reserv;
    private $date_voyage;
    private $payment;
    private $montant_avance;

    private $reserver;

    //init constructeur
    public function __construct($idreserv,$idvoit,$idcli,$place,$date_reserv,$date_voyage,$payment,$montant_avance)
    {
        $this->idreserv = $idreserv;
        $this->idvoit = $idvoit;
        $this->idcli = $idcli;
        $this->place = $place;
        $this->date_reserv = $date_reserv;
        $this->date_voyage = $date_voyage;
        $this->payment	 = $payment	;
        $this->$montant_avance = $montant_avance;
    }

    /*********************** Init_Accesseur ************************/
    public function getidreserv()
    {
        return $this->idreserv;
    }
    public function setidreserv($idreserv)
    {
        $this->idreserv = $idreserv;
    }

    public function getidvoit()
    {
        return $this->idvoit;
    }
    public function setidvoit($idvoit)
    {
        $this->idvoit = $idvoit;
    }

    public function getidcli()
    {
        return $this->idcli;
    }
    public function setidcli($idcli)
    {
        $this->idcli = $idcli;
    }

    public function getplace()
    {
        return $this->place;
    }
    public function setplace($place)
    {
        $this->place = $place;
    }

    public function getdate_reserv()
    {
        return $this->date_reserv;
    }
    public function setdate_reserv($date_reserv)
    {
        $this->date_reserv = $date_reserv;
    }

    public function getdate_voyage()
    {
        return $this->date_voyage;
    }
    public function setdate_voyage($date_voyage)
    {
        $this->date_voyage = $date_voyage;
    }

    public function getpayment()
    {
        return $this->payment;
    }
    public function setpayment($payment)
    {
        $this->payment = $payment;
    }

    public function getmontant_avance()
    {
        return $this->montant_avance;
    }
    public function setmontant_avance($montant_avance)
    {
        $this->montant_avance = $montant_avance;
    }


    public function setreserver($reserver)
    {
        $this->reserver[] = $reserver;
    }
    public function getreserver()
    {
        return $this->reserver;
    }



    public function chargementreserver()
   {
       $query = $this->getconnexionbd()->prepare("SELECT * FROM `reserver`");
       $query->execute();
       $reserverDatas = $query->fetchAll(PDO::FETCH_ASSOC);
       $query->closeCursor();
       //inscription des donnees dans la  base dans le tableau d'affichage
       foreach($reserverDatas as $reserver)
       {
           $reserverListe = new reserver_model($reserver['idreserv'],$reserver['idvoit'],$reserver['idcli'],$reserver['place'],$reserver['date_reserv'],$reserver['date_voyage'],$reserver['payment'],$reserver['montant_avance']);
           $this->setreserver($reserverListe);
       }
   }

   public function getreserverById($reserver)
   {
       for($i=0; $i < count($this->reserver);$i++)
       {
           if($this->reserver[$i]->getidreserv() === $reserver)
           {
               return $this->reserver[$i];
           }
       }
   }

   public function ajoutreserverBd($idreserv,$idvoit,$idcli,$place,$date_reserv,$date_voyage,$payment,$montant_avance)
   {
       $queryStr = "INSERT INTO reserver (idreserv, idvoit, idcli, place, date_reserv, date_voyage, payment, montant_avance) VALUES(:idreserv, :idvoit, :idcli, :place, :date_reserv, :date_voyage, :payment, :montant_avance)";
       $query = $this->getconnexionbd()->prepare($queryStr);
       $query->bindValue(":idreserv",$idreserv,PDO::PARAM_INT);
       $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
       $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
       $query->bindValue(":place",$place,PDO::PARAM_INT);
       $query->bindValue(":date_reserv",$date_reserv,PDO::PARAM_STR);
       $query->bindValue(":date_voyage",$date_voyage,PDO::PARAM_STR);
       $query->bindValue(":payment",$payment,PDO::PARAM_STR);
       $query->bindValue(":montant_avance",$montant_avance,PDO::PARAM_INT);

       $resultat = $query->execute();
       $query->closeCursor();
              //actualisation interface
       if($resultat > 0)
       {
           $reserver = new reserver_model($this->getconnexionbd()->lastInsertId(),$idreserv,$idvoit,$idcli,$place,$date_reserv,$date_voyage,$payment,$montant_avance);
           $this->setreserver($reserver);
       }        
   }

   public function suppressionreserver($idreserv)
   {
       $queryStr = "DELETE FROM reserver WHERE idreserv = :idreserv";
       $query = $this->getconnexionbd()->prepare($queryStr);
       $query->bindValue(":idreserv",$idreserv,PDO::PARAM_INT);
       $resultat = $query->execute();
       $query->closeCursor();
       //actualisation interface
       if($resultat > 0)
       {
           $reserver = $this->getreserverById($idreserv);
           unset($reserver);
       }
   }

   public function modificationreserverBD($idreserv,$idvoit,$idcli,$place,$date_reserv,$date_voyage,$payment,$montant_avance)
   {
       $queryStr = "UPDATE reserver SET idvoit = :idvoit, idcli = :idcli, place = :place, date_reserv = :date_reserv, date_voyage = :date_voyage, payment = :payment, montant_avance = :montant_avance WHERE idreserv = :idreserv";
       $query = $this->getconnexionbd()->prepare($queryStr);
       $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
       $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
       $query->bindValue(":place",$place,PDO::PARAM_INT);
       $query->bindValue(":date_reserv",$date_reserv,PDO::PARAM_STR);
       $query->bindValue(":date_voyage",$date_voyage,PDO::PARAM_STR);
       $query->bindValue(":payment",$payment,PDO::PARAM_STR);
       $query->bindValue(":montant_avance",$montant_avance,PDO::PARAM_INT);
       $query->bindValue(":idreserv",$idreserv,PDO::PARAM_INT);

       $resultat = $query->execute();
       $query->closeCursor();
        //actualisation interface
       if($resultat > 0)
       {
           $this->getreserverById($idreserv)->setdesign($idvoit);
           $this->getreserverById($idreserv)->setidcli($idcli);
           $this->getreserverById($idreserv)->setplace($place);
           $this->getreserverById($idreserv)->setdate_reserv($date_reserv);
           $this->getreserverById($idreserv)->setdate_voyage($date_voyage);
           $this->getreserverById($idreserv)->setpayment($payment);
           $this->getreserverById($idreserv)->setmontant_avance($montant_avance);

       }
   }
}
?>