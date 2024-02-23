<?php 
ob_start(); 
?>

<table class="table text-center">
    <tr>
        <th>Reference voiture</th>
        <th>Design</th>
        <th>Type de voiture</th>
        <th>Nombre de place</th>
        <th>Frais</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php 
    for($i=0; $i < count($voitures); $i++) : 
    ?>
    <tr> <!--raha tsy mila mirelier @ page afa refa avy mclique-->
        <td class="align-middle"><?= $voitures[$i]->getidvoit(); ?></td>
        <td class="align-middle"><?= $voitures[$i]->getdesign(); ?></td>
        <td class="align-middle"><?= $voitures[$i]->gettypes(); ?></td>
        <td class="align-middle"><?= $voitures[$i]->getnbrplace(); ?></td>
        <td class="align-middle"><?= $voitures[$i]->getfrais(); ?></td>

        <td class="align-middle"><a href="<?= URL ?>voiture/interfacemodif/<?= $voitures[$i]->getidvoit(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>voiture/suppr/<?= $voitures[$i]->getidvoit(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer la voiture ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>voiture/interfaceajout" class="btn btn-success d-block">Ajouter</a>

<?php
$content = ob_get_clean();
$titre = "Les voitures de la cooperative";
require "template.php";
?>