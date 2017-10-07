<?php include_once('./vue/head.php'); ?>

</head>

<body>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-danger">
        <div class="panel-heading">
          <h3 class="panel-title">Supression</h3>
        </div>
        <div class="panel-body">
          <p>êtes vous certain de vouloir supprimer ce contrat ?</p>
          <form action="./fct/opcontrat.php" method="post">
            <input type="hidden" name="type" value="suppr" />
            <input type="hidden" name="cnid" value="<?php echo $cnid ?>"/>
            <input type="hidden" name="cid" value="<?php echo $cid ?>"/>
            <button class="btn btn-danger btn-lg" type="submit">supprimer</button>

          <a class="btn btn-default btn-lg" href="../index.php">retour</a>
          </form>
        </div>
      </div>
    </div>
  </div>
