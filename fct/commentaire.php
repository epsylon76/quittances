<?php
include_once('conn.php');

global $bdd;

if(isset($_GET['cid']))
{
  $cid=$_GET['cid'];

  $requete = $bdd->prepare("UPDATE `client` SET
                                                `observations` = :obsv,
                                                `cdatemodif` = now() WHERE `cid` = :cid");

  $donnees=array('obsv'=>$_GET['observation'],
                  'cid'=>$cid);
  $requete->execute($donnees);

  header("location:../client.php?action=afficher&cid=".$cid);
}
