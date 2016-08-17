<?php

/**
 * Description of AssociatoDAO
 *
 * @author Alex
 */
class AssociatoDAO {
    private $wpdb;
    private $table;
    
    function __construct() {
        global $wpdb;
        $wpdb->prefix = 'qe_';
        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix.'associati'; 
    }
    
    /**
     * La funzione salva un oggetto Associato nel database e restituisce il suo ID
     * @param Associato $a
     * @return boolean
     */
    public function saveAssociato(Associato $a){
        try{           
            $this->wpdb->insert(
                    $this->table,
                    array(
                        'id_utente_wp' => $a->getIdUtenteWP(),
                        'nome' => $a->getNome(),
                        'cognome' => $a->getCognome(),
                        'sesso' => $a->getSesso(),
                        'luogo_nascita' => $a->getLuogoNascita(),
                        'data_nascita' =>  $a->getDataNascita(),
                        'telefono' => $a->getTelefono(),
                        'email' => $a->getEmail()
                    ),
                    array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
                );
            return $this->wpdb->insert_id;            
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
   /**
    * La funzione restituisce un associato passando il suo ID
    * @param type $ID
    * @return \Associato
    */
    public function getAssociato($ID){
        try{
            $query = "SELECT * FROM ".$this->table." WHERE ID = ".$ID;
            $temp = $this->wpdb->get_row($query);
            if($temp != null){
                $a = new Associato();
                $a->setID($temp->ID);
                $a->setNome(stripslashes($temp->nome));
                $a->setCognome(stripslashes($temp->cognome));
                $a->setSesso($temp->sesso);
                $a->setLuogoNascita(stripslashes($temp->luogo_nascita));
                $a->setDataNascita($temp->data_nascita);
                $a->setTelefono($temp->telefono);
                $a->setEmail($temp->email);
                $a->setIdUtenteWP($temp->id_utente_wp);
                
                return $a;
            }
            return null;
            
        } catch (Exception $ex) {
            _e($ex);
            return null;
        }
    }
    
    /**
     * La funzione restituisce l'ID associato dato l'id di un utente wordpress
     * @param type $idUtenteWp
     * @return boolean
     */
    public function getIdAssociato($idUtenteWp){
        try{
            $query = "SELECT ID FROM ".$this->table." WHERE id_utente_wp = ".$idUtenteWp;
            return $this->wpdb->get_var($query);
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
        
    }
    
    
    /**
     * La funzione restituisce un array di ID associati
     * @return boolean|array
     */
    public function getAssociati(){
        try{
            $query = "SELECT ID FROM ".$this->table;
            return $this->wpdb->get_col($query);          
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione elimina un associato dal database
     * @param type $ID
     * @return boolean
     */
    public function deleteAssociato($ID){
        try{
            return $this->wpdb->delete($this->table, array('ID' => $ID));
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione aggiorna un associato passato per parametro
     * @param Associato $a
     * @return boolean
     */
    public function updateAssociato(Associato $a){        
        try{
            //Imposto il timezone
            date_default_timezone_set('Europe/Rome');
            $timestamp = $a->getDataNascita().' 00:00:00';           
            
            $this->wpdb->update(
                    $this->table,
                    array(
                        'nome' => $a->getNome(),
                        'cognome' => $a->getCognome(),
                        'sesso' => $a->getSesso(),
                        'luogo_nascita' => $a->getLuogoNascita(),
                        'data_nascita' => $timestamp,
                        'telefono' => $a->getTelefono(),
                        'email' => $a->getEmail(),
                        'id_utente_wp' => $a->getIdUtenteWP()
                    ),
                    array('ID' => $a->getID()),
                    array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d'),
                    array('%d')
                );
            
            return true;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione restituisce un array di id_utente_wp
     * @return type
     */
    public function getUtentiWpAssegnati(){
        try{
            $query = "SELECT id_utente_wp FROM ".$this->table;
            return $this->wpdb->get_col($query);
        } catch (Exception $ex) {
            _e($ex);
            return null;
        }
    }
    
}
