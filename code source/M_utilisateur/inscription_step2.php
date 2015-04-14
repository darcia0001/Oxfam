<?php
session_start();
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
  if (isset($_SESSION['utilisateur'])){//si existe un utilisateur connecter on peut pas poursuivre l insciption
	header("Location: ../accueil.php");
  }
  //verification k on vien bien de l etape 1
  if ((isset($_REQUEST['code'])) && (isset($_SESSION['code']))){
  	if ($_REQUEST['code']!=$_SESSION['code'] ) //si l code n conrespond pas
  	{die("<meta http-equiv='refresh' content=0;URL='inscription_step1.php'>");
  	}
  }else{
  	die("<meta http-equiv='refresh' content=0;URL='inscription_step1.php'>");
  	}//si les variable n existe pas
  
	$manageur=ManageurUtilisateur::getInstance();
	if (isset($_POST['email'])){
				$user=new Utilisateur(array());
				if(isset($_REQUEST["nom"] )){
					$user->setNom($_REQUEST["nom"]);
				}
				if(isset($_REQUEST["prenom"] )){
					$user->setPrenom($_REQUEST["prenom"]);
				}
				if(isset($_REQUEST["password"] )){
					$user->setMdp(sha1($_REQUEST["password"]));
				}
				if(isset($_REQUEST["profil"] )){
					$user->setProfil($_REQUEST["profil"]);
				}
				if(isset($_REQUEST["email"] )){
					$user->setEmail($_REQUEST["email"]);
				}
				if(isset($_REQUEST["structure"] )){
					$_user->setStructure($_REQUEST["structure"]);
				}
				if(isset($_REQUEST["groupe"] )){
					$_user->setGroupeUtilisateur($_REQUEST["groupe"]);
				}
				$manageur->addUtilisateur($user);
				
                $_SESSION['ok']=1;
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
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../assets/style.css" media="all" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/js.js"></script>

<script>
 	function controle(){
 		mdp = document.getElementById("mdp").value;
 		vmdp = document.getElementById("vmdp").value;
 		if ( mdp!=""){
 			if ( mdp.length>=5){
	 				document.getElementById("SubmitBtn").disabled=false;
		 			document.getElementById("notification").className="alert-info alert-dismissable";
		 			document.getElementById("notification").innerHTML="Le mot de passe est OK. ";
		 			if (mdp==vmdp){
				 			document.getElementById("SubmitBtn").disabled=false;
				 			document.getElementById("notification").className="alert-info alert-dismissable";
				 			document.getElementById("notification").innerHTML="Les mots de passe correspondent maintenant. ";
				 		}else{
				 			document.getElementById("SubmitBtn").disabled=true;
				 			document.getElementById("notification").className="alert-danger alert-dismissable";
				 			document.getElementById("notification").innerHTML="Les mots de passe ne correspondent pas ! Vérifiez encore.";
				 		}
		 		}else{
		 			document.getElementById("SubmitBtn").disabled=true;
		 			document.getElementById("notification").className="alert-danger alert-dismissable";
		 			document.getElementById("notification").innerHTML="Le mot de passe est trop court. Il doit être supérieur ou égal à 5 caractères";
 			}
	 	}
 	}
 	
 </script>
</head>

<body>
<body>
    <div class="loginform col_12">
        <div class="col_12  bgvert minh200">
            <div class="col_6">
                <img src="../assets/img/logo.png" />
            </div>
            <div class="col_6">
                        <div id="notification" class=' alert-danger alert-dismissable ' align='center'></div>
                        <?php 
                        if (isset($_SESSION['email']) ) $email= 'value ="'.$_SESSION["email"].'"';
                        if (!isset($_SESSION['ok'])){
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
						 echo '
                        <div class="panel-body">
                            <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <label> Prénoms </label>
                                            <input name="prenom" class="form-control" placeholder="Entrer les prénoms" required="">
                                        </div>
                                        <div class="form-group">
                                            <label> Nom </label>
                                            <input name="nom" class="form-control" placeholder="Entrer le nom" required="">
                                        </div>
                                        <input name="profil" type="hidden" value="chercheur">
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input  type="email"  disabled="" class="form-control"  required="" '.$email.' >  
                                            <input name="email"  type="hidden"  class="form-control"  required=""  '.$email.'  >
                                        </div>
                                        <div class="form-group">
                                            <label> Profil</label>
                                            <select name="profil" class="form-control" required="" >
												<option value="administrateur"   >Administrateur</option>
												<option value="agentoxfam"    >Agent oxfam</option>
												<option value="agentprojet"     >Agent projet</option>
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
												'.$selectGroupe.'
												</select>
								       </div>    		
                                        <div class="form-group">
                                            <label> Mot de passe </label>
                                            <input  name="mdp"  id="mdp"  type="password" class="form-control" placeholder="Entrer le mot de passe" required="">
                                        </div>
                                        <div class="form-group">
                                            <label> Vérification du mot de passe </label>
                                            <input name="vmdp" id="vmdp" type="password" class="form-control" placeholder="Entrer le mot de passe à nouveau" required="">
                                        </div>
                                        <br />
                                        <div class="form-group pull-right" id="divBtn" onmouseover="controle()">
		                                        <button id="SubmitBtn"  type="submit" class="btn btn-lg btn-success"  ><i class="fa fa-check"></i> Soumettre</button>
		                                        <button type="reset" class="btn btn-lg btn-danger"> <i class="fa fa-times"></i> Annuler</button>
                                        </div>
                                    </form>
                                    ';
									} else {
                                      echo "
						   					<p align='center' style='font-size : 1.5em'>  Inscription terminée avec succès. <br/> <a href='login.php'> Vous pouvez vous connecter ici </a> </p>
						   				";
                                    }
                                    ?>
            </div>
        </div>
    </div>
<footer>
		<hr />
		<div class="frontoffstat_piedpage">
		Infos OXFAM / Phone / Adresse / etc. 
		</div>
		<hr class="ligne_rouge" />
</footer>
 

</body>

</html>
