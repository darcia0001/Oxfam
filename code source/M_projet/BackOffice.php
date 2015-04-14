<?php
	require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurProjet.php');
	$manageur=ManageurProjet::getInstance();

	//gerer tous rapport objet/base de donneeq
	/*  // ---------------------------- gestion de la sécurité -------------------------
		session_start();

	  if (!isset($_SESSION['user'])){
		//regarde pour l instant on en fait fie d etre co
		//header('Location:  connexion.php');
	  }
		if (isset($_SESSION['user'])){
		 $user =  unserialize($_SESSION['user']);
		   if (($user->getProfil())!='administrateur')
				header("Location: ../".$user->getProfil());
	  }
	// -------------------------------------------------------------------------------- */
?>
<html>
<head>
    <title>BackOffice</title>
	<meta charset="UTF-8">
	
    <link rel="stylesheet" type="text/css" href="../ressources/css/ourstyle.css">
    <link href="../ressources/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../ressources/font-awesome-4.1.0/css/font-awesome.css" rel="stylesheet">
</head>

<body>

    <?php  
        include("header.php");
    ?>
	<br/>
	<div id="wrapper">
		<?php
				include("menu.php");
		?>	
					
		<div class="col-md-8 text-center">
			<h2>Bienvenue dans le Back Office de la plateforme OXFAM</h2>
		</div>
		
		<?php 
			if (isset($_REQUEST["creerVille"])){
				$ville= new Ville();

				if (isset($_REQUEST["nomVille"])){
				  $ville->setNomVille($_REQUEST["nomVille"]);
				}

				if (isset($_REQUEST["nomPays"])){
				  $ville->setNomPays($_REQUEST["nomPays"]);
				}

				$manageur->addVille($ville);

				echo '
					<div class=" col-md-8 text-center alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								Ville ajout&eacutee avec succès !
					</div>
							';

			}
		
			if (isset($_REQUEST["creerPays"])){
				$pays= new Pays();

				if (isset($_REQUEST["nomPays"])){
				  $pays->setNomPays($_REQUEST["nomPays"]);
				}

				if (isset($_REQUEST["codePays"])){
				  $pays->setCodePays($_REQUEST["codePays"]);
				}
				if (isset($_REQUEST["langue"])){
				  $pays->setLanguePays($_REQUEST["langue"]);
				}
				if (isset($_REQUEST["monnaie"])){
				  $pays->setDevisePays($_REQUEST["monnaie"]);
				}

				$manageur->addPays($pays);

				echo '
					<div class=" col-md-8 text-center alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Pays ajouté avec succès !
					</div>
							';

			}
		
			if (isset($_REQUEST["creerProjet"])){
		$projet= new Projet();

		if (isset($_REQUEST["nomProjet"])){
			  $projet->setNom($_REQUEST["nomProjet"]);
			}

			if (isset($_REQUEST["villeProjet"])){
			  $projet->setVilleProjet($_REQUEST["villeProjet"]);
			}
			if (isset($_REQUEST["categorie"])){
			  $projet->setCategorie($_REQUEST["categorie"]);
			}
			if (isset($_REQUEST["secteurActivite"])){
			  $projet->setSecteur($_REQUEST["categorie"]);
			}

			$manageur->addProjet($projet);

			echo '
				<div class="col-md-8 text-center alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							Projet ajouté avec succès !
				</div>
						';

			}
		?>
		
		<div col-md-12>
			<div col-md-3 col-md-offset-5>
			
			</div>
			<div col-md-3>
				
			</div>
			<div col-md-3>
				
			</div>
		</div>
	</div>
		
    
    <script src="../ressources/js/jquery.mobile-1.4.5.js"></script>
</body>
</html>