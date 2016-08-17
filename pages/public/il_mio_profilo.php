<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/

$view = new AssociatoView();


$view->listnerDettaglioAssociatoPubblico();
$view->printIlMioProfilo(get_current_user_id());

?>

