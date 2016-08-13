<?php
/**
 * Description of AssociatoView
 *
 * @author Alex
 */
class AssociatoView extends PrinterView {
    private $province;
    private $controller;
    private $form, $label;
    
    function __construct() {
        //istanzio le variabili del padre
        parent::__construct();
        
        //inserisco tutte le variabili
        global $FORM_NOME, $FORM_COGNOME, $FORM_SESSO, $FORM_LUOGO_NASCITA, $FORM_DATA_NASCITA, $FORM_TELEFONO, $FORM_EMAIL, $FORM_UTENTE_WP;
        global $LABEL_NOME, $LABEL_COGNOME, $LABEL_SESSO, $LABEL_LUOGO_NASCITA, $LABEL_DATA_NASCITA, $LABEL_TELEFONO, $LABEL_EMAIL, $LABEL_UTENTE_WP;
        global $FORM_INDIRIZZO, $LABEL_INDIRIZZO, $FORM_CIVICO, $LABEL_CIVICO, $FORM_CAP, $LABEL_CAP, $FORM_CITTA, $LABEL_CITTA, $FORM_PROV, $LABEL_PROV;
        global $FORM_NUM_TESSERA, $FORM_DATA_ISCRIZIONE, $FORM_DATA_RINNOVO, $FORM_TIPO_SOCIO, $FORM_MODULO, $FORM_NOTE;
        global $LABEL_NUM_TESSERA, $LABEL_DATA_ISCRIZIONE, $LABEL_DATA_RINNOVO, $LABEL_TIPO_SOCIO, $LABEL_MODULO, $LABEL_NOTE;
        global $FORM_SUBMIT_ASSOCIATO, $LABEL_SUBMIT_ASSOCIATO;
        
        //associato
        $this->form['nome'] = $FORM_NOME;
        $this->form['cognome'] = $FORM_COGNOME;
        $this->form['sesso'] = $FORM_SESSO;
        $this->form['luogoNascita'] = $FORM_LUOGO_NASCITA;
        $this->form['dataNascita'] = $FORM_DATA_NASCITA;
        $this->form['telefono'] = $FORM_TELEFONO;
        $this->form['email'] = $FORM_EMAIL;
        $this->form['utenteWP'] = $FORM_UTENTE_WP;
        
        //indirizzo
        $this->form['indirizzo'] = $FORM_INDIRIZZO;
        $this->form['civico'] = $FORM_CIVICO;
        $this->form['cap'] = $FORM_CAP; 
        $this->form['citta'] = $FORM_CITTA;
        $this->form['prov'] = $FORM_PROV;
        
        //iscrizioneRinnovo
        $this->form['numTessera'] = $FORM_NUM_TESSERA;
        $this->form['dataIscrizione'] = $FORM_DATA_ISCRIZIONE;
        $this->form['dataRinnovo'] = $FORM_DATA_RINNOVO;
        $this->form['tipoSocio'] = $FORM_TIPO_SOCIO;
        $this->form['modulo'] = $FORM_MODULO;
        $this->form['submit'] = $FORM_SUBMIT_ASSOCIATO;
        $this->form['note'] = $FORM_NOTE;
        
        $this->label['nome'] = $LABEL_NOME;
        $this->label['cognome'] = $LABEL_COGNOME;
        $this->label['sesso'] = $LABEL_SESSO;
        $this->label['luogoNascita'] = $LABEL_LUOGO_NASCITA;
        $this->label['dataNascita'] = $LABEL_DATA_NASCITA;
        $this->label['telefono'] = $LABEL_TELEFONO;
        $this->label['email'] = $LABEL_EMAIL;
        $this->label['utenteWP'] = $LABEL_UTENTE_WP;
        $this->label['indirizzo'] = $LABEL_INDIRIZZO;
        $this->label['civico'] = $LABEL_CIVICO;
        $this->label['cap'] = $LABEL_CAP; 
        $this->label['citta'] = $LABEL_CITTA;
        $this->label['prov'] = $LABEL_PROV;
        $this->label['numTessera'] = $LABEL_NUM_TESSERA;
        $this->label['dataIscrizione'] = $LABEL_DATA_ISCRIZIONE;
        $this->label['dataRinnovo'] = $LABEL_DATA_RINNOVO;
        $this->label['tipoSocio'] = $LABEL_TIPO_SOCIO;
        $this->label['modulo'] = $LABEL_MODULO;
        $this->label['submit'] = $LABEL_SUBMIT_ASSOCIATO;
        $this->label['note'] = $LABEL_NOTE;
        
        $this->province = array(
            'AG' => 'Agrigento',
            'AL' => 'Alessandria',
            'AN' => 'Ancona',
            'AO' => 'Aosta',
            'AR' => 'Arezzo',
            'AP' => 'Ascoli Piceno',
            'AT' => 'Asti',
            'AV' => 'Avellino',
            'BA' => 'Bari',
            'BT' => 'Barletta-Andria-Trani',
            'BL' => 'Belluno',
            'BN' => 'Benevento',
            'BG' => 'Bergamo',
            'BI' => 'Biella',
            'BO' => 'Bologna',
            'BZ' => 'Bolzano',
            'BS' => 'Brescia',
            'BR' => 'Brindisi',
            'CA' => 'Cagliari',
            'CL' => 'Caltanissetta',
            'CB' => 'Campobasso',
            'CI' => 'Carbonia-Iglesias',
            'CE' => 'Caserta',
            'CT' => 'Catania',
            'CZ' => 'Catanzaro',
            'CH' => 'Chieti',
            'CO' => 'Como',
            'CS' => 'Cosenza',
            'CR' => 'Cremona',
            'KR' => 'Crotone',
            'CN' => 'Cuneo',
            'EN' => 'Enna',
            'FM' => 'Fermo',
            'FE' => 'Ferrara',
            'FI' => 'Firenze',
            'FG' => 'Foggia',
            'FC' => 'Forlì-Cesena',
            'FR' => 'Frosinone',
            'GE' => 'Genova',
            'GO' => 'Gorizia',
            'GR' => 'Grosseto',
            'IM' => 'Imperia',
            'IS' => 'Isernia',
            'SP' => 'La Spezia',
            'AQ' => 'L\'Aquila',
            'LT' => 'Latina',
            'LE' => 'Lecce',
            'LC' => 'Lecco',
            'LI' => 'Livorno',
            'LO' => 'Lodi',
            'LU' => 'Lucca',
            'MC' => 'Macerata',
            'MN' => 'Mantova',
            'MS' => 'Massa-Carrara',
            'MT' => 'Matera',
            'ME' => 'Messina',
            'MI' => 'Milano',
            'MO' => 'Modena',
            'MB' => 'Monza e della Brianza',
            'NA' => 'Napoli',
            'NO' => 'Novara',
            'NU' => 'Nuoro',
            'OT' => 'Olbia-Tempio',
            'OR' => 'Oristano',
            'PD' => 'Padova',
            'PA' => 'Palermo',
            'PR' => 'Parma',
            'PV' => 'Pavia',
            'PG' => 'Perugia',
            'PU' => 'Pesaro e Urbino',
            'PE' => 'Pescara',
            'PC' => 'Piacenza',
            'PI' => 'Pisa',
            'PT' => 'Pistoia',
            'PN' => 'Pordenone',
            'PZ' => 'Potenza',
            'PO' => 'Prato',
            'RG' => 'Ragusa',
            'RA' => 'Ravenna',
            'RC' => 'Reggio Calabria',
            'RE' => 'Reggio Emilia',
            'RI' => 'Rieti',
            'RN' => 'Rimini',
            'RM' => 'Roma',
            'RO' => 'Rovigo',
            'SA' => 'Salerno',
            'VS' => 'Medio Campidano',
            'SS' => 'Sassari',
            'SV' => 'Savona',
            'SI' => 'Siena',
            'SR' => 'Siracusa',
            'SO' => 'Sondrio',
            'TA' => 'Taranto',
            'TE' => 'Teramo',
            'TR' => 'Terni',
            'TO' => 'Torino',
            'OG' => 'Ogliastra',
            'TP' => 'Trapani',
            'TN' => 'Trento',
            'TV' => 'Treviso',
            'TS' => 'Trieste',
            'UD' => 'Udine',
            'VA' => 'Varese',
            'VE' => 'Venezia',
            'VB' => 'Verbano-Cusio-Ossola',
            'VC' => 'Vercelli',
            'VR' => 'Verona',
            'VV' => 'Vibo Valentia',
            'VI' => 'Vicenza',
            'VT' => 'Viterbo',
        );
        
        $this->controller = new AssociatoController();
    }
    
    
    /**
     * Funzione che stampa i campi per l'inserimento dell'indirizzo
     */
    public function printIndirizzoForm(){        
        
        echo '<h4>Indirizzo</h4>';
        parent::printTextFormField($this->form['indirizzo'], $this->label['indirizzo'], true);
        parent::printTextFormField($this->form['civico'], $this->label['civico'], true);
        parent::printTextFormField($this->form['cap'], $this->label['cap'], true);
        parent::printTextFormField($this->form['citta'], $this->label['citta'], true);
        parent::printSelectFormField($this->form['prov'], $this->label['prov'], $this->province, true);  
    }
    
