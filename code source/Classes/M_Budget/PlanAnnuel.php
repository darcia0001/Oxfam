<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/BudgetProjet.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/AnneeComptable.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/PlanMensuel.php');

/**
 * @access public
 * @package M_Budget
 */
class PlanAnnuel {
	/**
	 * @AttributeType String
	 */
	private $libelle;
	/**
	 * @AttributeType String
	 */
	private $code;
	/**
	 * @AttributeType double
	 */
	private $montamtTotalPrevu;
	/**
	 * @AssociationType M_Budget.BudgetProjet
	 */
	public $unnamed_BudgetProjet_;
	/**
	 * @AssociationType M_Budget.AnneeComptable
	 */
	public $_;
	/**
	 * @AssociationType M_Budget.PlanMensuel
	 * @AssociationKind Composition
	 */
	public $unnamed_PlanMensuel_;
	//constructeur
	public function __construct($libelle, $code, $montamtTotalPrevu){
		$this->libelle = $libelle;
		$this->code = $code;
		$this->montamtTotalPrevu = $montamtTotalPrevu;
		$this->unnamed_PlanMensuel_ = new PlanMensuel($code, $libelle);
	}
}
?>