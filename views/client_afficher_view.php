<?php 
ob_start(); 
?>

<table class="table text-center">
    <tr>
        <th>Reference client</th>
        <th>Nom client</th>
        <th>Numero telephone</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php 
    for($i=0; $i < count($clients) ;$i++) : 
    ?>
    <tr>
        <!--<td class="align-middle"><a href = " <?= URL ?>client/caf/<?= $clients[$i]->getIdcli(); ?> " > <?= $clients[$i]->getIdcli(); ?></a></td>--> <!--raha tsy mila mirelier @ page afa refa avy mclique-->
        <td class="align-middle"><?= $clients[$i]->getIdcli(); ?></td>
        <td class="align-middle"><?= $clients[$i]->getnom(); ?></td>
        <td class="align-middle"><?= $clients[$i]->getnumtel(); ?></td>

        <td class="align-middle"><a href="<?= URL ?>client/interfacemodif/<?= $clients[$i]->getIdcli(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>client/suppr/<?= $clients[$i]->getIdcli(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer le livre ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>client/interfaceajout" class="btn btn-success d-block">Ajouter</a>

<?php
$content = ob_get_clean();
$titre = "Les client de la cooperative";
require "template.php";
?>