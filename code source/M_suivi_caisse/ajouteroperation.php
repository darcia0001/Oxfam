<?php
require_once(realpath(dirname(__FILE__)) . '/../Classes/Manageur/ManageurBD.php');
require_once(realpath(dirname(__FILE__)) . '/../Classes/M_SuiviCaisse/OperationBanque.php');
require_once(realpath(dirname(__FILE__)) . '/../Classes/M_SuiviCaisse/OperationCaisse.php');
$manageur=ManageurOperation::getInstance();
$listeOpCaisse = $manageur->getListOperationCaisse();
//var_dump($listeOpCaisse);
if ( isset($_REQUEST["typeOperation"])){
	if ($_REQUEST["typeOperation"]=="Caisse"){
		$opCaisse = new OperationCaisse(array());
		$opCaisse->setDateOperation($_REQUEST["dateOperation"]);
		$opCaisse->setSommeOperation($_REQUEST["sommeOperation"]);
		$opCaisse->setLibelle($_REQUEST["libelle"]);
		$opCaisse->setReferencePaiement($_REQUEST["referencePaiement"]);
		$opCaisse->setNumRecu($_REQUEST["numRecu"]);
		
		$manageur->addOperationCaisse($opCaisse);
		
	} else if ($_REQUEST["typeOperation"]=="Banque"){
		$opBanque = new OperationBanque(array());
		$opBanque->setDateOperation($_REQUEST["dateOperation"]);
		$opBanque->setSommeOperation($_REQUEST["sommeOperation"]);
		$opBanque->setLibelle($_REQUEST["libelle"]);
		$opBanque->setReferencePaiement($_REQUEST["referencePaiement"]);
		$opBanque->setTypeOpBancaire($_REQUEST["typeOpBancaire"]);
		$opBanque->setReferenceOperation($_REQUEST["referenceOperation"]);

		$manageur->addOperationBanque($opBanque);
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>OxFam| Ajouter Operation</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="description" content="" />
		<meta name="copyright" content="" />
		<link rel="stylesheet" type="text/css" href="css/style.css" media="all" /> 
		<link rel="stylesheet" type="text/css" href="css/login.css" media="all" />                 
		<link rel="stylesheet" type="text/css" href="style.css" media="all" />                         
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/js.js"></script>                                  
	</head>
	<body style="padding-left: 60px;padding-right: 60px;">
		
		<div class="width80"   >
		    <div class="col_12"  > <!-- Entête de la page -->
		          <img  class="col_2" src="img/logo.png" />
		          <p class="col_2">OXFAM</p>
		          <img  class="col_2" src="img/logo.png" />
		          
			      <div class="col_4">
			          <span class="col_12">Bienvenue à </span>
			          <span class="col_12"> 
			             <span class="col_6">Prenom </span>
			             <span class="col_6">NOM </span>
			          </span>
			          <span class="col_12">Nom du projet / Pays</span>
			          <span class="col_12">
				          <select   >
					          <option value="">-- Choix langue  --</option>
					          <option value="">Français</option>
					          <option value="">Anglais</option>
				          </select   >
			           </span>
			      </div>  
			      
			     <div class="col_2" >
			        <button class="small vert pill fright  icon-signout" type="submit"> Quitter </button>
			     </div>
		    </div> <!-- Fin Entête -->
		    
		    <img  class="col_12 sparatorh2" src="img/separateur.png"  />
		  	<ul class="breadcrumbs col_6"> <!-- Début Fil d'ariane -->
				<li><a href="">Home</a></li>
				<li><a href="">Module</a></li>
				<li><a href="">Sous Module</a></li>
			</ul>							<!-- Fin Fil Ariane -->
		    <h6 class="col_6 fright txtalignright"> jj/mm/yy hh:mm </h6> <!-- Date et Heure Système -->
		    <img  class="col_12 sparatorh2" src="img/separateur.png"  />
			
		    <div class="col_8">
		        	<h3>
		        		<span class="icon-dashboard fsize45"></span>
		            	Gestion Operations
		            </h3>
		    </div>
		    
		    <!-- TODO : Alerte à gérer avec Javascript, par défaut caché -->
		    <div class="col_4 fright txtalignright" >
			    <div class="notice error" hidden id="alerte_operation">
			    	<i class="icon-remove-sign icon-large"></i> Alerte Opération / Dépassement
			        <a href="#close" class="icon-remove"></a>
			    </div>
			</div>

			<form action="ajouteroperation.php" method="post"> <!-- Début Formulaire -->
				<!-- Début Info Budget -->
			    <div class="col_12">
			        <span class="col_4"> 
			            <h4>Info budget</h4>
			        </span>
			        <br />
			        <br />
			        <div class="col_4 "> 
			            <div class="notice "> Période en cours : MM/YYYY
			        </div>
			        </div>
			    </div>   
			    <hr/>
			    <!-- <img  class="col_12 sparatorh2" src="img/separateur.png"  /> -->
			    
			    <div class="col_12 "> 
			            <div class="notice  col_4 fright txtalignright"> Budget Restant Ligne : XXXXXXX F
			      </div>
			    </div>
			    
			      <div class="col_12 "> 
			          <div class="col_5 ">
			          <label  class="col_4"> Choix du Thème</label>
			          <select  class="col_7 fright" >
			          <option value="">-- Liste thèmes  --</option>
			          
			          </select   >
			        </div>
			        
			    </div>
			    
			    <div class="col_12 "> 
			         <div class="col_5 "> 
				          <label for="rubrique" class="col_4"> Choix rubrique</label>
				          <select  id="rubrique" class="col_7 fright" >
				          		<option value="">-- Liste rubriques  --</option>
				          </select   >
			        </div>
			        <div class="col_2"></div>
			        <div class="col_5"> 
			          <label  class="col_4"> Choix ligne</label>
			          <select  class="col_7 fright" >
			          		<option value="">-- Liste lignes budgétaires  --</option>
			          </select   >
			        </div>
			    </div>
			    <!-- Fin Info Budget -->
			    
			    <!-- Début Info Opération -->
			    <div class="col_12">
			        <span class="col_4"> 
			            <h4> Infos opération </h4>
			        </span>
			    </div>   
			    <hr/>
			    <!-- <img  class="col_12 sparatorh2" src="img/separateur.png"  /> -->
			    
			    <div class="col_12 "> 
					<!--    Numéro à calculer à partir du dernier numéro dans la base 		 -->
			        <div class="notice  col_4 fright txtalignright">Numéro opération : <?php echo $manageur->countOperationCaisse()+1 ?> </div>
			    </div>
			    <div class="col_12 "> 
			         <div class="col_6 ">
				          <label  class="col_4"> Date opération</label>
				          <input name="dateOperation" type="date" required="" class="col_6 fright" >
			        </div>   
			    </div>
			    <div class="col_12 "> 
			         <div class="col_5 ">
				          <label  class="col_4"> Type opération</label>
				          <select  class="col_7 fright" required="" id="typeOperation" name="typeOperation" onchange="suiteOperation();">
					          <option disabled="">Choisir un type</option>
					          <option>Caisse</option>
					          <option>Banque</option>
				          </select   >
			        </div>
			    </div>
			    
			    <div id="suiteOperation">
			    	
			    </div>
			
			    <div class="col_12 "> 
			         <div class="col_6 "> 
				          <label for="depense" class="col_4"> Libellé dépense</label>
				          <input type="text" required="" name="libelle" class="col_6 fright" placeholder="Description de la dépense" >
			        </div>
			        
			        <div class="col_6"> 
			          <label  class="col_4"> Référence paiement</label>
			          <input type="text"  required="" name="referencePaiement" class="col_6 fright" placeholder="Numéro de la référence" >
			        </div>
			    </div>
			    
			    <div class="col_12 "> 
			         <div class="col_6 ">
				          <label  class="col_4"> Montant opération</label>
				          <input type="number" required="" name="sommeOperation" class="col_6 fright" placeholder="xxxxxxxxxxxx F"/>
			        </div>  
			        <div class="col_6"> 
			          <label  class="col_4"> Note opération </label>
			          <input type="text"  required="" name="noteOperation" class="col_6 fright" placeholder="Une note sur l'opération" >
			        </div> 
			    </div>
				<!-- Fin Info Opération -->
				
				<!-- TODO Estimation prévisionnelle du solde restant à gérer dynamiquement avec JavaScript (le montant dans la base diminué du montant de l'opération) -->
			    <div class="col_12 "> 
			          <div class="notice col_6">
				          <div class="col_12 ">
					          <label  class="col_6"> Solde ligne après opération</label>
					          <span  class="col_6 notice fright"> xxxxxxxxxxxxx F</span>
				          </div> 
				          
				          <div class="col_12 ">
					          <label  class="col_6"> Solde budget après opération</label>
					          <span  class="col_6 notice fright">  xxxxxxxxxxxxx F </span>
				          </div> 
			         </div> 
			        <div class="col_4">
			        	 <br/><br/><br/>	
			             <button class="large green pill pull-right  icon-circle-arrow-right" type="submit"  >Enregistrer opération</button>
			        </div>    
			    </div>
		   </form> <!-- Fin Formulaire -->
		    
		    <div class="col_4 "> 
		        <p class="col_6">
		            <span class="icon-download fsize45"> </span>
		            <br/>
		            <span> Générer Etat</span>
		        </p>
		        <p class="col_6">
		            <span class="icon-print fsize45"> </span>
		            <br/>
		            <span> Imprimer Opération </span>
		        </p>
		    </div>
		</div>
	</body>
</html>
<script>
	function suiteOperation(){
		if (document.getElementById("typeOperation").value=="Caisse"){
			str = '<div class="col_12 "> ' ;
			str+= '		<div class="col_6 ">' ;
			str+= '			<label  class="col_4"> Numéro de reçu </label> ';
			str+= '			<input type="number"  required="" name="numRecu" class="col_6 fright" placeholder="Numéro du reçu" >';
			str+= '		</div>';
			str+= '</div>';
			document.getElementById("suiteOperation").innerHTML = str;
			}
		if (document.getElementById("typeOperation").value=="Banque") {
			var str;
			str = '<div class="col_12 "> ' ;
			str+= '		<div class="col_6 ">' ;
			str+='			<label  class="col_4"> Référence du paiement </label> ';
			str+='			<input type="text"  required="" name="referenceOperation" class="col_6 fright" placeholder="référence" >';
			str+= '		</div>';
			str+= '</div>'; 
			       	
	       	str+='<div class="col_12 "> ' ;
			str+='		<div class="col_5 ">' ;
	       	str+='			<label  class="col_4"> Type Opération bancaire </label>';
		    str+='			<select  class="col_7 fright" required=""  name="typeOpBancaire">';
			str+='      		<option disabled="">Choisir un type</option>';
			str+='      		<option>Type1</option>';
			str+='      		<option>Type2</option>';
		    str+='  		</select   >';
		    str+= '		</div>';
			str+= '</div>'; 
			document.getElementById("suiteOperation").innerHTML = str; }
					
	}
</script>