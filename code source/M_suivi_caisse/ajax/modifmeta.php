<?php
require_once(realpath(dirname(__FILE__)) . '/../../Classes/Manageur/ManageurBD3.php');
require_once(realpath(dirname(__FILE__)) . '/../../Classes/M_SuiviCaisse/OperationBanque.php');
require_once(realpath(dirname(__FILE__)) . '/../../Classes/M_SuiviCaisse/OperationCaisse.php');

error_reporting(E_ALL);
     			ini_set('display_errors', 1);
	 
				$manageur=ManageurOperation::getInstance();
				if(isset($_REQUEST["modif"]) && isset($_REQUEST["id"])){
					var_dump($_REQUEST["typeOperation"]);
					if ($_REQUEST["typeOperation"]=="Caisse"){
						$opCaisse = $manageur->getOperationCaisse($_REQUEST["id"]);
						if ($opCaisse!=null){
							$opCaisse = new OperationCaisse($manageur->getOperationCaisse($_REQUEST["id"]));
							$opCaisse->setSommeOperation($_REQUEST["sommeOperation"]);
							$opCaisse->setNoteOperation($_REQUEST["noteOperation"]);
							$opCaisse->setLibelle($_REQUEST["libelle"]);
							$opCaisse->setReferencePaiement($_REQUEST["referencePaiement"]);
							$opCaisse->setNumRecu($_REQUEST["numRecu"]);						
				            
				            $manageur->updateOperationCaisse($opCaisse);
		
						}
					} else if ($_REQUEST["typeOperation"]=="Banque"){
						
						$opBanque = new OperationBanque($manageur->getOperationBanque($_REQUEST["id"]));
						var_dump($opBanque);
						$opBanque->setSommeOperation($_REQUEST["sommeOperation"]);
						$opBanque->setNoteOperation($_REQUEST["noteOperation"]);
						$opBanque->setLibelle($_REQUEST["libelle"]);
						$opBanque->setReferencePaiement($_REQUEST["referencePaiement"]);
						$opBanque->setTypeOpBancaire($_REQUEST["typeOpBancaire"]);
						$opBanque->setReferenceOperation($_REQUEST["referenceOperation"]);
				
						
			            $manageur->updateOperationBanque($opBanque);
					}
					echo '
					 <div class="modal-content">
			          <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			            <h4 class="modal-title" id="myModalLabel">Modifier la métadonnée</h4>
			          </div>
			          <div class="modal-body">
					             	<div class="panel panel-primary">
				                        <div class="panel-heading">
				                            <i class="fa fa-edit"></i>
				                        </div>
				                        <div class="panel-body">
						
									 <h2 align="center" class="alert-success">Opération modifiée avec succès !!! </h2> 
						 	  
							 	  </div>
						          </div>
						          <div class="modal-footer" id="footer_modal" align="center">
						            <button type="button" class="btn btn-success" onclick="location.reload();" data-dismiss="modal">Terminer </button>
						          </div>
					 ';	
					
				}
				if(isset($_REQUEST["rechercher"])&isset($_REQUEST["id"])){
					$oper=$manageur->getOperationCaisse($_REQUEST["id"]);
				if ($oper != null)
					echo '
					 <div class="modal-content">
		          <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            <h4 class="modal-title" id="myModalLabel">Modifier Opération Caisse</h4>
		          </div>
		          <div class="modal-body">
				             	<div class="panel panel-primary">
			                        <div class="panel-heading">
			                            <i class="fa fa-edit"></i>
			                        </div>
			                        <div class="panel-body" >
			                         <div id="notification" class=" alert-danger alert-dismissable " align="center"></div>
										
										<form action="ajouteroperation.php" method="post">
												<input name="typeOperation" id="typeOperation" type="hidden" value="Caisse">
												<input id="id" type="hidden" value="'.$oper['ID'].'">
												<input id="referenceOperation" type="hidden" value="null">
												<input id="typeOpBancaire" type="hidden" value="null">
												<!--
												<div class="col_12 "> 
													 <div class="col_6 ">
														  <label  class="col_4"> Date opération</label>
														  <input id="dateOperation" type="date" required="" class="col_6 fright" value="'.$oper['DATEOPERATION'].'" >
													</div>   
												</div>
												-->
												
												<div id="suiteOperation1">
													<div class="col_12 "> 
															<div class="col_6 ">
																<label  class="col_4"> Numéro de reçu </label>
																<input type="number"  required="" id="numRecu" class="col_6 fright" placeholder="Numéro du reçu" value="'.$oper['NUMRECU'].'">
															</div>
													</div>
												</div>
												       	
												<div class="col_12 "> 
													 <div class="col_6 "> 
														  <label for="depense" class="col_4"> Libellé dépense</label>
														  <input type="text" required="" id="libelle" class="col_6 fright" placeholder="Description de la dépense" value="'.$oper['LIBELLE'].'">
													</div>
													
													<div class="col_6"> 
													  <label  class="col_4"> Référence paiement</label>
													  <input type="text"  required="" id="referencePaiement" class="col_6 fright" placeholder="Numéro de la référence" value="'.$oper['REFERENCEPAIEMENT'].'" >
													</div>
												</div>
												
												<div class="col_12 "> 
													 <div class="col_6 ">
														  <label  class="col_4"> Montant opération</label>
														  <input type="number" required="" id="sommeOperation" class="col_6 fright" placeholder="xxxxxxxxxxxx F" value="'.$oper['SOMMEOPERATION'].'"/>
													</div>  
													<div class="col_6"> 
													  <label  class="col_4"> Note opération </label>
													  <input type="text"  required="" id="noteOperation" class="col_6 fright" placeholder="Une note sur l\'opération" value="'.$oper['NOTEOPERATION'].'">
													</div> 
												</div>
											 </form> <!-- Fin Formulaire -->	
												
							 	  </div>
						          </div>
						          <div class="modal-footer">
						            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						            <button type="submit" id="saveMetaBtn" class="btn btn-primary" onclick="updateMeta();">Sauvegarder</button>
						          </div>
						          
								  
					 '; else {
					$oper=$manageur->getOperationBanque($_REQUEST["id"]);
					echo '
					 <div class="modal-content">
		          <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		            <h4 class="modal-title" id="myModalLabel">Modifier opération Banque</h4>
		          </div>
		          <div class="modal-body">
				             	<div class="panel panel-primary">
			                        <div class="panel-heading">
			                            <i class="fa fa-edit"></i>
			                        </div>
			                        <div class="panel-body" >
			                         <div id="notification" class=" alert-danger alert-dismissable " align="center"></div>
										
										<form action="ajouteroperation.php" method="post">
												<input name="typeOperation" id="typeOperation" type="hidden" value="Banque">
												<input id="id" type="hidden" value="'.$oper['ID'].'">
												<input id="numRecu" type="hidden" value="null">
												
												<!--
												<div class="col_12 "> 
													 <div class="col_6 ">
														  <label  class="col_4"> Date opération</label>
														  <input id="dateOperation" type="date" required="" class="col_6 fright" value="'.$oper['DATEOPERATION'].'" >
													</div>   
												</div>
												-->
												
												<div id="suiteOperation1">
													<div class="col_12 "> 
															<div class="col_6 ">
																<label  class="col_4"> Référence Opération </label> 
																<input type="text"  required="" id="referenceOperation" class="col_6 fright" placeholder="référence" value="'.$oper['REFERENCEOPERATION'].'">
															</div>
													</div>
													       	
											       	<div class="col_12 "> 
															<div class="col_5 ">
											       				<label  class="col_4"> Type Opération bancaire </label>
												    			<select  class="col_7 fright" required=""  id="typeOpBancaire">
													      		<option disabled="">Choisir un type</option>
													      		<option>Type1</option>
													      		<option>Type2</option>
												      		</select   >
												    		</div>
													</div>
												</div>
											
												<div class="col_12 "> 
													 <div class="col_6 "> 
														  <label for="depense" class="col_4"> Libellé dépense</label>
														  <input type="text" required="" id="libelle" class="col_6 fright" placeholder="Description de la dépense" value="'.$oper['LIBELLE'].'">
													</div>
													
													<div class="col_6"> 
													  <label  class="col_4"> Référence paiement</label>
													  <input type="text"  required="" id="referencePaiement" class="col_6 fright" placeholder="Numéro de la référence" value="'.$oper['REFERENCEPAIEMENT'].'" >
													</div>
												</div>
												
												<div class="col_12 "> 
													 <div class="col_6 ">
														  <label  class="col_4"> Montant opération</label>
														  <input type="number" required="" id="sommeOperation" class="col_6 fright" placeholder="xxxxxxxxxxxx F" value="'.$oper['SOMMEOPERATION'].'"/>
													</div>  
													<div class="col_6"> 
													  <label  class="col_4"> Note opération </label>
													  <input type="text"  required="" id="noteOperation" class="col_6 fright" placeholder="Une note sur l\'opération" value="'.$oper['NOTEOPERATION'].'">
													</div> 
												</div>
											 </form> <!-- Fin Formulaire -->	
												
							 	  </div>
						          </div>
						          <div class="modal-footer">
						            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
						            <button type="submit" id="saveMetaBtn" class="btn btn-primary" onclick="updateMeta();">Sauvegarder</button>
						          </div>
						          
								  
					 '; }
				 
	  
	  	}
?>