<?php


//connexion à la bdd
include_once('./fct/conn.php');

include_once('./fct/fctglobales.php');
$_SESSION['mail_psw'] = get_mail_psw();

//modele societes
include_once('./fct/societe.php');
$societe = new societe();

//modele locataires
include_once('./fct/client.php');
$client = new client();

//modele quittances
include_once('./fct/quittance.php');
$quittance = new quittance();

 //modèle contrat
 include_once('./fct/contrat.php');
 $contrat = new contrat();

 //modèle logement
 include_once('./fct/logement.php');
 $logement = new logement();
