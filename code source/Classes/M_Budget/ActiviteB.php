<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/Themes.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/LigneBudget.php');

/**
 * @access public
 * @package M_Budget
 */
class ActiviteB {
	/**
	 * @AttributeType String
	 */
	private $libelle;
	/**
	 * @AttributeType Date
	 */
	private $dateDebut;
	/**
	 * @AttributeType Date
	 */
	private $dateFin;
	/**
	 * @AttributeType float
	 */
	private $montantPrevu;
	/**
	 * @AssociationType M_Budget.Themes
	 */
	public $unnamed_Themes_;
	/**
	 * @AssociationType M_Budget.LigneBudget
	 * @AssociationKind Composition
	 */
	public $unnamed_LigneBudget_;

	//constructeur
	public function __construct($libelle, $dateDebut, $dateFin, $montantPrevu){
		$this->$libelle = $libelle;
		$this->$dateDebut = $dateDebut;
		$this->$dateFin = $dateFin;
		$this->$montantPrevu = $montantPrevu;
		$this->$unnamed_LigneBudget_ = new LigneBudget($libelle, $montantPrevu);
	}

	//getters et setters
	public function setLibelle($libelle){
		$this->$libelle = $libelle;
	}
	public function getLibelle(){
		return  $this->$libelle;
	}

	public function setDateDebut($date){
		$this->$dateDebut = $date;
	}
	public function getDateDebut(){
		return $this->$dateDebut;
	}

	public function setDateFin($date){
		$this->$dateFin = $date;
	}
	public function getDateFin(){
		return $this->$dateFin;
	}

	public function setMontantPrevu($montant){
		$this->$montantPrevu = $montant;
	}
	public function getMontantPrevu(){
		return $this->$montantPrevu;
	}


}
?>
