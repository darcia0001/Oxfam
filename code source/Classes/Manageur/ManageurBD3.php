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
	
	
	
	// *******************************************************************************
	// *************************** MANAGEUR OPERATIONS  ******************************
	require_once(realpath(dirname(__FILE__)) . '/../M_SuiviCaisse/Operation.php');
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
        const DEFAULT_ORACLE_USER = 'darcia';
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
            // $q = $this->getPDO()->prepare('select id from lignebudget l where (l.libelle=\'bugget1\')');
            // try {
            	// $opCaisse->setLigneBudget($q->execute()->fetchColumn());
            // }catch(PDOException $e){	
                // echo ($e->getMessage());
            // }
            
            $opBanque->setLigneBudget(1); // test
            $q = $this->getPDO()->prepare('INSERT INTO operationBanque values (seq_opCaisse.NEXTVAL, :libelle, NULL, :sommeOperation, :noteOperation, :etatSoumission, :soumission, :referencePaiement, :ligneBudget, :typeOpBancaire, :referenceOperation)');
            $q->bindValue (':libelle', $opBanque->getLibelle());
            //$q->bindValue(':dateOperation', date_format(date_create($opBanque->getDateOperation()), 'd-m-Y')); 
            $q->bindValue(':sommeOperation', $opBanque->getSommeOperation());
            $q->bindValue(':noteOperation', $opBanque->getNoteOperation());
            $q->bindValue(':etatSoumission', $opBanque->getEtatSoumission());
			$q->bindValue(':soumission', $opBanque->getSoumission());
			$q->bindValue(':referencePaiement', $opBanque->getReferencePaiement());
			$q->bindValue(':ligneBudget', $opBanque->getLigneBudget());
			$q->bindValue(':typeOpBancaire', $opBanque->getTypeOpBancaire());
			$q->bindValue(':referenceOperation', $opBanque->getReferenceOperation());
			try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
        }
		public function addOperationCaisse(OperationCaisse $opCaisse){
			// $q = $this->getPDO()->prepare('select id from lignebudget l where (l.libelle=\'bugget1\')');
            // try {
            	// $opCaisse->setLigneBudget($q->execute()->fetchColumn());
            // }catch(PDOException $e){	
                // echo ($e->getMessage());
            // }
            $opCaisse->setLigneBudget(1); // test
            $q = $this->getPDO()->prepare('INSERT INTO operationCaisse values (seq_opCaisse.NEXTVAL, :libelle, NULL, :sommeOperation, :noteOperation, :etatSoumission, :soumission, :referencePaiement, :ligneBudget, :numRecu)');
            $q->bindValue (':libelle', $opCaisse->getLibelle());
            //$q->bindValue(':dateOperation', date_format(date_create($opCaisse->getDateOperation()), 'd-m-Y')); 
            $q->bindValue(':sommeOperation', $opCaisse->getSommeOperation());
            $q->bindValue(':noteOperation', $opCaisse->getNoteOperation());
            $q->bindValue(':etatSoumission', $opCaisse->getEtatSoumission());
			$q->bindValue(':soumission', $opCaisse->getSoumission());
			$q->bindValue(':referencePaiement', $opCaisse->getReferencePaiement());
			$q->bindValue(':ligneBudget', $opCaisse->getLigneBudget());
			$q->bindValue(':numRecu', $opCaisse->getNumRecu());
			
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
        	 $q = $this->getPDO()->prepare('DELETE FROM OperationBanque WHERE id = '.$idOpBanque);
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
        }
		public function deleteOperationCaisse($idOpCaisse){
			 $q = $this->getPDO()->prepare('DELETE FROM OperationCaisse WHERE id = '.$idOpCaisse);
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
        }
		
        public function getOperationBanque($id){
            $opBanque=array();
            
			$q = $this->getPDO()->prepare('SELECT * FROM OperationBanque WHERE id = '.$id);
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
			 $opBanque = $q->fetch(PDO::FETCH_ASSOC);
            return $opBanque;
        }
		public function getOperationCaisse($id){
            $opCaisse=array();
			$q = $this->getPDO()->prepare('SELECT * FROM OperationCaisse WHERE id = '.$id);
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
			 $opCaisse = $q->fetch(PDO::FETCH_ASSOC);
            return $opCaisse;
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
            $q = $this->getPDO()->prepare('UPDATE operationBanque SET libelle = :libelle, sommeOperation = :sommeOperation,  noteOperation = :noteOperation, referencePaiement = :referencePaiement , typeOpBancaire = :typeOpBancaire, referenceOperation = :referenceOperation  WHERE id = :id');
            $q->bindValue(':libelle', $opBanque->getLibelle());
            // $q->bindValue(':dateOperation', $opBanque->getDateOperation()); 
            $q->bindValue(':sommeOperation', $opBanque->getSommeOperation());
            $q->bindValue(':noteOperation', $opBanque->getNoteOperation());
            // $q->bindValue(':etatSoumission', $opBanque->getEtatSoumission());
			// $q->bindValue(':soumission', $opBanque->getSoumission());
			$q->bindValue(':referencePaiement', $opBanque->getReferencePaiement());
			$q->bindValue(':typeOpBancaire', $opBanque->getTypeOpBancaire());
			$q->bindValue(':referenceOperation', $opBanque->getReferenceOperation());
            $q->bindValue(':id', $opBanque->getId());
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
            $q->closeCursor();
        }
		
		public function updateOperationCaisse(OperationCaisse $opCaisse){
            $q = $this->getPDO()->prepare('UPDATE operationCaisse SET libelle = :libelle, sommeOperation = :sommeOperation,  noteOperation = :noteOperation, etatSoumission = :etatSoumission, referencePaiement = :referencePaiement, numRecu = :numRecu WHERE id = :id');
            $q->bindValue(':libelle', $opCaisse->getLibelle());
            //$q->bindValue(':dateOperation', $opCaisse->getDateOperation()); 
            $q->bindValue(':sommeOperation', $opCaisse->getSommeOperation());
            $q->bindValue(':noteOperation', $opCaisse->getNoteOperation());
            $q->bindValue(':etatSoumission', $opCaisse->getEtatSoumission());
			$q->bindValue(':referencePaiement', $opCaisse->getReferencePaiement());
			$q->bindValue(':numRecu', $opCaisse->getNumRecu());
            $q->bindValue(':id', $opCaisse->getId());
            try {
            	$q->execute();
            }catch(PDOException $e){	
                echo ($e->getMessage());
            }
            $q->closeCursor();
        }
        
    
    }//fin class ManageurOperation
?>
