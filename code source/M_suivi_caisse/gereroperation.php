<!DOCTYPE html>
<html><head>
<title>OxFam| Connexion</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="" />
<meta name="copyright" content="" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" /> 
<link rel="stylesheet" type="text/css" href="style.css" media="all" />   
<!-- DataTables CSS -->
<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

<link href="css/bootstrap.css" rel="stylesheet">                      
<!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/js.js"></script>          
<script type="text/javascript" src="js/tab.js"></script>  
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
				          <select  >
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
		        
		        <!-- /.row -->
	            <div class="row">
	                <div class="col-lg-12">
	                    <div class="panel panel-default" style="background-color: #E2A9F3;">
	                        <div class="panel-heading">
	                            Les opérations suivant les budgets
	                        </div>
	                        <!-- .panel-heading -->
	                        <div class="panel-body">
	                            <div class="panel-group" id="accordion">
	                                <div class="panel panel-default">
	                                    <div class="panel-heading" style="background-color: #58ACFA;">
	                                        <h4 class="panel-title">
	                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Budget Q1</a>
	                                        </h4>
	                                    </div>
	                                    <div id="collapseOne" class="panel-collapse collapse in" align="left">
	                                        <div class="panel-body">
												<!-- /.table-responsive -->
									            <div class="table-responsive">
									                <table class="table table-striped table-bordered table-hover" id="dataTables1">
									                    <thead>
									                        <tr>
									                            <th style="width:15%;overflow:auto">Libellé</th>
									                            <th>Date Opération</th>
									                            <th style="width:15%;overflow:auto">Somme </th>
									                            <th style="width:10%;overflow:auto">Note </th>
																<th style="width:10%;overflow:auto">Recu / Ref</th>
																<th style="width:10%;overflow:auto">Types</th>
									                            <th>Actions</th>
									                        </tr>
									                    </thead>
									                    <tbody>
									                       <?php
															require_once(realpath(dirname(__FILE__)) . '/../Classes/Manageur/ManageurBD.php');
															require_once(realpath(dirname(__FILE__)) . '/../Classes//M_SuiviCaisse/OperationBanque.php');
															require_once(realpath(dirname(__FILE__)) . '/../Classes//M_SuiviCaisse/OperationCaisse.php');
															$manageur=ManageurOperation::getInstance();
															$idLigneBudget = 1 ; // L'id de la ligne budgéetaire
															$listeOpCaisse = $manageur->getListOperationCaisse($idLigneBudget);
															$listeOpBanque = $manageur->getListOperationBanque($idLigneBudget);
															$opCaisse = new OperationCaisse(array());
															$opBanque = new OperationBanque(array());	
															
															// Listing des opération Caisse
																foreach ($listeOpCaisse as $opCaisse){
																 ?>	
																  
									                            <td><?php  echo $opCaisse->getLibelle() ?>	</td>
									                            <td><?php  echo $opCaisse->getDateOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getSommeOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getNoteOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getNumRecu()  ?>	</td>
									                            <td> Caisse </td>
									                        
									                            <td>
																<center>
																	
									                            		<a href="#" title="Modifier" id="<?php  echo $opCaisse->getId()  ?>" 
									                            				onclick="modifyMeta(this.id);"  
									                            				type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modifyMeta">
									                            				<i class="fa fa-edit"></i>
									                            		</a>
									                            		<a href="#"  title="Supprimer"id=" <?php  echo $opCaisse->getId()  ?> " 
									                                    		onclick="deleteMeta(this.id);"
									                                    		 type="button"  class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delMeta">
									                                    		 <i class="fa fa-times"></i>
									                            		 </a>
									                       		</center>
									                       </td>
									                        </tr>
																 
														   <?php 
																}										                       
									                       // Listing des opération Banque
																foreach ($listeOpBanque as $opBanque){
																 ?>	
																  
									                            <td><?php  echo $opBanque->getLibelle() ?>	</td>
									                            <td><?php  echo $opBanque->getDateOperation() ?>	</td>
									                            <td><?php  echo $opBanque->getSommeOperation() ?>	</td>
									                            <td><?php  echo $opBanque->getNoteOperation() ?>	</td>
									                            <td><?php  echo $opBanque->getReferenceOperation()  ?>	</td>
									                            <td> Banque </td>
									                        
									                            <td>
																<center>
																		
									                            		<a href="#" title="Modifier" id="<?php  echo $opBanque->getId()  ?>" 
									                            				onclick="modifyMeta(this.id);"  
									                            				type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modifyMeta">
									                            				<i class="fa fa-edit"></i>
									                            		</a>
									                            		<a href="#"  title="Supprimer"id=" <?php  echo $opBanque->getId()  ?> " 
									                                    		onclick="deleteMeta(this.id);"
									                                    		 type="button"  class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delMeta">
									                                    		 <i class="fa fa-times"></i>
									                            		 </a>
									                       		</center>
									                       </td>
									                        </tr>
																 
														   <?php 
																}	
									                       ?>
									                    </tbody>                
									                    </tbody>
									                </table>
									            </div>
									            <!-- /.table-responsive -->
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="panel panel-default">
	                                    <div class="panel-heading" style="background-color: #F7FE2E;">
	                                        <h4 class="panel-title">
	                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Budget Q2</a>
	                                        </h4>
	                                    </div>
	                                    <div id="collapseTwo" class="panel-collapse collapse" align="left">
	                                        <div class="panel-body">
												<!-- /.table-responsive -->
									            <div class="table-responsive">
									                <table class="table table-striped table-bordered table-hover" id="dataTables2">
									                    <thead>
									                        <tr>
									                            <th style="width:15%;overflow:auto">Libellé</th>
									                            <th>Date Opération</th>
									                            <th style="width:15%;overflow:auto">Somme </th>
									                            <th style="width:10%;overflow:auto">Note </th>
																<th style="width:10%;overflow:auto">Num Recu</th>
									                            <th>Actions</th>
									                        </tr>
									                    </thead>
									                    <tbody>
									                       <?php
															require_once(realpath(dirname(__FILE__)) . '/../Classes/Manageur/ManageurBD.php');
															require_once(realpath(dirname(__FILE__)) . '/../Classes//M_SuiviCaisse/OperationBanque.php');
															require_once(realpath(dirname(__FILE__)) . '/../Classes//M_SuiviCaisse/OperationCaisse.php');
															$manageur=ManageurOperation::getInstance();
															$idLigneBudget = 2 ; // L'id de la ligne budgéetaire
															$listeOpCaisse = $manageur->getListOperationCaisse($idLigneBudget);
															$opCaisse = new OperationCaisse(array());	
																//echo var_dump($lesutilisateurs);
																foreach ($listeOpCaisse as $opCaisse){
																 ?>	
																  
									                            <td><?php  echo $opCaisse->getLibelle() ?>	</td>
									                            <td><?php  echo $opCaisse->getDateOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getSommeOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getNoteOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getNumRecu()  ?>	</td>
									                        
									                            <td>
																<center>
									                            		<a href="#" title="Modifier" id="<?php  echo $opCaisse->getId()  ?>" 
									                            				onclick="modifyMeta(this.id);"  
									                            				type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modifyMeta">
									                            				<i class="fa fa-edit"></i>
									                            		</a>
									                            		<a href="#"  title="Supprimer"id=" <?php  echo $opCaisse->getId()  ?> " 
									                                    		onclick="deleteMeta(this.id);"
									                                    		 type="button"  class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delMeta">
									                                    		 <i class="fa fa-times"></i>
									                            		 </a>
									                       		</center>
									                       </td>
									                        </tr>
																 
														   <?php 
																}	
									                       ?>
									                    </tbody>                
									                    </tbody>
									                </table>
									            </div>
									            <!-- /.table-responsive -->
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="panel panel-default">
	                                    <div class="panel-heading" style="background-color: #01DF01;">
	                                        <h4 class="panel-title">
	                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Budget Q3</a>
	                                        </h4>
	                                    </div>
	                                    <div id="collapseThree" class="panel-collapse collapse" align="left">
	                                        <div class="panel-body">
												<!-- /.table-responsive -->
									            <div class="table-responsive">
									                <table class="table table-striped table-bordered table-hover" id="dataTables3">
									                    <thead>
									                        <tr>
									                            <th style="width:15%;overflow:auto">Libellé</th>
									                            <th>Date Opération</th>
									                            <th style="width:15%;overflow:auto">Somme </th>
									                            <th style="width:10%;overflow:auto">Note </th>
																<th style="width:10%;overflow:auto">Num Recu</th>
									                            <th>Actions</th>
									                        </tr>
									                    </thead>
									                    <tbody>
									                       <?php
															require_once(realpath(dirname(__FILE__)) . '/../Classes/Manageur/ManageurBD.php');
															require_once(realpath(dirname(__FILE__)) . '/../Classes//M_SuiviCaisse/OperationBanque.php');
															require_once(realpath(dirname(__FILE__)) . '/../Classes//M_SuiviCaisse/OperationCaisse.php');
															$manageur=ManageurOperation::getInstance();
															$idLigneBudget = 3 ;
															$listeOpCaisse = $manageur->getListOperationCaisse($idLigneBudget);
															$opCaisse = new OperationCaisse(array());	
																//echo var_dump($lesutilisateurs);
																foreach ($listeOpCaisse as $opCaisse){
																 ?>	
																  
									                            <td><?php  echo $opCaisse->getLibelle() ?>	</td>
									                            <td><?php  echo $opCaisse->getDateOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getSommeOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getNoteOperation() ?>	</td>
									                            <td><?php  echo $opCaisse->getNumRecu()  ?>	</td>
									                        
									                            <td>
																<center>
																
									                            		<a href="#" title="Modifier" id="<?php  echo $opCaisse->getId()  ?>" 
									                            				onclick="modifyMeta(this.id);"  
									                            				type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modifyMeta">
									                            				<i class="fa fa-edit"></i>
									                            		</a>
									                            		<a href="#"  title="Supprimer"id=" <?php  echo $opCaisse->getId()  ?> " 
									                                    		onclick="deleteMeta(this.id);"
									                                    		 type="button"  class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delMeta">
									                                    		 <i class="fa fa-times"></i>
									                            		 </a>
									                       		</center>
									                       </td>
									                        </tr>
																 
														   <?php 
																}	
									                       ?>
									                    </tbody>                
									                    </tbody>
									                </table>
									            </div>
									            <!-- /.table-responsive -->
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- .panel-body -->
	                    </div>
	                    <!-- /.panel -->
	                </div>
	                <!-- /.col-lg-12 -->
	            </div>
	            <!-- /.row -->
		</div>
		<div align="center" class="well"> 
        		<a href="ajouteroperation.php">Ajouter une opération</a> 
        </div>
        
        <!-- MODAL POUR LA SUPPRESSION D'UNE METADONNEE  -->
		    <div class="modal fade" id="delMeta" tabindex="-1" role="dialog" aria-labelledby="deleteUser" aria-hidden="true">
		      <div class="modal-dialog modal-lg" >
		        <div class="modal-content" id='deleteMeta'>
		          
		          
		          
		  
		  
		  		
		  		5555  
		        </div>
		      </div>
		    </div>
	    
	     <!-- MODAL POUR LA MODIFICATION D'UNE METADONNEE -->
	    <div class="modal fade" id="modifyMeta" tabindex="-1" role="dialog" aria-labelledby="modifyUser" aria-hidden="true">
	      <div class="modal-dialog modal-lg" id='modifMeta'>
	        
		                            <!-- Le formulaire à ajouter ici avec les recnseignements sur l'utilisateur, avec AJAX -->
							             
							             
		                        
		                        <!-- /.panel-body -->
		                    </div>
		        </div>
        
