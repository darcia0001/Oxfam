<?php
require_once(realpath(dirname(__FILE__)) . '/../M_SuiviCaisse/Operation.php');

/**
 * @access public
 * @package M_SuiviCaisse
 */
class OperationCaisse extends Operation {

	public function __construct($donnees)	{
		$this->hydrate($donnees);
	}
	
	/**
	 * @AttributeType int
	 */
	private $numRecu;
	public function   getNumRecu() {
		return $this->numRecu;
	}
	public function   setNumRecu($numRecu) {
		return $this->numRecu=$numRecu;
	}
	
}
?>