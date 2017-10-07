<div class="row">
  <div class="container" style="border:2px solid black; background-color:rgba(0,50,50,0.1);">


    <h2 class="text-center">Appel de loyer</h2>



    <div class="col-md-4 col-sm-6" >
      <form action="appel.php" method="post">

        <input type="hidden" name="cnid" value="<?php echo $cnid ?>"/>
        <input type="hidden" name="cid" value="<?php echo $cid ?>"/>
        <input type="hidden" name="sid" value="<?php echo $sid ?>"/>
        <input type="hidden" name="lid" value="<?php echo $lid ?>"/>

        <div class="form-group">
          <label for="client">Client</label>
          <input type="text" class="form-control" id="client"  value="<?php echo $donneesclient['cnom']; ?>" disabled>
        </div>

        <div class="form-group">
          <label for="societe">Société</label>
          <input type="text" class="form-control" id="societe"  value="<?php echo $donneessociete['snom']; ?>" disabled>
        </div>

        <div class="form-group">
          <label for="logement">Logement</label>
          <input type="text" class="form-control" id="logement" value="<?php echo $donneeslogement['ldesc']; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="addrlogement">Adresse logement</label>
          <input type="text" class="form-control" id="addrlogement" value="<?php echo $donneeslogement['ladresse']; ?>"disabled >
        </div>


      </div>

      <div class="col-md-4 col-sm-6" >


        <div class="form-group">
          <label for="mois">Mois</label>
          <?php
            select_mois(01,3016,$cid);
          ?>
        </div>


        <div class="form-group">
          <label for="annee">Année</label>
          <div class="input-group" style="width:50%">
            <input type="text" class="form-control" id="annee" name="annee"/>
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



    </div> <!-- row -->



  </div>

</div>


<div class="row">
  <div class="container">
    <br>
    <!-- bloc de boutons en dessous de la quittance, en fonction de l'acion -->

    <button type="submit" class="btn btn-primary" name="action" value="vue"><i class="fa fa-eye"></i> Voir l'appel en PDF</button>

    <h4>Message corps email</h4>
    <textarea style="width:50%; height:70px;" name="message">Je vous prie de trouver çi joint l'appel de loyer,
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
    <button type="submit" name="action" class="btn btn-success" value="envoi"><i class="fa fa-envelope"></i> Envoyer par Email</button>


  </form>
  <br>
  <a href="client.php?action=afficher&cid=<?php echo $cid;?>" class="btn btn-lg btn-default">retour à la page client</a>


</div>
</div>
