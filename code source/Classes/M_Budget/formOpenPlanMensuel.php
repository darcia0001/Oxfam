<!DOCTYPE html>
<html>
    <head>
      <title>OxFam| Ouvrir Plan Mensuel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="" />
        <meta name="copyright" content="" />
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" /> 
        <link rel="stylesheet" type="text/css" href="css/login.css" media="all" />                 
        <link rel="stylesheet" type="text/css" href="style.css" media="all" />                         
        <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
        <script type="text/javascript" src="js/js.js"></script>                                  
    </head>

    <body style="padding-left: 60px;padding-right: 60px;">
    <form method="POST" action="formOpenPlanMensuel.php">	
	      <div class="width80"   >
	          
	          <div class="col_12"  >
	              
	            
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
	              <button class="small vert pill fright  icon-signout" type="submit"  >Quitter</button>
	            </div> 
	          </div>

	          <ul class="breadcrumbs col_6">
	            <li><a href="">Home</a></li>
	            <li><a href="">Module</a></li>
	            <li><a href="">Sous Module</a></li>
	          </ul>
	        
	          <p class="col_6 fright txtalignright"> jj/mm/yy hh:mm</p>

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
	                  <span> Générer Etat</span>
	              </p>
	              <p class="col_6">
	                  <span class="icon-print fsize45"> </span>
	                  <br/>
	                  <span> Imprimer Opération </span>
	              </p>
	          </div> 
	        </form>
	 </body>
</html>

<?php

	//chargeons la classe de la base des donnees
 	require('../Manageur/ManageurBudget.php');

	$bdd = ManageurBudget::getInstance();
 //on teste d'abord si tous les champs ont ete saisis
 if (isset($_POST['codeMois']) and isset($_POST['libelleMois']) ){
 	$codeMois = $_POST['codeMois'];
 	$libelleMois = $_POST['libelleMois'];
 }
 else
 	echo "verifier que vous avez remplis tous les champs";
 if (isset($_POST['libelleElementPlanMensuel']) and isset($_POST['montantElementPlanMensuel'])){
 	$libelleElementPlanMensuel = $_POST['libelleElementPlanMensuel'];
 	$montantElementPlanMensuel = $_POST['montantElementPlanMensuel'];
 }
 echo "verifier que vous tous les champs ont ete bien saisis<br/>";

 if (isset($_POST['libelleLigneBudget']) and isset($_POST['montantPrevuLigneBudget'])){
 	$libelleLigneBudget = $_POST['libelleLigneBudget'];
 	$montantPrevuLigneBudget = $_POST['montantPrevuLigneBudget'];
 	$mntExec = $_POST['montantExecuteLigneBudget'];
 }
 else
 	echo "verifier que vous tous les champs ont ete bien saisis<br/>";

 echo "codeM: ".$codeMois." libelleMois: ".$libelleMois."<br/>
 	   lib elmt plan mens: ".$libelleElementPlanMensuel." mont : ".$montantElementPlanMensuel."<br/>
 	   lib ligne budget: ".$libelleLigneBudget." mont prev: ".$montantPrevuLigneBudget." mnt exec: ".$mntExec;

 	   	$mois = new Mois($codeMois, $libelleMois);
 	   	$epm = new ElementPlanMensuel($codeMois, $libelleElementPlanMensuel, $montantElementPlanMensuel);
 	   	$lbd = new LigneBudget($libelleLigneBudget, $montantPrevuLigneBudget, $mntExec);

 	   	echo "ajout mois<br/>";
 		$bdd->addMois($mois);
 		
 		echo "ajout elmnt plan mensuel<br/>";
 		$bdd->addEltPlanMensuel($epm);
 		
 		echo "ajout ligne budgetaire <br/>";
 		$bdd->addLigneBudget($lbd);

 		echo "tout fait <br/>";
 //echo "here";
?>

