<?php

/**
 * Description of Associato
 *
 * @author Alex
 */
class Associato {
    private $ID;
    private $idUtenteWP;
    private $nome;
    private $cognome;
    private $sesso;
    private $luogoNascita;
    private $dataNascita;
    private $indirizzo;
    private $telefono;
    private $email;
    private $iscrizioneRinnovo;
    private $ibernato;
    
    
    function __construct() {
        
    }
    
    function getID() {
        return $this->ID;
    }

    function getIdUtenteWP() {
        return $this->idUtenteWP;
    }

    function getNome() {
        return $this->nome;
    }

    function getCognome() {
        return $this->cognome;
    }

    function getSesso() {
        return $this->sesso;
    }

    function getLuogoNascita() {
        return $this->luogoNascita;
    }

    function getDataNascita() {
        return $this->dataNascita;
    }

    function getIndirizzo() {
        return $this->indirizzo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setIdUtenteWP($idUtenteWP) {
        $this->idUtenteWP = $idUtenteWP;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCognome($cognome) {
        $this->cognome = $cognome;
    }

    function setSesso($sesso) {
        $this->sesso = $sesso;
    }

    function setLuogoNascita($luogoNascita) {
        $this->luogoNascita = $luogoNascita;
    }

    function setDataNascita($dataNascita) {
        $this->dataNascita = $dataNascita;
    }

    function setIndirizzo($indirizzo) {
        $this->indirizzo = $indirizzo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getIscrizioneRinnovo() {
        return $this->iscrizioneRinnovo;
    }

    function setIscrizioneRinnovo($iscrizioneRinnovo) {
        $this->iscrizioneRinnovo = $iscrizioneRinnovo;
    }

    function getIbernato() {
        return $this->ibernato;
    }

    function setIbernato($ibernato) {
        $this->ibernato = $ibernato;
    }

}
