
<?php
//load
include_once 'fct/load.php';
include_once 'vue/head.php';
include_once 'vue/navbar.php';

    if($_GET['action']=="new")
    {
			$action="new";
			$cid=$_GET['cid'];
			$loc=$client::donneesclient($_GET['cid']);
			$datedebut = "";
			$datefin = "";
      $datedepart="";
      $loyer = "000";
      $provision = "00";
			include_once 'vue/contrat.php';

    }
  if($_GET['action']=="modif"){
		$cnid=$_GET['cnid'];

		$action="modif";
		$con=$contrat::donneescontrat($cnid);
		$loc=$client::donneesclient($con['cid']);
		$log=$logement::donneeslogement($con['lid']);
		$datedebut = $con['datedebut'];
		$datefin = $con['datefin'];
    $datedepart=$con['datedepart'];
    $lignesquittances = $quittance->liste_quittances('cnid',$cnid);
		$cid=$con['cid'];
    $loyer = $con['cloyer'];
    $provision = $con['cprov'];
    $boutonsuppr = $quittance->dernierequittancecontrat($cnid); //retourne false si 0 quittance
		//vue contrat
		include_once 'vue/contrat.php' ;
	}

  if($_GET['action']=="suppr"){
    $cnid=$_GET['cnid'];
    $cid=$_GET['cid'];
    include_once 'vue/suppr/supprcontrat.php';
  }


  include_once 'fct/scripts.php';
