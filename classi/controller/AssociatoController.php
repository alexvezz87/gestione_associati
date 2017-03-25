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
    
    /**
     * La funzione ricevuto in ingresso l'array di iscrizione/rinnovo restituisce l'ultima data 
     * in cui l'iscrizione o il rinnovo è stato effettuato
     * @param type $irs
     * @return type
     */
    public function getUltimaIscrizione($irs){
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
        return $ultimaData;
    }
    
    public function getAssociatiInScadenza(){
        //ottengo tutti gli associati
        $associati = $this->getAssociatiList();    
        $inScadenza = array();
        
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;
            
            //ottengo l'ultima data in cui è stata rinnovata l'iscrizione
            $ultimaData = $this->getUltimaIscrizione($a->getIscrizioneRinnovo());
            
            if(getStatusAssociato($ultimaData) == 'IN SCADENZA'){
                array_push($inScadenza, $associato);
            }
        }
        
        return $inScadenza;
    }
    
    public function getAssociatiScaduti(){
        //ottengo tutti gli associati
        $associati = $this->getAssociatiList();    
        $scaduti = array();
        
        foreach($associati as $associato){
            $a = new Associato();
            $a = $associato;            
            
            $ultimaData = $this->getUltimaIscrizione($a->getIscrizioneRinnovo());
            
            if(getStatusAssociato($ultimaData) == 'SCADUTO'){
                array_push($scaduti, $associato);
            }
        }
        
        return $scaduti;
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
                array_push($emails, $a->getEmail().';'.$a->getNome().' '.$a->getCognome());
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
    
    /**
     * La funzione invia la mail di iscrizione in scadenza o iscrizione scaduta di un determinato associato a seconda dei parametri inseriti
     * @param type $mode
     * @param Associato $a
     * @return boolean
     */
    public function inviaMail($mode, Associato $a){
        //mode = 1 --> scadenza
        //mode = 2 --> scaduto
           
        //preparo il messaggio
        $title = "";
        $message = "";
        
        //ottengo la data della scadenza dell'ultima iscrizione    
        $irs = $a->getIscrizioneRinnovo();
        
        $data = getGiornoMese($this->getUltimaIscrizione($irs));
        
        //ottengo l'id dell'ultima iscrizione/rinnovo
        $lastID = 0;
        foreach($irs as $item){
            $ir = new IscrizioneRinnovo();
            $ir = $item;
            $lastID = $ir->getID();
        }
        
        if($mode == 1){
            $title = "Iscrizione in scadenza!";
            $message = '<p>Ciao '.$a->getNome().',<br>
                        sembra ieri, ma è quasi passato un anno dalla tua iscrizione a La
                        Quarta Era. Ti vogliamo ricordare che il prossimo '.$data.', la tua
                        iscrizione scadrà. Se hai dei dubbi sul rinnovo, dalla data di
                        scadenza hai a disposizione un mese per pensarci.';
        }
        else if($mode == 2){
            $title = "Iscrizione scaduta!";
            $message = '<p>Ciao '.$a->getNome().',<br>
                        ti vogliamo informare che la tua iscrizione a La Quarta Era è
                        scaduta il giorno <b>'.$data.'</b>. <br>
                        Se hai dei dubbi sul rinnovo, dalla data di scadenza hai a
                        disposizione <b>30 giorni</b> prima che la tua iscrizione decada
                        definitivamente.';            
        }
        
        $message.= 'Per qualsiasi
                    domanda ti rimandiamo alla pagina delle domande frequenti sul
                    nostro sito (<a class="moz-txt-link-freetext" href="https://quartaera.it/associazione/domande-frequenti/">https://quartaera.it/associazione/domande-frequenti/</a>),
                    oppure non esitare a contattarci.<br>
                    Se invece vuoi rinnovare per un altro anno, hai a disposizione due
                    strade.<br>
                    La prima consiste nel venirci a trovare in fiera e rinnovare
                    l\'iscrizione rivolgendoti ad un membro del consiglio direttivo. <br>
                    La seconda strada invece, è quella del rinnovo online. Abbiamo
                    sviluppato un sistema facile e veloce per rinnovare l\'iscrizione
                    in pochi click. Trovi tutto l\'occorrente a questa pagina: <br>
                    </p>
                    <p align="center"> <font size="+2"><a class="moz-txt-link-freetext" href="https://quartaera.it/rinnovo/">https://quartaera.it/rinnovo/</a></font><br>
                    </p>
                    <p>Compila il form e invia la richiesta. Successivamente il sistema
                    di pagamento di paypal ti permetterà di concludere l\'operazione. <br>
                    Se ci sono domande o dubbi, non esitare a chiedere. Siamo a tua
                    completa disposizione.<br>
                    <br>
                    Sperando in un riscontro positivo, ti auguriamo buona giornata.<br>
                    <br>
                    Amministrazione - La Quarta Era</p>';
        
        $firma = '<table border="0" width="100%">
                    <tr><td align="center">
                    <table border="0">
                     <tr> 
                      <td>
                        <img width="210" height="200" src="https://quartaera.it/wp-content/uploads/2016/02/LOGO-QUARTA-ERA.jpg">
                      </td>
                      <td valign="top">
                        <div style="margin-left:25px">
                         <span style="font-size:25px; font-weight:bold">La Quarta Era</span><br>
                         <strong>Associazione di Rievocazione Tolkieniana</strong><br>
                         SEDE<br>
                         Via Francesco Lolli, 9<br>
                         42122 - Reggio Emilia<br>
                         C.F. 91173910356<br>
                         web. <a href="http://www.quartaera.it">www.quartaera.it</a><br>
                         mail. <a href="mailto:info@quartaera.it">info@quartaera.it</a>
                        </div>
                      </td>
                     </tr>
                    </table>
                    </td></tr>
                    </table>';
        
        
        $message.='<br><br><br>'.$firma;
        
        //invio la mail
        try{
            //aggiungo il filtro per l'html sulla mail
            add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
            //invio la mail
            //test
            print_r($message);
            if(wp_mail($a->getEmail(), $title, $message)){
                
                //ufficiale
                //wp_mail($a->getEmail(), $title, $message);

                //se la mail viene inviata correttamente, devo aggiornare l'iscrizione/rinnovo
                //ottengo l'oggetto in questione
                $ir = $this->irDAO->getIscrizioneRinnovoByID($lastID);
                
                $update = false;
                if($mode == 1){                    
                    $update = $this->irDAO->UpdateMailScadenza($ir);                   
                }
                else if($mode == 2){                    
                    $update = $this->irDAO->updateMailScaduta($ir);                    
                }
                //aggiorno 
                if($update == true){
                    return true;
                }           
            }
            return false;
            
        } catch (Exception $ex) {
            _e($ex);
            return false;
        }
    }
    
}
