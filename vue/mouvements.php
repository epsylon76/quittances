

  <div class="container">
    <div class="row">
      <h2><?php echo $contrat->nb_mvt_contrats($mois,$annee); ?> Mouvements en <?php echo mois_from_no($mois).' '.$annee; ?>

      </h2>

      <form class="form-inline" method="get" action="mouvements.php">
        <?php echo select_annee($annee);?>
        <button type="submit" class="btn btn-success btn-sm">Changer</button>
      </form>

      <p>
        <style>
          .label{margin-left:5px;}
        </style>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=1">Jan -> <?php echo $contrat->nb_mvt_contrats(1,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=2">Fév -> <?php echo $contrat->nb_mvt_contrats(2,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=3">Mars -> <?php echo $contrat->nb_mvt_contrats(3,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=4">Avr -> <?php echo $contrat->nb_mvt_contrats(4,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=5">Mai -> <?php echo $contrat->nb_mvt_contrats(5,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=6">Juin -> <?php echo $contrat->nb_mvt_contrats(6,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=7">Juil -> <?php echo $contrat->nb_mvt_contrats(7,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=8">Août -> <?php echo $contrat->nb_mvt_contrats(8,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=9">Sept -> <?php echo $contrat->nb_mvt_contrats(9,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=10">Oct -> <?php echo $contrat->nb_mvt_contrats(10,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=11">Nov -> <?php echo $contrat->nb_mvt_contrats(11,$annee);?></a>
        </span>
        <span class="label label-info">
          <a style="color:white" href="mouvements.php?annee=<?php echo $annee?>&mois=12">Déc -> <?php echo $contrat->nb_mvt_contrats(12,$annee);?></a>
        </span>
      </p>



      <div class="col-md-6">
        <table class="table">
          <h4>Entrées</h4>
          <?php
          //variables pour le calcul final
          $totalentrees=0;
          if($liste_debut)
          {
            foreach($liste_debut as $ligne)
            {
              if(ponctuel($ligne['datedebut'],$ligne['datefin'])){$class="info";}ELSE{$class="";}
              ?>
              <tr class="<?php echo $class;?>" >
                <td>
                  <?php echo date_unix_humain($ligne['datedebut']); ?>
                </td>
                <td>
                  <?php
                  echo 'contrat '.$ligne['cnid'];
                  ?>
                </td>
                <td>
                  <?php
                  $cli = $client->donneesclient($ligne['cid']);
                  echo $cli['cnom'];
                  ?>
                </td>
                <td>
                  <?php
                  $log = $logement->donneeslogement($ligne['lid']);
                  echo $log['ldesc'];
                  ?>
                </td>
                <td>
                  <?php echo $ligne['cloyer']; ?>
                </td>
                <td>
                  <?php echo $ligne['cprov']; ?>
                </td>
                <td>
                  <?php
                  $total = $ligne['cprov']+$ligne['cloyer'];
                  $totalentrees = $totalentrees+$total;
                  echo $total;
                  ?>
                </td>
              </tr>
              <?php
            }
          }
          ?>
          <tr>
            <td colspan="6" class="text-right" style="font-weight:bold;">
              TOTAL des entrées =
            </td>
            <td>
              <?php echo $totalentrees; ?>
            </td>

          </table>
        </div>

        <div class="col-md-6">
          <table class="table">
            <h4>Sorties</h4>
            <?php
            //variables pour le calcul final
            $totalsorties=0;

            if($liste_fin)
            {
              foreach($liste_fin as $ligne)
              {
                if(ponctuel($ligne['datedebut'],$ligne['datefin'])){$class="info";}ELSE{$class="";}
                ?>
                <tr class="<?php echo $class;?>" >
                  <td>
                    <?php echo date_unix_humain($ligne['datefin']); ?>
                  </td>
                  <td>
                    <?php
                      echo 'contrat '.$ligne['cnid'];
                    ?>
                  </td>
                  <td>
                    <?php
                    $cli = $client->donneesclient($ligne['cid']);
                    echo $cli['cnom'];
                    ?>
                  </td>
                  <td>
                    <?php
                    $log = $logement->donneeslogement($ligne['lid']);
                    echo $log['ldesc'];
                    ?>
                  </td>
                  <td>
                    <?php echo $ligne['cloyer']; ?>
                  </td>
                  <td>
                    <?php echo $ligne['cprov']; ?>
                  </td>
                  <td>
                    <?php
                    $total = $ligne['cprov']+$ligne['cloyer'];
                    if(ponctuel($ligne['datedebut'],$ligne['datefin']))
                    {echo $total.' -> 0';}else
                    {
                    $totalsorties = $totalsorties+$total;
                    echo $total;
                  }

                    ?>
                  </td>
                </tr>
                <?php
              }
            }
            ?>
            <tr>
              <td colspan="6" class="text-right" style="font-weight:bold;">
                TOTAL des sorties =
              </td>
              <td>
                <?php echo $totalsorties; ?>
              </td>

            </table>
          </div>
        </div>




        <div class="row">
          <div class="col-md-12">
            <table class="table">

              <tr>
                <td>
                  Mouvements de <?php echo mois_from_no($mois).' '.$annee;?>
                </td>
                <td>
                  Entrées + <?php echo $totalentrees;?>
                </td>
                <td>
                  Sorties - <?php echo $totalsorties; ?>
                </td>
                <td class="text-right">
                  Total
                </td>
                <td class="text-left">
                    <?php echo $totalentrees-$totalsorties ?>
                </td>
              </tr>

          </table>
          </div>
        </div>






        <?php include_once('./fct/scripts.php'); ?>
