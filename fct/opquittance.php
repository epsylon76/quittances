<?php

//load
include_once('conn.php');
include_once('fctglobales.php');


//on arrive pour quelle operation ?

$type=$_POST['type'];

if($type=="modif"|| $type=="suppr"){
  $qid=$_POST['qid'];
  $cnid=$_POST['cnid'];
}

if($type=="new")
{
  $cnid=$_POST['cnid'];
  $cid=$_POST['cid'];
  $sid=$_POST['sid'];
  $lid=$_POST['lid'];
  $mois=$_POST['mois'];
  $annee=$_POST['annee'];
  $qdate=$annee.'-'.$mois.'-01';
  $dateedition=$_POST['dateedition'];
  $qid='';
}

if($type=="new" || $type=="modif")
{
  $loyer=$_POST['loyer'];
  $provision=$_POST['provision'];
  $moyenpaiement=$_POST['moyenpaiement'];
  $datepaiement=$_POST['datepaiement'];
  $dateedition=$_POST['dateedition'];
  $note=$_POST['qnote'];
}



if($type=="new")
{
  //on vérifie d'abord si la q n'existe pas déjà pour le mois et l'année demandée pour le contrat en question
  $req= 'select qid from quittance where cnid='.$cnid.' and YEAR(qdate)='.$annee.' AND MONTH(qdate)='.$mois;
  $req = $bdd->query($req);
  $req = $req->fetch();
  $qid=$req[0];
  if($req[0])
  {
    pagemessage('danger','Impossible','Cette Quittance existe déjà','../quittance.php?action=modif&qid='.$qid);
  }
  ELSE //on peut effectuer l'operation
  {


    $requete = $bdd->prepare("INSERT INTO `quittance` SET `cid` = :cid,
      `sid` = :sid,
      `lid` = :lid,
      `cnid` = :cnid,
      `qdate` = :qdate,
      `qloyer` = :qloyer,
      `qprov` = :qprov,
      `moyenpaiement` = :moyenpaiement,
      `datepaiement` = :datepaiement,
      `dateedition` = :dateedition,
      `qnote` = :qnote"
    );

    $donnees = array('cid'=>$cid,
    'sid'=>$sid,
    'lid'=>$lid,
    'cnid'=>$cnid,
    'qdate'=>$qdate,
    'qloyer'=>$loyer,
    'qprov'=>$provision,
    'moyenpaiement'=>$moyenpaiement,
    'datepaiement'=>$datepaiement,
    'dateedition' =>$dateedition,
    'qnote' => $note
  );

  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
  }ELSE
  {

    $lastqid=$bdd->query("select MAX(qid) from quittance");
    $qid=$lastqid->fetch();
    $qid=$qid[0];

    pagemessage('success','Création de la quittance','Quittance crée avec succès','../quittance.php?action=modif&qid='.$qid);
  }

}
}



if($type=="modif")
{
  $requete = $bdd->prepare("UPDATE `quittance`
    SET `qloyer` = :qloyer,
    `qprov` = :qprov,
    `moyenpaiement` = :moyenpaiement,
    `datepaiement` = :datepaiement,
    `dateedition` = :dateedition,
    `qnote` = :qnote
    WHERE `qid`= :qid");

    $donnees = array('qid'=>$qid,
    'qloyer'=>$loyer,
    'qprov'=>$provision,
    'moyenpaiement'=>$moyenpaiement,
    'datepaiement'=>$datepaiement,
    'dateedition' =>$dateedition,
    'qnote' => $note
  );

  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
  }ELSE
  {

    pagemessage('success','Modification de la quittance','La quittance à été modifiée','../quittance.php?action=modif&qid='.$qid);
  }
}


if($type=="suppr")
{
  $qid=$_POST['qid'];


  $requete = $bdd->prepare("DELETE FROM `quittance` WHERE `qid`= :qid");
  $donnees = array('qid'=>$qid);
  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
  }ELSE
  {
    pagemessage('success','Supression de la quittance','La quittance à été suppriméee','../contrat.php?action=modif&cnid='.$cnid);
  }
}

include_once('./scripts.php');
