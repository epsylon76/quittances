
<?php
//le chargeur principal
include_once('./fct/load.php');

//initialisation du programme

//si aucune société on envoie sur l'ecran d'ajout d'une société

if(empty($societe->liste_societes()))
{
  header('Location: societe.php?action=new');
}


//liste des contrats
if(!isset($_GET['sid'])){$sid=0;}ELSE{$sid=$_GET['sid'];}
$lignescontrat = $contrat->listecontratsmain();


//liste des quittances récentes
$lignesquittances = $quittance->liste_quittances("all",0);

include_once 'vue/head.php';

include_once('vue/navbar.php');
//la vue principale
include_once('vue/main.php');
//la vue main
include_once('fct/scripts.php');
//les scripts de fin de page
