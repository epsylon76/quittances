
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">


  <title>Programme quittances</title>


</head>

<body>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-danger" style="margin-top:50px;">
        <div class="panel-heading">
          <h3 class="panel-title">Supression</h3>
        </div>
        <div class="panel-body">
          <p>êtes vous certain de vouloir supprimer cette quittance ?</p>
          <form action="./fct/opquittance.php" method="post">
            <input type="hidden" name="type" value="suppr" />
            <input type="hidden" name="qid" value="<?php echo $qid ?>"/>
            <input type="hidden" name="cnid" value="<?php echo $cnid ?>"/>
            <button class="btn btn-danger btn-lg" type="submit">supprimer</button>
          <a class="btn btn-default btn-lg" href="../index.php">retour</a>
          </form>
        </div>
      </div>
    </div>
  </div>
