<?php
require("../classes/ManageurBD.php");


	$manageur=ManageurBD::getInstance();
	$user=null;
	if(isset($_REQUEST["mark"]) && isset($_REQUEST["id"])){
				$id=intval($_REQUEST["id"]);
				if ( is_numeric($id) ){
					$meta=$manageur->getMetadonnee($id);
					$meta->setVue('oui');
					$manageur->updateMetadonnee($meta);
				}
				echo "
				<script type=\"text/javascript\"> location.reload() </script>
				<div class='modal-header'>
				            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				            <h4 class='modal-title' id='myModalLabel'>Notification</h4>	          
				            </div>
				  			<div class='modal-body'>
				             	<div class='panel panel-primary'>
			                        <div class='panel-heading'>
			                            <i class='fa fa-edit'></i>
			                        </div>
			                        <div class='panel-body'>
				                            <h2 align='center' class='alert-success'>Vous avez marqué la notification  comme vue !!! </h2> 
		                            </div>
		                            </div>
						          <div class='modal-footer'>
						            <button type='button' class='btn btn-primary'  onclick='location.reload()'>Terminer </button>
						          </div>
							          ";
	}

		if(isset($_REQUEST["all"])){
				$manageur->getMarkVueAll();
				
				echo "
				<script type=\"text/javascript\"> location.reload() </script>
				<div class='modal-header'>
				            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				            <h4 class='modal-title' id='myModalLabel'>Notification</h4>	          
				            </div>
				  			<div class='modal-body'>
				             	<div class='panel panel-primary'>
			                        <div class='panel-heading'>
			                            <i class='fa fa-edit'></i>
			                        </div>
			                        <div class='panel-body'>
				                            <h2 align='center' class='alert-success'>Vous avez marqué toutes notifications  comme vues !!! </h2> 
		                            </div>
		                            </div>
						          <div class='modal-footer'>
						            <button type='button' class='btn btn-primary'  onclick='location.reload()'>Terminer </button>
						          </div>
							          ";
	}
			
?>