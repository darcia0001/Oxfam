<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Utilisateur/Utilisateur.php');

/**
 * @access public
 * @package M_Utilisateur
 */
class Structure {
	/**
	 * @AssociationType M_Utilisateur.Utilisateur
	 */
	public $utilisateur;
	private $id;
	private $nom;
	//constructeur
	public function __construct($donnees)	{
		$this->hydrate($donnees);
	}
	public function   getId() {
		return $this->id;
	}
	
	public function setId( $id) {
		$this->id = $id;
	}
	public function getNom() {
		return $this->nom;
	}
	public function setNom($nom) {
	
		$this->nom = $nom;
	
	}
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