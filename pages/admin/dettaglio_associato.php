<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/


$id = $_GET['id'];
$view = new AssociatoView();
$c = new AssociatoController();

$a = new Associato();
$a = $c->getAssociatoByIdAssociato($id);
$back = "";
if($a->getIbernato() == 0){
    $back = "gestione_associati";
}
else if($a->getIbernato() == 1){
    $back = "ibernati";
}

?>

<div class="back" style="margin-top:20px">
    <a href="<?php echo admin_url() ?>admin.php?page=<?php echo $back ?>"><<<< Torna alla pagina precedente</a>
</div>
<?php $view->listenerDettaglioAssociato() ?>
<div class="dettaglio-associato">
    <?php $view->printDettaglioAssociato($id) ?>
</div>

