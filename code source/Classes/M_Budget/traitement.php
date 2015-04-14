<?php

	//chargeons la classes de la base des donnees
 	require('../Manageur/Manageur2.php');

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

 echo "codeM: ".$codeMois." libelleMois: ".$libelleMois."<br/>
 	   lib elmt plan mens: ".$libelleElementPlanMensuel." mont : ".$montantElementPlanMensuel."<br/>
 	   lib ligne budget: ".$libelleLigneBudget." mont prev: ".$montantPrevuLigneBudget." mnt exec: ".$mntExec;

 	   	$mois = new Mois($codeMois, $libelleMois);
 	   	$epm = new ElementPlanMensuel($codeMois, $libelleElementPlanMensuel, $montantElementPlanMensuel);
 	   	$lbd = new LigneBudget($libelleLigneBudget, $montantPrevuLigneBudget, $mntExec);

 	   	echo "ajout mois<br/>";
 		$bdd->addMois($mois);
 		
 		echo "ajout elmnt plan mensuel<br/>";
 		$bdd->addEltPlanMensuel($epm);
 		
 		echo "ajout ligne budgetaire <br/>";
 		$bdd->addLigneBudget($lbd);

 		echo "tout fait <br/>";
 //echo "here";
?>
