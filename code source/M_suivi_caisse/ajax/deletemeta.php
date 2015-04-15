<?php

require_once(realpath(dirname(__FILE__)) . '/../../Classes/Manageur/ManageurBD3.php');
require_once(realpath(dirname(__FILE__)) . '/../../Classes/M_SuiviCaisse/OperationBanque.php');
require_once(realpath(dirname(__FILE__)) . '/../../Classes/M_SuiviCaisse/OperationCaisse.php');

	$manageur=ManageurOperation::getInstance();
				if(isset($_REQUEST["rechercher"])&isset($_REQUEST["id"])){
				$oper=$manageur->getOperationCaisse($_REQUEST["id"]);
				if ($oper==null)
					$oper=$manageur->getOperationBanque($_REQUEST["id"]);
	
				if ($oper!=null)
				echo '
					 <div class="modal-content">
			          <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			            <h4 class="modal-title" id="myModalLabel">Supprimer l\'opération</h4>
			          </div>
			          <div class="modal-body">
					             	<div class="panel panel-primary">
				                        <div class="panel-heading">
				                            <i class="fa fa-edit"></i>
				                        </div>
				                        <div class="panel-body" id="modifMeta">
						
									 <h2 align="center" class="alert-danger"> Voulez-vous vraiment supprimer cette opération ? </h2> 
						 	  
							 	  </div>
						          </div>
						          <div class="modal-footer">
							            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							            <button type="button" class="btn btn-danger" id="'.$oper['ID'].'" onclick="confirmDelete(this.id)"><i class="fa fa-times"></i> Suppimer</button>
						          </div>
						</div>
					</div>
					      
				      ';
	  
	  	} 
	  	
	  	if(isset($_REQUEST["suppr"]) && isset($_REQUEST["id"])){
				$id=intval($_REQUEST["id"]);
				$manageur->deleteOperationBanque($_REQUEST["id"]);
				$manageur->deleteOperationCaisse($_REQUEST["id"]);
				
				echo "
				<div class='modal-header'>
				            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				            <h4 class='modal-title' id='myModalLabel'>Supprimer l\'opération</h4>	          
				            </div>
				  			<div class='modal-body'>
				             	<div class='panel panel-primary'>
			                        <div class='panel-heading'>
			                            <i class='fa fa-edit'></i>
			                        </div>
			                        <div class='panel-body'>
				                            <h2 align='center' class='alert-success'>Opération supprimée avec succès !!! </h2> 
		                            </div>
		                            </div>
						          <div class='modal-footer'>
						            <button type='button' class='btn btn-primary'  onclick='location.reload()'>Terminer </button>
						          </div>
							          ";
			}
			
?>