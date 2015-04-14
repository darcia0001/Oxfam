<?php
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
$manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donneeq
  // ---------------------------- gestion de la securité -------------------------
    session_start();
  if (!isset($_SESSION['utilisateur'])){
  
    header('Location:  connexion.php');
    exit();
  }
    //redirection suivant le profil de l utilisateur
    if (isset($_SESSION['utilisateur'])){
	 $user =  unserialize($_SESSION['user']);
	   if (($user->getProfil())=='agenprojet'){//si c est un agent projet on le redirige
	   	header("Location: ..");exit();
	   }
	   if (($user->getProfil())=='agenprojet'){//si c est un agent oxfam on le redirige
	   	header("Location: ..");exit();
	   }
  }
// --------------------------------------------------------------------------------

	$user=null;
			if(isset($_REQUEST["supprimerUtilisateur"]) && isset($_REQUEST["id"])){
				$manageur->deleteUtilisateurByEmail($_REQUEST["id"]);
				//apres la modification on revien a gestion utilisateurs
				header("Location: gestion_utilisateurs.php");
				exit();
			}
			if(isset($_REQUEST["email"])){
				$user=$manageur->getUtilisateur($_REQUEST["email"]);				
				}
				
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Oxfam">
    <meta name="author" content="darcia0001">

    <title>Oxfam</title>

   

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Projet Oxfam </a>
            </div>
            <!-- /.navbar-header -->

            

            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Supression d'un  utilisateur</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
            <div class="panel panel-primary" >
                        <div class="panel-heading">
                            <font color="cyan">  <i class="fa fa-times	"></i> </font> Suppression de l' Utilisateur
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	
                        	<?php 
                        	if (isset($_REQUEST['email']) && ($_REQUEST['email']!='')){
                        		if ( $user!=null){
                        			echo '
                        	 <hr/>
                            <form role="form" action="deleteuser.php?deleted=1" method="post">
 
                                        <div class="row">
				                            <div class="panel panel-success col-md-6 col-md-offset-3">
					                        <div class="panel-heading" align="center">
					                            Utilisateur trouvé !
					                        </div>
					                        <div class="panel-body">
					                            
					                            <div class="table-responsive">
						                                <table class="table">
						                                    <thead>
						                                        <tr>
						                                            <th>Prénoms</th>
						                                            <th>Nom</th>
						                                        </tr>
						                                    </thead>
						                                    <tbody>
						                                        <tr>
						                                            <td>'.$user->getPrenom().'</td>
						                                            <td>'.$user->getNom().'</td>
						                                        </tr>
						                                    </tbody>
						                                </table>
						                            </div>
					                        </div>
					                        <!-- id d l utilisateur a supprimer -->
				                                          <input name="id" type="hidden" value="'.$user->getEmail().'" >
					                        <div  align="center">
					                            	<div class="form-group">
		                                        		<button name="supprimerUtilisateur" type="submit" class="btn btn-lg btn-danger"> <i class="fa fa-times"></i> Suppimer ?</button>
		                                        </div>
					                        </div>
					                    </div>
			                            </div>
                                    </form>
                                    ';
                                    }elseif (!isset($_REQUEST['deleted'])) {
		                                    	echo'
												<div class="row">
						                            <div class="panel panel-info col-md-6 col-md-offset-3">

							                        <div class="panel-heading" align="center">
							                            Utilisateur non trouvé !
							                        </div>
							                        <div class="panel-body">
							                        		<h3 align="center"> Cet utilisateur n\'existe pas dans la base de données </h3>
							                        </div>
							                     </div>';
							              }
                                }
                                if (isset($_REQUEST['deleted'])) {
											echo'
												<div class="row">
						                            <div class="panel panel-info col-md-6 col-md-offset-3">
							                        <div class="panel-heading" align="center">
							                            Utilisateur non trouvé !
							                        </div>
							                        <div class="panel-body">
							                        		<h3 align="center"> Utilisateur supprimé avec succès </h3>
							                        </div>
							                     </div>
							                     ';
										}
									?>
									
                        </div>
                        <!-- /.panel-body -->

                    </div>
            
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <br />
    <br />

	<!-- FOOTER -->
      <footer class="navbar-fixed-bottom" style="background-color: #DDDDDD">
      		<div class="container">
      			<br />
        		<p class="pull-right"><a href="#"> Retour en haut </a></p>
        		<p>&copy; 2015 Oxfam &middot; <a href="../confidentialites.php">Confidentialité</a> &middot; <a href="../conditions.php">Conditions d'utilisation</a></p>
        	</div>
      </footer>
      
      
    
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>