    /**
     * Funzione che stampa i campi dettaglio di inserimento di un'iscrizione
     */
    public function printIscrizione(){
        echo '<h4>Iscrizione</h4>';
        parent::printNumberFormField($this->form['numTessera'], $this->label['numTessera'], true, $this->controller->suggerisciProssimaTessera());
        parent::printDateFormField($this->form['dataIscrizione'], $this->label['dataIscrizione'], true);
        $tipoSocio = array('1' => 'Sostenitore', '2' => 'Ordinario', '3' => 'VIP');
        parent::printSelectFormField($this->form['tipoSocio'], $this->label['tipoSocio'], $tipoSocio, true);
        parent::printInputFileFormField($this->form['modulo'], $this->label['modulo'], true);
        parent::printTextAreaFormField($this->form['note'], $this->label['note']);
    }
    
    /**
     * Funzione che stampa a video il form di add associato
     */
    public function printAddAssociatoForm(){        
    ?>
         <form class="form-horizontal" role="form" action="<?php echo curPageURL() ?>" name="form-associato" method="POST" enctype="multipart/form-data">
            <div class="col-sm-6">
                <?php parent::printTextFormField($this->form['nome'], $this->label['nome'], true) ?>
                <?php parent::printTextFormField($this->form['cognome'], $this->label['cognome'], true) ?>
                <?php
                    $sesso = array('m' => 'Maschio', 'f' => 'Femmina');
                    parent::printRadioFormField($this->form['sesso'], $this->label['sesso'], $sesso, true);                    
                ?>
                <?php parent::printTextFormField($this->form['luogoNascita'], $this->label['luogoNascita'], true) ?>
                <?php parent::printDateBirthdayFormField($this->form['dataNascita'], $this->label['dataNascita'], true) ?>
                <?php parent::printTextFormField($this->form['telefono'], $this->label['telefono']) ?>
                <?php parent::printEmailFormField($this->form['email'], $this->label['email']) ?>
                <?php  
                    $utentiWp = $this->controller->getUtentiWpNonAssegnati();                    
                    parent::printSelectFormField($this->form['utenteWP'], $this->label['utenteWP'], $utentiWp);
                ?>
            </div>
            <div class="clear"></div>
            <div class="col-sm-6">
                <?php $this->printIndirizzoForm(); ?>
            </div>
            <div class="clear"></div>
            <div class="col-sm-6">
                <?php $this->printIscrizione() ?>
            </div>
            <div class="clear"></div>
            <?php parent::printSubmitFormField($this->form['submit'], $this->label['submit']) ?>
            <div class="clear"></div>
        </form>
    <?php       
        
    }
    
    
    public function listenerAddAssociato(){
        
        if(isset($_POST[$this->form['submit']])){
            //print_r($_POST);            
            
            //In primis, salvo il file con wordpress
            $upload = wp_upload_bits($_FILES[$this->form['modulo']]["name"], null, file_get_contents($_FILES[$this->form['modulo']]["tmp_name"]));
            
            //print_r($upload);
            
            if($upload['error'] != false){
               parent::printErrorBoxMessage($upload['error']);              
               return;
            }
            
            //se l'upload è avvenuto correttamente continuo facendo un check dei campi obbligatori
            $associato = $this->checkAssociatoFields();            
            if($associato == null){
                //se ci sono stati errori concludo l'operazione                
                return;
            }
            
            $indirizzo = $this->checkIndirizzoFields();
            if($indirizzo == null){
                //se ci sono stati errori concludo l'operazione
                return;
            }
            $associato->setIndirizzo($indirizzo);
            
            $iscrizione = $this->checkIscrizioneRinnovoFields(0, $upload);
            if($iscrizione == null){
                //se ci sono stati errori concludo l'operazione
                return;
            }
            $associato->setIscrizioneRinnovo($iscrizione);
            //salvo l'associato
            if($this->controller->saveAssociato($associato) == false){
                parent::printErrorBoxMessage('Associato non salvato nel Sistema!');
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Associato salvato con successo!');
                //Pulisco la variabile $_POST
                unset($_POST);
                return;
            }
            
            
        }
    }
    
