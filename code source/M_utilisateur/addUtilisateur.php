<?php
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
$manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donneeq
  // ---------------------------- gestion de la securité -------------------------
    session_start();
  if (!isset($_SESSION['utilisateur'])){
  
    header('Location:  connexion.php');
    exit();
  }
    //redirection suivant le profil de l utilisateur
    if (isset($_SESSION['user'])){
	 $user =  unserialize($_SESSION['user']);
	   if (($user->getProfil())=='agenprojet'){//si c est un agent projet on le redirige
	   	header("Location: ../accueil.php");exit();
	   }
	   if (($user->getProfil())=='agenprojet'){//si c est un agent oxfam on le redirige
	   	header("Location: ../accueil.php");exit();
	   }
  }
// --------------------------------------------------------------------------------
?>
<?php
$_user=null;
if( isset($_REQUEST["modification"])){//deuxieme entree sur la page execution de la modification
		$_user=$manageur->getUtilisateur($_REQUEST["email"] );
		//regarde permettre de change l email aussi		
		if(isset($_REQUEST["nom"] )){
			$_user->setNom($_REQUEST["nom"]);
		}
		if(isset($_REQUEST["prenom"] )){
			$_user->setPrenom($_REQUEST["prenom"]);
		}
		if(isset($_REQUEST["password"] )){
			$mdp=$_REQUEST["password"];
	
		$_user->setPassword(sha1($mdp));	 
		}
		if(isset($_REQUEST["profil"] )){
			$_user->setProfil($_REQUEST["profil"]);
		}
		if(isset($_REQUEST["email"] )){
			$_user->setEmail($_REQUEST["email"]);
		}
		if(isset($_REQUEST["tel"] )){
			$_user->setTelephone($_REQUEST["tel"]);
		}
		if(isset($_REQUEST["structure"] )){
			$_user->setStructure($_REQUEST["structure"]);
		}
		if(isset($_REQUEST["groupe"] )){
			$_user->setGroupeUtilisateur($_REQUEST["groupe"]);
		}
		$manageur->update($_user);
		//apres la modification on revien a la page de de gestion des utilisateur
		header("Location: gestion_utilisateurs.php");
		exit();
}
if( isset($_REQUEST["ajout"])){//pour ajouter
	$_user=new Utilisateur(array());
	//regarde permettre de change l email aussi
	if(isset($_REQUEST["nom"] )){
		$_user->setNom($_REQUEST["nom"]);
	}
	if(isset($_REQUEST["prenom"] )){
		$_user->setPrenom($_REQUEST["prenom"]);
	}
	if(isset($_REQUEST["password"] )){
		$mdp=$_REQUEST["password"];
		$_user->setPassword(sha1($mdp));
	}
	if(isset($_REQUEST["profil"] )){
		$_user->setProfil($_REQUEST["profil"]);
	}
	if(isset($_REQUEST["email"] )){
		$_user->setEmail($_REQUEST["email"]);
	}
	if(isset($_REQUEST["structure"] )){
		$_user->setStructure($_REQUEST["structure"]);
	}
	if(isset($_REQUEST["groupe"] )){
		$_user->setGroupeUtilisateur($_REQUEST["groupe"]);
	}
	
	$manageur->addUtilisateur($_user);
	//apres l'ajout on revien a la page de de gestion des utilisateur
	header("Location: gestion_utilisateurs.php");
	exit();
}
if(isset($_REQUEST["modifier"])&isset($_REQUEST["email"])){//premier entree dans la page demande de moification
	$_user=$manageur->getUtilisateur($_REQUEST["email"]);
}
//echo var_dump($_user);				
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Projet Oxfam">
   <meta name="author" content="darcia0001">
    <script>
    $(document).ready(function() {   
    	
    $(function () {
        $("#selectProfil").change(function () {
             
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
 	function controle(){
 		mdp = document.getElementById("mdp").value;
 		vmdp = document.getElementById("vmdp").value;
 		if ( mdp!=""){
 			if ( mdp.length>=5){
	 				document.getElementById("modifUserBtn").disabled=false;
		 			document.getElementById("notification").className="alert-info alert-dismissable";
		 			document.getElementById("notification").innerHTML="Le mot de passe est OK. ";
		 			if (mdp==vmdp){
				 			document.getElementById("modifUserBtn").disabled=false;
				 			document.getElementById("notification").className="alert-info alert-dismissable";
				 			document.getElementById("notification").innerHTML="Les mots de passe correspondent maintenant. ";
				 		}else{
				 			document.getElementById("modifUserBtn").disabled=true;
				 			document.getElementById("notification").className="alert-danger alert-dismissable";
				 			document.getElementById("notification").innerHTML="Les mots de passe ne correspondent pas ! Vérifiez encore.";
				 		}
		 		}else{
		 			document.getElementById("modifUserBtn").disabled=true;
		 			document.getElementById("notification").className="alert-danger alert-dismissable";
		 			document.getElementById("notification").innerHTML="Le mot de passe est trop court. Il doit être supérieur ou égal à 5 caractères";
 			}
	 	}
 	}
 	
 </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Projet Oxfam</a>
            </div>
           
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php if (isset($_REQUEST['modifier']))echo "Modification d'un  utilisateur";else echo  "Ajout d'un  utilisateur";?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
            <div class="panel panel-primary">
                        <div class="panel-heading">
                            <font color="cyan">  <i class="fa fa-edit"></i> </font> Ajouter Utilisateur
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<?php 
                        	if (($_user!=null)&& (isset($_REQUEST['modifier']))){//formulaire de modification
	                        		$profil1="";
	                        		$profil2="";
									if  ($_user->getProfil()=='agentoxfam') 
										$profil1="selected='selected' ";
									$profil3="";
									if  ($_user->getProfil()=='agentProjet') 
										$profil2="selected='selected' ";
	                        	echo '
		                        	 <hr/>
		                            <form role="form" action="addUtilisateur.php?modification=1" method="post">
		                                       <div class="row">
						                            <div class="panel panel-success col-md-6 col-md-offset-3">
							                        <div class="panel-heading" align="center">
							                            Utilisateur trouvé !
							                        </div>
							                        <div id="notification" class="alert-danger alert-dismissable" align="center"></div>
							                        <div class="panel-body">
							                            	<form role="form" >
											                   <div class="form-group">
						                                            <label> Prénoms </label>
						                                            <input name="prenom" required="" class="form-control" placeholder="Entrer les prénoms" value="'.$_user->getPrenom().'">
						                                        </div>
						                                        <div class="form-group">
						                                            <label> Nom </label>
						                                            <input name="nom" required="" class="form-control" placeholder="Entrer le nom"  value="'.$_user->getNom().'">
						                                        </div>
						                                        <div class="form-group">
						                                            <label> Profil</label>
						                                            <select name="profil" class="form-control" required="" >
																		<option value="agentoxfam" '.$profil1.'  >Agent oxfam</option>
																		<option value="agentprojet"   '.$profil2.' >Agent projet</option>
																		</select>
						                                        </div>
						                                        <div class="form-group">
						                                            <label> Email </label>
						                                            <input name="email" required=""   type="email" class="form-control" placeholder="Entrer l\'adresse email" value="'.$_user->getEmail().'">
						                                        </div>
						                                        <div class="form-group">
						                                            <label> Mot de passe </label>
						                                            <input  name="password"  id="mdp" required=""  type="password" class="form-control" placeholder="Entrer le mot de passe" value="'.$_user->getPassword().'">
						                                        </div>
						                                        <div class="form-group">
						                                            <label> Vérification du mot de passe </label>
						                                            <input name="vmdp" id="vmdp"  required=""  type="password" class="form-control" placeholder="Entrer le mot de passe à nouveau" value="'.$_user->getPassword().'">
						                                        </div>
						                                        <!-- id d l utilisateur a modifier -->
						                                          <input name="email" type="hidden" value="'.$_user->getEmail().'" >
						                                        <div class="form-group" id="divBtn" onmouseover="controle()">
						                                        <button  id="modifUserBtn"  type="submit" class="btn btn-lg btn-success" ><i class="fa fa-check"></i> Modifier </button>
						                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                		  										
						                                        </div>
							                         </form>
							                    </div>
					                            </div>
		                                    </form>
		                                    '; 
                        					}
                        					 elseif (isset($_REQUEST['ajouter'])) {//formulaire d ajout
                        					 	//le choix d une structure
                        					 	$lesStructure=$manageur->getListStructure();
                        					 	$selectStruct='';
                        					 	foreach ($lesStructure as $struct){
													$selectStruct.='<option value="'.$struct->getNom().'"   >'.$struct->getNom().'</option>';                        	
                        					 	}
                        					 	//le choix d un groupe d utilisateur
                        					 	$lesgroupes=$manageur->getListGroupe();
                        					 	$selectGroupe='';
                        					 	foreach ($lesgroupes as $groupe){
                        					 		$selectGroupe.='<option value="'.$groupe->getNom().'"   >'.$groupe->getNom().'</option>';
                        					 	}
                        					 	
                        					 	echo  var_dump($selectStruct);
			                                echo '
			                        	 	<hr/>
				                            <form role="form" action="addUtilisateur.php?ajout=1" method="post">
				                                       <div class="row">
								                            <div class="panel panel-success col-md-6 col-md-offset-3">
									                        
									                        <div id="notification" class="alert-danger alert-dismissable" align="center"></div>
									                        <div class="panel-body">
									                            	<form role="form" >
													                   <div class="form-group">
								                                            <label> Prénoms </label>
								                                            <input name="prenom" required="" class="form-control" placeholder="Entrer les prénoms" value=" ">
								                                        </div>
								                                        <div class="form-group">
								                                            <label> Nom </label>
								                                            <input name="nom" required="" class="form-control" placeholder="Entrer le nom"  value=" ">
								                                        </div>
								                                        <div class="form-group">
								                                            <label> Profil</label>
								                                            <select id="selectProfil" name="profil" class="form-control" required="" >
                    															<option value="agentprojet"     >Agent projet</option>
																				<option value="agentoxfam"    >Agent oxfam</option>
																				
																				</select>
								                                        </div>
                    													<div class="form-group">
								                                            <label> Structure</label>
								                                            <select name="structure" class="form-control" required="" >
																				'.$selectStruct.'
																				</select>
								                                        </div>
                    													<div class="form-group">
								                                            <label> Groupes d\'utilisateurs</label>
								                                            <select name="groupe" class="form-control" required="" >
																				<div id="selectGroupeProjet">
												                   					<option class="selectGroupeProjet" value="gestionnaireprojet">Gestionnaire Projet</option>
												                   					<option class="selectGroupeProjet" value="operateurprojet">Operateur Projet</option>
												                   					<option class="selectGroupeProjet" value="gestionnaireprojet">Gestionnaire Projet</option>
											                   					</div>
											                   					<div id="selectGroupeOxfam">
												                   					<option class="selectGroupeOxfam" value="administrateur">Administrateur</option>
												                   					<option class="selectGroupeOxfam" value="agentcontroleoxfam">Agent Controle</option>
												                   					<option class="selectGroupeOxfam" value="agentvalidationoxfam">Agent Validation</option>
											                   					</div>
																			</select>
								                                        </div>
                                       
                         
								                                        <div class="form-group">
								                                            <label> Email </label>
								                                            <input name="email" required=""   type="email" class="form-control" placeholder="Entrer l\'adresse email" value=" ">
								                                        </div>
								                                        <div class="form-group">
								                                            <label> Mot de passe </label>
								                                            <input  name="password"  id="mdp" required=""  type="password" class="form-control" placeholder="Entrer le mot de passe" value="">
								                                        </div>
								                                        <div class="form-group">
								                                            <label> Vérification du mot de passe </label>
								                                            <input name="vmdp" id="vmdp"  required=""  type="password" class="form-control" placeholder="Entrer le mot de passe à nouveau" value="">
								                                        </div>
								                                        
								                                       
								                                 <div class="form-group" id="divBtn" onmouseover="controle()">
						                                        <button  id="modifUserBtn"  type="submit" class="btn btn-lg btn-success" ><i class="fa fa-check"></i> Ajouter </button>
						                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                		  										<button type="button" class="btn btn-info"   onclick="confirmActive(this.id)"><i class="glyphicon glyphicon-ok"></i> Activer</button>
							          							</div>
									                         </form>
									                    </div>
							                            </div>
				                                    </form>
				                                    ';
											}
										
										
										if (isset($_REQUEST['confirmationMod'])) {
											echo'lol
												<div class="row">
						                            <div class="panel panel-info col-md-6 col-md-offset-3">
							                        <div class="panel-heading" align="center">
							                            Utilisateur non trouvé !
							                        </div>
							                        <div class="panel-body">
							                        		<h3 align="center"> Utilisateur modifié avec succès </h3>
							                        </div>
							                     </div>
							                     ';
										}
										
										if (isset($_REQUEST['confirmationAjout'])) {
											echo'
												<div class="row">
						                            <div class="panel panel-info col-md-6 col-md-offset-3">
							                        <div class="panel-heading" align="center">
							                            Utilisateur non trouvé !
							                        </div>
							                        <div class="panel-body">
							                        		<h3 align="center"> Utilisateur modifié avec succès </h3>
							                        </div>
							                     </div>
							                     ';
										}
										?>
                        </div>
                        
                        <!-- /.panel-body -->
                    </div>
                    
        </div>
        <!-- /#page-wrapper -->
			
    </div>
    <!-- /#wrapper -->
    <br />
    <br />

	<!-- FOOTER -->
      <footer class="navbar-fixed-bottom" style="background-color: #DDDDDD">
      		<div class="container">
      			<br />
        		<p class="pull-right"><a href="#"> Retour en haut </a></p>
        		<p>&copy; 2015 Oxfam &middot; <a href="../confidentialites.php">Confidentialité</a> &middot; <a href="../conditions.php">Conditions d'utilisation</a></p>
        	</div>
      </footer>
      
      
<script type="text/javascript" src="../assets/js/jquery.js"></script>
    	<!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>

  

</body>

</html>
