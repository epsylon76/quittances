<?php include_once('head.php'); ?>
<?php include_once('navbar.php'); ?>

<div class="container">
  <div class="row">


    <div class="starter-template">
      <div class="col-md-6">
        <h3><strong><?php echo $cli['cnom'] ?></strong>
          <?php //on affiche uniquement le bouton de suppression s'il n'a aucun contrats
          if(!$contrat->has_contrats($cli['cid']))
          {
            ?>
            <a class="pull-right btn btn-danger btn-sm" style="margin-left:5px" href="client.php?cid=<?php echo $cli['cid']."&action=suppr"; ?>"><i class="fa fa-trash-o fa-lg"></i></a>
            <?php
          }
          ?>

          <a class="pull-right btn btn-warning btn-sm" href="client.php?cid=<?php echo $cli['cid']."&action=modif"; ?>"><i class="fa fa-edit"></i> Modifier</a>

        </h3>
        <h5>Tel : <a href="tel:<?php echo $cli['ctel'] ?>"><?php echo $cli['ctel'] ?></a></h5>
        <h5>Mail : <a href="mailto:<?php echo $cli['cmail'] ?>"><?php echo $cli['cmail'] ?></a></h5>
        <h4>Observations</h4>
        <form action="./fct/commentaire.php">
          <textarea style="width:100%; height:100px;" name="observation"><?php echo $cli['observations']; ?></textarea>
          <input type="hidden" name="cid" value="<?php echo $cli['cid']; ?>" />
          <button type="submit" class="btn btn-success btn-xs pull-right"><i class='fa fa-pencil'></i> Enregistrer</button>
        </form>
      </div>


      <div class="col-md-6">
        <h4>Infos Garant</h4>
        <h5>Nom : <?php echo $cli['garnom'] ?></h5>
        <h5>Tel : <?php echo $cli['gartel'] ?></h5>
        <h5>Mail : <?php echo $cli['garmail'] ?></h5>
        <h5><?php echo $cli['garadr'] ?></h5>
        <h5><?php echo $cli['garcp'] ?> <?php echo $cli['garville'] ?></h5>
      </div>

    </div><!-- /.starter template -->
  </div> <!--row -->


  <div class="row" style="margin-top:50px;">

    <div class="col-md-6">
      <h2>Contrats<a class="btn btn-primary btn-sm pull-right" href="contrat.php?action=new&cid=<?php echo $cli['cid'] ?>"><i class='fa fa-plus'></i> Nouveau contrat</a></h2>


      <?php
      foreach($listecontrats as $con) //pour chaque cas de contrat
      {

        if($con['datefin']!="0000-00-00") // date de fin définie ?
        {
          if($con['datefin']>date("Y-m-d")) //la date est future ?
          {
            if(intervalle($con['datefin'])<60 && intervalle($con['datefin'])>0) //la  fin approche car on est dans l'intervalle de 60 jours
            {
              $couleur="alert-warning";
              $phrase=' début : '.date_unix_humain($con['datedebut']).' |<strong>il reste '.intervalle($con['datefin']).' jours |  fin : '.date_unix_humain($con['datefin']).'</strong><br>';
            }
            else //la fin est dans plus de 60 jour, le contrat est en cours
            {
              $couleur="alert-success";
              $phrase=' début : '.date_unix_humain($con['datedebut']).' | fin : '.date_unix_humain($con['datefin']);
            }
          }
          else //la date de fin est passée
          {
            $couleur="alert-danger";
            $phrase=' début : '.date_unix_humain($con['datedebut']).' | fin le : '.date_unix_humain($con['datefin']);
          }
        }
        else //il n'y a pas de date de fin
        {
          $couleur="alert-info";
          $phrase=' début : '.date_unix_humain($con['datedebut']).' | Pas de date de fin définie';
        }
        // les valeurs non conditionnelles
        $log = $logement->donneeslogement($con['lid']);
        //maintenant on peut afficher
        ?>

        <div class="alert <?php echo $couleur;?>" role="alert">
          <p>

            <?php
            if($log['ltype']=="1")
            {echo '<i class="fa fa-cube" aria-hidden="true"></i> Meublé';}
            if($log['ltype']=="2")
            {echo '<i class="fa fa-bed" aria-hidden="true"></i> Chambre';}
            ?>
            <?php echo $log['ldesc']; ?>

            <a href="contrat.php?action=modif&cnid=<?php echo $con['cnid']; ?>" class="btn btn-default btn-sm pull-right">Détails</a>
            <?php echo $log['letage']; ?><br>
            <?php echo $log['ladresse']; ?><br>
            <?php echo $log['lcp']; ?> <?php echo $log['lville']; ?><br>
          </p>
          <?php echo $phrase; ?>
          <form id="<?php echo $con['cnid'];?>" class="form-inline" action="quittance.php" method="get">
            <?php echo select_annee(date("Y")); ?>
            <button type="submit" class="btn btn-success input-sm"><i class='fa fa-plus'></i> Nouvelle quittance</button>
            <a class="btn btn-primary btn-sm" href="./appel.php?cnid=<?php echo $con['cnid']; ?>">Appel de quittance</a>
            <input type="hidden" name="action" value="new"/>
            <input type="hidden" name="cnid" value="<?php echo $con['cnid'];?>"/>
            <input type="hidden" name="cid" value="<?php echo $con['cid'];?>"/>
          </form>

        </div>

        <?php
      }   //foreach
      ?>

    </div> <!-- col-md-6 -->




    <div class="col-md-6">
      <h2>Quittances du client</h2>
      <div class="tableaulim">
        <table class="table table-bordered table-fixed table-striped">
          <thead>
            <td>Apt</td>
            <td>Mois</td>
            <td>Année</td>
            <td>Montant</td>
            <td>Provision</td>
            <td><i class="fa fa-envelope"></i></td>
            <td><i class="fa fa-eye"></i></td>
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
              echo '<td>'.$log['ldesc'].'</td>';
              echo '<td>'.$mois['nommois'].'</td>';
              echo '<td>'.$annee.'</td>';
              echo '<td>'.$ligneq['qloyer'].'</td>';
              echo '<td>'.$ligneq['qprov'].'</td>';
              echo '<td>';
              if($ligneq['dateenvoi']!="0000-00-00"){echo date_unix_humain($ligneq['dateenvoi']).' <i class="fa fa-envelope"></i>';}
              echo '</td>';
              echo '<td><a href="quittance.php?action=modif&qid='.$ligneq['qid'].'"><i class="fa fa-eye"></i></a></td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>


    </div>





  </div><!-- row -->
</div> <!-- container -->
