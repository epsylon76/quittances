  <div class="container">
    <div class="row">
      <h2>Logements<a class="btn btn-primary btn-sm pull-right" href="logements.php?action=new">Nouveau logement</a></h2>

      <p>
        <i class="fa fa-cube" aria-hidden="true"></i> Meublé <i class="fa fa-bed" aria-hidden="true"></i> Chambre
      </p>

    </div>

    <div class="col-md-12" style="text-align:right">
      <table class="table table-bordered text-left table-fixed table-striped" id="tableau_logements">
        <thead>
          <td><i class="fa fa-eye"></i></td>
          <td>Description</td>
          <td>Ville</td>
          <td>Société</td>
          <td>Adresse</td>
          <td>Etage</td>
          <td>Contrats</td>
        </thead>
        <?php
        foreach($listelogements as $ligne)
        {
          ?>

          <tr>
            <td><a href="logements.php?action=modif&lid=<?php echo $ligne['lid']?>"><i class="fa fa-eye"></i></a></td>
            <td>
              <?php
              echo $ligne['ldesc'];

              if($ligne['ltype']=="1")
              {echo '<i class="fa fa-cube pull-right" aria-hidden="true"></i>';}
              if($ligne['ltype']=="2")
              {echo '<i class="fa fa-bed pull-right" aria-hidden="true"></i>';}
              ?>
            </td>
            <td><?php echo $ligne['lville']?></td>
            <td>
              <?php
              $nomsoc = $societe->donneessociete($ligne['sid']);
              echo $nomsoc['snom'];?>
            </td>
            <td><?php echo $ligne['ladresse']?></td>
            <td><?php echo $ligne['letage']?></td>
            <td>
              <?php
              $contrats = $logement->listecontrats($ligne['lid']);
              $contrats = array_filter($contrats);
              if(!empty($contrats)){
                foreach($contrats as $contrat)
                {
                  ?>
                  <a class="btn btn-primary btn-sm" href="client.php?action=afficher&cid=<?php echo $contrat['cid']; ?>">
                    <?php

                    $nomclient = $client->donneesclient($contrat['cid']);
                    echo $nomclient['cnom'];
                    ?>
                  </a>
                  <?php }} ?>
            </td>
          </tr>
          <?php
        }
        ?>

      </table>

    </div>

  </div>
