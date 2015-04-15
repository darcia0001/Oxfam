<?php 
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/Manageur2.php');
// ---------------------------- gestion de la securit� -------------------------
session_start();
if (!isset($_SESSION['utilisateur'])){

	header('Location:  connexion.php');
	exit();
}
//redirection suivant le profil de l utilisateur
if (isset($_SESSION['utilisateur'])){
	$user =  unserialize($_SESSION['utilisateur']);
	if (($user->getProfil())=='agenprojet'){//si c est un agent projet on le redirige
		header("Location: ../accueil.php");exit();
	}
	if (($user->getProfil()=='agentoxfam')&&($user->getGroupeUtilisateur()!="administrateur")){//si c est un agent oxfam non administrateur on le redirige
	 header("Location: ../accueil.php");exit();
	}
	
}
// --------------------------------------------------------------------------------

?>
<!DOCTYPE html>
<html>
    <head>
      <title>OxFam| Ouvrir Plan Mensuel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="" />
        <meta name="copyright" content="" />
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css" media="all" /> 
        <link rel="stylesheet" type="text/css" href="../assets/css/login.css" media="all" />                 
        <link rel="stylesheet" type="text/css" href="../assets/style.css" media="all" />                         
        <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
        <script type="text/javascript" src="../assets/js/js.js"></script>  
        
	    <link href="../ressources/font-awesome-4.1.0/css/font-awesome.css" rel="stylesheet">
	    <link rel="stylesheet" type="text/css" href="../ressources/css/ourstyle.css">                                
    </head>

    <body  >
       <?php  
        include("header.php");
    ?>
    <form method="POST" action="traitement.php">	
	   

	          <div class="col_12">

	              <span class="col_4"> 
	                  <br />
	                  Infos Plan Mensuel
	              </span>
	          </div>   
	          <img  class="col_12 sparatorh2" src="img/separateur.png"  />
	         
		       <div class="notice col_12">
		       	  	<div class="col_12">
		              <span class="col_4"> 
		                  <br />
		                  Infos Mois
		              </span>
	          		</div> 
		         	
		         	<div class="col_12 "> 
		               <div class="col_6 ">
			                <label  class="col_4" for="codeMois"> Code mois</label>
			                <input type="text"  id="codeMois" class="col_6 fright" name="codeMois">
		            	</div>   
		          	</div>
		          
		          	<div class="col_12 "> 
		              
		               	<div class="col_6 "> 
		                  <label for="libelleMois" class="col_4"> Libellé mois</label>
		                  
		                  <input type="text"  id="libelleMois" class="col_6 fright" name="libelleMois">
		              	</div>
		               
		          	</div>
	        	</div>

	        	<div class="notice col_12">
		       	  	<div class="col_12">
		              <span class="col_4"> 
		                  <br />
		                  Saisie Element Plan Mensuel
		              </span>
	          		</div> 	          
		          	<div class="col_12 "> 
		              
		               	<div class="col_6 "> 
		                  <label for="libelleElementPlanMensuel" class="col_4"> Libellé </label>
		                  
		                  <input type="text"  id="libelleElementPlanMensuel" class="col_6 fright" name="libelleElementPlanMensuel">

		              	</div>
		          	</div>
		          	<div class="col_12 "> 
		               <div class="col_6 ">
			                <label  for = "montantElementPlanMensuel" class="col_4"> Montant </label>
			                <input type="number"  id = "montantElementPlanMensuel" class="col_6 fright" name="montantElementPlanMensuel">
		            	</div>   
		          	</div>
		          	
	        	</div>

	        	<div class="notice col_12">
		       	  	<div class="col_12">
		              <span class="col_4"> 
		                  <br />
		                  Infos Ligne Budgetaire
		              </span>
	          		</div> 	          
		          	<div class="col_12 "> 
		              
		               	<div class="col_6 "> 
		                  <label for="libelleLigneBudget" class="col_4"> Libellé </label>
		                  
		                  <input type="text"  id="libelleLigneBudget" class="col_6 fright" name="libelleLigneBudget">
		              	</div>
		          	</div>
		          	<div class="col_12 "> 
		               <div class="col_6 ">
			                <label  class="col_4" for="montantPrevuLigneBudget"> Montant Prévu</label>
			                <input type="number"  id = "montantPrevuLigneBudget" class="col_6 fright" name="montantPrevuLigneBudget">
		            	</div>   
		          	</div>
		          	<div class="col_12 "> 
		               <div class="col_6 " >
			                <label  class="col_4" for="montantExecuteLigneBudget"> Montant Executé</label>
			                <input type="number"  id = "montantExecuteLigneBudget" 
			                	    class="col_6 fright" name="montantExecuteLigneBudget" placeholder = "Pouvant etre nul">
		            	</div>   
		          	</div>
	        	</div>
	        	
	        	<div class="col_4 "> 
	            
	            <input type = "submit" value = "Valider"/>
	            <input type = "reset" value = "Annuler"/>
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
	        </form>
	 </body>
</html>
