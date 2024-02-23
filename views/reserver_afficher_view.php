<?php 
ob_start(); 
?>

<table class="table text-center">
    <tr>
        <th>Numero de reservation </th>
        <th>Reference voiture</th>
        <th>Reference client</th>
        <th>Place</th>
        <th>Date de reservation</th>
        <th>Date de voyage</th>
        <th>Payment</th>
        <th>Montant a l'avance</th>

        <th colspan="2">Actions</th>
    </tr>
    <?php 
    for($i=0; $i < count($reserver) ;$i++) : 
    ?>
    <tr>
        <!--<td class="align-middle"><a href = " <?= URL ?>client/caf/<?= $reserver[$i]->getIdcli(); ?> " > <?= $clients[$i]->getIdcli(); ?></a></td>--> <!--raha tsy mila mirelier @ page afa refa avy mclique-->
        <td class="align-middle"><?= $reserver[$i]->getidreserv(); ?></td>
        <td class="align-middle"><?= $reserver[$i]->getidvoit(); ?></td>
        <td class="align-middle"><?= $reserver[$i]->getidcli(); ?></td>
        <td class="align-middle"><?= $reserver[$i]->getplace(); ?></td>
        <td class="align-middle"><?= $reserver[$i]->getdate_reserv(); ?></td>
        <td class="align-middle"><?= $reserver[$i]->getdate_voyage(); ?></td>
        <td class="align-middle"><?= $reserver[$i]->getpayment(); ?></td>
        <td class="align-middle"><?= $reserver[$i]->getmontant_avance(); ?></td>

        <td class="align-middle"><a href="<?= URL ?>reserver/interfacemodifreserver/<?= $reserver[$i]->getidreserv(); ?>" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle">
            <form method="POST" action="<?= URL ?>reserver/suppr/<?= $reserver[$i]->getidreserv(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer cette reservation ?');">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<a href="<?= URL ?>reserver/interfaceajout" class="btn btn-success d-block">Ajouter</a>

<?php
$content = ob_get_clean();
$titre = "Les reservations de la cooperative";
require "template.php";
?>