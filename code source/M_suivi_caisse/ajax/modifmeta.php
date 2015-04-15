<?php
require_once(realpath(dirname(__FILE__)) . '/../../Classes/Manageur/ManageurBD.php');
require_once(realpath(dirname(__FILE__)) . '/../../Classes/M_SuiviCaisse/OperationBanque.php');
require_once(realpath(dirname(__FILE__)) . '/../../Classes/M_SuiviCaisse/OperationCaisse.php');

				if(isset($_REQUEST["rechercher"])&isset($_REQUEST["id"])){
				 echo '
					 <div class="modal-content">
			          <div class="modal-header">
			            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			            <h4 class="modal-title" id="myModalLabel">Modifier l\'opération</h4>
			          </div>
			          <div class="modal-body">
					             	<div class="panel panel-primary">
				                        <div class="panel-heading">
				                            <i class="fa fa-edit"></i>
				                        </div>
				                        <div class="panel-body" id="modifMeta">
						
									 <h2 align="center" class="alert-success"> Pas encore implémentée !! </h2> 
						 	  
							 	  </div>
						          </div>
						          <div class="modal-footer" id="footer_modal" align="center">
						            <button type="button" class="btn btn-success"  data-dismiss="modal">Terminer </button>
						          </div>
					 ';
	  
	  	}
?>