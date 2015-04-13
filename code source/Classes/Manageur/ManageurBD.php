<?php
    /*
    // Connexion au service XE (i.e. la base de donn�es) sur la machine "localhost"
     $conn = oci_pconnect('oxfam', 'passer', 'localhost/XE');
    
    
    if (!$conn) {
    
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    
    $stid = oci_parse($conn, 'SELECT nom FROM utilisateurs');
    oci_execute($stid);
    
    echo "<table border='1'>\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
	 * 
	 * */
    
?>

<?php
	//************************************************************************
	// ****************** MANAGEUR UTILISATEUR *******************************
    require(dirname(__FILE__)."/../M_Utilisateur/Utilisateur.php");
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
            $q = $this->getPDO()->prepare('INSERT INTO utilisateurs SET password = :password, nom = :nom, prenom = :prenom,  email = :email, profil = :profil');
            $q->bindValue(':nom', $uti->getNom());
            $q->bindValue(':prenom', $uti->getPrenom()); 
            $q->bindValue(':email', $uti->getEmail());
            $q->bindValue(':profil', $uti->getProfil());
            $q->bindValue(':password', $uti->getPassword());
            $q->execute();
            //on infor l objet de son id dans la base
            $uti->hydrate(array(
                    'id' => $this->getPDO()->lastInsertId()
            ));
        }
         public function countUtilisateur($options){
            $utilisateurs = array();
            $q = $this->getPDO()->prepare('SELECT COUNT(*)  FROM utilisateurs ');
            $q->execute();
            return $q->fetchColumn();
    
        }
        public function deleteUtilisateur(Utilisateur $uti){
            $this->getPDO()->exec('DELETE FROM utilisateurs WHERE id = '.$uti->geId());
        }
        //regarde
        public function deleteUtilisateurByEmail($id){
    
    
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
            if (is_int($info)){//si c est l id
              $q = $this->getPDO()->query('SELECT * FROM utilisateurs WHERE id = '.$info);
              $uti = $q->fetch(PDO::FETCH_ASSOC);
            }
            else{//a partir d l email
              $q = $this->getPDO()->prepare('SELECT email,password,nom,prenom FROM utilisateurs WHERE email = :email');
              $q->execute(array(':email' => $info));
    
              $uti = $q->fetch(PDO::FETCH_ASSOC);
            }
            $q->closeCursor();
            if($uti==null) return null;
             return new Utilisateur($uti);
    
        }
    
    //revoi un tableau d utilisateur
         public function getListUtilisateur(){
            //echo var_dump( $options);
            $utilisateurs = array();
            $q = $this->getPDO()->prepare('SELECT nom,prenom,email,profil FROM utilisateurs ');
            $q->execute();
            $tas=$q->fetchAll(PDO::FETCH_ASSOC);
            //$rows = $q->fetchAll(PDO::FETCH_CLASS, 'ArrayObject');
             foreach ( $tas  as $donnees){
    
             $utilisateurs[] = new Utilisateur($donnees); 
            }
            $q->closeCursor();
            unset($q);unset($tas);		
            return $utilisateurs;
      }
        public function update(Utilisateur $uti){
            $q = $this->getPDO()->prepare('UPDATE utilisateurs SET nom = :nom, prenom = :prenom, adresse = :adresse, telephone = :telephone,  email = :email,profil = :profil, password = :password WHERE id = :id');
            $q->bindValue(':id', $uti->getId(), PDO::PARAM_INT);
            $q->bindValue(':nom', $uti->getNom(), PDO::PARAM_INT);
            $q->bindValue(':prenom', $uti->getPrenom(), PDO::PARAM_INT);
            $q->bindValue(':adresse', $uti->getAdresse(), PDO::PARAM_INT);
            $q->bindValue(':email', $uti->getEmail(), PDO::PARAM_INT);
            $q->bindValue(':profil', $uti->getProfil(), PDO::PARAM_INT);
            $q->bindValue(':password', $uti->getPassword(), PDO::PARAM_INT);
            $q->execute();
            $q->closeCursor();
        }
    
        public function getListUtilisateurNew(){
    
      }
         public function countUtilisateurNew(){
    
        }
    
    }//fin class ManageurUtilisateur
	
	
	// *******************************************************************************
	// *************************** MANAGEUR OPERATIONS  ******************************
	require_once(realpath(dirname(__FILE__)) . '/../M_SuiviCaisse/OperationBanque.php');
	require_once(realpath(dirname(__FILE__)) . '/../M_SuiviCaisse/OperationCaisse.php');
    class ManageurOperation{
        /**
         * Instance de la classe ManageurOperation:singleton
         *
         * @var ManageurOperation
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
        const DEFAULT_ORACLE_USER = 'oxfam';
        /**
        * Constante: hote de la bdd
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
        const DEFAULT_ORACLE_NS = 'oxfam';//bon bon oxfam lors de l integration
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
                $this->PDOInstance  = new PDO("oci:dbname=".self::DEFAULT_ORACLE_SERVICE,self::DEFAULT_ORACLE_USER,self::DEFAULT_ORACLE_PASS,array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
		    }catch(PDOException $e){
            	
                echo ($e->getMessage());
            }
    
         }
        /**
        * Cree et retourne l'objet ManageurOperation : Singleton
        *
        * @access public
        * @static
        * @param void
        * @return ManageurOperation $instance
        */
        public static function getInstance(){
            if(is_null(self::$instance)){
            	self::$instance = new ManageurOperation();
            }
            return self::$instance;
        }
        public function getPDO(){
            $this->PDOInstance  = new PDO("oci:dbname=".self::DEFAULT_ORACLE_SERVICE,self::DEFAULT_ORACLE_USER,self::DEFAULT_ORACLE_PASS,array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
            return $this->PDOInstance ;
        }
        /*methodes de manipulation des operations */
    
         public function addOperationBanque(OperationBanque $opBanque){
            $q = $this->getPDO()->prepare('select TO_CHAR(ref(l)) from lignebudget l where (l.libelle=\'bugget1\')');
            try {
            	$opBanque->setLigneBudget($q->execute()->fetchColumn());
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }	
            $q = $this->getPDO()->prepare('INSERT INTO operationBanque SET libelle = :libelle, dateOperation = :dateOperation, sommeOperation = :sommeOperation,  noteOperation = :noteOperation, etatSoumission = :etatSoumission, soumission = :soumission, referencePaiement = :referencePaiement , typeOpBancaire = :typeOpBancaire');
            $q->bindValue(':libelle', $opBanque->getLibelle());
            $q->bindValue(':dateOperation', $opBanque->getDateOperation()); 
            $q->bindValue(':sommeOperation', $opBanque->getSommeOperation());
            $q->bindValue(':noteOperation', $opBanque->getNoteOperation());
            $q->bindValue(':etatSoumission', $opBanque->getEtatSoumission());
			$q->bindValue(':soumission', $opBanque->getSoumission());
			$q->bindValue(':referencePaiement', $opBanque->getReferencePaiement());
			$q->bindValue(':typeOpBancaire', $opBanque->getTypeOpBancaire());
			//$q->bindValue(':ligneBudget', $opBanque->getLigneBudget);
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
            //on informe l'objet de son id dans la base
            // $opBanque->hydrate(array(
                    // 'id' => $this->getPDO()->lastInsertId()
            // ));
        }
		public function addOperationCaisse(OperationCaisse $opCaisse){
			$q = $this->getPDO()->prepare('select TO_CHAR(ref(l)) from lignebudget l where (l.libelle=\'bugget1\')');
            try {
            	$opCaisse->setLigneBudget($q->execute()->fetchColumn());
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
            $q = $this->getPDO()->prepare('INSERT INTO operationCaisse values (seq_opCaisse.NEXTVAL, :libelle, :dateOperation, :sommeOperation, :noteOperation, :etatSoumission, :soumission, :referencePaiement, :ligneBudget, :numRecu)');
            $q->bindParam (':libelle', $opCaisse->getLibelle());
            $q->bindParam(':dateOperation', date_format(date_create($opCaisse->getDateOperation()), 'd-m-Y')); 
            $q->bindParam(':sommeOperation', $opCaisse->getSommeOperation());
            $q->bindParam(':noteOperation', $opCaisse->getNoteOperation());
            $q->bindParam(':etatSoumission', $opCaisse->getEtatSoumission());
			$q->bindParam(':soumission', $opCaisse->getSoumission());
			$q->bindParam(':referencePaiement', $opCaisse->getReferencePaiement());
			$q->bindParam(':ligneBudget', $opCaisse->getLigneBudget());
			$q->bindParam(':numRecu', $opCaisse->getNumRecu());
			
			try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
            
        }
        public function countOperationBanque(){
            $q = $this->getPDO()->prepare('SELECT COUNT(*)  FROM operationBanque ');
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
            return $q->fetchColumn();
        }
		public function countOperationCaisse(){
            $q = $this->getPDO()->prepare('SELECT COUNT(*)  FROM operationCaisse ');
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
            return $q->fetchColumn();
        } 
		
        public function deleteOperationBanque($idOpBanque){
            $this->getPDO()->exec('DELETE FROM OperationBanque WHERE id = '.$idOpBanque);
        }
		public function deleteOperationCaisse($idOpCaisse){
            $this->getPDO()->exec('DELETE FROM OperationCaisse WHERE id = '.$idOpCaisse);
        }
		
        public function getOperationBanque($id){
            $opBanque=array();
            if (is_int($info)){
              $q = $this->getPDO()->query('SELECT * FROM OperationBanque WHERE id = '.$id);
              $opBanque = $q->fetch(PDO::FETCH_ASSOC);
            }
        }
		public function getOperationCaisse($id){
            $opCaisse=array();
            if (is_int($info)){
              $q = $this->getPDO()->query('SELECT * FROM OperationCaisse WHERE id = '.$id);
              $opCaisse = $q->fetch(PDO::FETCH_ASSOC);
            }
        }
    	
		  public function getListOperationBanque(){
	        $opBanque = array();
	        $q = $this->getPDO()->prepare('SELECT * FROM OperationBanque ');
	        try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
	        $tas=$q->fetchAll(PDO::FETCH_ASSOC);
	         foreach ( $tas  as $donnees){
	
	         $opBanque[] = new OperationBanque($donnees); 
	        }
	        $q->closeCursor();
	        unset($q);unset($tas);		
	        return $opBanque;
      	 }
		  
	     public function getListOperationCaisse($idLigneBudget){
	        $opCaisse = array();
	        //$q = $this->getPDO()->prepare('SELECT id, libelle, dateOperation, sommeOperation, noteOperation, etatSoumission, soumission, referencePaiement, TO_CHAR(ligneBudget), numRecu FROM OperationCaisse ');
	        $q = $this->getPDO()->prepare('SELECT * FROM OperationCaisse where lignebudget='.$idLigneBudget);
	        try {
            	$q->execute();
				$tas=$q->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo ($e->getMessage());
            }
			
	         foreach ( $tas  as $donnees){
	         	$opCaisse[] = new OperationCaisse($donnees); 
	         }
	        $q->closeCursor();
	        unset($q);unset($tas);
	        return $opCaisse;
      	}
		 
		 
        public function updateOperationBanque(OperationBanque $opBanque){
            $q = $this->getPDO()->prepare('UPDATE operationBanque SET libelle = :libelle, dateOperation = :dateOperation, sommeOperation = :sommeOperation,  noteOperation = :noteOperation, etatSoumission = :etatSoumission, soumission = :soumission, referencePaiement = :referencePaiement , typeOpBancaire = :typeOpBancaire WHERE id = :id');
            $q->bindValue(':libelle', $opBanque->getLibelle());
            $q->bindValue(':dateOperation', $opBanque->getDateOperation()); 
            $q->bindValue(':sommeOperation', $opBanque->getSommeOperation());
            $q->bindValue(':noteOperation', $opBanque->getNoteOperation());
            $q->bindValue(':etatSoumission', $opBanque->getEtatSoumission());
			$q->bindValue(':soumission', $opBanque->getSoumission());
			$q->bindValue(':referencePaiement', $opBanque->getReferencePaiement());
			$q->bindValue(':typeOpBancaire', $opBanque->getTypeOpBancaire());
            $q->bindValue(':id', $opBanque->getId());
            $q->execute();
            $q->closeCursor();
        }
		
		public function updateOperationCaisse(OperationCaisse $opCaisse){
            $q = $this->getPDO()->prepare('UPDATE operationCaisse SET libelle = :libelle, dateOperation = :dateOperation, sommeOperation = :sommeOperation,  noteOperation = :noteOperation, etatSoumission = :etatSoumission, soumission = :soumission, numRecu = :numRecu WHERE id = :id');
            $q->bindValue(':libelle', $opCaisse->getLibelle());
            $q->bindValue(':dateOperation', $opCaisse->getDateOperation()); 
            $q->bindValue(':sommeOperation', $opCaisse->getSommeOperation());
            $q->bindValue(':noteOperation', $opCaisse->getNoteOperation());
            $q->bindValue(':etatSoumission', $opCaisse->getEtatSoumission());
			$q->bindValue(':soumission', $opCaisse->getSoumission());
			$q->bindValue(':numRecu', $opCaisse->getNumRecu());
            $q->bindValue(':id', $opCaisse->getId());
            $q->execute();
            $q->closeCursor();
        }
    
    }//fin class ManageurOperation
  

    //************************************************************************************
    //***************************** Manager Budget **************************************
    
	require_once(realpath(dirname(__FILE__)) . '/../M_Budget/BudgetProjet.php');
	require_once(realpath(dirname(__FILE__)) . '/../M_Budget/LigneBudget.php');
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/PlanAnnuel.php");
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/PlanMensuel.php");
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/Themes.php");
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/AnneeComptable.php");
	require_once(realpath(dirname(__FILE__)) . "/../M_Budget/ActiviteB.php");

class ManageurBudget{
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
	const DEFAULT_SQL_USER = 'riki';
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
	const DEFAULT_SQL_DTB = 'oxfam';
	/**
	* Constructeur
	*
	* @param void
	* @return void
	* @see PDO::__construct()
	* @access private
	*/
	private function __construct(){
		$conn = oci_pconnect('riki', 'passer', 'localhost/XE');
	 }
	/**
	* Crée et retourne l'objet Manageur2 : Singleton
	*
	* @access public
	* @static
	* @param void
	* @return Manageur2 $instance
	*/
		public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new Manageur2();
		}
		return self::$instance;
	}
	public function getPDO(){
		$conn = oci_pconnect('riki', 'passer', 'localhost/XE');
		return $conn;
	}
	/*methodes de manipulation des utilisateurs */

	public function addMois(Mois $m){

		$request = 'insert into Mois(code, libelle, etat)'.
					'values (:code, :lib , :etat)'; 
		$insert = oci_parse($this->getPDO(), $request);
		oci_bind_by_name($insert, ':code', $m->getCode);
		oci_bind_by_name($insert, ':lib', $m->getLibelle);
		oci_bind_by_name($insert, ':etat', $m->getEtat);

		$execute = oci_execute($insert);
		if ($execute != 0){
			echo "reussi";
		}
		else
			echo "erreur exe: ".$execute;
		return $execute;
	}
	 public function addEltPlanMensuel($options){
	 	$request = 'insert into ElementPlanMensuel(code, libelle, montant)'.
					'values (:code, :lib , :montant)'; 
		$insert = oci_parse($this->getPDO(), $request);
		oci_bind_by_name($insert, ':code', $m->getCode);
		oci_bind_by_name($insert, ':lib', $m->getLibelle);
		oci_bind_by_name($insert, ':montant', $m->getMontant);

		$execute = oci_execute($insert);
		if ($execute != 0){
			echo "reussi";
		}
		else
			echo "erreur exe: ".$execute;
		return $execute;
	 
	}
	 public function addLigneBudget(LigneBudget $l){
	 	$request = 'insert into LigneBudget(libelle, montantprevu, montantexecute)'.
					'values (:lib, :mntprev, :mntexec)'; 
		$insert = oci_parse($this->getPDO(), $request);
		oci_bind_by_name($insert, ':lib', $l->getLibelle);
		oci_bind_by_name($insert, ':mntprev', $l->getMontantPrevu);
		oci_bind_by_name($insert, ':mntexec', $l->getMontantExecute);

		$execute = oci_execute($insert);
		if ($execute != 0){
			echo "reussi";
		}
		else
			echo "erreur exe: ".$execute;
		return $execute;
	}

	//Pour fermer un plan mensuel il suffit tout juste de mettre son etat à "fermer" 
	//RMQ = Un plan mensuel ouvert a un état "ouvert"
	//Dans la classe Manager
	public function closePlanMensuel(PlanMensuel $toClose){
		$toClose->$mois->setEtat("fermer");
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

	//cette méthode permet de récuperer la liste des thèmes dans la base de données
	//Elle est utile dans l'ajoute d'une opération
	public function getListeThemes(){
		$query = 'SELECT TO_CHAR(ref(t)) , libelle  FROM  Themes t'; //on peut aussi passer par la classe BudgetProjet pour selecter la listeTheme
		$parse = oci_parse($this->getPDO(), $query);
		$execute = oci_execute($request);
		return $execute;
	}  

	//Cette méthode permet de récuperer dans la base de données la liste des ligne budgetaires
	public function getListLigneBudgetaire(){
		$query = 'SELECT TO_CHAR(ref(l)) , libelle FROM  LigneBudget l'; 
		$parse = oci_parse($this->getPDO(), $query);
		$execute = oci_execute($request);
		return $execute;
	}

}//fin class Manager budget
?>
