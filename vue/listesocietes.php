<?php include_once('head.php');?>

<body>
  <?php include_once('navbar.php'); ?>

  <div class="container">
    <div class="row">
      <h2>Liste des Sociétés<a class="btn btn-primary btn-sm pull-right" href="societe.php?action=new">Nouvelle Société</a></h2>
      <p></p>
    </div>

    <div class="col-md-12" style="text-align:right">
      <table class="table table-bordered text-left table-fixed table-striped">
        <?php
        foreach($listesocietes as $ligne)
        {
          ?>
          <tr>
            <td><?php echo $ligne['snom']?></td>
            <td><?php echo $ligne['sadresse']?></td>
            <td><?php echo $ligne['sville']?></td>
            <td><a href="societe.php?action=modif&sid=<?php echo $ligne['sid']?>"><i class="fa fa-edit"></i></a></td>
          
          </tr>
          <?php
        }
        ?>


      </table>

    </div>

  </div>
