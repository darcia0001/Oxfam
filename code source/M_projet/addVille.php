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
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="../assets/style.css" media="all" />
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
				<h1>Ajout d'une nouvelle ville:</h1>
				<form action="BackOffice.php" method="POST" id="formCreation" class="col-lg-6 well">
					
					
					<div class="form-group">
						<label for="nomV">Nom Ville:</label>
						<input type="text" class="form-control" name="nomVille" placeholder="Nom de la ville"/> <br/>
						
					</div>
					
					<div class="form-group">
						<label for="select">Pays : </label>
						<select name="nomPays" class="form-control" id="">
							<?php
								
								$lesPays= $manageur->getListePays();
								
								foreach ($lesPays as $val) {
									echo "<option value=".$val.">".$val."</option>";
								}
							?>
							</select>
					</div>
					

					<input type="submit" name="creerVille" value="Enregistrer" />

				</form>
			</div>
		</div>
		
    
    <script src="../ressources/js/jquery.mobile-1.4.5.js"></script>
</body>
</html>