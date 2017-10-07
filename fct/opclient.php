<?php
//connexion à la bdd
include_once('conn.php');
include_once('fctglobales.php');
include_once('../vue/head.php');

if($_POST['type']=="modif")
{
  $requete = $bdd->prepare("UPDATE `client` SET
                                                `cnom` = :nom,
                                                `ctel` = :tel,

                                                `cmail` = :mail,

                                                `garnom` = :garnom,
                                                `gartel` = :gartel,

                                                `garmail` = :garmail,
                                                `garadr` = :garadr,
                                                `garcp` = :garcp,
                                                `garville` = :garville,
                                                `cdatemodif` = now() WHERE `cid` = :cid");

  $donnees=array('nom'=>$_POST['nom'],
                'tel'=>$_POST['tel'],
                'mail'=>$_POST['mail'],


                'cid'=>$_POST['cid'],
                'garnom'=>$_POST['garnom'],
                'gartel'=>$_POST['gartel'],

                'garmail'=>$_POST['garmail'],
                'garadr'=>$_POST['garadr'],
                'garcp'=>$_POST['garcp'],
                'garville'=>$_POST['garville']
              );
}
elseif ($_POST['type']=="new")
{
  $requete = $bdd->prepare("INSERT INTO `client` SET
                                                    `cnom` = :nom,
                                                    `ctel` = :tel,

                                                    `cmail` = :mail,

                                                    `garnom` = :garnom,
                                                    `gartel` = :gartel,

                                                    `garmail` = :garmail,
                                                    `garadr` = :garadr,
                                                    `garcp` = :garcp,
                                                    `garville` = :garville,
                                                    `cdatemodif` = now() "
                                                  );
  $donnees = array('nom'=>$_POST['nom'],
                    'tel'=>$_POST['tel'],
                    'mail'=>$_POST['mail'],


                    'garnom'=>$_POST['garnom'],
                    'gartel'=>$_POST['gartel'],

                    'garmail'=>$_POST['garmail'],
                    'garadr'=>$_POST['garadr'],
                    'garcp'=>$_POST['garcp'],
                    'garville'=>$_POST['garville']
                  );
}
elseif ($_POST['type']=="suppr")
{
  $cid=$_POST['cid'];
  $cid=intval($cid);


  $requete = $bdd->prepare("DELETE FROM `client` WHERE `cid`= :cid");
  $donnees = array('cid'=>$cid);
  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
  }ELSE
  {
    ?>
    <div class="row">
      <div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
        <div class="panel panel-warning">
          <div class="panel-heading">
            <h3 class="panel-title">Supression</h3>
          </div>
          <div class="panel-body">
            <p>client supprimé</p>
            <p><a class="btn btn-default btn-lg" href="../index.php">retour</a></p>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
}


//execution de la requete et rapport d'erreur


if (!$requete->execute($donnees)) {
  echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
}


if($_POST['type']=="modif")
{
  ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">Modification client</h3>
        </div>
        <div class="panel-body">
          <p>Client modifié avec succès</p>
          <p><a class="btn btn-default btn-lg" href="../client.php?action=afficher&cid=<?php echo $_POST['cid']; ?>">retour</a></p>
        </div>
      </div>
    </div>
  </div>
  <?php
}
if($_POST['type']=="new")
{
  $lastcid=$bdd->query("select MAX(cid) from client");
  $cid=$lastcid->fetch();
  $cid=$cid[0];
  ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">Création client</h3>
        </div>
        <div class="panel-body">
          <p>Client crée avec succès !</p>
          <p><a class="btn btn-default btn-lg" href="../client.php?action=afficher&cid=<?php echo $cid; ?>">fiche client</a></p>
        </div>
      </div>
    </div>
  </div>
  <?php
}

include_once('./scripts.php');
