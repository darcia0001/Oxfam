<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/Ville.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Budget/BudgetProjet.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/SecteurActivite.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Projets/CategorieProjet.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Utilisateur/Structure.php');

/**
 * @access public
 * @package M_Projets
 */
class Projet extends Structure {
	/**
	 * @AttributeType String
	 */
	private $nom;
	/**
	 * @AssociationType M_Projets.Ville
	 */
	private $villeProjet;
	/**
	 * @AssociationType M_Budget.BudgetProjet
	 */
	//public $unnamed_BudgetProjet_;
	
	private $secteurActivite;

	private $categorieProjet;

	/**
	 * @AssociationType M_Projets.SecteurActivite
	 */
	//public $_;

	public function __construct(/*$donnees*/)	{
		//$this->hydrate($donnees);
	}

	//hydratation de l objet grace au donnnees de la base
	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value){
			$method = 'set'.ucfirst($key);//on construit le setter potentiel pour chak info
	
			if (method_exists($this, $method)){
				$this->$method($value);//on fait  l affectation
			}
		}
	}

	public function getNom(){ return $this->nom; }
	public function setNom($n){ $this->nom= $n; }

	public function getVilleProjet(){ return $this->villeProjet; }
	public function setVilleProjet($val){ $this->villeProjet= $val; } 
	
	public function getCategorie(){ return $this->categorieProjet; }
	public function setCategorie($val){ $this->categorieProjet= $val; }
	
	public function getSecteur(){ return $this->secteurActivite; }
	public function setSecteur($val){ $this->secteurActivite= $val; }
}
?>