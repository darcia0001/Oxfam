<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/Monnaie.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/Ville.php');
//require_once(realpath(dirname(__FILE__)) . '/../Class_48.php');

/**
 * @access public
 * @package M_Projets
 */
class Pays {
	/**
	 * @AttributeType String
	 */
	private $codePays;
	private $nomPays;
	private $languePays; 
	private $devisePays="";
	
	public function __construct(){
		
	}
	
	public function getCodePays(){ return $this->codePays; }
	public function setCodePays($val){ $this->codePays= $val; } 
	
	public function getNomPays(){ return $this->nomPays; }
	public function setNomPays($val){ $this->nomPays= $val; } 
	
	public function getDevisePays(){ return $this->devisePays; }
	public function setDevisePays($val){ $this->devisePays= $val; } 
	
	public function getLanguePays(){ return $this->languePays; }
	public function setLanguePays($val){ $this->languePayst= $val; } 
	
}
?>