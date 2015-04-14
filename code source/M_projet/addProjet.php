<?php
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurProjet.php');
$manageur=ManageurProjet::getInstance();//gerer tous rapport objet/base de donneeq
  // ---------------------------- gestion de la securité -------------------------
    session_start();
  if (!isset($_SESSION['utilisateur'])){
  
    header('Location:  connexion.php');
    exit();
  }
    //redirection suivant le profil de l utilisateur
    if (isset($_SESSION['utilisateur'])){
	 $user =  unserialize($_SESSION['utilisateur']);
	   if (($user->getProfil())=='agenprojet'){//si c est un agent projet on le redirige
	   	header("Location: ../accueil.php");exit();
	   }
	   /*if (($user->getProfil()=='agentoxfam')&&($user->getGroupeUtilisateur()!="administrateur")){//si c est un agent oxfam non administrateur on le redirige
	   		header("Location: ../accueil.php");exit();
	   }
	   */
  }
// --------------------------------------------------------------------------------

?>
<html>
<head>
    <title>BackOffice</title>

    <link rel="stylesheet" type="text/css" href="../ressources/css/ourstyle.css">
    <!-- Bootstrap Core CSS -->
    <link href="../ressources/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
</head>
<body>

    <?php  
        include("header.php");
    ?>
	<div class="wrapper">
		<?php
			include("menu.php");
		?>
		
		<div class="col-md-offset-5">
			<h1>Ajout d'un nouveau projet:</h1>
			<form action="BackOffice.php" method="POST" id="formCreation" class="col-lg-6 well">
				<label for="nom">Nom :</label>
				<input type="text" class="form-control" name="nomProjet" placeholder="nom du Projet"/> <br/>
				
				<div class="form-group">
					<label for="select">Ville du projet : </label>
					<select name="villeProjet" class="form-control" id="">
						<?php
							
							$lesVilles= $manageur->getListeVilles();
							
							foreach ($lesVilles as $val) {
								echo "<option value=".$val.">".$val."</option>";
							}
						?>
					</select>
				</div>

				<div class="form-group">
					<label for="select">Secteur d'activit&eacute : </label>
					<select name="secteurActivite" class="form-control" id="">
						<?php

							$lesSects= $manageur->getListeSecteurActivite();
							
							foreach ($lesSects as $val) {
								echo "<option value=".$val.">".$val."</option>";
							}
						?>
					</select>
				</div>

				<div class="form-group">
					<label for="select">Cat&eacutegorie du projet : </label>
					<select name="categorie" class="form-control" id="">
						<?php
							
							$lesCategs= $manageur->getListeCategorieProjet();
							
							foreach ($lesCategs as $val) {
								echo "<option value=".$val.">".$val."</option>";
							}
						?>
					</select>
				</div>

				<input type="submit" name="creerProjet" value="Enregistrer" />

			</form>
		</div>
	</div>
    
    <script src="../ressources/js/jquery.mobile-1.4.5.js"></script>
</body>
</html>