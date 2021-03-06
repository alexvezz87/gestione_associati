<?php

/**
 * Description of IndirizzoDAO
 *
 * @author Alex
 */
class IndirizzoDAO {
    private $wpdb;
    private $table;
    
    function __construct() {
        global $wpdb;        
        $wpdb->prefix = 'qe_';
        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix.'indirizzi';
    }
    
    /**
     * La funzione salva un indirizzo del DB
     * @param Indirizzo $i
     * @return boolean
     */
    public function saveIndirizzo(Indirizzo $i){
        try{
            $this->wpdb->insert(
                    $this->table,
                    array(
                        'indirizzo' => $i->getIndirizzo(),
                        'civico' => $i->getCivico(),
                        'cap' => $i->getCap(),
                        'citta' => $i->getCitta(),
                        'prov' => $i->getProv(),    
                        'id_associato' => $i->getIdAssociato()
                    ),
                    array('%s', '%s', '%s', '%s', '%s', '%d')
                );
            
            return $this->wpdb->insert_id;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione restituisce un array di indirizzi attraverso dei campi passati per parametro
     * @param type $parameters
     * @return array
     */
    public function getIndirizzo($parameters){
        //i parametri ricevuti possono essere:
        //1. id_associato --> Ricerca per Utente
        //2. cap --> Ricerca per cap
        //3. citta --> Ricerca per città
        //4. prov --> Ricerca per provincia     
        //sono contemplate ricerche multiple
        try{
            //Imposto la query
            $query = "SELECT * FROM ".$this->table." WHERE 1=1";
            foreach($parameters as $k => $v){
                if($k == 'id_associato'){
                    $query.=" AND ".$k." = ".$v; 
                }
                else{
                    $query.=" AND ".$k." = '".$v."'"; 
                }
            }
            
            $temp = $this->wpdb->get_results($query);
            if($temp != null && count($temp) > 0){
                $result = array();
                foreach($temp as $t){
                    $i = new Indirizzo();
                    $i->setCap($t->cap);
                    $i->setCitta(stripslashes($t->citta));
                    $i->setCivico($t->civico);
                    $i->setID($t->ID);
                    $i->setIdAssociato($t->id_associato);
                    $i->setIndirizzo(stripslashes($t->indirizzo));
                    $i->setProv($t->prov);
                    
                    array_push($result, $i);
                }
                return $result;
            }
            return null;
            
        } catch (Exception $ex) {
            _e($ex);
            return null;
        }
    }
   
    /**
     * La funzione elimina un indirizzo dal DB
     * @param type $idUtente
     * @return boolean
     */
    public function deleteIndirizzo($idAssociato){
        try{
            return $this->wpdb->delete($this->table, array('id_associato' => $idAssociato));            
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
    /**
     * La funzione aggiorna un indirizzo nel DB
     * @param Indirizzo $i
     * @return boolean
     */
    public function updateIndirizzo(Indirizzo $i){
        try{
            $this->wpdb->update(
                    $this->table,
                    array(
                        'indirizzo' => $i->getIndirizzo(),
                        'civico' => $i->getCivico(),
                        'cap' => $i->getCap(),
                        'citta' => $i->getCitta(),
                        'prov' => $i->getProv()
                    ),
                    array('id_associato' => $i->getIdAssociato()),
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
     * La funzione controlla se esiste un inidizzo che fa match con un associato
     * @param type $idAssociato
     * @return boolean
     */
    public function existsIndirizzo($idAssociato){
        try{
            $query = "SELECT ID FROM ".$this->table." WHERE id_associato = ".$idAssociato;
            if($this->wpdb->get_var($query) != null){
                return true;
            }
            return false;
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
}
