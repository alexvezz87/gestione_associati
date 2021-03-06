<?php

/**
 * Description of IscrizioneRinnovoDAO
 *
 * @author Alex
 */
class IscrizioneRinnovoDAO {
    private $wpdb;
    private $table;
    
    function __construct() {
        global $wpdb;
        $wpdb->prefix = 'qe_';
        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix.'iscrizione_rinnovi';
    }
    
    /**
     * La funzione salva un oggetto IscrizioneRinnovo associato ad un utente associato
     * @param IscrizioneRinnovo $ir
     * @return boolean
     */
    public function saveIscrizione(IscrizioneRinnovo $ir){
        
        try{
            $this->wpdb->insert(
                    $this->table,
                    array(
                        'id_associato' => $ir->getIdAssociato(),
                        'data_iscrizione' => $ir->getDataIscrizione(),
                        'data_rinnovo' => '0000-00-00 00:00:00',
                        'numero_tessera' => $ir->getNumeroTessera(),                        
                        'tipo_socio' => $ir->getTipoSocio(),                        
                        'modulo' => $ir->getModulo(),
                        'note' => $ir->getNote(),
                        'mail_scadenza' => 0,
                        'mail_scaduta' => 0
                    ),
                    array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d')
                );
            return $this->wpdb->insert_id;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione salva un rinnovo
     * @param IscrizioneRinnovo $ir
     * @return boolean
     */
    public function saveRinnovo(IscrizioneRinnovo $ir){
        try{
            $this->wpdb->insert(
                    $this->table,
                    array(
                        'id_associato' => $ir->getIdAssociato(),
                        'data_rinnovo' => $ir->getDataRinnovo(),
                        'data_iscrizione' => '0000-00-00 00:00:00',
                        'numero_tessera' => $ir->getNumeroTessera(),                        
                        'tipo_socio' => $ir->getTipoSocio(),                        
                        'modulo' => $ir->getModulo(),
                        'note' => $ir->getNote(),
                        'mail_scadenza' => 0,
                        'mail_scaduta' => 0
                    ),
                    array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d')
                );
            return $this->wpdb->insert_id;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
   /**
    * La funzione restituisce un array di oggetti IscrizioneRinnovo dato un id associato
    * @param type $idAssociato
    * @return array
    */
    public function getIScrizioneRinnovo($idAssociato){
        try{
            $query = "SELECT * FROM ".$this->table." WHERE id_associato = ".$idAssociato;
            $temp = $this->wpdb->get_results($query);
            if(count($temp) > 0){
                $irs = array();
                foreach($temp as $item){                    
                    //aggiungo un oggetto iscrizione rinnovo all'array
                    array_push($irs, $this->setFields($item));
                }
                return $irs;
            }            
            return null;
        } catch (Exception $ex) {
            _e($ex);
            return null;
        }
    }
    
    /**
     * Ottengo un oggetto Iscrizione/rinnovo per un determinato campo
     * @param type $ID
     * @return type
     */
    public function getIscrizioneRinnovoByID($ID){
        try{
            $result = null;
            $query = "SELECT * FROM ".$this->table." WHERE ID = ".$ID;
            $temp = $this->wpdb->get_row($query);
            
            if($temp != null){
                //imposto i campi di iscrizione/rinnovo
                $result = $this->setFields($temp);
            }
            return $result;
        } catch (Exception $ex) {
            _e($ex);
            return null;
        }
    }
    
    /**
     * Funzione che setta i campi di un nuovo elemento iscrizione rinnovo
     * @param type $item
     * @return \IscrizioneRinnovo
     */
    protected function setFields($item){
        $ir = new IscrizioneRinnovo();
        $ir->setID($item->ID);
        $ir->setIdAssociato($item->id_associato);                    
        isset($item->data_iscrizione) ? $ir->setDataIscrizione($item->data_iscrizione) : $ir->setDataIscrizione(null);                                       
        $ir->setNumeroTessera($item->numero_tessera);
        isset($item->data_rinnovo) ?  $ir->setDataRinnovo($item->data_rinnovo) :  $ir->setDataRinnovo(null);                   
        $ir->setModulo($item->modulo);
        $ir->setNote($item->note);
        $ir->setTipoSocio($item->tipo_socio);
        $ir->setMailScadenza($item->mail_scadenza);
        $ir->setMailScaduta($item->mail_scaduta);        
        return $ir;
    }
    
    /**
     * La funzione elimina un oggetto IscrizioneRinnovo dal database associato ad un id associato
     * @param type $idAssociato
     * @return boolean
     */
    public function deleteIscrizioneRinnovo($idAssociato){
        try{
            return $this->wpdb->delete($this->table, array('id_associato' => $idAssociato));            
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione aggiorna un'iscrizione
     * @param IscrizioneRinnovo $ir
     * @return boolean
     */
    public function updateIscrizione(IscrizioneRinnovo $ir){       
        try{
            $this->wpdb->update(
                    $this->table,
                    array(
                        'numero_tessera' => $ir->getNumeroTessera(),
                        'data_iscrizione' => $ir->getDataIscrizione(), 
                        'data_rinnovo' => '0000-00-00 00:00:00',
                        'tipo_socio' => $ir->getTipoSocio(),                        
                        'note' => $ir->getNote()                        
                    ),
                    array('ID' => $ir->getID()),
                    array('%s', '%s', '%s', '%s', '%s'),
                    array('%d')
                );
            return true;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * LA funzione aggiorna un rinnovo
     * @param IscrizioneRinnovo $ir
     * @return boolean
     */
    public function updateRinnovo(IscrizioneRinnovo $ir){
        try{
            $this->wpdb->update(
                    $this->table,
                    array(
                        'numero_tessera' => $ir->getNumeroTessera(),
                        'data_rinnovo' => $ir->getDataRinnovo(), 
                        'data_iscrizione' => '0000-00-00 00:00:00',
                        'tipo_socio' => $ir->getTipoSocio(),
                        //'modulo' => $ir->getModulo(),
                        'note' => $ir->getNote()                        
                    ),
                    array('ID' => $ir->getID()),
                    array('%s', '%s', '%s', '%s', '%s'),
                    array('%d')
                );
            return true;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione aggiorna il campo di invio
     * @param IscrizioneRinnovo $ir
     * @return boolean
     */
    public function UpdateMailScadenza(IscrizioneRinnovo $ir){
        try{
            $this->wpdb->update(
                    $this->table,
                    array(                       
                        'data_iscrizione' => $ir->getDataIscrizione(), 
                        'data_rinnovo' => $ir->getDataRinnovo(),
                        'mail_scadenza' => 1          
                    ),
                    array('ID' => $ir->getID()),
                    array('%s', '%s', '%d'),
                    array('%d')
                );
            return true;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    public function updateMailScaduta(IscrizioneRinnovo $ir){
       try{
            $this->wpdb->update(
                    $this->table,
                    array(                       
                        'data_iscrizione' => $ir->getDataIscrizione(), 
                        'data_rinnovo' => $ir->getDataRinnovo(),
                        'mail_scaduta' => 1          
                    ),
                    array('ID' => $ir->getID()),
                    array('%s', '%s', '%d'),
                    array('%d')
                );
            return true;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    
    /**
     * La funzione restituisce il numero più alto 
     * @return int
     */
    public function getUltimaTessera(){
        try{
            $query = "SELECT MAX(numero_tessera) FROM ".$this->table;
            $result = $this->wpdb->get_var($query);
            
            if($result == null){
                $result = 0;
            }           
            
            return intval($result);
            
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione restituisce un array di id associati ordinati per numero tessera 
     * @return boolean
     */
    public function getIdAssociati(){
        try{
            $query = "SELECT DISTINCT id_associato FROM ".$this->table." ORDER BY numero_tessera ASC";
            return $this->wpdb->get_col($query); 
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * Ottengo gli id degli ultimi 5 associati
     * @return boolean
     */
    public function getLast5IdAssociati(){
        try{
            $query = "SELECT DISTINCT id_associato FROM ".$this->table." ORDER BY data_iscrizione DESC, numero_tessera DESC LIMIT 5";
            return $this->wpdb->get_col($query); 
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }

}
