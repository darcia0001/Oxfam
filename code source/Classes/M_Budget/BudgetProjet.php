<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/PlanAnnuel.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/Projet.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/Themes.php');

/**
 * @access public
 * @package M_Budget
 */
class BudgetProjet {
	/**
	 * @AttributeType double
	 */
	private $montantDemande;
	/**
	 * @AttributeType double
	 */
	private $montantAttribue;
	/**
	 * @AttributeType double
	 */
	private $montantExecute;
	/**
	 * @AttributeType double
	 */
	private $montantRestant;
	/**
	 * @AssociationType M_Budget.PlanAnnuel
	 */
	public $unnamed_PlanAnnuel_;
	/**
	 * @AssociationType M_Projets.Projet
	 */
	public $_;
	/**
	 * @AssociationType M_Budget.Themes
	 * @AssociationKind Composition
	 */
	public $unnamed_Themes_;

	//constructeur
	public function __construct($montantDemande, $montantAttribue,
				 $montantExecute, $libelle){
		$this->$montantDemande = $montantDemande;
		$this->$montantExecute = $montantExecute;
		$this->$montantAttribue = $montantAttribue;
		$this->$montantRestant = $montantDemande - $montantAttribue;
		$this->$unnamed_Themes_ = new Themes($libelle);
	}

	//methodes


	//getters et setters
	public function setMontantDemande($montant){
		$this->$montantDemande = $montant;
	}

	public function getMontantDemande(){
		return $this->$montantDemande;
	}

	public function setMontantAttribue($montant){
		$this->$montantAttribue = $montant;
	}

	public function getMontantAttribue(){
		return $this->$montantAttribue;
	}

	public function setMontantExecute($montant){
		$this->$montantExecute = $montant;
	}

	public function getMontantExecute(){
		return $this->$montantExecute;
	}

	public function setMontantRestant($montant){
		$this->$montantRestant = $montant;
	}

	public function getMontantRestant(){
		return $this->$montantRestant;
	}

}
?>
