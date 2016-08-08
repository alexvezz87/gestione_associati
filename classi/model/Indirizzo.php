<?php


/**
 * Description of Indirizzo
 *
 * @author Alex
 */
class Indirizzo {
    private $ID;
    private $indirizzo;
    private $civico;
    private $cap;
    private $citta;
    private $prov;
    private $idAssociato;
    
    function __construct() {
        
    }
    
    function getID() {
        return $this->ID;
    }

    function getIndirizzo() {
        return $this->indirizzo;
    }

    function getCivico() {
        return $this->civico;
    }

    function getCap() {
        return $this->cap;
    }

    function getCitta() {
        return $this->citta;
    }

    function getProv() {
        return $this->prov;
    }

    function getIdAssociato() {
        return $this->idAssociato;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setIndirizzo($indirizzo) {
        $this->indirizzo = $indirizzo;
    }

    function setCivico($civico) {
        $this->civico = $civico;
    }

    function setCap($cap) {
        $this->cap = $cap;
    }

    function setCitta($citta) {
        $this->citta = $citta;
    }

    function setProv($prov) {
        $this->prov = $prov;
    }

    function setIdAssociato($idAssociato) {
        $this->idAssociato = $idAssociato;
    }



    
}
