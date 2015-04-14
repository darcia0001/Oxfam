<?php
    require(dirname(__FILE__)."/../M_Projets/Projet.php");
    
	class ManageurProjet{
        /**
         * Instance de la classe ManageurProjet:singleton
         *
         * @var ManageurProjet
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
        private $connexion;

        private $requete;
    
        /**
        * Constante: nom d'utilisateur de la bdd
        *
        * @var string
        */
        const DEFAULT_ORACLE_USER = 'darcia';
        /**
        * Constante: hÃ´te de la bdd
        *
        * @var string
        */
        const DEFAULT_ORACLE_SERVICE = 'localhost/XE';
        /**
        * Constante: hÃ´te de la bdd
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
        * @see PCI::__construct()
        * @access private
        */
        private function __construct(){

            $this->connexion  = oci_connect('darcia', 'passer', 'localhost/XE');
            
            if (! $this->connexion) {
    
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
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
            self::$instance = new ManageurProjet();
            }
            return self::$instance;
        }

        public function getPDO(){
            $this->PDOInstance  = new PDO("oci:dbname=".'localhost/XE','elbah','repasser2014',array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
            return $this->PDOInstance ;
    
        }
        /*methodes de manipulation des projets */
		
		public function addProjet(Projet $projet){

            $this->requete =  oci_parse($this->connexion,
                                            "
											INSERT INTO projet values ('".$projet->getNom()."',
											(select ref(s) from secteuractivite s where s.libelle like '".$projet->getSecteur()."'),	
											(select ref(c) from categorieprojet c where c.libelle like '".$projet->getCategorie()."') ,
											(select ref(v) from ville v where v.nomVille like '".$projet->getVilleProjet()."') )
										");
            

            oci_execute($this->requete);
        }
		
		public function addPays(Pays $pays){
			
			$this->requete =  oci_parse($this->connexion,
                                            "INSERT INTO pays (codepays, nomcomplet, langue, monnaie) values('".$pays->getCodePays()."',
											'".$pays->getNomPays()."',
											(select ref(l) from langue l where l.nom like '".$pays->getLanguePays()."'),
											(select ref(m) from monnaie m where m.nomdevise like '".$pays->getDevisePays()."') )
										");
										
			
			oci_execute($this->requete);
											
		}
		
		public function addVille(Ville $ville){
			$this->requete =  oci_parse($this->connexion,
                                            "INSERT INTO ville values(
											'".$ville->getNomVille()."',
											(select ref(p) from pays p where p.nomcomplet like '".$ville->getNomPays()."') )
										");
										
			
			oci_execute($this->requete);
		}
		
		public function getProjet($nomProjet){
			$prjt= new Projet();
			
			$this->requete =  oci_parse($this->connexion,
                                            "select nom, deref(secteur).libelle secteur, 
												deref(categorie).libelle categorie,
												deref(villeprojet).nomville nom_ville 
												from projet where nom like '".$nomProjet."' 
											"
										);
			
			oci_execute($this->requete);
			
			while ($row = oci_fetch_array($this->requete, OCI_BOTH)) {
				$prjt->setNom($row["NOM"]);
				$prjt->setVilleProjet($row["NOM_VILLE"]);
				$prjt->setCategorie($row["CATEGORIE"]);
				$prjt->setSecteur($row["SECTEUR"]);
			}
			
			return $prjt;
		}
		
/*		public function supprimerProjet(Projet $projet){
			$this->requete =  oci_parse($this->connexion," delete from projet where nom = '".$projet->getNom()."'");
			
			oci_execute($this->requete);
			
			
		}
*/		
		public function modifierProjet(Projet $projet, $oldName){
			
			$this->requete =  oci_parse($this->connexion,
                                            "
									UPDATE projet SET nom = '".$projet->getNom()."',
										secteur = (select ref(s) from secteuractivite s where s.libelle = '".$projet->getSecteur()."'),	
										categorie = (select ref(c) from categorieprojet c where c.libelle = '".$projet->getCategorie()."'),
										villeprojet = (select ref(v) from ville v where v.nomVille = '".$projet->getVilleProjet()."')  
									WHERE nom = '".$oldName."'
									"); 								
			oci_execute($this->requete);
		}
		
		public function getListeProjets(){
			$listeProjets= array();
            
            $this->requete= oci_parse($this->connexion, 'SELECT nom, deref(secteur).libelle secteur_activite, 
												deref(categorie).libelle categorie, 
												deref(villeprojet).nomville nom_ville 
												FROM projet');
            oci_execute($this->requete);
			$nbrow= oci_fetch_all($this->requete, $row, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			
			$listeProjets= $row;
			
            return $listeProjets;
		}

        public function getListeLangues(){
            $listeLangue= array();
            
            $this->requete= oci_parse($this->connexion, 'SELECT nom FROM langue');
            oci_execute($this->requete);

            while ($row = oci_fetch_array($this->requete, OCI_BOTH)) {
                $listeLangue[]= $row["NOM"];                    
            }

            return $listeLangue;
        }
		
		public function getListePays(){
            $listePays= array();
            
            $this->requete= oci_parse($this->connexion, 'SELECT nomcomplet FROM pays');
            oci_execute($this->requete);

            while ($row = oci_fetch_array($this->requete, OCI_BOTH)) {
                $listePays[]= $row["NOMCOMPLET"];
            }

            return $listePays;
        }
		
		public function getListeVilles(){
            $listeVilles= array();
            
            $this->requete= oci_parse($this->connexion, 'SELECT nomville FROM ville');
            oci_execute($this->requete);

            while ($row = oci_fetch_array($this->requete, OCI_BOTH)) {
                $listeVilles[]= $row["NOMVILLE"];                    
            }

            return $listeVilles;
        }
		
		public function getListeMonnaies(){
            $listeMonnaie= array();
            
            //$this->connexion= oci_connect("ahmed", "marabou","localhost/XE") ;
            $this->requete= oci_parse($this->connexion, 'SELECT nomdevise FROM monnaie');
            oci_execute($this->requete);

            while ($row = oci_fetch_array($this->requete, OCI_BOTH)) {
                $listeMonnaie[]= $row["NOMDEVISE"];
            }

            return $listeMonnaie;
        }
		
        public function getListeSecteurActivite(){
            $listeSect= array();

            $this->requete= oci_parse($this->connexion, 'SELECT libelle FROM secteuractivite');
            oci_execute($this->requete);

            while ($row = oci_fetch_array($this->requete, OCI_BOTH)) {
                $listeSect[]= $row["LIBELLE"];
            }

            return $listeSect;            
        }

        public function getListeCategorieProjet(){
            $listeCat= array();

            $this->requete= oci_parse($this->connexion, 'SELECT libelle FROM categorieprojet');
            oci_execute($this->requete);

            while ($row = oci_fetch_array($this->requete, OCI_BOTH)) {
                $listeCat[]= $row["LIBELLE"];
            }

            return $listeCat;            
        }

        public function setConnexion($val){ $this->connexion= $val;}
	}
?>