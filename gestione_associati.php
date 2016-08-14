<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/
 /**
 * @package preventivi_serrature
 */
/*
Plugin Name: Gestione Associati
Plugin URI: 
Description: Plugin per la gestione degli iscritti a l'associazione La Quarta Era
Version: 1.0
Author: Alex Vezzelli - Alex Soluzioni Web
Author URI: http://www.alexsoluzioniweb.it/
License: GPLv2 or later
*/


define('NAME_PLUGIN', 'gestione_associati');

//includo le librerie
require_once 'install_DB.php';
require_once 'functions.php';
require_once 'classi/classes.php';
require_once 'variabili_globali.php';

//indico la cartella dove è contenuto il plugin
require_once (dirname(__FILE__) . '/gestione_associati.php');

//creo il db al momento dell'attivazione
register_activation_hook(__FILE__, 'install_DB');
function install_DB(){
    install_tabelle_db();
}

//rimuovo il db quando disattivo il plugin
register_deactivation_hook( __FILE__, 'remove_DB');
function remove_DB(){
    drop_tabelle_associati();
}


//registro gli stili
add_action( 'wp_enqueue_scripts', 'register_ga_style' );
add_action( 'admin_enqueue_scripts', 'register_admin_style' );

function register_ga_style(){
    wp_register_style('ga_style_css', plugins_url('css/style.css', __FILE__));
    wp_enqueue_style('ga_style_css');
}

function register_admin_style() {
    wp_register_style('admin-style', plugins_url('css/admin-style.css', __FILE__) );
    wp_register_style('admin-bootstrap-style', plugins_url('css/bootstrap.min.css', __FILE__) );
    wp_register_style('file-input-style', plugins_url('css/fileinput.min.css', __FILE__) );
    
    wp_enqueue_style('admin-style');
    wp_enqueue_style('admin-bootstrap-style');
    wp_enqueue_style('file-input-style');
}


//Aggiungo il file di Javascript al plugin
add_action( 'wp_enqueue_scripts', 'register_js_script' );

function register_js_script(){
    wp_register_script('functions-ga-js', plugins_url('js/script.js', __FILE__), array('jquery'), '1.0', false);          
            
    wp_enqueue_script('functions-ga-js');   
} 

//aggiungo gli script lato amministratore
function register_admin_js_script(){
    wp_register_script('bootstrap-js', plugins_url('js/bootstrap.min.js', __FILE__), array('jquery'), '1.0', false);   
    wp_register_script('file-input-js', plugins_url('js/fileinput.min.js', __FILE__), array('jquery'), '1.0', false); 
    
    wp_enqueue_script('bootstrap-js');   
    wp_enqueue_script('file-input-js');  
}

add_action( 'admin_enqueue_scripts', 'register_admin_js_script' );



//Aggiungo il menu di Plugin
function add_admin_ga_menu(){
    add_menu_page('Associati', 'Associati', 'edit_plugins', 'gestione_associati', 'add_page_gestione_associati', plugins_url('images/ico_plugin.png', __FILE__), 9 );
    add_submenu_page('gestione_associati', 'Aggiungi Associato', 'Aggiungi Associato', 'edit_plugins', 'add_associato', 'add_page_add_associato');
    
    add_submenu_page('', 'Dettaglio Associato',  'Dettaglio Associato', 'edit_plugins', 'dettaglio_associato', 'add_pagina_dettaglio');
}


function add_page_gestione_associati(){
    include 'pages/admin/pagina_associati.php';
}

function add_page_add_associato(){
    include 'pages/admin/add_associato.php';
}

function add_pagina_dettaglio(){
    include 'pages/admin/dettaglio_associato.php';
}



//registro il menu
add_action('admin_menu', 'add_admin_ga_menu');
?>