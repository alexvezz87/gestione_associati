<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/

$view = new AssociatoView();
$controller = new AssociatoController();

?>

<h2>Statistiche</h2>

<?php
    $s = array();
    
    $s1 = array();    
    $s1['id'] = 'statusAssociati';
    $s1['titolo'] = 'Status Associati';
    $s1['dati'] = $controller->getStatusAssociati();
    $s1['type'] = 'pie';
    array_push($s, $s1);
    
    $s4 = array();
    $s4['id'] = 'tipoAssociati';
    $s4['titolo'] = 'Tipo Associato';
    $s4['dati'] = $controller->getTipoAssociato();
    $s4['type'] = 'pie';
    array_push($s, $s4);
    
    $s2 = array();
    $s2['id'] = 'sessoAssociati';
    $s2['titolo'] = 'Associati';
    $s2['dati'] = $controller->getSessoAssociati();    
    $s2['type'] = 'pie';
    array_push($s, $s2);
    
    $s3 = array();
    $eta1 = $controller->getEtaAssociati();
    $s3['id'] = 'etaAssociati';
    $s3['titolo'] = 'Età';
    $s3['dati'] = $eta1['dati'];
    $s3['note'] = 'Media età: '.$eta1['media'];
    $s3['type'] = 'area';
    array_push($s, $s3);
    
    $s5 = array();
    $eta2 = $controller->getEtaAssociati('m');
    $s5['id'] = 'etaAssociatiUomini';
    $s5['titolo'] = 'Età uomini';
    $s5['dati'] = $eta2['dati'];
    $s5['note'] = 'Media età: '.$eta2['media'];
    $s5['type'] = 'area';
    array_push($s, $s5);
    
    $s6 = array();
    $eta3 = $controller->getEtaAssociati('f');
    $s6['id'] = 'etaAssociatiDonne';
    $s6['titolo'] = 'Età donne';
    $s6['dati'] = $eta3['dati'];
    $s6['note'] = 'Media età: '.$eta3['media'];
    $s6['type'] = 'area';
    array_push($s, $s6);

    $s7 = array();
    $s7['id'] = 'provenienzaAssociati';
    $s7['titolo'] = 'Provenienza';
    $s7['dati'] = $controller->getProvenienzaAssociati();
    $s7['type'] = 'column';
    array_push($s, $s7);
    
    $array = array();
    $regioni = $controller->getProvenienzaAssociati();
    foreach($regioni as $k => $v){
       $regione = $controller->getProvenienzaRegione($k);
       
       foreach($regione as $k => $v){
           if($k != 'ESTERO'){
            $countAssociati = 0;
            foreach ($v as $item){
                $countAssociati+=$item;
            }
            $sR = array();
            $sR['id'] = 'provenienza'.str_replace('-', '', str_replace(' ', '', $k));
            $sR['titolo'] = $k;
            $sR['dati'] = $v;
            $sR['note'] = 'Totale associati: '.$countAssociati;
            $sR['type'] = 'pie';
          
           array_push($s, $sR);
           }
       }
    }
    
    $view->printStatisticheColumns($s);
    
?>
<div class="clear"></div>
<?php 

    $view->printAssociatiMaps();
  
?>


