<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/


$id = $_GET['id'];
$view = new AssociatoView();

?>

<div class="back" style="margin-top:20px">
    <a href="<?php echo admin_url() ?>/admin.php?page=gestione_associati"><<<< Torna alla pagina precedente</a>
</div>
<?php $view->listenerDettaglioAssociato() ?>
<div class="dettaglio-associato">
    <?php $view->printDettaglioAssociato($id) ?>
</div>