    /**
     * La funzione controlla i campi e restituisce un oggetto associato, null in caso di errori
     * @return \Associato
     */
    protected function checkAssociatoFields(){
        $errors = 0;
        //inizio con l'associato
        $a = new Associato();
        
        //nome - CAMPO OBBLIGATORIO
        if(isset($_POST[$this->form['nome']]) && trim($_POST[$this->form['nome']]) != ''){
            $a->setNome($_POST[$this->form['nome']]);
        }
        else{
            $errors++;
            parent::printErrorBoxMessage('Campo '.$this->label['nome'].' mancante o non corretto');
        }
        
        //cognome - CAMPO OBBLIGATORIO
        if(isset($_POST[$this->form['cognome']]) && trim($_POST[$this->form['cognome']]) != ''){
            $a->setCognome($_POST[$this->form['cognome']]);
        }
        else{
            $errors++;
            parent::printErrorBoxMessage('Campo '.$this->label['cognome'].' mancante o non corretto');
        }
        
        //sesso - CAMPO OBBLIGATORIO
        if(isset($_POST[$this->form['sesso']]) && trim($_POST[$this->form['sesso']]) != ''){
            $a->setSesso($_POST[$this->form['sesso']]);
        }
        else{
            $errors++;
            parent::printErrorBoxMessage('Campo '.$this->label['sesso'].' mancante o non corretto');
        }
        
        //dataNascita - CAMPO OBBLIGATORIO
        if(isset($_POST[$this->form['dataNascita'].'-d']) && isset($_POST[$this->form['dataNascita'].'-m']) && isset($_POST[$this->form['dataNascita'].'-y']) ){
            //conversione in timestamp
            $d = "";
            if(intval($_POST[$this->form['dataNascita'].'-d']) < 10){
                $d = '0'.$_POST[$this->form['dataNascita'].'-d'];
            }
            else{
                 $d = ''.$_POST[$this->form['dataNascita'].'-d'];
            }
            $m = $_POST[$this->form['dataNascita'].'-m'];
            $y = $_POST[$this->form['dataNascita'].'-y'];
            
            //$dtime = DateTime::createFromFormat("d/m/Y H:i", $d."/".$m."/".$y." 00:00");
            $timestamp = date($y.'-'.$m.'-'.$d);
            
            $a->setDataNascita($timestamp);
        }
        else{
            $errors++;
            parent::printErrorBoxMessage('Campo '.$this->label['dataNascita'].' mancante o non corretto');
        }
        
        //luogoNascita - CAMPO OBBLIGATORIO
        if(isset($_POST[$this->form['luogoNascita']]) && trim($_POST[$this->form['luogoNascita']]) != ''){
            $a->setLuogoNascita($_POST[$this->form['luogoNascita']]);
        }
        else{
            $errors++;
            parent::printErrorBoxMessage('Campo '.$this->label['luogoNascita'].' mancante o non corretto');
        }
        
        //telefono
        if(isset($_POST[$this->form['telefono']]) && trim($_POST[$this->form['telefono']]) != ''){
            $a->setTelefono($_POST[$this->form['telefono']]);
        }
        
        //email
        if(isset($_POST[$this->form['email']]) && trim($_POST[$this->form['email']]) != ''){
            $a->setEmail($_POST[$this->form['email']]);
        }
        
        //utente WP
        if(isset($_POST[$this->form['utenteWP']]) && trim($_POST[$this->form['utenteWP']]) != ''){
            $a->setIdUtenteWP($_POST[$this->form['utenteWP']]);
        }
        
        if($errors > 0){
            return null;
        }
        
        return $a;
        
    }
    
