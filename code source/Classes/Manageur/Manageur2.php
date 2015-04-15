<?php
	//require("../M_Utilisateur/Utilisateur.php");

	require_once(realpath(dirname(__FILE__)) . '/../M_Budget/BudgetProjet.php');
	require_once(realpath(dirname(__FILE__)) . '/../M_Budget/LigneBudget.php');
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/PlanAnnuel.php");
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/PlanMensuel.php");
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/Themes.php");
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/AnneeComptable.php");
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/ActiviteB.php");
	require_once  (dirname(__FILE__)."/../M_Utilisateur/Utilisateur.php");
	require_once(dirname(__FILE__)."/../M_Utilisateur/GroupeUtilisateur.php");

class Manageur2{
	/**
	* Instance de la classe PDO
	*
	* @var PDO
	* @access private
	*/
	private $PDOInstance = null;
	/**
	* Instance de la classe Manageur2
	*
	* @var Manageur2
	* @access private
	* @static
	*/
	private static $instance = null;
	/**
	* Constante: nom d'utilisateur de la bdd
	*
	* @var string
	*/
	const DEFAULT_SQL_USER = 'darcia';
	/**
	* Constante: hôte de la bdd
	*
	* @var string
	*/
	const DEFAULT_SQL_HOST = 'localhost/XE';
	/**
	* Constante: hôte de la bdd
	*
	* @var string
	*/
	const DEFAULT_SQL_PASS = 'passer';
	/**
	* Constante: nom de la bdd
	*
	* @var string
	*/
	const DEFAULT_SQL_DTB = 'darcia';
	/**
	* Constructeur
	*
	* @param void
	* @return void
	* @see PDO::__construct()
	* @access private
	*/private function __construct(){
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
            self::$instance = new Manageur2();
            }
            return self::$instance;
        }
        public function getPDO(){
            $this->PDOInstance  = new PDO("oci:dbname=".'localhost/XE','darcia','passer',array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
            return $this->PDOInstance ;
    
        }
	/*methodes de manipulation des utilisateurs */

	public function addMois(Mois $m){

		$request = $this->getPDO()->prepare('insert into Mois(code, libelle, etat)'.
					'values (:code, :lib , :etat)'); 
		//$request = oci_parse($this->getPDO(), $request);
		$request->bindValue(':code', $m->getCode());
		$request->bindValue(':lib', $m->getLibelle());
		$request->bindValue(':etat', $m->getEtat());
		$request->execute();
		$request->execute();

		//$execute = oci_execute($request);
		if ($request->execute() != 0){
			echo "<p font = '12' color = 'blue'><strong> ajout reussi </strong></p>";		}
		else
			echo "<p font = '12' color = 'red'><strong> erreur lors de l'ajout </strong></p>";
		return $request->execute();
	}
	 public function addEltPlanMensuel($m){
	 	$request = $this->getPDO()->prepare('insert into ElementPlanMensuel(code, libelle, montant)'.
					'values (:code, :lib , :montant)'); 
		//$request->bindValue($this->getPDO(), $request);
		$request->bindValue(':code', $m->getCode());
		$request->bindValue(':lib', $m->getLibelle());
		$request->bindValue(':montant', $m->getMontant());

		$request->execute();
		// = oci_execute($request);
		if ($request->execute() != 0){
			echo "<p font = '12' color = 'blue'><strong> ajout reussi </strong></p>";
		}
		else
			echo "<p font = '12' color = 'red'><strong> erreur lors de l'ajout </strong></p>";
		return $request->execute();
	 
	}
	 public function addLigneBudget(LigneBudget $l){
	 	$request = $this->getPDO()->prepare( 'insert into LigneBudget(libelle, montantprevu, montantexecute)'.
					'values (:lib, :mntprev, :mntexec)'); 
		//$request = oci_parse($this->getPDO(), $request);
		$request->bindValue(':lib', $l->getLibelle());
		$request->bindValue(':mntprev', $l->getMontantPrevu());
		$request->bindValue(':mntexec', $l->getMontantExecute());

		$request->execute();

		//$execute = oci_execute($request);
		if ($request->execute() != 0){
			echo "<p font = '12' color = 'blue'><strong> ajout reussi </strong></p>";
		}
		else
			echo "<p font = '12' color = 'blue'><strong> erreur lors de l'ajout de ".$l->getLibelle."</strong></p>";
		return $request->execute();
	}

	public function listMois(AnneeComptable $an){
		$tab = array();
		$i = 0;
		for ($i=0; $i<count($an->unnamed_Mois_); $i++) {
		 	# code...
		 	$tab[$i] = $an->unnamed_Mois_[$i]; 
		 } 

		 return $tab;
	}

	public function deleteUtilisateurById($id){
		
		
	}
	public function existUtilisateur($info){
		
	}
	public function getUtilisateur($info){
	}
	
	
	public function getUtilisateurByEmail($info){
	
	}
	 public function getListUtilisateur(){
	 
  }
	public function update(Utilisateur $uti){
		
	}

	public function getListUtilisateurNew(){
	 	
  }
  	 public function countUtilisateurNew(){
	
	}
 
}//fin class ManageurDb

//c
?>