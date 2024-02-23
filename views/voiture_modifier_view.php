<?php 
ob_start(); 
?>

<form method="POST" action="<?= URL ?>voiture/modifBdd" enctype="multipart/form-data">
    <div class="form-group">
        <label for="idvoit">Reference voiture : </label>
        <input type="text" class="form-control" id="idvoit" name="idvoit" value="<?= $voitures->getIdcli() ?>">
    </div>
    <div class="form-group">
        <label for="design">Design : </label>
        <input type="text" class="form-control" id="design" name="design" value="<?= $voitures->getdesign() ?>">
    </div>
    <div class="form-group">
        <label for="types">Types : </label>
        <input type="text" class="form-control" id="types" name="types" value="<?= $voitures->gettypes() ?>">
    </div>
    <div class="form-group">
        <label for="nbrplace">Nombre de place : </label>
        <input type="text" class="form-control" id="nbrplace" name="nbrplace" value="<?= $voitures->getnbrplace() ?>">
    </div>    
    <div class="form-group">
        <label for="frais">Frais : </label>
        <input type="number" class="form-control" id="frais" name="frais" value="<?= $voitures->getfrais() ?>">
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" id="idvoit_obsolete" name="idvoit_obsolete" value="<?= $voitures->getidvoit() ?>">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<?php
$content = ob_get_clean();
$titre = "Modification client : ".$clients->getIdcli();
require "template.php";
?>