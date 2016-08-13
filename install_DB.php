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
        install_tabella_indirizzo($wpdb, $charset_collate);
        
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
                nome TEXT NOT NULL,
                cognome TEXT NOT NULL,
                sesso VARCHAR(1) NOT NULL,
                luogo_nascita TEXT NOT NULL,
                data_nascita DATE NOT NULL,               
                telefono VARCHAR(30),
                email TEXT NOT NULL,
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

function install_tabella_indirizzo($wpdb, $charset_collate){
    $table = $wpdb->prefix.'indirizzi';
    $query = "CREATE TABLE IF NOT EXISTS $table (
                ID INT NOT NULL auto_increment PRIMARY KEY,
                id_associato INT NOT NULL,
                indirizzo TEXT NOT NULL,                
                civico VARCHAR(10) NOT NULL,
                cap TEXT NOT NULL,
                citta TEXT NOT NULL,
                prov TEXT NOT NULL,
                FOREIGN KEY (id_associato) REFERENCES qe_associati(ID)
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
    $table = $wpdb->prefix.'iscrizione_rinnovi';
    $query = "CREATE TABLE IF NOT EXISTS $table (
                ID INT NOT NULL auto_increment PRIMARY KEY,  
                id_associato INT NOT NULL,
                numero_tessera INT NOT NULL,
                data_iscrizione TIMESTAMP,
                data_rinnovo TIMESTAMP,
                tipo_socio VARCHAR(20) NOT NULL,                
                modulo TEXT,
                note TEXT,
                FOREIGN KEY (id_associato) REFERENCES qe_associati(ID)
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
        dropTabellaRinnovi($wpdb);
        dropTabellaIndirizzi($wpdb);
        dropTabellaAssociati($wpdb);        
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
            $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."iscrizione_rinnovi;";
            $wpdb->query($query);
            return true;
        }
    catch(Exception $e){
        _e($e);
        return false;
    }
}

function dropTabellaIndirizzi($wpdb){
    try{
            $query = "DROP TABLE IF EXISTS ".$wpdb->prefix."indirizzi;";
            $wpdb->query($query);
            return true;
        }
    catch(Exception $e){
        _e($e);
        return false;
    }
}

?>