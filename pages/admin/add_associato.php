<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/

$view = new AssociatoView();

?>

<?php $view->listenerAddAssociato() ?>

<h1>Nuovo Associato</h1>
<div class="form-container">
    <?php $view->printAddAssociatoForm() ?>
</div>