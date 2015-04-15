<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/BudgetProjet.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/ActiviteB.php');

/**
 * @access public
 * @package M_Budget
 */
class Themes {
	/**
	 * @AttributeType String
	 */
	private $libelle;
	/**
	 * @AssociationType M_Budget.BudgetProjet
	 */
	public $unnamed_BudgetProjet_;
	/**
	 * @AssociationType M_Budget.ActiviteB
	 * @AssociationKind Aggregation
	 */
	public $unnamed_ActiviteB_;

	//getters et setters

	public function setLibelle($libelle){
		$this->$libelle = $libelle;
	}

	public function getLibelle(){
		return $this->$libelle;
	}
	//constructeur
	public function __construct($libelle){
		$this-> $libelle = $libelle;
	}
}
?>
