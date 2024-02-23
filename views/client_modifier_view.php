<?php 
ob_start(); 
?>

<form method="POST" action="<?= URL ?>client/modifBdd" enctype="multipart/form-data">
    <div class="form-group">
        <label for="idcli">Reference client : </label>
        <input type="text" class="form-control" id="idcli" name="idcli" value="<?= $clients->getIdcli() ?>">
    </div>
    <div class="form-group">
        <label for="nom">Nom : </label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= $clients->getnom() ?>">
    </div>
    <div class="form-group">
        <label for="numtel">Nunero telephone : </label>
        <input type="text" class="form-control" id="numtel" name="numtel" value="<?= $clients->getnumtel() ?>">
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control" id="idtsycli" name="idtsycli" value="<?= $clients->getIdcli() ?>">
    </div>
    <!--<input type="hidden" name="identifiant" value="<?= $clients->getIdcli(); ?>">-->
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <!--<a href="<?= URL ?>livres/cprmo" class="btn btn-success d-block">Annuler</a>-->
</form>

<?php
$content = ob_get_clean();
$titre = "Modification client : ".$clients->getIdcli();
require "template.php";
?>