<?php 
require_once "../models/reserver_model.php";

class reserver_controller
{
    private $reserver;

    public function __construct()
    {
        $this->reserver = new reserver_model("fictif", "fictif", "fictif", 12, "2024-02-12 20:14:00", "2024-02-12", "fictif", 10000);
        $this->reserver->chargementreserver();//recuperation des donnees dans la base
    }

    public function controller_vue_reserver()
    {
        $reserver = $this->reserver->getreserver();
        require "views/reserver_afficher_view.php"; //redirection
    }

    /*public function controller_afficherlivre($id)
    {
        $livre = $this->livres->getLivreById($id);
        require "views/silivredetaille_view.php";
    }*/

    public function controller_page_ajoutreserver()
    {
        require "views/reserver_ajout_view.php";
    }

    public function controller_ajoutreserver()
    {
        $this->reserver->ajoutreserverBd($_POST['idreserv'],$_POST['idvoit'],$_POST['idcli'],$_POST['place'],$_POST['date_reserv'],$_POST['date_voyage'],$_POST['payment'],$_POST['montant_avance']);
        //header('Location: '. URL . "livres");
    }

    public function controller_suppression_reserver($idreserv)
    {
        $this->reserver->suppressionreserver($idreserv);
        //header('Location: '. URL . "livres");
    }

    public function controller_page_modification_reserver($idreserv)//donne une interface de modification
    {
        $reserver = $this->reserver->getreserverById($idreserv);
        require "views/reserver_modifier_view.php";
    }

    public function controller_page_retour_modification_reserver()//actualisation interface de liste
    {
        $reserver = $this->reserver->getreserver();
        require "views/reserver_afficher_view.php";
    }

    public function controller_modification_reserver()//modificaation bases de donnees
    {
        $this->reserver->modificationreserverBD($_POST['idreserv'],$_POST['idvoit'],$_POST['idcli'],$_POST['place'],$_POST['date_reserv'],$_POST['date_voyage'],$_POST['payment'],$_POST['montant_avance']);
        //header('Location: '. URL . "livres");
    }

}   

?>