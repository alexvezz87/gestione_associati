<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/

$view = new AssociatoView();
$controller = new AssociatoController();

$inScadenza = $controller->getAssociatiInScadenza();
$scaduti = $controller->getAssociatiScaduti();

$emails = $controller->getEmailAssociati();
?>

<?php /* 
<h2>Email newsletter</h2>

<textarea style="width:100%">
    <?php 
        foreach($emails as $email){
            echo $email.'&#13;&#10;';
        }
    ?>
</textarea>
*/ ?>
<div class="loader-container">
            <div class="loader"></div>
        </div>
<h2>Visualizza Associati</h2>
<input type="hidden" name="ajax-url" value="<?php echo get_home_url() ?>/wp-admin/admin-ajax.php" />

<h3>Ultimi 5 inseriti</h3>
<?php $view->printTableAssociati($controller->getLast5Associati()) ?>

<?php if(count($scaduti) > 0){ ?>
<h3>Scaduti</h3>
<?php $view->printTableAssociati($scaduti) ?>
<?php } ?>

<?php if(count($inScadenza) > 0){ ?>
<h3>In scadenza</h3>
<?php $view->printTableAssociati($inScadenza) ?>
<?php } ?>

<h3>Tutti gli associati</h3>
<?php $view->printTableAssociati($controller->getAssociatiNonIbernati()) ?>