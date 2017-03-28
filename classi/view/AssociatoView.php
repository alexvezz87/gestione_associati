<?php
/**
 * Description of AssociatoView
 *
 * @author Alex
 */
class AssociatoView extends PrinterView {
    private $province;
    private $tipoSocio;
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
            'EE' => 'Estero',
        );
        
        $this->controller = new AssociatoController();
        $this->tipoSocio = array('1' => 'Sostenitore', '2' => 'Ordinario', '3' => 'VIP', '4' => 'Onorario');
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
    
    
    public function printDettaglioIndirizzo($array){
        foreach($array as $item){
            $i = new Indirizzo();
            $i = $item;
            echo '<h4>Indirizzo</h4>';
            parent::printHiddenFormField('associato-id', $i->getIdAssociato());
            parent::printTextFormField($this->form['indirizzo'], $this->label['indirizzo'], true, $i->getIndirizzo());
            parent::printTextFormField($this->form['civico'], $this->label['civico'], true, $i->getCivico());
            parent::printTextFormField($this->form['cap'], $this->label['cap'], true, $i->getCap());
            parent::printTextFormField($this->form['citta'], $this->label['citta'], true, $i->getCitta());
            parent::printSelectFormField($this->form['prov'], $this->label['prov'], $this->province, true, $i->getProv());  
        }
        
    }
    
    /**
     * Funzione che stampa i campi dettaglio di inserimento di un'iscrizione
     */
    public function printIscrizione(){
        echo '<h4>Iscrizione</h4>';
        parent::printNumberFormField($this->form['numTessera'], $this->label['numTessera'], true, $this->controller->suggerisciProssimaTessera());
        parent::printDateFormField($this->form['dataIscrizione'], $this->label['dataIscrizione'], true);
        
        parent::printSelectFormField($this->form['tipoSocio'], $this->label['tipoSocio'], $this->tipoSocio, true);
        parent::printInputFileFormField($this->form['modulo'], $this->label['modulo'], true);
        parent::printTextAreaFormField($this->form['note'], $this->label['note']);
    }
    
    
    public function printRinnovo($array){
        //devo trovare il numero tessera
        $tessera = "";
        $tipoSocio = "";
        $idAssociato = "";
        foreach($array as $item){
            $ir = new IscrizioneRinnovo();
            $ir = $item;
            if($ir->getDataIscrizione() != '0000-00-00 00:00:00'){
                //uso il numero tessera dell'iscrizione
                $tessera = $ir->getNumeroTessera();
                $tipoSocio = $ir->getTipoSocio();
                $idAssociato = $ir->getIdAssociato();
            }
        }
        
        
        echo '<h4>Nuovo Rinnovo</h4>';
        parent::printHiddenFormField('associato-id', $idAssociato);
        parent::printNumberFormField($this->form['numTessera'], $this->label['numTessera'], true, $tessera);
        parent::printDateFormField($this->form['dataRinnovo'], $this->label['dataRinnovo'], true);
        
        parent::printSelectFormField($this->form['tipoSocio'], $this->label['tipoSocio'], $this->tipoSocio, true, $tipoSocio);
        parent::printInputFileFormField($this->form['modulo'], $this->label['modulo'], true);
        parent::printTextAreaFormField($this->form['note'], $this->label['note']);
    }
    
    public function printDettaglioIscrizione($array){
        
        $countRinnovo = 0;
        foreach($array as $item){
            echo '<hr>';
            echo '<form class="form-horizontal" role="form" action="'.curPageURL().'" name="form-associato-iscrizione-rinnovo" method="POST" >';
            
            $ir = new IscrizioneRinnovo();
            $ir = $item;
            
            //campo id-associato
            parent::printHiddenFormField('ir-id', $ir->getID());
            
            $testoModulo = "";
            $anno = "";
            if($ir->getDataIscrizione() != '0000-00-00 00:00:00'){
                echo '<h4>Iscrizione</h4>';
                $data = explode('-', $ir->getDataIscrizione());
                $anno = $data[0];
                $testoModulo = "Documento: Iscrizione ".$anno;
                        
            }
            else{ 
                $countRinnovo++;
                echo '<h4>Rinnovo '.$countRinnovo.'</h4>';
                $data = explode('-', $ir->getDataRinnovo());
                $anno = $data[0];
                $testoModulo = "Documento: Rinnovo ".$anno;
            }
            parent::printNumberFormField($this->form['numTessera'], $this->label['numTessera'], true, $ir->getNumeroTessera());
            if($ir->getDataIscrizione() != '0000-00-00 00:00:00'){
                parent::printDateFormField($this->form['dataIscrizione'], $this->label['dataIscrizione'], true, $ir->getDataIscrizione());
            }
            else{                
                parent::printDateFormField($this->form['dataRinnovo'], $this->label['dataRinnovo'], true, $ir->getDataRinnovo());
            } 
            
            parent::printSelectFormField($this->form['tipoSocio'], $this->label['tipoSocio'], $this->tipoSocio, true, $ir->getTipoSocio());
            parent::printImageLinkDocument($this->form['modulo'], $this->label['modulo'], false, $ir->getModulo(), $testoModulo);
            parent::printTextAreaFormField($this->form['note'], $this->label['note'], false, $ir->getNote());
            
            if($ir->getDataIscrizione() != '0000-00-00 00:00:00'){
                parent::printUpdateDettaglio('associato-iscrizione'); 
            }
            else{                
                parent::printUpdateDettaglio('associato-rinnovo'); 
            } 
            
            
            echo '</form>';
        }
    }
    
    protected function printDettaglioIscrizionePubblico($array){
        $countRinnovo = 0;
        foreach($array as $item){
                      
            $ir = new IscrizioneRinnovo();
            $ir = $item;
            
            echo '<form class="form-horizontal" role="form" action="'.curPageURL().'" name="form-associato-iscrizione-rinnovo" method="POST" >';
            
            
            $testoModulo = "";
            $anno = "";
            if($ir->getDataIscrizione() != '0000-00-00 00:00:00'){
                echo '<h4>Iscrizione</h4>';
                $data = explode('-', $ir->getDataIscrizione());
                $anno = $data[0];
                $testoModulo = "Documento: Iscrizione ".$anno;
                        
            }
            else{ 
                $countRinnovo++;
                echo '<h4>Rinnovo '.$countRinnovo.'</h4>';
                $data = explode('-', $ir->getDataRinnovo());
                $anno = $data[0];
                $testoModulo = "Documento: Rinnovo ".$anno;
            }
            parent::printDisabledTextFormField($this->form['numTessera'],  $this->label['numTessera'], $ir->getNumeroTessera());
            //parent::printNumberFormField($this->form['numTessera'], $this->label['numTessera'], true, $ir->getNumeroTessera());
            if($ir->getDataIscrizione() != '0000-00-00 00:00:00'){
                
                parent::printDisabledTextFormField($this->form['dataIscrizione'], $this->label['dataIscrizione'], getStringData($ir->getDataIscrizione()));
            }
            else{                
                parent::printDisabledTextFormField($this->form['dataRinnovo'], $this->label['dataRinnovo'], getStringData($ir->getDataRinnovo()));
            } 
            
            parent::printDisabledTextFormField($this->form['tipoSocio'], $this->label['tipoSocio'], getValueTipoSocio($ir->getTipoSocio()));
            parent::printImageLinkDocument($this->form['modulo'], $this->label['modulo'], false, $ir->getModulo(), $testoModulo);
            parent::printDisabledTextAreaFormField($this->form['note'], $this->label['note'], $ir->getNote());
          
            echo '</form>';
            
            echo '<hr>';  
        }
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
    
    
    public function printDettaglioAssociato($idAssociato){
        $a = new Associato();
        $a = $this->controller->getAssociatoByIdAssociato($idAssociato);
        
        if($a != null){
    ?>
        <h3>Associato: <?php echo $a->getCognome().' '.$a->getNome() ?></h3>
        <div class="col-sm-6">
            <form class="form-horizontal" role="form" action="<?php echo curPageURL() ?>" name="form-associato-dettagli" method="POST" >
                <?php parent::printHiddenFormField('associato-id', $a->getID()); ?>
                <?php parent::printTextFormField($this->form['nome'], $this->label['nome'], true, $a->getNome()) ?>
                <?php parent::printTextFormField($this->form['cognome'], $this->label['cognome'], true, $a->getCognome()) ?>
                <?php
                    $sesso = array('m' => 'Maschio', 'f' => 'Femmina');
                    parent::printRadioFormField($this->form['sesso'], $this->label['sesso'], $sesso, true, $a->getSesso());                    
                ?>
                <?php parent::printTextFormField($this->form['luogoNascita'], $this->label['luogoNascita'], true, $a->getLuogoNascita()) ?>
                <?php parent::printDateBirthdayFormField($this->form['dataNascita'], $this->label['dataNascita'], true, $a->getDataNascita()) ?>
                <?php parent::printTextFormField($this->form['telefono'], $this->label['telefono'], false, $a->getTelefono()) ?>
                <?php parent::printEmailFormField($this->form['email'], $this->label['email'], false, $a->getEmail()) ?>
                <?php  
                    $utentiWp = getUtentiWpSelectValues();                   
                    parent::printSelectFormField($this->form['utenteWP'], $this->label['utenteWP'], $utentiWp, false, $a->getIdUtenteWP());
                ?>
                <div>
                    <?php parent::printUpdateDettaglio('associato') ?>
                </div>
            </form>
            <hr>
            <form class="form-horizontal" role="form" action="<?php echo curPageURL() ?>" name="form-associato-indirizzo" method="POST" >    
                <?php $this->printDettaglioIndirizzo($a->getIndirizzo()); ?>
                <div>
                    <?php parent::printUpdateDettaglio('associato-indirizzo') ?>
                </div>
            </form>
             <?php $this->printDettaglioIscrizione($a->getIscrizioneRinnovo()) ?>
            <div class="clear"></div>
            <hr>
            <form class="form-horizontal" role="form" action="<?php echo curPageURL() ?>" name="form-associato-elimina" method="POST" >
                <?php parent::printHiddenFormField('associato-id', $a->getID()) ?>
                
                <?php if($a->getIbernato() == 0) { ?>    
                <?php parent::printDeleteDettaglio('associato') ?>
                <?php }else if($a->getIbernato() == 1){ ?>
                <?php parent::printAttivaDettaglio('associato') ?>
                <?php } ?>
            </form>
            
        </div>
        <div class="col-sm-6">
            <form class="form-horizontal" role="form" action="<?php echo curPageURL() ?>" name="form-rinnovo" method="POST" enctype="multipart/form-data" >
                <?php parent::printHiddenFormField('associato-id', $a->getID()) ?>
                <?php $this->printRinnovo($a->getIscrizioneRinnovo()) ?>
                <input class="btn btn-success" style="float:right" type="submit" name="rinnova-associato" value="Rinnova" />
            </form>
        </div>
    <?php
        }
        else{
            echo '<p>Associato non trovato :( </p>';
        }
    }
    
    /**
     * Funzione che stampa i dati associativi pubblici di un utente
     * @param type $idUtenteWp
     * @return type
     */
    public function printIlMioProfilo($idUtenteWp){
        
        $a = new Associato();
        $a = $this->controller->getAssociatoByIdUtenteWp($idUtenteWp);
        
        if($a == null){
            parent::printErrorBoxMessage('La tua utenza non corrisponde a nessun associato.');
            return;
        }
        
        //stampo i campi utente        
        $arrayIR = $a->getIscrizioneRinnovo();
        $ultimaData = "";
        foreach($arrayIR as $item2){
            $temp = new IscrizioneRinnovo();
            $temp = $item2;
            if($temp->getDataIscrizione() != '0000-00-00 00:00:00'){
                $ir = $temp;
                $ultimaData = $temp->getDataIscrizione();               
            }
            else{                
                $ultimaData = $temp->getDataRinnovo();               
            }
        }
        
        $status = getStatusAssociato($ultimaData);
        
        $htmlStatus = 'STATO: ';
        if($status == 'ATTIVO'){
            $htmlStatus .= '<span style="color:green">'.$status.'</span>';
        }
        else{
            if($status == 'IN SCADENZA'){
                $htmlStatus .= '<span style="color:#FFA500">'.$status.'</span>';
            }
            else if($status == 'SCADUTO'){
                $htmlStatus .= '<span style="color:red">'.$status.'</span>';
            }
            
            $htmlStatus.='<br><a href="https://quartaera.it/rinnovo/">clicca qui per rinnovare!</a>';
        }
        
    ?>
        <h3 style="float:right"><?php echo $htmlStatus ?></h3>
        <h3 style="float:left;">Associato: <?php echo $a->getCognome().' '.$a->getNome()?></h3>
        <div class="clear"></div>
        <div class="col-sm-6">
            <form class="form-horizontal" role="form" action="<?php echo curPageURL() ?>" name="form-associato-dettagli" method="POST" >
                <?php parent::printHiddenFormField('associato-id', $a->getID()); ?>
                <?php parent::printHiddenFormField($this->form['utenteWP'], $a->getIdUtenteWP()) ?>
                <?php parent::printTextFormField($this->form['nome'], $this->label['nome'], true, $a->getNome()) ?>
                <?php parent::printTextFormField($this->form['cognome'], $this->label['cognome'], true, $a->getCognome()) ?>
                <?php
                    $sesso = array('m' => 'Maschio', 'f' => 'Femmina');
                    parent::printRadioFormField($this->form['sesso'], $this->label['sesso'], $sesso, true, $a->getSesso());                    
                ?>
                <?php parent::printTextFormField($this->form['luogoNascita'], $this->label['luogoNascita'], true, $a->getLuogoNascita()) ?>
                <?php parent::printDateBirthdayFormField($this->form['dataNascita'], $this->label['dataNascita'], true, $a->getDataNascita()) ?>
                <?php parent::printTextFormField($this->form['telefono'], $this->label['telefono'], false, $a->getTelefono()) ?>
                <?php parent::printEmailFormField($this->form['email'], $this->label['email'], false, $a->getEmail()) ?>
               
                <div>
                    <?php parent::printUpdateDettaglio('associato') ?>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <form class="form-horizontal" role="form" action="<?php echo curPageURL() ?>" name="form-associato-indirizzo" method="POST" >    
                <?php $this->printDettaglioIndirizzo($a->getIndirizzo()); ?>
                <div>
                    <?php parent::printUpdateDettaglio('associato-indirizzo') ?>
                </div>
            </form>
        </div>
        <div class="clear"></div>
        <hr>
        <div class="col-sm-6">
             <?php $this->printDettaglioIscrizionePubblico($a->getIscrizioneRinnovo()) ?>  
        </div>
    <?php       
        
    }
    
    /**
     * Listener del form di aggiunta associato
     * @return type
     */
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
    
    
    public function listenerDettaglioAssociato(){
        //Questo listener contiene 4 tipi di listeners (3 di update e 1 di delete)
        
        //1. update dettagli associato
        if(isset($_POST['update-associato'])){     
            
            $associato = $this->checkAssociatoFields();
            //print_r($associato);
            if($associato == null){
                //se ci sono stati errori concludo l'operazione  
                parent::printErrorBoxMessage('Associato non aggiornato!');
                return;
            }
            $associato->setID($_POST['associato-id']);
            
            if($this->controller->updateAssociatoDettagli($associato) == false){
                parent::printErrorBoxMessage('Associato non aggiornato!');
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Associato aggiornato con successo!');
                unset($_POST);
                return;
            }
        }
        
        //2. update indirizzo
        if(isset($_POST['update-associato-indirizzo'])){
            $indirizzo = $this->checkIndirizzoFields();            
            if($indirizzo == null){
                //se ci sono stati errori concludo l'operazione
                parent::printErrorBoxMessage('Indirizzo Associato non aggiornato!');
                return;
            }
            $indirizzo->setIdAssociato($_POST['associato-id']);
            
            if($this->controller->updateAssociatoIndirizzo($indirizzo) == false){
                parent::printErrorBoxMessage('Indirizzo Associato non aggiornato!');
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Indirizzo Associato aggiornato con successo!');
                unset($_POST);
                return;
            }
        }
        
        //3a. update iscrizione
        if(isset($_POST['update-associato-iscrizione'])){
            $iscrizione = $this->checkIscrizioneRinnovoFields(0, null);
            if($iscrizione == null){
                //se ci sono stati errori concludo l'operazione
                parent::printErrorBoxMessage('Iscrizione Associato non aggiornata!');
                return;
            }           
            $iscrizione->setID($_POST['ir-id']);
            if($this->controller->updateAssociatoIscrizioneRinnovo($iscrizione) == false){
                parent::printErrorBoxMessage('Iscrizione Associato non aggiornata!');
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Iscrizione Associato aggiornata con successo!');
                unset($_POST);
                return;
            }
            
        }
        
        //3b. update rinnovo
        if(isset($_POST['update-associato-rinnovo'])){
            $rinnovo = $this->checkIscrizioneRinnovoFields(1, null);
            if($rinnovo == null){
                //se ci sono stati errori concludo l'operazione
                parent::printErrorBoxMessage('Rinnovo Associato non aggiornato!');
                return;
            }
            $rinnovo->setID($_POST['ir-id']);
           
            if($this->controller->updateAssociatoIscrizioneRinnovo($rinnovo) == false){
                parent::printErrorBoxMessage('Rinnovo Associato non aggiornato!');               
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Rinnovo Associato aggiornato con successo!');
                unset($_POST);
                return;
            }
            
        }
        
        //4. iberna associato
        if(isset($_POST['delete-associato'])){
            //Iberno l'associato --> vado a modificare un flag all'interno del suo record nel database            
            $associato = $this->controller->getAssociatoByIdAssociato($_POST['associato-id']);
            $associato->setIbernato(1);
             if($this->controller->updateAssociatoDettagli($associato) == false){
                parent::printErrorBoxMessage('Associato non aggiornato!');
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Associato IBERNATO successo!');
                unset($_POST);
                return;
            }
        } 
        
        //4b. attiva associato
        if(isset($_POST['attiva-associato'])){
            //Attivo l'associato --> vado a modificare il flag all'interno del suo record nel database
            $associato = $this->controller->getAssociatoByIdAssociato($_POST['associato-id']);
            $associato->setIbernato(0);
             if($this->controller->updateAssociatoDettagli($associato) == false){
                parent::printErrorBoxMessage('Associato non aggiornato!');
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Associato ATTIVATO con successo!');
                unset($_POST);
                return;
            }
        }
        
        //5. salva nuovo rinnovo
        if(isset($_POST['rinnova-associato'])){
            
            //In primis, salvo il file con wordpress
            $upload = wp_upload_bits($_FILES[$this->form['modulo']]["name"], null, file_get_contents($_FILES[$this->form['modulo']]["tmp_name"]));
            
            if($upload['error'] != false){
               parent::printErrorBoxMessage($upload['error']);              
               return;
            }            
            $rinnovo = $this->checkIscrizioneRinnovoFields(1, $upload);
            if($rinnovo == null){
                //se ci sono stati errori concludo l'operazione
                parent::printErrorBoxMessage('Errore nel salvare il nuovo rinnovo.');
                return;
            }
            $rinnovo->setIdAssociato($_POST['associato-id']);
            if($this->controller->saveRinnovo($rinnovo) == false){
                parent::printErrorBoxMessage('Errore nel salvare il nuovo rinnovo.');
                return;
            }
            else{
                parent::printOkBoxMessage('Nuovo Rinnovo salvato con successo!');
                unset($_POST);
                return;
            }
        }
        
    }
    
    
    public function listnerDettaglioAssociatoPubblico(){
        //1. update dettagli associato
        if(isset($_POST['update-associato'])){     
            
            $associato = $this->checkAssociatoFields();
            //print_r($associato);
            if($associato == null){
                //se ci sono stati errori concludo l'operazione  
                parent::printErrorBoxMessage('Associato non aggiornato!');
                return;
            }
            $associato->setID($_POST['associato-id']);
            
            if($this->controller->updateAssociatoDettagli($associato) == false){
                parent::printErrorBoxMessage('Associato non aggiornato!');
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Associato aggiornato con successo!');
                unset($_POST);
                
                //invio email di avvertimento 
                $to = 'amministrazione@quartaera.it';
                $subject = "Avviso di aggiornamento dettagli associato";
                $message = "L'associato ".$associato->getNome().' '.$associato->getCognome().', ha modificato i dati relativi al dettaglio associato';
                add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
                //wp_mail($to, $subject, $message, $headers = '');
                
                return;
            }
        }
        
        //2. update indirizzo
        if(isset($_POST['update-associato-indirizzo'])){
            $indirizzo = $this->checkIndirizzoFields();            
            if($indirizzo == null){
                //se ci sono stati errori concludo l'operazione
                parent::printErrorBoxMessage('Indirizzo Associato non aggiornato!');
                return;
            }
            $indirizzo->setIdAssociato($_POST['associato-id']);
            
            if($this->controller->updateAssociatoIndirizzo($indirizzo) == false){
                parent::printErrorBoxMessage('Indirizzo Associato non aggiornato!');
                return;
            }
            else{
                //tutto ok
                parent::printOkBoxMessage('Indirizzo Associato aggiornato con successo!');
                unset($_POST);
                
                //invio email di avvertimento 
                $to = 'amministrazione@quartaera.it';
                $subject = "Avviso di aggiornamento dettagli indirizzo associato";
                $message = "L'associato ".$associato->getNome().' '.$associato->getCognome().', ha modificato i dati relativi al suo indirizzo';
                add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
                //wp_mail($to, $subject, $message, $headers = '');
                
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
        if($upload != null){
            $ir->setModulo($upload['url']);
        }
        
        //note
        if(isset($_POST[$this->form['note']]) && trim($_POST[$this->form['note']]) != ''){
            $ir->setNote($_POST[$this->form['note']]);
        }
        
        if($errors > 0){
            return null;
        }
        
        return $ir;        
        
    }
    
    
    public function printTableAssociati($associati){   
        
        $header = array(
            $this->label['numTessera'],
            $this->label['cognome'],
            $this->label['nome'],
            $this->label['tipoSocio'],
            $this->label['dataIscrizione'],
            'Ultimo Rinnovo',
            'Stato',
            'Azioni'    
        );
        
        $bodyTable = $this->printBodyTable($associati);
        
        parent::printTableHover($header, $bodyTable);
       
    }
    
    
    protected function printBodyTable($array){
        parent::printBodyTable($array);
        
        
        
        $html = "";
        foreach($array as $item){
            $a = new Associato();
            $a = $item;
            
            $ir = new IscrizioneRinnovo();
            
            $arrayIR = $a->getIscrizioneRinnovo();
            $ultimaData = "";
            $countRinnovi = 0;
            $numTessera = "";
            $tipoSocio = "";
            $ultimoRinnovo = "nessuno";
            $mailInScadenza = "";
            $mailScaduta = "";
            foreach($arrayIR as $item2){
                $temp = new IscrizioneRinnovo();
                $temp = $item2;
                if($temp->getDataIscrizione() != '0000-00-00 00:00:00'){
                    $ir = $temp;
                    $ultimaData = $temp->getDataIscrizione();
                    $numTessera = $temp->getNumeroTessera();
                    $tipoSocio = $temp->getTipoSocio();
                }
                else{
                    $countRinnovi++;
                    $ultimaData = $temp->getDataRinnovo();
                    $tipoSocio = $temp->getTipoSocio();
                    $ultimoRinnovo = getStringData($temp->getDataRinnovo());
                }
                $mailInScadenza = $temp->getMailScadenza();
                $mailScaduta = $temp->getMailScaduta();
            }
           
            
            $html.="<tr>";
            //numTessera
            $html.='<td>'.parent::printTextField(null, $numTessera).'</td>';
            //cognome
            $html.='<td>'.parent::printTextField(null, $a->getCognome()).'</td>';
            //nome
            $html.='<td>'.parent::printTextField(null, $a->getNome()).'</td>';
            //tipo socio
            $socio = "";
            if($tipoSocio == '1'){
                $socio = 'Sostenitore';
            }
            else if($tipoSocio == '2'){
                $socio = 'Ordinario';
            }
            else if($tipoSocio == '3'){
                $socio = 'VIP';
            }
            else if($tipoSocio == '4'){
                $socio = 'Onorario';
            }
            
            $html.='<td>'.parent::printTextField(null, $socio).'</td>';
            //data iscrizione
            $html.='<td>'.parent::printTextField(null, getStringData($ir->getDataIscrizione())).'</td>';
            //stato
            $rinnovo = "";
            if($countRinnovi == 0){
                $rinnovo = "nessuno";
            }
            else if($countRinnovi == 1){
                $rinnovo = "1 rinnovo";
            }
            else{
                $rinnovo = $countRinnovi." rinnovi";
            }
            
            $html.='<td>'.parent::printTextField(null, $ultimoRinnovo).'</td>';
            
            $scaduto = "";
            $status = getStatusAssociato($ultimaData);
            if($status == 'ATTIVO'){
                $scaduto = '<strong style="color:green">ATTIVO</span>';
            }
            else if($status == 'SCADUTO'){
                $scaduto = '<strong style="color:red">SCADUTO</span>';
            }
            else{
                $scaduto = '<strong style="color:#FFA500">IN SCADENZA</span>';
            }
            
            if($a->getIbernato() == 1){
                $scaduto = '<strong style="color:#999">IBERNATO</span>';
            }
                        
            $html.='<td>'.parent::printTextField(null, $scaduto ).'</td>';
            //azioni
            $html.='<td>';
            //invio mail
            
            $mode = "";
            $bottone = "";
            if($status == 'IN SCADENZA'){
                $mode = 1;
                if($mailInScadenza == 0){
                    $bottone = '<button class="in-scadenza" data-id="'.$a->getID().'" >Invia Email</button>';
                }
                else{
                    $bottone = '';
                }
            }
            else if($status == 'SCADUTO'){
                $mode = 2;
                if($mailScaduta == 0){
                    $bottone = '<button class="scaduta" data-id="'.$a->getID().'" >Invia Email</button>';
                }
                else{
                    $bottone = '';
                }
            }            
            $html.= $bottone;
            //dettagli
            $html.='<button onclick="location.href=\''.get_admin_url().'admin.php?page=dettaglio_associato&id='.$a->getID().'\'">Dettagli</button>';
            //$html.='<a href="'.get_admin_url().'admin.php?page=dettaglio_associato&id='.$a->getID().'">Visualizza dettagli</a>';            
            
            
            $html.='</td>';
            $html.="</tr>"; 
        }
        
        return $html;        
    }
    
    /** STATISTICHE **/
    
    public function printStatisticheColumns($statistiche){
        //$idDiv, $titolo, $array
        
    ?>
        <script type="text/javascript">

            window.onload = function () {
                
            <?php
                foreach($statistiche as $s){
                    $this->printVarCanvas($s);
                }
            ?>      
            }
            </script>
            
            <?php foreach($statistiche as $s){
                                
                echo '<div class="col-xs-12 col-sm-6" style="margin-bottom:20px">';
                echo ' <div id="'.$s['id'].'" style="height:300px; widht:90%"></div>';
                if(isset($s['note'])){
                    echo '<p style="text-align:center; font-size:18px"><strong>'.$s['note'].'</strong></p>';
                }
                echo '</div>';
             } ?>
    <?php    
    }
    
    
    protected function printVarCanvas($s){
        
        $idDiv = $s['id'];
        $titolo = $s['titolo'];
        $array = $s['dati'];
        $type = $s['type'];        
        
    ?>
            var <?php echo $idDiv ?> = new CanvasJS.Chart("<?php echo $idDiv ?>", {
                    title:{
                            text: "<?php echo $titolo ?>"              
                    },
                    data: [              
                    {
                            // Change type to "doughnut", "line", "splineArea", etc.
                            type: "<?php echo $type ?>",
                            <?php
                                if(count($array) > 0){
                                    echo 'dataPoints: [';
                                    $i=1;
                                    foreach ($array as $key => $value) {
                                        if($i == count($array)){
                                            echo '{ label: "'.$key.'", y: '.$value.' }';
                                        }
                                        else{
                                            echo '{ label: "'.$key.'", y: '.$value.' }, ';
                                        }                                                
                                        $i++;                                                        
                                    }
                                    echo ']';
                                }
                            ?>
                    }
                    ]
            });
            <?php echo $idDiv ?>.render(); <?php echo $idDiv ?> = {};
    <?php
    }
    
    public function printAssociatiEmail(){
        $emails = $this->controller->getEmailAssociati();
        
        foreach($emails as $e){
            echo $e.'<br>';
        }
    }
    
    public function printAssociatiMaps(){
        //ottengo i cap degli associati
        $caps = $this->controller->getCapAssociati();
        //print_r($caps);
    ?>
        <script
            src="https://maps.googleapis.com/maps/api/js?callback=preInit&key=AIzaSyAHWTiM4LHqYwrpDRCYVhKu_wTAvJa5uPo" async defer>
        </script>
        
        <div id="map_canvas" style="width:650px; height:700px; border: 2px solid #3872ac;"></div>
         
       <script type="text/javascript">
            var locations = [
        <?php
            if(count($caps) > 0 ){
                $count = 0;
                foreach($caps as $cap){
                    if($count == count($caps)-1){
                        echo "['".$cap['nome']."', '".$cap['addr'].", ".$cap['cap'].", ".$cap['prov']."']";
                    }
                    else{
                        echo "['".$cap['nome']."', '".$cap['addr'].", ".$cap['cap'].", ".$cap['prov']."'],";
                    }                    
                    $count++;
                }
            }
        ?>
            ];
            
            var geocoder;
            var map;
            var bounds;
           
            function preInit(){
                bounds = new google.maps.LatLngBounds();
                google.maps.event.addDomListener(window, "load", initialize);
            }
            
            function initialize() {
                
                
                
                map = new google.maps.Map(
                document.getElementById("map_canvas"), {
                    center: new google.maps.LatLng(42.2053153, 12.1936114),
                    zoom: 6,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                geocoder = new google.maps.Geocoder();

                for (i = 0; i < locations.length; i++) {


                    geocodeAddress(locations, i);
                }
            }
            
            
            
            function geocodeAddress(locations, i) {
                var title = locations[i][0];
                var address = locations[i][1];                
                geocoder.geocode({
                    'address': locations[i][1]
                },

                function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var marker = new google.maps.Marker({
                            icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
                            map: map,
                            position: results[0].geometry.location,
                            title: title,
                            animation: google.maps.Animation.DROP,
                            address: address
                        });
                        infoWindow(marker, map, title, address);
                        bounds.extend(marker.getPosition());
                        map.fitBounds(bounds);
                    } else {
                        // === if we were sending the requests to fast, try this one again and increase the delay
                        if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                            setTimeout(function() {
                                geocodeAddress(locations, i);
                            }, 50);
                        }   
                        
                        //alert("geocode of " + address + " failed:" + status);
                    }
                });
                
            }
            
            function infoWindow(marker, map, title, address) {
                google.maps.event.addListener(marker, 'click', function () {
                    var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div></p></div>";
                    iw = new google.maps.InfoWindow({
                        content: html,
                        maxWidth: 350
                    });
                    iw.open(map, marker);
                });
            }

            function createMarker(results) {
                var marker = new google.maps.Marker({
                    icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
                    map: map,
                    position: results[0].geometry.location,
                    title: title,
                    animation: google.maps.Animation.DROP,
                    address: address
                });
                bounds.extend(marker.getPosition());
                map.fitBounds(bounds);
                infoWindow(marker, map, title, address);
                return marker;
            }
            
        </script> 
   
        
        
    <?php
        
    }
        
}
