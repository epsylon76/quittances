
<?php
	//le chargeur principal
	include_once('./fct/load.php');

  //quelle est la periode ? s'il n'y en a pas, on prends celle du moment

if(!isset($_GET['annee']))
{
  $annee = date("Y");
}
else {
  intval($_GET['annee']);
  $annee = $_GET['annee'];
}

if(!isset($_GET['mois']))
{
  $mois = date("m");
}
else {
  intval($_GET['mois']);
  $mois = $_GET['mois'];
}

// on fait une liste des contrats commençant pdt cette periode

$liste_debut = $contrat->listecontratsdebut($mois,$annee);
$liste_fin = $contrat->listecontratsfin($mois,$annee);
//le mois précédent
$mois_prec=$mois-1;
$annee_prec=$annee;
if($mois_prec==0){$mois_prec=12;$annee_prec=$annee-1;}
$liste_debut_prec = $contrat->listecontratsdebut($mois_prec,$annee_prec);
$liste_fin_prec = $contrat->listecontratsfin($mois,$annee_prec);

$totalentrees_prec=0;
$totalsorties_prec=0;
if($liste_debut_prec)
{
	foreach($liste_debut_prec as $ligne_prec)
	{
		$totalentrees_prec=$totalentrees_prec+$ligne_prec['cprov']+$ligne_prec['cloyer'];
	}
}
if($liste_fin_prec)
{
	foreach($liste_fin_prec as $ligne_prec)
	{
		$totalsorties_prec=$totalsorties_prec+$ligne_prec['cprov']+$ligne_prec['cloyer'];
	}
}
//si la liste est vide on obtient false


include_once 'vue/head.php';
include_once 'vue/navbar.php';
include_once 'vue/mouvements.php';