    /**
     * La funzione controlla i campi indirizzo e restituisce un oggetto indirizzo, null in caso di errori
     * @return \Indirizzo
     */
    protected function checkIndirizzoFields(){
        //INDIRIZZO
        if(isset($_POST[$this->form['indirizzo']]) && isset($_POST[$this->form['civico']]) && isset($_POST[$this->form['cap']]) && isset($_POST[$this->form['citta']]) && isset($_POST[$this->form['prov']])){
            //controllo sul loro settaggio
            $arrayInd = array();
            array_push($arrayInd, $_POST[$this->form['indirizzo']]);
            array_push($arrayInd, $_POST[$this->form['civico']]);
            array_push($arrayInd, $_POST[$this->form['cap']]);
            array_push($arrayInd, $_POST[$this->form['citta']]);
            array_push($arrayInd, $_POST[$this->form['prov']]);
            
            $okInd = 0;
            for($i=0; $i < count($arrayInd); $i++){
                if($arrayInd[$i] != ''){
                    $okInd++;
                }
            }
            
            if($okInd == 5){
                $indirizzo = new Indirizzo();
                $indirizzo->setIndirizzo($_POST[$this->form['indirizzo']]);
                $indirizzo->setCivico($_POST[$this->form['civico']]);
                $indirizzo->setCap($_POST[$this->form['cap']]);
                $indirizzo->setCitta($_POST[$this->form['citta']]);
                $indirizzo->setProv($_POST[$this->form['prov']]);
                
                return $indirizzo;
            }
            else if($okInd > 0 && $okInd < 5){                
                parent::printErrorBoxMessage('Campo indirizzo non compilato in modo corretto.');
                return null;
            }
            else if($okInd == 0){
                parent::printErrorBoxMessage('Campo indirizzo non compilato in modo corretto.');
                return null;
            }   
        }
    }
    
