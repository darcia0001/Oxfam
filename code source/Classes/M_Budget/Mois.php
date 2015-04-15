<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/AnneeComptable.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/PlanMensuel.php');

/**
 * @access public
 * @package M_Budget
 */
class Mois {
	/**
	 * @AttributeType String
	 */
	private $code;
	/**
	 * @AttributeType String
	 */
	private $libelle;
	/**
	 * @AttributeType String
	 * Etat peut etre : cloture ou ouvert
	 */
	private $etat;
	/**
	 * @AssociationType M_Budget.AnneeComptable
	 */
	public $unnamed_AnneeComptable_;
	/**
	 * @AssociationType M_Budget.PlanMensuel
	 */
	public $unnamed_PlanMensuel_;
	//constructor
	public function __construct($code, $libelle){
		$this->code = $code;
		$this->libelle = $libelle;
		$this->setEtat("ouvert");
	}

	///getters et setters
	public function setCode($code){
		$this->code = $code;
	}
	public function getCode(){
		return $this->code;
	}

	public function setLibelle($libelle){
		$this->libelle = $libelle;
	}
	public function getLibelle(){
		return $this->libelle;
	}

	public function setEtat($etat){
		$this->etat = $etat;
	}

	public function getEtat(){
		return $this->etat;
	}
}
?>