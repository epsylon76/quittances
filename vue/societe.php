<?php include_once('head.php'); ?>
<?php include_once('navbar.php'); ?>


  <div class="row">
    <div class="container">

      <div class="starter-template">
        <form method="post" action="./fct/opsociete.php" enctype="multipart/form-data">
          <h1>
            <?php

            if(isset($sid)){echo "Société ".$snom;}
            else {
              echo "Ajout Société";
            }
            ?>
          </h1>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="snom">Nom Société</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-handshake-o" aria-hidden="true"></i></span>
                  <input type="text" maxlength="60" required class="form-control" id="snom" name="snom" value="<?php echo $snom; ?>">
                </div>
              </div>


              <div class="form-group">
                <label for="sadresse">Adresse</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                  <input type="text" maxlength="100" required class="form-control" id="sadresse" name="sadresse" value="<?php echo $sadresse; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="scp">Code Postal</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                  <input type="text" maxlength="5"  required class="form-control input-group" id="scp" name="scp" value="<?php echo $scp; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="sville">Ville</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                  <input type="text" maxlength="65"  required class="form-control input-group" id="sville" name="sville" value="<?php echo $sville; ?>">
                </div>
              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="stel">Téléphone</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                  <input type="phone" required maxlength="10" class="form-control" id="stel" name="stel" value="<?php echo $stel; ?>">
                </div>
              </div>



              <div class="form-group">
                <label for="semail">Email</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-at" aria-hidden="true"></i></span>
                  <input type="email" class="form-control" id="semail" name="semail" value="<?php echo $semail; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="urltampon">Tampon</label>
                <div class="input-group">
                  <input type="file" class="form-control" id="tampon" name="tampon">

                  <?php if ($urltampon!="#")
                  {
                    ?>
                    <img src="<?php echo $urltampon ?>" width="50%" height="50%"/>
                    <?php
                  }
                  ?>

                </div>
              </div>

              <input type="hidden" name="type" value="<?php echo $_GET['action'] ?>">
              <input type="hidden" name="urltampon" value="<?php echo $urltampon ?>">
              <!-- si l'action est une modification on passe le cid en info -->
              <?php  if($_GET['action']=="modif"){echo '<input type="hidden" name="sid" value="'.$sid.'">';}  ?>

            </div> <!-- md- 6 -->
          </div><!-- row-->

          <div class="row">
            <button type="submit" class="btn btn-lg btn-primary">
              <?php
              if($_GET['action']=="modif")
              {
                echo "Enregistrer";
              }
              else {
                echo "Nouvelle société";
              }
               ?>
            </button>
            <a class="btn btn-lg btn-default" href="index.php">retour</a>
            <?php if($_GET['action']=="modif")
            {
              if($societe->has_quittances($sid)==false)
              {
                ?>
                  <a class="btn btn-lg btn-danger" href="societe.php?action=suppr&sid=<?php echo $sid; ?>">supprimer</a>
                <?php
              }
            }
            ?>
          </form>
        </div>


<?php include_once('./fct/scripts.php'); ?>
