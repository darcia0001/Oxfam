<?php
//chargeons la classes de la base des donnees
require('../Classes/Manageur/Manageur2.php');
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
	if (($user->getProfil()=='agentoxfam')&&($user->getGroupeUtilisateur()!="administrateur")){//si c est un agent oxfam non administrateur on le redirige
	 header("Location: ../accueil.php");exit();
	}
	
}
// --------------------------------------------------------------------------------
	

	$bdd = Manageur2::getInstance();
 //on teste d'abord si tous les champs ont ete saisis
 if (isset($_POST['codeMois']) and isset($_POST['libelleMois']) ){
 	$codeMois = $_POST['codeMois'];
 	$libelleMois = $_POST['libelleMois'];
 }
 else
 	echo "verifier que vous avez remplis tous les champs";
 if (isset($_POST['libelleElementPlanMensuel']) and isset($_POST['montantElementPlanMensuel'])){
 	$libelleElementPlanMensuel = $_POST['libelleElementPlanMensuel'];
 	$montantElementPlanMensuel = $_POST['montantElementPlanMensuel'];
 }
 echo "verifier que vous tous les champs ont ete bien saisis<br/>";

 if (isset($_POST['libelleLigneBudget']) and isset($_POST['montantPrevuLigneBudget'])){
 	$libelleLigneBudget = $_POST['libelleLigneBudget'];
 	$montantPrevuLigneBudget = $_POST['montantPrevuLigneBudget'];
 	$mntExec = $_POST['montantExecuteLigneBudget'];
 }
 else
 	echo "verifier que vous tous les champs ont ete bien saisis<br/>";

 echo "<strong> code Mois </strong>: ".$codeMois." <strong>libelle mois</strong>: ".$libelleMois."<br/>
 	   <strong>lib elmt plan mensuel</strong>: ".$libelleElementPlanMensuel.
 	   "<br/><strong>montant</strong> : ".$montantElementPlanMensuel."<br/>
 	   <br/><strong>lib ligne budget:</strong> ".$libelleLigneBudget.
 	   "<br/><strong> mont prev:</strong> ".$montantPrevuLigneBudget.
 	   "<br/> <strong>montant exec</strong>: ".$mntExec;

 	   	$mois = new Mois($codeMois, $libelleMois);
 	   	$epm = new ElementPlanMensuel($codeMois, $libelleElementPlanMensuel, $montantElementPlanMensuel);
 	   	$lbd = new LigneBudget($libelleLigneBudget, $montantPrevuLigneBudget, $mntExec);

 	   	echo "<br/> <strong>ajout mois</strong><br/>";
 		$bdd->addMois($mois);
 		
 		echo "<br/><strong>ajout elmnt plan mensuel</strong><br/>";
 		$bdd->addEltPlanMensuel($epm);
 		
 		echo "<br><strong>ajout ligne budgetaire </strong><br/>";
 		$bdd->addLigneBudget($lbd);

 		echo "<br/><strong>tout fait <strong> <br/>";
 //echo "here";
?>
<p> <a href = "formOpenPlanMensuel.php"/> Nouvel formulaire </p>  