<?php
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurProjet.php');
$manageur=ManageurProjet::getInstance();//gerer tous rapport objet/base de donneeq
// ---------------------------- gestion de la securit� -------------------------
    session_start();
  if (!isset($_SESSION['utilisateur'])){
  
    header('Location:  connexion.php');exit();
  }
    //redirection suivant le profil de l utilisateur
    if (isset($_SESSION['utilisateur'])){
	 $user =  unserialize($_SESSION['utilisateur']);
	   if (($user->getProfil())=='agentprojet'){//si c est un agent projet on le redirige
	   	header("Location: ../accueil.php");exit();
	   	 
	   }
// 	   if (($user->getProfil()=='agentoxfam')&&($user->getGroupeUtilisateur()!="administrateur")){//si c est un agent oxfam non administrateur on le redirige
// 	   		header("Location: ../accueil.php");exit();
	   		 
// 	   }
  }
// --------------------------------------------------------------------------------
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
        <div class="alert alert-success alert-dismissable" align="center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Projet ajouté avec succès !
        </div>
                ';

	
  }
?>
<html>
<head>
    <title>BackOffice</title>

    <link rel="stylesheet" type="text/css" href="../ressources/css/ourstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="../assets/style.css" media="all" />
	<!-- Bootstrap Core CSS -->
    <link href="../ressources/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../ressources/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
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
		
			<div class="col-md-offset-3 listeProjet">
			<h1>Liste des projets :</h1>	
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Nom Projet</th>
						<th>Secteur d'Activit&eacute</th>
						<th>Cat&eacutegorie</th>
						<th>Ville</th>
						<th>Modifier</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$lesPrjts= $manageur->getListeProjets(); 
						
						foreach($lesPrjts as $val){
						echo (" <tr> <td>".$val["NOM"]."</td> <td>".$val["SECTEUR_ACTIVITE"]."</td> <td>".$val["CATEGORIE"]."</td> <td>".$val["NOM_VILLE"]."</td> 
									<td> <a href='modifierProjet.php?nomProjet=".$val["NOM"]."' title='Modifier Projet' id=''  type='button' class='btn btn-success btn-circle' data-toggle='modal' data-target='#modifyUser'><i class='fa fa-edit'></i></a> </td> 
								</tr>");
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	
	
    <script src="../ressources/js/jquery.mobile-1.4.5.js"></script>
	<!-- Bootstrap Core JavaScript -->
    <script src="../ressources/js/bootstrap.min.js"></script>
</body>
</html>