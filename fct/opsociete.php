<?php
//connexion à la bdd

include_once('../fct/conn.php');
include_once('../fct/fctglobales.php');


$avertissement="";

if($_POST['type']=="modif")
{
  $sid=$_POST['sid'];

  if($_FILES['tampon']['size']>0)
  {
    echo "taille du fichier : ";
    echo $_FILES['tampon']['size'];
    echo " octets";
    include_once('upload.php');
  }

  //si l'url a été mise à jour, on passe le paramètre, sinon on garde l'ancien
  if(isset($nom))
  {
    echo $nom;
    $urltampon=substr($nom, 3);
  }
  else {
    $urltampon=$_POST['urltampon'];
  }

  $requete = $bdd->prepare("UPDATE `societe` SET `snom` = :snom,  `stel` = :stel, `semail` = :semail, `sadresse` = :sadresse, `scp` = :scp, `sville` = :sville, `sdatemodif` = now(), `urltampon`=:urltampon WHERE `sid`=:sid");
  $donnees = array( 'sid'=>$_POST['sid'],
  'snom'=>$_POST['snom'],

  'stel'=>$_POST['stel'],
  'semail'=>$_POST['semail'],
  'sadresse'=>$_POST['sadresse'],
  'scp'=>$_POST['scp'],
  'sville'=>$_POST['sville'],
  'urltampon'=>$urltampon

);

if (!$requete->execute($donnees)) {
  echo "Echec lors de l'exécution : (" . $requete->errorCode() . ") " . $requete->error;
}
ELSE
{

  pagemessage('success','Modification','Societé modifiée avec succès','../societe.php?action=modif&sid='.$sid);
}

}






if ($_POST['type']=="new")
{
  $sid = derniersid()[0];
  $sid = $sid+1;

  if($_FILES['tampon']['size']>0)
  {
    echo "taille du fichier : ";
    echo $_FILES['tampon']['size'];
    echo " octets";
    include_once('upload.php');
  }
  //si l'url a été mise à jour, on passe le paramètre, sinon on garde l'ancien
  if(isset($nom))
  {
    echo $nom;
    $urltampon=substr($nom, 3);
  }
  else {
    $urltampon=$_POST['urltampon'];
  }
  echo $urltampon;


  $requete = $bdd->prepare("INSERT INTO `societe` SET `snom` = :snom,  `stel` = :stel, `semail` = :semail, `sadresse` = :sadresse, `scp` = :scp, `sville` = :sville, `sdatemodif` = now(), `urltampon`=:urltampon ");
  $donnees = array('snom'=>$_POST['snom'],

  'stel'=>$_POST['stel'],
  'semail'=>$_POST['semail'],
  'sadresse'=>$_POST['sadresse'],
  'scp'=>$_POST['scp'],
  'sville'=>$_POST['sville'],
  'urltampon'=>$urltampon
);

if (!$requete->execute($donnees)) {
  echo "Echec lors de l'exécution : (" . $requete->errorCode() . ") " . $requete->error;
}
ELSE
{
  ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel <?php if($avertissement==""){echo "panel-success";}ELSE{echo "panel-warning";} ?>" style="margin-top:50px">
        <div class="panel-heading">
          <h3 class="panel-title">Opération</h3>
        </div>
        <div class="panel-body">
          <p>Opération effectuée</p>
          <p><?php echo $avertissement; ?></p>
          <p><a class="btn btn-default btn-lg" href="../societe.php?action=modif&sid=<?php echo $sid?>">retour</a></p>
        </div>
      </div>
    </div>
  </div>
  <?php
}

}



if($_POST['type']=="suppr")
{
  $sid=$_POST['sid'];
  $requete = $bdd->prepare("DELETE FROM `societe` WHERE `sid`= :sid");
  $donnees = array('sid'=>$sid);
  rrmdir('../assets/img/'.$sid);

  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errorCode() . ") " . $requete->error;
  }
  ELSE
  {
    ?>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-warning" style="margin-top:50px">
          <div class="panel-heading">
            <h3 class="panel-title">Société supprimée</h3>
          </div>
          <div class="panel-body">
            <p>Opération effectuée</p>
            <p><a class="btn btn-default btn-lg" href="../societe.php?action=liste">retour à la liste</a></p>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

}







include_once('../fct/scripts.php');
