<?php
//require_once(realpath(dirname(__FILE__)) . '/../M_Budget/LigneBudget.php');
//require_once(realpath(dirname(__FILE__)) . '/../M_Budget/PlanMensuel.php');

/**
 * @access public
 * @package M_SuiviCaisse
 */
class Operation {
	private $id;
	public function   getID() {
		return $this->id;
	}
	public function   setID($id) {
		return $this->id=$id;
	}
	
	/**
	 * @AttributeType String
	 */
	private $libelle;
	public function   getLibelle() {
		return $this->libelle;
	}
	public function   setLibelle($libelle) {
		return $this->libelle=$libelle;
	}
	
	/**
	 * @AttributeType Date
	 */
	private $dateOperation;
	public function   getDateOperation() {
		return $this->dateOperation;
	}
	public function   setDateOperation($dateOperation) {
		return $this->dateOperation=$dateOperation;
	}
	
	/**
	 * @AttributeType double
	 */
	private $sommeOperation;
	public function   getSommeOperation() {
		return $this->sommeOperation;
	}
	public function   setSommeOperation($sommeOperation) {
		return $this->sommeOperation=$sommeOperation;
	}
	
	/**
	 * @AttributeType String
	 */
	private $noteOperation;
	public function   getNoteOperation() {
		return $this->noteOperation;
	}
	public function   setNoteOperation($noteOperation) {
		return $this->noteOperation=$noteOperation;
	}
	
	/**
	 * @AttributeType String
	 * Etat de la soumission peut etre :
	 * - validee
	 * - soumise
	 * - rejetee
	 * - brouillon
	 */
	private $etatSoumission;
	public function   getEtatSoumission() {
		return $this->etatSoumission;
	}
	public function   setEtatSoumission($etatSoumission) {
		return $this->etatSoumission=$etatSoumission;
	}
	
	/**
	 * @AttributeType String
	 */
	private $soumission;
	public function   getSoumission() {
		return $this->soumission;
	}
	public function   setSoumission($soumission) {
		return $this->soumission=$soumission;
	}
	
	/**
	 * @AttributeType String
	 */
	private $referencePaiement;
	public function   getReferencePaiement() {
		return $this->referencePaiement;
	}
	public function   setReferencePaiement($referencePaiement) {
		return $this->referencePaiement=$referencePaiement;
	}
	
	/**
	 * @AttributeType String
	 */
	private $ligneBudget;
	public function   getLigneBudget() {
		return $this->ligneBudget;
	}
	public function   setLigneBudget($ligneBudget) {
		return $this->ligneBudget=$ligneBudget;
	}
	
	/*
	// @AssociationType M_Budget.LigneBudget 
	public $_;
	
	// @AssociationType M_Budget.PlanMensuel
	public $unnamed_PlanMensuel_;
	*/
	
	//hydratation de l objet grace au donnnees de la base
	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);//on construit le setter potentiel pour chak info
	
			if (method_exists($this, $method))
			{
				$this->$method($value);//on fait  l affectation
			}
		}
	}
}
?>