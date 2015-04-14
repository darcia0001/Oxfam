<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/PlanMensuel.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/LigneBudget.php');

/**
 * @access public
 * @package M_Budget
 */
class ElementPlanMensuel {
	/**
	 * @AttributeType String
	 */
	private $code;
	/**
	 * @AttributeType String
	 */
	private $libelle;
	/**
	 * @AttributeType double
	 */
	private $montant;
	/**
	 * @AssociationType M_Budget.PlanMensuel
	 */
	public $unnamed_PlanMensuel_;
	/**
	 * @AssociationType M_Budget.LigneBudget
	 */
	public $unnamed_LigneBudget_;
	//constructeur
	public function __construct($code, $libelle, $montant){
		$this->$code =$code;
		$this->$libelle = $libelle;
	}

	///getters et setters
	public function setCode($code){
		$this->$code = $code;
	}
	public function getCode(){
		return $this->$code;
	}

	public function setLibelle($libelle){
		$this->$libelle = $libelle;
	}
	public function getLibelle(){
		return $this->$libelle;
	}

	public function setMontant($montant){
		$this->montant = $montant;
	}

	public function getMontant(){
		return $this->$montant;
	}
}
?>
