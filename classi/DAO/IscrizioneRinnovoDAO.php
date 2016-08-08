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
    public function saveIscrizioneRinnovo(IscrizioneRinnovo $ir){
        try{
            $this->wpdb->insert(
                    $this->table,
                    array(
                        'id_associato' => $ir->getIdAssociato(),
                        'data_iscrizione' => $ir->getDataIscrizione(),
                        'numero_tessera' => $ir->getNumeroTessera(),
                        'data_rinnovo' => $ir->getDataRinnovo(),
                        'tipo_socio' => $ir->getTipoSocio(),                        
                        'modulo' => $ir->getModulo()
                    ),
                    array('%d', '%s', '%s', '%s', '%s', '%s')
                );
            return $this->wpdb->insert_id;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione restituisce un oggetto IscrizioneRinnovo dato un id associato
     * @param type $idAssociato
     * @return \IscrizioneRinnovo|boolean
     */
    public function getIScrizioneRinnovo($idAssociato){
        try{
            $query = "SELECT * FROM ".$this->table." WHERE id_associato = ".$idAssociato;
            $temp = $this->wpdb->get_row($query);
            if($temp != null){
                $ir = new IscrizioneRinnovo();
                $ir->setID($temp->ID);
                $ir->setIdAssociato($temp->id_associato);
                $ir->setDataIscrizione($temp->data_iscrizione);
                $ir->setNumeroTessera($temp->numero_tessera);
                $ir->setDataRinnovo($temp->data_rinnovo);
                $ir->setModulo($temp->modulo);
                
                return $ir;
            }            
            return null;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
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
     * La funzione 
     * @param IscrizioneRinnovo $ir
     * @return boolean
     */
    public function updateIscrizioneRinnovo(IscrizioneRinnovo $ir){
        try{
            $this->wpdb->update(
                    $this->table,
                    array(
                        'numero_tessera' => $ir->getNumeroTessera(),
                        'data_iscrizione' => $ir->getDataIscrizione(),
                        'data_rinnovo' => $ir->getDataRinnovo(),
                        'tipo_socio' => $ir->getTipoSocio(),
                        'modulo' => $ir->getModulo()
                    ),
                    array('ID' => $ir->getID()),
                    array('%s', '$%s', '%s', '%s', '%s'),
                    array('%d')
                );
            return true;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }

}
