
<div class="container">
  <div class="row">

    <div class="starter-template">
      <form method="post" action="./fct/opcontrat.php">
        <h1>
          <?php
          if($action=="modif"){
            echo "Contrat ".$loc['cnom'];
          }
          if($action=="new"){
            echo "Nouveau contrat";
          }
          ?>
          <a class="btn btn-default" href="client.php?action=afficher&cid=<?php echo $cid ?>"><i class="fa fa-reply"></i></a>
        </h1>
      </div>
    </div>

    <div class="row">


      <div class="col-md-6">

        <input type="hidden" name="cid" value="<?php echo $cid; ?>">

        <div class="form-group">
          <label for="logement">Logement</label>
          <?php
          if($_GET['action']=="modif")
          {
            ?>
            <input type="text" class="form-control" id="logement" name="logement" disabled value="<?php echo $log['ldesc']; ?>">
            <input type="hidden" name="lid" value="<?php echo $con['lid']; ?>">
            <?php
          }ELSEIF($_GET['action']=="new")
          {
            echo $logement::selectlogement();
          }
          ?>
          <div id="details"></div>
        </div>

        <div class="form-group">
          <label for="datedebut">Date début</label>
          <input type="date" class="form-control" id="datedebut" name="datedebut" required value="<?php echo $datedebut; ?>">
        </div>

        <div class="form-group">
          <label for="datefin">Date fin</label>
          <input type="date" class="form-control" id="datefin" name="datefin" value="<?php echo $datefin; ?>">
        </div>

        <div class="form-group">
          <label for="datedepart">Date départ réel</label>
          <input type="date" class="form-control" id="datedepart" name="datedepart" value="<?php echo $datedepart; ?>">
        </div>




      </div>

      <div class="col-md-6">


        <div class="form-group">
          <label for="loyer">loyer</label>
          <input type="text" class="form-control" id="loyer" name="loyer" value="<?php echo $loyer; ?>">
        </div>

        <div class="form-group">
          <label for="provision">Provision</label>
          <input type="text" class="form-control" id="provision" name="provision" value="<?php echo $provision; ?>">
        </div>

        <input type="hidden" name="type" value="<?php echo $action ?>">
        <?php if(isset($cnid)){
          echo '<input type="hidden" name="cnid" value="'.$cnid.'">';
        }
        ?>
      </div> <!-- md- 6 -->

    </div><!-- row-->

    <div class="row">

      <button type="submit" class="btn btn-primary"><?php if($action=="new"){echo "Nouveau contrat";}ELSE{echo "Enregistrer";} ?></button>
      <?php if($_GET['action']=="modif" && $boutonsuppr==false)
      { ?>
        <a class="btn btn-danger" href="contrat.php?action=suppr&cnid=<?php echo $cnid; ?>&cid=<?php echo $cid ?>">supprimer</a>
        <?php } ?>
      </form>
    </div>
    <?php
    if($_GET['action']=="modif") //on affiche la deuxieme partie en mode modif seuleement
    {
      ?>
      <div class="row">

        <div class="col-md-12">
          <h2>Quittances du contrat</h2>
          <a class="btn btn-primary" href="./appel.php?cnid=<?php echo $cnid; ?>">Appel de quittance</a>
          <form method="get" action="quittance.php" class="form-inline pull-right" >
            <input type="hidden" name="action" value="new" />
            <input type ="hidden" name="cnid" value="<?php echo $cnid ?>" />
            <?php echo select_annee(date("Y")); ?>
            <button type="submit" class="btn btn-primary" >Nouvelle quittance</button>
          </form>

          <div class="clearfix"></div>

          <div class="tableaulim">
            <table class="table table-bordered table-fixed table-striped">
              <thead data-href="quittance.php">
                <td><i class="fa fa-eye"></i></td>
                <td>Apt</td>
                <td>SCI</td>
                <td>Mois</td>
                <td>Année</td>
                <td>Montant</td>
                <td>Provision</td>
                <td><i class="fa fa-envelope"></i></td>
              </thead>

              <tbody>
                <?php

                foreach ($lignesquittances as $ligneq)
                {
                  //le mois et l'annee
                  $mois = mois($ligneq['qdate']);
                  $date=new DateTime($ligneq['qdate'],new DateTimeZone('Europe/Paris'));
                  $annee = $date->format('Y');
                  //la société
                  $soc = $societe->donneessociete($ligneq['sid']);
                  //le logement
                  $log = $logement->donneeslogement($ligneq['lid']);

                  echo '<tr>';
                  echo '<td><a href="quittance.php?action=modif&qid='.$ligneq['qid'].'"><i class="fa fa-eye"></i></a></td>';
                  echo '<td>'.$log['ldesc'].'</td>';
                  echo '<td>'.$soc['snom'].'</td>';
                  echo '<td>'.$mois['nommois'].'</td>';
                  echo '<td>'.$annee.'</td>';
                  echo '<td>'.$ligneq['qloyer'].'</td>';
                  echo '<td>'.$ligneq['qprov'].'</td>';
                  echo '<td>';
                  if($ligneq['dateenvoi']!="0000-00-00"){echo '<i class="fa fa-envelope"></i> '.date_unix_humain($ligneq['dateenvoi']);}
                  echo '</td>';

                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <div id="affichage">
      </div>




      <?php } //fin du if d'affichage
      ?>

    </div>
