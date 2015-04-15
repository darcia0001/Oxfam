<?php
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
$manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donneeq
// ---------------------------- gestion de la securité -------------------------
    session_start();
  if (!isset($_SESSION['utilisateur'])){
  
    header('Location:  connexion.php');exit();
  }
    //redirection suivant le profil de l utilisateur
    if (isset($_SESSION['utilisateur'])){
	 $user =  unserialize($_SESSION['utilisateur']);
	   if (($user->getProfil())=='agentprojet'){//si c est un agent projet on le redirige
	   	header("Location: ../accueil.php");exit();
	   	 
	   }
	   if (($user->getProfil()=='agentoxfam')&&($user->getGroupeUtilisateur()!="administrateur")){//si c est un agent oxfam non administrateur on le redirige
	   		header("Location: ../accueil.php");exit();
	   		 
	   }
  }
// --------------------------------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>OxFam| Connexion</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
		<meta name="copyright" content="" />
		<link rel="stylesheet" type="text/css" href="../assets/css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="../assets/style.css" media="all" />
		<script type="text/javascript" src="../assets/js/jquery.js"></script>
		<script type="text/javascript" src="../assets/js/js.js"></script>
		<script type="text/javascript" src="../assets/js/tab.js"></script>
		 <!-- Bootstrap Core CSS -->
    	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    	<!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- DataTables CSS -->
<link href="../assets/css/plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../ressources/css/ourstyle.css">
    <script>
    
     $(document).ready(function() {   
    	//alert("charger");
    	$('#modifUser').change(
        		function() {        			
        	            var val = $('#selectProfil option:selected').val();
        	            if (val == "agentoxfam") {
        	                
        	                $(".selectGroupeOxfam").show();
        	                $(".selectGroupeProjet").hide();
        	            }
        	            if (val == "agentprojet") {
        	            	
        	                $(".selectGroupeOxfam").hide();
        	                $(".selectGroupeProjet").show();
        	            }
        		});
    $(function () {
        //alert("");
        $(".selectGroupeOxfam").hide();
        $(".selectGroupeProjet").show();
        $("#selectProfil").change(function () {
//         	alert("change profil");
            var val = $('#selectProfil option:selected').val();
            if (val == "agentoxfam") {
                
                $(".selectGroupeOxfam").show();
                $(".selectGroupeProjet").hide();
            }
            if (val == "agentprojet") {
            	
                $(".selectGroupeOxfam").hide();
                $(".selectGroupeProjet").show();
            }
            
        })
    })
    } );//document ready
    </script>
		
