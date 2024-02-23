<?php 
ob_start(); 
?>

welcome to PNS boy  <br>
magnitry langilangy bassy avia anao mamangy</br>

<?php
$content = ob_get_clean();
$titre = "RESERVATION DES PLACES DE COOPERATIVES";
require "template.php";
?>