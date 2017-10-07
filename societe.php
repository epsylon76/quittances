<?php

//load
include_once('./fct/load.php');


if(!isset($_GET['action']))
{header('location:societe.php?action=liste');}

if(isset($_GET['action']) && $_GET['action']=="liste") //action en cours
{
  $listesocietes=$societe->liste_societes(0);
  include_once("./vue/listesocietes.php");
}

if($_GET['action']=="new")
{
  $snom="";
  $sadresse="";
  $scp="";
  $sville="";
  $stel="";
  $semail="";
  $urltampon="#";
  include_once('./vue/societe.php');
}

if($_GET['action']=="modif")
{
  $soc=$societe->donneessociete($_GET['sid']);
  $snom=$soc['snom'];
  $sadresse=$soc['sadresse'];
  $scp=$soc['scp'];
  $sville=$soc['sville'];
  $stel=$soc['stel'];
  $semail=$soc['semail'];
  $urltampon=$soc['urltampon'];
  $sid=$soc['sid'];
  include_once('./vue/societe.php');
}

if($_GET['action']=="suppr")
 {
   $sid=$_GET['sid'];
   include_once('./vue/suppr/supprsociete.php');
 }

include_once('./fct/scripts.php');
