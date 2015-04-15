<?php 
require_once(realpath(dirname(__FILE__)) . '/classes/Manageur/ManageurBD.php');
$manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donneeq
// ---------------------------- gestion de la securité -------------------------
session_start();
if (!isset($_SESSION['utilisateur'])){
	header('Location:  connexion.php');
	exit();
}

	$user =  unserialize($_SESSION['utilisateur']);
	

// --------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html>
	<head>
		<title>OxFam| Connexion</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
		<meta name="copyright" content="" />
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="assets/style.css" media="all" />
		<script type="text/javascript" src="assets/js/jquery.js"></script>
		<script type="text/javascript" src="assets/js/js.js"></script>
		<script type="text/javascript" src="assets/js/tab.js"></script>
		 <!-- Bootstrap Core CSS -->
    	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="ressources/css/ourstyle.css">
	</head>
	<body style="padding-left: 60px;padding-right: 60px;">
	
		<?php  include("header.php");?>
		<div class=   >
			<img class="col_12 sparatorh2" src="assets/img/separateur.png" />
			<div class="col_6">
				<span class="col_6 icon-dashboard fsize45"></span>
				<div class="col_6">
					<br />
					<span>Accueil Administrateur <?php echo $user->getProfil();?></span>
				</div>
			</div>
			
			<div class="col_12  ">
				<a href="M_utilisateur/gestion_utilisateurs.php"        title="Supprimer"  type="button"  class="btn btn-success btn-circle" >    
				Gestion Utilisateurs
                <i class="fa fa-edit"></i>
                </a>
                
                <a href="M_projet/BackOffice.php"        title="Gestion Projets"  type="button"  class="btn btn-success btn-circle" >    
				Gestion Projets
                <i class="fa fa-edit"></i>
                </a>
                
                <a href="M_utilisateur/gestion_utilisateurs.php"        title="Supprimer"  type="button"  class="btn btn-success btn-circle" >    
				gestion des langues
                <i class="fa fa-edit"></i>
                </a>
                
                <a href="#"        title="Supprimer"  type="button"  class="btn btn-success btn-circle" >    
				Gestion Controle
                <i class="fa fa-edit"></i>
                </a>
                
                <a href="M_utilisateur/profile.php"        title="Supprimer"  type="button"  class="btn btn-success btn-circle" >    
				Profile
                <i class="fa fa-edit"></i>
                </a>
                
                <a href="M_budget/formOpenPlanMensuel.php"        title="Supprimer"  type="button"  class="btn btn-success btn-circle" >    
				Gestion Budget
                <i class="fa fa-edit"></i>
                </a>
			</div>
		</div>
	</body>
</html>