</body>



</html>
 <script>
$(document).ready(function() {
    $('#dataTables').dataTable( {
	language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    },
		
    } );
} );
$(document).ready(function() {
    $('#dataTables1').dataTable( {
	language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    },
		
    } );
} );
$(document).ready(function() {
    $('#dataTables2').dataTable( {
	language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    },
		
    } );
} );
$(document).ready(function() {
    $('#dataTables3').dataTable( {
	language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    },
		
    } );
} );
    </script>
    
    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
	<script>
	
	function modifyMeta(id) {
	  if (window.XMLHttpRequest) {
	    // code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
	    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	      document.getElementById("modifMeta").innerHTML=xmlhttp.responseText;
	    }
	  }
	 xmlhttp.open("GET","ajax/modifmeta.php?rechercher=1&&id="+id,true);
	  xmlhttp.send();
	}
	
	function deleteMeta(id) {
	  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		      document.getElementById("deleteMeta").innerHTML=xmlhttp.responseText;
		    }
		  }
		 xmlhttp.open("GET","ajax/deleteMeta.php?rechercher=1&&id="+id,true);
		 xmlhttp.send();
	}
	
	function confirmDelete(id) {
	  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		      document.getElementById("deleteMeta").innerHTML=xmlhttp.responseText;
		    }
		  }
		 xmlhttp.open("GET","ajax/deleteMeta.php?suppr=1&&id="+id,true);
		 xmlhttp.send();
	}
	
	function updateMeta() {
		params="title="+document.getElementById("title").value; 
		params+="&&creator="+document.getElementById("creator").value;
		params+="&&subject="+document.getElementById("subject").value;
		params+="&&description="+document.getElementById("description").value;
		params+="&&publisher="+document.getElementById("publisher").value;
		params+="&&contributor="+document.getElementById("contributor").value;
		params+="&&date="+document.getElementById("date").value;
		params+="&&type="+document.getElementById("type").value;
		params+="&&format="+document.getElementById("format").value;
		params+="&&identifier="+document.getElementById("identifier").value;
		params+="&&source="+document.getElementById("source").value;
		params+="&&language="+document.getElementById("language").value;
		params+="&&relation="+document.getElementById("relation").value;
		params+="&&coverage="+document.getElementById("coverage").value;
		params+="&&rights="+document.getElementById("rights").value;
		params+="&&id="+document.getElementById("id").value;
		  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function() {
		    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		      document.getElementById("modifMeta").innerHTML=xmlhttp.responseText;
		    }
		  }
		
		 xmlhttp.open("GET","../php/ajax/modifmeta.php?modif=1&&"+params,true);
		 xmlhttp.send();
		}
 </script>


