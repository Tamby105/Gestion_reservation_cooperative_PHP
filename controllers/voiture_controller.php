<?php 
require_once "models/voiture_model.php";
require_once "models/place_model.php";

class voiture_controller
{
    private $voitures;
    private $places;

    public function __construct()
    {
        $this->voitures = new voiture_model("fictif", "fictif", "fictif", "fictif", 28, 30000);
        $this->voitures->chargementvoiture();//recuperation des donnees dans la base
    
        $this->places = new place_model("fictif", 01, "non");
    }

    /*public function __construct()
    {
        $this->places = new place_model("fictif", 01, "oui");
    }*/

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
        header('Location: '. URL . "voiture");
        //boucle qui ajoute tous les places d'une voiture en initialisant toutes les ocupations en "non" au moment d'ajoout d'une nouvelle voiture
        $idvoit = $_POST['idvoit'];
        $nbrplace = $_POST['nbrplace'];
        
        for($i=1; $i <= $nbrplace; $i++)
        {
             $this->places->ajoutplaceBd($idvoit,$i);
        }
    }
    public function controller_page_modification_voitures($idvoit)//donne une interface de modification
    {
        $voitures = $this->voitures->getvoitureById($idvoit);
        require "views/voiture_modifier_view.php";
    }
    public function controller_modification_voiture()//modificaation bases de donnees
    {
        $this->clients->modificationvoitureBD($_POST['idvoit'],$_POST['design'],$_POST['types'],$_POST['nbrplace'],$_POST['frais']);
        header('Location: '. URL . "voiture");
    }
    public function controller_suppression_voiture($idvoit)
    {
        $this->voitures->suppressionvoiture($idvoit);
        $this->places->suppressionplace($idvoit);
        header('Location: '. URL . "voiture");
    }
    /*public function controller_page_retour_modification_voiture()//actualisation interface de liste
    {
        $voitures = $this->voitures->getvoiture();
        require "views/voiture_afficher_view.php";
    }*/

}   

?>