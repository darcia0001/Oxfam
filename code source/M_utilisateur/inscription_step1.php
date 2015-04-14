<?php session_start();  
require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
 if (isset($_SESSION['utilisateur'])){
	 $user =  unserialize($_SESSION['utilisateur']);
	   if (($user->getProfil())!='administrateur')
     		header("Location: .." );
}

if (isset($_REQUEST['email']))// 
		$_SESSION['email']=$_REQUEST['email'];

if ((isset($_REQUEST['code'])) && (isset($_SESSION['code']))){
	if ($_REQUEST['code']==$_SESSION['code'] ) // Si la correspondance est vérifié on va à l'étape 2 du scénario de pré-inscription
		die("<meta http-equiv='refresh' content=0;URL='inscription_step2.php'>");
}

$manageur=ManageurUtilisateur::getInstance();
if(isset($_SESSION["email"]))
$user=$manageur->getUtilisateur($_SESSION["email"]);
//echo var_dump($user);
?>
<!DOCTYPE html>
<html lang="fr">

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
						if (isset($_REQUEST['code']))//si renseigne le code
							echo "";
						else
						if (!isset($_REQUEST['email'])){
	                    echo '
                        <div class="panel-body">
                            <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input name="email"  type="email" class="form-control" placeholder="Entrer une adresse email pour commencer" required="">
                                        </div>
                                        <br />
                                        <div class="form-group" align="center" >
		                                        <button type="submit" class="btn btn-lg btn-success"  ><i class="fa fa-check"></i> Envoyer</button>
                                        </div>
                                    </form>
                        </div>
                        ';}else 
                        if (isset($user)){	
                        	if ($user!=null){
			                    echo '
			                    <div class=" alert-danger alert-dismissable" align="center">Cet adresse email est deja utilise pour un autre compte ! </div>
		                        <div class="panel-body">
		                            <form role="form" action="" method="post">
		                                        <div class="form-group">
		                                            <label> Email </label>
		                                            <input name="email"  type="email" class="form-control" placeholder="Entrer une adresse email pour commencer" required="">
		                                        </div>
		                                        <br />
		                                        <div class="form-group" align="center" >
				                                        <button type="submit" class="btn btn-lg btn-success"  ><i class="fa fa-check"></i> Envoyer</button>
		                                        </div>
		                                    </form>
		                        </div>';}}
								else {
								// Si le champ email est renseigne, on envoie par email le code validation
								$_SESSION['email']=$_POST['email'];
								$_SESSION['code']=1000 + mt_rand(0, 8999);
								require '../assets/PHPMailer/PHPMailerAutoload.php';
								$mail = new PHPMailer;
								$mail->isSMTP();
								$mail->Host = 'smtp.modev-auf.org';
								$mail->SMTPAuth = true;
								$mail->Username = 'admin@modev-auf.org';
								$mail->Password = '@EQDcRZ9';
								$mail->SMTPSecure = 'tls';
								$mail->From = 'admin@modev-auf.org';
								$mail->FromName = 'L\'equipe de MoDev-AUF';
								$mail->addAddress($_POST['email'], 'Utilisateur');
								$mail->addReplyTo('admin@modev-auf.org', 'L\'equipe de MoDev-AUF');
								$mail->WordWrap = 50;
								$mail->isHTML(true);	
								$mail->Subject = 'Validation Email';
								$mail->Body    = 'Bonjour ! Voici votre code de validation <b>'.$_SESSION['code']."</b>";
								if(!$mail->send()) {
								   // echo " <p class='centered' style='color: red; font-size : 1.5em'>Message could not be sent ! ".$mail->ErrorInfo."</p>";
								   echo "
								   		<p align='center' style='font-size : 1.5em'>  Le service est temporairement indisponible. Merci de revenir dans un instant. <br/> <a href='index.php'> Retourner à l'accueil </a> </p>
								   		";
								   exit;
								}
							}
					// On attend la saisie du code de validation
					 if (isset($_SESSION['email']))	
					if (!(isset($_POST['code'])) && (isset($_POST['email']))&&($user==null)){
						echo '
							<div class="panel-body">
                            <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <label> Code de validation </label>
                                            <input name="code" type="number" class="form-control" placeholder="Entrer le code de validation que vous venez de recevoir par email" required="">
                                        </div>
                                        <br />
                                        <div class="form-group" align="center" >
		                                        <button type="submit" class="btn btn-lg btn-success"  ><i class="fa fa-check"></i> Envoyer</button>
                                        </div>
                                    </form>
                        </div>
                        ';}
						// Si le code est saisi on vérifie s'il correspond à celui présent dans la session
						if ((isset($_POST['code'])) && (isset($_SESSION['code']))){
							if ($_POST['code']==$_SESSION['code'] )
									// Si la correspondance est vérifié on va à l'étape 1 du scénario de pré-inscription
									die("<meta http-equiv='refresh' content=0;URL='register_2.php'>");
								else{
									// Si la correspondance n'est pas vérifiée on affiche un  message d'erreur et on redemannde la saisie du code valide
									echo '
									<div class=" alert-danger alert-dismissable" align="center">Le code entré n\'est pas valide ! Veuillez consulter votre email SVP. Merci. </div>
									<div class="panel-body">
			                            <form role="form" action="" method="post">
                                        <div class="form-group">
                                            <label> Code de validation </label>
                                            <input name="code" type="number" class="form-control" placeholder="Entrer le code de validation que vous venez de recevoir par email" required="">
                                        </div>
                                        <br />
                                        <div class="form-group" align="center" >
		                                        <button type="submit" class="btn btn-lg btn-success"  ><i class="fa fa-check"></i> Envoyer</button>
                                        </div>
                                    </form>
			                        </div>';
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