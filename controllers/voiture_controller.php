<?php 
require_once "../models/voiture_model.php";

class voiture_controller
{
    private $voitures;

    public function __construct()
    {
        $this->voitures = new voiture_model("fictif", "fictif", "fictif", "fictif", 28, 30000);
        $this->voitures->chargementvoiture();//recuperation des donnees dans la base
    }

    public function controller_vue_voiture()
    {
        $voitures = $this->voitures->getvoiture();
        require "views/voiture_afficher_view.php"; //redirection
    }

    /*public function controller_afficherlivre($id)
    {
        $livre = $this->livres->getLivreById($id);
        require "views/silivredetaille_view.php";
    }*/

    public function controller_page_ajoutvoiture()
    {
        require "views/voiture_ajout_view.php";
    }

    public function controller_ajoutvoiture()
    {
        $this->voitures->ajoutvoitureBd($_POST['idvoit'],$_POST['design'],$_POST['types'],$_POST['nbrplace'],$_POST['frais']);
        //header('Location: '. URL . "livres");
    }

    public function controller_suppression_client($idvoit)
    {
        $this->voitures->suppressionvoiture($idvoit);
        //header('Location: '. URL . "livres");
    }

    public function controller_page_modification_voitures($idvoit)//donne une interface de modification
    {
        $voitures = $this->voitures->getvoitureById($idvoit);
        require "views/voiture_modifier_view.php";
    }

    public function controller_page_retour_modification_voiture()//actualisation interface de liste
    {
        $voitures = $this->voitures->getvoiture();
        require "views/voiture_afficher_view.php";
    }

    public function controller_modification_voiture()//modificaation bases de donnees
    {
        $this->clients->modificationvoitureBD($_POST['idvoit'],$_POST['design'],$_POST['types'],$_POST['nbrplace'],$_POST['frais']);
        //header('Location: '. URL . "livres");
    }

}   

?>