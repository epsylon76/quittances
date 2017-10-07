

  <div class="container">



    <div class="row">
      <div class="col-md-12">
        <h4>Contrats en cours</h4>

        <div>
          <table class="table table-bordered table-striped">

            <?php
            if($lignescontrat)
            {
              foreach ($lignescontrat as $lignes)
              {
                $cli = $client->donneesclient($lignes['cid']);
                $log = $logement->donneeslogement($lignes['lid']);
                $soc = $societe->donneessociete($lignes['sid']);

                echo '<tr>';
                echo '<td><a href="contrat.php?action=modif&cnid='.$lignes['cnid'].'"><i class="fa fa-eye"></i></a></td>';
                echo '<td>'.$log['ldesc'].'</td>';
                echo '<td>'.$log['letage'].'</td>';
                echo '<td><a href=client.php?action=afficher&cid='.$cli['cid'].'>'.$cli['cnom'].'</a></td>';
                echo '<td>Debut : '.date_unix_humain($lignes['datedebut']).'</td>';
                echo '<td>Fin '.date_unix_humain($lignes['datefin']).'</td>';
                echo '</tr>';
              };
            }
            ?>

          </table>

        </div>
      </div>



    </div>	<!-- row -->

    <div class="row">
      <div class="col-md-12">
        <h2>Quittances récentes</h2>
        <table class="table table-bordered table-striped">

          <?php
            $i=0;
          if(!empty($lignesquittances))
          {
            foreach ($lignesquittances as $lignes)
            {

              $cli = $client->donneesclient($lignes['cid']);
              $log = $logement->donneeslogement($lignes['lid']);
              $soc = $societe->donneessociete($lignes['sid']);

              echo '<tr>';
              echo '<td><a href="client.php?action=afficher&cid='.$lignes['cid'].'"><i class="fa fa-eye"></i></a></td>';
              echo '<td>'.$cli['cnom'].'</td>';
              echo '<td><a href="logements.php?action=modif&lid='.$log['lid'].'"><i class="fa fa-eye"></i></a> '.$log['ldesc'].' '.$log['letage'].'</td>';
              if($lignes['dateenvoi']!="0000-00-00")
              {
                echo '<td><i class="fa fa-envelope"></i> '.date_unix_humain($lignes['dateenvoi']).'</td>';
              }ELSE
              {echo '<td></td>';}
              echo '</tr>';
               if(++$i > 10) break;
            };
          }
          ?>

        </table>
      </div>
    </div>
    <a href="sauv.php" class="btn btn-warning btn-lg">Sauvegarder le programme</a>
  </div>
