<?php 
	require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurProjet.php');
	$manageur=ManageurProjet::getInstance();//gerer tous rapport objet/base de donneeq

	if (isset($_REQUEST["nomProjet"])){
		$leProjet= $manageur->getProjet($_REQUEST["nomProjet"]);
	}
	
	if (isset($_REQUEST["modifierProjet"])){
		$newP= new Projet();
		
		//$manageur->supprimerProjet($manageur->getProjet($_REQUEST["nomProjet"]));
		
		$oldName = $_REQUEST["oldName"];
		
		$newP->setNom($_REQUEST["nomProjet"]);
		$newP->setVilleProjet($_REQUEST["villeProjet"]); 
		$newP->setCategorie($_REQUEST["categorie"]);
		$newP->setSecteur($_REQUEST["secteurActivite"]);
		
		$manageur->modifierProjet($newP, $oldName);
		
	}
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
			<h1>Modification d'un projet:</h1>
			<form action="modifierProjet.php" method="GET" id="formCreation" class="col-lg-6 well">
				<label for="nom">Nom :</label>
				<?php echo "<input type='text' class='form-control' name='nomProjet'  value='".$leProjet->getNom()."' /> <br/>";
					echo "<input type='hidden' class='form-control' name='oldName'  value='".$leProjet->getNom()."' /> <br/>";
					
				?> 
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
					<label for="select" default="<?php echo "".$leProjet->getSecteur() ?>">Secteur d'activit&eacute : </label>
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

				<input type="submit" name="modifierProjet" value="Enregistrer" />

			</form>
		</div>
	</div>
    
    <script src="../ressources/js/jquery.mobile-1.4.5.js"></script>
</body>
</html>