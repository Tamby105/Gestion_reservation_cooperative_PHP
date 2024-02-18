<?php 
ob_start(); 
?>
<form method="POST" action="<?= URL ?>client/ajouterbdd" enctype="multipart/form-data">
    <div class="form-group">
        <label for="idcli">Reference client : </label>
        <input type="text" class="form-control" id="idcli" name="idcli">
    </div>
    <div class="form-group">
        <label for="nom">Nom : </label>
        <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="form-group">
        <label for="numtel">Numero telephone : </label>
        <input type="text" class="form-control" id="numtel" name="numtel">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
<?php
$content = ob_get_clean();
$titre = "Ajout d'un livre";
require "template.php";
?>