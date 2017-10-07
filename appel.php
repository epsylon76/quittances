<?php
//load
include_once 'fct/load.php';
//s'il y a eu un formulaire de posté par la vue appel .php on appelle et on formate les donnéees pour le pdf
if(!isset($_POST['cnid'])){
	$cnid=$_GET['cnid'];
	$donneescontrat = $contrat->donneescontrat($cnid);
	$lid=$donneescontrat['lid'];
	$sid=$donneescontrat['sid'];
	$cid=$donneescontrat['cid'];
	$donneessociete = $societe->donneessociete($donneescontrat['sid']);
	$donneesclient = $client->donneesclient($donneescontrat['cid']);
	$donneeslogement = $logement->donneeslogement($donneescontrat['lid']);
	$loyer=$donneescontrat['cloyer'];
	$provision=$donneescontrat['cprov'];

	include_once 'vue/head.php';
	include_once 'vue/navbar.php';
	include_once 'vue/appel.php';
	include_once 'fct/scripts.php';
}else {
	$cnid=$_POST['cnid'];
	$donneescontrat = $contrat->donneescontrat($cnid);
	$donneessociete = $societe->donneessociete($donneescontrat['sid']);
	$donneesclient = $client->donneesclient($donneescontrat['cid']);
	$donneeslogement = $logement->donneeslogement($donneescontrat['lid']);
	$loyer=$_POST['loyer'];
	$provision=$_POST['provision'];
	$mois['nommois']=mois_from_no($_POST['mois']);
	$annee=$_POST['annee'];
	$email=$_POST['email'];
	$message=$_POST['message'];

	include_once('./vue/appelpdf.php');
}