<script>
var emailsUtilisateursChecked=new Array();
//Array Remove 
Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};
//fonction appele a c chak fois k il y a un check ou uncheck pour prendre
//l email des utilisateurt checked
function checkall(input){
	alert(input.value);
}
function eventCheck(email){
	i=0;
	//on cherche l email dans le tableau
	while(i<emailsUtilisateursChecked.length){
		if(emailsUtilisateursChecked[i]==email){//si on le trouve on l enleve et on kitte
			emailsUtilisateursChecked.remove(i);
			//alert(emailsUtilisateursChecked);
			return ;
		}

		i++;
	}
	
	//puisk l email ne s y trouve pas on l ajoute
	emailsUtilisateursChecked.push(email);
	//alert(emailsUtilisateursChecked);
}
function modifyUser() {
		if(emailsUtilisateursChecked.length>1 || emailsUtilisateursChecked.length<1){
			alert("veillez  cocher un et un seul  utilisateur pour la modification");
			return;
		}
		email=emailsUtilisateursChecked[0];
		 
	  if (window.XMLHttpRequest) {
	    // code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
	    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	      document.getElementById("modifUser").innerHTML=xmlhttp.responseText;
	    }
	  }
	 xmlhttp.open("GET","addUtilisateur.php?modifier=1&&email="+email,true);
	  xmlhttp.send();
	}
	function addUser() {
		email="darcia@yahoo.fr";
		 
	  if (window.XMLHttpRequest) {
	    // code for IE7+, Firefox, Chrome, Opera, Safari
	    xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
	    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	      document.getElementById("modifUser").innerHTML=xmlhttp.responseText;
	    }
	  }
	 xmlhttp.open("GET","addUtilisateur.php?ajouter=1&email="+email,true);
	  xmlhttp.send();
	  $(".selectGroupeOxfam").hide();
      $(".selectGroupeProjet").show();
	  $("#selectProfil").change(function () {
//       	alert("change profil");
          var val = $('#selectProfil option:selected').val();
          if (val == "agentoxfam") {
              
              $(".selectGroupeOxfam").show();
              $(".selectGroupeProjet").hide();
          }
          if (val == "agentprojet") {
          	
              $(".selectGroupeOxfam").hide();
              $(".selectGroupeProjet").show();
          }
          
      })
	}
	function deleteUser() {
		if(emailsUtilisateursChecked.length>1 || emailsUtilisateursChecked.length<1){
			alert("veillez  cocher un et un seul  utilisateur pour la suppression");
			return;
		}
		email=emailsUtilisateursChecked[0];
		 
	  if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp=new XMLHttpRequest();
		  } else { // code for IE6, IE5
		    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		      document.getElementById("modifUser").innerHTML=xmlhttp.responseText;
		    }
		  }
		 xmlhttp.open("GET","deleteuser.php?rechercher=1&&email="+email,true);
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
		      document.getElementById("deleteUser").innerHTML=xmlhttp.responseText;
		    }
		  }
		 xmlhttp.open("GET","deleteuser.php?suppr=1&&id="+id,true);
		 xmlhttp.send();
	}
	


 	function controle(){
 		mdp = document.getElementById("mdp").value;
 		vmdp = document.getElementById("vmdp").value;
 		if ( mdp!=""){
 			if ( mdp.length>=5){
	 				document.getElementById("saveUserBtn").disabled=false;
		 			document.getElementById("notification").className="alert-info alert-dismissable";
		 			document.getElementById("notification").innerHTML="Le mot de passe est OK. ";
		 			if (mdp==vmdp){
				 			document.getElementById("saveUserBtn").disabled=false;
				 			document.getElementById("notification").className="alert-info alert-dismissable";
				 			document.getElementById("notification").innerHTML="Les mots de passe correspondent maintenant. ";
				 		}else{
				 			document.getElementById("saveUserBtn").disabled=true;
				 			document.getElementById("notification").className="alert-danger alert-dismissable";
				 			document.getElementById("notification").innerHTML="Les mots de passe ne correspondent pas ! VÃ©rifiez encore.";
				 		}
		 		}else{
		 			document.getElementById("saveUserBtn").disabled=true;
		 			document.getElementById("notification").className="alert-danger alert-dismissable";
		 			document.getElementById("notification").innerHTML="Le mot de passe est trop court. Il doit Ãªtre supÃ©rieur ou Ã©gal Ã  5 caractÃ¨res";
 			}
	 	}
 	}
 </script>	
	</head>
	<body style="padding-left: 60px; padding-right: 60px;">
			<?php  include("header.php");?>
			<img class="col_12 sparatorh2" src="../assets/img/separateur.png" />
			<div class="col_6">
				<span class="col_6 icon-dashboard fsize45"></span>
				<div class="col_6">
					<br />
					<span style="font-size:2em;">Gestion Utilisateurs</span>
				</div>
			</div>
			<div class="col_6">
			<a href="#"
                   id="btn_add"
                   title="ajouter"
                   onclick="addUser();"
                   type="button"
                   class="btn btn-success btn-circle"
                   data-toggle="modal"
                   data-target="#modifyUser">
                    Ajouter
                    <i class="fa fa-edit"></i>
                </a>
                <a href="#"
                   title="Modifier"
                   id="btn_edit"
                   onclick="modifyUser();"
                   type="button"
                   class="btn btn-success btn-circle"
                   data-toggle="modal"
                   data-target="#modifyUser">
                    Modifier
                    <i class="fa fa-edit"></i>
                </a>
                <a href="#"
                   title="Supprimer"
                   id="btn_del"
                   onclick="deleteUser();"
                   type="button"
                   class="btn btn-success btn-circle"
                   data-toggle="modal"
                   data-target="#modifyUser">
                    Supprimer
                    <i class="fa fa-edit"></i>
                </a>
			</div>
			<div class="col_4 fright txtalignright">
				
			</div>
			<div class="table-responsive">
			<table  class="table table-striped table-bordered table-hover  " cellpadding="0" cellspacing="0" id="userTable">
					<caption >
						<h1 class="    "> Liste des utilisateurs</h1>
					</caption>
                                    <thead >
                                        <tr>
                                        	<th><input onchange="checkall(this)" type="checkbox" /> </th>
                                            <th style="width:20%" >Prenom </th>
											<th width="10%">Nom </th>
											<th width="20%">Email </th>
											<th width="20%">Profil </th>
											<th width="10%"> Structure </th>
											 <th width="20%"> Groupe </th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                       
					                         $lesutilisateurs=$manageur->getListUtilisateur();
							
											//echo var_dump($lesutilisateurs);
											foreach ($lesutilisateurs as $user){
											?>	
											<tr class="" >
											<td>
											 <input name="iduser" value="<?php echo $user->getEmail();?>"  type="checkbox" onchange="eventCheck(this.value)" />
											</td>
					                        <td><?php  echo $user->getPrenom() ?>	</td>
					                        <td><?php  echo $user->getNom() ?>	</td>
					                        <td><?php  echo $user->getEmail() ?>	</td>
					                        <td><?php  echo $user->getProfil() ?>	</td>
					                        <td><?php  echo $user->getStructure() ?>	</td>
					                         <td><?php  echo $user->getGroupeUtilisateur() ?>	</td>
					                        </tr>
																 
											<?php 
											}	
					
					                        ?>                          
                                       
                                    </tbody>
                                </table>
			</div>
			
		</div>
<footer>
		<hr />
		<div class="frontoffstat_piedpage">
		Infos OXFAM / Phone / Adresse / etc. 
		</div>
		<hr / class="ligne_rouge">
</footer>
</body>
<!-- MODAL POUR LA MODIFICATION/AJOUT D'UN UTILISATEUR -->
    <div class="modal fade" id="modifyUser" tabindex="-1" role="dialog" aria-labelledby="modifyUser" aria-hidden="true">
      <div class="modal-dialog modal-lg" id='modifUser'>
        
	                            <!-- Le formulaire a  ajouter ici avec les recnseignements sur l'utilisateur, avec AJAX -->
					             
					             
                        
                        <!-- /.panel-body -->
                    </div>
 </div>
	<!-- DataTables JavaScript -->
    <script src="../assets/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
    $(document).ready(function() {
        $('#userTable').DataTable({	
            language: {
                processing:     "Traitement en cours...",
                search:         "Rechercher&nbsp;:",
                lengthMenu:    "Afficher _MENU_ utilisateurs",
                info:           "Affichage de l'utilisateur _START_ &agrave; _END_ sur _TOTAL_ utilisateurs",
                infoEmpty:      "Affichage de l'utilisateur 0 &agrave; 0 sur 0 utilisateurs",
                infoFiltered:   "(filtr&eacute; de _MAX_ utilisateurs au total)",
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
            });
    } );
    </script>

</html>
