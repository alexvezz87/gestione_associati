<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/

$view = new AssociatoView();
$controller = new AssociatoController();

$ibernati = $controller->getAssociatiIbernati();


?>

<h2>Visualizza Ibernati</h2>
<?php $view->printTableAssociati($ibernati) ?>