<?php


/**
 * Description of LocatorDAO
 *
 * @author Alex
 */
class LocatorDAO {
    private $wpdb;
    private $regione;
    private $provincia;
    
    function __construct() {
        global $wpdb;
        $wpdb->prefix = 'qe_';
        $this->wpdb = $wpdb;
        $this->regione = $wpdb->prefix.'regioni';
        $this->provincia = $wpdb->prefix.'province';
    }
    
    
    public function getCodRegioneBySiglaProv($sigla){
        try{
            $query = "SELECT cod_regione FROM ".$this->provincia." WHERE sigla = '".$sigla."'";
            return $this->wpdb->get_var($query);
        } catch (Exception $ex) {
            _e($ex);
            return -1;
        }
    }
    
    public function getNomeRegioneByCodRegione($cod){
        try{
            $query = "SELECT regione FROM ".$this->regione." WHERE cod_regione = '".$cod."'";
            return $this->wpdb->get_var($query);
        } catch (Exception $ex) {
            _e($ex);
            return -1;
        }
    }
    
    public function getNomeProvinciaBySigla($sigla){
        try{
            $query = "SELECT provincia FROM ".$this->provincia." WHERE sigla = '".$sigla."'";
            return $this->wpdb->get_var($query);
        } catch (Exception $ex) {
            _e($ex);
            return -1;
        }
    }
}
