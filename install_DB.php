<?php

//Autore: Alex Vezzelli - Alex Soluzioni Web
//url: http://www.alexsoluzioniweb.it/


/********************* CREATE TABLES *******************/

function install_tabelle_db(){
    try{
        global $wpdb;
        $charset_collate = "";
        $wpdb->prefix = 'qe_';
        if (!empty ($wpdb->charset)){
            $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
        }
        if (!empty ($wpdb->collate)){
            $charset_collate .= " COLLATE {$wpdb->collate}";
        }
        
        //installo le tabelle
        install_tabella_associato($wpdb, $charset_collate);
        install_tabella_rinnovo($wpdb, $charset_collate);
        install_tabella_sezioni_interesse($wpdb, $charset_collate);
        
        return true;
        
    } catch (Exception $ex) {
        _e($ex);
        return false;
    }
}


function install_tabella_associato($wpdb, $charset_collate){
    $table = $wpdb->prefix.'associati';
    $query = "CREATE TABLE IF NOT EXISTS $table (
                ID INT NOT NULL auto_increment PRIMARY KEY,
                numero_tessera INT NOT NULL,
                nome TEXT NOT NULL,
                cognome TEXT NOT NULL,
                sesso VARCHAR(1) NOT NULL,
                luogo_nascita TEXT NOT NULL,
                data_nascita TIMESTAMP NOT NULL,
                ind_via TEXT NOT NULL,
                ind_civico VARCHAR(10) NOT NULL,
                ind_citta TEXT NOT NULL,
                ind_prov TEXT NOT NULL,
                telefono VARCHAR(30),
                email TEXT NOT NULL,
                tipo_socio VARCHAR(20) NOT NULL,
                data_iscrizione TIMESTAMP NOT NULL,
                modulo TEXT,
                id_utente_wp INT
             );{$charset_collate}";
    try{
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($query);   
        return true;
    } catch (Exception $ex) {
        _e($ex);
        return false;
    }      
}

function install_tabella_rinnovo($wpdb, $charset_collate){
    $table = $wpdb->prefix.'rinnovi';
    $query = "CREATE TABLE IF NOT EXISTS $table (
                ID INT NOT NULL auto_increment PRIMARY KEY,               
                data_rinnovo TIMESTAMP NOT NULL,                
                id_associato INT NOT NULL
             );{$charset_collate}";
    try{
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($query);   
        return true;
    } catch (Exception $ex) {
        _e($ex);
        return false;
    }      
}

function install_tabella_sezioni_interesse($wpdb, $charset_collate){
    $table = $wpdb->prefix.'sezioni_interesse';
    $query = "CREATE TABLE IF NOT EXISTS $table (
                ID INT NOT NULL auto_increment PRIMARY KEY,               
                nome_sezione TEXT NOT NULL,                
                id_associato INT NOT NULL
             );{$charset_collate}";
    try{
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($query);   
        return true;
    } catch (Exception $ex) {
        _e($ex);
        return false;
    }      
}


function drop_tabelle_associati(){
    global $wpdb;
    $wpdb->prefix = 'qe_';
    try{
        dropTabellaAssociati($wpdb);
        dropTabellaRinnovi($wpdb);
        dropTabellaSezioniInteresse($wpdb);
    } catch (Exception $ex) {
        _e($ex);        
        return false;
    }
}

function dropTabellaAssociati($wpdb){
    try{
            $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."associati;";
            $wpdb->query($query);
            return true;
        }
    catch(Exception $e){
        _e($e);
        return false;
    }
}

function dropTabellaRinnovi($wpdb){
    try{
            $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."rinnovi;";
            $wpdb->query($query);
            return true;
        }
    catch(Exception $e){
        _e($e);
        return false;
    }
}

function dropTabellaSezioniInteresse($wpdb){
    try{
            $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."sezioni_interesse;";
            $wpdb->query($query);
            return true;
        }
    catch(Exception $e){
        _e($e);
        return false;
    }
}

?>