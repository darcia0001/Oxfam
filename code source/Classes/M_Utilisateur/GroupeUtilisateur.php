<?php
require_once(realpath(dirname(__FILE__)) . '/../M_Utilisateur/Utilisateur.php');
require_once(realpath(dirname(__FILE__)) . '/../M_Utilisateur/Privilege.php');

/**
 * @access public
 * @package M_Utilisateur
 */
class GroupeUtilisateur {
	public $nom;
	public $id;
	/**
	 * @AssociationType M_Utilisateur.Privilege
	 * @AssociationKind Aggregation
	 */
	public $privilege;
	public function __construct($donnees)	{
		$this->hydrate($donnees);
	}
	public function getPrivilege(){
		return $privilege;
	}
	public function setPrivilege($privilege){
		$this->privilege=$privilege;
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