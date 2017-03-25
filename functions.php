<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/

function curPageURL() {
    $pageURL = 'http';
    
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
     $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
     $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}


function getTime($time){
    //viene passata una data nella forma aaaa-mmm-dd hh:mm:ss (es. 2015-09-13 16:30:40)
    //devo restituire gg/mm/aaaa hh:mm

    $temp = explode(' ', $time);
    $time1 = explode('-', $temp[0]);
    $time2 = explode(':', $temp[1]);

    return $time1[2].'/'.$time1[1].'/'.$time1[0];
    //return $time1[2].'/'.$time1[1].'/'.$time1[0].' - '.$time2[0].':'.$time2[1];
}


function getGiornoMese($time){
    //viene passata una data nella forma aaaa-mmm-dd hh:mm:ss (es. 2015-09-13 16:30:40)
    //devo restituire gg mm
    $temp = explode(' ', $time);
    $time1 = explode('-', $temp[0]);
    $time2 = explode(':', $temp[1]);

    return $time1[2].' '.getMese($time1[1]);
}

function getStringData($time){
    $temp = explode(' ', $time);
    $time1 = explode('-', $temp[0]);
    return $time1[2].' '.getMese($time1[1]).' '.$time1[0];
}

function getMese($mese){
    
    switch ($mese){
        case '01': return 'Gennaio';
        case '02': return 'Febbraio';
        case '03': return 'Marzo';
        case '04': return 'Aprile';
        case '05': return 'Maggio';
        case '06': return 'Giugno';
        case '07': return 'Luglio';
        case '08': return 'Agosto';
        case '09': return 'Settembre';
        case '10': return 'Ottobre';
        case '11': return 'Novembre';
        case '12': return 'Dicembre';
    }
    
   
}

/**
 * La funzione indica se un utente è scaduto. Il periodo è di 365 giorni
 * @param type $data
 * @return boolean
 */
function isAssociatoScaduto($data){
    //calcolo il tempo 
    $oggi = time();
    //Giorni da sottrarre
    $giorni = 365*24*60*60;
    $datascadenza = strtotime($data) + $giorni;   
    if($datascadenza > $oggi){
        return false;
    }
    return true;
}

/**
 * La funzione restitusce una stringa che indica lo stato dell'assocciato, passata una data come parametro in ingresso!
 * @param type $data
 * @return string
 */
function getStatusAssociato($data){    
    //calcolo il tempo 
    $oggi = time();
    //Giorni da sottrarre
    $giorni = 365*24*60*60;
    $giorniAvviso = (365-15)*24*60*60;
    $datascadenza = strtotime($data) + $giorni;  
    $dataAvviso = strtotime($data) + $giorniAvviso;  
    if($datascadenza > $oggi){
        if($dataAvviso <= $oggi){
            return 'IN SCADENZA';
        }
        return 'ATTIVO';
    }
    return 'SCADUTO';
}


function getUtentiWpSelectValues(){
    
    $args = array('fields' => 'all', 'orderby' => 'display_name', 'order' => 'ASC');        
    $usersWp = get_users($args);
    
    $result = array();
    foreach($usersWp as $user){
        $u = new WP_User();
        $u = $user;
        $result[$u->ID] = $u->user_firstname.' '.$u->user_lastname;
    }
    
    return $result;
}


function getValueTipoSocio($tipo){
    switch($tipo){
        case 1 : return 'Sostenitore';
        case 2 : return 'Ordinario';
        case 3 : return 'VIP';
        case 4 : return 'Onorario';
    }
}


//CHIAMATE AJAX
add_action( 'wp_ajax_nopriv_invia_mail', 'invia_mail' );
add_action( 'wp_ajax_invia_mail', 'invia_mail' );
function invia_mail(){
    $result = false;
    
    $controller = new AssociatoController();
    $a = $controller->getAssociatoByIdAssociato($_POST['id']);
    
    if($controller->inviaMail($_POST['mode'], $a)){       
        $result = true;
    }
    
    echo json_encode($result);
    die();
    
}


?>