    /**
     * La funzione controlla i campi di Iscrizione/Rinnovo (selezione mediante il campo mode)
     * Restituisce un oggetto IscrizioneRinnovo, null in caso di errori
     * @param type $mode
     * @param type $upload
     * @return \IscrizioneRinnovo
     */
    protected function checkIscrizioneRinnovoFields($mode, $upload){
        //mode = 0 --> iscrizione
        //mode = 1 --> rinnovo
        $errors = 0;
        $ir = new IscrizioneRinnovo();
        
        //numero tessera - CAMPO OBBLIGATORIO
        if(isset($_POST[$this->form['numTessera']]) && trim($_POST[$this->form['numTessera']]) != ''){
            $ir->setNumeroTessera($_POST[$this->form['numTessera']]);
        }
        else{
            $errors++;
            parent::printErrorBoxMessage('Campo '.$this->label['numTessera'].' mancante o non corretto');
        }
        
        if($mode == 0){
            //data iscrizione - CAMPO OBBLIGATORIO
            if(isset($_POST[$this->form['dataIscrizione'].'-d']) && isset($_POST[$this->form['dataIscrizione'].'-m']) && isset($_POST[$this->form['dataIscrizione'].'-y'])){
                //conversione in timestamp
                $d = "";
                if(intval($_POST[$this->form['dataIscrizione'].'-d']) < 10){
                    $d = '0'.$_POST[$this->form['dataIscrizione'].'-d'];
                }
                else{
                     $d = ''.$_POST[$this->form['dataIscrizione'].'-d'];
                }
                $m = $_POST[$this->form['dataIscrizione'].'-m'];
                $y = $_POST[$this->form['dataIscrizione'].'-y'];

                //$dtime = DateTime::createFromFormat("d/m/Y H:i", $d."/".$m."/".$y." 00:00");
                $timestamp = date($y.'-'.$m.'-'.$d);
                $ir->setDataIscrizione($timestamp);
            }
            else{
                $errors++;
                parent::printErrorBoxMessage('Campo '.$this->label['dataIscrizione'].' mancante o non corretto');
            }
        }
        else{
            //data rinnovo - CAMPO OBBLIGATORIO
            if(isset($_POST[$this->form['dataRinnovo'].'-d']) && isset($_POST[$this->form['dataRinnovo'].'-m']) && isset($_POST[$this->form['dataRinnovo'].'-y'])){
                //conversione in timestamp
                $d = "";
                if(intval($_POST[$this->form['dataRinnovo'].'-d']) < 10){
                    $d = '0'.$_POST[$this->form['dataRinnovo'].'-d'];
                }
                else{
                     $d = ''.$_POST[$this->form['dataRinnovo'].'-d'];
                }
                $m = $_POST[$this->form['dataRinnovo'].'-m'];
                $y = $_POST[$this->form['dataRinnovo'].'-y'];

                //$dtime = DateTime::createFromFormat("d/m/Y H:i", $d."/".$m."/".$y." 00:00");
                $timestamp = date($y.'-'.$m.'-'.$d);
                $ir->setDataRinnovo($timestamp);
            }
            else{
                $errors++;
                parent::printErrorBoxMessage('Campo '.$this->label['dataRinnovo'].' mancante o non corretto');
            }
        }
        
        //tipo socio - CAMPO OBBLIGATORIO
        if(isset($_POST[$this->form['tipoSocio']]) && trim($_POST[$this->form['tipoSocio']]) != ''){
            $ir->setTipoSocio($_POST[$this->form['tipoSocio']]);
        }
        else{
            $errors++;
            parent::printErrorBoxMessage('Campo '.$this->label['tipoSocio'].' mancante o non corretto');
        }
        
        //modulo - CAMPO OBBLIGATORIO
        //se sono qui vuol dire che il modulo è stato caricato
        $ir->setModulo($upload['url']);
        
        //note
        if(isset($_POST[$this->form['note']]) && trim($_POST[$this->form['note']]) != ''){
            $ir->setNote($_POST[$this->form['note']]);
        }
        
        if($errors > 0){
            return null;
        }
        
        return $ir;        
        
    }
    
    
}
