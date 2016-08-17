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
     * La funzione salva un rinnovo nel database
     * @param IscrizioneRinnovo $ir
     * @return boolean
     */
    public function saveRinnovo(IscrizioneRinnovo $ir){
        if($this->irDAO->saveRinnovo($ir) == false){
            return false;
        }
        return true;
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
     * La funzione restituisce un associato passato l'id utente wordpress
     * @param type $idUtenteWp
     * @return type
     */
    public function getAssociatoByIdUtenteWp($idUtenteWp){
        $idAssociato = $this->aDAO->getIdAssociato($idUtenteWp);
        return $this->getAssociatoByIdAssociato($idAssociato);
    }
    
    /**
     * La funzione restituisce un array di associati
     * @return array
     */
    public function getAssociatiList(){
        //ottengo un array di ID di associati
        $ids = $this->irDAO->getIdAssociati();
        
        
        $associati = array();
        if(count($ids) > 0){
            foreach($ids as $id){
                $associato = $this->getAssociatoByIdAssociato($id);               
                array_push($associati, $associato);
            }
        }
        
        return $associati;
    }
    
    public function getLast5Associati(){
        //ottengo un array di ID di associati
        $ids = $this->irDAO->getLast5IdAssociati();
        
        
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
     * La funzione aggiorna solo i campi dettaglio associato
     * @param Associato $a
     * @return boolean
     */
    public function updateAssociatoDettagli(Associato $a){
        if($this->aDAO->updateAssociato($a) == false){
            return false;
        }   
        return true;
    }
    
    /**
     * La funzione aggiorna solo i campi indirizzo associato
     * @param Indirizzo $i
     * @return boolean
     */
    public function updateAssociatoIndirizzo(Indirizzo $i){
        if($this->iDAO->updateIndirizzo($i) == false){
            return false;
        }
        return true;
    }
    
    /**
     * La funzione aggiorna solo i campi iscrizione rinnovo di un associato
     * @param IscrizioneRinnovo $ir
     * @return boolean
     */
    public function updateAssociatoIscrizioneRinnovo(IscrizioneRinnovo $ir){
        if($ir->getDataRinnovo() == null){
            
            if($this->irDAO->updateIscrizione($ir) == false){
                return false;
            } 
        }
        else if($ir->getDataIscrizione() == null){
            
            if($this->irDAO->updateRinnovo($ir) == false){
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
    
    
    
    /*** STATISTICHE ***/
    
    public function getAssociatiAttivi(){
        //ottengo tutti gli associati
        $associati = $this->getAssociatiList();
                
        $attivi = array();
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            $irs = $a->getIscrizioneRinnovo();
            $ultimaData = "";
            foreach($irs as $item){
                $ir = new IscrizioneRinnovo();
                $ir = $item;
                if($ir->getDataIscrizione() != '0000-00-00 00:00:00'){
                    $ultimaData = $ir->getDataIscrizione();
                }
                else{
                    $ultimaData = $ir->getDataRinnovo();
                }
            }
            
            if(isAssociatoScaduto($ultimaData)){
                
            }
            else{
                array_push($attivi, $associato);
            }
        }
        
        return $attivi;
    }
    
    public function getStatusAssociati(){
        //ottengo tutti gli associati
        $associati = $this->getAssociatiList();
        $countAttivi = 0;
        $countScaduti = 0;
        
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            $irs = $a->getIscrizioneRinnovo();
            $ultimaData = "";
            foreach($irs as $item){
                $ir = new IscrizioneRinnovo();
                $ir = $item;
                if($ir->getDataIscrizione() != '0000-00-00 00:00:00'){
                    $ultimaData = $ir->getDataIscrizione();
                }
                else{
                    $ultimaData = $ir->getDataRinnovo();
                }
            }
            
            if(isAssociatoScaduto($ultimaData)){
                $countScaduti++;
            }
            else{
                $countAttivi++;
            }
        }
        
        $result['Attivi'] = $countAttivi;
        $result['Scaduti'] = $countScaduti;
        
        return $result;
    }
    
    
    public function getSessoAssociati(){
        $associati = $this->getAssociatiAttivi();
        $countM = 0;
        $countF = 0;
        
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            if($a->getSesso() == 'm'){
                $countM++;
            }
            else{
                $countF++;
            }
        }
        
        $result['Uomini'] = $countM;
        $result['Donne'] = $countF;
        
        return $result;
    }
    
    public function getEtaAssociati($sex=null){
        $associati = $this->getAssociatiAttivi();
        $annoCorrente = date('Y');
        $total = array();
        
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            if($sex != null){
                if($a->getSesso() == $sex){
                    $temp = explode('-', $a->getDataNascita());
                    $eta = intval($annoCorrente) - intval($temp[0]);
                    array_push($total, $eta);
                }
            }
            else{
            
                $temp = explode('-', $a->getDataNascita());
                $eta = intval($annoCorrente) - intval($temp[0]);

                array_push($total, $eta);
            }
        }
        
        $media = 0;
        for($i=0; $i < count($total); $i++){
            $media += $total[$i];
        }
        
        sort($total);
        
        $media = $media / count($total);       
        
        $result['dati'] = array_count_values($total);
        $result['media'] = round($media,2);
        
        return $result;
    }
    
    
    public function getTipoAssociato(){
         //ottengo tutti gli associati
        $associati = $this->getAssociatiAttivi(); 
        $result = array();
        
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            $irs = $a->getIscrizioneRinnovo();
            $tipoSocio = "";
            foreach($irs as $item){
                $ir = new IscrizioneRinnovo();
                $ir = $item;
                $tipoSocio = getValueTipoSocio($ir->getTipoSocio());
            }
            
            array_push($result, $tipoSocio);
            
        }
        
        //sort($result);        
        return array_count_values($result);
    }
}
