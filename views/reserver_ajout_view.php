<?php 
ob_start(); 
?>
<form method="POST" action="<?= URL ?>voiture/ajouterbdd" enctype="multipart/form-data">
    <div class="form-group">
        <label for="idvoit">Reference voiture : </label>
        <input type="text" class="form-control" id="idvoit" name="idvoit">
    </div>
    <div class="form-group">
        <label for="design">Design : </label>
        <input type="text" class="form-control" id="design" name="design">
    </div>
    <div class="form-group">
        <label for="types">Types : </label>
        <input type="text" class="form-control" id="types" name="types">
    </div>
    <div class="form-group">
        <label for="nbrplace">Nombre de place : </label>
        <input type="text" class="form-control" id="nbrplace" name="nbrplace">
    </div>
    <div class="form-group">
        <label for="frais">Frais : </label>
        <input type="number" class="form-control" id="frais" name="frais">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout d'un livre";
require "template.php";
?>