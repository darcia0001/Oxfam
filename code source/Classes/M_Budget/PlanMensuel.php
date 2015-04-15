<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/PlanAnnuel.php');
require_once(realpath(dirname(__FILE__)) . '/../M_SuiviCaisse/Operation.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/Mois.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/ElementPlanMensuel.php');

/**
 * @access public
 * @package M_Budget
 */
class PlanMensuel {
	/**
	 * @AttributeType String
	 */
	private $code;
	/**
	 * @AttributeType String
	 */
	private $libelle;
	/**
	 * @AssociationType M_Budget.PlanAnnuel
	 */
	public $unnamed_PlanAnnuel_;
	/**
	 * @AssociationType M_SuiviCaisse.Operation
	 */
	public $unnamed_Operation_;
	/**
	 * @AssociationType M_Budget.Mois
	 */
	public $mois;
	/**
	 * @AssociationType M_Budget.ElementPlanMensuel
	 * @AssociationKind Composition
	 */
	public $unnamed_ElementPlanMensuel_;

	//constructors
	public function __construct($code, $libelle, $montant){
		$this->$code =$code;
		$this->$libelle = $libelle;
		$this->$unnamed_ElementPlanMensuel_ = new ElementPlanMensuel($code, $libelle, $montant);
		$mois = new Mois();

	}

	//getters et setters
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
}
?>
