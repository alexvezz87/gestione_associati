<?php


/**
 * Description of IscrizioneRinnovo
 *
 * @author Alex
 */
class IscrizioneRinnovo {
    //put your code here
    
    private $ID;
    private $idAssociato;
    private $numeroTessera;
    private $dataRinnovo;
    private $tipoSocio;
    private $dataIscrizione;
    private $modulo;
    
    function __construct() {
        
    }
    
    function getID() {
        return $this->ID;
    }

    function getIdAssociato() {
        return $this->idAssociato;
    }

    function getNumeroTessera() {
        return $this->numeroTessera;
    }

    function getDataRinnovo() {
        return $this->dataRinnovo;
    }

    function getTipoSocio() {
        return $this->tipoSocio;
    }

    function getDataIscrizione() {
        return $this->dataIscrizione;
    }

    function getModulo() {
        return $this->modulo;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setIdAssociato($idAssociato) {
        $this->idAssociato = $idAssociato;
    }

    function setNumeroTessera($numeroTessera) {
        $this->numeroTessera = $numeroTessera;
    }

    function setDataRinnovo($dataRinnovo) {
        $this->dataRinnovo = $dataRinnovo;
    }

    function setTipoSocio($tipoSocio) {
        $this->tipoSocio = $tipoSocio;
    }

    function setDataIscrizione($dataIscrizione) {
        $this->dataIscrizione = $dataIscrizione;
    }

    function setModulo($modulo) {
        $this->modulo = $modulo;
    }



}
