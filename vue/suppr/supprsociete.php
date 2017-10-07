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
            <p>êtes vous certain de vouloir supprimer cette socxiété ?</p>
            <form action="./fct/opsociete.php" method="post">
              <input type="hidden" name="type" value="suppr" />
              <input type="hidden" name="sid" value="<?php echo $sid ?>"/>
              <button class="btn btn-danger btn-lg" type="submit">supprimer</button>

            <a class="btn btn-default btn-lg" href="../index.php">annuler</a>
            </form>
          </div>
        </div>
      </div>
    </div>
