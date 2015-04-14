<?php 
require_once(realpath(dirname(__FILE__)) . '/classes/Manageur/ManageurBD.php');
$manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donneeq
// ---------------------------- gestion de la securit� -------------------------
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
	</head>
	<body style="padding-left: 60px; padding-right: 60px;">
		<div class="width80">
			<div class="col_12">
				<img class="col_2" src="assets/img/logo.png" />
				<p class="col_2">
					OXFAM
				</p>
				<img class="col_2" src="assets/img/logo.png" />
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
					<button class="small vert pill fright  icon-signout" type="submit">
						Quitter
					</button>
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
			<img class="col_12 sparatorh2" src="assets/img/separateur.png" />
			<div class="col_6">
				<span class="col_6 icon-dashboard fsize45"></span>
				<div class="col_6">
					<br />
					<span>Accueil Agent<?php echo $user->getProfil();?></span>
				</div>
			</div>
			<div class="col_4 fright txtalignright">
				
			</div>
			<div class="col_12 bar">
				
			</div>
		</div>
	</body>
</html>
