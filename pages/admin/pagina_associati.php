<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/

$view = new AssociatoView();
$controller = new AssociatoController();

?>

<h2>Visualizza Associati</h2>

<h3>Ultimi 5 inseriti</h3>
<?php $view->printTableAssociati($controller->getLast5Associati()) ?>

<h3>Tutti gli associati</h3>
<?php $view->printTableAssociati($controller->getAssociatiList()) ?>