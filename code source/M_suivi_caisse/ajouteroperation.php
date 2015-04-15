<?php
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
require_once(realpath(dirname(__FILE__)) . '/../Classes/Manageur/ManageurBD3.php');
require_once(realpath(dirname(__FILE__)) . '/../Classes/M_SuiviCaisse/OperationBanque.php');
require_once(realpath(dirname(__FILE__)) . '/../Classes/M_SuiviCaisse/OperationCaisse.php');
$manageur=ManageurOperation::getInstance();
// ---------------------------- gestion de la securit� -------------------------
session_start();
if (!isset($_SESSION['utilisateur'])){

	header('Location:  connexion.php');exit();
}
//redirection suivant le profil de l utilisateur
if (isset($_SESSION['utilisateur'])){
	$user =  unserialize($_SESSION['utilisateur']);
// 	if (($user->getProfil())=='agentprojet'){//si c est un agent projet on le redirige
// 		header("Location: ../accueil.php");exit();

// 	}
	// 	   if (($user->getProfil()=='agentoxfam')&&($user->getGroupeUtilisateur()!="administrateur")){//si c est un agent oxfam non administrateur on le redirige
	// 	   		header("Location: ../accueil.php");exit();
	 
	// 	   }
}
// --------------------------------------------------------------------------------
$listeOpCaisse = $manageur->getListOperationCaisse(1);
//var_dump($listeOpCaisse);
if ( isset($_REQUEST["typeOperation"])){
	if ($_REQUEST["typeOperation"]=="Caisse"){
		$opCaisse = new OperationCaisse(array());
		$opCaisse->setDateOperation($_REQUEST["dateOperation"]);
		$opCaisse->setSommeOperation($_REQUEST["sommeOperation"]);
		$opCaisse->setNoteOperation($_REQUEST["noteOperation"]);
		$opCaisse->setLibelle($_REQUEST["libelle"]);
		$opCaisse->setReferencePaiement($_REQUEST["referencePaiement"]);
		$opCaisse->setNumRecu($_REQUEST["numRecu"]);
		
		$manageur->addOperationCaisse($opCaisse);
		
	} else if ($_REQUEST["typeOperation"]=="Banque"){
		$opBanque = new OperationBanque(array());
		$opBanque->setDateOperation($_REQUEST["dateOperation"]);
		$opBanque->setSommeOperation($_REQUEST["sommeOperation"]);
		$opBanque->setNoteOperation($_REQUEST["noteOperation"]);
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
		<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">   
		<link rel="stylesheet" type="text/css" href="../ressources/css/ourstyle.css">                             
	</head>
	<body style="padding-left: 60px;padding-right: 60px;">
		<?php  
        include("header.php");
    		?>
		<div class="width80"   >
		    <img  class="col_12 sparatorh2" src="img/separateur.png"  />
			
		    <div class="col_8">
		        	<h3>
		        		<span class="icon-dashboard fsize45"></span>
		            	Gestion Operations
		            </h3>
		    </div>
		    
		    <?php 
		    	if ( isset($_REQUEST["typeOperation"])){
		    	echo '
				<div class="col_4 fright txtalignright" >
			    <div class="notice success" id="alerte_operation">
				    	<i class="icon-remove-sign icon-large"></i> Operation ajoutees avec succès !!
				        <a href="#close" class="icon-remove"></a>
				    </div>
				</div>
                ';
                }
		 ?>
		    
		    <!-- TODO : Alerte à gerer avec Javascript, par defaut cache -->
		    <div class="col_4 fright txtalignright" >
			    <div class="notice error" hidden id="alerte_operation">
			    	<i class="icon-remove-sign icon-large"></i> Alerte Operation / Depassement
			        <a href="#close" class="icon-remove"></a>
			    </div>
			</div>

			<form action="ajouteroperation.php" method="post"> <!-- Debut Formulaire -->
				<!-- Debut Info Budget -->
			    <div class="col_12">
			        <span class="col_4"> 
			            <h4>Info budget</h4>
			        </span>
			        <br />
			        <br />
			        <div class="col_4 "> 
			            <div class="notice "> Periode en cours : MM/YYYY
			        </div>
			        </div>
			    </div>   
			    <hr/>
			    <!-- <img  class="col_12 sparatorh2" src="img/separateur.png"  /> -->
			    
			    <div class="col_12 "> 
			            <div class="notice  col_4 fright txtalignright"> Budget Restant Ligne : XXXXXXX F
			      </div>
			    </div>
			    </br></br>
			    <div class="col_12 "> 
			         <div class="col_5 ">
				          <label  class="col_4"> Choix du Thème</label>
				          <select  class="col_7 fright" >
				          	<option value="">-- Liste thèmes  --</option>
			          	  </select   >
			        </div>
			        <div class="col_2"></div>
			        <div class="col_5"> 
			          <label  class="col_4"> Choix ligne</label>
			          <select  class="col_7 fright" >
			          		<option value="">-- Liste lignes budgetaires  --</option>
			          </select   >
			        </div>
			    </div>
			    <!-- Fin Info Budget -->
			    
			    <!-- Debut Info Operation -->
			    <div class="col_12">
			        <span class="col_4"> 
			            <h4> Infos operation </h4>
			        </span>
			    </div>   
			    <hr/>
			    <!-- <img  class="col_12 sparatorh2" src="img/separateur.png"  /> -->
			    
			    <div class="col_12 "> 
					<!--    Numero à calculer à partir du dernier numero dans la base 		 -->
			        <div class="notice  col_4 fright txtalignright">Numero operation : <?php echo $manageur->countOperationCaisse()+1 ?> </div>
			    </div>
			    <div class="col_12 "> 
			         <div class="col_6 ">
				          <label  class="col_4"> Date operation</label>
				          <input name="dateOperation" type="date" required="" class="col_6 fright" >
			        </div>   
			    </div>
			    <div class="col_12 "> 
			         <div class="col_5 ">
				          <label  class="col_4"> Type operation</label>
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
				          <label for="depense" class="col_4"> Libelle depense</label>
				          <input type="text" required="" name="libelle" class="col_6 fright" placeholder="Description de la depense" >
			        </div>
			        
			        <div class="col_6"> 
			          <label  class="col_4"> Reference paiement</label>
			          <input type="text"  required="" name="referencePaiement" class="col_6 fright" placeholder="Numero de la reference" >
			        </div>
			    </div>
			    
			    <div class="col_12 "> 
			         <div class="col_6 ">
				          <label  class="col_4"> Montant operation</label>
				          <input type="number" required="" name="sommeOperation" class="col_6 fright" placeholder="xxxxxxxxxxxx F"/>
			        </div>  
			        <div class="col_6"> 
			          <label  class="col_4"> Note operation </label>
			          <input type="text"  required="" name="noteOperation" class="col_6 fright" placeholder="Une note sur l'operation" >
			        </div> 
			    </div>
				<!-- Fin Info Operation -->
				
				<!-- TODO Estimation previsionnelle du solde restant à gerer dynamiquement avec JavaScript (le montant dans la base diminue du montant de l'operation) -->
			    <div class="col_12 "> 
			          <div class="notice col_6">
				          <div class="col_12 ">
					          <label  class="col_6"> Solde ligne après operation</label>
					          <span  class="col_6 notice fright"> xxxxxxxxxxxxx F</span>
				          </div> 
				          
				          <div class="col_12 ">
					          <label  class="col_6"> Solde budget après operation</label>
					          <span  class="col_6 notice fright">  xxxxxxxxxxxxx F </span>
				          </div> 
			         </div> 
			        <div class="col_4">
			        	 <br/><br/><br/>	
			             <button class="large green pill pull-right  icon-circle-arrow-right" type="submit"  >Enregistrer operation</button>
			        </div>    
			    </div>
		   </form> <!-- Fin Formulaire -->
		    
		    <div class="col_4 "> 
		        <p class="col_6">
		            <span class="icon-download fsize45"> </span>
		            <br/>
		            <span> Generer Etat</span>
		        </p>
		        <p class="col_6">
		            <span class="icon-print fsize45"> </span>
		            <br/>
		            <span> Imprimer Operation </span>
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
			str+= '			<label  class="col_4"> Numero de recu </label> ';
			str+= '			<input type="number"  required="" name="numRecu" class="col_6 fright" placeholder="Numero du reçu" >';
			str+= '		</div>';
			str+= '</div>';
			document.getElementById("suiteOperation").innerHTML = str;
			}
		if (document.getElementById("typeOperation").value=="Banque") {
			var str;
			str = '<div class="col_12 "> ' ;
			str+= '		<div class="col_6 ">' ;
			str+='			<label  class="col_4"> R�f�rence du paiement </label> ';
			str+='			<input type="text"  required="" name="referenceOperation" class="col_6 fright" placeholder="reference" >';
			str+= '		</div>';
			str+= '</div>'; 
			       	
	       	str+='<div class="col_12 "> ' ;
			str+='		<div class="col_5 ">' ;
	       	str+='			<label  class="col_4"> Type Operation bancaire </label>';
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
