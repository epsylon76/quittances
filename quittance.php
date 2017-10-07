<?php
//load
include_once('./fct/load.php');

//il faut içi gérer les différents mode d'arrivée grmblblbl
//si on est en mode affichage d'une quittance existance
if($_GET['action']=="modif")
{
	$qid=$_GET['qid'];
	$donneesquittance=$quittance->aff_quittance($qid);
	$cnid=$donneesquittance['cnid'];
	//on prend les données du contrat
	$donneescontrat = $contrat->donneescontrat($cnid);
	$lid=$donneescontrat['lid'];
	$sid=$donneescontrat['sid'];
	$cid=$donneescontrat['cid'];
	$donneesquittance=$quittance->aff_quittance($qid);
	$mois=mois($donneesquittance['qdate']);
	$annee=annee($donneesquittance['qdate']);
	$datepaiement=$donneesquittance['datepaiement'];
	$listesoc = $societe->selectsociete($qid);
	$donneessociete = $societe->donneessociete($donneesquittance['sid']);
	$donneesclient = $client->donneesclient($donneesquittance['cid']);
	$donneeslogement = $logement->donneeslogement($donneesquittance['lid']);
	$loyer=$donneesquittance['qloyer'];
	$provision=$donneesquittance['qprov'];
	$moyenpaiement=$donneesquittance['moyenpaiement'];
	$titre="Quittance n°".$_GET['qid']."de ";
	$dateedition=$donneesquittance['dateedition'];
	//la on affiche la vue
	include_once('./vue/quittance.php');
}

if($_GET['action']=="new") //on arrive pour une nouvelle quittance alors on prend l'id du contrat
{

	$type="new"; //pour communiquer sur l'etat
	$cnid=$_GET['cnid']; //de quel contrat on parle
	$annee=$_GET['annee']; //pour quelle année
	//on prend les données du contrat
	$donneescontrat = $contrat->donneescontrat($cnid);
	$lid=$donneescontrat['lid'];
	$sid=$donneescontrat['sid'];
	$cid=$donneescontrat['cid'];
	$dateedition=date('Y-m-d');
	//on prend les données du client
	$donneesclient = $client->donneesclient($cid);
	//le logement auquel il est lié
	$donneeslogement = $logement->donneeslogement($lid);
	//y a t-il eu une quittance précédente sur ce contrat, si oui on va reprendre des données
	$last=$quittance->dernierequittancecontrat($cnid);
	if($last)
	{
		$donneeslastq=$quittance->aff_quittance($last);
		$moyenpaiement=$donneeslastq['moyenpaiement'];
	}
	else
	{
		$moyenpaiement="2";
	}

	$loyer=$donneescontrat['cloyer'];
	$provision=$donneescontrat['cprov'];
	$date=new DateTime(null,new DateTimeZone('Europe/Paris'));
	$str=$date->format("m");
	$mois['nomois'] = ltrim($str, '0');
	$datepaiement=date('Y-m-d');
	$listesoc = $societe->selectsociete($sid);
	$donneessociete = $societe->donneessociete($sid);
	$donneesclient = $client->donneesclient($cid);
	$donneeslogement = $logement->donneeslogement($lid);
	$donneesquittance['qnote']="";
	$action="new";
	//la on affiche la vue
	include_once('./vue/quittance.php');

}

if($_GET['action']=="suppr"){
	$cnid=$_GET['cnid'];
	$qid=$_GET['qid'];
	include_once('./vue/suppr/supprquittance.php');
}



if($_GET['action']=="vuepdf")
{
	$qid=$_GET['qid'];
	$donneesquittance=$quittance->aff_quittance($qid);
	$cnid=$donneesquittance['cnid'];
	//on prend les données du contrat
	$donneescontrat = $contrat->donneescontrat($cnid);
	$lid=$donneescontrat['lid'];
	$sid=$donneescontrat['sid'];
	$cid=$donneescontrat['cid'];
	$donneesquittance=$quittance->aff_quittance($qid);
	$mois=mois($donneesquittance['qdate']);
	$annee=annee($donneesquittance['qdate']);
	$datepaiement=$donneesquittance['datepaiement'];
	$listesoc = $societe->selectsociete($qid);
	$donneessociete = $societe->donneessociete($donneesquittance['sid']);
	$donneesclient = $client->donneesclient($donneesquittance['cid']);
	$donneeslogement = $logement->donneeslogement($donneesquittance['lid']);
	if(isset($_GET['pdf']) && $_GET['pdf']=="envoipdf"){
		$email=$_GET['email'];
		$message=$_GET['message'];
	}
	//la on affiche la vue
	include_once('./vue/quittancepdf.php');
}


include_once('./fct/scripts.php');
