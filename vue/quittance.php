
<?php include_once('head.php'); ?>
<?php include_once('navbar.php'); ?>




<div class="row">
  <div class="container" style="border:2px solid black; <?php if($_GET['action']=="modif"){echo "background-color:rgba(0,50,0,0.1);"; } ?> ">


    <h2 class="text-center"><?php if($_GET['action']=="new"){echo "Nouvelle ";}?> Quittance de loyer</h2>



    <div class="col-md-4 col-sm-6" >
      <form action="./fct/opquittance.php" method="post">
        <input type="hidden" name="type" value="<?php echo $_GET['action'] ?>"/>
        <?php if($_GET['action']=="modif"){echo '<input type="hidden" name="qid" value="'.$qid.'"/>';} ?>
        <input type="hidden" name="cnid" value="<?php echo $cnid ?>"/>
        <input type="hidden" name="cid" value="<?php echo $cid ?>"/>
        <input type="hidden" name="sid" value="<?php echo $sid ?>"/>
        <input type="hidden" name="lid" value="<?php echo $lid ?>"/>

        <div class="form-group">
          <label for="client">Client</label>
          <input type="text" class="form-control" id="client" value="<?php echo $donneesclient['cnom']; ?>" disabled>
        </div>

        <div class="form-group">
          <label for="societe">Société</label>
          <input type="text" class="form-control" id="client" value="<?php echo $donneessociete['snom']; ?>" disabled>
        </div>

        <div class="form-group">
          <label for="logement">Logement</label>
          <input type="text" class="form-control" id="logement" value="<?php echo $donneeslogement['ldesc']; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="addrlogement">Adresse logement</label>
          <input type="text" class="form-control" id="addrlogement" value="<?php echo $donneeslogement['ladresse']; ?>"disabled >
        </div>


          <h5 style="font-weight:bold">Note</h5>
        <textarea style="width:50%; height:70px;" name="qnote"><?php echo $donneesquittance['qnote'] ?></textarea>



      </div>

      <div class="col-md-4 col-sm-6" >


        <div class="form-group">
          <label for="mois">Mois</label>
          <?php
          if($_GET['action']=="new"){
            select_mois($mois['nomois'],$annee,$cid);
          }
          elseif($_GET['action']=="modif")
          {

            ?>
            <input type="text" class="form-control" id="mois" value="<?php echo $mois['nommois'];?>" disabled ></input>
            <?php
          }
          ?>
        </div>


        <div class="form-group">
          <label for="annee">Année</label>
          <div class="input-group" style="width:50%">
            <input type="text" class="form-control" id="annee" value="<?php echo $annee; ?>" disabled />
            <input type="hidden" name="annee" value="<?php echo $annee; ?>">
            <?php if($_GET['action']=="new"){echo '<span class="input-group-btn"><a class="btn btn-secondary"  href="client.php?action=afficher&cid='.$cid.'" >changer</a></span>';} ?>
          </div>
        </div>

        <div class="form-group">
          <label for="loyer">Loyer</label>
          <input type="text" class="form-control" id="loyer" name="loyer" value="<?php echo $loyer; ?>">
        </div>

        <div class="form-group">
          <label for="provision">Provision</label>
          <input type="text" class="form-control" id="provision" name="provision" value="<?php echo $provision; ?>">
        </div>

      </div> <!--md-4-->

      <div class="col-md-4 col-sm-6" >

        <div class="form-group">
          <label for="datedebut">Date début</label>
          <input type="date" class="form-control" id="datedebut" name="datedebut"  value="<?php echo $datedebut ?>">
        </div>

        <div class="form-group">
          <label for="datefin">Date fin</label>
          <input type="date" class="form-control" id="datefin" name="datefin"  value="<?php echo $datefin ?>">
        </div>

        <div class="form-group">
          <label for="provision">Date d'édition</label>
          <input type="date" class="form-control" id="dateedition" name="dateedition"  value="<?php echo $dateedition ?>">
        </div>

        <div class="form-group">
          <label for="provision">Date de Paiement</label>
          <input type="date" class="form-control" id="datepaiement" name="datepaiement"  value="<?php echo $datepaiement ?>">
        </div>

        <div class="form-group">
          <label for="moyenpaiement">Moyen Paiement</label>
          <?php echo selectpaiement($moyenpaiement); ?>
        </div>

        <div class="form-group">
          <label for="tampon">Tampon société</label>
          <img src="<?php echo $donneessociete['urltampon']; ?>" class="img-responsive"/>
        </div>

      </div> <!--md-4-->

    </div> <!-- row -->



  </div>

</div>


<div class="row">
  <div class="container">
    <br>
    <!-- bloc de boutons en dessous de la quittance, en fonction de l'acion -->
    <?php if($_GET['action']=="new")
    {
      ?>
      <a href="client.php?action=afficher&cid=<?php echo $cid;?>" class="btn btn-default pull-right">retour</a>
      <button type="submit" class="btn btn-success pull-right">Nouvelle Quittance</button>

    </form>
    <?php
  }elseif($_GET['action']=="modif") {
    ?>

    <a href="quittance.php?action=suppr&qid=<?php echo $qid ?>&cnid=<?php echo $cnid ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Supprimer</a>
    <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Modifier</button>
    <a class="btn btn-primary pull-right" href="quittance.php?action=new&cnid=<?php echo $cnid?>&cid=<?php echo $cid?>&annee=<?php echo $annee?>"><i class="fa fa-plus"></i> Nouvelle quittance</a>
  </form>


  <form class="form-inline" action="quittance.php" method="get">
    <a class="btn btn-primary" href="quittance.php?action=vuepdf&pdf=vuepdf&qid=<?php echo $qid ?>"><i class="fa fa-eye"></i> Voir la quittance en PDF</a>

    <h4>Message corps email</h4>
    <textarea style="width:50%; height:70px;" name="message">Je vous prie de trouver çi joint la quittance demandée,
      cordialement
      Arnaud Binet</textarea>
    <br>


    <select class="form-control" id="envoyeremail" name="email" >
      <?php if($donneesclient['cmail']!=""){ ?>
      <option value="<?php echo $donneesclient['cmail']; ?>" ><?php echo $donneesclient['cmail']; ?></option>
      <?php } ?>
      <?php if($donneesclient['garmail']!=""){ ?>
      <option value="<?php echo $donneesclient['garmail']; ?>" ><?php echo $donneesclient['garmail']; ?></option>
      <?php } ?>
    </select>
    <button type="submit" class="btn btn-success"><i class="fa fa-envelope"></i> Envoyer par Email</button>
    <input type="hidden" name="action" value="vuepdf" />
    <input type="hidden" name="pdf" value="envoipdf" />
    <input type="hidden" name="qid" value="<?php echo $qid ?>" />

  </form>
  <br>
  <a href="client.php?action=afficher&cid=<?php echo $cid;?>" class="btn btn-lg btn-default">retour à la page client</a>
  <?php
}
?>

</div>
</div>





<?php

include_once('./fct/scripts.php');

?>
