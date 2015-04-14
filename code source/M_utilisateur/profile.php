<?php
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
$manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donnees
  // ---------------------------- gestion de la securité -------------------------
    session_start();

  if (!isset($_SESSION['utilisateur'])){
  	
    header('Location:  connexion.php');
    exit();
  }
// --------------------------------------------------------------------------------
  $_user=unserialize($_SESSION['utilisateur']);
  if( isset($_REQUEST["modification"])){
  	
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
  	
  }
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
  		
  <script>
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
  		<div class="width80">
  			<div class="col_12">
  				<img class="col_2" src="../assets/img/logo.png" />
  				<p class="col_2">
  					OXFAM
  				</p>
  				<img class="col_2" src="../assets/img/logo.png" />
  				<div class="col_4">
  					<span class="col_12">Bienvenue à </span><span class="col_12"><span class="col_6">Prenom </span><span class="col_6">NOM </span></span><span class="col_12">Nom du projet / Pays</span>
  					<span class="col_12">
  						<select>
  							<option value="">-- Choix langue --</option>
  							<option value="">Français</option>
  							<option value="">Anglais</option>
  						</select> </span>
  				</div>
  				<div class="col_2">
  					<a href="deconnexion.php">
  					<button class="small vert pill fright  icon-signout" type="submit">
  						Quitter
  					</button>
  					</a>
  				</div>
  			</div>
  			<ul class="breadcrumbs col_6">
  				<li>
  					<a href="">Home</a>
  				</li>
  				<li>
  					<a href="">Module</a>
  				</li>
  				<li>
  					<a href="">Sous Module</a>
  				</li>
  			</ul>
  			<p class="col_6 fright txtalignright">
  				jj/mm/yy hh:mm
  			</p>
  			<img class="col_12 sparatorh2" src="../assets/img/separateur.png" />
		              <div class="row">
                      <div class="panel panel-success col-md-6 col-md-offset-3">
	                        <div class="panel-heading" align="center">
	                            Modifier votre profile
	                        </div>
	                        <div id="notification" class="alert-danger alert-dismissable" align="center"></div>
	                        <div class="panel-body">
						<form role="form" action="" method="get">
						<input type="hidden" name="modification" value="1"/>
					                   <div class="form-group">
                                            <label> Prénoms </label>
                                            <input name="prenom" required="" class="form-control" placeholder="Entrer les prénoms" value="<?php echo $_user->getPrenom();?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Nom </label>
                                            <input name="nom" required="" class="form-control" placeholder="Entrer le nom"  value="<?php echo $_user->getNom();?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Profil</label>
                                            <select name="profil" class="form-control" required="" >
												<option value="administrateur" '.$profil1.' >Administrateur</option>
												<option value="agentoxfam" '.$profil2.'  >Agent oxfam</option>
												<option value="agentprojet"   '.$profil3.' >Agent projet</option>
												</select>
                                        </div>
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input name="email" required=""   type="email" class="form-control" placeholder="Entrer l\'adresse email" value="<?php echo $_user->getEmail();?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Mot de passe </label>
                                            <input  name="password"  id="mdp" required=""  type="password" class="form-control" placeholder="Entrer le mot de passe" value="<?php echo$_user->getPassword();?>">
                                        </div>
                                        <div class="form-group">
                                            <label> Vérification du mot de passe </label>
                                            <input name="vmdp" id="vmdp"  required=""  type="password" class="form-control" placeholder="Entrer le mot de passe à nouveau" value="<?php echo $_user->getPassword();?>">
                                        </div>
                                        <!-- id d l utilisateur a modifier -->
                                       
                                        <div class="form-group" id="divBtn" onmouseover="controle()">
                                        <button  id="modifUserBtn"  type="submit" class="btn btn-lg btn-success" ><i class="fa fa-check"></i> Modifier </button>
                                  
                                        </div>
							</form>
  	<!-- g -->
  		</div>
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
  <!-- MODAL POUR LA MODIFICATION D'UN UTILISATEUR -->
      <div class="modal fade" id="modifyUser" tabindex="-1" role="dialog" aria-labelledby="modifyUser" aria-hidden="true">
        <div class="modal-dialog modal-lg" id='modifUser'>
          
  	                            <!-- Le formulaire a  ajouter ici avec les recnseignements sur l'utilisateur, avec AJAX -->
  					             
  					             
                          
                          <!-- /.panel-body -->
                      </div>
   </div>
  </html>
    