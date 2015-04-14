<?php 
  // ---------------------------- gestion de la securité -------------------------
    session_start();
//s il y a un user  connecte on le deconnecte 
  if (isset($_SESSION['utilisateur'])){
  
    header('Location:  deconnexion.php');
    exit();
  }
 
// --------------------------------------------------------------------------------?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lost password</title>
<link href="../assets/style.css" rel="stylesheet">
</head>


<body>

<a href="connexion.php"><img class="retour" src="../assets/images/index.png"> Retour a l'authentification</a> <br>
<div class="contenucentre">
<?php if (isset($_REQUEST["email"])){
	require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
	$manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donnees

	// Si le champ email est renseigne, on envoie par email le code validation
	$_SESSION['email']=$_POST['email'];
	$_user=$manageur->getUtilisateur($_REQUEST["email"] );
	//echo var_dump($_user);
	if($_user==null){
		echo "<p align='center' style='font-size : 1.5em'>  L'email incorrecte . Merci de rentre un email valide. <br/> <a href='lostpassword.php'> Reessayer!! </a> </p>
								   		
		";
		
	}else{//le email est valide
	$mdp=$_user->getPassword();
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
	$mail->Subject = 'Rappel de votre mot de passe Email';
	$mail->Body    = 'Bonjour ! Voici votre mot de passe  <b>'.$mdp."</b>";
	if(!$mail->send()) {
		// echo " <p class='centered' style='color: red; font-size : 1.5em'>Message could not be sent ! ".$mail->ErrorInfo."</p>";
		echo "
								   		<p align='center' style='font-size : 1.5em'>  Le service est temporairement indisponible. Merci de revenir dans un instant. <br/> <a href='../accueil.php'> Retourner Ã  l'accueil </a> </p>
								   		";
		exit;
	}
	}//else le email est valide
	
}else{//pas de email doncc on l demande
	echo '
			
		Il semblerait que vous ayez oublier votre mot de passe. Veuillez soumettre votre adresse email pour une reinitialisation de votre compte.
		<form action="" method="POST">
		<table class="lostpassword" border="0">
		  <tr>
		    <td><img src="../assets/images/logo.png"></td>
		    <td><input type="text" name="email" value="">
		    	<input type="submit" name="" value="Soumettre"></td>
		  </tr>
		</table>
		</form>	
			
			';
}
?>


</div>
</body>
</html>
