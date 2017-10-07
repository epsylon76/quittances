
<div class="row">
  <div class="container">

    <div class="starter-template">
      <form method="post" action="./fct/oplogement.php">
        <h1>
          <?php

          if($_GET['action']=="modif"){echo $ldesc;}
          else {
            echo "Nouveau logement";
          }
          ?>
        </h1>

        <?php
        if($_GET['action']=="modif")
        {

          $contrats = $logement->listecontrats($lid);
          $contrats = array_filter($contrats);
          if(!empty($contrats)){
            foreach($contrats as $contrat)
            {
              ?>
              <a class="btn btn-primary" href="client.php?action=afficher&cid=<?php echo $contrat['cid']; ?>">
                <?php

                $nomclient = $client->donneesclient($contrat['cid']);
                echo $nomclient['cnom'];
                ?>
              </a>
              <?php } ?>
            </p>

            <?php }} ?>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="ldesc">Description Logement</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-italic" aria-hidden="true"></i></span>
                    <input type="text" maxlength="60" required class="form-control" id="ldesc" name="ldesc" value="<?php echo $ldesc; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="letage">Etage</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-italic" aria-hidden="true"></i></span>
                    <input type="text" maxlength="60" class="form-control" id="letage" name="letage" value="<?php echo $letage; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="ladresse">Adresse</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                    <input type="text" maxlength="60" class="form-control" id="ladresse" name="ladresse" value="<?php echo $ladresse; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="lcp">Code Postal</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    <input type="text" maxlength="5"  required class="form-control input-group" id="lcp" name="lcp" value="<?php echo $lcp; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="lville">Ville</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <input type="text" maxlength="65"  required class="form-control input-group" id="lville" name="lville" value="<?php echo $lville; ?>">
                  </div>
                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <label for="sid">Société propriétaire</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-handshake-o" aria-hidden="true"></i></span>
                    <?php echo $societe->selectsociete($sid); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="lloyer">Loyer</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-euro" aria-hidden="true"></i></span>
                    <input type="text" maxlength="65"  required class="form-control input-group" id="lloyer" name="lloyer" value="<?php echo $lloyer; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="lprov">Provision sur charge</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-bolt" aria-hidden="true"></i></span>
                    <input type="text" maxlength="65"  required class="form-control input-group" id="lprov" name="lprov" value="<?php echo $lprov; ?>">
                  </div>
                </div>


                <div class="form-group" style="margin-top:20px;">

                  <label class="radio-inline"><input type="radio" name="ltype" value="0" <?php if($ltype=="0"){echo "checked";} ?>>Normal</label>
                  <label class="radio-inline"><input type="radio" name="ltype" value="1" <?php if($ltype=="1"){echo "checked";} ?>>Meublé</label>
                  <label class="radio-inline"><input type="radio" name="ltype" value="2" <?php if($ltype=="2"){echo "checked";} ?>>Chambre</label>
                </div>




                <input type="hidden" name="type" value="<?php echo $_GET['action'] ?>">
                <!-- si l'action est une modification on passe le cid en info -->
                <?php  if($_GET['action']=="modif"){echo '<input type="hidden" name="lid" value="'.$lid.'">';}  ?>

              </div> <!-- md- 6 -->
            </div><!-- row-->

            <div class="row">
              <button type="submit" class="btn btn-lg btn-primary">
                <?php
                if($_GET['action']=="modif")
                {
                  echo "Modifier";
                }
                else {
                  echo "Enregistrer";
                }
                ?>
              </button>
              <a class="btn btn-lg btn-default" href="logements.php?action=liste">retour</a>
              <?php
              if($_GET['action']=="modif"){
                if($logement->nbcontrats($lid)[0]=="0")
                { ?>
                  <a class="btn btn-lg btn-danger" href="logements.php?action=suppr&lid=<?php echo $lid?>">Supprimer</a>
                  <?php
                }
              }
              ?>
            </form>
          </div>
