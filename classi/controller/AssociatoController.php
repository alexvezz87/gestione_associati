<?php

/**
 * Description of AssociatoController
 *
 * @author Alex
 */
class AssociatoController {
    private $aDAO;
    private $iDAO;
    private $irDAO;
    
    function __construct() {
        $this->aDAO = new AssociatoDAO();
        $this->iDAO = new IndirizzoDAO();
        $this->irDAO = new IscrizioneRinnovoDAO();        
    }

    /**
     * La funzione salva nel database un associato con indirizzo e modulo di iscrizione
     * @param Associato $a
     * @return boolean
     */
    public function saveAssociato(Associato $a){
        //salvo l'associato e ottengo l'id
        $idAssociato = $this->aDAO->saveAssociato($a);   
        if($idAssociato != false){
            
            //salvo indirizzo
            $i = new Indirizzo();
            $i = $a->getIndirizzo();
            $i->setIdAssociato($idAssociato);
            
            if($this->iDAO->saveIndirizzo($i) == false){
                //se sopraggiunge errore, elimino l'associato
                $this->aDAO->deleteAssociato($idAssociato);
                return false;
            }
            
            //salvo iscrizioneRinnovo
            $ir = new IscrizioneRinnovo();
            $ir = $a->getIscrizioneRinnovo();
            $ir->setIdAssociato($idAssociato);
            if($this->irDAO->saveIscrizione($ir) == false){
                //se sopraggiunge errore, elimino l'indirizzo
                $this->iDAO->deleteIndirizzo($idAssociato);
                //ed elimino l'associato
                $this->aDAO->deleteAssociato($idAssociato);
                return false;
            }
            
            return true;            
        }
    }
    
    /**
     * La funzione restituisce un oggetto Associato conoscendo l'ID associato
     * @param type $idAssociato
     * @return type
     */
    public function getAssociatoByIdAssociato($idAssociato){
        $associato = new Associato();
        $associato = $this->aDAO->getAssociato($idAssociato);   
        if($associato != null){
            //ottengo l'indirizzo
            $parameters['id_associato'] = $idAssociato;
            $associato->setIndirizzo($this->iDAO->getIndirizzo($parameters));
            //ottengo l'array di iscrizioneRinnovo
            $associato->setIscrizioneRinnovo($this->irDAO->getIScrizioneRinnovo($idAssociato));
        }
        return $associato;
    }
    
    /**
     * La funzione restituisce un 
     * @param type $idUtenteWp
     * @return type
     */
    public function getAssociatoByIdUtenteWp($idUtenteWp){
        $idAssociato = $this->aDAO->getIdAssociato($idUtenteWp);
        return $this->aDAO->getAssociato($idAssociato);
    }
    
    /**
     * La funzione restituisce un array di associati
     * @return array
     */
    public function getAssociatiList(){
        //ottengo un array di ID di associati
        $ids = $this->aDAO->getAssociati();
        $associati = array();
        if(count($ids) > 0){
            foreach($ids as $id){
                $associato = $this->getAssociatoByIdAssociato($id);               
                array_push($associati, $associato);
            }
        }
        
        return $associati;
    }
    
    /**
     * La funzione aggiorna un associato passato per parametro
     * @param Associato $a
     * @return boolean
     */
    public function updateAssociato(Associato $a){
        //aggiorno l'associato
        if($this->aDAO->updateAssociato($a) == false){
            return false;
        }        
        //aggiorno l'indirizzo
        if($this->iDAO->updateIndirizzo($a->getIndirizzo()) == false){
            return false;
        }
        //aggiorno le iscrizioniRinnovo
        foreach($a->getIscrizioneRinnovo() as $ir){
            if($this->irDAO->updateIscrizioneRinnovo($ir)== false){
                return false;
            }
        }
        
        return true;        
    }
    
    /**
     * La funzione elimina un associato dal database
     * @param type $idAssociato
     * @return boolean
     */
    public function deleteAssociato($idAssociato){
        
        //elimino l'indirizzo
        if($this->iDAO->deleteIndirizzo($idAssociato) == false){
            return false;
        }
        //elimino iscrizioneRinnovo
        if($this->irDAO->deleteIscrizioneRinnovo($idAssociato) == false){
            return false;
        }
        //elimino associato
        if($this->aDAO->deleteAssociato($idAssociato) == false){
            return false;
        }
        
        return true;        
    }
    
    /**
     * La funzione restituisce un array di utenti WP non assegnati ad associati
     * @return array
     */
    public function getUtentiWpNonAssegnati(){
        //ottengo l'array degli utenti già assegnati
        $wpAssegnati = $this->aDAO->getUtentiWpAssegnati();
        //ottengo tutti gli utenti
        $args = array('fields' => 'all', 'orderby' => 'display_name', 'order' => 'ASC');        
        $usersWp = get_users($args);
        
        $results = array();        
        
        for($i=0; $i < count($usersWp); $i++){           
            for($j=0; $j < count($wpAssegnati); $j++){
               if($usersWp[$i]->ID == $wpAssegnati[$j]){
                   $usersWp[$i]->ID = false;                   
               }
            }
        }
        
        for($i=0; $i < count($usersWp); $i++){
            $temp = array();
            if($usersWp[$i]->ID != false){
               $results[$usersWp[$i]->ID] = $usersWp[$i]->user_firstname.' '.$usersWp[$i]->user_lastname; 
            }
        }
        
        return $results;
        
    }
    
    /**
     * La funzione suggerisce il numero della prossima tessera da inserire
     * @return type
     */
    public function suggerisciProssimaTessera(){
        $ultimaTessera = $this->irDAO->getUltimaTessera();
        return $ultimaTessera+1;
    }
    
    
}
