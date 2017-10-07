<?php include_once('head.php'); ?>
<?php include_once('navbar.php'); ?>

<div class="container">
  <div class="row">



    <form method="post" action="./fct/opclient.php">
      <h1>
        <?php

        if(isset($cid)){echo "Client numéro ".$cid;}
        else {
          echo "Nouveau client";
        }
        ?>
      </h1>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="nom">Nom Prénom</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></span>
            <input type="text" maxlength="60"  required class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="tel">Telephone</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
            <input type="text" maxlength="10" class="form-control" id="tel" name="tel" value="<?php echo $tel; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="mail">Email</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-at" aria-hidden="true"></i></span>
            <input type="email" maxlength="60" class="form-control input-group" id="mail" name="mail" value="<?php echo $mail; ?>">
          </div>
        </div>
      </div>
      <div class="col-md-6">


        <input type="hidden" name="type" value="<?php echo $action ?>">
        <!-- si l'action est une modification on passe le cid en info -->
        <?php  if($action=="modif"){echo '<input type="hidden" name="cid" value="'.$cid.'">';}  ?>

      </div> <!-- md- 6 -->

    </div><!-- row-->
    <div class="row">
      <h3>Garant</h3>
      <div class="col-md-6">
        <div class="form-group">
          <label for="garnom">Nom Prénom</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></span>
            <input type="text" maxlength="60" class="form-control" id="garnom" name="garnom" value="<?php echo $garnom; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="gartel">Telephone</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
            <input type="text" maxlength="10" class="form-control" id="gartel" name="gartel" value="<?php echo $gartel; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="garmail">Email</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-at" aria-hidden="true"></i></span>
            <input type="email" maxlength="60" class="form-control input-group" id="garmail" name="garmail" value="<?php echo $garmail; ?>">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="garadr">Adresse</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
            <input type="text" maxlength="120" class="form-control" id="garadr" name="garadr" value="<?php echo $garadr; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="garcp">Code Postal</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <input type="text" maxlength="5"  class="form-control" id="garcp" name="garcp" value="<?php echo $garcp; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="garville">Ville</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="garville" name="garville" value="<?php echo $garville; ?>">
          </div>
        </div>
      </div>
    </div><!--row-->

    <div class="row">
      <button type="submit" class="btn btn-lg btn-primary">
        Enregistrer
      </button>
      <?php if($_GET['action']=="new"){
        ?>
        <a class="btn btn-lg btn-default" href="index.php">annuler</a>
        <?php
      }else {
        ?>
        <a class="btn btn-lg btn-default" href="client.php?action=afficher&cid=<?php echo $cid ?>">retour</a>
        <?php
      }?>
    </form>
  </div>
</div>
