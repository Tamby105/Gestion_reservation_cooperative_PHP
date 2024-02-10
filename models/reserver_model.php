<?php 
require_once "connexion_model.php";

class reserver_model extends reserver_model
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
}
?>