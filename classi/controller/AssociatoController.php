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
    private $lDAO;
    
    function __construct() {
        $this->aDAO = new AssociatoDAO();
        $this->iDAO = new IndirizzoDAO();
        $this->irDAO = new IscrizioneRinnovoDAO();        
        $this->lDAO = new LocatorDAO();
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
    
    /**
     * La funzione restituisce un array di soli associati attivi
     * @return array
     */
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
    
    /**
     * La funzione restituisce le informazioni relative allo stato degli associati (attivi e scaduti)
     * @return int
     */
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
    
    
    /**
     * La funzione restituisce informazioni riguardo al numero di uomini e donne tra gli associati
     * @return int
     */
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
    
    /**
     * La funzione restituisce informazioni riguardo all'età degli associati
     * con un eventuale parametro si può sapere l'età di uomini e donne
     * @param type $sex
     * @return type
     */
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
    
    /**
     * La funzione restituisce informazioni riguardo alla tessera dell'associato (sostenitore, ordinario, VIP, onorario)
     * @return type
     */
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
    
    /**
     * La funzione restituisce la regione di provenienza dalla sigla della provincia
     * @param type $sigla
     * @return type
     */
    protected function getRegioneBySiglaProv($sigla){
        $codRegione = $this->lDAO->getCodRegioneBySiglaProv($sigla);
        return $this->lDAO->getNomeRegioneByCodRegione($codRegione);
    }
    
    public function getProvenienzaAssociati(){
        $associati = $this->getAssociatiAttivi();
        $arrayRegioni = array();
        
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            $indirizzi = $a->getIndirizzo();
            $siglaProv = "";
            foreach($indirizzi as $indirizzo){
                $i = new Indirizzo();
                $i = $indirizzo;
                
                $siglaProv = $i->getProv();
            }
            
            if($siglaProv != 'EE'){
                array_push($arrayRegioni, $this->getRegioneBySiglaProv($siglaProv));
            }
            else{
                array_push($arrayRegioni, 'ESTERO');
            }
        }
        
        
        sort($arrayRegioni);
        $arrayRegioni = array_count_values($arrayRegioni);
        arsort($arrayRegioni);
        
        return $arrayRegioni;
    }
    
    /**
     * La funzione restituisce un array composto da un nome e il relativo cap.
     * @return array
     */
    public function getCapAssociati(){
        $associati = $this->getAssociatiAttivi();
        $result = array();
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            $indirizzi = $a->getIndirizzo();
            $cap = array();
            
            foreach($indirizzi as $indirizzo){
                $i = new Indirizzo();
                $i = $indirizzo;
                
                $cap['addr'] =  str_replace("'", "\'", $i->getIndirizzo().' '.$i->getCivico().', '.$i->getCitta());
                $cap['cap'] = $i->getCap();
                $cap['prov'] = str_replace("'", "\'", $this->lDAO->getNomeProvinciaBySigla($i->getProv()));
            }
            
            if($cap['cap'] != 'xxx'){
                $cap['nome'] = str_replace("'", "\'", $a->getNome().' '.$a->getCognome());
                array_push($result, $cap);
            }
        }
        
        return $result;
    }
    
    public function getEmailAssociati(){
        $associati = $this->getAssociatiAttivi();
        $emails = array();
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            if($a->getEmail() != 'xxx@xxx.xx'){
                array_push($emails, $a->getEmail().', '.$a->getNome().' '.$a->getCognome());
            }
        }
        
        return $emails;
    }
    
    public function getProvenienzaAssociatiRegioni(){
        $associati = $this->getAssociatiAttivi();
        $regioni = array();        
        
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            $indirizzi = $a->getIndirizzo();
            $siglaProv = "";
            foreach($indirizzi as $indirizzo){
                $i = new Indirizzo();
                $i = $indirizzo;
                
                $siglaProv = $i->getProv();
            }
            
            $locator = array();            
            $nomeRegione = $this->getRegioneBySiglaProv($siglaProv);
            $locator[$nomeRegione] = $this->lDAO->getNomeProvinciaBySigla($siglaProv);
            array_push($regioni, $locator);            
        }        
        
        return $regioni;
        
    }
    
    public function getProvenienzaRegione($nomeRegione){
        
        $array = $this->getProvenienzaAssociatiRegioni();
        $regione = array();
        $regione[$nomeRegione] = array();
        
        foreach($array as $item){
            foreach($item as $k => $v){
                if($k == $nomeRegione){
                    array_push($regione[$nomeRegione], $v);
                }
            }
        }
        sort($regione[$nomeRegione]);
        
        $regione[$nomeRegione] = array_count_values($regione[$nomeRegione]);
        
        return $regione;
    }
    
    
    
}
