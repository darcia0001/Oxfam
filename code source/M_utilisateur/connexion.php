<?php 
session_start();
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
$manageur=ManageurUtilisateur::getInstance();//gerer les objets utilisateur
 if (isset($_SESSION['utilisateur'])){//s il ya un utilisateur connecte on fait  une redirection
	 $user =  unserialize($_SESSION['utilisateur']);
     header('Location:..');
     exit();
  }
?>
<!DOCTYPE html>
<html>
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
</head>
<body>
    <div class="loginform col_12">
        <div class="col_12  bgvert minh200">
            <div class="col_6">
                <img src="../assets/img/logo.png" />
            </div>
            <div class="col_6">
            <?php
            	if (!isset($_REQUEST['email'])) //On est dans la page de connexion et pas encor connecte
                 {
                 echo '
                <form>
                <input name="email" class="col_12" type="text" placeholder="login" required=""/>
                <input name="password" class="col_12" type="password" placeholder="mot de passe" required="" />
                <br />
                <button class="small red pill fright  icon-circle-arrow-right" type="submit">
                    Connexion</button>
                </form>
				';
               } 
               //sinon traitemen du demande de connexion
               else
               {
               	if (!empty($_REQUEST['email']) && !empty($_REQUEST['password']) ) //Oublie d'un champ
               	{
               		$user=$manageur->getUtilisateur($_REQUEST['email']);
               		if ($user != NULL) {
               			$mdpentre=$_REQUEST['password'];
               			if (($user->getPassword()  == sha1($mdpentre))){//etat active
               				$_SESSION['utilisateur'] = serialize($user);
               				header('Location:..');
               				//die("<meta http-equiv='refresh' content=0;URL=".$user->getProfil().">");
               			}
               			else{//erreur 
               				//on doit refaire le log
               				echo '
			                <form>
			                <input name="email" class="col_12" type="text" placeholder="login" required=""/>
			                <input name="password" class="col_12" type="password" placeholder="mot de passe" required="" />
			                <br />
			                <button class="small red pill fright  icon-circle-arrow-right" type="submit">
			                    Connexion</button>
			                </form>
							';
               				if ($user->getPassword()  != sha1($mdpentre))//erreur mot de passe
               					echo "<div class='alert alert-danger alert-dismissable col-md-6 col-md-offset-3' align='center'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                Le mot de passe entré n'est pas correct. Veuillez essayer encore.
                            	</div>";
               		 		if (0)//($user->getetat()  == 'nouveau')
               		 		echo "<div class='alert alert-danger alert-dismissable col-md-6 col-md-offset-3' align='center'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	                		Votre compte n'est pas encore activé par un administrateur. Veuillez patienter le tant q'un administrateur l'approve. Merci.
	            			</div>";
               		 		if (0)//$user->getetat()  == 'bloque')
               		 		echo "<div class='alert alert-danger alert-dismissable col-md-6 col-md-offset-3' align='center'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	                		Votre compte a été bloqué. Veuillez contacter votre admisitrateur. Merci.
	            			</div>";
               		 
               		}
               	}//if user ! null
               	else{
               			echo '
			                <form>
			                <input name="email" class="col_12" type="text" placeholder="login" required=""/>
			                <input name="password" class="col_12" type="password" placeholder="mot de passe" required="" />
			                <br />
			                <button class="small red pill fright  icon-circle-arrow-right" type="submit">
			                    Connexion</button>
			                </form>
							';
               			echo "<div class='alert alert-danger alert-dismissable col-md-6 col-md-offset-3' align='center'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                Cet utilisateur n'exite pas. Si vous n'avez pas encore de compte, <a href='register_1.php'>inscrivez-vous ici.</a>
                            </div>";
               	}
                
               	}
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
		<hr / class="ligne_rouge">
</footer>
</body>
</html>
