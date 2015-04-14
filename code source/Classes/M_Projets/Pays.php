<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/Monnaie.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/Ville.php');
//require_once(realpath(dirname(__FILE__)) . '/../Class_48.php');

/**
 * @access public
 * @package M_Projets
 */
class Pays {
	/**
	 * @AttributeType String
	 */
	private $pays;
	/**
	 * @AttributeType String
	 */
	private $nomComplet;
	/**
	 * @AttributeType String
	 */
	private $nomAbrege;
	/**
	 * @AssociationType M_Projets.Monnaie
	 */
	public $_;
	/**
	 * @AssociationType M_Projets.Ville
	 * @AssociationKind Aggregation
	 */
	public $unnamed_Ville_;
	/**
	 * @AssociationType Class
	 */
	public $unnamed_Class_48_;
}
?>