<?php
//load
include_once('fctglobales.php');
include_once('conn.php');
global $bdd;

$type = $_POST['type'];

if($type!="suppr"){
$cid = $_POST['cid'];
$lid =  $_POST['lid'];
$datedebut = $_POST['datedebut'];
$datefin = $_POST['datefin'];
$datedepart=$_POST['datedepart'];
$loyer = $_POST['loyer'];
$provision = $_POST['provision'];
  //on déduit le sid dans la table logement
  $req = $bdd->query('select sid from logement where lid='.$lid );
  $sid = $req->fetch();
  $sid=$sid[0];
}

if($type=="new")
{

  $requete = $bdd->prepare("INSERT INTO `contrat` SET `cid` = :cid, `lid` = :lid, `sid` = :sid, `datedebut` = :datedebut, `datefin` = :datefin, `datedepart` = :datedepart, `cloyer` = :loyer, `cprov` = :provision, `datemodif` = now() ");
   $donnees=array('cid'=>$cid, 'lid'=>$lid, 'sid'=>$sid, 'datedebut'=>$datedebut, 'datefin'=>$datefin, 'datedepart'=>$datedepart, 'loyer'=>$loyer, 'provision'=>$provision);
}

if($type=="modif")
{
   $cnid = $_POST['cnid'];
   $requete = $bdd->prepare("UPDATE `contrat` SET `cid` = :cid, `lid` = :lid, `sid` = :sid, `datedebut` = :datedebut, `datefin` = :datefin, `datedepart` = :datedepart, `cloyer` = :loyer, `cprov` = :provision, `datemodif` = now() WHERE `cnid` = :cnid");
   $donnees=array('cid'=>$cid, 'lid'=>$lid, 'sid'=>$sid, 'datedebut'=>$datedebut, 'datefin'=>$datefin, 'datedepart'=>$datedepart, 'cnid'=>$cnid, 'loyer'=>$loyer, 'provision'=>$provision);
// var_dump($donnees);
}

if($type=="suppr")
{
  $cnid = $_POST['cnid'];
  $cid = $_POST['cid'];
  $requete = $bdd->prepare("DELETE FROM `contrat` WHERE `cnid` = :cnid");
  $donnees=array('cnid'=>$cnid);
}


//execution de la requete et rapport d'erreur


if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
}


if($type=="modif")
{
  include_once('../vue/head.php');
  pagemessage('success','Modification du contrat','Le contrat à été modifié','../contrat.php?action=modif&cnid='.$cnid);
}

if($type=="new")
{
$lastcnid=$bdd->query("select MAX(cnid) from contrat");
$cnid=$lastcnid->fetch();
  include_once('../vue/head.php');
  pagemessage('success','Création du contrat','Le contrat à été créé','../contrat.php?action=modif&cnid='.$cnid[0]);
}

if($type=="suppr")
{
  include_once('../vue/head.php');
  pagemessage('success','Supression du contrat','Le contrat à été supprimé','../client.php?action=afficher&cid='.$cid);
}

include_once('scripts.php');
