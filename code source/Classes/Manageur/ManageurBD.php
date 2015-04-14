

<?php
require_once  (dirname(__FILE__)."/../M_Utilisateur/Utilisateur.php");
require_once(dirname(__FILE__)."/../M_Utilisateur/GroupeUtilisateur.php");
class ManageurUtilisateur{
	/**
	 * Instance de la classe ManageurBD:singleton
	 *
	 * @var ManageurBD
	 * @access private
	 * @static
	 */
	private static $instance = null;
	/**
	*  Instance de la classe PDO
	*
	* @var PDO
	* @access private
	*/
	private $PDOInstance = null;
	
	/**
	* Constante: nom d'utilisateur de la bdd
	*
	* @var string
	*/
	const DEFAULT_ORACLE_USER = 'darcia';
	/**
	* Constante: hôte de la bdd
	*
	* @var string
	*/
	const DEFAULT_ORACLE_SERVICE = 'localhost/XE';
	/**
	* Constante: hôte de la bdd
	*
	* @var string
	*/
	const DEFAULT_ORACLE_PASS = 'passer';
	/**
	* Constante: nom de la bdd
	*
	* @var string
	*/
	const DEFAULT_ORACLE_NS = 'darcia';//bon bon oxfam lors de l integration
	/**
	* Constructeur private:singleton
	*
	* @param void
	* @return void
	* @see PDO::__construct()
	* @access private
	*/
	private function __construct(){
		try{
			$this->PDOInstance  = new PDO("oci:dbname=".'localhost/XE','darcia','passer',array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
			
		}catch(PDOException $e){
			echo ($e->getMessage());
		}
		
	 }
	/**
	* Cree et retourne l'objet ManageurBD : Singleton
	*
	* @access public
	* @static
	* @param void
	* @return ManageurBD $instance
	*/
	public static function getInstance(){
		if(is_null(self::$instance)){
		self::$instance = new ManageurUtilisateur();
		}
		return self::$instance;
	}
	public function getPDO(){
		$this->PDOInstance  = new PDO("oci:dbname=".'localhost/XE','darcia','passer',array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
		return $this->PDOInstance ;
			 
	}
	/*methodes de manipulation des utilisateurs */

	public function addUtilisateur(Utilisateur $uti){
	 	echo var_dump($uti);
		$q = $this->getPDO()->prepare("insert into utilisateurs values (:nom , :prenom , :email , :password , :profil ,
	(select REF(a) from GROUPES_UTILISATEUR a where a.nom= :profil ),
	(select REF(a) from STRUCTURES a where a.nom= :structure  ))");
		$q->bindValue(':nom', $uti->getNom());
		$q->bindValue(':prenom', $uti->getPrenom()); 
		$q->bindValue(':email', $uti->getEmail());
		$q->bindValue(':profil', $uti->getProfil());
		$q->bindValue(':password', $uti->getPassword());
		$q->bindValue(':structure', $uti->getStructure());
		$q->execute();
		//on infor l objet de son id dans la base
		
	}
	public function countUtilisateur($options){
		$utilisateurs = array();
		$q = $this->getPDO()->prepare('SELECT COUNT(*)  FROM utilisateurs ');
		$q->execute();
		return $q->fetchColumn();
	 
	}
	
	//regarde
	public function deleteUtilisateurByEmail($email){
		$this->getPDO()->exec("DELETE FROM utilisateurs WHERE email = '".$email."'");
		
	}
	
	public function existUtilisateur($info){//pertinance
		if (is_int($info)) // si l argument est un int On veut voir si tel utilisateur ayant pour id $info existe.
		{
			return (bool) $this->getPDO()->query('SELECT COUNT(*) FROM utilisateurs WHERE id = '.$info)->fetchColumn();
		}
	
		// Sinon, c'est qu'on veut v�rifier en utilisant l email  .
	
		$q = $this->getPDO()->prepare('SELECT COUNT(*) FROM utilisateurs WHERE email = :email');
		$q->execute(array(':email' => $info));
		$r=(bool) $q->fetchColumn();
		$q->closeCursor();
		return $r;
	}
	///recoit en parametre soit l id soit l' email et retour l utilisateur correspondant
	public function getUtilisateur($info){
		$uti=array();
		//a partir d l email
		  $q = $this->getPDO()->prepare('SELECT a.nom,a.prenom,a.email,a.profil,a.password,
				a.STRUCTURE.nom as structure,a.GROUPE_UTILISATEUR.nom as groupeUtilisateur FROM utilisateurs a WHERE a.email = :email');
		  $q->execute(array(':email' => $info));
		  
		  $uti = $q->fetch(PDO::FETCH_ASSOC);
		
		$q->closeCursor();
		if($uti==null) return null;
		 return new Utilisateur($uti);

	}
	
//revoi un tableau d utilisateur
	 public function getListUtilisateur(){
	 	//echo var_dump( $options);
		$utilisateurs = array();
		$q = $this->getPDO()->prepare('SELECT a.nom,a.prenom,a.email,a.profil,
				a.STRUCTURE.nom as structure,a.GROUPE_UTILISATEUR.nom as groupeUtilisateur FROM utilisateurs a');
		$q->execute();
		$tas=$q->fetchAll(PDO::FETCH_ASSOC);
		foreach ( $tas  as $donnees){
		 	 
		 $utilisateurs[] = new Utilisateur($donnees); 
		}
		$q->closeCursor();
		unset($q);unset($tas);		
		return $utilisateurs;
  }

  public function countGroupe(){
  	$utilisateurs = array();
  	$q = $this->getPDO()->prepare('SELECT COUNT(*)  FROM GROUPES_UTILISATEUR ');
  	$q->execute();
  	return $q->fetchColumn();
  
  }
	public function update(Utilisateur $uti){
		$q = $this->getPDO()->prepare('UPDATE utilisateurs SET  
				structure= (select ref(s) from structures s where s.nom =:structure ),
				GROUPE_UTILISATEUR=(select ref(g) from GROUPES_UTILISATEUR g where g.nom =:groupe ),
				nom = :nom, prenom = :prenom,   email = :email,profil = :profil, password = :password WHERE email = :email');
		$q->bindValue(':nom', $uti->getNom(), PDO::PARAM_INT);
		$q->bindValue(':prenom', $uti->getPrenom(), PDO::PARAM_INT);
		$q->bindValue(':email', $uti->getEmail(), PDO::PARAM_INT);
		$q->bindValue(':profil', $uti->getProfil(), PDO::PARAM_INT);
		$q->bindValue(':password', $uti->getPassword(), PDO::PARAM_INT);
		$q->bindValue(':structure', $uti->getStructure(), PDO::PARAM_INT);
		$q->bindValue(':groupe', $uti->getGroupeUtilisateur(), PDO::PARAM_INT);
		//echo var_dump($q);
		$q->execute();
		$q->closeCursor();
	}

public function getListStructure(){
	 	//echo var_dump( $options);
		$structures = array();
		$q = $this->getPDO()->prepare("select  a.nom from STRUCTURES a ");
		$q->execute();
		$tas=$q->fetchAll(PDO::FETCH_ASSOC);
		//$rows = $q->fetchAll(PDO::FETCH_CLASS, 'ArrayObject');
		 foreach ( $tas  as $donnees){
		 	 
		 $structures[] = new Structure($donnees); 
		}
		$q->closeCursor();
		unset($q);unset($tas);		
		return $structures;
  }
  public function getListGroupe(){
  	//echo var_dump( $options);
  	$groupeutilisateurs = array();
  	$q = $this->getPDO()->prepare('SELECT g.nom FROM GROUPES_UTILISATEUR g ');
  	$q->execute();
  	$tas=$q->fetchAll(PDO::FETCH_ASSOC);
  	//$rows = $q->fetchAll(PDO::FETCH_CLASS, 'ArrayObject');
  	foreach ( $tas  as $donnees){
  		  
  		$groupeutilisateurs[] = new GroupeUtilisateur($donnees);
  	}
  	$q->closeCursor();
  	unset($q);unset($tas);
  	return $groupeutilisateurs;
  }
}//fin class ManageurDb

//c
?>