<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/PlanAnnuel.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/Mois.php');

/**
 * @access public
 * @package M_Budget
 */
class AnneeComptable {
	/**
	 * @AttributeType String
	 */
	private $libelle;
	/**
	 * @AttributeType String
	 */
	private $code;
	/**
	 * @AttributeType String
	 * Etat peut etre : cloturee ou ouverte
	 */
	private $etat;
	/**
	 * @AssociationType M_Budget.PlanAnnuel
	 */
	public $unnamed_PlanAnnuel_;
	/**
	 * @AssociationType M_Budget.Mois
	 * @AssociationKind Composition
	 */
	public $unnamed_Mois_;

	public function __construct($code, $libelle, $etat){
		$this->$code = $code;
		$this->$libelle = $libelle;
		$this->$etat  =$etat;
		$this->unnamed_Mois_ = new Mois[12];
		//$this->unnamed_Mois_ = new Mois($code, $libelle, $etat);
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
	
}
?>
