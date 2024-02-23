<?php 
require_once "models/client_model.php";

class client_controller
{
    private $clients;

    public function __construct()
    {
        $this->clients = new client_model("fictif", "fictif", "fictif");
        $this->clients->chargementclient();//recuperation des donnees dans la base
    }

    public function controller_vue_client()
    {
        $clients = $this->clients->getclient();
        require "views/client_afficher_view.php"; //mtifitra makany @vue
    }

    /*public function controller_afficherlivre($id)
    {
        $livre = $this->livres->getLivreById($id);
        require "views/silivredetaille_view.php";
    }*/

    public function controller_page_ajoutclient()
    {
        require "views/client_ajout_view.php";
    }

    public function controller_ajoutclient()
    {
        $this->clients->ajoutclientBd($_POST['idcli'],$_POST['nom'],$_POST['numtel']);
        header('Location: '. URL . "client");
    }

    public function controller_suppression_client($idcli)
    {
        $this->clients->suppressionclient($idcli);
        header('Location: '. URL . "client");
    }

    public function controller_page_modification_client($idcli)//donne une interface de modification
    {
        $clients = $this->clients->getclientById($idcli);
        require "views/client_modifier_view.php";
    }

    public function controller_page_retour_modification_client()//actualisation interface de liste
    {
        $clients = $this->clients->getLivres();
        require "views/client_afficher_view.php";
    }

    public function controller_modification_client()//modificaation bases de donnees
    {
        $this->clients->modificationclientBD($_POST['idcli'],$_POST['nom'],$_POST['numtel'],$_POST['idtsycli']);
        header('Location: '. URL . "client");
    }

}   

?>