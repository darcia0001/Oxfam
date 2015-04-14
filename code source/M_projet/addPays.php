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
				<h1>Ajout d'un nouveau pays:</h1>
				<form action="BackOffice.php" method="POST" id="formCreation" class="col-lg-6 well">
					
					
					<div class="form-group">
						<label for="code">Code Pays:</label>
						<input type="text" class="form-control" name="codePays" placeholder="Code du Pays"/> <br/>
						
					</div>
					<div class="form-group">
						<label for="nom">Nom Complet Pays:</label>
						<input type="text" class="form-control" name="nomPays" placeholder="nom du Pays"/> <br/>
						
					</div>
					
					
					<div class="form-group">
					<label for="select">Langue du pays : </label>
						<select name="langue" class="form-control" id="">
							<?php
								
								$lesLangues= $manageur->getListeLangues();
								
								foreach ($lesLangues as $val) {
									echo "<option value=".$val.">".$val."</option>";
								}
							?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="select">Monnaie du pays : </label>
						<select name="monnaie" class="form-control" id="">
							<?php
								
								$lesMonnaies= $manageur->getListeMonnaies();
								
								foreach ($lesMonnaies as $val) {
									echo "<option value=".$val.">".$val."</option>";
								}
							?>
							</select>
					</div>
					

					<input type="submit" name="creerPays" value="Enregistrer" />

				</form>
			</div>
		</div>
		
    
    <script src="../ressources/js/jquery.mobile-1.4.5.js"></script>
</body>
</html>