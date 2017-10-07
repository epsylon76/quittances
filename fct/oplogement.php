<?php
//load
include_once('fctglobales.php');
include_once('conn.php');

$type=$_POST['type'];

if($type=="new" || $type=="modif")
  {
    $ldesc=$_POST['ldesc'];
    $ladresse=$_POST['ladresse'];
    $lcp=$_POST['lcp'];
    $lville=$_POST['lville'];
    $sid=$_POST['sid'];
    $lloyer=$_POST['lloyer'];
    $lprov=$_POST['lprov'];
    $ltype=$_POST['ltype'];
    $letage=$_POST['letage'];
  }

if($type=="modif")
{
  $lid=$_POST['lid'];
}


//-----------------------
//AJOUT
//---------------------------


if($type=="new")
{
  $lid="";
  $requete = $bdd->prepare("INSERT INTO `logement` SET
                                                        `lid` = :lid,
                                                        `sid` = :sid,
                                                        `ldesc` = :ldesc,
                                                        `ladresse` = :ladresse,
                                                        `lcp` = :lcp,
                                                        `lville` = :lville,
                                                        `lloyer` = :lloyer,
                                                        `lprov` = :lprov,
                                                        `ltype` = :ltype,
                                                        `letage` = :letage"
                                                      );

  $donnees = array(
    'lid'=>$lid,
    'sid'=>$sid,
    'ldesc'=>$ldesc,
    'ladresse'=>$ladresse,
    'lcp'=>$lcp,
    'lville'=>$lville,
    'lloyer'=>$lloyer,
    'lprov'=>$lprov,
    'ltype' =>$ltype,
    'letage' =>$letage
  );

  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
  }ELSE
  {
      pagemessage('success','Création du logement','Le logement à été créé','../logements.php?action=liste');
  }
}


//--------------------
//MODIFICATION
//--------------------


if($type=="modif")
{
  $requete = $bdd->prepare("UPDATE `logement` SET
                                                        `lid` = :lid,
                                                        `sid` = :sid,
                                                        `ldesc` = :ldesc,
                                                        `ladresse` = :ladresse,
                                                        `lcp` = :lcp,
                                                        `lville` = :lville,
                                                        `lloyer` = :lloyer,
                                                        `lprov` = :lprov,
                                                        `ltype` = :ltype,
                                                        `letage` = :letage
                                                        WHERE `lid`=:lid"
                                                      );

  $donnees = array(
    'lid'=>$lid,
    'sid'=>$sid,
    'ldesc'=>$ldesc,
    'ladresse'=>$ladresse,
    'lcp'=>$lcp,
    'lville'=>$lville,
    'lloyer'=>$lloyer,
    'lprov'=>$lprov,
    'ltype' =>$ltype,
    'letage' =>$letage
  );

  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
  }ELSE
  {
    pagemessage('success','Modification du logement','Le logement à été modifié','../logements.php?action=modif&lid='.$lid);
  }
}


//
// SUPPRESSION
//

if($type=="suppr")
{
  $lid=$_POST['lid'];


  $requete = $bdd->prepare("DELETE FROM `logement` WHERE `lid`= :lid");
  $donnees = array('lid'=>$lid);
  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
  }ELSE
  {
    pagemessage('success','Supression du logement','Le logement à été supprimé','../logements.php?action=liste');
  }
}

include_once('../fct/scripts.php');
