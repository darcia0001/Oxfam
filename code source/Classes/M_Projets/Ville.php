<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/Pays.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/Projet.php');

/**
 * @access public
 * @package M_Projets
 */
class Ville {
	/**
	 * @AttributeType String
	 */
	private $nomVille;
	private $nomPays;
	
	public function getNomVille(){ return $this->nomVille; }
	public function setNomVille($val){ $this->nomVille= $val; }
	
	public function getNomPays(){ return $this->nomPays; }
	public function setNomPays($val){ $this->nomPays= $val; }
	
}
?>